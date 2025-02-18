<?php

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
	}


	public function index()
	{
		show_404();
	}

	function kabupaten(){
		
		$prov = $this->input->post('prov');
		$kab = $this->input->post('kab');

		$this->db->order_by("kab_nama");
		$m = $this->db->get_where("app_kabupaten",array(
				"kab_propinsi_id"	=> $prov,
			))->result();
		
		$html = "<option value=''> - pilih kota - </option>";

		foreach ((array)$m as $k => $v) {
			$s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$v->kab_kode."' $s >".$v->kab_nama."</option>";
		}

		die($html);
	}	

	function kecamatan(){
		
		$prov = $this->input->post('prov');
		$kab = $this->input->post('kab');

		$this->db->order_by("kec_nama");
		$m = $this->db->get_where("app_kecamatan",array(
				"kec_kab_id"	=> $prov
			))->result();

		$html = "<option value=''> - pilih kecamatan - </option>";
		foreach ((array)$m as $k => $v) {
			$s = $v->kec_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$v->kec_kode."' $s >".$v->kec_nama."</option>";
		}

		die($html);
	}	

	function kelurahan(){
		
		$prov = $this->input->post('prov');
		$kab = $this->input->post('kab');

		$this->db->order_by("kel_nama");
		$m = $this->db->get_where("app_kelurahan",array(
				"kel_kec_id"	=> $prov
			))->result();

		$html = "<option value=''> - pilih kelurahan - </option>";
		foreach ((array)$m as $k => $v) {
			$s = $v->kel_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$v->kel_kode."' $s >".$v->kel_nama."</option>";
		}

		die($html);
	}	

	function ktp(){
		
		$ktp = $this->input->post('ktp');
		$this->db->order_by("kta_no_id");
		$this->db->select("kta_no_id");
		$m = $this->db->get_where("app_kta", array( 
			"kta_no_id" => $ktp
		))->result();
		if(count($m) == 0){
			echo "1";
		}else{
			echo "0";			
		}
	}

	function perekomendasi(){
		
		$ktp = $this->input->post('ktp');
		$m = $this->db->get_where("app_perekomendasi", array( 
			"nik_perekomendasi" => $ktp
		))->result();
		if(count($m) == 0){
			$data = $this->db->get_where("app_kta", array( 
				"kta_no_Id" => $ktp
			))->result();
			if(count($data) == 0){
				echo "3";
			}else{
				echo "1";
			}
		}else{
			echo "2";			
		}
	}	

	function save_image() {
		$upload_dir = './uploads/generate/cards/';  //implement this function yourself
		$img 		= $this->input->post('imgBase64');
		$name 		= $this->input->post('npapg');
		$img 		= str_replace('data:image/png;base64,', '', $img);
		$img 		= str_replace(' ', '+', $img);
		$data 		= base64_decode($img);
		$file 		= $upload_dir.$name.".png";
		$success 	= file_put_contents($file, $data);

		$this->db->update("app_kta",array(
			"kta_kartu"				=> $name.".png",
			"is_generate"			=> 1,
		),array(
			"kta_no_id"				=> $name,											
		));

		echo "success";
	}

	function save_card_image() {
		$upload_dir = './uploads/generate/cards/';  //implement this function yourself
		$id 		= $this->input->post('id');
		$img 		= $this->input->post('imgBase64');
		$name 		= $this->input->post('npapg');
		$img 		= str_replace('data:image/png;base64,', '', $img);
		$img 		= str_replace(' ', '+', $img);
		$data 		= base64_decode($img);
		$file 		= $upload_dir.$name.".png";
		$success 	= file_put_contents($file, $data);

		$this->db->update("app_kta",array(
			"kta_kartu"				=> $name.".png",
			"is_generate"			=> 1,
		),array(
			"kta_no_id"				=> $name,											
		));

		$this->db->update("app_batch_detail",array(
			"kta_foto_kartu"		=> $name.".png",
		),array(
			"kta_no_id"				=> $name,											
		));

		echo "success";
	}

	function download() {
		$id 		= $this->input->post('id');

		$this->db->update("app_kta",array(
			"is_cetak"				=> 1,
		),array(
			"print_batch_code"		=> $id,											
		));

		echo "success";
	}	
	
	function generate(){
		$propinsi 			= $this->input->post('propinsi');
		$kabupaten 			= $this->input->post('kabupaten');
		$kecamatan 			= $this->input->post('kecamatan');
		$kelurahan 			= $this->input->post('kelurahan');
		$rekomendasi 		= $this->input->post('rekomendasi');
		$search_propinsi="";
		$search_kabupaten="";
		$search_kecamatan="";
		$search_kelurahan="";
		$search_rekomendasi="";

		if(isset($propinsi) ){
			if($propinsi != ""){
				$search_propinsi = "WHERE kta_propinsi = '".$propinsi."'"; 
			}
		}

		if(isset($kabupaten) ){
			if($kabupaten != ""){
				$search_kabupaten = "AND kta_kabupaten = '".$kabupaten."'"; 
			}
		}
		
		if(isset($kecamatan) ){
			if($kecamatan != ""){
				$search_kecamatan = "AND kta_kecamatan = '".$kecamatan."'"; 
			}
		}

		if(isset($kelurahan) ){
			if($kelurahan != ""){
				$search_kelurahan = "AND kta_kelurahan = '".$kelurahan."'"; 
			}
		}

		if(isset($rekomendasi) ){
			if($rekomendasi != "" && $propinsi != ""){
				$search_rekomendasi = "AND col27 = '".$rekomendasi."'"; 
			}elseif($rekomendasi != "" && $propinsi == ""){
				$search_rekomendasi = "WHERE col27 = '".$rekomendasi."'"; 
			}
		}

		$html = "";
			$data = $this->db->query("
				select
					app_kta.*, 
					app_propinsi.propinsi_nama,
					app_kabupaten.kab_nama,
					app_kecamatan.kec_nama,
					app_kelurahan.kel_nama
				FROM
					app_kta
				INNER JOIN app_propinsi ON app_kta.kta_propinsi 	= app_propinsi.propinsi_kode 
				INNER JOIN app_kabupaten ON app_kta.kta_kabupaten 	= app_kabupaten.kab_kode 
				INNER JOIN app_kecamatan ON app_kta.kta_kecamatan 	= app_kecamatan.kec_kode 
				INNER JOIN app_kelurahan ON app_kta.kta_kelurahan 	= app_kelurahan.kel_kode 
				$search_propinsi $search_kabupaten $search_kecamatan $search_kelurahan $search_rekomendasi
				and is_generate = '0'
				ORDER BY kta_id DESC
				LIMIT 1
			")->result();

			if( count($data) > 0 ) {
            	$no = 0; $cname = '';
                foreach($data as $val) {
					$html 	.=  '<input type="hidden" id="npapg" name="npapg" value="'.$val->kta_no_id.'">';
					$html 	.=	'<div id="canvas-card" class="canvas">';
					$html 	.=	'<div class="content-lg">';
					$html 	.=	'<div style="clear:both;float:right;margin:20px 25px 0 0;">';
					$html 	.=	'';
					$html 	.=	'</div>';	
					$html 	.=	'<div style="clear:both;float:right;margin:165px 54px 6px 30px;">';
					$html 	.=	'<img alt="" src="'.copy_image("foto",$val->kta_foto_wajah).'" style="height:265px; width:183px;" >';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;float:right;margin-right:50px;">';
					$html 	.=	'<div class="nama-lg">'.strtoupper($val->kta_nama_lengkap).'</div>';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;margin-right:50px;">';
					$html 	.=	'<div style="float:right;">';
					$html 	.=	'<div class="nomor-lg"><span align="left">NPAPG - '.substr($val->kta_no_id,0,6)." ".substr($val->kta_no_id,6,6)." ".substr($val->kta_no_id,12,4).'</span></div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;float:right;margin-right:50px;">';
					$html 	.=	'<div class="domisili-lg" style="margin-top:5px;">'.strtoupper($val->kel_nama." - ".$val->kec_nama).'</div>';
					$html 	.=	'<div class="domisili-lg" style="margin-top:5px;">'.strtoupper($val->kab_nama).'</div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
                }
			}						
		die($html);
	}

	function generate_card(){
		$id 				= $this->input->post('id');

		$html = "";
			$data = $this->db->query("
				select
					app_kta.*, 
					app_propinsi.propinsi_nama,
					app_kabupaten.kab_nama,
					app_kecamatan.kec_nama,
					app_kelurahan.kel_nama
				FROM
					app_kta
				INNER JOIN app_propinsi ON app_kta.kta_propinsi 	= app_propinsi.propinsi_kode 
				INNER JOIN app_kabupaten ON app_kta.kta_kabupaten 	= app_kabupaten.kab_kode 
				INNER JOIN app_kecamatan ON app_kta.kta_kecamatan 	= app_kecamatan.kec_kode 
				INNER JOIN app_kelurahan ON app_kta.kta_kelurahan 	= app_kelurahan.kel_kode 
				WHERE is_generate = '0' and print_batch_code = '$id'
				ORDER BY kta_id DESC
				LIMIT 1
			")->result();

			if( count($data) > 0 ) {
            	$no = 0; $cname = '';
                foreach($data as $val) {
					$html 	.=  '<input type="hidden" id="npapg" name="npapg" value="'.$val->kta_no_id.'">';
					$html 	.=	'<div id="canvas-card" class="canvas">';
					$html 	.=	'<div class="content-lg">';
					$html 	.=	'<div style="clear:both;float:right;margin:20px 25px 0 0;">';
					$html 	.=	'';
					$html 	.=	'</div>';	
					$html 	.=	'<div style="clear:both;float:right;margin:165px 54px 6px 30px;">';
					$html 	.=	'<img alt="" src="'.copy_image("foto",$val->kta_foto_wajah).'" style="height:265px; width:183px;" >';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;float:right;margin-right:50px;">';
					$html 	.=	'<div class="nama-lg">'.strtoupper($val->kta_nama_lengkap).'</div>';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;margin-right:50px;">';
					$html 	.=	'<div style="float:right;">';
					$html 	.=	'<div class="nomor-lg"><span align="left">NPAPG - '.substr($val->kta_no_id,0,6)." ".substr($val->kta_no_id,6,6)." ".substr($val->kta_no_id,12,4).'</span></div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
					$html 	.=	'<div style="clear:both;float:right;margin-right:50px;">';
					$html 	.=	'<div class="domisili-lg" style="margin-top:5px;">'.strtoupper($val->kel_nama." - ".$val->kec_nama).'</div>';
					$html 	.=	'<div class="domisili-lg" style="margin-top:5px;">'.strtoupper($val->kab_nama).'</div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
					$html 	.=	'</div>';
                }
				die($html);
			}else{
				echo "1";
			}					
	}

	function generate_zip(){
		ini_set("memory_limit","512M");
		$id 				= $this->input->post('id');

		$html = "";
			$data = $this->db->query("
				select
					app_kta.*, 
					app_propinsi.propinsi_nama,
					app_kabupaten.kab_nama,
					app_kecamatan.kec_nama,
					app_kelurahan.kel_nama
				FROM
					app_kta
				INNER JOIN app_propinsi ON app_kta.kta_propinsi 	= app_propinsi.propinsi_kode 
				INNER JOIN app_kabupaten ON app_kta.kta_kabupaten 	= app_kabupaten.kab_kode 
				INNER JOIN app_kecamatan ON app_kta.kta_kecamatan 	= app_kecamatan.kec_kode 
				INNER JOIN app_kelurahan ON app_kta.kta_kelurahan 	= app_kelurahan.kel_kode 
				WHERE print_batch_code = '$id'
			")->result();

			$this->load->library('zip');
			$filename = "Print_Batch_".$id."-".date("YmdHis").".zip";

			if( count($data) > 0 ) {
            	$no = 0; $cname = '';
                foreach($data as $val) {
					$this->zip->read_file('./uploads/generate/cards/'.$val->kta_kartu);
                }
				$this->zip->archive('./uploads/generate/zip/'.$filename);				
				$this->db->update(
					"app_batch_cetak", 
					array("batch_zip_files"	  => $filename),
					array("batch_id"	  	  => $id )
					);				

			}		
			echo '<div style="text-align: center"><strong>Done, <a href="'.site_url('cetak/detail/'.$id).'">click here to see detail</a></strong></div>';
	}


	function create(){
		$propinsi 			= $this->input->post('propinsi');
		$kabupaten 			= $this->input->post('kabupaten');
		$kecamatan 			= $this->input->post('kecamatan');
		$kelurahan 			= $this->input->post('kelurahan');
		$rekomendasi 		= $this->input->post('rekomendasi');
		$search_propinsi="";
		$search_kabupaten="";
		$search_kecamatan="";
		$search_kelurahan="";
		$search_rekomendasi="";

		if(isset($propinsi) ){
			if($propinsi != ""){
				$search_propinsi = "WHERE kta_propinsi = '".$propinsi."'"; 
			}
		}

		if(isset($kabupaten) ){
			if($kabupaten != ""){
				$search_kabupaten = "AND kta_kabupaten = '".$kabupaten."'"; 
			}
		}
		
		if(isset($kecamatan) ){
			if($kecamatan != ""){
				$search_kecamatan = "AND kta_kecamatan = '".$kecamatan."'"; 
			}
		}

		if(isset($kelurahan) ){
			if($kelurahan != ""){
				$search_kelurahan = "AND kta_kelurahan = '".$kelurahan."'"; 
			}
		}

		if(isset($rekomendasi) ){
			if($rekomendasi != "" && $propinsi != ""){
				$search_rekomendasi = "AND col27 = '".$rekomendasi."'"; 
			}elseif($rekomendasi != "" && $propinsi == ""){
				$search_rekomendasi = "WHERE col27 = '".$rekomendasi."'"; 
			}
		}

		$html = "";

		$create = $this->db->insert(
			"app_batch_cetak", 
			array(
			  "batch_provinsi"		  => $propinsi,
			  "batch_kabupaten" 	  => $kabupaten,
			  "batch_kecamatan" 	  => $kecamatan,
			  "batch_kelurahan"   	  => $kelurahan,
			  "batch_perekomendasi"	  => $rekomendasi,
			  "created_date"		  => date("Y-m-d H:i:s"),
			  "created_user"		  => $this->session->userdata('user_id'),
			)
		  );
	  
		$id = $this->db->insert_id();

			$data = $this->db->query("
				select
					app_kta.*, 
					app_propinsi.propinsi_nama,
					app_kabupaten.kab_nama,
					app_kecamatan.kec_nama,
					app_kelurahan.kel_nama
				FROM
					app_kta
				INNER JOIN app_propinsi ON app_kta.kta_propinsi 	= app_propinsi.propinsi_kode 
				INNER JOIN app_kabupaten ON app_kta.kta_kabupaten 	= app_kabupaten.kab_kode 
				INNER JOIN app_kecamatan ON app_kta.kta_kecamatan 	= app_kecamatan.kec_kode 
				INNER JOIN app_kelurahan ON app_kta.kta_kelurahan 	= app_kelurahan.kel_kode 
				$search_propinsi $search_kabupaten $search_kecamatan $search_kelurahan $search_rekomendasi
				and is_cetak = 0 and print_batch_code = 0
				ORDER BY kta_id DESC
				LIMIT 250
			")->result();

			if( count($data) > 0 ) {
            	$no = 0; $cname = ''; $count = 0;
                foreach($data as $val) {
					$this->db->insert(
						"app_batch_detail", 
						array(
						  "batch_id"		  => $id,
						  "kta_no_id"		  => $val->kta_no_id,
						  "kta_nama_lengkap"  => $val->kta_nama_lengkap,
						  "kta_provinsi" 	  => $val->propinsi_nama,
						  "kta_kabupaten" 	  => $val->kab_nama,
						  "kta_kecamatan" 	  => $val->kec_nama,
						  "kta_kelurahan"     => $val->kel_nama,
						  "kta_foto_wajah"	  => $val->kta_foto_wajah,
						  "kta_foto_kartu"	  => $val->kta_kartu,
						  "created_date"	  => date("Y-m-d H:i:s"),
						  "created_user"	  => $this->session->userdata('user_id'),
						)
					  );			
					$count++;

					$this->db->update(
						"app_kta", 
						array("print_batch_code"	=> $id),
						array("kta_id"	  			=> $val->kta_id)
						);				
	
                }
				$this->db->update(
					"app_batch_cetak", 
					array("batch_count_cards"	  => $count),
					array("batch_id"	  => $id )
					);				
			}		

		echo $id;
	}

	function copy_asset(){
		$propinsi 			= $this->input->post('propinsi');
		$kabupaten 			= $this->input->post('kabupaten');
		$search_propinsi="";
		$search_kabupaten="";

		if(isset($propinsi) ){
			if($propinsi != ""){
				$search_propinsi = "WHERE kta_propinsi = '".$propinsi."'"; 
			}
		}

		if(isset($kabupaten) ){
			if($kabupaten != ""){
				$search_kabupaten = "AND kta_kabupaten = '".$kabupaten."'"; 
			}
		}
		
		$html = "";
			$data = $this->db->query("
				select
					app_kta.*, 
					app_propinsi.propinsi_nama,
					app_kabupaten.kab_nama,
					app_kecamatan.kec_nama,
					app_kelurahan.kel_nama
				FROM
					app_kta
				INNER JOIN app_propinsi ON app_kta.kta_propinsi 	= app_propinsi.propinsi_kode 
				INNER JOIN app_kabupaten ON app_kta.kta_kabupaten 	= app_kabupaten.kab_kode 
				INNER JOIN app_kecamatan ON app_kta.kta_kecamatan 	= app_kecamatan.kec_kode 
				INNER JOIN app_kelurahan ON app_kta.kta_kelurahan 	= app_kelurahan.kel_kode 
				$search_propinsi $search_kabupaten
				ORDER BY kta_id DESC
			")->result();

			if( count($data) > 0 ) {
            	$no = 0; $cname = '';
				$folder 	= "uploads/foto/";
                foreach($data as $val) {
					copy("https://anggotapg.com/assets_colo/collections/kta/photo/".$val->kta_foto_wajah, $folder.$val->kta_foto_wajah);
					copy("https://anggotapg.com/assets_colo/collections/kta/photo/".$val->kta_foto_ktp, "uploads/ktp/".$val->kta_foto_ktp);
                }
			}						
		echo "success";
	}	

    public function category()
	{
        $category = $this->input->post('category');
		$data = $this->master_model->category();

        $html = "<option value=''> - choose category - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Category_Code."' >".$item->Category_Name."</option>";
		}

		die($html);
	}

    public function all_category()
	{
        $category = $this->input->post('category');
		$data = $this->master_model->all_category();

        $html = "<option value=''> - choose category - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Category_Code."' >".$item->Category_Name."</option>";
		}

		die($html);
	}


    public function brand()
	{
        $cat = $this->input->post('cat');
        $brand = $this->input->post('brand');
		$data = $this->master_model->brand($cat, $brand);

        $html = "<option value=''> - choose brand - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Brand_Name."' >".$item->Brand_Name."</option>";
		}

		die($html);
	}

    public function all_brand()
	{
        $cat = $this->input->post('cat');
        $brand = $this->input->post('brand');
		$data = $this->master_model->all_brand($cat, $brand);

        $html = "<option value=''> - choose brand - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Brand_Name."' >".$item->Brand_Name."</option>";
		}

		die($html);
	}

    public function subbrand()
	{
        $subbrand = $this->input->post('subbrand');
        $brand = $this->input->post('brand');
		$data = $this->master_model->subbrand($subbrand, $brand);

        $html = "<option value=''> - choose brand - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Sub_Brand_Code."' >".$item->Sub_Brand_Name."</option>";
		}

		die($html);
	}	

    public function market()
	{
        $market = $this->input->post('market');
        $brand = $this->input->post('brand');
		$data = $this->master_model->market($market, $brand);

        $html = "<option value=''> - choose market - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Market_Code."' >".$item->Market_Name."</option>";
		}

		die($html);
	}	

	public function sub_brand_list()
	{
        $market = $this->input->post('market');
        $brand = $this->input->post('brand');
		$data = $this->master_model->all_market($market,$brand);

        $html = "<ul>";
		foreach ((array)$data as $datas => $item) {
			$product = $this->master_model->product($item->Brand_Name,$item->Category_Code,"",$item->Market_Code);
			$html .= "<li><b>".$item->Market_Name."</b></li>";
			$html .= "<ul>";
			foreach ((array)$product as $products => $sku) {
				$html .= "<li>".$sku->Item_Number." - ".$sku->IDESC."</li>";
			}
			$html .= "</ul>";
		}
        $html .= "<ul>";

		die($html);
	}	

    public function product()
	{
        $cat = $this->input->post('cat');
        $brand = $this->input->post('brand');
        $subbrand = $this->input->post('subbrand');
        $market = $this->input->post('market');
		$data = $this->master_model->product($brand,$cat,$subbrand,$market);

        $html = "<option value=''> - choose product - </option>";
		foreach ((array)$data as $datas => $item) {
			// $s = $v->kab_kode==$kab?'selected="selected"':'';
			$html .= "<option value='".$item->Item_Number."' >".$item->Item_Number." - ".$item->IDESC."</option>";
		}

		die($html);
	}

	public function request()
	{
        $request = $this->input->post('form_number');

		$request_detail = $this->db->get_where("COTTON_V2_Request_Header",array(
			"Form_Number"	=> $request,
		))->row();

		$detail = $this->db->get_where("COTTON_V2_Request_Detail",array(
			"Request_Seq"	=> $request,
		))->row();

		$request_brand = $this->db->query(
		"SELECT DISTINCT Request_Detail_Seq, Request_Seq, User_Login, COTTON_V2_Request_Detail.Brand_Code, Brand_Name, Category_Code, Category_Name 
		FROM COTTON_V2_Request_Detail
		INNER JOIN COTTON_V2_Brand ON COTTON_V2_Brand.Brand_Code = COTTON_V2_Request_Detail.Brand_Code
		WHERE Request_Seq = '".$request."'
		"
		)->result();

		$request_track = $this->db->get_where("COTTON_V2_Request_Track",array(
			"Request_Seq"	=> $request,
		))->result();

		$approve_track = $this->db->get_where("COTTON_V2_Request_Approval_Track",array(
			"Request_Seq"	=> $request,
		))->result();

		if($request_detail->Form_Status == 1){
			$status =  "Approved By Line Manager";
		}elseif($request_detail->Form_Status == 2){
			$status =  "Approved By Finance Manager";
		}else if($request_detail->Form_Status == 0){
			$status = "Form Request Submitted";
		}else{
			$status = "Draft";
		}

		$html = '                                                
		<table class="thead-dark table table-sm table-striped">
			<thead>
				<tr>
					<th class="text-left" style="width: 20px;" >Request Number</th>
					<th class="text-left" style="width: 5px;">:</th>
					<th class="text-left" style="width: 50px;">'.$request_detail->Form_Number.'</th>
					<th class="text-left" style="width: 20px;">Request Date</th>
					<th class="text-left" style="width: 5px;">:</th>
					<th class="text-left" style="width: 50px;">'.myDate($request_detail->Form_Date,"d M Y").'</th>
				</tr>
				<tr>
					<th class="text-left" style="width: 20px;">Request Description</th>
					<th class="text-left" style="width: 5px;">:</th>
					<th class="text-left" style="width: 100px;">'.$request_detail->Form_Description.'</th>
					<th class="text-left" style="width: 20px;">Request Status</th>
					<th class="text-left" style="width: 5px;">:</th>
					<th class="text-left" style="width: 50px;">'.$status.'</th>
				</tr>
				
			</thead>
			<tbody>
			</tbody>
		</table>
		';
		
		if($request_detail->Form_Description == 'Change Authorization Request'){
			$html .= '   
			<table class="thead-dark table table-sm table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" style="width: 5%;">New User ID</th>
						<th class="text-center" style="width: 15%;">New User Name</th>
						<th class="text-center" style="width: 15%;">New User Email</th>
					</tr>
				</thead>
				<tbody>
				
			';
			if(!empty($detail)){
				$html .= "<tr>";
				$html .= '<td class="text-center">'.$detail->Request_User_Id.'</td>';
				$html .= '<td class="text-center">'.$detail->Request_User_fullname.'</td>';
				$html .= '<td class="text-center">'.$detail->Request_User_email.'</td>';
				$html .= "</tr>";
			}
			$html .= "</tbody></table>";	
		}else{
			$html .= '   
			<table class="thead-dark table table-sm table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" style="width: 5%;">Category Name</th>
						<th class="text-center" style="width: 15%;">Brand Code</th>
						<th class="text-center" style="width: 15%;">Brand Name</th>
					</tr>
				</thead>
				<tbody>
				
			';
			if(!empty($request_brand)){
				foreach ((array)$request_brand as $datas => $item) {
					$html .= "<tr>";
					$html .= '<td class="text-center">'.$item->Category_Name.'</td>';
					$html .= '<td class="text-center">'.$item->Brand_Code.'</td>';
					$html .= '<td class="text-center">'.$item->Brand_Name.'</td>';
					$html .= "</tr>";
				}	
			}
			$html .= "</tbody></table>";
		}



		$html .= '
			<h6>Form Request Approval Track</h6>                                                                                               
			<table class="thead-dark table table-sm table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" style="width: 15%;">User</th>
						<th class="text-center" style="width: 15%;">Level</th>
						<th class="text-center" style="width: 15%;">Status</th>
						<th class="text-center" style="width: 15%;">Date</th>
					</tr>
				</thead>
				<tbody>
		';

		if(!empty($approve_track)){
			foreach ((array)$approve_track as $datas => $item) {
				$status = $item->Approve_Status=="waiting"?"-":myDate($item->Approve_Date,"d M Y");
				$html .= "<tr>";
				$html .= '<td class="text-center">'.$item->Approve_Name.'</td>';
				$html .= '<td class="text-center">'.$item->Approve_Title.'</td>';
				$html .= '<td class="text-center">'.$item->Approve_Status.'</td>';
				$html .= '<td class="text-center">'.$status.'</td>';
				$html .= "</tr>";
			}	
		}
		$html .= "</tbody></table>";		
		$html .= '
			<h6>Form Request History</h6>                                                                                               
			<table class="thead-dark table table-sm table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" style="width: 15%;">Description</th>
						<th class="text-center" style="width: 15%;">User</th>
						<th class="text-center" style="width: 15%;">Level</th>
						<th class="text-center" style="width: 15%;">Date</th>
					</tr>
				</thead>
				<tbody>
		';

		if(!empty($request_track)){
			foreach ((array)$request_track as $datas => $item) {
				$html .= "<tr>";
				$html .= '<td class="text-center">'.$item->Approve_Status.'</td>';
				$html .= '<td class="text-center">'.$item->Approve_Name.'</td>';
				$html .= '<td class="text-center">'.$item->Approve_Title.'</td>';
				$html .= '<td class="text-center">'.myDate($item->Approve_Date,"d M Y").'</td>';
				$html .= "</tr>";
			}	
		}
		$html .= "</tbody></table>";
		die($html);
	}


	public function login()
	{
//		if(empty($this->session->userdata())){
			$this->load->model('auth_model');
			$this->load->library('form_validation');
	
			$rules = $this->auth_model->rules();
			$this->form_validation->set_rules($rules);
	
			if($this->form_validation->run() == FALSE){
				return $this->load->view('login_form');
			}
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');

	
			if($this->auth_model->login($username, $password)){
				// echo "<pre>";
				// print_r($this->session->userdata());
				// echo "</pre>";
				
				// die;

				redirect('dashboard');
			} else {
				// redirect('dashboard');
				$this->session->set_flashdata('message_login_error', 'Login Failed, Please check your username or password!');
			}
	
			$this->load->view('login_form');	
		// }else{
		// 	redirect('dashboard');
		// }
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}
}
