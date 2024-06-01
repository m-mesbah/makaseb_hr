
<?php 
require_once('../../controllers/AuthController.php');
require_once('../../includes/header.php');

//if the user logged in it will redirect him to dashboard
AuthController::userAuth('../dashboard');

//access token which came from like that sent to email
$userEmail = @$_GET['userEmail'] ?? null;
?>



<div class="container">

    <div class="text-center mt-5">
        <h5 class="modal-title" >Aactivate your email</h5>
    </div>
    <div class="modal-body">

    <!-- reset password form -->
        <form id="activeEmail" class="text-center" action="../../handlers/activeEmail.php" method="POST"  >
            <div id="resetPassErrs" class="form-text bg-danger text-white"></div>
            <div id="successMsg" class="form-text bg-success text-white text-center"></div>
    
            <div class="mb-3">
              <input type="text" hidden name="email"  value="<?php echo($userEmail)?>" class="form-control" aria-describedby="emailHelp">
            </div>
            <button type="submit" id="" class="btn btn-success px-5 submit_btn">Active</button>
        </form>
    </div>
</div>

<?php 

require_once('../../includes/footer.php');



?>