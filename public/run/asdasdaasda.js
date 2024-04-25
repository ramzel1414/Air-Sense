import axios from 'axios';
import serialportgsm from 'serialport-gsm';

const sender = '123456789125';
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
modem.open('COM1', options, {});
modem.on('open', data => {
    modem.initializeModem(() => {
        console.log("Modem is initialized");
        const processMessages = () => {
            modem.getSimInbox((messages) => {
                const filteredMessages = messages.data.filter(message => message.sender === sender);
                filteredMessages.forEach(message => {
                    const regex = /PM2.5: ([\d.]+)ug\/m3
PM10: ([\d.]+) ug\/m3
CO: ([\d.]+) ppm
NO2: ([\d.]+) ppm
Ozone: ([\d.]+)/;
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
        processMessages();
        setInterval(processMessages, 1000);
    });
});