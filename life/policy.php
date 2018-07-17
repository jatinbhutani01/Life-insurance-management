<?php
session_start();
if($_SESSION['type']=="dba")
{
    if(isset($_POST['submit']))
    {
        require_once 'config.php';
        $db=mysqli_connect('localhost','root','','life');
        $que="SELECT max(policy_no) from policy";
        $res=mysqli_query($db,$que);
        $policy=0;
        if(!empty($res))
        {
            $row=mysqli_fetch_array($res);
            $policy=$row[0];
        }
        $policy++;
        $query="INSERT INTO policy VALUES($policy,".$_POST['mat_val'].",".$_POST['ins_prem'].",".$_POST['mat_period'].");";
        $result=mysqli_query($db,$query);
    }
?>
<html>
    <head>
        <title>policy</title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="droptwo.css">
        <link rel="stylesheet" href="table.css">
    </head>
    <body>
        
        <header>
        <div class="header">
            <div class="logo">
                <span><a href="login.php">#Insurance For Life</a></span>
            </div>
            <ul class="links"> 
                <li><a href="dba.php">MENU</a></li>
                <li><a href="progress.php">PROGRESS</a></li>
                <li><a href="analytics.php">ANALYTICS</a></li>
                <li><a href="branch.php">BRANCHES</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="logout.php">LOG OUT</a></li>
            </ul>
        </div>
        </header>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >ADD POLICY</div></li>
                    <li id="two"> <div onclick="bbbb()" >VIEW POLICY</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" > 
                    <h2>ADD POLICY</h2>
                    <br>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <label>Maturity Value:</label><input type="number" placeholder="maturity value" name="mat_val" required>
                        <br>
                        <br>
                        <label>Insurance Premium:</label><input type="number" placeholder="insurance premium" name="ins_prem" required>
                        <br>
                        <br>
                        <label>Maturity Period(in month's):</label><input type="number" placeholder="maturity period" name="mat_period" required>
                        <br>
                        <br>
                        <input type="submit" name="submit" value="SUBMIT">
                    </form>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <?php
                    require_once 'config.php';
                    $db=mysqli_connect('localhost','root','','life');
                    $quer="select * from policy";
                    $r=mysqli_query($db,$quer);
                    if(!empty($r))
                    {
                        echo "<h2>CURRENT POLICY</h2><br>";
                        echo "<table>";
                        echo "<tr><th>Sl no.</th><th>Maturity<br>Value</th><th>Insurance<br>Premium</th><th>Maturity<br>Period</th></tr>";
                        while($ro=mysqli_fetch_array($r))
                        {
                            echo "<tr><td>$ro[0]</td><td>$ro[1]</td><td>$ro[2]</td><td>$ro[3]</td></tr>";
                        }
                        echo "</table>";
                    }
                    else
                    {
                        echo "no policy available";
                    }
                    ?>
                </div>
                <div class="inner" style="display:none;" id="remove"> 
                    
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