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
    $name = $_POST['username'];
    $password = md5($_POST['password']);
    // Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
    $name = stripslashes($name);
    // SQL query to fetch information of registerd users and finds user match.
    $login_sql = "
    SELECT u.username, u.password, o.occupation FROM users u
    JOIN occupations o
    ON u.occupation = o.id
    WHERE `username` 
    LIKE '".$name."' 
    AND password 
    LIKE '".$password."'";
    $result = odbc_exec(connectDB(), $login_sql);
    $rows = odbc_num_rows($result);
    if ($rows == 1) {
        $occupation = odbc_result($result,"occupation");
        $_SESSION['login_user'] = $name; // Initializing Session
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
