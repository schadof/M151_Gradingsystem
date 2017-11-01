<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once "$root/assets/php/login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Marks</title>
</head>
<body>
<div id="form">
    <h1 id="title">Enter User Data</h1>
    <div id="register">
        <form action="/index.php" method="POST">
            Class:<br>
            <select name="class">
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
            <br>
            Student:<br>
            <select name="class">
                <?php
                $result = getStudents();

                while(odbc_fetch_row($result)) {
                    $student_id = odbc_result($result,"id");
                    $student = odbc_result($result, "username");
                    echo "<option value='$student_id'>$student</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<br>
<a href='/index.php'>Home</a>
</body>
</html>