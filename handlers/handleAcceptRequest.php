<?php
session_start();
require_once('../controllers/AuthController.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');
$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";
$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$date = date('Y-m-d H:i:s');
$sql = "UPDATE `requests` SET `set_spcs_dat` = '".$date."', `status` = '".$_GET['status']."', `spcs` = '".$_GET['spcs']."' WHERE `requests`.`id` = '".$_GET['id']."'";
if(@$_GET['status'] == '2' )$sql = "UPDATE `requests` SET `ceo_app_date` = '".$date."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
if(@$_GET['status'] == '3' )$sql = "UPDATE `requests` SET `st_comment` = '".$_GET['st_comment']."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
if(@$_GET['status'] == '6' )$sql = "UPDATE `requests` SET `buy_date` = '".$date."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
if(@$_POST['status'] == '7' ){
    $contract = $_FILES["contract"];
    $contractName = $contract["name"];
    $contractName = uniqid() . time() . $contract["name"];
    $tmpName = $contract["tmp_name"];
    move_uploaded_file($tmpName, "../assets/contracts/$contractName");
    $sql = "UPDATE `requests` SET `del_date` = '".$date."', `status` = '".$_POST['status']."', `serial_num` = '".$_POST['serial_num']."', `contract` = '".$contractName."' WHERE `requests`.`id` = '".$_POST['id']."'";
}
$result = $connectDb->select($conn, $sql);
$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request now handed to CEO wait until he accept it</p>';
if(@$_GET['status'] == '2' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request Rejected</p>';
if(@$_GET['status'] == '3' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request accepted</p>';
if(@$_GET['status'] == '6' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request accepted</p>';
header('location: ../views/requests/view.php');
?>
