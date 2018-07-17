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
            analytics
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
            <li><a href="progress.php">PROGRESS</a></li>
            <li><a href="policy.php">POLICY</a></li>
            <li><a href="branch.php">BRANCH</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >BEST POLICY</div></li>
                    <li id="two"><div onclick="bbbb()">BRANCH WISE</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <h2>BEST POLICY</h2>
                    <br>
                    <br>
                    <?php
                        $query="select p.mat_val, p.ins_prem, p.ins_prem * p.mat_period as abcd , p.mat_period , max(p.policy_no) from customer c, policy p where c.policy_no=p.policy_no ;";
                        $result=mysqli_query($db,$query);
                        $r=mysqli_fetch_array($result);
                        echo "Policy No: ".$r[4];
                        echo "<br><br>Maturity Value: Rs.".$r[0];
                        echo "<br><br>premium per month: Rs.".$r[1];
                        echo "<br><br>Total premium: Rs.".$r[2];
                        $a=$r[2];
                        $b=$r[0];
                        $c=$a-$b;
                        echo "<br><br>Profit to the company: Rs. $c<br>";
                    ?>
                    
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <?php
                        $query1="select max(coun) as maxcount , branch_no , policyno , branchl  from ( select count(p.policy_no) as coun , p.policy_no policyno , b.branchno as branch_no, b.location as branchl  from customer c, agent a, policy p, branch b where c.eno=a.eno and p.policy_no=c.policy_no and b.branchno=a.branchno group by b.branchno , p.policy_no) as tt group by branch_no";
                        $result1= mysqli_query($db, $query1);
                        if(mysqli_num_rows($result1)>0)
                        {
                            echo "<h2>MOST SOLD POLICY <br>BRANCH WISE</h2><br>";
                            echo "<table> <tr><th>Branch No</th><th>Location</th><th>No of<br>Customer's</th><th>Policy<r>Number</th></tr>";
                            while($i=mysqli_fetch_array($result1))
                            {
                                echo "<tr><td>".$i[1]."</td>"."<td>".$i[3]."</td>"."<td>".$i[0]."</td>"."<td>".$i[2]."</td>";
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