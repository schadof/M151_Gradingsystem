<?php
include './login.php';
$con = connectDB();

//check connection
if (!$con){
    exit("Connection Failed: " . $con);
}

/* show tables */
$sql = "
SELECT u.fname, u.lname, c.name, ma.mark, ma.weight, ma.description, mo.module FROM users u
JOIN classes c
ON u.class = c.id
JOIN marks ma
ON ma.user = u.id
JOIN modules mo
ON ma.module = mo.id;";
$result = odbc_exec($con,$sql);
//check SQL
if (!$result){
    exit("Error in SQL");
}

echo "<table>";
while (odbc_fetch_row($result))
{
    $mark=odbc_result($result,"mark");
    $weight=odbc_result($result,"weight");

    echo "<td>$mark" . "x" . "$weight</td>";
}
echo "</table>";
odbc_close($con);

