<?php
session_start();
if($_SESSION['type']==="dba")
{
?>
<html>
    <head>
        <title>
            dba's menu
        </title>
        <link type="text/css" rel="stylesheet" href="header.css">
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
        <div class="menu" style="margin-top:110px;">
            <div class="menulist">
                <div class="bar"><a href="progress.php">COMPANY PROGRESS</a></div>
                <div class="bar"><a href="analytics.php">ANALYTICS</a></div>
                <div class="bar"><a href="branch.php">BRANCHES</a></div>
                <div class="bar"><a href="policy.php">POLICIES</a></div>
            </div>
        </div>
        </div>
    </body>
</html>
<?php
}
 else {
     header('location:login.html');
}
?>

