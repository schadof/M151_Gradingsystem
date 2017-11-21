<?php
@session_start();
//Conects to Database and returns connection
function connectDB(){
//connection data
$db_odbc = 'M151_GREADES';
$db_user = 'root';
$db_pass = '';

//connect
$con = odbc_connect($db_odbc,$db_user,$db_pass);

//check connection
if (!$con){
	exit("Connection Failed: " . $con);
}

return $con;
}

//Returns list of students
function getStudents (){
    $students_sql = "CALL getStudents();";
    $students = odbc_exec(connectDB(), $students_sql);
    return $students;
}

//Sets Session Tokens if password and username in post were correct
function login() {
    // Define $username and $password
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    // Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
    $username = stripslashes($username);
    // SQL query to fetch information of registerd users and finds user match.
    $login_sql = "CALL login('$username', '$password')";
    $result = odbc_exec(connectDB(), $login_sql);
    $rows = odbc_num_rows($result);
    if ($rows == 1) {
        $occupation = odbc_result($result,"occupation");
        $username_id = odbc_result($result,"id");
        $_SESSION["login_user"] = $username; // Initializing Session
        $_SESSION["loginid_user"] = $username_id; // Initializing Session
        $_SESSION["occupation"] = $occupation; // Initializing Session
    } else {
        $error = "Username or Password is invalid";
        echo $error;
        $_SESSION["login_failure"] = 'true';
    }
    odbc_close(connectDB()); // Closing Connection
}

//Creates user
function createUser() {
    $conn = connectDB();
    $fname=$_POST["fname"];
    unset($_POST["fname"]);

    $lname=$_POST["lname"];
    unset($_POST["lname"]);

    $username=$_POST["username"];
    unset($_POST["username"]);

    $password=md5($_POST["password"]);
    unset($_POST["password"]);

    $occupation=$_POST["occupation"];
    unset($_POST["occupation"]);

    $class=$_POST["class"];
    unset($_POST["class"]);
    $fname = stripslashes($fname);
    $lname = stripslashes($lname);
    $occupation = stripslashes($occupation);
    $class = stripslashes($class);
    odbc_autocommit($conn, FALSE);
    $query = odbc_exec($conn, "CALL createUser('$fname', '$lname', '$username', '$password', $occupation, $class)");
    if (!odbc_error())
        odbc_commit($conn);
    else
        odbc_rollback($conn);
    odbc_close($conn); // Closing Connection
}

//Creates mark
function createMark() {
    $conn = connectDB();
    $mark=$_POST["mark"];
    unset($_POST["mark"]);

    $weight=$_POST["weight"];
    unset($_POST["weight"]);

    $description=$_POST["description"];
    unset($_POST["description"]);

    $module=$_POST["module"];
    unset($_POST["module"]);

    $student=$_POST["student"];
    unset($_POST["student"]);

    $teacher=$_SESSION["loginid_user"];
    $mark = stripslashes($mark);
    $weight = stripslashes($weight);
    $student = stripslashes($student);
    $teacher = stripslashes($teacher);
    odbc_autocommit($conn, FALSE);
    $query = odbc_exec($conn, "CALL createMark($mark, $weight, '$description', $module, $student, $teacher)");
    if (!odbc_error())
        odbc_commit($conn);
    else
        odbc_rollback($conn);
    odbc_close($conn); // Closing Connection
}

function editMarks(array $array){
    $conn = connectDB();
    foreach($array as $id) {
        $mark = $_POST["mark_$id"];
        unset($_POST["mark_$id"]);

        $weight = $_POST["weight_$id"];
        unset($_POST["weight_$id"]);

        $description = $_POST["description_$id"];
        unset($_POST["description_$id"]);

        $mark = stripslashes($mark);
        $weight = stripslashes($weight);
        odbc_autocommit($conn, FALSE);

        $query = odbc_exec($conn, "CALL editMarks($id, $mark, $weight, '$description')");
        if (!odbc_error()) {
            odbc_commit($conn);
        }
        else
            odbc_rollback($conn);
        unset($array);
    }
    odbc_close($conn); // Closing Connection
}
