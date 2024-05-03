<html>
<head><title>Download page</title><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<style> 
@font-face {
 font-family:Montserrat-Regular;
  src: url("Montserrat-Regular.ttf");
}
*{font-family:Montserrat-Regular;}
a{text-decoration:none;
color:dodgerblue; } 
button{ font-size:20px;
border-radius:5px; }
div{ width:60%; }
footer {
  bottom: 0;
  height:10px;
  z-index: -1;
 text-align:center;
 font-size:7px;
line-height:1px;
opacity: 0.5;}
</style>
<body><center><br>
<?php 
$dep=["CSE","ECE","EEE","MECH","CIVIL"];
$yr=["1st year","2nd year","3rd year"," 4th year"];
$cl=["A","B"];
foreach($dep as $d){foreach($yr as $y){foreach($cl as $c){
echo '<div>'.$y.' - '.$d.' - '.$c.'                                 
                                    
<button><a href="files/'.$y.'-'.$d.'-'.$c.'.csv">Download</a></button>
</div><br>';
}}}
?>
</center> </body>
<footer><p>developed by</p><p>doetdd yyghhg ghfhf yukkki</p> </footer>
</html>