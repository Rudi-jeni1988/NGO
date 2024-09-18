<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="home.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">NexFund</h1>
      </a>

      <nav id="navmenu" class="navmenu d-flex">
        <ul>
          <li><a href="home.php" class="<?= $currentPage == 'home.php' ? 'active' : '' ?>">Home</a></li>
          <li><a href="funds.php" class="<?= $currentPage == 'funds.php' ? 'active' : '' ?>">Funds</a></li>
          <li><a href="document.php" class="<?= $currentPage == 'document.php' ? 'active' : '' ?>">Documents</a></li>
          <li><a href="notification.php" class="<?= $currentPage == 'notification.php' ? 'active' : '' ?>">Notification</a></li>
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        <ul>
            <li class="dropdown"><a href="#"><img src="../img/admin-icon.png" width="40" class="rounded-pill border"></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="../index.php">Logout</a></li>
            </ul>
          </li> 
        </ul>
      </nav>


    </div>
  </header>