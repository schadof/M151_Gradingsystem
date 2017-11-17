<?php
@session_start();
if ($_SESSION["occupation"] == "Administrator") {
$root = $_SERVER['DOCUMENT_ROOT'];
include_once "$root/assets/php/login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<ul>
    <li><a href="/index.php">Home</a></li>
    <li><a href='assets/php/logout.php'>Logout</a></li>
</ul>
<div>
    <h1>Enter User Data</h1>
    <div>
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
            <select name="occupation">
                <?php
                $con = connectDB();

                $sql = "SELECT * FROM occupations;";

                $result = odbc_exec($con, $sql);

                while (odbc_fetch_row($result)) {
                    $occupation_id = odbc_result($result, "id");
                    $occupation = odbc_result($result, "occupation");
                    echo "<option value='$occupation_id'>$occupation</option>";
                }
                ?>
            </select>
            <br>
            Class:<br>
            <select name="class">
                <option value='NULL' selected></option>
                <?php
                $con = connectDB();

                $sql = "SELECT * FROM classes;";

                $result = odbc_exec($con, $sql);

                while (odbc_fetch_row($result)) {
                    $class_id = odbc_result($result, "id");
                    $class = odbc_result($result, "class");
                    echo "<option value='$class_id'>$class</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<?php
}
?>
</body>
</html>