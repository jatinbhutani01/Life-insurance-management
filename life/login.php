<!DOCTYPE html>
<?php 
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['type']))
{
    if($_SESSION['type']==="customer")
    {
        header('location:customer.php');
    }
    else if($_SESSION['type']=="agent")
    {
        header('location:agent.php');
    }
    else if($_SESSION['type']=="dba")
    {
        header('location:dba.php');
    }
}
else {
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <link rel="stylesheet" type="text/css" href="header.css">
        <link rel="stylesheet" type="text/css" href="formstyle.css">
    </head>
    <body>
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="index.php">#Insurance For Life</a></span>
            </div>
            <ul class="links">
                <li><a href="signup.php">SIGN UP</a></li>
                <li><a href="about.php">ABOUT</a></li>
            </ul>
        </div>
        </header>
        <div class="login_form"  >
            <h2>LOG IN</h2>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                
                <label>UserName</label><input type="text" placeholder="UserName" name="username">
                <br>
                <br>
                <label>Password</label><input type="password" placeholder="Password" name="password">
                <br>
                <br>
                <input type="submit" value="LOG IN" name="submit">
                    
            </form>
        
        <?php
        if(isset($_POST['submit']))
        {
            require_once 'config.php';
            $db=mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
            $query="select * from userinfo where username ='".$_POST['username']."';";
            $result=mysqli_query($db, $query);
            if(empty($result))
            {
                echo "wrong id or password";
            }
            $row= mysqli_fetch_assoc($result);
            if($_POST['password']!=$row['password'])
            {
                echo "wrong id or password";
            }
            else
            {
                $_SESSION["username"]=$row['username'];
                $_SESSION["type"]=$row['type'];
                if($row['id']!=NULL)
                {
                    $_SESSION["id"]=$row['id'];
                }
                if($row['type']=="customer")
                {
                    header('location:customer.php');
                }
                else if($row['type']=="agent")
                {
                    header('location:agent.php');
                }
                else if($row['type']=="dba")
                {
                    header('location:dba.php');
                }
                
            }
            
        }
        ?>
        </div>
    </body>
</html>
<?php
 }
?>