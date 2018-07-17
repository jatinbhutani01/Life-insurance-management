<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="dba")
{
    require_once 'config.php';
    $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            progress
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
            <li><a href="analytics.php">ANALYTICS</a></li>
            <li><a href="policy.php">POLICY</a></li>
            <li><a href="branch.php">BRANCH</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >TOTAL PROGRESS</div></li>
                    <li id="two"><div onclick="bbbb()">BRANCH PROFIT</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <h2>TOTAL PROGRESS</h2>
                    <br>
                    <br>
                    <?php
                        $query="select sum(p.mat_val), sum(p.ins_prem), sum(p.ins_prem * p.mat_period) from customer c, policy p where c.policy_no=p.policy_no ;";
                        $result=mysqli_query($db,$query);
                        $r=mysqli_fetch_array($result);
                        echo "Total Maturity Value: Rs.".$r[0];
                        echo "<br><br>Total premium per month: Rs.".$r[1];
                        echo "<br><br>Total premium: Rs.".$r[2];
                        $a=$r[2];
                        $b=$r[0];
                        $c=$a-$b;
                        echo "<br><br>Total profit to the company: Rs. $c<br>";
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <?php
                        $query1="select b.branchno , b.location , count(c.cid) , sum(p.mat_val) ,sum(p.mat_period * p.ins_prem) from customer c , agent a , branch b , policy p where b.branchno=a.branchno and a.eno=c.eno and p.policy_no=c.policy_no group by b.branchno;";
                        $result1= mysqli_query($db, $query1);
                        if(mysqli_num_rows($result1)>0)
                        {
                            echo "<h2>BRANCH PROFIT</h2><br><br>";
                            echo "<table> <tr><th>Branch No</th><th>Location</th><th>No of<br>Customer's</th><th>Total<br>Profit</th></tr>";
                            while($i=mysqli_fetch_array($result1))
                            {
                                $pro=($i[4]-$i[3]);
                                echo "<tr><td>".$i[0]."</td>"."<td>".$i[1]."</td>"."<td>".$i[2]."</td>"."<td>$pro</td></tr>";
                            }
                            echo "</table>";
                        }
                        else
                        {
                            echo "<h2>NO CUSTOMERS</h2>";
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
else
{
    header('location:login.php');
}
?>