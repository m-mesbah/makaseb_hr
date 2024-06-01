<?php
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
// AuthController::gustAuth('../index.php');
$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";


$_REQUEST['id']= rand();
if (isset($_REQUEST['labtop'])) $_REQUEST['labtop'] = 'yes';
if (isset($_REQUEST['mouse_and_pad'])) $_REQUEST['mouse_and_pad'] = 'yes';
if (isset($_REQUEST['headset'])) $_REQUEST['headset'] = 'yes';
if (isset($_REQUEST['lap_stand'])) $_REQUEST['lap_stand'] = 'yes';

$department = DataHandlingController::handleData('department', 'Department is require');
$department = DataValidationController::testInput($department);


$com_name = DataHandlingController::handleData('com_name', 'Company name is require');
$com_name = DataValidationController::testInput($com_name);


$emp_code = DataHandlingController::handleData('emp_code', 'Employee code  is require');
$emp_code = DataValidationController::testInput($emp_code);

$emp_name = DataHandlingController::handleData('emp_name', 'Employee name  is require');
$emp_name = DataValidationController::testInput($emp_name);

if (!preg_match("/^[a-zA-Z-' ]*$/", $emp_name)) {
  array_push(DataHandlingController::$errs, "Invalid Employee name format");
}
//if there an error during handling inputs or validation  it will return errors to ajax 
if (!empty(DataHandlingController::$errs)) {
  echo (json_encode(DataHandlingController::$errs));
  die();
}

$fields = [];
$values = [];
foreach ($_REQUEST as $input => $value) {
  array_push($fields, $input);
  array_push($values, $value);
}
//connecting to database
$connectDb = new ConnectDb($servername, $username, $password, $dbname);

$conn = $connectDb->connectdb();
$connectDb->insert_row('requests', $fields, $values);
$request_number = $conn->insert_id;

##################################
####### sending any email ########
##################################

//set mail reciver and sender
$url = "http://localhost/task/handlers/handleActiveEmail.php";
$from_mail_header = 'm.mesbah@4tel.sa';
$from_mail = 'Requests';
$userEmailheader = '4tel.sa';
$mail_body = "<html><h1 >There is a request sent </h1></br> open the dashbord to accept it and request from a manager to check it</html>";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request';

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'it@it.sa';
$msg = 'The request was sent wait until it proved , your request number is: ' . $request_number . '';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email($mail, $msg);


##################################
####### sending any email ########
##################################


die();
