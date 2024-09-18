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

        <section class="about section pt-4">

            <div class="container">

                <div class="row">

                    <div class="col-lg-6 ps-4 offset-md-3">
                        <div class="row">
                            <h3>Essential Document</h3>
                            <div class="quick-access">
                                <form id="uploadForm" enctype="multipart/form-data">
                                    <div class="w-100">
                                        <h4>Progress Report</h4>
                                        <p>Includes achievements, challenges, and how funds were utilized to achieve the project's goals.</p>
                                        <p>
                                            <input type="file" id="real-file" name="file" hidden="hidden" />
                                            <button type="button" id="custom-button">Upload</button>
                                            <span id="custom-text">No file chosen, yet.</span>
                                        </p>
                                    </div>
                                    <div style="text-align:center;">
                                        <button type="submit" id="submit-btn">Submit</button>
                                    </div>
                                   
                                </form>

                                <script>
                                   

                                    // Display selected file name
                                    document.getElementById("real-file").addEventListener("change", function() {
                                        const file = document.getElementById("real-file").files[0];
                                        if (file) {
                                            document.getElementById("custom-text").innerHTML = file.name;
                                        }
                                    });

                                    // Handle form submission
                                    document.getElementById("uploadForm").addEventListener("submit", function(e) {
                                        e.preventDefault(); // Prevent default form submission

                                        const file = document.getElementById("real-file").files[0];
                                        if (!file) {
                                            alert("Please select a file to upload.");
                                            return;
                                        }

                                        let formData = new FormData();
                                        formData.append("file", file); // Only the file is appended, no trust_id

                                        // AJAX request to send the file to the server
                                        let xhr = new XMLHttpRequest();
                                        xhr.open("POST", "../api/upload_progress_doc.php", true);

                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                const response = JSON.parse(xhr.responseText);
                                                if (response.status === true) {
                                                    alert("File uploaded successfully!");
                                                    location.reload();
                                                } else {
                                                    alert("File upload failed: " + response.msg);
                                                    location.reload();
                                                }
                                            } else {
                                                alert("Error during the file upload process.");
                                                location.reload();
                                            }
                                        };

                                        xhr.send(formData);
                                    });
                                </script>



                                <!-- <div class="w-100">
                            <h4>Bank Account Statement</h4>
                            <p>Must cover the period since the last fund release, including deposits and expenditures.</p>
                            <p>
                                <input type="file" id="real-file" hidden="hidden" />
                                <button type="button" id="custom-button">Upload</button>
                                <span id="custom-text"></span>
                            </p>
                        </div> -->
                                <!-- <div class="w-100">
                            <h4>Utilization Certificate (UC)</h4>
                            <p>Should include a statement of expenditure and the balance remaining.</p>
                            <p>
                                <input type="file" id="real-file" hidden="hidden" />
                                <button type="button" id="custom-button">Upload</button>
                                <span id="custom-text"></span>
                            </p>
                        </div> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="quick-access p-0 border-0 bg-transparent">
                                <div class="w-100">
                                    <h4 class="mt-3">Track Status</h4>
                                    <!-- <p>
                                <button type="button" id="custom-button"> Verification</button>
                            </p>
                            <p>
                                <button type="button" id="custom-button">Submit New Documents</button>
                            </p> -->
                                    <p>
                                        <a href="viewdoc.php"><button type="button" id="custom-button">View Documents</button></a>

                                    </p>
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
</body>

</html>