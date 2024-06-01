<?php 



function JeraCurl($data){
    
    // URL to post the JSON data to
    $url = 'http://portal.exacall.com:3080';

    // Initialize cURL
    $curl = curl_init($url);

    // Set the necessary cURL options
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($curl);
        // Handle the error accordingly
        return $error;
    } else {
        // Handle the response
        return $response;
    }

    // Close the cURL handle
    curl_close($curl);
}
function JeraGetvolume($jera_id, $currency = true){
    // JSON data to be posted
    $data = '{
        "jsonrpc": "2.0",
        "id": 2,
        "method": "clients.subscriptions.deactivate",
        "params": {
            "AUTH": "texthere",
            "id": '.$jera_id.'
        }
    }';

    $data = '{
        "jsonrpc": "2.0",
        "id": 2,
        "method": "clients.total_volume.get",
        "params": {
            "AUTH": "texthere",
            "id": '.$jera_id.'
        }
    }';


    $data = '{
        "jsonrpc": "2.0",
        "id": 2,
        "method": "clients.volume.get",
        "params": {
            "AUTH": "texthere",
            "id": '.$jera_id.'
        }
    }';

    $exec = JeraCurl($data);
    $response = json_decode($exec, true);
    print_r($response);
}



?>

<table class="table">
        <thead>
            <tr>
                <th scope="col">Request number</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Company</th>
                <th scope="col">Department</th>
                <th scope="col">Request date</th>
                <th scope="col">Labtop</th>
                <th scope="col">Mouse and Pad </th>
                <th scope="col">Headset</th>
                <th scope="col">Lap stand</th>
                <th scope="col">Others</th>
                <th scope="col">Status</th>
                <th scope="col">Status Comment</th>
                <th scope="col">Specifications</th>
                <th scope="col">Ceo date</th>
                <th scope="col">Refused commint</th>
                <th scope="col">Accountant date</th>
                <th scope="col">Buy date</th>
                <th scope="col">Delevery date</th>
                <th scope="col">Contract pdf</th>
                <th scope="col">Serial number</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="col">Request number</td>
                <td scope="col">Name</td>
                <td scope="col">Code</td>
                <td scope="col">Company</td>
                <td scope="col">Department</td>
                <td scope="col">Request date</td>
                <td scope="col">Labtop</td>
                <td scope="col">Mouse and Pad </td>
                <td scope="col">Headset</td>
                <td scope="col">Lap stand</td>
                <td scope="col">Others</td>
                <td scope="col">Status</td>
                <td scope="col">Status Comment</td>
                <td scope="col">Specifications</td>
                <td scope="col">Ceo date</td>
                <td scope="col">Refused commint</td>
                <td scope="col">Accountant date</td>
                <td scope="col">Buy date</td>
                <td scope="col">Delevery date</td>
                <td scope="col">Contract pdf</td>
                <td scope="col">Serial number</td>
                <td scope="col">Action</td>
            </tr>

        </tbody>
    </table>