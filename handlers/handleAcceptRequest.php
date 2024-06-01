<?php
session_start();
require_once('../controllers/AuthController.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');

$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$date = date('Y-m-d H:i:s');
$sql = "UPDATE `requests` SET `ceo_app_date` = ".$date.", `status` = ".$_GET['status'].", `spcs` = ".$_GET['spcs']." WHERE `requests`.`id` = ".$_GET['id']."";
$result = $connectDb->select($conn, $sql);
$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request now handed to CEO wait until he accept it</p>';
header('location: ../views/requests/view.php');
?>

<p class="py-3 mt-3 text-whit"></p>