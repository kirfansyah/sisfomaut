 
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-map"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SISFOMAUT</div>
      </a>

       

      <!-- Divider -->
      <hr class="sidebar-divider ">


      <!-- QUERY MENU -->

      <?php 
      $role_id = $this->session->userdata('role_id');
      $queryMenu = "SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` =  $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC 
                    ";
      $menu = $this->db->query($queryMenu)->result_array();
      
       
      ?>

      <!-- LOOPING MENU -->
      <?php foreach($menu as $m) : ?>
      <div class="sidebar-heading">
          <?php echo $m['menu']; ?> 
      </div>

      <!-- SIAPKAN SUB MENU SESUAI SUB MENU-->

      <?php 
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sub_menu`.`menu_id` = $menuId
                    AND `user_sub_menu`.`is_active` = 1";

        $subMenu = $this->db->query($querySubMenu)->result_array();

       ?>

       <?php foreach($subMenu as $sm) :?>
        <?php if($title == $sm['title']) : ?>
            <li class="nav-item active">
              <?php else : ?>
            <li class="nav-item">
              <?php endif; ?>
            <a class="nav-link pb-0" href="<?php echo base_url().$sm['url']?>">
              <i class="<?php echo $sm['icon']; ?>"></i>
              <span><?php echo $sm['title']; ?></span></a>
            </li>
       <?php endforeach; ?> 
       <!-- Divider -->
       <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>
      <!-- Nav Item - Dashboard -->      
      

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            
           
           <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user['name']; ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/profile/').$user['image']; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        

      

  
