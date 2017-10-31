<?php
@session_start();
include '../php/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div id="form">
    <h1 id="title">Enter User Data</h1>
    <div id="register">
        <form action="/index.php" method="POST">
            First Name:<br>
            <input type="text" name="fname" placeholder="First Name">
            <br>
            Last Name:<br>
            <input type="text" name="lname" placeholder="Last Name">
            <br>
            Username:<br>
            <input type="text" name="username" placeholder="Username">
            <br>
            Password:<br>
            <input type="password" name="password" placeholder="Password">
            <br>
            Occupation:<br>
            <select id="occupation">
                <?php
                $con = connectDB();

                $sql = "SELECT * FROM occupations;";

                $result = odbc_exec($con,$sql);

                while(odbc_fetch_row($result)) {
                    $occupation_id = odbc_result($result,"id");
                    $occupation = odbc_result($result, "occupation");
                    echo "<option value='$occupation_id'>$occupation</option>";
                }
                ?>
            </select>
            <br>
            Class:<br>
            <select id="class">
                <?php
                $con = connectDB();

                $sql = "SELECT * FROM classes;";

                $result = odbc_exec($con,$sql);

                while(odbc_fetch_row($result)) {
                    $class_id = odbc_result($result,"id");
                    $class = odbc_result($result, "class");
                    echo "<option value='$class_id'>$class</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>