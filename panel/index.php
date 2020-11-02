<?php
session_start();
include_once('services/Pages.php');

if(isset($_POST['path'])) {
    $GLOBALS['currentPath']['path'] = $_POST['path'];
} elseif (isset($_SESSION['last_path']))  {
    $GLOBALS['currentPath']['path'] = $_SESSION['last_path'];
} else {
    $GLOBALS['currentPath']['path'] = $pages[0]->path;
}

$_SESSION['last_path'] = $GLOBALS['currentPath']['path'];

searchPage($pages);

function searchPage($pages) {
    foreach ($pages as $page) :
        if($page instanceof PageReferenceComposite) {
            searchPage($page->subMenu);
        } else {
           if($page->path ===  $GLOBALS['currentPath']['path']) {
               $GLOBALS['currentPath']['title'] = $page->title;
               $GLOBALS['currentPath']['dir'] = dirname($page->path);
           }
        }
    endforeach;
}

$index_location = dirname(substr_replace($_SERVER['PHP_SELF'], 'localhost', 0, 0));

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Sistem Informasi Desa</title>
    <link rel="stylesheet" href="../dependencies/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dependencies/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../dependencies/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../dependencies/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../dependencies/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="../dependencies/plugins/jquery/jquery.min.js"></script>
    <script src="../dependencies/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../dependencies/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../dependencies/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dependencies/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dependencies/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../dependencies/dist/js/adminlte.min.js"></script>
</head>

<?php
function printSideBarMenu($pages)
{
    foreach ($pages as $page) :
        if ($page instanceof PageReferenceComposite) {
?>
            <li class="nav-item has-treeview menu-open">
                <a href="" class="nav-link <?= isActive($page->subMenu) ? 'active' : '' ?>">
                    <i class="<?= $page->icon ?>"></i>
                    <p>
                        <?= $page->title ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
<?php
            printSideBarMenu($page->subMenu);
            echo '</ul></li>';
        } else {
            $id_selector = 'f' . str_replace(' ', '', $page->title);
            $active = $page->path === $GLOBALS['currentPath']['path'];
?>
            <li class="nav-item">
                <a href="#" class="nav-link <?= $active ? 'active' : '' ?>"
                   onclick="document.querySelector('#<?= $id_selector ?>').submit();">
                    <form action="" method="POST" id="<?= $id_selector ?>" style="display: none;">
                        <input type="hidden" name="path" value="<?= $page->path ?>">
                    </form>
                    <i class="<?= $page->icon ?>"></i>
                    <p><?= $page->title ?></p>
                </a>
            </li>
<?php
        }
    endforeach;
}
?>
<?php
    function isActive($pages) {
        foreach($pages as $page) :
            if($page instanceof PageReferenceComposite) {
                return isActive($page->subMenu);
            }  else {
                if ($page->path === $GLOBALS['currentPath']['path']) {
                    return true;
                }
            }
        endforeach;
    }
?>


<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- User Account Menu -->
            <li class="nav-item dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="" class="dropdown-toggle nav-link text-primary" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <i class="user-image fas fa-user-circle"></i>
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="list-group">
                        <a href="" class="list-group-item list-group-item-action">Ganti Sandi</a>
                        <a href="" class="list-group-item list-group-item-action text-danger">Logout</a>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="." class="brand-link">
            <img src="assets/images/logo-jatim.png" alt="Logo Provinsi Jawa Timur"
                 class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">Desa Sugihwaras</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                    <?php
                    printSideBarMenu($pages);
                    ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?= $GLOBALS['currentPath']['title'] ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="."><?= ucwords(str_replace('-', ' ', $GLOBALS['currentPath']['dir'])) ?></a></li>
                            <?php
                            if($GLOBALS['currentPath']['title'] != 'Dashboard') {
                                echo "<li class=\"breadcrumb-item active\">{$GLOBALS['currentPath']['title']}</li>";
                            }
                            ?>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?php
                include($GLOBALS['currentPath']['path'])
                ?>
                <script>
                    window.history.replaceState({}, document.title, "" + "");
                </script>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.main-content -->

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Sistem Informasi Desa</strong><br>
        Dibuat dengan ❤️+ 🥴 + 🤪 untuk memenuhi praktek industri
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->
<script>
</script>
</body>

</html>