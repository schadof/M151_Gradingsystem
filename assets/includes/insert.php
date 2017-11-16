<?php
@session_start();
if ($_SESSION["occupation"] == "Teacher") {
$root = $_SERVER['DOCUMENT_ROOT'];
include_once "$root/assets/php/login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div id="form">
    <h1 id="title">Enter Mark Data</h1>
    <div id="register">
        <form action="/index.php" method="POST">
            Mark:<br>
            <input type="number" name="mark" placeholder="Mark">
            <br>
            Weight:<br>
            <input type="number" name="weight" placeholder="Weight">
            <br>
            Description:<br>
            <input type="text" name="description" placeholder="Description">
            <br>
            Module:<br>
            <select name="module">
                <?php
                $con = connectDB();

                $sql = "SELECT * FROM modules;";

                $result = odbc_exec($con, $sql);

                while (odbc_fetch_row($result)) {
                    $module_id = odbc_result($result, "id");
                    $module = odbc_result($result, "module");
                    echo "<option value='$module_id'>$module</option>";
                }
                ?>
            </select>
            <br>
            Student:<br>
            <select name="student">
                <?php
                $result = getStudents();

                while (odbc_fetch_row($result)) {
                    $student_id = odbc_result($result, "id");
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
<?php
}
?>
<a href='/index.php'>Home</a>
</body>
</html>