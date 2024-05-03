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
  
 $s1=explode(",",$r["Sem1"]);
 $s2=explode(",",$r["Sem2"]);
 $s3=explode(",",$r["Sem3"]);
 $s4=explode(",",$r["Sem4"]);
 $s5=explode(",",$r["Sem5"]); 
 $s6=explode(",",$r["Sem6"]);
 $s7=explode(",",$r["Sem7"]);
 $s8=explode(",",$r["Sem8"]);



$ar=[$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8];

for($j=0;$j<count($ar);$j++) {
   $total_count[$j]=count($ar[$j]);
   $max_count=max($total_count);
 }


 //error forloop ,loop according to count, definit it as 6 makes error ,use foreach 
for($i=0;$i<$max_count;$i++){
  //ucfirst - Capitalize first letter
  // check if variable is empty and display otherwise it makes error
echo '<tr>';
echo '<td>';  if (!empty($s1[$i])) { echo ucfirst($s1[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s2[$i])) { echo ucfirst($s2[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s3[$i])) { echo ucfirst($s3[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s4[$i])) { echo ucfirst($s4[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s5[$i])) { echo ucfirst($s5[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s6[$i])) { echo ucfirst($s6[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s7[$i])) { echo ucfirst($s7[$i]); }else{ echo "-"; } echo '</td>';
echo '<td>';  if (!empty($s8[$i])) { echo ucfirst($s8[$i]); }else{ echo "-"; } echo '</td>';
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
 echo "";
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

 $reg=$_GET["RegNo"];
echo '<br><br><center> <button style="font-size:20px; border-radius:5px;"> <a style="color:grey; text-decoration:none;" href="create_pdf.php?RegNo='.$reg.'">Download Page »</a> </button> </center> <br>';
?>


