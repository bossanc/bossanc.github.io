<?php

session_start();
include("connect.php");
if (!isset($_SESSION[user])) {
     header("Location: login.php"); 
     exit;
}
	$stat = mysqli_query($conn,"SELECT* FROM status");
	$status = mysqli_fetch_array($stat);
	$userpass = $_SESSION[user];
 	$sid = $userpass[0];
	$password = $userpass[1]; 
	
	$semnow = $status['semnow'];
	$yearnow = $status['yearnow'];	
	
	$studentfacsql = "SELECT DISTINCT fac_name FROM student INNER JOIN faculty ON student.fac_ID = faculty.fac_ID  WHERE student.stu_id = $userpass[0]";
$facname = mysqli_query($conn,$studentfacsql);
$facname2 = mysqli_fetch_array($facname);
	
define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{
	function Header(){
		$this->SetFont('Arial','I',8);
 		$this->Text(10,10,'datareg.zz.vc' );
 		$this->Ln(10);
	}
}

$pdf=new PDF();

$pdf->SetAuthor( 'datareg.zz.vc' );
$pdf->SetCreator( 'cscu' );
$pdf->SetDisplayMode( 'fullwidth' , 'single' );
$pdf->SetTitle( 'datareg' );


	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',20);
	$pdf->Cell(0,10,'Withdraw yeah yeah !',0,1,"C");
	$pdf->Cell(0,10,'bah',0,1,"C");
	$pdf->Cell(0,10,'Name : '.$userpass[1],0,1);
	$pdf->Cell(0,10,'Faculty : '.$facname2[0],0,1);
	$pdf->Cell(0,10,'College year : '.$userpass[9],0,1);
	$pdf->Cell(0,10,'Mobile No. : '.$userpass[4],0,1);
	$pdf->Cell(0,10,iconv( 'UTF-8','TIS-620','Address : '.$userpass[3]),0,1);
	
	$pdf->Output();
	


?>

