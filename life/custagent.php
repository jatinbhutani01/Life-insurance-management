<?php
session_start();
if(isset($_SESSION['type']) && $_SESSION['type']=="customer")
{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            customer's agent
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
            <li><a href="customermenu.php">MENU</a></li>
            <li><a href="custpersonal.php">INFO</a></li>
            <li><a href="custupdate.php">UPDATE</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea">
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >AGENT INFO</div></li>
                    <li id="two" ><div  onclick="bbbb()">BRANCH</div></li>
                </ul>
            </div>
            <div class="texarea" style="padding-top: 10px;align-content: center;">
                <div class="inner"  id="aaaa" >
                    <h2>AGENTS INFO</h2>
                    <br>
                    <br>
                    <?php
                        require_once 'config.php';
                        $db= mysqli_connect($dbhost,$dbuser,$dbpassword,$database);
                        $query="SELECT a.eno, a.name, a.dob, a.gender, a.phone, a.branchno FROM agent a,customer c where a.eno=c.eno and c.cid=".$_SESSION['id'].";";
                        $result= mysqli_query($db, $query);
                        $i=mysqli_fetch_array($result);
                        echo "ENO: ".$i[0];
                        echo "<br><br>name: ".$i[1];
                        echo "<br><br>DOB: ".$i[2];
                        echo "<br><br>Phone Number: ".$i[4];
                        echo "<br><br>gender: ".$i[3];
                        echo "<br>";
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <h2>BRANCH POLICY</h2>
                    <br><br>
                    <?php
                        $qu="select a.eno,a.name,b.branchno,b.location from customer c , agent a ,branch b where c.eno=a.eno and b.branchno=a.branchno and c.cid=".$_SESSION['id'].";";
                        $res= mysqli_query($db, $qu);
                        $r= mysqli_fetch_array($res);
                        echo "Branch Number: ".$r[2];
                        echo "<br><br>Branch Location: ".$r[3];
                        echo "<br><br>Handeling agents eno:".$r[0];
                        echo "<br><br>Handeling agents name:".$r[1];
                        echo "<br>";
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