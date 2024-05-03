<?php
require('fpdf186/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}



// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(123,126,129);
    $this->SetTextColor(255);
    $this->SetDrawColor(162,166,170);
    $this->SetLineWidth(.5);
    $this->SetFont('','B',16);  //font,bold,size
    // Header
    $width = array(30,40,90, 30 );
    for($i=0;$i<count($header);$i++)
        $this->Cell($width[$i],10,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(222,228,233);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;

    foreach($data as $row){
        $text = $row[2];    // or $yourtext;
        $maxPos = 37;           // Max. number of characters
if (strlen($text) > $maxPos){
    $lastPos = ($maxPos - 3) - strlen($text);
    $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '...'; }

        $this->Cell($width[0],10,$row[0],'LR',0,'L',$fill);
        $this->Cell($width[1],10,$row[1],'LR',0,'L',$fill);
        $this->Cell($width[2],10,$text,'LR',0,'L',$fill);
        $this->Cell($width[3],10,$row[3],'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($width),0,'','T');
}
}

$pdf = new PDF('P','mm','A4');
 //Table Header
  $header=["Semester","Subject Code","Subject","Status"];
  //Table Rows
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
["2","MA3251","Engineering Mathematics - II","Pass"],
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
["6","CCS356","Object Oriented Software Engineering","Pass"],
["6","CS3691","Embedded Systems and IoT","Pass"],
["6","CCS351","Modern Cryptography","Pass"],
["7","CCS335","Cloud Computing","Pass"],
["7","GE3791","Human Values and Ethics","Pass"],
["7","GE3754","Human Resource Management","Pass"],
["8","GE3751","Principles of Management","Pass"],
["8","CS3811","Project Work","Pass"]
  ];
$pdf->SetFont('Arial','',14);
$pdf->AddPage();

/*===================================================*/
$conn = new  mysqli("localhost", "root", "","Mark");

$r=preg_replace("/[^0-9]/", "",$_GET['RegNo']);
//$n=$_GET['Name'];
//$d=$_GET['dob'];

$sql = "SELECT * FROM Marks where Regno='$r' " ;

$table = $conn->query($sql);
$row = $table->fetch_assoc();

 $s[0]=explode(",",$row["Sem1"]);
 $s[1]=explode(",",$row["Sem2"]);
 $s[2]=explode(",",$row["Sem3"]);
 $s[3]=explode(",",$row["Sem4"]);
 $s[4]=explode(",",$row["Sem5"]); 
 $s[5]=explode(",",$row["Sem6"]);
 $s[6]=explode(",",$row["Sem7"]);
 $s[7]=explode(",",$row["Sem8"]);

for ($k=0; $k < count($s); $k++) { 
for ($l=0; $l < count($s[$k]); $l++) { 
   //loop runs acoording to the number of subjects in $s
    for ($m=0; $m < count($data); $m++) { 
           //loop runs acoording to the number of subjects in $data
         if ( $s[$k][$l] == $data[$m][1] ) {
           $data[$m][3] ="Arrear";
         } //if
    }//for
} } //nested for
/*===============================================================*/

$reg=$row["Regno"];
$reg_num = "Register Name : {$reg} ";
$name=$row["Name"];
$stud_name="Student Name : {$name}";

$pdf->Cell(0,10,$reg_num,0,1,'C');
$pdf->Cell(0,10,$stud_name,0,1,'C');



$pdf->FancyTable($header,$data);
$pdf->Output();
?>
