<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="agent")
{
    require_once 'config.php';
    $db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            agent progress
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
            <li><a href="agentpersonal.php">INFO</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea" style="width:50%;">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >TOTAL PROGRESS</div></li>
                    <li id="two"><div onclick="bbbb()">CUSTOMER WISE</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <?php
                        $query="select sum(p.mat_val), sum(p.ins_prem), sum(p.ins_prem * p.mat_period) from customer c, agent a, policy p where c.policy_no=p.policy_no and a.eno=c.eno and a.eno=".$_SESSION['id'].";";
                        $result=mysqli_query($db,$query);
                        $r=mysqli_fetch_array($result);
                        if($r[0]!=NULL)
                        {
                            echo "<h2>TOTAL PROGRESS</h2><br>";
                            echo "Total Maturity Value: Rs.".$r[0];
                            echo "<br><br>Total premium per month: Rs.".$r[1];
                            echo "<br><br>Total premium: Rs.".$r[2];
                            $a=$r[2];
                            $b=$r[0];
                            $c=$a-$b;
                            echo "<br><br>Total profit to the company: Rs. $c";
                        }
                        else
                        {
                            echo "<h2>NO CUSTOMERS</h2>";
                        }
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <?php
                        $query1="select c.name, c.phone, p.mat_val, p.ins_prem, p.mat_period, c.startdate from customer c, agent a, policy p where c.policy_no=p.policy_no and a.eno=c.eno and a.eno=".$_SESSION['id'].";";
                        $result1= mysqli_query($db, $query1);
                        if(mysqli_num_rows($result1)>0)
                        {
                            echo "<h2>CUSTOMER WISE</h2><br>";
                            echo "<table> <tr><th>name</th><th>phone</th><th>start<br>date</th><th>maturity<br>value</th><th>insurance<br>premium</th><th>maturity<br>period</th><th>Total<br>Profit</th></tr>";
                            while($i=mysqli_fetch_array($result1))
                            {
                                $pro=($i[3]*$i[4])-$i[2];
                                echo "<tr><td>".$i[0]."</td>"."<td>".$i[1]."</td>"."<td>".$i[5]."</td>"."<td>".$i[2]."</td>"."<td>".$i[3]."</td>"."<td>".$i[4]."</td>"."<td>$pro</td></tr>";
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