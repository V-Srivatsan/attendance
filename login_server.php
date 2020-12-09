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
        echo "<p>You have already posted your attendance</p>";
        die();
    }

    $requested = $connect->query("SELECT * FROM ips WHERE IP='$request_ip' AND Request='Yes'");
    if (! $requested->fetch(PDO::FETCH_ASSOC)) {
        $connect->query("INSERT INTO ips VALUES ('$request_ip', 'Yes', 'No')");
    }

    if (isset($_POST['roll'])) {
        $sql = "SELECT * FROM passwords WHERE subject=:subj AND pass=:pass";
        $result = $connect->prepare($sql);
        $result->execute(array(":subj" => $_POST['subj'], ":pass" => htmlentities($_POST['pass'])));
        if ($result->fetch(PDO::FETCH_ASSOC)) {
            $connect->query("UPDATE ips SET Post='Yes' WHERE IP='$request_ip'");
            $sql = "SELECT Name FROM students WHERE Roll=:roll";
            $result = $connect->prepare($sql);
            $result->execute(array(':roll' => $_POST['roll']));
            $name = $result->fetch(PDO::FETCH_ASSOC)['Name'];
            $subj = $_POST['subj'];
            $update_sql = "UPDATE students SET ".$subj."='Present' WHERE Name='$name'";
            $connect->query($update_sql);
            echo "<p>Your attendance has been taken, ".$name.".</p>";
        }
        else {
            echo "<p>Incorrect Password</p>";
        }
    }
 ?>
