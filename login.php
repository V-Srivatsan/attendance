<?php
    function getIP(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    $host = "";
    $dbname = "";
    $username = ""; 
    $pass = "";
    $port = "";
    $connect = new PDO('mysql:host=$host;dbname=$dbname;charset=utf8mb4', '$username', '$pass'); //for ecxternal databases
    $connect = new PDO('mysql:host=$host;port=$port;dbname=$dbname', '$username', '$pass'); //for localhost databases

    $request_ip = getIP();

    $posted = $connect->query("SELECT * FROM ips WHERE IP='$request_ip' AND Request='Yes' AND Post='Yes'");

    if ($posted->fetch(PDO::FETCH_ASSOC)) {
        echo "<link rel=\"stylesheet\" href=\"styles.css\">";
        echo "<p>You have already posted your attendance</p>";
        die();
    }

    $requested = $connect->query("SELECT * FROM ips WHERE IP='$request_ip' AND Request='Yes'");
    if (! $requested->fetch(PDO::FETCH_ASSOC)) {
        $connect->query("INSERT INTO ips VALUES ('$request_ip', 'Yes', 'No')");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="functions.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <h1>Attendance</h1>
        <br>
        <div id="text-area">
            <p>
                <strong>Instructions:</strong> Select your Subject, and enter your Roll. Press anywhere on the screen and "Post Attendance".
                <br>
                <strong>Note:</strong> You can send your data only ONCE.
            </p>
            <for id="details">
                <select id="subjects" onchange="checkInp()">
                    <option value="-1">Select</option>
                    <option value="0">English</option>
                    <option value="1">Maths</option>
                    <option value="2">Science</option>
                    <option value="3">Social</option>
                </select>
                <input type="number" name="roll" placeholder="Roll" onchange="checkInp()" min="1" max="41">
                <input type="text" name="pass" placeholder="Enter Password" onchange="checkInp()">
                <button type="button" id="btn" onclick="validate()" style="display: none;">Post Attendance</button>
                <img id="loading" src="loading.gif" alt="Loading..." style="display: none;">
            </form>
            <br><br>
            <div id="result"></div>
            <a href="admin.php"><button>Admin</button></a>
        </div>
    </body>
</html>
