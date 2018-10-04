<div class="top_nav">
  <div class="nav_menu">
    <nav class="" role="navigation">

      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo site_url('home') ?>">Monitor</a></li>
      <li><a href="<?php echo site_url('report/manage_audit_plan')?>">Report</a></li>
      <li><a href="#contact">Device</a></li>

    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src=<?php echo $sess_image;?> alt=""><?php echo $sess_name; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <?php if($sess_position != "Admin") : ?>
            <li><a href=<?php echo site_url('setting/account')?>> Account</a></li>
              <li><a href=<?php echo site_url('help/manage_help')?> target="_blank">Help</a></li>
            <?php endif ?>
            <li><a href="<?php echo site_url(); ?>.home/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>


          <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-red"><?php// echo $inc_approved ?></span>
            </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a href="<?php echo base_url()."report/manage_audit_plan/"; ?>">
                      <span class="image"><img src="<?php echo site_url().'assets/images/Hermawan-Syahrul.png'?>" alt="Profile Image" /></span>
                      <span>
                        <span>Administration</span>
                        <span class="time"><?php// echo $temp_date_approved_topnav ?></span>
                      </span>
                    </span>
                      <span class="message">
                    </a>
                  </li>

                <li>
                  <div class="text-center">
                    <a href="<?php echo base_url()."report/manage_audit_plan/"; ?>">
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
          </li>


      </ul>
    </nav>
  </div>
</div>
