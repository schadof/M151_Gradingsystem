<?php
@session_start();
if ($_SESSION['occupation'] == "Teacher" || $_SESSION['occupation'] == "Administrator") {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include_once "$root/assets/php/login.php";
    $students = getStudents();

    if (odbc_num_rows($students) != 0) {
        echo "Students:";
        echo "<table>";
        while (odbc_fetch_row($students)) {
            $id = odbc_result($students, "id");
            $fname = odbc_result($students, "fname");
            $lname = odbc_result($students, "lname");
            $username = odbc_result($students, "username");
            $class = odbc_result($students, "class");

            echo "<td>$fname</td>";
            echo "<td>$lname</td>";
            echo "<td>$username</td>";
            echo "<td>$class</td>";
            echo "<td><a href='/assets/includes/editmark.php?student=$id'>Edit</a></td></tr>";
        }
        echo "</table>";
        odbc_close(connectDB()); // Closing Connection
    }
}