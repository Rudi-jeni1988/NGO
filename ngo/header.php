<?php
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="home.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">NexFund</h1>
      </a>

      <nav id="navmenu" class="navmenu d-flex">
        <ul>
          <li class="nav-item <?= ($activePage == 'home') ? 'active':''; ?>"><a href="home.php">Home</a></li>
          <li class="nav-item <?= ($activePage == 'funds') ? 'active':''; ?>"><a href="funds.php">Funds</a></li>
          <li class="nav-item <?= ($activePage == 'document') ? 'active':''; ?>"><a href="document.php">Documents</a></li>
          <li class="nav-item <?= ($activePage == 'notification') ? 'active':''; ?>"><a href="notification.php">Notification</a></li>
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        <ul>
            <li class="dropdown"><a href="#"><img src="../img/profile.png" width="40" class="rounded-pill border"></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="../index.php">Logout</a></li>
            </ul>
          </li> 
        </ul>
      </nav>

    </div>
  </header>