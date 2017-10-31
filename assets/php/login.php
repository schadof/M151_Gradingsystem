<?php

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
    $query = odbc_exec(connectDB(), "select * from users");
    $students = odbc_result($query);
    odbc_close(connectDB()); // Closing Connection
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
    $query = odbc_exec(connectDB(), "select * from users where `username` like '".$name."' AND password like '".$password."'");
    $rows = odbc_num_rows($query);
    if ($rows == 1) {
        $_SESSION['login_user'] = $name; // Initializing Session
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
    $lname=$_POST['lname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $occupation=$_POST['occupation'];
    $class=$_POST['class'];
    $fname = stripslashes($fname);
    $lname = stripslashes($lname);
    $occupation = stripslashes($occupation);
    $class = stripslashes($class);
    $query = odbc_exec(connectDB(), "insert into `users` (fname, lname, username, password, occupation, class) 
                                                VALUES ($fname, $lname, $username, $password, $occupation, $class)");
    odbc_close(connectDB()); // Closing Connection
}
