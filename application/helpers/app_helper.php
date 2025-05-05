<?php
function getCI()
	{
	$CI =& get_instance ();
	return $CI;
	}
if (! function_exists ('load_view'))
	{
	function load_view($view = "", $data)
		{
		$CI = getCI ();

		$CI->load->view ('_partials/head.php');
		$CI->load->view ($view, $data);
		$CI->load->view ('_partials/footer.php');

		}
	}

function debugCode($r = array(), $f = TRUE)
	{
	echo "<pre>";
	print_r ($r);
	echo "</pre>";

	if ($f == TRUE)
		die;
	}

function myNum($num = 0, $curr = "")
	{
	$curr2 = strtolower ($curr);
	if ($curr2 == "rp")
		{
		return number_format ($num, 0, ".", ",");
		}
	elseif ($curr2 == "$" || $curr2 == "e")
		{
		return number_format ($num, 0, ".", ",") . " " . $curr;
		}
	else
		{
		return number_format ($num, 0, ".", ",");
		}
	}

function myCurr($num = 0, $curr = "")
	{
	return number_format ($num, 0, ".", ",");
	}

function myDecimal($num = 0, $curr = "")
	{
	return number_format ($num, 2, ",", ".");
	}

function myDate($dt, $f = "d/m/Y H:i", $s = true)
	{
	$day = array(
		1 => "Senin",
		2 => "Selasa",
		3 => "Rabu",
		4 => "Kamis",
		5 => "Jumat",
		6 => "Sabtu",
		7 => "Minggu"
	);
	if (trim ($dt) != "0000-00-00" && trim ($dt) != "")
		{
		$ts = strtotime ($dt);
		$dtm = date ($f, $ts);
		if (trim ($dtm) == "01/01/1970")
			{
			return "-";
			}
		else
			{
			return ($s) ? $day[date ("N", $ts)] . ", " . $dtm : $dtm;
			}
		}
	else
		{
		return "-";
		}
	}

function mDate($date = "", $v = "+1 day", $format = 'Y-m-d')
	{
	date_default_timezone_set ('Asia/Jakarta');
	$date = (trim ($date) == "") ? date ("Y-m-d") : $date;
	$nd = strtotime (date ("Y-m-d", strtotime ($date)) . $v);
	return date ($format, $nd);
	}

function formatDate($date = "", $format = 'd M Y')
	{
	date_default_timezone_set ('Asia/Jakarta');
	$nd = strtotime (date ("Y-m-d", strtotime ($date)));
	return date ($format, $nd);
	}

function showToast($type = "success", $msg = "")
	{
	switch ($type)
		{
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
            class="toast ' . $class . '"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
        >
        <div class="toast-header">
        	' . $icon . '
            <strong class="me-auto">' . $title . '</strong>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="toast"
            aria-label="Close"
        ></button>
        </div>
        	<div class="toast-body">' . $msg . '</div>
        </div>  	
	';
	}


function _encrypt($key = "")
	{
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

function _decrypt($key = "")
	{
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

function log_print($id = null, $desc = "")
	{
	$CI = &get_instance ();

	$CI->db->insert (
		"app_log_print",
		array(
			"kta_no_id" => $id,
			"log_desc" => $desc,
			"log_user" => $CI->session->userdata ('user_name'),
			"log_user_id" => $CI->session->userdata ('user_id'),
			"log_user_role" => $CI->session->userdata ('user_role'),
			"log_datetime" => date ("Y-m-d H:i:s"),
		)
	);
	}

function baseline_category_desc($category = "")
	{
	switch ($category)
		{
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
	$wk_ts = strtotime ('+' . $wk_num . ' weeks', strtotime ($yr . '0101'));
	$mon_ts = strtotime ('-' . date ('w', $wk_ts) + $first . ' days', $wk_ts);
	return date ($format, $mon_ts);
	}

function approval_category($category = "", $order_category = "", $purchase_reason = "", $remarks)
	{
	switch ($category)
		{
		case "price_over_threshold":
			$desc = 'Price allowance over threshold';
			break;
		case "qty_over_threshold":
			$desc = 'Quantity allowance over threshold';
			break;
		case "ignore_order":
			$desc = 'Ignored by requestor';
			break;
		default:
			if ($order_category == "ignore")
				{
				$desc = 'Ignored by requestor';
				}
			else
				{
				$desc = $purchase_reason . " - " . $remarks;
				}
			break;
		}

	return $desc;
	}

function send_email_notification($to, $subject, $body)
	{
	$ci = &get_instance ();
	$ci->load->library ('email');
	$ci->config->load ('env');

	// $config = array(
	// 	'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
	// 	'smtp_host' => 'ssl://smtp.gmail.com',
	// 	'smtp_port' => 465,
	// 	'smtp_user' => 'astria.safari@gmail.com',
	// 	'smtp_pass' => 'knucmduqxdmidvgm',
	// 	'mailtype' => 'html'
	// );

	$config = array(
		'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		'smtp_host' => $ci->config->item ('smtp_host'),
		'smtp_port' => $ci->config->item ('smtp_port'),
		'smtp_user' => $ci->config->item ('smtp_user'),
		'smtp_crypto' => 'tls',
		'smtp_pass' => $ci->config->item ('smtp_pass'),
		'mailtype' => 'html',
	);

	$ci->email->initialize ($config);

	$ci->email->set_newline ("\r\n");

	$from = "sgss.notification@unilever.com";

	$ci->email->from ($from);
	$ci->email->to ($to);
	$ci->email->subject ($subject);
	$ci->email->message ($body);
	// $ci->email->send();

	if (! $ci->email->send ())
		{
		show_error ($ci->email->print_debugger ());
		}
	}
function email_body($subject, $body)
	{
	$html = '
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width" initial-scale="1">
		<style>
			* { font-family: sans-serif !important; }
		</style>
		<style>
			*,
			*:after,
			*:before {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
	
			* {
				-ms-text-size-adjust: 100%;
				-webkit-text-size-adjust: 100%;
			}
	
			html,
			body,
			.document {
				width: 100% !important;
				height: 100% !important;
				margin: 0;
				padding: 0;
			}
	
			body {
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				text-rendering: optimizeLegibility;
			}
	
			div[style*="margin: 16px 0"] {
				margin: 0 !important;
			}
	
			table,
			td {
				mso-table-lspace: 0pt;
				mso-table-rspace: 0pt;
			}
	
			table {
				border-spacing: 0;
				border-collapse: collapse;
				table-layout: fixed;
				margin: 0 auto;
			}
	
			img {
				-ms-interpolation-mode: bicubic;
				max-width: 100%;
				border: 0;
			}
	
			*[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: none !important;
			}
	
			.x-gmail-data-detectors,
			.x-gmail-data-detectors *,
			.aBn {
				border-bottom: 0 !important;
				cursor: default !important;
			}
	
			.btn {
				-webkit-transition: all 200ms ease;
				transition: all 200ms ease;
			}
	
			.btn:hover {
				background-color: dodgerblue;
			}
	
			@media screen and (max-width: 750px) {
				.container {
					/*width: 100%;*/
					margin: auto;
				}
	
				.stack {
					display: block;
					width: 100%;
					max-width: 100%;
				}
			}
		</style>
	</head>
	<body>	
	<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center"
		   class="document">
			<tr>
				<td valign="top">
				<br/>
				<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center"
					   width="700" class="container" style="border:1px solid #ddd;">
					<tr>
						<td style="background: #1771ba;" align="left" valign="top">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td width="100%" colspan="3" height="20">&nbsp;</td>
								</tr>
								<tr>
									<td width="30" valign="top" align="center">
										&nbsp;
									</td>
									<td width="640" valign="top" align="left">
										<span style="font-family:Arial, Helvetica, sans-serif; color:#fff; font-size:12px;">' . $subject . '</span>
									</td>
									<td width="30" valign="top" align="center">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td width="100%" colspan="3" height="20">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="left" valign="top">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td width="100%" colspan="3" height="20">&nbsp;</td>
								</tr>
								<tr>
									<td width="50" valign="top" align="top">&nbsp;</td>
									<td width="600" valign="top" align="top">
										' . $body . '
										</br></br>			
									</p>
									</td>
									<td width="50" valign="top" align="top">&nbsp;</td>
								</tr>
								<tr>
									<td width="100%" colspan="3" height="20">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="background: #1771ba;" align="center" valign="top">
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style="background: #1771ba;" align="center" valign="top">
							<span style="font-family:Arial, Helvetica, sans-serif; color:#fff; font-size:12px;">&copy; 2025 Unilever.</span>
						</td>
					</tr>
					<tr>
						<td style="background: #1771ba;" align="center" valign="top">
							&nbsp;
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</body>
	</html>	
	';

	return $html;
	}

function num2alpha($n)
	{
	$r = '';
	for ($i = 1; $n >= 0 && $i < 10; $i++)
		{
		$r = chr (0x41 + ($n % pow (26, $i) / pow (26, $i - 1))) . $r;
		$n -= pow (26, $i);
		}
	return $r;
	}

function approval_status($status = "")
	{
	switch ($status)
		{
		case "auto_approved":
			$desc = 'Auto Approved';
			break;
		case "approved":
			$desc = 'Approved';
			break;
		case "inactive":
			$desc = 'Approval Not Required';
			break;
		case "waiting_approval":
			$desc = 'Waiting For Approval';
			break;
		case "rejected":
			$desc = 'Rejected';
			break;
		case "finished":
			$desc = 'Finished';
			break;
		default:
			$desc = 'Waiting For Approval';
			break;
		}

	return $desc;
	}

function generateRecurringDates($startDate, $endDate, $recurrence = 'daily')
	{
	$dates = [];
	$start = new DateTime($startDate);
	$end = new DateTime($endDate);

	// Define interval based on recurrence type
	switch ($recurrence)
		{
		case 'daily':
			$interval = new DateInterval('P1D');
			break;
		case 'weekly':
			$interval = new DateInterval('P1W');
			break;
		case 'biweekly':
			$interval = new DateInterval('P2W');
			break;
		case 'monthly':
			$interval = new DateInterval('P1M');
			break;
		case 'yearly':
			$interval = new DateInterval('P1Y');
			break;
		default:
			throw new Exception("Invalid recurrence type");
		}

	while ($start <= $end)
		{
		$dates[] = $start->format ('Y-m-d');
		$start->add ($interval);
		}

	return $dates;
	}
?>
