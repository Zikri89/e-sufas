<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $this->session->userdata('username'); ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <!-- Query Join table user_menu dan user_akses_menu -->
    <?php 
      $role_id = $this->session->userdata('role_id');
      $result = $this->db->query("SELECT * 
                                  FROM user_menu a JOIN user_akses_menu b 
                                    ON a.id_menu = b.menu_id 
                                 WHERE role_id = $role_id 
                              ORDER BY b.menu_id ASC ");
    ?>

    <!-- Looping nama menu di table user_menu -->
    <?php foreach ($result->result_array() as $menu): ?>
      <li class="header"><?= $menu['menu'] ?></li>
      
      <!-- Query Join table user_sub_menu dan user_menu -->
      <?php 
        $menuId = $menu['menu_id'];
      ?>

      <!-- Looping title menu di table user_sub_menu -->
      <?= multi_menu($menuId) ?>
    <?php endforeach; ?>
  </ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- <li class="treeview">
  <a href="#">
    <i class="fa fa-indent"></i> <span>Master Data</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><i class="fa fa-list-alt"></i> <span>M Data Level</span></a></li>
    <li><i class="fa fa-list-alt"></i> <span>M Data Kabupaten</span></a></li>
  </ul> 
</li> -->