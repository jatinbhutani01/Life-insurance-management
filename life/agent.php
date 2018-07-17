<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['type']="agent")
{
require_once 'config.php';
$db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
$query="select * from agent where eno=".$_SESSION['id'];
$result=mysqli_query($db,$query);
if(mysqli_num_rows($result)==0)
{
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="register.css">
        <title>
            agent
        </title>
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
        <div class="form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" >
            <label>Name:</label><input type="text" name="name" placeholder="name" required><br><br>
            <label>Date of Birth:</label><input type="date" name="dob" required><br><br>
            <label>Gender:</label><input type="radio" name="gender" value="m" checked="checked">Male<input type="radio" name="gender" value="f" >Female<br><br>
            <label>Phone Number:</label><input type="text" name="phone"  placeholder="phone number" required><br><br>
            <?php
                require_once 'config.php';
                $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
                $query="SELECT * FROM branch";
                $result= mysqli_query($db, $query);
                if(empty($result))
                {
                    echo "no branches available";
                }
                else
                {
                echo "<label>Branch:</label><select name=\"branchno\" required>";
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<option value=\"".$row['branchno']."\">".$row['location']."</option>";
                }
                echo "</select>";
                }
            ?>
            <br>
            <br>
            <input type="submit" name="submit" value="REGISTER">
            </form>
            <?php
                if($_SERVER['REQUEST_METHOD']=="POST")
                {
                    
                    if(isset($_POST['submit']))
                    {
                        require_once 'config.php';
                        $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
                        $que="SELECT max(eno) FROM agent";
                        $result=mysqli_query($db,$que);
                        $eno=$_SESSION['id'];
                        $quer="insert into agent values($eno,'".$_POST['name']."','".$_POST['dob']."','".$_POST['gender']."','".$_POST['phone']."',".$_POST['branchno'].");";
                        $resul= mysqli_query($db,$quer);
                        if(!$resul)
                        {
                            mysqli_errno($db);
                            echo "could not add dataset";
                        }
                        else
                        {
                            header('location:agentmenu.php');
                        }
                        
                    }
                }
            ?>
            </div>
    </body>
</html>
<?php
}
else
{
    header('location:agentmenu.php');
}
}
else
{
    header('location:login.php');
}
?>