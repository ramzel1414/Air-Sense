import serialportgsm from 'serialport-gsm';

let modem = serialportgsm.Modem()
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
}

modem.open('COM5', options, {});

modem.on('open', data => {
    // initialize modem
    modem.initializeModem(() => {
        console.log("Modem is initialized");

        // Send SMS
        modem.sendSMS('+639606421564', 'Testing! from serial', true, data => {
            console.log(data);
        })
    })
})
modem.on('onSendingMessage', result => {
    console.log(result)
})


//DEBUG COMMANDS
// Get SIM number
// modem.getOwnNumber((data) => {
//     console.log(data);
// });

// Get SIM signal
// modem.getNetworkSignal((data) => {
//     console.log(data);
// });

// Get SMS Inbox
// modem.getSimInbox((data) => {
//     console.log(data)
// });

// Delete All SMS Inbox
// modem.deleteAllSimMessages((data) => {
//     console.log("Deleted All Messages")
//     console.log(data);
// })



