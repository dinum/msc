    <div class="row">

      <div class="col-lg-3">
          <h1 class="my-4 text-center"><img src="<?php echo base_url(); ?>assets/image/symbole.png" class="img-fluid"/></h1>
        
        <!--<ul class="nav flex-column flex-nowrap overflow-hidden">
                <li class="nav-item">
                    <a class="nav-link text-truncate" href="#"><i class="fa fa-home"></i> <span class="d-none d-sm-inline">Overview</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa fa-table"></i> <span class="d-none d-sm-inline">Reports</span></a>
                    <div class="collapse" id="submenu1" aria-expanded="false">
                        <ul class="flex-column pl-2 nav">
                            <li class="nav-item"><a class="nav-link py-0" href="#"><span>Orders</span></a></li>
                            <li class="nav-item">
                                <a class="nav-link collapsed py-1" href="#submenu1sub1" data-toggle="collapse" data-target="#submenu1sub1"><span>Customers</span></a>
                                <div class="collapse" id="submenu1sub1" aria-expanded="false">
                                    <ul class="flex-column nav pl-4">
                                        <li class="nav-item">
                                            <a class="nav-link p-1" href="#">
                                                <i class="fa fa-fw fa-clock-o"></i> Daily </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-1" href="#">
                                                <i class="fa fa-fw fa-dashboard"></i> Dashboard </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-1" href="#">
                                                <i class="fa fa-fw fa-bar-chart"></i> Charts </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-1" href="#">
                                                <i class="fa fa-fw fa-compass"></i> Areas </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link text-truncate" href="#"><i class="fa fa-bar-chart"></i> <span class="d-none d-sm-inline">Analytics</span></a></li>
                <li class="nav-item"><a class="nav-link text-truncate" href="#"><i class="fa fa-download"></i> <span class="d-none d-sm-inline">Export</span></a></li>
            </ul>-->
        <ul class="nav flex-column flex-nowrap overflow-hidden">            
            <li class="nav-item">
                <a class="nav-link text-truncate" href="<?php echo base_url(); ?>elections"><span><i class="fa fa-bars"></i>&nbsp;&nbsp;Elections</span></a>
            </li>
            <?php if ($this->session->userdata('user_logged')) { ?>
                <?php if (array_search('add_users', $permissions) || array_search('view_users', $permissions) || array_search('update_users', $permissions)) { ?>
                    <li class="nav-item"><a class="nav-link text-truncate" href="<?php echo base_url(); ?>users"><span><i class="fa fa-user"></i>&nbsp;&nbsp;Users</span></a></li>
                <?php } ?>    
                <?php if (array_search('add_roles', $permissions) || array_search('view_roles', $permissions) || array_search('update_roles', $permissions)) { ?>
                     <li class="nav-item"><a class="nav-link text-truncate" href="<?php echo base_url(); ?>roles"><span><i class="fa fa-level-up"></i>&nbsp;&nbsp;Roles</span></a></li>
                <?php } ?>
                <?php if (array_search('add_permissions', $permissions) || array_search('view_permissions', $permissions) || array_search('update_permissions', $permissions)) { ?>     
                     <li class="nav-item"><a class="nav-link text-truncate" href="<?php echo base_url(); ?>permissions"><span><i class="fa fa-lock"></i>&nbsp;&nbsp;Permissions</span></a></li>
                <?php } ?>     
            <?php } ?>
        </ul>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">