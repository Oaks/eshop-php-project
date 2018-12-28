  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible text-center">
      <?=$_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <form action="<?='/admin/user/login-admin'?>" method="post">
      <div class="form-group has-feedback">
        <input name="login" type="text" class="form-control" placeholder="Login">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
