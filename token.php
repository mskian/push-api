<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('X-Robots-Tag: noindex, nofollow', true);

require 'config.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$msg['message'] = '';
$user_id = '';
$user_token = '';

if(isset($_POST['userid']) && isset($_POST['token'])){
    if(!empty($_POST['userid']) && !empty($_POST['token'])){
        $user_id = $_POST['userid'];
        $user_token = $_POST['token'];
        $insert_query = "INSERT INTO tokens (userid,token) VALUES (:userid,:token) ON DUPLICATE KEY UPDATE userid= :userid, token= :token";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindValue(':userid', htmlspecialchars(strip_tags($user_id)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':token', htmlspecialchars(strip_tags($user_token)),PDO::PARAM_STR);

        if($insert_stmt->execute()){
            $msg['message'] = 'Data Inserted Successfully';
        }else{
            $msg['message'] = 'Data not Inserted';
        } 
        
    }else{
        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}
else{
    $msg['message'] = 'Please fill all the fields';
}
echo  json_encode($msg);

?>