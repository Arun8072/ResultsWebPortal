

<html>
<?php
//fri²¹½ sat½ sun½ wed½ fri¼ tue¹½ fri½ 
if(!isset($_GET['RegNo'])){exit(header("Location:index.html"));}

$conn = new  mysqli("localhost", "root", "","Mark");

$r=preg_replace("/[^0-9]/", "",$_GET['RegNo']);
//$n=$_GET['Name'];
//$d=$_GET['dob'];

$sql = "SELECT * FROM Marks where Regno='$r' " ;

$t = $conn->query($sql);

echo '<head><title>Arrear Details</title><link rel="icon" type="image/png" href="files/favicon.ico"><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
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
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 350%;  
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 50%;
  margin-left: -60px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 20%;  
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent black transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style></head>';
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
echo '<td class="tooltip">'; 
if (!empty($s1[$i])) { echo ucfirst($s1[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s2[$i])) { echo ucfirst($s2[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s3[$i])) { echo ucfirst($s3[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s4[$i])) { echo ucfirst($s4[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s5[$i])) { echo ucfirst($s5[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s6[$i])) { echo ucfirst($s6[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s7[$i])) { echo ucfirst($s7[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '<td class="tooltip">'; 
if (!empty($s8[$i])) { echo ucfirst($s8[$i]).'<span class="tooltiptext">Subject</span>'; }else{ echo "-"; } 
echo '</td>';
echo '</tr>';
}


 echo '<tr style="text-align:center;">';
  if($s1[0]){ echo '<td>'.count($s1).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s2[0]){ echo '<td>'.count($s2).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s3[0]){ echo '<td>'.count($s3).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s4[0]){ echo '<td>'.count($s4).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s5[0]){ echo '<td>'.count($s5).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s6[0]){ echo '<td>'.count($s6).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s7[0]){ echo '<td>'.count($s7).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
  if($s8[0]){ echo '<td>'.count($s8).'</td>' ; }else{ echo '<td>'."0".'</td>' ; }
 echo ' </tr>';

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


<script type="text/javascript">
  $data=[
["1","HS3152","Professional English - I","Pass"],
["1","MA3151","Matrices  and  Calculus","Pass"],
["1","PH3151","Engineering Physics","Pass"],
["1","CY3151","Engineering Chemistry","Pass"],
["1","GE3151","Problem Solving and Python Programming","Pass"],
["1","GE3171","Problem Solving and Python Programming Laboratory","Pass"],
["1","BS3171","Physics and Chemistry Laboratory","Pass"],
["1","GE3172","English Laboratory","Pass"],
["2","HS3252","Professional English - II","Pass"],
["2","MA3251","Statistics and Numerical Methods","Pass"],
["2","PH3256","Physics for Information Science","Pass"],
["2","BE3251","Basic Electrical and Electronics Engineering","Pass"], 
["2","GE3251","Engineering Graphics","Pass"],
["2","CS3251","Programming in C","Pass"],
["2","GE3271","Engineering Practices Laboratory","Pass"],
["2","CS3271","Programming in C Laboratory","Pass"],
["2","GE3272","Communication Laboratory","Pass"],
["3","MA3354","Discrete Mathematics","Pass"],
["3","CS3351","Digital Principles and Computer Organization","Pass"],
["3","CS3352","Foundations of Data Science","Pass"],
["3","CS3301","Data Structures","Pass"],
["3","CS3391","Object Oriented Programming","Pass"], 
["3","CS3311","Data Structures Laboratory","Pass"],
["3","CS3381","Object Oriented Programming Laboratory","Pass"],
["3","CS3361","Data Science Laboratory","Pass"],
["3","GE3361","Professional Development","Pass"],
["4","CS3452","Theory of Computation","Pass"],
["4","CS3491","Artificial Intelligence and Machine Learning","Pass"],
["4","CS3492","Database Management Systems","Pass"],
["4","CS3401","Algorithms","Pass"],
["4","CS3451","Introduction to Operating Systems","Pass"],
["4","GE3451","Environmental Sciences and Sustainability","Pass"],
["4","CS3461","Operating Systems Laboratory","Pass"],
["4","CS3481","Database Management Systems Laboratory","Pass"],
["5","CS3591","Computer Networks","Pass"],
["5","CS3501","Compiler Design","Pass"],
["5","CB3491","Cryptography and Cyber Security","Pass"],
["5","CS3551","Distributed Computing","Pass"],
["6","CCS356","Software Engineering","Pass"],
["6","CS3691","Embedded Systems and IoT","Pass"],
["6","CCS351","Modern Cryptography","Pass"],
["7","CCS335","Cloud Computing","Pass"],
["7","GE3791","Human Values and Ethics","Pass"],
["7","GE3754","Human Resource Management","Pass"],
["8","GE3751","Principles of Management","Pass"],
["8","CS3811","Project Work","Pass"]
];
var elem , sub;
            var Element = document.getElementsByClassName("tooltip"); 
            //console.log(Element[0].querySelector("span").innerHTML);
            for (var u = 0; u < Element.length; u++) { 
              for (var v = 0; v < $data.length ; v++) {
                   elem=Element[u].innerText.replace("Subject","").trim().toUpperCase();
                    sub=$data[v][1].trim().toUpperCase();
                 if(elem == sub){
                      console.log(elem);
                      Element[u].querySelector("span").innerHTML=$data[v][2].trim().toUpperCase();
                 }//if
              }//for
                // console.log(Element[u].innerText);
               // console.log(Element[u].querySelector("span").innerHTML);
            } //for
</script>
</html>