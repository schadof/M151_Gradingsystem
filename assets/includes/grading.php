<?php
@session_start();
if ($_SESSION['occupation'] == "Student") {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include_once "$root/assets/php/login.php";
    $con = connectDB();

    $sql = "
SELECT module FROM modules;";

    $result = odbc_exec($con, $sql);

    while (odbc_fetch_row($result)) {
        $module = odbc_result($result, "module");
        /* show tables */
        $sql1 = "
SELECT u.fname, u.lname, u.username, c.class, ma.mark, ma.weight, ma.description, mo.module FROM users u
JOIN classes c
ON u.class = c.id
JOIN marks ma
ON ma.student = u.id
JOIN modules mo
ON ma.module = mo.id
WHERE mo.module = '$module'
AND
u.username = '" . $_SESSION["login_user"] . "';";
        $result1 = odbc_exec($con, $sql1);
//check SQL
        if (!$result1) {
            exit("Error in SQL");
        }

        if (odbc_num_rows($result1) != 0) {
            $calculation = "";
            $weight = "";
            echo $module;
            echo "<table class='marks'>";
            while (odbc_fetch_row($result1)) {
                $mark = odbc_result($result1, "mark");
                $weight = odbc_result($result1, "weight");
                $description = odbc_result($result1, "description");
                $formula = $mark . "*" . $weight;
                if (!$calculation && $weight) {
                    $calculation = $formula;
                    $weighting = $weight;
                } else {
                    $calculation = $calculation . "+" . $formula;
                    $weighting = $weighting . "+" . $weight;
                }

                echo "<td data-balloon='Weight: $weight, Description: $description' data-balloon-pos='right'>$mark</td>";
            }
            $calculation = "(" . $calculation . ")/(" . $weighting . ")";
            eval('$math = (' . $calculation . ');');
            echo "<td class='grade'>" . round($math, 2) . "</td>";
            echo "</table>";
            echo "</br>";
        }
    }
    echo "You can hover over marks for weight and description";
    odbc_close($con);
}

