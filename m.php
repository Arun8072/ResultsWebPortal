<?php
//fri²¹½ sat½ sun½ wed½ fri¼ tue¹½ fri½ 
if(!isset($_GET['RegNo'])){exit(header("Location:index.html"));}

$conn = new  mysqli("localhost", "root", "","Mark");

$r=preg_replace("/[^0-9]/", "",$_GET['RegNo']);
//$n=$_GET['Name'];
//$d=$_GET['dob'];

$sql = "SELECT * FROM Marks where Regno='$r' " ;

$t = $conn->query($sql);
echo '<head><title>Arrear Details</title><meta name="viewport" content="width=device-width, initial-scale=1"></head><style>
@font-face {
 font-family:Montserrat-Regular;
  src: url("Montserrat-Regular.ttf");
}
*{ font-family:Montserrat-Regular; }
@media screen and (orientation: portrait){ #tbl{ display:none; }
article{ align:center;
width:60%;
border: 2px solid #f1f1f1;
border-radius:3px;
padding:10px;
margin:12px; }
div{ font-weight:bold; }
hr{ color: #f1f1f1;
opacity:0.5;
width:70%; }
*{font-size:14px;}
}
@media screen and (orientation: landscape){ #atl{ display:none;} 
th{ background-color:dodgerblue;
color:white; }
tr:nth-child(even){ background-color:#f1f1f1; }
} 
</style>';
echo '<center id="tbl" style="padding-top:10%;">
<table style="text-align:center; ">
  <thead>
  <tr> 
  <th scope="col">Sem1</th> 
  <th scope="col">Sem2</th> 
  <th scope="col">Sem3</th> 
  <th scope="col">Sem4</th> 
  <th scope="col">Sem5</th> 
  <th scope="col">Sem6</th> 
  <th scope="col">Sem7</th> 
  <th scope="col">Sem8</th> 
   </tr>
  </thead> 
 <tbody style="line-height:25px;" >';
 
$r = $t->fetch_assoc();
 //explode the line into array of words identified by comma
 $s1=explode(",",$r["Sem1a"]);
 $s2=explode(",",$r["Sem2a"]);
 $s3=explode(",",$r["Sem3a"]);
 $s4=explode(",",$r["Sem4a"]);
 $s5=explode(",",$r["Sem5a"]); 
 $s6=explode(",",$r["Sem6a"]);
 $s7=explode(",",$r["Sem7a"]);
 $s8=explode(",",$r["Sem8a"]);
for($i=0;$i<6;$i++){
//Capitalize first letter
 echo '<tr>';
echo '<td>'.ucfirst($s1[$i]).'</td>';
echo '<td>'.ucfirst($s2[$i]).'</td>';
echo '<td>'.ucfirst($s3[$i]).'</td>';
echo '<td>'.ucfirst($s4[$i]).'</td>';
echo '<td>'.ucfirst($s5[$i]).'</td>';
echo '<td>'.ucfirst($s6[$i]).'</td>';
echo '<td>'.ucfirst($s7[$i]).'</td>';
echo '<td>'.ucfirst($s8[$i]).'</td>';
  echo '</tr>';
}
 echo '<tr style="text-align:center;">
  <td>'.count($s1).'</td> 
  <td>'.count($s2).'</td> 
  <td>'.count($s3).'</td> 
  <td>'.count($s4).'</td> 
  <td>'.count($s5).'</td> 
  <td>'.count($s6).'</td> 
  <td>'.count($s7).'</td> 
  <td>'.count($s8).'</td> 
   </tr>';
      
echo '</tbody> </table> </center> ';
//following are same content which displayed only on mobile
echo '<center id="atl" >';
$ar=[$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8];
$i=0;
foreach($ar as $ss){
echo '<article><div>Sem'.++$i.'</div><hr>';
foreach($ss as $s){
echo '<section>'.ucfirst($s).'</section>';
}
echo '<section>'.count($ss).'</section></article>';
}
echo '</center>';

echo '<br><br><center> <button style="font-size:20px; border-radius:5px;"> <a style="color:grey; text-decoration:none;" href="d.php">Download Page »</a> </button> </center> <br>';
?>