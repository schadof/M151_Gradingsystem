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
    ?>
    <ul>
        <li><a href="/index.php">Home</a></li>
    <?php
}
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['occupation']) && isset($_POST['class'])){
    include_once 'assets/php/login.php';
    createUser();
    header( "refresh:0.1; url=/index.php" );
}
if (isset($_POST['mark']) && isset($_POST['weight']) && isset($_POST['description']) && isset($_POST['module']) && isset($_POST['student'])){
    include_once 'assets/php/login.php';
    header( "refresh:0.1; url=/index.php" );
    createMark();
}
if(isset($_SESSION['occupation'])) {
    if ($_SESSION['occupation'] == "Administrator") {
        echo "<li><a href='/assets/includes/registerform.php'>Add User</a></li>";
        echo "<li><a href='assets/php/logout.php'>Logout</a></li>";
        echo "</ul>";
        include_once 'assets/includes/students.php';
    }
    if ($_SESSION['occupation'] == "Teacher") {
        echo "<li><a href='/assets/includes/insert.php'>Add Mark</a></li>";
        echo "<li><a href='assets/php/logout.php'>Logout</a></li>";
        echo "</ul>";
        include_once 'assets/includes/students.php';
    }
    if ($_SESSION['occupation'] == "Student") {
        echo "<li><a href='assets/php/logout.php'>Logout</a></li>";
        echo "</ul>";
        include_once 'assets/includes/grading.php';
    }
}
?>
</body>
</html>