<?php

function debugCode($r=array(),$f=TRUE){
	echo "<pre>";
	print_r($r);
	echo "</pre>";
	
	if($f==TRUE)
		die;
}

function myNum($num=0,$curr=""){
	$curr2 = strtolower($curr);
	if($curr2=="rp"){
		return number_format($num,0,",",".");
	}elseif($curr2=="$" || $curr2=="e"){
		return number_format($num,0,".",",")." ".$curr;
	}else{
		return number_format($num,0,",",".");
	}
}

function myDate($dt,$f="d/m/Y H:i",$s=true){
	$day = array(
		1 => "Senin",
		2 => "Selasa",
		3 => "Rabu",
		4 => "Kamis",
		5 => "Jumat",
		6 => "Sabtu",
		7 => "Minggu"
	);
	if(trim($dt)!="0000-00-00" && trim($dt)!=""){
		$ts = strtotime($dt);
		$dtm = date($f,$ts);
		if( trim($dtm) == "01/01/1970" ){
			return "-";
		}else{
			return $dtm;
		}
	}else{
		return "-";
	}
}
?>