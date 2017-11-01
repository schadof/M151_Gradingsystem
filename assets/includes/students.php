<?php
@session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include_once "$root/assets/php/login.php";
$students = getStudents();

if(odbc_num_rows($students) != 0)
{
    echo "Students:";
    echo "<table>";
    while (odbc_fetch_row($students))
    {
        $fname = odbc_result($students,"fname");
        $lname = odbc_result($students,"lname");
        $username = odbc_result($students,"username");
        $class = odbc_result($students,"class");

        echo "<td>$fname</td>";
        echo "<td>$lname</td>";
        echo "<td>$username</td>";
        echo "<td>$class</td></tr>";
    }
    echo "</table>";
    odbc_close(connectDB()); // Closing Connection
}