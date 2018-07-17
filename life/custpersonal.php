<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="customer")
{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            customers information
        </title>
        <link rel="stylesheet" href="drop.css">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="table.css">
    </head>
    <body>
        <div class="header">
        <div class="logo">
            <span><a href="login.php">#Insurance For Life</a></span>
        </div>
        <ul class="links">
            <li><a href="customermenu.php">MENU</a></li>
            <li><a href="custagent.php">AGENT</a></li>
            <li><a href="custupdate.php">UPDATE</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >PERSONAL INFO</div></li>
                    <li id="two" ><div  onclick="bbbb()">POLICY</div></li>
                    <li id="three"><div onclick="cccc()">DEPENDANTS</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <h2>PERSONAL INFO</h2>
                    <br>
                    <br>
                    <?php
                        require_once 'config.php';
                        $db= mysqli_connect($dbhost,$dbuser,$dbpassword,$database);
                        $query="SELECT * FROM customer where cid=".$_SESSION['id'].";";
                        $result= mysqli_query($db, $query);
                        $i= mysqli_fetch_assoc($result);
                        echo "Name: ".$i['name']."<br><br>";
                        echo "Phone No: ".$i['phone']."<br><br>";
                        echo "Address: ".$i['address']."<br><br>";
                        echo "DOB: ".$i['dob']."<br><br>";
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <h2>CURRENT POLICY</h2>
                    <br><br>
                    <?php
                        $quer="select p.policy_no, p.mat_val, p.ins_prem, p.mat_period from policy p, customer c where p.policy_no=c.policy_no and exists (select co.policy_no from customer co where c.cid=co.cid and co.cid=".$_SESSION['id'].");";
                        $res= mysqli_query($db, $quer);
                        $r=mysqli_fetch_array($res);
                        echo "Maturity Value: ".$r[1];
                        echo "<br><br>Insurance Premium: ".$r[2];
                        echo "<br><br>Maturity Period: ".$r[3];
                        echo "<br><br>Policy start date: ".$i['startdate']."<br><br>";
                    ?>
                </div>
                <div class="inner" style="display:none;" id="cccc">
                    <?php
                        $que="select * from nominee where cid=".$i['cid'].";";
                        $re= mysqli_query($db, $que);
                        if(mysqli_num_rows($re)>0)
                        {
                        echo "<h2>NOMINEE'S</h2><br><br>";
                        echo "<table><tr>"
                        . "<th>Name</th>"
                        . "<th>Phone No</th>"
                        . "<th>Relationship</th>"
                        . "<th>Date Of Birth</th>"
                        . "</tr>";
                        while($n= mysqli_fetch_assoc($re))
                        {
                            echo "<tr><td>".$n['name']."</td><td>".$n['phone']."</td><td>".$n['relationship']."</td><td>".$n['dob']."</td></tr>";
                        }
                        echo "</table><br>";
                        }
                        else
                        {
                            echo "<h2> NO NOMINEE'S <h2><br><br>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var add= document.getElementById("aaaa");
            var view= document.getElementById("bbbb");
            var remove= document.getElementById("cccc");
            var one=document.getElementById("one");
            var two=document.getElementById("two");
            var three=document.getElementById("three");
            function aaaa()
            {
                add.style.display="block";
                view.style.display="none";
                remove.style.display="none";
                one.style.border="2px solid black";
                two.style.border="none";
                three.style.border="none";
            }
            function bbbb()
            {
                add.style.display="none";
                view.style.display="block";
                remove.style.display="none";
                one.style.border="none";
                two.style.border="2px solid black";
                three.style.border="none";
            }
            function cccc()
            {
                add.style.display="none";
                view.style.display="none";
                remove.style.display="block";
                one.style.border="none";
                two.style.border="none";
                three.style.border="2px solid black";
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