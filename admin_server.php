<?php
    session_start();
    $host = "";
    $dbname = "";
    $username = ""; 
    $pass = "";
    $port = "";
    $connect = new PDO('mysql:host=$host;dbname=$dbname;charset=utf8mb4', '$username', '$pass'); //for ecxternal databases
    $connect = new PDO('mysql:host=$host;port=$port;dbname=$dbname', '$username', '$pass'); //for localhost databases
    if (isset($_POST['pass'])) {
        if ($_POST['pass'] == "admin") {
            $result = $connect->query("SELECT * FROM passwords");
            echo "<table class='table table-responsive text-white'><tr><th>Subject</th><th>Pass</th></tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $subj = $row['subject'];
                $pass = $row['pass'];
                echo "
                    <tr>
                        <td>$subj</td>
                        <td>$pass</td>
                    </tr>
                ";
            }
            echo "</table><br><br>";

            echo "
            <button onclick=\"changePass()\">Change passwords</button>
            <button onclick=\"delIP()\">Reset IP</button>
            <button onclick=\"reset()\">Reset Attendance</button>
            <img src=\"loading.gif\" alt=\"LOADING...\" id=\"load_pwd\" style='display: none;'>

            ";
        }
        else {
            echo "<p>Incorrect Password</p>";
        }
    }
    if (isset($_POST['change_pass'])) {
        $english_pwd = hash("SHA256", "".abs(rand(1000000, 100000000) - rand(1000000, 100000000)) + rand(1000000, 100000000));
        // $hindi_pwd = hash("SHA256", "".abs(rand(1000000, 100000000) - rand(1000000, 100000000)) + rand(1000000, 100000000));
        $maths_pwd = hash("SHA256", "".abs(rand(1000000, 100000000) - rand(1000000, 100000000)) + rand(1000000, 100000000));
        $science_pwd = hash("SHA256", "".abs(rand(1000000, 100000000) - rand(1000000, 100000000)) + rand(1000000, 100000000));
        $social_pwd = hash("SHA256", "".abs(rand(1000000, 100000000) - rand(1000000, 100000000)) + rand(1000000, 100000000));

        $connect->query("UPDATE passwords SET pass='$english_pwd' WHERE subject='English'");
        // $connect->query("UPDATE passwords SET pass='$hindi_pwd' WHERE subject='Hindi'");
        $connect->query("UPDATE passwords SET pass='$maths_pwd' WHERE subject='Maths'");
        $connect->query("UPDATE passwords SET pass='$science_pwd' WHERE subject='Science'");
        $connect->query("UPDATE passwords SET pass='$social_pwd' WHERE subject='Social'");

        echo "<p>Changing Passwords: Done!</p>";
    }
    if (isset($_POST['del_IP'])) {
        $connect->query("TRUNCATE TABLE ips");
        echo "<p>Deleting Requested IPs: Done!</p>";
    }
    if (isset($_POST['reset'])) {
        $connect->query("UPDATE students SET English='Absent'");
        $connect->query("UPDATE students SET Maths='Absent'");
        $connect->query("UPDATE students SET Social='Absent'");
        $connect->query("UPDATE students SET Science='Absent'");
        echo "<p>Resetting Attendance: Done!</p>";
    }
?>
