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
    $query = mysqli_query(connectDB(), "select id, name from users");
    $students = mysqli_fetch_object($query);
    mysqli_close(connectDB()); // Closing Connection
    return $students;
}

//Sets Session Tokens if password and username in post were correct
function login() {
    // Define $username and $password
    $name = $_POST['username'];
    $password = md5($_POST['password']);
    // Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
    $name = stripslashes($name);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string(connectDB(), $password);
    // SQL query to fetch information of registerd users and finds user match.
    $query = mysqli_query(connectDB(), "select * from users where `Name` like '".$name."' AND Password like '".$password."'");
    $rows = mysqli_num_rows($query);
    if ($rows == 1) {
        $_SESSION['login_user'] = $name; // Initializing Session
    } else {
        $error = "Username or Password is invalid";
        echo $error;
        $_SESSION['login_failure'] = 'true';
    }
    mysqli_close(connectDB()); // Closing Connection
}

//Logs out current user
function logout() {
    @session_destroy();
}

//Creates user
function createUser() {
    $name=$_POST['username'];
    $password=md5($_POST['password']);
    $name = stripslashes($name);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string(connectDB(), $password);
    $query = mysqli_query(connectDB(), "insert into `users` (`Name`, Password) VALUES ('".$name."', '".$password."')");
    mysqli_close(connectDB()); // Closing Connection
}

?>