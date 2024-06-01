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