<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeviceController extends Controller
{
    public function store(Request $request)
    {

        // Check if devicePort or deviceSim already exists
        $existingDevice = Device::where('devicePort', $request->input('devicePort'))
                                ->orWhere('deviceSim', $request->input('deviceSim'))
                                ->first();

        if ($existingDevice) {
            // Redirect back with error message if devicePort or deviceSim already exists
            return redirect()->route('admin.management')->with('error', 'Device Port or SIM # already exists.');
        }

        // Check if devicePort is numeric
        if (!is_numeric($request->input('devicePort'))) {
            return redirect()->route('admin.management')->with('error', 'Device Port must be a valid number.');
        }

        // Check if the existing deviceSim does not have exactly 12 characters
        if (strlen($request->input('deviceSim')) !== 12) {
            return redirect()->route('admin.management')->with('error', 'Device SIM # must be exactly 12 characters long.');
        }

        // Check if deviceSim is numeric
        if (!is_numeric($request->input('deviceSim'))) {
            return redirect()->route('admin.management')->with('error', 'Device SIM # must be a valid number.');
        }

        // Validate the incoming request data
        $request->validate([
            'deviceName' => 'required|string',
            'devicePort' => 'required|integer|unique:devices,devicePort',
            'deviceSim' => 'required|integer|unique:devices,deviceSim',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);


        // Create a new Device record
        $device = Device::create([
            'deviceName' => $request->input('deviceName'),
            'devicePort' => $request->input('devicePort'),
            'deviceSim' => $request->input('deviceSim'),
        ]);

        // Generate JavaScript content based on the device data
        $jsFileName = str_replace(' ', '_', $device->deviceName) . '.js';
        $jsContent = <<<EOD
        import axios from 'axios';
        import serialportgsm from 'serialport-gsm';

        const sender = '{$device->deviceSim}';
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

        modem.open('COM{$device->devicePort}', options, {});

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
                                    ozone: parseFloat(matches[5]),
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

                    modem.deleteAllSimMessages(() => {
                        console.log('Deleting Automatically');
                    });
                };

                processMessages();
                setInterval(processMessages, 1000);
            });
        });
        EOD;

        // Specify the target directory relative to the public directory
        $targetDirectory = public_path('run');

        // Ensure the target directory exists; if not, create it
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        // Specify the full path to the JavaScript file
        $jsFilePath = $targetDirectory . DIRECTORY_SEPARATOR . $jsFileName;

        // Save JavaScript content to the specified file path
        file_put_contents($jsFilePath, $jsContent);

        // Redirect back to admin management page with success message
        return redirect()->route('admin.management')->with('success', 'Device created successfully!');
    }


    public function AdminManagement()
    {
        // Retrieve all devices from the database
        $devices = Device::all();

        // Pass devices data and device count to the admin management view
        $deviceCount = $devices->count();
        return view('admin.admin_management', compact('devices', 'deviceCount'));
    }


    public function delete($id)
    {
        $device = Device::findOrFail($id);

        // Check if the deviceSim matches the restricted value
        if ($device->deviceSim === '639537399626') {
            return redirect()->route('admin.management')->with('error', 'Cannot delete this device as it is being used.');
        }

        // Check if any other device is using the same devicePort
        $existingDevice = Device::where('devicePort', $device->devicePort)->where('id', '!=', $device->id)->first();
        if ($existingDevice) {
            return redirect()->route('admin.management')->with('error', 'Cannot delete this device. Another device is using the same COMPORT.');
        }

        // Delete the associated JavaScript file
        $jsFileName = str_replace(' ', '_', $device->deviceName) . '.js';
        $jsFilePath = public_path('run/' . $jsFileName);

        if (File::exists($jsFilePath)) {
            File::delete($jsFilePath);
        }

        // Proceed with deleting the device
        $device->delete();

        return redirect()->route('admin.management')->with('success', 'Device deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        // Retrieve the device record by ID
        $device = Device::findOrFail($id);

        // Check if devicePort or deviceSim already exists for other devices
        $existingDevice = Device::where('id', '!=', $id)
                                ->where(function ($query) use ($request) {
                                    $query->where('devicePort', $request->input('devicePort'))
                                        ->orWhere('deviceSim', $request->input('deviceSim'));
                                })
                                ->first();

        if ($existingDevice) {
            // Redirect back with error message if devicePort or deviceSim already exists for another device
            return redirect()->route('admin.management')->with('error', 'Device Port or SIM # already exists for another device.');
        }

        // Check if the existing deviceSim does not have exactly 12 characters
        if (strlen($request->input('deviceSim')) !== 12) {
            return redirect()->route('admin.management')->with('error', 'Device SIM # must be exactly 12 characters long.');
        }

        // Check if the existing deviceSim matches the restricted value
        if ($device->deviceSim === '639537399626') {
            // If the deviceSim matches the restricted value, prevent updating deviceSim
            return redirect()->route('admin.management')->with('error', 'Cannot update this device as it is being used.');
        }

        // Validate devicePort to ensure it is a number
        if (!is_numeric($request->input('devicePort'))) {
            return redirect()->route('admin.management')->with('error', 'Device Port must be a valid number.');
        }

        // Validate deviceSim to ensure it is a number
        if (!is_numeric($request->input('deviceSim'))) {
            return redirect()->route('admin.management')->with('error', 'Device SIM # must be a valid number.');
        }


        // Delete the old JavaScript file associated with the device
        $oldJsFileName = str_replace(' ', '_', $device->deviceName) . '.js';
        $oldJsFilePath = public_path('run/' . $oldJsFileName);

        if (File::exists($oldJsFilePath)) {
            File::delete($oldJsFilePath);
        }

        // Update the device with allowed fields (deviceName, devicePort, latitude, longitude)
        $device->update([
            'deviceName' => $request->input('deviceName'),
            'devicePort' => $request->input('devicePort'),
            'deviceSim' => $request->input('deviceSim'),
        ]);

        // Create a new JavaScript file based on the updated device data
        $newJsFileName = str_replace(' ', '_', $device->deviceName) . '.js';
        $newJsContent = <<<EOD
        import axios from 'axios';
        import serialportgsm from 'serialport-gsm';

        const sender = '{$device->deviceSim}';
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

        modem.open('COM{$device->devicePort}', options, {});

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
                                    ozone: parseFloat(matches[5]),
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

                    modem.deleteAllSimMessages(() => {
                        console.log('Deleting Automatically');
                    });
                };

                processMessages();
                setInterval(processMessages, 1000);
            });
        });
        EOD;

        // Save the new JavaScript content to a file in the desired directory
        $newJsFilePath = public_path('run/' . $newJsFileName);
        File::put($newJsFilePath, $newJsContent);

        // Redirect back to admin management page with success message
        return redirect()->route('admin.management')->with('success', 'Device updated successfully!');
    }

    public function getDeviceCount()
    {
        $deviceCount = Device::count();
        return response()->json($deviceCount); // Return the count as JSON response
    }

    public function getDeviceLocation()
    {
        $deviceLocations = Device::all(['deviceName', 'latitude', 'longitude']);
        return response()->json($deviceLocations); // Return the count as JSON response
    }

    public function storeLocation(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'deviceId' => 'required|exists:devices,id',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Find the device by ID
        $device = Device::findOrFail($request->input('deviceId'));

        // Update latitude and longitude of the device
        $device->update([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('admin.management')->with('success', 'Location added successfully!');
    }

}
