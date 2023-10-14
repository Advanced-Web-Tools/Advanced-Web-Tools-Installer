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
    <div class="wrapper">

        <div class="section-1">
            <div class="header">
                <h1>Welcome to AWT Installer!</h1>
            </div>
            <div class="actions">
                <p>Here we will guide you through install process.</p>
                <p>Lets begin!</p>
                <button onclick="replaceSection('.section-1', '.section-2')">Next</button>
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
                <input type="email" placeholder="Your contact" class="website_contact" />

                <div class="buttons">
                    <button onclick="replaceSection('.section-3', '.section-2')">Previous</button>
                    <button onclick="setInfo('.section-3', '.section-4')">Next</button>
                </div>
            </div>
        </div>
        <div class="section-4 hidden">
            <div class="header">
                <h1>Lets create first Admin account!</h1>
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
    </div>
</body>

</html>

<script>

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
            },
            error: function (xhr, status, error) {

                console.error("Error:", error);
            }
        });

        replaceSection(oldSection, newSection);
    }

    function setInfo(oldSection, newSection) {
        var name = $(".website_name").val();
        var contact = $(".website_contact").val();
        $('.admin_email').val(contact);

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
            },
            error: function (xhr, status, error) {
                // Request failed
                console.error("Error:", error);
            }
        });

        // If you need to replace the section, you can call the function here
        replaceSection(oldSection, newSection);
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
            success: function (response) {
                // Request completed successfully
                // You can handle the response here if needed
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Request failed
                console.error("Error:", error);
            }
        });

        // If you need to replace the section, you can call the function here
        replaceSection(oldSection, newSection);
    }


</script>