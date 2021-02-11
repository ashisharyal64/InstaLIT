<?php
session_start();
// if no user is logged in
if(!isset($_SESSION['user']))
{
    session_destroy();
    header("Location:login.php");
}
// get user id from session
$user_id = $_SESSION['user'];


//check if the user has profile or not
require_once 'libraries/classes/Database.php';
$connect = new Database();
$userData = $connect->select("SELECT `user_details`.*, `users`.`email` from `user_details` INNER JOIN `users` on `user_details`.`user_id` = `users`.`id` WHERE `user_details`.`user_id` = ?",'i', [$user_id]);
?>


<?php include("libraries/includes/header.php"); ?>
<form method="post" action="libraries/engine/userActions.php" enctype="multipart/form-data">
    <div class="profile-container">
        <div class="main-body">
            <div class="row gutters-sm">    

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img class="rounded-circle mt-5" width="150px"
                                        src="<?php if(!empty($userData))  { echo "/images/users/$user_id/profile/$user_id.jpg" ;} else  { echo "/images/ui/default_user.png"; } ?>">
                                <span class="font-weight-bold"><?php if(!empty($userData)){ echo $userData[0]['name']; } ?></span>
                                <span class="text-black-50"><?php if(!empty($userData)){ echo $userData[0]['website']; } ?></span>
                            </div>
                            <div class="d-flex flex-column align-items-center text-center" id="img-section"> <b>Profile Photo</b>
                                <p>Accepted  type .png. Less than 1MB</p>
                                <input class="btn btn-primary profile-button" type="file" name="profile">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 py-1">
                                    <label class="labels">Name</label>
                                    <input type="text"  name="name" class="form-control" placeholder="Full Name" value="<?php if(!empty($userData)){ echo $userData[0]['name']; } ?>">
                                </div>
                                <div class="col-md-12 py-1">
                                    <label class="labels">Bio</label>
                                    <textarea name="bio" type="text" class="form-control"> <?php if(!empty($userData)){ echo $userData[0]['bio']; } ?></textarea>
                                </div>
                            </div>
                            <div class="row mt12">
                                <div class="col-md-12 py-1">
                                    <label class="labels">Website</label>
                                    <input name="website" type="text" class="form-control" placeholder="website" value="<?php if(!empty($userData)){ echo $userData[0]['website']; } ?>">
                                </div>
                                <div class="col-md-12 py-1">
                                    <label class="labels">Gender</label>
                                    <input name="gender" type="text" class="form-control" placeholder="Gender" value="<?php if(!empty($userData)){ echo $userData[0]['gender']; } ?>">
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <input type="submit" name ="action" class="btn btn-primary profile-button" value="<?php if(!empty($userData)){ echo "Save Profile"; } else{ echo "Create Profile";} ?>">
                            </div>
                        </div>
                    </div>             
                    <div class="row gutters-sm">
                        <div class="col-sm-12 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <h4 class="text-right">Change Password</h4>
                                    </div>
                                    <div class="row mt12">
                                        <div class="col-md-12">
                                            <label class="labels">Enter your new password here</label>
                                            <input name="password" type="password" class="form-control" placeholder="Password" value="">
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <input name="action" class="btn btn-primary profile-button" type="submit" value="Save Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</form>



<?php include_once("libraries/includes/footer.php"); ?>


        