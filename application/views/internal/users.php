<div class="card card-outline-secondary my-4">
    <div class="card-header">
        <h4 class="pull-left">Users</h4><a href="<?php echo base_url(); ?>users/add" class="btn btn-info btn-small pull-right" ><i class="fa fa-plus"></i>&nbsp;Add User</a>
    </div>      
    <div class="card-body">
        <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($datas as $data){ ?>
            <li class="list-group-item"><?php echo $data->name; ?> ( <?php echo $data->email; ?> )</li>
            <?php } ?>
        </ul>
    </div>
</div>