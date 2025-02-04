<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
    <img class="img-avatar" style="height: 50px; width: auto; margin-top: 5px; margin-bottom: 2px" src="uploads/img/Web Icon.png" alt="">
       <h2>Asset Management System</h2>
       <h4>Login To Continue...</h4>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group text-center">
              <button type="submit" class="btn btn-primary" style="border-radius:0%; color=#0369A3;">Login</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
