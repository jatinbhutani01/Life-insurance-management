<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['username']) )
{
    header('location:login.php');
}
 else {
    

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>life insurance</title>
        <link rel="stylesheet" href="welcome.css">
    </head>
    <body>
        <div id="outer">
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="#">#Insurance For Life</a></span>
            </div>
        </div>
        </header>
        <div id="first">
            <span id="welcome">WELCOME</span><br>
            <span id="welcome2">To Life Insurance Management System</span><br><br>
            <span id="welcome3">Take a life insurance and secure your family's future With our life insurance management system book your life insurance today and be secure</span><br>
            <br><br><a href="login.php" id="button">GET STARTED</a>
        </div>
        </div>
        
    </body>
</html>
<?php
 }