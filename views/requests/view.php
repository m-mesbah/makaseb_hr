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


$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$sql = "SELECT * FROM `companies` ";
$result = $connectDb->select($conn, $sql);
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
                <li class="nav-item">
                    <p class="nav-link " style="cursor: pointer;">Add request</p>
                </li>
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


<div class="container">
    <div class="text-center">
        <h4 class="text-success">Requests</h4>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Request number</th>
                <th scope="col">Name</th>
                <th  scope="col"><button class="btn btn-success" id="show_request">Show</button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="col">Request number</td>
                <td scope="col">Name</td>
                <td scope="col">Code</td>
                <td scope="col">Company</td>
                <td scope="col">Department</td>
                <td scope="col">Request date</td>
                <td scope="col">Labtop</td>
                <td scope="col">Mouse and Pad </td>
                <td scope="col">Headset</td>
                <td scope="col">Lap stand</td>
                <td scope="col">Others</td>
                <td scope="col">Status</td>
                <td scope="col">Status Comment</td>
                <td scope="col">Specifications</td>
                <td scope="col">Ceo date</td>
                <td scope="col">Refused commint</td>
                <td scope="col">Accountant date</td>
                <td scope="col">Buy date</td>
                <td scope="col">Delevery date</td>
                <td scope="col">Contract pdf</td>
                <td scope="col">Serial number</td>
                <td scope="col">Action</td>
            </tr>

        </tbody>
    </table>
</div>


<?php require_once('../../includes/footer.php'); ?>