<div class="container loginbody">
<?php $attributes = array('class' => 'form-group', 'id' => 'signinform');
echo form_open(base_url().'login/submit', $attributes); ?>
  <div class="text-center mb-4">
    <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Election Commission</h1>
    <p><img src="<?php echo base_url(); ?>assets/image/symbole.png" class="img-fluid"/></p>
  </div>
  <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <?php echo form_input('uname','', 'required class="form-control" id="inputEmail" placeholder="User Name"'); ?>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <?php echo form_password('psword','', 'required class="form-control" id="inputPassword" placeholder="Password"'); ?>
  </div>
    <br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitButton">Sign in</button>
  <a class="btn btn-block btn-secondary btn-small" href="<?php echo base_url(); ?>">Cancel</a>
  <p class="mt-5 mb-3 text-muted text-center">&copy; <?php echo Date('Y'); ?></p>
<?php echo form_close(); ?>
</div>   




