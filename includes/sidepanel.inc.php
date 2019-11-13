<!-- Sidebar  -->
<?php 
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>FoodSmith</h3>
        <strong>AP</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= ($activePage == 'index') ? 'active':''; ?>">
            <a href="index.php">
                <i class="fas fa-home"></i>
                Home
            </a>
        </li>
        <li class="<?= ($activePage == 'foodordercart') ? 'active':''; ?>">
            <a href="foodordercart.php">
                <i class="fas fa-utensils"></i>
                Menu
            </a>
        </li>
        <li class="<?= ($activePage == 'tablelisting') ? 'active':''; ?>">
            <a href="tablelisting.php">
                <i class="fas fa-cash-register"></i>
                Payment
            </a>
        </li>
        <li class="<?= ($activePage == 'kitcheninbox2') ? 'active':''; ?>">
            <a href="kitcheninbox2.php">
                <i class="fas fa-hamburger"></i>
                Kitchen
            </a>
        </li>
    </ul>

</nav>
