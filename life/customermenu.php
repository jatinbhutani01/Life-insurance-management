<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['type']==="customer")
{
?>
<html>
    <head>
        <title>
            Customer Menu
        </title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="menu.css">
    </head>
    <body>
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="login.php">#Insurance For Life</a></span>
            </div>
            <ul class="links">
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="logout.php">LOG OUT</a></li>
            </ul>
        </div>
        </header>
        <div >
        <div class="menu" >
            <div class="menulist">
                <div class="bar"><a href="custpersonal.php">PERSONAL INFO</a></div>
                <div class="bar"><a href="custagent.php">AGENT</a></div>
                <div class="bar"><a href="custupdate.php">UPDATE INFO</a></div>
            </div>
        </div>
        </div>
    </body>
</html>
<?php
}
else
{
    header('location:login.php');
}
?>