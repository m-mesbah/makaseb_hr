<?php
session_start();

require_once('../../controllers/AuthController.php');
require_once('../../HijriDateLib/hijri.class.php');
require_once('../../controllers/DataHandlingController.php');
require_once('../../controllers/DataValidationController.php');
require_once('../../controllers/DBController.php');
require_once '../../vendor/autoload.php';
require_once("../../includes/fun.php");
require_once('../../includes/header.php');
AuthController::gustAuth('../../index.php');

$_SESSION['page'] = 'home';



$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";


$connectDb= new ConnectDb($servername,$username,$password,$dbname);
$conn=$connectDb->connectdb();
$sql = "SELECT * FROM `companies` ";
$result = $connectDb->select($conn,$sql);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <div id="">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  " href="../dashboard/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="../requests/requests.php">Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="../requests/view.php">View</a>
                </li>

            </ul>

        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               
            </ul>
            <div class="mb-md-2">
                <button id="dropdown-btn" class="text-white btn btn-success position-relative  "><?php echo @$_SESSION['userName'] ?? 'settings' ?></button>
                <ul class="bg-white p-2 position-absolute mt-2" style="display: none; padding-left: 15px;" id="dropdown">
                    <!-- <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none  " href="../Profile">Profile</a></p> -->
                    <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none btn btn-danger" href="../../handlers/handleLogout.php">Log Out</a></p>
                </ul>
            </div>
        </div>

    </div>

</nav>


<div class="container">
            <div class="text-center mt-5">
                <h2 class="text-dark">Send request to <span class="text-primary ">IT</span></h2>
            </div>
            <div id="successMsg" class="form-text bg-success text-white text-center successMsg"></div>

            <form class="my-2" id='request' action="../../handlers/handleRequest.php" method="post" >
                <div id="requestErrs" class="form-text bg-danger text-white requestErrs"></div>
                <div class="mb-3">
                    <input type="text" require name="emp_name" id="emp_name" placeholder="Your Name" class="form-control" aria-describedby="emailHelp">
                    <div id="emp_name" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <input type="number" require name="emp_code" id="emp_code" placeholder="Your Code" class="form-control" >
                    <div id="emp_code" class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <select name="com_name" id="com_name" class="form-control">
                    <option value="" disabled selected>Select your company</option>
                        <?php 
                        while($row = $result->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['com_name'] ?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" require name="department" id="department" placeholder="Your Department"  class="form-control" >
                    <div id="department" class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="labtop" class="form-label"> 
                        <input type="checkbox" name="labtop" id="labtop"  class="" > Labtop
                    </label>
                    <div id="labtop" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="mouse_and_pad" class="form-label">
                        <input type="checkbox" name="mouse_and_pad" id="mouse_and_pad"  class="" > Mouse and Pad 
                    </label>
                    <div id="mouse_and_pad" class="form-text text-danger"></div>

                </div>
                <div class="mb-3">
                    <label for="headset" class="form-label"> 
                        <input type="checkbox" name="headset" id="headset"  class="" >  Headset
                    </label>
                    <div id="headset" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="lap_stand" class="form-label"> 
                        <input type="checkbox" name="lap_stand" id="lap_stand"  class="" > Laptop stand
                    </label>
                    <div id="lap_stand" class="form-text text-danger"></div>

                </div>
               
                <div class="mb-3">
                    <input type="text" name="others" id="others" placeholder="Others..." class="form-control" >
                    <div id="others" class="form-text text-danger"></div>

                </div>
                
                <button id="submit" id='' class="btn btn-primary d-inline mr-4 submit_btn">Requst</button>
                
            </form>

        </div>


<?php require_once('../../includes/footer.php'); ?>