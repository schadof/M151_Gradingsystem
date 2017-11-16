<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Greades</title>
    <meta name="description" content="The Great Gradingsystem">
    <meta name="author" content="Lars Ragutt">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/balloon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>

<body>
<?php
@session_start();

if(!isset($_SESSION['login_user'])) {
    include_once 'assets/includes/loginform.php';
    if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['fname'])) {
        include_once 'assets/php/login.php';
        login();
        if(isset($_SESSION['login_user'])){
            header("location: index.php");
        }
    }
}
else{
    echo "<a href='assets/php/logout.php'>Logout</a>";
    echo "<br>";
    include_once 'assets/includes/grading.php';
}
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['occupation']) && isset($_POST['class'])){
    include_once 'assets/php/login.php';
    createUser();
}
if (isset($_POST['mark']) && isset($_POST['weight']) && isset($_POST['description']) && isset($_POST['module']) && isset($_POST['student'])){
    include_once 'assets/php/login.php';
    createMark();
}
if ($_SESSION['occupation'] == "Administrator"){
    echo "<a href='/assets/includes/registerform.php'>Add User</a><br>";
    include_once 'assets/includes/students.php';
}
if ($_SESSION['occupation'] == "Teacher"){
    echo "<a href='/assets/includes/insert.php'>Add Mark</a><br>";
    echo "<a href='/assets/includes/registerform.php'>Add User</a><br>";
    include_once 'assets/includes/students.php';
}
?>
</body>
</html>