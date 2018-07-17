<?php
session_start();
if(isset($_SESSION['username']))
{
    header('location:login.php');
}
 else 
 {?>
<html>
    <head>
        <title>
            sign up
        </title>
        <link type="text/css" rel="stylesheet" href="header.css">
        <link type="text/css" rel="stylesheet" href="signup.css">
    </head>
    <body>
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="login.php">#Insurance For Life</a></span>
            </div>
            <ul class="links">
                <li><a href="login.php">LOG IN</a></li>
                
                <li><a href="about.php">ABOUT</a></li>
            </ul>
        </div>
        </header>
        <div >
        <div class="form">
            <h2>SIGN UP</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label>User Name</label><input type="text" name="username" placeholder="username" required>
                <br><br>
                <label>Password</label><input type="password" name="pass" placeholder="password" required>
                <br><br>
                <label>Confirm Password</label><input type="password" name="pass1" placeholder="password" required>
                <br><br>
                <label>Type of account</label><select name="type">
                    <option value="customer">Customer</option>
                    <option value="agent">Agent</option>
                </select>
                <br><br>
                <input type="submit" name="submit" value="SIGN UP">
            </form>
        </div>
            <?php
            if(isset($_POST['submit']))
            {
                if($_POST['pass']===$_POST['pass'])
                {
                    require_once 'config.php';
                    $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
                    
                    $query="SELECT username FROM userinfo WHERE username='".$_POST['username']."';";
                    $result=mysqli_query($db,$query);
                    if(mysqli_num_rows($result)==0)
                    {
                        $quer="SELECT max(id) FROM userinfo WHERE type='".$_POST['type']."';";
                        $resul=mysqli_query($db, $quer);
                        $id=0;
                        if(mysqli_num_rows($resul)!=0)
                        {
                            $row=mysqli_fetch_array($resul);
                            echo "$row[0]";
                            $id=$row[0];
                        }
                        $id++;
                        echo "$id";
                        $q="INSERT INTO userinfo VALUES('".$_POST['username']."','".$_POST['pass']."','".$_POST['type']."',$id);";
                        $r=mysqli_query($db,$q);
                        if($r!=0)
                        {
                            $_SESSION['username']=$_POST['username'];
                            $_SESSION['type']=$_POST['type'];
                            $_SESSION['id']=$id;
                            if($_SESSION['type']==="customer")
                            {
                                header('location:customer.php');
                            }
                            else if($_SESSION['type']=="agent")
                            {
                                header('location:agent.php');
                            }
                        }
                        mysqli_errno($db);
                    }
                    else
                    {
                        echo "Username already taken";
                    }
                    
                }
                else
                {
                    echo "password do not match";
                }
            }
            ?>
        </div>
        
    </body>
</html>
<?php
 }
?>
