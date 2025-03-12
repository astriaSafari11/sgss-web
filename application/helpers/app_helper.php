<?php
function getCI(){
	$CI =& get_instance();
	return $CI; 
}
if(! function_exists('load_view')){
	function load_view($view = "", $data){
		$CI = getCI();
		
		$CI->load->view('_partials/head.php');
		$CI->load->view($view, $data);		
		$CI->load->view('_partials/footer.php');
		
	}
}

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
		return number_format($num,0,".",",");
	}elseif($curr2=="$" || $curr2=="e"){
		return number_format($num,0,".",",")." ".$curr;
	}else{
		return number_format($num,0,".",",");
	}
}

function myCurr($num=0,$curr=""){
	return number_format($num,0,".",",");
}

function myDecimal($num=0,$curr=""){
	return number_format($num,2,",",".");
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
			return ($s)?$day[date("N",$ts)].", ".$dtm:$dtm;
		}
	}else{
		return "-";
	}
}

function mDate($date="",$v="+1 day",$format='Y-m-d'){
	$date 	= (trim($date)=="")?date("Y-m-d"):$date;
	$nd 	=  strtotime(date("Y-m-d", strtotime($date)) . $v);
	return date($format,$nd);
}

function showToast($type="success",$msg=""){	
	switch($type){
		case "success":
			$title = 'Success!';
			$icon = '<i class="fa-solid fa-circle-check" style="margin-right:5px;"></i>';
			$class = "toast-success";
			break;
		case "error":
			$title = 'Error!';
			$icon = '<i class="fa-solid fa-circle-info" style="margin-right:5px;"></i>';
			$class = "toast-danger";
			break;
		case "warning":
			$title = 'Warning!';
			$icon = '<i class="fa-solid fa-triangle-exclamation" style="margin-right:5px;"></i>';
			$class = "toast-warning";
			break;
		case "info":
			$title = 'Information!';
			$icon = '<i class="fa-solid fa-circle-info" style="margin-right:5px;"></i>';
			$class = "toast-primary";
			break;
		default:
			$title = 'Information!';
			$icon = '<i class="fa-solid fa-circle-info" style="margin-right:5px;"></i>';
			$class = "toast-default";
		break;
	}
	echo '
		<div
        	id="toastDefault"
            class="toast '.$class.'"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
        >
        <div class="toast-header">
        	'.$icon.'
            <strong class="me-auto">'.$title.'</strong>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="toast"
            aria-label="Close"
        ></button>
        </div>
        	<div class="toast-body">'.$msg.'</div>
        </div>  	
	';
}


function _encrypt($key=""){
	// $CI =getCI();
	// $CI->load->library('encryption');
	// $CI->encryption->initialize(
	// 	array(
	// 			'cipher' => 'aes-128',
	// 			'mode' => 'ctr',
	// 			'key' => '#$6s5#2025#IDEA'
	// 	)
	// );

	// $encrypt = $CI->encryption->encrypt(trim($key));
	return $key;
}

function _decrypt($key=""){
	// $CI =getCI();
	// $CI->load->library('encryption');
	// $CI->encryption->initialize(
	// 	array(
	// 			'cipher' => 'aes-128',
	// 			'mode' => 'ctr',
	// 			'key' => '#$6s5#2025#IDEA'
	// 	)
	// );
	// $decrypt = base64_decode($key);
	return $key;
}

function send_email($to, $name, $position, $subject, $body, $template) 
{
    $ci = & get_instance();
    $ci->load->library('email');
	$config = array(
		'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		'smtp_host' => 'ssl://smtp.gmail.com', 
		'smtp_port' => 465,
		'smtp_user' => 'astria.safari@gmail.com',
		'smtp_pass' => 'byalfezfbiftqsai',
		'mailtype'	=> 'html'
	);

	$ci->email->initialize($config);

	$ci->email->set_newline("\r\n");

	$from 	= "astria.safari@gmail.com";

	$data = array(
		'name' 		=> $name,	
		'position' 	=> $position,
		'subject' 	=> $subject,
		'body'		=> $body,
		'url_link'	=> "http://103.161.185.45/cotton",		
	);

	$ci->email->from($from);
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($ci->load->view($template,$data, true));
    $ci->email->send();

	// if (!$ci->email->send()) {
	// 	show_error($ci->email->print_debugger());
	// }	
}

function log_print($id = null, $desc = ""){
	$CI = & get_instance();

    $CI->db->insert(
		"app_log_print", 
		array(
		  "kta_no_id" 				=> $id,
		  "log_desc"				=> $desc,
		  "log_user" 				=> $CI->session->userdata('user_name'),
		  "log_user_id" 			=> $CI->session->userdata('user_id'),
		  "log_user_role" 			=> $CI->session->userdata('user_role'),
		  "log_datetime"		    => date("Y-m-d H:i:s"),
		)
    );
}

function baseline_category_desc($category = ""){
	switch($category){
		case "Best":
			$desc = 'Min [purchase price] - from time period [begin] to [end]';
			break;
		case "Average":
			$desc = 'Avg [ purchase price ] - from time period [begin] to [end]';
			break;
		case "Latest":
			$desc = 'Purchase price at transaction n-1';
			break;
		case "Target":
			$desc = 'Target price set for the item';
			break;
		case "Budget":
			$desc = 'Budget / Volume Forecast Annual Usage';
			break;			
		default:
			$desc = 'Baseline Price';
		break;
	}

	return $desc;
}

function week_start_date($wk_num, $yr, $first = 1, $format = 'Y-m-d')
{
    $wk_ts  = strtotime('+' . $wk_num . ' weeks', strtotime($yr . '0101'));
    $mon_ts = strtotime('-' . date('w', $wk_ts) + $first . ' days', $wk_ts);
    return date($format, $mon_ts);
}
?>