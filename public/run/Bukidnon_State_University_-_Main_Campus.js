import axios from 'axios';
import serialportgsm from 'serialport-gsm';

const sender = '639658208285';
let modem = serialportgsm.Modem();
let options = {
    baudRate: 9600,
    dataBits: 8,
    stopBits: 1,
    parity: 'none',
    rtscts: false,
    xon: false,
    xoff: false,
    xany: false,
    autoDeleteOnReceive: false,
    enableConcatenation: true,
    incomingCallIndication: true,
    incomingSMSIndication: true,
    pin: '',
    customInitCommand: '',
    cnmiCommand: 'AT+CNMI=2,1,0,2,1',
    logger: console
};
modem.open('COM4', options, {});
modem.on('open', data => {
    modem.initializeModem(() => {
        console.log("Modem is initialized");
        const processMessages = () => {
            modem.getSimInbox((messages) => {
                const filteredMessages = messages.data.filter(message => message.sender === sender);
                filteredMessages.forEach(message => {
                    const regex = /PM2.5: ([\d.]+)ug\/m3\nPM10: ([\d.]+) ug\/m3\nCO: ([\d.]+) ppm\nNO2: ([\d.]+) ppm\nOzone: ([\d.]+)/;
                    const matches = message.message.match(regex);
                    if (matches) {
                        axios.post('http://127.0.0.1:8000/air-quality-data', {
                            sender: message.sender,
                            message: message.message,
                            pm10: parseFloat(matches[2]),
                            pm25: parseFloat(matches[1]),
                            co: parseFloat(matches[3]),
                            no2: parseFloat(matches[4]),
                            ozone: parseFloat(matches[5]).toFixed(3),
                            dateTime: message.dateTimeSent,
                        })
                            .then(response => {
                                console.log('Air quality data sent successfully:', response.data.message);
                            })
                            .catch(error => {
                                console.error('Error sending air quality data:', error);
                            });
                    }
                });
            });

            modem.deleteAllSimMessages((data) => {
                console.log('Deleting Automatically');
            });
        };
        const deviceDelay = 30000;
        const baseDelay = 30000;
        const interval = Math.max(deviceDelay - baseDelay, 1000); // Ensure minimum of 1 second
        processMessages();
        setInterval(processMessages, interval);
    });
});