<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Web Tools Installer</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="notifier">

    </div>
    <div class="wrapper shadow">
        <div class="branding">
            <img src="./logo.png" alt="" srcset="">
        </div>
        <div class="section-1">
            <div class="header">
                <h1>Welcome to AWT Installer!</h1>
            </div>
            <div class="actions">
                <p>Here we will guide you through installation process.</p>
                <p>This installer will automatically download and install <br>newest version of AWT.</p>
                <p>Lets begin!</p>
                <div class="buttons">
                    <button onclick="beginDownload('.section-1', '.section-2')">Next</button>
                </div>
            </div>
        </div>
        <div class="section-2 hidden">
            <div class="header">
                <h1>But first...</h1>
            </div>
            <div class="actions">
                <p>Lets setup a database</p>

                <input type="text" placeholder="Hostname" class="db-host" />
                <input type="text" placeholder="Username" class="db-user" />
                <input type="text" placeholder="Password" class="db-password" />
                <input type="text" placeholder="Database name" class="db-name" />

                <div class="buttons">
                    <button onclick="replaceSection('.section-2', '.section-1')">Previous</button>
                    <button onclick="testDatabase('.section-2', '.section-3')">Next</button>
                </div>
            </div>
        </div>
        <div class="section-3 hidden">
            <div class="header">
                <h1>Lets enter your info now!</h1>
            </div>
            <div class="actions">

                <input type="text" placeholder="Website name" class="website_name" />
                <input type="email" placeholder="Your email address" class="website_contact" />

                <div class="buttons">
                    <button onclick="replaceSection('.section-3', '.section-2')">Previous</button>
                    <button onclick="setInfo('.section-3', '.section-4')">Next</button>
                </div>
            </div>
        </div>
        <div class="section-4 hidden">
            <div class="header">
                <h1>Lets create an Admin Account for you!</h1>
            </div>
            <div class="actions">
                <input type="text" placeholder="Firstname" class="admin_firstname" />
                <input type="text" placeholder="Lastname" class="admin_lastname" />
                <input type="text" placeholder="Username" class="admin_username" />
                <input type="email" placeholder="Email" class="admin_email">
                <input type="password" placeholder="Password" class="admin_password" />

                <div class="buttons">
                    <button onclick="replaceSection('.section-4', '.section-3')">Previous</button>
                    <button onclick="createAccount('.section-4', '.section-5')">Next</button>
                </div>
            </div>
        </div>

        <div class="section-5 hidden">
        <div class="header">
                <h1>One last thing...</h1>

                <p>If your website is installed under specific directory please write it below.</p>
                <p>You can determine this by looking at URL of this installer.</p>
                <p>If you see a pattern like this "https://yoursite.com/[something]/".<br> There is a chance that you installed AWT in some directory.</p>
                <p>Default value is "/".</p>

            </div>
            <div class="actions">
                <input type="text" placeholder="Path to site directory" class="path_to_dir" value="/"/>
                <div class="buttons">
                    <button onclick="replaceSection('.section-5', '.section-4')">Previous</button>
                    <button onclick="editPath('.section-5', '.section-6');">Next</button>
                </div>
            </div>
        </div>


        <div class="section-6 hidden">
            <div class="header">
                <img src="./circle-check-regular.svg" width="100px"
                    style="filter: invert(38%) sepia(85%) saturate(1638%) hue-rotate(92deg) brightness(104%) contrast(109%);">
                <p>Thank you for installing Advanced Web Tools CMS!</p>
                <p>You can access the dashboard by clicking <a href="./awt-admin/">here</a>.</p>
                <p>To see your website click refresh.</p>
            </div>
            <div class="actions">
                <div class="buttons">
                    <button onclick="location.reload(true);">Refresh</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>

    var regexSimpleEmail = /@/;

    function validateEmail(email_val, emailRegex) {
        if (emailRegex.test(email_val)) {
            return true;
        }
        else {
            return false;
        }
    }

    function replaceSection(oldSection, newSection) {
        $(newSection).removeClass("hidden");
        $(oldSection).addClass("hidden");
    }

    function createAccount(oldSection, newSection) {
        var fname = $(".admin_firstname").val();
        var lname = $(".admin_lastname").val();
        var name = $(".admin_username").val();
        var email = $(".admin_email").val();
        var password = $(".admin_password").val();
        var dbHost = $(".db-host").val();
        var dbUser = $(".db-user").val();
        var dbPass = $(".db-password").val();
        var dbName = $(".db-name").val();

        if (!validateEmail(email, regexSimpleEmail)) {
            $(".notifier").html("<img src='circle-xmark-regular.svg'><p>Email address must be valid!</p>");
            setTimeout(() => {
                $(".notifier").html(" ");
            }, 5000);
            return;
        }

        if (fname === "" || lname === "" || name === "" || email === "" || password === "" || dbHost === "" || dbUser === "" || dbName === "") {
            $(".notifier").html("<img src='circle-xmark-regular.svg'><p>All fields are requried!</p>");
            setTimeout(() => {
                $(".notifier").html(" ");
            }, 5000);
            return;
        }

        var data = {
            fname: fname,
            lname: lname,
            username: name,
            email: email,
            password: password,
            dbHost: dbHost,
            dbUser: dbUser,
            dbPass: dbPass,
            dbName: dbName,
            create_acc: "1"
        };


        $.ajax({
            url: "./installer.php",
            type: "POST",
            data: data,
            success: function (response) {

                console.log(response);
                if (response == 'OK') {
                    replaceSection(oldSection, newSection);
                }
            },
            error: function (xhr, status, error) {
                $(".notifier").html("<img src='triangle-exclamation-solid.svg'><p>An error has occured while communicating with backend. See console log for more.</p>");
                console.log(response);
                setTimeout(() => {
                    $(".notifier").html(" ");
                }, 5000);
                console.error("Error:", error);
            }
        });
    }


    function editPath(oldSection, newSection) {
        var path = $(".path_to_dir").val();
        var dbHost = $(".db-host").val();
        var dbUser = $(".db-user").val();
        var dbPass = $(".db-password").val();
        var dbName = $(".db-name").val();


        var data = {
            dbHost: dbHost,
            dbUser: dbUser,
            dbPass: dbPass,
            dbName: dbName,
            edit_path: path
        };


        $.ajax({
            url: "./installer.php",
            type: "POST",
            data: data,
            success: function (response) {

                console.log(response);
                if (response == 'OK') {
                    replaceSection(oldSection, newSection);
                }
            },
            error: function (xhr, status, error) {
                $(".notifier").html("<img src='triangle-exclamation-solid.svg'><p>An error has occured while communicating with backend. See console log for more.</p>");
                console.log(response);
                setTimeout(() => {
                    $(".notifier").html(" ");
                }, 5000);
                console.error("Error:", error);
            }
        });
    }

    function setInfo(oldSection, newSection) {
        var name = $(".website_name").val();
        var contact = $(".website_contact").val();
        $('.admin_email').val(contact);

        if (!validateEmail(contact, regexSimpleEmail)) {
            $(".notifier").html("<img src='circle-xmark-regular.svg'><p>Email address must be valid!</p>");
            setTimeout(() => {
                $(".notifier").html(" ");
            }, 5000);
            return;
        }

        if (name === "" || contact === "") {
            $(".notifier").html("<img src='circle-xmark-regular.svg'><p>All fields are requried!</p>");
            setTimeout(() => {
                $(".notifier").html(" ");
            }, 5000);

            return;
        }

        var data = {
            web_name: name,
            web_contact: contact,
            set_info: "1"
        };

        $.ajax({
            url: "./installer.php",
            type: "POST",
            data: data,
            success: function (response) {
                // Request completed successfully
                // You can handle the response here if needed
                console.log(response);
                if (response == 'OK') {
                    replaceSection(oldSection, newSection);
                }
            },
            error: function (xhr, status, error) {
                $(".notifier").html("<img src='triangle-exclamation-solid.svg'><p>An error has occured while communicating with backend. See console log for more.</p>");
                console.log(response);
                setTimeout(() => {
                    $(".notifier").html(" ");
                }, 5000);
                console.error("Error:", error);

            }
        });

        // If you need to replace the section, you can call the function here

    }


    function testDatabase(oldSection, newSection) {
        var dbHost = $(".db-host").val();
        var dbUser = $(".db-user").val();
        var dbPass = $(".db-password").val();
        var dbName = $(".db-name").val();

        // Set up the data to be sent as key-value pairs
        var data = {
            dbHost: dbHost,
            dbUser: dbUser,
            dbPass: dbPass,
            dbName: dbName,
            test_database: "1" // You can add more data if needed
        };

        // Send the POST request using jQuery
        $.ajax({
            url: "./installer.php",
            type: "POST",
            data: data,
            success: function (response, status) {
                // Request completed successfully
                // You can handle the response here if needed
                console.log(response);
                if (response == 'OK') {
                    replaceSection(oldSection, newSection);
                } else {
                    $(".notifier").html("<img src='triangle-exclamation-solid.svg'><p>An error has occured while connecting to database. See console log for more.</p>");
                    console.log(response);
                    setTimeout(() => {
                        $(".notifier").html(" ");
                    }, 5000);
                }
            },
            error: function (xhr, status, error) {
                $(".notifier").html("<img src='triangle-exclamation-solid.svg'><p>An error has occured while communicating with backend. See console log for more.</p>");
                console.log(response);
                setTimeout(() => {
                    $(".notifier").html(" ");
                }, 5000);
                console.error("Error:", error);
            }
        });


    }


    function beginDownload(oldSection, newSection) {

        var data = {
            download: "1"
        };

        $(".notifier").html("<img src='download-solid.svg' style='filter: invert(43%) sepia(25%) saturate(2988%) hue-rotate(150deg) brightness(104%) contrast(101%);'><p>Downloading latest version of AWT...</p>");

        $.ajax({
            url: "./installer.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response == 'OK') {
                    replaceSection(oldSection, newSection);
                    $(".notifier").html("<img src='circle-check-regular.svg' style='filter: invert(38%) sepia(85%) saturate(1638%) hue-rotate(92deg) brightness(104%) contrast(109%);'><p>Download was succesfull!</p>");
                    console.log(response);
                    setTimeout(() => {
                        $(".notifier").html(" ");
                    }, 5000);
                } else {
                    $(".notifier").html("<img src='circle-xmark-regular.svg'><p>Failed to download latest version of AWT.</p>");
                    console.log(response);
                    setTimeout(() => {
                        $(".notifier").html(" ");
                    }, 5000);
                }
            },
            error: function (xhr, status, error) {
                // Request failed
                console.error("Error:", error);
                $(".notifier").html("<img src='circle-xmark-regular.svg'><p>Failed to download latest version of AWT.</p>");
                console.log(response);
                setTimeout(() => {
                    $(".notifier").html(" ");
                }, 5000);
            }
        });
    }


</script>