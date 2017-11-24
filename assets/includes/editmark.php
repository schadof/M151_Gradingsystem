<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Greades</title>
    <meta name="description" content="The Great Gradingsystem">
    <meta name="author" content="Lars Ragutt">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">

</head>

<body>
<ul>
    <li><a href="/index.php">Home</a></li>
    <li><a href='assets/php/logout.php'>Logout</a></li>
</ul>
<?php
@session_start();
if ($_SESSION['occupation'] == "Teacher") {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include_once "$root/assets/php/login.php";
    $con = connectDB();
    $array = array();

    $sql = "
SELECT module FROM modules;";

    $result = odbc_exec($con, $sql);
    echo "<form method='POST'>";
    while (odbc_fetch_row($result)) {
        $module = odbc_result($result, "module");
        /* show tables */
        $sql1 = "
SELECT u.id, u.fname, u.lname, u.username, c.class, ma.id ma_id, ma.mark, ma.weight, ma.description, mo.module FROM users u
JOIN classes c
ON u.class = c.id
JOIN marks ma
ON ma.student = u.id
JOIN modules mo
ON ma.module = mo.id
WHERE mo.module = '$module'
AND
u.id = '" . $_GET['student'] . "';";
        $result1 = odbc_exec($con, $sql1);
//check SQL
        if (!$result1) {
            exit("Error in SQL");
        }
        if (odbc_num_rows($result1) != 0) {
            $calculation = "";
            $weight = "";
            echo $module;
            echo "<table>";
            echo "<td>Mark</td>";
            echo "<td>Weight</td>";
            echo "<td>Description</td></tr>";
            while (odbc_fetch_row($result1)) {
                $mark_id = odbc_result($result1, "ma_id");
                $array[] = $mark_id;
                $mark = odbc_result($result1, "mark");
                $weight = odbc_result($result1, "weight");
                $description = odbc_result($result1, "description");


                echo "<td><input type='number'  step='0.01' name='mark_$mark_id' value='$mark'></td>";
                echo "<td><input type='number'  step='0.01' name='weight_$mark_id' value='$weight'></td>";
                echo "<td><input type='text' name='description_$mark_id' value='$description'></td></tr>";
            }
            echo "</table>";
            echo "</br>";
        }
    }
    echo "<input type='submit' value='Submit' name='submit'>";
    echo "</form>";

    if(isset($_POST["submit"])){
        include_once "$root/assets/php/login.php";
        editMarks($array);
        odbc_close($con);
        header( "refresh:0.1; url=../../index.php" );
    }
}
?>
</body>
</html>