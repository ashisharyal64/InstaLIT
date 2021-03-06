

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Font Awesome Script -->
    <script src="https://kit.fontawesome.com/1f88de1726.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="libraries/css/style.css">
    <link rel="stylesheet" href="libraries/css/login.css">
    

    <title>InstaLIT</title>
</head>
<body>

<?php
  $links = array(
    'index' => [
      'name'    => 'Home',
      'classes' => 'fas fa-home',
    ],
    'profile' => [
      'name'    => 'My Page',
      'classes' => 'fas fa-address-card',
    ],
    'editprofile' => [
      'name'    => 'Settings',
      'classes' => 'fas fa-cog',
    ],
  );
?>

<!-- START navigation -->
  <nav>
    <div class="nav-container">
      <div class="nav-left">
        <a href="index.php">
          <img src="images/ui/logoXL.png" alt="">
        </a>
      </div>

      <div class="spacer"></div>

      <div class="searchbar">
        <form action="/results.php" method="post">
          <input type="text" placeholder="Search" name="keyword">
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <div class="spacer"></div>

      <div class="nav-links">
        <ul class="nav-right no-bullets">
          <?php foreach($links as $link_key => $link_value){ 
            if( isset($_SESSION["user"]) && ( $link_key === 'signup' || $link_key === 'login' ) ){
              // do nothing
            } else { ?>
              <li>
                <a href="<?= $link_key; ?>.php" title="<?= $link_value['name']; ?>">
                  <i class="<?= $link_value['classes']; ?>"></i>
                </a>
              </li>
            <?php } ?>
          <?php } ?>
        
          <div class="dropdownleft">
            <div class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar">
                <img src="images/ui/default_user.png" alt="">
              </div>
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <?php foreach($links as $link_key => $link_value){ 
                if( isset($_SESSION["user"]) && ( $link_key === 'signup' || $link_key === 'login' ) ){ 
                  // do nothing
                } else { ?>
                  <button class="dropdown-item" type="button"><i class="<?= $link_value['classes']; ?>"></i>
                    <a class="profile-links" href="<?= $link_key; ?>.php">
                      <?= $link_value['name']; ?>
                    </a></button>
                <?php } ?>
              <?php } ?>
              
              <hr class="hr-margin" style="width:100%;">
              <button class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i>
                <a class="profile-links" href="libraries/engine/auth.php?action=logout">Sign out</a></button>
            </div>
          </div>
      
      </div>
    </div>
  </nav>
<!-- END nagivation -->