<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('X-Robots-Tag: noindex, nofollow', true);

require_once 'config.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();
$data = '';

 $query = "SELECT * FROM tokens";
 $stmt = $conn->prepare($query);
 $stmt->execute();
 $data = array();
 if($stmt->execute()){
 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row['token'];
 }
}
//if(!empty($data)){
   // echo json_encode($data);
//} else {
 //echo 'error';
//}

?>