<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="dba")
{
    $location="";
    $err="";
    require 'config.php';
    if($_SERVER['REQUEST_METHOD']==="POST")
    {
        if(empty($_POST['location']))
        {
            $err="enter location";

        }
        else
        {
            $db= mysqli_connect($dbhost,$dbuser,$dbpassword,$database) or die("unable to connect");
            echo mysqli_connect_error();
            $max= mysqli_query($db,"SELECT max(branchno) from branch" );
            $row= mysqli_fetch_assoc($max);
            $maxval=$row['max(branchno)'];
            $maxval++;
            $query="INSERT INTO branch(branchno,location) VALUES($maxval,'".$_POST['location']."');";
            $result=mysqli_query($db,$query);
            if($result==0)
            {
                echo "error". mysqli_error($db);
            }
            else
            {
                echo "".$_POST['location']." branch added to the branches of this company";
            }
            mysqli_close($db);

        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            branch
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
            <li><a href="dba.php">MENU</a></li>
            <li><a href="progress.php">PROGRESS</a></li>
            <li><a href="analytics.php">ANALYTICS</a></li>
            <li><a href="policy.php">POLICY</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >ADD BRANCH</div></li>
                    <li id="two" > <div  onclick="bbbb()">VIEW BRANCHES</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" > 
                    <h2>ADD BRANCH</h2>
                    <br>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <label>Location:</label><input type='text' name="location" required>
                        <br><br>
                        <input type="submit" value="SUBMIT">
                    </form>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <?php
                        require_once 'config.php';
                        $db= mysqli_connect($dbhost,$dbuser,$dbpassword,$database);
                        $query="SELECT * FROM branch";
                        $result= mysqli_query($db,$query);
                        if(empty($result))
                        {
                            echo "empty table";
                        }
                        else
                        {
                            echo "<table><tr>"
                            . "<th>Branch Number</th>"
                            . "<th>Location</th></tr>";
                            while($i= mysqli_fetch_assoc($result))
                            {
                                echo "<tr><td> ".$i['branchno']."</td><td>".$i['location']."</td></tr>";
                            }
                            echo "</table>";
                        }
                    ?>
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
    </body>
</html>
<?php 
}
 else {
    header('location:login.php');
}
?>