<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NexFund</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
  <!-- Main CSS File -->
  <link href="../css/main.css" rel="stylesheet">
  <style>
    .scroll-container {
      height: 100vh;
      overflow: hidden;
      position: relative;
    }

    .scroll-content {
      position: absolute;
      top: 100%;
      animation: scrollUp 10s linear infinite;
      width: 50%;

    }

    @keyframes scrollUp {
      0% {
        top: 100%;
      }

      100% {
        top: -100%;
      }
    }

    .scroll-container:hover .scroll-content {
      animation-play-state: paused;
    }
  </style>
</head>

<body class="fund-page">

  <?php include('header.php'); ?>

  <main class="main">

    <section class="about section">

      <div class="container">

        <div class="row">

          <div class="col-lg-12 content ngo-cont mt-5" style="min-height:100vh;">
            <div class="row">

              <div class="col-lg-12">
                <div class="scroll-container">
                  <div class="scroll-content">
                    <ul>
                      <!-- Notifications will be dynamically inserted here -->
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </section>
  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p>&copy; <span>Copyright</span> <strong class="px-1 sitename">NexFund</strong><span>All Rights Reserved</span></p>
    </div>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  
  <script>
    // Function to fetch and display notifications
    function fetchNotifications() {
      $.ajax({
        url: '../api/selectnotification.php',
        method: 'POST',
        contentType: 'application/json',
       
        success: function(response) {
          if (response.status === 200) {
            let notifications = response.data;
            let notificationHTML = '';

            // Loop through notifications and create HTML content
            notifications.forEach(function(notification) {
              notificationHTML += `
                          <li>
                            <p><b>${notification.title}</b><span class="float-end">${formatDate(notification.addedon)}</span></p>
                            <p>${notification.content}</p>
                          </li>`;
            });

            $('.scroll-content ul').html(notificationHTML);

          } else if (response.status === 404) {
            $('.scroll-content ul').html('<li>No new notifications.</li>');
          } else {
            console.error('Error fetching notifications:', response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('An error occurred:', error);
        }
      });
    }

    // Helper function to format the date
    function formatDate(dateString) {
      let date = new Date(dateString);
      return date.toLocaleDateString('en-GB'); // Format the date as DD/MM/YYYY
    }

    // Call the fetchNotifications function when the page loads
    $(document).ready(function() {
      fetchNotifications();
    });
  </script>


</body>

</html>