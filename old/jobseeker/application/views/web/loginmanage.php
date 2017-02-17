<?php $this->load->view('web/header'); ?>

    <div class="container">
        <div style="width:400px;margin:0 auto;">
            <form class="form-signin" method="post" action="<?php echo base_url('manage/cekLogin'); ?>">
              <h2 class="form-signin-heading">Please sign in</h2>
              <label for="inputUsername" class="sr-only">Username or Email Address</label>
              <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username or Email Address" required autofocus>
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>    
    </div>

<?php $this->load->view('web/footer'); ?>
