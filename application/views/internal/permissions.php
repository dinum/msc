<div class="card card-outline-secondary my-4">
    <div class="card-header">
        <h4 class="pull-left">Permissions</h4><a href="<?php echo base_url(); ?>permissions/add" class="btn btn-info btn-small pull-right" ><i class="fa fa-plus"></i>&nbsp;Add Permission</a>
    </div>      
    <div class="card-body">
        <?php echo (isset($msg)&&!empty($msg))?$msg:'';  ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($datas as $data){ ?>
            <li class="list-group-item"><?php echo $data->permission; ?><?php if($data->special_permission==1){ ?>
                    <span class="badge badge-pill badge-warning">S</span>
                <?php } ?></li>
            <?php } ?>
        </ul>
    </div>
</div>