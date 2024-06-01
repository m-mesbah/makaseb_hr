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


$connect = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connect->connectdb();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <div id="">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  active" href="../dashboard/">Requirments</a>
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
                    <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none  " href="../Profile">Profile</a></p>
                    <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none btn btn-danger" href="../../handlers/handleLogout.php">Log Out</a></p>
                </ul>
            </div>
        </div>

    </div>

</nav>

<div class="text-center mt-5 text-success">
    <h1>Welcome <?php echo @$_SESSION['userName'] ?> To makaseb Hr system</h1>
</div>

<div class=" dflex justify-content-center row  mt-5">
        <a href="../requests/view.php" class="btn btn-success col-md-6 col-lg-3 m-2 py-2"> Show requests</a>

        <a href="../requests/requests.php" class="btn btn-success col-md-6 col-lg-3 m-2 py-2"> Add requests</a>
</div>

<?php require_once('../../includes/footer.php'); ?>