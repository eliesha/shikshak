<?php 
require '../config/init.php';
require 'inc/header.php';
if (isset($_SESSION['session_token'])) {
  redirect('./dashboard', 'warning', 'You are logged in already, '.$_SESSION['full_name'].'. Please
  <a href="logout" style="color: red">logout</a> first!');
}
?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="process/login.php">
              <?php flash(); ?>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name="password" />
              </div>
              <div>
                <button class="btn submit" style="background: #DB4729; color: #fff">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> Shikshak </h1>
                  <p>© <?php echo date('Y') ?> All Rights Reserved. Shikshak Monthly Magazine. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        <?php require 'inc/footer.php' ?>