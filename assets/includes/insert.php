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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<ul>
    <li><a href="/index.php">Home</a></li>
    <li><a href='assets/php/logout.php'>Logout</a></li>
</ul>
<div>
    <h1>Enter Mark Data</h1>
    <div>
        <form action="/index.php" method="POST">
            Mark:<br>
            <input type="number" step="0.01" name="mark" placeholder="Mark">
            <br>
            Weight:<br>
            <input type="number" step="0.01" name="weight" placeholder="Weight">
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
</body>
</html>