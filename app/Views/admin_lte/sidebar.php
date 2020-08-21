<?php
$user = user();
$userid = user_id();
$logged_in = logged_in();
$username = $user->username;


$group_admin = array("1");
$group_sub_admin = array("1");
$user_group  = in_groups($group_admin);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-collapse">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link text-sm ">
        <img src="<?= base_url('dist/img/boxed-bg.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Harmoni</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="http://harmoni.ddns.net/office/assets/dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $username; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php
                $db      = \Config\Database::connect();
                $builder = $db->table('menu');

                if ($user_group) {
                    $menu = $builder->orderBy('role_id', 'ASC')->getWhere(array('parent_id' => 0, 'active' => 1));
                } else {
                    $menu = $builder->getWhere(array('parent_id' => 0, 'active' => 1, 'role_id' => $group_admin));
                }
                foreach ($menu->getResult() as $m) {
                    // chek ada sub menu
                    if ($user_group) {
                        $submenu = $builder->getWhere(array('parent_id' => $m->id, 'active' => 1));
                    } else {
                        $submenu = $builder->getWhere(array('parent_id' => $m->id, 'active' => 1, 'role_id' => $group_admin));
                    }

                    if (count($submenu->getResult()) > 0) {
                        // tampilkan submenu
                        echo '<li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa ' . $m->icon . '"></i>
                            <p>
                            ' . strtoupper($m->name) . '
                                <i class="right fa fa-chevron-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">';
                        foreach ($submenu->getResult() as $s) {
                            echo '<li class="nav-item">
                            <a href="' . base_url($s->link) . '" class="nav-link">
                                <i class="far ' . $s->icon . ' nav-icon"></i>
                                <p>' . strtoupper($s->name) . '</p>
                            </a>
                        </li>';
                        }
                        echo "</ul></li>";
                    } else {
                        echo '<li class="nav-item">
                        <a href="' . base_url($m->link) . '" class="nav-link">
                            <i class="far ' . $m->icon . ' nav-icon"></i>
                            <p>' . strtoupper($m->name) . '</p>
                        </a>
                    </li>';
                    }
                }
                ?>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->