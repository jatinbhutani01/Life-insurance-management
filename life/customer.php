<!DOCTYPE HTML>
<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['type']==="customer")
{
require_once 'config.php';
$db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
$query="SELECT * FROM customer WHERE cid=".$_SESSION['id'].";";
$result=mysqli_query($db,$query);
if(mysqli_num_rows($result)==0)
{
$query="select max(eno),min(eno) from agent";
$res= mysqli_query($db, $query);
$row= mysqli_fetch_array($res);
$max=$row[0];
$min=$row[1];
$no_nominee=1;
if(isset($_POST['submit']))
{
    if(isset($_POST['submit']))
    {
        $cid=$_SESSION['id'];
        $query1="INSERT INTO customer VALUES($cid,'".$_POST['name']."','".$_POST['phone']."','".$_POST['address']."','".
                $_POST['dob']."',".$_POST['eno'].",".$_POST['policy'].",'".$_POST['startdate']."');";
        $result1= mysqli_query($db, $query1);
        $fail=1;
        if($result1==0)
        {
            echo "unable to add to customer table";
            $fail=0;
        }
        $no=1;
        $name="name$no";
        while(isset($_POST[$name]))
        {
            $dob="dob$no";
            $phone="phone$no";
            $address="address$no";
            $rela="relationship$no";
            $query2="INSERT INTO nominee VALUES($cid,'".$_POST[$name]."','".$_POST[$dob]."','".$_POST[$phone]."','".$_POST[$address]."','".$_POST[$rela]."');";
            $result2=mysqli_query($db, $query2);
            if($result2==0)
            {
                echo "unable to write for ".$no;
                $fail=0;
            }
            
            $no++;
            $name="name$no";
        }
        if($fail)
        {
            header('location:login.php');
            
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="customer.css">
        <link rel="stylesheet" href="register.css">
        <title>
            customer
        </title>
    </head>
    <body>
    <div class="header">
        <div class="logo">
            <span><a href="login.php">#Insurance For Life</a></span>
        </div>
        <ul class="links">
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
        </ul>
    </div>
    <div class="form">
    <h2>
        Add Customer
    </h2
    <br>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label>Name</label><input name="name" type="text" placeholder="Full Name" required>
        <br><br>
        <label>Phone Number</label><input name="phone" type="text" placeholder="phone number" required>
        <br><br>
        <label>Address</label><input name="address" type="text" placeholder="address" required>
        <br><br>
        <label>Date Of Birth</label><input name="dob" type="date" required>
        <br><br>
        <label>Agent's Employee Number</label><input type="number" <?php echo "min=\"$min\" max=\"$max\"";?> name="eno" placeholder="eno">
        <br><br>
        <label>Policy</label><br><br>
        <?php 
        $que="select * from policy";
        $result= mysqli_query($db, $que);
        if(!empty($result))
        {
            $i=0;
            while($row=mysqli_fetch_array($result))
            {
                if($i==0)
                {
                    echo '<input type="radio" name="policy" value="'.$row[0].'" checked="checked">';
                    $i=1;
                }
                else
                {
                    echo '<input type="radio" name="policy" value="'.$row[0].'">';
                }
                echo "Maturity value=Rs.".$row[1]."<br>Insurance Premium=Rs.".$row[2]."<br>Maturity Period=".$row[3]." months<br><br>";
            }
        }
        else
        {
            echo "no policy available";
        }
        ?>
        <br>
        <br>
        <label>Policy Start Date</label><input type="date" name="startdate" required>
        <br>
        <br>
        <h3>Nominee 1:-</h3>
        <label>Name</label><input type="text" name="name1" placeholder="name" required>
        <br><br>
        <label>Date of birth</label><input type="date" name="dob1" required>
        <br><br>
        <label>Phone no</label><input type="text" name="phone1" placeholder="Phone Number" required>
        <br><br>
        <label>Address</label><input type="text" name="address1" placeholder="address" required>
        <br><br>
        <label>Relationship</label><input type="text" name="relationship1" placeholder="relationship" required>
        <br>
        <div id="nominee">
        </div>
        <script>
        var no=1;
        function addnominee(){
            no++;
            var text="<br><br><h3>Nominee "+no+":-</h3>"+
            "<label>Name</label><input type=\"text\" name=\"name"+no+"\" placeholder=\"name\" required>"
            +"<br><br>"
            +"<label>Date of birth</label><input type=\"date\" name=\"dob"+no+"\" required>"
            +"<br><br>"
            +"<label>Phone no</label><input type=\"text\" name=\"phone"+no+"\" placeholder=\"Phone Number\" required>"
            +"<br><br>"
            +"<label>Address</label><input type=\"text\" name=\"address"+no+"\" placeholder=\"address\" required>"
            +"<br><br>"
            +"<label>Relationship</label><input type=\"text\" name=\"relationship"+no+"\" placeholder=\"relationship\" required>"
            +"<br>";
            var node=document.createElement('div');
            node.id="node"+no;
            node.innerHTML=text;
            document.getElementById('nominee').appendChild(node);
        }
        </script>
        <br>
        <br>
        <span onclick="addnominee()" id="nominee-add-id">+Add Nominee</span>
        <br>
        <br>
        <input type="submit" value="REGISTER" name="submit" >
    </form>

    </div>
    </body>
</html>
<?php
}
else
{
    header('location:customermenu.php');
}
}
else
{
    header('location:login.php');
}
?>
