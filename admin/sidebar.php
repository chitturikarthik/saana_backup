<?php
// session_start();
//session_start(); // Start the session
if (!isset($_SESSION['access'])) {
    header("Location:index.php");
    exit(); // Make sure to exit after redirection
}

// Logout logic
if (isset($_GET['logout'])) {
    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: index.php");
    exit(); // Make sure to exit after redirection
}

?>
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            <b style="color:white;">OPERATIONS</b>
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li class="nav-active">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a class="nav-link" href="total_alumni.php">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span>Manage Alumni</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a class="nav-link" href="payments.php">
                            <i class="fas fa-credit-card" aria-hidden="true"></i>
                            <!-- <i class="fa-solid fa-money-check-dollar"></i> -->
                            <span>Payments</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a class="nav-link" href="events.php">
                            <i class="fas fa-image" aria-hidden="true"></i>
                            <span>Manage Events</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a class="nav-link" href="?logout=1">
                            <i class="fas fa-power-off"></i><span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>


    </div>

</aside>