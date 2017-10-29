<?php
include './login.php';
$con = connectDB();

//check connection
if (!$con){
    exit("Connection Failed: " . $con);
}

$sql = "
SELECT module FROM modules;";

$result = odbc_exec($con,$sql);

while(odbc_fetch_row($result))
{
	$module = odbc_result($result,"module");
/* show tables */
$sql1 = "
SELECT u.fname, u.lname, c.name, ma.mark, ma.weight, ma.description, mo.module FROM users u
JOIN classes c
ON u.class = c.id
JOIN marks ma
ON ma.user = u.id
JOIN modules mo
ON ma.module = mo.id
WHERE mo.module = '$module';";
$result1 = odbc_exec($con,$sql1);
//check SQL
if (!$result1){
    exit("Error in SQL");
}

if(odbc_num_rows($result1) != 0)
{
echo $module;
}

echo "<table>";
while (odbc_fetch_row($result1))
{
    $mark=odbc_result($result1,"mark");
    $weight=odbc_result($result1,"weight");

    echo "<td>$mark" . "*" . "$weight</td>";
}
echo "</table>";
echo "</br>";
}
odbc_close($con);

