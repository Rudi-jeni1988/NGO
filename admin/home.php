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
</head>

<body class="fund-page">

  <?php include('header.php'); ?>

  <main class="main">

    <section class="about section">

      <div class="container">

        <div class="row">

          <div class="col-lg-12 content ngo-cont mt-5" style="min-height:100vh;">
            <div class="row">

              <div class="col-lg-6 trust-registration">
                <h3 class="mt-5">Trust Registration</h3>
                <ul></ul>
              </div>

              <div class="col-lg-6 ngo-registration">
                <h3 class="mt-5">NGO Registration</h3>
                <ul></ul>
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
    $(document).ready(function() {
      // Fetch all data (Trust and NGO registrations together)
      $.ajax({
        url: '../api/select_users.php', // Change to your API URL
        method: 'POST',
        contentType: 'application/json',
        success: function(response) {
          if (response.status === 200) {
            // Clear previous data
            $('.trust-registration ul').empty();
            $('.ngo-registration ul').empty();

            // Loop through each record and filter based on the role
            $.each(response.data, function(index, record) {
              let listItem = `
                            <li>
                                <p><b>${record.organization_name}</b></p>
                                <p>${record.uin}</p>
                                <p>${record.date}</p>
                                <p>${record.role}</p>
                                <p class="float-end text-end">
                                    <a href="#" class="btn btn-danger me-2 reject-btn" data-id="${record.user_id}">Reject</a>
                                    <a href="#" class="btn btn-success approve-btn" data-id="${record.user_id}">Approve</a>
                                </p><br>
                            </li>
                        `;

              // Append to the appropriate section
              if (record.role === "Trust") {
                $('.trust-registration ul').append(listItem);
              } else if (record.role === "NGO") {
                $('.ngo-registration ul').append(listItem);
              }
            });

            // Using function Handle Approve button click
            $('.approve-btn').on('click', function(event) {
              event.preventDefault();
              let userId = $(this).data('id');
              updateUserStatus(userId, "approve");
            });

            // Using function Handle Reject button click 
            $('.reject-btn').on('click', function(event) {
              event.preventDefault();
              let userId = $(this).data('id');
              updateUserStatus(userId, "reject");
            });
          } else {
            alert(response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          alert('Something went wrong while fetching registrations.');
        }
      });
    });
  </script>

  <script>
    function updateUserStatus(userId, action) {
      $.ajax({
        url: '../api/update_user_status.php', // Change to your API URL
        method: 'POST',
        data: JSON.stringify({
          id: userId,
          status: action
        }),
        contentType: 'application/json',
        success: function(response) {
          if (response.status === 200) {
            alert(response.message); // Success message
            // Optionally, you can refresh the list or hide the updated entry
            location.reload(); // Reload the page to reflect changes
          } else {
            alert(response.message); // Error or failure message
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          alert('Something went wrong while updating user status.');
        }
      });
    }
  </script>

</body>
</html>