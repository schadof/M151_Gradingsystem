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
    <div id="search">
        <form action="" method="POST">
            Student:<br>
            <select name="student" id="student">
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
<?php
if(isset($_POST['submit'])){
    $sql = "
SELECT module FROM modules;";

    $result = odbc_exec($con, $sql);

    while (odbc_fetch_row($result)) {
        $module = odbc_result($result, "module");
        /* show tables */
        $sql1 = "
SELECT u.id, u.fname, u.lname, u.username, c.class, ma.mark, ma.weight, ma.description, mo.module FROM users u
JOIN classes c
ON u.class = c.id
JOIN marks ma
ON ma.user = u.id
JOIN modules mo
ON ma.module = mo.id
WHERE mo.module = '$module'
AND
u.id = '" . $_POST['student'] . "';";
        print $_POST['student'];
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
            while (odbc_fetch_row($result1)) {
                $mark = odbc_result($result1, "mark");
                $weight = odbc_result($result1, "weight");
                $formula = $mark . "*" . $weight;
                if (!$calculation && $weight) {
                    $calculation = $formula;
                    $weighting = $weight;
                } else {
                    $calculation = $calculation . "+" . $formula;
                    $weighting = $weighting . "+" . $weight;
                }

                echo "<td>$formula</td>";
            }
            $calculation = "(" . $calculation . ")/(" . $weighting . ")";
            eval('$math = (' . $calculation . ');');
            echo "<td class='grade'>$math</td>";
            echo "</table>";
            echo "</br>";
        }
    }
    odbc_close($con);
}
?>
<br>
<a href='/index.php'>Home</a>
</body>
</html>