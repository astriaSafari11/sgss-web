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

function myCurr($num=0,$curr=""){
	return "Rp. ".number_format($num,2,",",".");
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
			return $dtm;
		}
	}else{
		return "-";
	}
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

function mass_email($to, $subject, $body, $template) 
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
		'subject' 	=> $subject,
		'body'		=> $body,
		'url_link'	=> "http://103.161.185.45/cotton",		
	);

	$ci->email->from($from);
	$ci->email->bcc($to);
	$ci->email->subject($subject);
	$ci->email->message($ci->load->view($template,$data, true));
    $ci->email->send();

	// if (!$ci->email->send()) {
	// 	show_error($ci->email->print_debugger());
	// }	
}

function get_propinsi(){
	$CI = & get_instance();
	$CI->db->order_by("propinsi_nama");
	$m = $CI->db->get_where("app_propinsi",array(
			"propinsi_status"	=> 0
		))->result();

	return $m;
}

function get_pekerjaan(){
	$CI = & get_instance();
	$CI->db->order_by("pekerjaan_nama");
	$m = $CI->db->get_where("app_pekerjaan",array(
			"pekerjaan_status"	=> 0
		))->result();

	return $m;
}

function get_perekomendasi(){
	$CI = & get_instance();
	$CI->db->order_by("nama_perekomendasi");
	$m = $CI->db->get_where("app_perekomendasi")->result();

	return $m;
}

function get_role(){
	$CI = & get_instance();
	$m = $CI->db->get_where("app_role")->result();

	return $m;
}

function get_nama_role($id=null){
	$CI = & get_instance();
	$m = $CI->db->get_where("app_role",array(
		"role_id"	=> $id
	))->row();

	return $m->role_name;
}

function get_path(){
	$CI = & get_instance();
	$m = $CI->db->get_where("app_kabupaten",array(
			"kab_propinsi_id"	=> "31"
		))->result();
	return $m;
}

function get_path_value($st=""){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta WHERE kta_kabupaten = '$st'")->row();
	return $m;
}

function get_total_anggota(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta")->row();
	return $m;
}


function get_total_perekomendasi(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(id) AS jumlah FROM app_perekomendasi")->row();
	return $m->jumlah;
}

function get_grafik_perekomendasi(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(id) AS jumlah, kta_jenkel FROM app_perekomendasi
	INNER JOIN app_kta ON app_perekomendasi.npapg_perekomendasi = app_kta.kta_nomor_kartu
	GROUP BY kta_jenkel")->result();
	return $m;
}

function get_top_perekomendasi(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah, col27, nik_perekomendasi, nama_perekomendasi, kota_perekomendasi, foto_perekomendasi FROM app_perekomendasi
	INNER JOIN app_kta ON app_perekomendasi.npapg_perekomendasi = app_kta.col27
	GROUP BY col27,nik_perekomendasi,  nama_perekomendasi, kota_perekomendasi, foto_perekomendasi
	ORDER BY jumlah DESC
	LIMIT 5")->result();
	return $m;
}

function get_chart_perekomendasi(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah, col27, nama_perekomendasi FROM app_perekomendasi
	INNER JOIN app_kta ON app_perekomendasi.npapg_perekomendasi = app_kta.col27
	GROUP BY col27, nama_perekomendasi
	ORDER BY jumlah DESC")->result();
	return $m;
}

function get_total_propinsi(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	SELECT 
	COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
	COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan,
	app_propinsi.propinsi_nama, 
	app_kabupaten.kab_nama 
	FROM app_kabupaten
	INNER JOIN app_kta ON app_kabupaten.kab_kode = app_kta.kta_kabupaten
	INNER JOIN app_propinsi ON app_kabupaten.kab_propinsi_id = app_propinsi.propinsi_kode
	GROUP BY propinsi_nama, kab_nama
	ORDER BY propinsi_nama ASC
	")->result();
	return $m;
}

function get_total_detail($p=array()){
	$CI = & get_instance();

	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";
	
	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}
	$m = $CI->db->query("	
	SELECT 
	COUNT(kta_id) AS total,
	COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
	COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan,
	COUNT(if(is_cetak = 0, kta_id, NULL)) as belum_cetak,
	COUNT(if(is_cetak >= 1, kta_id, NULL)) as cetak	
	FROM app_kta
	INNER JOIN app_propinsi ON app_propinsi.propinsi_id = app_kta.kta_propinsi
	INNER JOIN app_kabupaten ON app_kabupaten.kab_kode = app_kta.kta_kabupaten
	INNER JOIN app_kecamatan ON app_kecamatan.kec_kode = app_kta.kta_kecamatan
	INNER JOIN app_kelurahan ON app_kelurahan.kel_kode = app_kta.kta_kelurahan
	LEFT JOIN app_perekomendasi ON app_perekomendasi.npapg_perekomendasi = app_kta.col27
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	")->row();
	return $m;
}

function get_detail_data($p=array()){
	$CI = & get_instance();
	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";

	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}

	$m = $CI->db->query("	
	SELECT 
	COUNT(kta_id) AS total,
	COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
	COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan,
	COUNT(if(is_cetak = 0, kta_id, NULL)) as belum_cetak,
	COUNT(if(is_cetak >= 1, kta_id, NULL)) as cetak,
	app_propinsi.propinsi_nama, 
	app_kabupaten.kab_nama,
	app_kecamatan.kec_nama,
	app_kelurahan.kel_nama,
	app_perekomendasi.nama_perekomendasi
	FROM app_kta
	INNER JOIN app_propinsi ON app_propinsi.propinsi_id = app_kta.kta_propinsi
	INNER JOIN app_kabupaten ON app_kabupaten.kab_kode = app_kta.kta_kabupaten
	INNER JOIN app_kecamatan ON app_kecamatan.kec_kode = app_kta.kta_kecamatan
	INNER JOIN app_kelurahan ON app_kelurahan.kel_kode = app_kta.kta_kelurahan
	LEFT JOIN app_perekomendasi ON app_perekomendasi.npapg_perekomendasi = app_kta.col27
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	GROUP BY propinsi_nama, kab_nama, kec_nama, kel_nama, col27, nama_perekomendasi		
	ORDER BY col27, propinsi_nama, kab_nama, kec_nama, kel_nama ASC
	")->result();
	return $m;
}

function get_data_jakarta(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	SELECT 
	COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
	COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan,
	app_propinsi.propinsi_nama, 
	app_kabupaten.kab_nama 
	FROM app_kabupaten
	INNER JOIN app_kta ON app_kabupaten.kab_kode = app_kta.kta_kabupaten
	INNER JOIN app_propinsi ON app_kabupaten.kab_propinsi_id = app_propinsi.propinsi_kode
	WHERE app_kabupaten.kab_propinsi_id = '31'
	GROUP BY propinsi_nama, kab_nama
	ORDER BY propinsi_nama ASC
	")->result();
	return $m;
}

function get_data_pekerjaan(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	select
	pekerjaan_nama, 
	COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	INNER JOIN app_pekerjaan ON app_pekerjaan.pekerjaan_id = app_kta.kta_pekerjaan
	GROUP BY kta_pekerjaan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_detail_data_pekerjaan($p=array()){
	$CI = & get_instance();

	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";

	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}

	$m = $CI->db->query("	
	select
	pekerjaan_nama, 
	COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	INNER JOIN app_pekerjaan ON app_pekerjaan.pekerjaan_id = app_kta.kta_pekerjaan
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	GROUP BY kta_pekerjaan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_data_pendidikan(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	select
		kta_pendidikan, 
		COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	GROUP BY kta_pendidikan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_detail_data_pendidikan($p=array()){
	$CI = & get_instance();

	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";

	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}

	$m = $CI->db->query("	
	select
	kta_pendidikan, 
	COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	GROUP BY kta_pendidikan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_data_agama(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	select
		kta_agama, 
		COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	GROUP BY kta_agama
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_detail_data_agama($p=array()){
	$CI = & get_instance();

	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";

	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}

	$m = $CI->db->query("	
	select
	kta_agama, 
	COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	GROUP BY kta_agama
	ORDER BY jumlah DESC
	")->result();
	return $m;
}



function get_data_pengurus(){
	$CI = & get_instance();
	$m = $CI->db->query("	
	select
		kta_tingkatan, 
		COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	GROUP BY kta_tingkatan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_detail_data_pengurus($p=array()){
	$CI = & get_instance();

	$propinsi = ""; $kabupaten=""; $kecamatan=""; $kelurahan=""; $rekomen="";

	if(isset($p['kta_propinsi']) ){
		if($p['kta_propinsi'] != ""){
			$propinsi = "WHERE kta_propinsi = '".$p['kta_propinsi']."'";
		}else{
			$propinsi = "";
		}
	}

	if(isset($p['kta_kabupaten']) ){
		if($p['kta_kabupaten'] != ""){
			$kabupaten = "AND kta_kabupaten = '".$p['kta_kabupaten']."'";
		}else{
			$kabupaten = "";
		}
	}
	
	if(isset($p['kta_kecamatan']) ){
		if($p['kta_kecamatan'] != ""){
			$kecamatan = "AND kta_kecamatan = '".$p['kta_kecamatan']."'";
		}else{
			$kecamatan = "";
		}
	}
	if(isset($p['kta_kelurahan']) ){
		if($p['kta_kelurahan'] != ""){
			$kelurahan = "AND kta_kelurahan = '".$p['kta_kelurahan']."'";
		}else{
			$kelurahan = "";
		}
	}

	if(isset($p['col27']) ){
		if($p['kta_propinsi'] != "" && $p['col27'] != ""){
			$rekomen = "AND col27 = '".$p['col27']."'";
		}else{
			if($p['col27'] != ""){
				$rekomen = "WHERE col27 = '".$p['col27']."'";
			}else{
				$rekomen = "";
			}
		}
	}

	$m = $CI->db->query("	
	select
	kta_tingkatan, 
	COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	$propinsi $kabupaten $kecamatan $kelurahan $rekomen
	GROUP BY kta_tingkatan
	ORDER BY jumlah DESC
	")->result();
	return $m;
}

function get_total_cetak(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta where is_cetak > 0")->row();
	return $m->jumlah;
}

function get_total_belum_cetak(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta where is_cetak = 0")->row();
	return $m->jumlah;
}

function get_grafik_cetak(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah, is_cetak FROM app_kta
	GROUP BY is_cetak")->result();
	return $m;
}

function get_total_anggota_bulan_ini(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta WHERE DATE_FORMAT(time_entry,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')")->row();
	return $m->jumlah;
}

function get_total_anggota_minggu_ini(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta WHERE 
	time_entry between (DATE_FORMAT(CURDATE(),'%Y-%m-%d') - INTERVAL 8 DAY ) and DATE_FORMAT(CURDATE(),'%Y-%m-%d')")->row();
	return $m->jumlah;
}

function get_total_anggota_hari_ini(){
	$CI = & get_instance();
	$m = $CI->db->query("SELECT COUNT(kta_id) AS jumlah FROM app_kta WHERE DATE_FORMAT(time_entry,'%Y-%m-%d') = DATE_FORMAT(CURDATE(),'%Y-%m-%d')")->row();
	return $m->jumlah;
}

function get_cart_bulan(){
	$CI = & get_instance();
	$m = $CI->db->query("
	select
		DATE_FORMAT(time_entry,'%Y-%m') as tahun, 
		COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	WHERE DATE_FORMAT(time_entry,'%Y') = DATE_FORMAT(CURDATE(),'%Y')
	GROUP BY
		DATE_FORMAT(time_entry,'%Y-%m')
	ORDER BY DATE_FORMAT(time_entry,'%Y-%m') ASC
			")->result();
	return $m;
}

function get_chart_30_hari(){
	$CI = & get_instance();
	$m = $CI->db->query("
	select
		DATE_FORMAT(time_entry,'%Y-%m-%d') as tanggal, 
		COUNT(if(kta_id, kta_id, NULL)) as jumlah
	FROM
		app_kta
	WHERE
	time_entry between (DATE_FORMAT(CURDATE(),'%Y-%m-%d') - INTERVAL 32 DAY ) and DATE_FORMAT(CURDATE(),'%Y-%m-%d')
	GROUP BY
		DATE_FORMAT(time_entry,'%Y-%m-%d')
	ORDER BY DATE_FORMAT(time_entry,'%Y-%m-%d') ASC
	LIMIT 31
			")->result();
	return $m;
}

function get_chart_tahun(){
	$CI = & get_instance();
	$m = $CI->db->query("
		select
			DATE_FORMAT(time_entry,'%M') as bulan, 
			COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
			COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan		
		FROM
			app_kta
		WHERE DATE_FORMAT(time_entry,'%Y') = DATE_FORMAT(CURDATE(),'%Y')
		GROUP BY
			DATE_FORMAT(time_entry,'%m')
		ORDER BY DATE_FORMAT(time_entry,'%m') ASC
	")->result();
	return $m;
}

function get_chart_total_tahun(){
	$CI = & get_instance();
	$m = $CI->db->query("
		select
			DATE_FORMAT(time_entry,'%Y') as tahun,
			COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
			COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan		
		FROM
			app_kta
		GROUP BY
			DATE_FORMAT(time_entry,'%Y')
		ORDER BY DATE_FORMAT(time_entry,'%Y') ASC
	")->result();
	return $m;
}

function get_cart_jk(){
	$CI = & get_instance();
	$m = $CI->db->query("
	select
		COUNT(if(kta_jenkel = 1, kta_id, NULL)) as laki,
		COUNT(if(kta_jenkel = 2, kta_id, NULL)) as perempuan		
	FROM
		app_kta
	")->row();
	return $m;
}

function get_entry_terbaru(){
	$CI = & get_instance();
	$m = $CI->db->query("
	SELECT * FROM app_kta 
	ORDER BY time_entry DESC
	LIMIT 6
	")->result();
	return $m;
}

function get_agama($p=null){
	switch ($p) {
		case 1:
		  $agama = "Islam";
		  break;
		case 2:
		  $agama = "Kristen Protestan";
		  break;
		case 3:
		  $agama = "Kristen Katolik";
		  break;
		case 4:
		  $agama = "Budha";
		  break;
		case 5:
		  $agama = "Hindu";
		  break;
		case 6:
		  $agama = "Konghucu";
		  break;
		default:
		$agama = "Tidak Ada Keterangan";
	}
	return $agama;
}

function get_status_nikah($p=null){
	switch ($p) {
		case 1:
		  $nikah = "Belum Kawin";
		  break;
		case 2:
		  $nikah = "Kawin";
		  break;
		case 3:
		  $nikah = "Pernah Menikah";
		  break;
		default:
		$nikah = "Tidak Ada Keterangan";
	}
	return $nikah;
}

function get_image($type,$filename){
	$img = "";
	$base_url 	= $type=="foto"?base_url("uploads/foto/".$filename):base_url("uploads/ktp/".$filename);
	$folder 	= $type=="foto"?"uploads/foto/".$filename:"uploads/ktp/".$filename;

	if(file_exists($folder)){
		return $base_url;
	}else{
		if(file_exists("https://anggotapg.com/assets_colo/collections/kta/photo/".$filename)){
			copy("https://anggotapg.com/assets_colo/collections/kta/photo/".$filename, $folder);
		}
		return "https://anggotapg.com/assets_colo/collections/kta/photo/".$filename;
	}
}
function copy_image($type,$filename){
	$img = "";
	$base_url 	= $type=="foto"?base_url("uploads/foto/".$filename):base_url("uploads/ktp/".$filename);
	$folder 	= $type=="foto"?"uploads/foto/".$filename:"uploads/ktp/".$filename;

	if(file_exists($folder)){
		return $base_url;
	}else{
		if(copy("https://anggotapg.com/assets_colo/collections/kta/photo/".$filename, $folder)){
			return $base_url;
		}else{
			return "https://anggotapg.com/assets_colo/collections/kta/photo/".$filename;
		}
	}
}


function upload_image($upload,$filename,$folder){
	$CI = & get_instance();
	$config = array(
		'file_name'     => $filename,
		'upload_path'   => $folder,
		'allowed_types' => "jpg|png|jpeg|gif",
		'max_size'      => "1024000", // file size , here it is 1 MB(1024 Kb)
	);
	$CI->load->library('upload');
	$CI->upload->initialize($config);
    
	if ($CI->upload->do_upload($upload)) {
		$file_name = $CI->upload->data('file_name');
	}else{
		$CI->upload->display_errors();
	}  

	return $file_name;
}

function log_data($id = null, $desc = ""){
	$CI = & get_instance();

    $insert_data = $CI->db->insert(
		"app_log_data", 
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

function log_print($id = null, $desc = ""){
	$CI = & get_instance();

    $insert_data = $CI->db->insert(
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

?>