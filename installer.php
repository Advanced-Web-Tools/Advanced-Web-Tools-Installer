<?php

// $opDir = __DIR__.DIRECTORY_SEPARATOR."testing".DIRECTORY_SEPARATOR;

$opDir = __DIR__.DIRECTORY_SEPARATOR;

if (isset($_POST['test_database'])) {
    $db_host = $_POST['dbHost'];
    $db_user = $_POST['dbUser'];
    $db_pass = $_POST['dbPass'];
    $db_name = $_POST['dbName'];

    try {
        $mysql = new \mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($mysql->connect_error == null) {
            $unzip = new ZipArchive();
            $res = $unzip->open(__DIR__.DIRECTORY_SEPARATOR.'installer.zip');

            if ($res === TRUE) {
                $unzip->extractTo($opDir);
                $unzip->close();

                $db_config_file = $opDir."awt-src".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."database".DIRECTORY_SEPARATOR."databaseConfig.class.php";

                $key = hash("SHA512", time());

                readFileReplaceLine($db_config_file, 'private static string $hostname = "";', 'private static string $hostname = "'.$db_host.'";');
                readFileReplaceLine($db_config_file, 'private static string $database = "";', 'private static string $database = "'.$db_name.'";');
                readFileReplaceLine($db_config_file, 'private static string $username = "";', 'private static string $username = "'.$db_user.'";');
                readFileReplaceLine($db_config_file, 'private static string $password = "";', 'private static string $password = "'.$db_pass.'";');
                readFileReplaceLine($db_config_file, 'private static string $key = "";', 'private static string $key = "'.$key.'";');

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                $sql = file_get_contents('database-awt.sql');

                $conn->multi_query($sql);

                echo json_encode("OK");
            } else {
                echo json_encode("FAIL");
            }
        } else {
            echo json_encode("FAIL");
        }
    } catch (Exception $e) {
        echo json_encode("FAIL");
    }
}

if(isset($_POST['set_info'])) {
    $name = $_POST["web_name"];
    $contact = $_POST["web_contact"];

    $config_file = $opDir."awt-config.php";

    readFileReplaceLine($config_file, 'define("WEB_NAME", "");', 'define("WEB_NAME", "'.$name.'");');
    readFileReplaceLine($config_file, 'define("CONTACT_EMAIL", "");', 'define("CONTACT_EMAIL", "'.$contact.'");');
    readFileReplaceLine($config_file, 'define("AWT_VERSION", "");', 'define("AWT_VERSION", "23.7a");');

}

if(isset($_POST["create_acc"])) {
    $db_host = $_POST['dbHost'];
    $db_user = $_POST['dbUser'];
    $db_pass = $_POST['dbPass'];
    $db_name = $_POST['dbName'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash("SHA512", $password);
    $email = $_POST["email"];

    $token = hash("SHA512", $password . time());

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $conn->query("INSERT INTO `awt_admin`(`email`, `username`, `firstname`, `lastname`, `last_logged_ip`, `password`, `token`, `permission_level`) VALUES
    ('$email','$username','$fname','$lname','127.0.0.1','$password','$token','0')");

    clean();
}


function readFileReplaceLine(string $file, string $old_content, string $new_content) {
    $lines = file($file);

    foreach($lines as $line => $content) {
        if(str_contains($content, $old_content)) {
            $lines[$line] = $new_content . PHP_EOL;
        }
    }

    file_put_contents($file, implode("", $lines));
}


function clean() {
    unlink('installer.zip');
    unlink('database-awt.sql');
    unlink('pexels-mo-eid-12324196.jpg');
    unlink('style.css');
}