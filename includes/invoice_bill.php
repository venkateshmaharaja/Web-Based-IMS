<?php
include_once("../fpdf/fpdf.php");
if($_GET["invoice_date"]){
	$pdf=new FPDF();
	$pdf->Addpage();

	$pdf->SetFont("Arial","B",18);
	$pdf->Cell(190,10,"INVOICE",1,1,"C");
	$pdf->SetFont("Arial","B",16);
	$pdf->Cell(190,10,"SRI VISHNU AGENCIES",1,1,"C");             
	$pdf->SetFont("Arial","B",10);
	$pdf->Cell(190,7,"GST:33AACDEF14571AES  ,  No:33&34 Womes Sector ,  Thirumudivakkam,Chennai-600137 , 9940453368 ",1,1,"C");  


	//$pdf->Cell(190,255,null,1,0,null);
	$pdf->SetFont("Arial","B",14);
	$pdf->Cell(35,20,"INVOICE NO",1,0,"C");             
	$pdf->Cell(35,20,"",1,0,"C");
	$pdf->SetFont("Arial","B",12);            //Line One
	$pdf->Cell(50,10,"CUSTOMER NAME",1,0,"C");
	$pdf->Cell(70,10,$_GET["invoice_date"],1,1,"C");

	
	
	$pdf->SetFont("Arial","B",14);
	$pdf->Cell(35,10,"",0,0,"C");
	$pdf->Cell(35,10,"",0,0,"C");
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(50,10,"ADDRESS LINE 1",1,0,"C");
	$pdf->Cell(70,10,"14A DR.Radhikrishnan street",1,1,"C");

	$pdf->SetFont("Arial","B",14);
	$pdf->Cell(70,20,"DATE : 02-10-1996",1,0,"C");
	$pdf->Cell(50,10,"ADDRESS LINE 2",1,0,"C");
	$pdf->Cell(70,10,"New Perungalathour",1,1,"C");

	$pdf->Cell(70,10,"",0,0,"C");
	$pdf->Cell(50,10,"ADDRESS LINE 3",1,0,"C");
	$pdf->Cell(70,10,"Chennai - 628002",1,0,"C");
	
	$pdf->Output();
}
?>