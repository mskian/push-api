<?php

require ('read.php');

define( 'API_ACCESS_KEY', '<CLOUD SERVER API KEY>' );

$tokens = json_encode($data);
$token = json_decode($tokens, true);
$user_title = '';
$user_message = '';

if(isset($_GET['title']) && isset($_GET['body'])){
  if(!empty($_GET['title']) && !empty($_GET['body'])){

    $user_title = htmlspecialchars($_GET['title'], ENT_COMPAT);
    $user_message = htmlspecialchars($_GET['body'], ENT_COMPAT);

    $data = [
            "registration_ids" => $token,
            "notification" => [
            "title" => $user_title, 
            "body" => $user_message, 
            "icon" => "https://example.com/assets/icons/Icon-48.png",
              ]
            ];

    $data_string = json_encode($data);
    $url = "https://fcm.googleapis.com/fcm/send";
    $headers = [
     'Authorization: key=' . API_ACCESS_KEY,
     'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url);                                                              
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
    $result = curl_exec($ch);
    curl_close ($ch);
    echo json_encode($result);

} else {
    $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    echo json_encode($msg);
  }
} else {
$msg['message'] = 'Please fill all the fields';
echo json_encode($msg);
}

?>