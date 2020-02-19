<div class="card card-outline-secondary my-4">
    <div class="card-header">
        Verify User
    </div>
    <div class="card-body">
        <p>Please Enter your Password</p>
        <?php echo form_open(base_url() . 'home/verify_user', array('class' => 'form-group', 'id' => 'form-id')); ?>
            <?php echo (isset($msg)&&!empty($msg))?'<div class="form-group">'.$msg.'</div>':'';  ?>
        <div class="form-group">
            <input type="hidden" value="<?php echo $url; ?>" name="backurl" />
            <?php echo form_password('psword', '', 'required class="form-control" id="inputPassword" placeholder="Password"'); ?>
        </div>
                <hr>
                <input type="submit" class="btn btn-success" name="verify" value="Verify">

        <?php echo form_close(); ?>
    </div>
</div>
