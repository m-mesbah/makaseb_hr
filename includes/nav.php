<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        
        <div class="container">
            <a class="navbar-brand" href="./">Reuirments</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                </ul>
                <div class="mb-md-2">
                <button id="dropdown-btn" class="text-white btn btn-success position-relative  " ><?php echo @$_SESSION['userName'] ?? 'settings' ?></button>
              <ul class="bg-white p-2 position-absolute mt-2" style="display: none; padding-left: 15px;" id="dropdown">
                <!-- <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none  " href="../Profile"  >Profile</a></p> -->
                <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none btn btn-danger" href="../../handlers/handleLogout.php" >Log Out</a></p>
              </ul>
                    <!-- <li class="nav-item">
                        <a class="nav-link " href="../Profile"  >Profile</a>
                    </li> -->
                    <!-- <a href="../../handlers/handleLogout.php" class="btn btn-outline-success">Log Out</a> -->
                </div>
            </div>
           
        </div>
        
    </nav>