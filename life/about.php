<?php
session_start();

?>
<html>
    <head>
        <title>
            about
        </title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="about.css">
    </head>
    <body>
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="login.php">#Insurance For Life</a></span>
            </div>
            <ul class="links">
                <?php
                if(isset($_SESSION['username'])&&$_SESSION['type']==="agent")
                {
                    echo "<li><a href=\"agentmenu.php\">MENU</a></li><li><a href=\"logout.php\">LOG OUT</a></li>";
                }
                else if(isset($_SESSION['username'])&&$_SESSION['type']==="dba")
                {
                    echo "<li><a href=\"dba.php\">MENU</a></li><li><a href=\"logout.php\">LOG OUT</a></li>";
                }
                else if(isset($_SESSION['username'])&&$_SESSION['type']==="customer")
                {
                    echo "<li><a href=\"customermenu.php\">MENU</a></li><li><a href=\"logout.php\">LOG OUT</a></li>";
                }
                else
                {
                    echo "<li><a href=\"login.php\">MAIN PAGE</a></li>";
                }
                ?>
            </ul>
        </div>
        </header>
        <div>
        <div class="menu" >
            <div class="inner">
                <span id="welcome">Made By: Jatin Bhutani</span><br>
                <span id="welcome">Course: 6th SEM BE CSE</span><br>
                <span id="welcome">Batch: 2nd Batch</span><br>
                <span id="welcome">Purpose: DBMS Lab Project</span><br>
                <span id="welcome">Topic: Life Insurance Management</span><br>
            </div>
        </div>
        </div>
    </body>
</html>
