<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Asset Management System";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <link rel="Website Icon" type="png" href="uploads/img/Web Icon.png">
  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header" >
    <div class="header-content logo pull-left" style="background-color: #0369A3; height:65px; display: flex; justify-content: center; align-items: center;">
          <a class="navbar-brand brand-logo " href="admin.php" style="margin-bottom: 25px">
            <img class="img-avatar" style="height: 50px; width: auto; " src="uploads/img/Web Icon.png" alt="">
          </a>
      </div>
     
      <div class="header-content">
      <div class="header-date pull-left" style="color: black;">
          <strong>
             <?php 
               date_default_timezone_set('Africa/Nairobi'); // Set the timezone to EAT
               echo date("F j, Y, g:i a") . " EAT"; // Display the date and time with EAT label
               ?>
          </strong>
      </div>

          <!-- Centered Title -->
          <!--  <div class="header-content">
          <div style="text-align: center;">
            <strong style="color: black">MEDIA DEPARTMENT IMS</strong>
          </div>
          </div> -->

     <!-- Profile on the right -->
     <div class="pull-right clearfix" style="margin-bottom:50px;">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Profile
                  </a>
              </li>
             <li>
                 <a href="edit_account.php" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Settings
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Logout
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('user_menu.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
