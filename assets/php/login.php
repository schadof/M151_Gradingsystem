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
    $students_sql = "
    SELECT u.id, u.fname, u.lname, u.username, c.class FROM users u
    JOIN classes c
    ON u.class = c.id
    JOIN occupations o
    ON u.occupation = o.id
    WHERE o.occupation='Student'";
    $students = odbc_exec(connectDB(), $students_sql);
    return $students;
}

//Sets Session Tokens if password and username in post were correct
function login() {
    // Define $username and $password
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    // Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
    $username = stripslashes($username);
    // SQL query to fetch information of registerd users and finds user match.
    $login_sql = "
    SELECT u.id, u.username, u.password, o.occupation FROM users u
    JOIN occupations o
    ON u.occupation = o.id
    WHERE `username` 
    LIKE '".$username."' 
    AND password 
    LIKE '".$password."'";
    $result = odbc_exec(connectDB(), $login_sql);
    $rows = odbc_num_rows($result);
    if ($rows == 1) {
        $occupation = odbc_result($result,"occupation");
        $username_id = odbc_result($result,"id");
        $_SESSION['login_user'] = $username; // Initializing Session
        $_SESSION['loginid_user'] = $username_id; // Initializing Session
        $_SESSION['occupation'] = $occupation; // Initializing Session
    } else {
        $error = "Username or Password is invalid";
        echo $error;
        $_SESSION['login_failure'] = 'true';
    }
    odbc_close(connectDB()); // Closing Connection
}

//Creates user
function createUser() {
    $fname=$_POST['fname'];
    unset($_POST['fname']);

    $lname=$_POST['lname'];
    unset($_POST['lname']);

    $username=$_POST['username'];
    unset($_POST['username']);

    $password=md5($_POST['password']);
    unset($_POST['password']);

    $occupation=$_POST['occupation'];
    unset($_POST['occupation']);

    $class=$_POST['class'];
    unset($_POST['class']);
    $fname = stripslashes($fname);
    $lname = stripslashes($lname);
    $occupation = stripslashes($occupation);
    $class = stripslashes($class);
    $query = odbc_exec(connectDB(), "insert into `users` (fname, lname, username, password, occupation, class) 
                                                VALUES ('$fname', '$lname', '$username', '$password', $occupation, $class)");
    odbc_close(connectDB()); // Closing Connection
}

//Creates mark
function createMark() {
    $mark=$_POST['mark'];
    unset($_POST['mark']);

    $weight=$_POST['weight'];
    unset($_POST['weight']);

    $description=$_POST['description'];
    unset($_POST['description']);

    $module=$_POST['module'];
    unset($_POST['module']);

    $student=$_POST['student'];
    unset($_POST['student']);

    $teacher=$_SESSION['loginid_user'];
    $mark = stripslashes($mark);
    $weight = stripslashes($weight);
    $student = stripslashes($student);
    $teacher = stripslashes($teacher);
    $query = odbc_exec(connectDB(), "insert into `marks` (mark, weight, description, `module`, student, teacher) 
                                                VALUES ('$mark', '$weight', '$description', '$module', $student, $teacher)");
    odbc_close(connectDB()); // Closing Connection
}
