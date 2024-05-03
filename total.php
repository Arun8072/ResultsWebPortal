<?php
if(!isset($_POST['Reg'])){exit(header("Location:index.html"));}

$conn = new  mysqli("localhost", "root", "","Mark");

$r=preg_replace('/[^0-9]/', '', $_POST['Reg']);
$n=preg_replace('/[^A-z.\s]/', '', $_POST['Name']);
//$d=$_POST['dob'];

$sql = "SELECT Total FROM Marks where Regno='$r' and Name='$n' " ;

$t = $conn->query($sql);

echo '<head><title>Total Arrear Count</title><link rel="icon" type="image/png" href="files/favicon.ico"><meta name="viewport" content="width=device-width, initial-scale=1"></head><style>
@font-face {
 font-family:Montserrat-Regular;
  src: url("Montserrat-Regular.ttf");
}
*{font-family:Montserrat-Regular;}
</style>';

if($row = $t->fetch_assoc()){
 echo '<center style="padding:18%;"><span style="line-height:1px;"><p style="font-size:55px; width:20%;">'.$row["Total"].'</p><p style="font-size:35px;width:25%;">Total</p></span><br><br><form action="marks.php" method="GET"><button name="RegNo" type="submit" value="'.$r.'" style="font-size:30px; border-radius:5px;">Details</button></form></center>';
}else{
echo "Invalid";
}

?>