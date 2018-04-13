<?php
require_once 'dbconfig.php';


$date = isset($_GET['date']) ? $_GET['date'] : date('d/m/Y'); 
$date = str_replace('/', '-', $date);

$prev_date = date('d/m/Y', strtotime($date .' -1 day'));
$next_date = date('d/m/Y', strtotime($date .' +1 day')); 
$current_date = date('d/m/Y', strtotime($date));
$current_day = date('l - F jS Y', strtotime($date));
$html.='';
$html.='
<html>
<head>
<style>
.marginbottom20 {
	width: 20%;
	float: left;
	margin: 0 10px;
}
.jobcontentbox {
	border-radius: 5px;
	border: 1px solid #ddd;
	padding: 10px;
	position: relative;
}
.equinamesection {
	padding: 10px;
	border: 1px solid #ddd;
	border-radius: 5px;
	font-weight: bold;
	background: #f0f0f0;
}
.clear {
	clear: both;
}
</style>
</head>
<body>
<div id="container">
  <h2>Current Day Jobs</h2>';
   
 
 $totaljob = 0;
$i = 0;
$eu = 0;
 
 
 
    $equipments = $equipment->getequipmentlist();

 foreach($equipments as $equipment){
    

   
    if($eu%6==0){ echo '<div class="clearfix"></div>'; } if($eu%9==0){ echo '<div class="clearfix"></div>'; } $eu++;  
 $html .='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 marginbottom20">
    <div class="equinamesection text-center">'.$equipment['equi_name'].' 
	</div>';
     
$jobsbycranetypes =  $job->getjobbycranetypelist($equipment['equi_id'],$current_date); 
if(is_array($jobsbycranetypes)){
	foreach($jobsbycranetypes as $jobdetail){
		
		if($equipment['equi_id'] == 7){ $totaljob = $i; } else {
		
		$i++;
		
		$totaljob = $i;
		}
		
$customers = $customer->customerdata($jobdetail['job_clie_id']);

$editby = $jobdetail['job_completedby'];

$contactdata = $customer->gecontactdata($jobdetail['job_cont_name']);


   $html.=' <div class="jobcontentbox clearfix">
      <div><b>Client:</b>
        '.$customers['cust_name'].'
      </div>
      <div><b>Time:</b>'.$jobdetail['job_time'].'</div>
      <div><b>Address:</b>'.substr($jobdetail['job_address'], 0,18).'</div>
      <div><b>Crane Type:</b>'.$jobdetail['job_equi_size'].'</div>
      <div><b>Contact:</b>'.$contactdata['cont_name'].'</div>
      <div><b>Details:</b>'.substr($jobdetail['job_detail'], 0, 18).'...</div>
    </div>';
     }
 		} else { 
    $html.='<div class="jobcontentbox clearfix">
      <div>No Data Available</div>
    </div>';
     } 
  $html.='</div>';
   } 
  $html.='<div class="clear">
    <h2>Next Day Jobs</h2>';
   
 
 $totaljob = 0;
$i = 0;
$eus = 0;
 
 
 
    //$equipments = $equipment->getequipmentlist();

 foreach($equipments as $equipment){
    

   
    if($eus%6==0){ echo '<div class="clearfix"></div>'; } if($eus%9==0){ echo '<div class="clearfix"></div>'; } $eus++; 
    $html.='<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 marginbottom20">
      <div class="equinamesection text-center">'.$equipment['equi_name'].'</div>';
       
$jobsbycranetypes =  $job->getjobbycranetypelist($equipment['equi_id'],$next_date); 
if(is_array($jobsbycranetypes)){
	foreach($jobsbycranetypes as $jobdetail){
		
		if($equipment['equi_id'] == 7){ $totaljob = $i; } else {
		
		$i++;
		
		$totaljob = $i;
		}
		
$customers = $customer->customerdata($jobdetail['job_clie_id']);

$editby = $jobdetail['job_completedby'];

$contactdata = $customer->gecontactdata($jobdetail['job_cont_name']);


      $html.='<div class="jobcontentbox clearfix">
        <div><b>Client:</b>
          '.$customers['cust_name'].'
        </div>
        <div><b>Time:</b>'.$jobdetail['job_time'].'</div>
        <div><b>Address:</b>'.substr($jobdetail['job_address'], 0,18).'...</div>
        <div><b>Crane Type:</b>'.$jobdetail['job_equi_size'].'</div>
        <div><b>Contact:</b>'.$contactdata['cont_name'].'</div>
        <div><b>Details:</b>'.substr($jobdetail['job_detail'], 0, 18).'...</div>
      </div>';
       }

 } else { 
     $html.=' <div class="jobcontentbox clearfix">
        <div>No Data Available</div>
      </div>';
       } 
    $html.='</div>';
     } 
  $html.='</div>
</div>
</body>
</html>';


include("mpdf.php");

$mpdf=new mPDF(); 

$mpdf->SetDisplayMode('fullpage');

//$mpdf->WriteHTML($html);
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
//$json = json_decode(file_get_contents('http://ablworks.com.au/testelsjobs/cron_dashboard.php'));

//print_r($json); 
$mpdf->WriteHTML($html);

//$filename= home_base_directory()."/pdfs/asd.pdf";
$mpdf->Output();
//$mpdf->Output(); 

exit;



?>