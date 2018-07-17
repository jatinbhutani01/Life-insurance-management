<?php
session_start();
if(isset($_SESSION['type']) &&$_SESSION['type']=="agent")
{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            agent's information
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
            <li><a href="agentupdate.php">UPDATE</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
        </div>
        <div class="workarea" >
            <div class="toggle">
                <ul>
                    <li style="border:2px solid black;" id="one"><div onclick="aaaa()" >PERSONAL INFO</div></li>
                    <li id="two" ><div  onclick="bbbb()">EMPLOYMENT INFO</div></li>
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
                        $query="SELECT * FROM agent where eno=".$_SESSION['id'].";";
                        $result= mysqli_query($db, $query);
                        $i= mysqli_fetch_assoc($result);
                        echo "Name: ".$i['name']."<br><br>";
                        echo "ENO: ".$i['branchno']."<br><br>";
                        echo "Phone No: ".$i['phone']."<br><br>";
                        echo "DOB: ".$i['dob']."<br><br>";
                    ?>
                </div>
                <div class="inner" style="display:none;" id="bbbb">
                    <h2>EMPLOYMENT INFO</h2>
                    <br>
                    <br>
                    <?php
                        $query1="select * from branch where branchno=".$i['branchno'].";";
                        $result1= mysqli_query($db, $query1);
                        $r= mysqli_fetch_array($result1);
                        echo "Branch No: ".$r[0]."<br><br>";
                        echo "Branch Location: ".$r[1]."<br><br>";
                        echo "ENO: ".$i['branchno']."<br><br>";
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