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
// AuthController::gustAuth('../../index.php');
$_SESSION['page'] = 'home';

$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "makaseb_hr";


$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$sql = "SELECT 
requests.id as id,
requests.emp_name as emp_name,
status.title as title,
status.color as color
 FROM `requests` join `status` where requests.status = status.status  ";
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
                    <a class="nav-link  " href="../requests/requests.php">Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="../requests/view.php">View</a>
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


<div class="container">
    <div class="text-center mt-4">
        <h4 class="text-success">Requests</h4>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Request number</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td scope="col"><?php echo $row['id'] ?></td>
                    <td scope="col"><?php echo $row['emp_name'] ?></td>
                    <td scope="col" style="background-color: <?php echo $row['color'] ?> ; color:white;"><?php echo $row['title'] ?></td>
                    <td scope="col">
                        <button class="btn btn-success show_request" name="<?php echo $row['id'] ?>" onclick="show(<?php echo $row['id'] ?>, '<?php echo $row['title'] ?>')">Show</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Register Modal -->
<div class="modal  bg-dark " id="request_table" tabindex="-1" aria-labelledby="showLoginFormLabel" aria-hidden="true" style='display: none;'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showLoginFormLabel">Request </h5>
                <button onclick="show(0)" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody class="req_table">

                    </tbody>
                        <tr>
                            <th scope="col">Action</th>
                            <td scope="col" id="action"></td>
                        </tr>
                </table>
            </div>

        </div>
    </div>

</div>
<!-- Register Modal -->

<script>
    function show(id_, status_) {

        $('#request_table').fadeToggle();
        if (id_ != 0) {
            ajax_request(id_, status_)
        }

    }

    function ajax_request(id, status) {
        id_ = id;
        status_ = status;
        $.ajax({
            type: "get",
            url: "../../handlers/handelAjaxRequest.php",
            data: {
                status: status_,
                id: id_
            },
            dataType: "JSON",

            success: function(data) {
                $(".req_table").empty();
                $("#showLoginFormLabel").empty();
                $("#action").empty();
                $('#showLoginFormLabel').append(`Request # ${data.id}`)
                if(data.req_status == 0){
                    <?php if(@$_SESSION['group_id'] == '7' || @$_SESSION['group_id'] == '100'){?>
                    $('#action').append(`
                    <form action="../../handlers/handleAcceptRequest.php" class="text-center" method="get">
                        <textarea name="spcs" id="" cols="30" rows="10" placeholder="Add Specifications"></textarea>
                        <input type="text" name="id" value="${data.id}" hidden>
                        <input type="text" name="status" value="1" hidden>
                        <button type="submit" class="btn btn-success">Send To CEO</button>
                    </form>
                  
                    `)
                    <?php }?>
                }
                if(data.req_status == 1){
                    $('#action').append(`<h5  style='color:${data.color};' >Waiting CEO....</h5>
                    <?php if(@$_SESSION['group_id'] == '1' || @$_SESSION['group_id'] == '100'){?>
                        <a class='btn btn-success' href='../../views/handlers/handleAcceptRequest.php?id=${data.id}&status=3&date=<?php echo date('Y-m-d H:i:s');?>' >Accept</a>
                        <a class='btn btn-danger' href='../../views/requests/accept.php?id=${data.id}&status=2' >reject</a>
                    <?php }?>
                    
                    `)
                }
                if(data.req_status == 2){
                    $('#action').append(`<p  style='color:${data.color};' >REJECTED... check the Refused comment </p>`)
                   
                }
                if(data.req_status == 3){
                    $('#action').append(`<p  style='color:${data.color};' >Waiting for acc to put the date</p>`)
                    <?php if(@$_SESSION['group_id'] == '3' || @$_SESSION['group_id'] == '100'){?>
                    $('#action').append(`<a class='btn btn-success' href='../../views/requests/set_spics.php?id=${data.id}&status=1' >Set a Date</a>`)
                    <?php }?>
                }
                if(data.req_status == 4){
                    $('#action').append(`<p  style='color:${data.color};' >Waiting for  the date to get the mony (${data.acc_date}) </p>`)
                }
                if(data.req_status == 5){
                    $('#action').append(`<p  style='color:${data.color};' >Buying the devices....</p>`)
                }
                if(data.req_status == 6){
                    // set the serial number and upload contract pdf 
                    $('#action').append(`<p  style='color:${data.color};' >Buy devices at ${data.buy_date}  </p></br>
                    <?php if(@$_SESSION['group_id'] == '7' || @$_SESSION['group_id'] == '100'){?>
                        <a class='btn btn-success' href='../../views/requests/delever.php?id=${data.id}&status=7' >deliver the devices</a>
                    <?php }?>
                    `)
                }
                if(data.req_status == 7){
                    $('#action').append(`<p  style='color:${data.color};' >completed and delivered at (${data.del_date})</p>`)
                }
                $(".req_table").append(
                    `
            
                        <tr>
                            <th scope="col">Request number</th>
                            <td scope="col">${data.id}</td>
                        </tr>
                        <tr>
                            <th scope="col">Name</td>
                            <td scope="col">${data.emp_name}</td>
                        </tr>
                        <tr>
                            <th scope="col">Code</th>
                            <td scope="col">${data.emp_code}</td>
                        </tr>
                        <tr>
                            <th scope="col">Company</th>
                            <td scope="col">${data.com_name}</td>
                        </tr>
                        <tr>
                            <th scope="col">Department</th>
                            <td scope="col">${data.department}</td>
                        </tr>
                        <tr>
                            <th scope="col">Request date</th>
                            <td scope="col">${data.re_date}</td>
                        </tr>
                        <tr>
                            <th scope="col">Labtop</th>
                            <td scope="col">${data.labtop}</td>
                        </tr>
                        <tr>
                            <th scope="col">Mouse and Pad </th>
                            <td scope="col">${data.mouse_and_pad}</td>
                        </tr>
                        <tr>
                            <th scope="col">Headset</th>
                            <td scope="col">${data.headset}</td>
                        </tr>
                        <tr>
                            <th scope="col">Lap stand</th>
                            <td scope="col">${data.lap_stand}</td>
                        </tr>
                        <tr>
                            <th scope="col">Others</th>
                            <td scope="col">${data.others}</td>
                        </tr>
                        <tr >
                            <th scope="col">Status</th>
                            <td scope="col" style='background-color:${data.color};'><h5 class='text-white'>${data.title}</h5></td>
                        </tr>
                        <tr>
                            <th scope="col">Status Comment</th>
                            <td scope="col">${data.st_description}</td>
                        </tr>
                        <tr>
                            <th scope="col">Specifications</th>
                            <td scope="col">${data.spcs}</td>
                        </tr>
                        <tr>
                            <th scope="col">Ceo date</th>
                            <td scope="col">${data.ceo_app_date}</td>
                        </tr>
                        <tr>
                            <th scope="col">Refused comment</th>
                            <td scope="col">${data.st_comment}</td>
                        </tr>
                        <tr>
                            <th scope="col">Accountant date</th>
                            <td scope="col">${data.acc_date}</td>
                        </tr>
                        <tr>
                            <th scope="col">Buy date</th>
                            <td scope="col">${data.buy_date}</td>
                        </tr>
                        <tr>
                            <th scope="col">Delevery date</th>
                            <td scope="col">${data.del_date}</td>
                        </tr>
                        <tr>
                            <th scope="col">Contract pdf</th>
                            <td scope="col">${data.req_contract}</td>
                        </tr>
                        <tr>
                            <th scope="col">Serial number</th>
                            <td scope="col">${data.serial_num}</td>
                        </tr>
                       
                        `
                );


            },
        });
    }
</script>

<?php require_once('../../includes/footer.php'); ?>