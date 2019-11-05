<!-- Sidebar  -->

<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>

<?php 
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
        <strong>AP</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>">
            <a href="home.php">
                <i class="fas fa-home"></i>
                Home
            </a>
        </li>
        <li class="<?= ($activePage == 'manage-menu' || $activePage == 'manage-food-category') ? 'active':''; ?>">
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-hamburger"></i>
                Menu
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li class="<?= ($activePage == 'manage-food-category') ? 'active':''; ?>">
                    <a href="manage-food-category.php">Manage category</a>
                </li>
                <li class="<?= ($activePage == 'manage-menu') ? 'active':''; ?>">
                    <a href="manage-menu.php">Manage product</a>
                </li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'manage-table') ? 'active':''; ?>">
            <a href="manage-table.php">
                <i class="fas fa-table"></i>
                Manage Table
            </a>
        </li>
        <li class="<?= ($activePage == 'manage-transactions') ? 'active':''; ?>">
            <a href="manage-transactions.php">
                <i class="fas fa-utensils"></i>
                Manage Transactions
            </a>
        </li>
        <li class="<?= ($activePage == 'reservation') ? 'active':''; ?>">
            <a href="#">
                <i class="fas fa-utensils"></i>
                Reserve Table
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-donate"></i>
                Financial
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-chart-line"></i>
                Analytics
            </a>
        </li>
    </ul>

</nav>
