<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="agent")
{
    require_once 'config.php';
    $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
    $updated=0;
    $notmatch=0;
    if(isset($_POST['changepassword']))
    {
        if($_POST['pass']==$_POST['pass1'])
        {
            $query3="update userinfo set password='".$_POST['pass']."' where id=".$_SESSION['id']." and type='agent' ;";
            $result1= mysqli_query($db, $query3);
            $updated=0;
        }
        else
        {
            $notmatch=1;
        }
    }
    if(isset($_POST['updatesubmit']))
    {
        $quer="update agent set name='".$_POST['name']."', phone='".$_POST['phone']."', dob='".$_POST['dob']."' where eno=".$_SESSION['id'].";";
        $resu=mysqli_query($db,$quer);
        if($resu==1)
        {
            $updated=1;
        }
    }
    $query="select * from agent where eno=".$_SESSION['id'];
    $result=mysqli_query($db,$query);
    $t= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            update info
        </title>
        <link rel="stylesheet" href="droptwo.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="table.css">
        
    </head>
    <body>
        
        <div class="header">
        <div class="logo">
            <span><a href="login.php">#Insurance For Life</a></span>
        </div>
        <ul class="links">
            <li><a href="agentmenu.php">MENU</a></li>
            <li><a href="agentprogress.php">PROGRESS</a></li>
            <li><a href="agentinfo.php">INFO</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >PERSONAL</div></li>
                    <li id="two"><div onclick="bbbb()">CHANGE PASSWORD</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <h2>UPDATE INFO</h2>
                    <br>
                    <br>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
                        <label>Name:</label><input name="name" type="text" placeholder="Full Name" value="<?php echo $t[1]; ?>" required>
                        <br><br>
                        <label>Phone Number:</label><input name="phone" type="text" placeholder="phone number" value="<?php echo $t[4]; ?>" required>
                        <br><br>
                        <label>Date Of Birth:</label><input name="dob" type="date" value="<?php echo $t[2]; ?>" required>
                        <br><br>
                        <input type="submit" value="SUBMIT" name="updatesubmit">
                    </form>
                    <br>
                    <?php 
                    if($updated==1)
                    {
                        echo "<p>information has been updated";
                    }
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <h2>CHANGE PASSWORD</h2>
                    <br>
                    <br>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <label>Password:</label><input type="password" name="pass" placeholder="password" required>
                        <br><br>
                        <label>Confirm Password:</label><input type="password" name="pass1" placeholder="password" required>
                        <br><br>
                        <input type="submit" name="changepassword" value="SUBMIT">
                        <br>
                        <br>
                        <?php
                        if($notmatch==1)
                        {
                            echo "password's do not match please retry!!";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var add= document.getElementById("aaaa");
            var view= document.getElementById("bbbb");
            var one=document.getElementById("one");
            var two=document.getElementById("two");
            function aaaa()
            {
                add.style.display="block";
                view.style.display="none";
                one.style.border="2px solid black";
                two.style.border="none";
            }
            function bbbb()
            {
                add.style.display="none";
                view.style.display="block";
                one.style.border="none";
                two.style.border="2px solid black";
            }
        </script>
        <?php 
        if($notmatch==1)
        {
            echo "<script type=\"text/javascript\"> bbbb();</script>";
        }
        ?>
    </body>
</html>
<?php 
}
else
{
    header('location:login.php');
}
?>