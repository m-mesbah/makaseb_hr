

<?php

session_start();
require_once('./controllers/AuthController.php');
require_once('./includes/header.php');
require_once('./controllers/DBController.php');
require_once("./vendor/autoload.php");
require_once("./includes/fun.php");
AuthController::userAuth('./views/dashboard');

$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";

$connectDb= new ConnectDb($servername,$username,$password,$dbname);
$conn=$connectDb->connectdb();
//testing if the email is exist !! if exist return err
$sql = "SELECT * FROM `companies` ";
$result = $connectDb->select($conn,$sql);

?>


    
     

    <main >

        <div class="container">
            <div class="text-center mt-5">
                <h2 class="text-dark">Welcom to <span class="text-primary ">Makaseb</span></h2>
            </div>
            <div id="successMsg" class="form-text bg-success text-white text-center"></div>

            <form class="my-2" id='loginForm' action="./handlers/handleLogin.php" method="post" >
                <div id="loginErrs" class="form-text bg-danger text-white"></div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="text" name="userEmailLogin" id="userEmailLogin"  class="form-control" aria-describedby="emailHelp">
                    <div id="emailErr" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" name="userPasswordLogin" id="userPasswordLogin"  class="form-control" >
                    <div id="passwordErr" class="form-text text-danger"></div>

                </div>
                
                <button id="submit" id='' class="btn btn-primary d-inline mr-4 submit_btn">Login</button>
                <p class="text-primary text-decoration-none cursor-pointer mx-4 d-inline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#showRegisterForm">forget your password?</p>

                
            </form>

            <!-- Button trigger Register modal -->
            <button class=" btn btn-success text-white text-decoration-none px-5 mt-3"  data-bs-toggle="modal" data-bs-target="#showLoginForm" id=''>Register</button>
            <!-- Button trigger Register modal -->

        </div>




        <!-- Register Modal -->
        <div class="modal fade" id="showLoginForm" tabindex="-1" aria-labelledby="showLoginFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showLoginFormLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registerForm" action="./handlers//handleRegister.php" method="POST" >
 
                        <div id="Errs" class="form-text bg-danger text-white"></div>
                        <div id="" class="form-text bg-success text-white text-center successMsg"></div>

                            <div class="mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" name="userName"  class="form-control"  aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email address</label>
                                <input type="text" name="userEmail"  class="form-control" aria-describedby="emailHelp">
                                <div id="emailErr" class="form-text text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Password</label>
                                <input type="password" name="userPassword"  class="form-control" >
                                <div id="passwordErr" class="form-text text-danger"></div>

                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Company</label>
                                <select class="form-control" name="company" id="userPassword">
                                    <?php 
                                    while($row = $result->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['com_name'] ?></option>
                                    <?php 
                                    }?>
                                </select>
                                <div id="company" class="form-text text-danger"></div>

                            </div>
                            
                            <button type="submit" class="btn btn-primary submit_btn" id="regiser">Register</button>
                        </form> 
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Register Modal -->


        <!-- forget password modal -->
        <div class="modal fade" id="showRegisterForm" tabindex="-1" aria-labelledby="showRegisterFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showRegisterFormLabel">Reset your password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm" action="./handlers/handleLogin.php" method="POST"  >
                    <div id="resetPassErrs" class="form-text bg-danger text-white"></div>
                    <div id="successMsg" class="form-text bg-success text-white text-center"></div>

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email address</label>
                            <input type="email" name="email"  class="form-control" aria-describedby="emailHelp">
                            <div id="emailErr" class="form-text text-danger"></div>
                        </div>
                        <button type="submit"  class="btn btn-primary submit_btn">Reset Password</button>
                    </form>
                </div>
                
                
                </div>
            </div>
        </div>
        <!-- forget password modal -->
    </main>

<?php 

require_once('./includes/footer.php');



?>