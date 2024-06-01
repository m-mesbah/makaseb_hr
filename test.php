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


<tr>
    <th scope="col">Request number</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Name</td>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Code</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Company</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Department</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Request date</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Labtop</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Mouse and Pad </th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Headset</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Lap stand</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Others</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Status</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Status Comment</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Specifications</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Ceo date</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Refused commint</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Accountant date</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Buy date</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Delevery date</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Contract pdf</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Serial number</th>
    <td scope="col">9897</td>
</tr>
<tr>
    <th scope="col">Action</th>
    <td scope="col">9897</td>
</tr>


<form action="../../handlers/handleAcceptRequest.php" class="text-center" method="get">
    <textarea name="spcs" cols="30" rows="10" placeholder="Add Specifications"></textarea>
    <input type="text" name="id" value="" hidden>
    <input type="text" name="status" value="" hidden>
    <button type="submit" class="btn btn-success">Send To CEO</button>
</form>