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
        .about h3 {
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .quick-access h4 {
            font-size: 20px;
            font-weight: 600;
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

                       
                        <div class="row rejected-funds">
                        <h3 class="mt-5">Document's</h3>
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
    <!-- Main JS File -->
    <script src="../js/main.js"></script>
    <script>
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");

        customBtn.addEventListener("click", function() {
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function() {
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(
                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                )[1];
            } else {
                customTxt.innerHTML = "No file chosen, yet.";
            }
        });
    </script>

    <!-- All Document list based on user session -->
    <script>
        $(document).ready(function() {
            // AJAX request to fetch rejected funds
            $.ajax({
                url: '../api/selectall_progress_doc.php', // API endpoint for fetching rejected proposals
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200) {
                        // Clear the existing list
                        const rejectedFundsContainer = $('.rejected-funds');
                        rejectedFundsContainer.empty();

                        // Loop through each rejected fund
                        response.data.forEach(function(item) {
                            const listItem = `
                            <div class="col-lg-6">
                                <ul>
                        <li>
                            <p><b>${item.trust_name}</b><span class="open-btn float-end"><a href="../progressdoc/${item.doc_name}" class="text-white" target="_blank">View</a></span></p>
                            <p>${item.uin}</p>
                            <p>${new Date(item.date).toLocaleDateString()}</p>
                            <p>${item.mobno}</p>
                             <p>Trust</p>
                           
                        </li>
                        </ul>
                        </div>`;

                            // Append the rejected fund item to the list
                            rejectedFundsContainer.append(listItem);
                        });
                    } else {
                        // Display a message if no rejected funds are found
                        $('.rejected-funds').html('<li>No rejected funds found.</li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('.rejected-funds').html('<li>There was an error loading the data.</li>');
                }
            });
        });
    </script>
</body>

</html>