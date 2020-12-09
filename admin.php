<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="functions.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body onload="checkAdmin()">
        <h1>Admin</h1>
        <div id="text-area">
            <form id="admin_form"method="post">
                <input type="password" name="pass" placeholder="Enter Admin Password">
                <input type="submit" id="admin_btn" value="Validate">
                <img src="loading.gif" alt="Loading..." id="loading" style="display: none;">
            </form><br><br>
            <div id="output">

            </div>
            <br>
            <p><a href="login.php"><button>Login</button></a></p>
        </div>
    </body>
</html>
