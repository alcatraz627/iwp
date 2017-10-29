<?php
// Include the file containing the database connection code
require_once('include/header.php');

if(isset($_GET['logout'])) 
{
    session_unset();
    header("Location: index.php");
}

// Redirect the user to the login page if they are not logged in
if(isset($_SESSION['user'])) header('location: index.php');
?>
<div class="row text-center">
    <div class="col-sm-6 col-sm-push-3">
        <ul class="nav nav-tabs">
            <li class="<?php echo(isset($_GET['signup'])?'':'active')?>"><a data-toggle="tab" href="#login">Log In</a></li>
            <li class="<?php echo(isset($_GET['signup'])?'active':'')?>"><a data-toggle="tab" href="#signup">Sign Up</a></li>
        </ul>

        <div class="tab-content">
            <div id="login" class="tab-pane fade<?php echo(isset($_GET['signup'])?'':' in active')?>">
                <h3>Log In</h3>
                <p>Please enter your credentials</p>

                <form class="form-horizontal col-sm-10 col-sm-push-1" action="config/action.php" method="post" name="loginform">
                <input type="hidden" name="actiontype" value="login">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-push-2 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email address" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-push-2 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-push-1">
                            <button type="submit" class="btn btn-primary center-block btn-block btn-lg">Log In</button>
                        </div>
                    </div>
                </form>

            </div>
            <div id="signup" class="tab-pane fade<?php echo(isset($_GET['signup'])?' in active':'')?>">
                <h3>Sign Up</h3>
                <p>Please enter your credentials</p>

                <form class="form-horizontal col-sm-10 col-sm-push-1" action="config/action.php" method="post" name="signupform" onclick="validate()">
                <input type="hidden" name="actiontype" value="signup">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-push-2 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email address" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-push-2 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-push-2 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Enter Password Again" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-push-1">
                            <button type="submit" class="btn btn-success center-block btn-block btn-lg">Sign Up</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
function validate() {
    if($('#password').val() !== $('#confirmpassword').val())
    {
        alert('Passwords do not match');
        return false;
    }
    return true;        
}
</script>
<?php
// Include the file containing the database connection code
require_once('include/header.php');
?>
