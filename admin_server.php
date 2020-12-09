<?php
    session_start();
    // $connect = new PDO("mysql:hostname=localhost;port=3306;dbname=id15581085_attendance", 'vatsan_php', 'Brainless-2109');
    $connect = new PDO('mysql:host=remotemysql.com;dbname=VWYSNpIlh4;charset=utf8mb4', 'VWYSNpIlh4', 'O62vcpFSIJ');
    if (isset($_POST['pass'])) {
        if ($_POST['pass'] == "vatsan_admin_2109") {
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
