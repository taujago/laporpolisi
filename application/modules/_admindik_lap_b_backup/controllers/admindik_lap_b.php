<?php
class admindik_lap_b extends admindik_controller {
// kesehatan,kekuatan, keturunan, masuk surga
	var $controller ;

	function admindik_lap_b(){
		parent::__construct();
		// $this->load->model("core_model","cm");
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("admindik_lap_b_model","dm");
		$this->controller = get_class($this);
		$this->load->library('user_agent');

		$this->userdata = $_SESSION['userdata'];

	}

	function index(){
		// echo "fuckkk.."; exit;
		$userdata = $this->session->userdata("userdata");

		$controller = get_class($this);


		// $data['leasing_id'] = $userdata['leasing_id'];
		 


	 
		//show_array($data_array); exit;
		$data_array['controller'] = $controller;

	 

		//$data_array['status'] = ( isset($this->input->get('status'))?$this->input->get('status'):"0"; 
		//echo "uri .. ".$data_array['uri']; exit;
		$data_array['status'] = isset($_GET['status'])?$_GET['status']:'0';
		$content = $this->load->view($controller."_view",$data_array,true);

		$this->set_subtitle("LAPORAN POLISI TIPE B");
		$this->set_title("LAPORAN  POLISI TIPE B");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"tanggal"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][1]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][2]['search']['value'];
        $id_fungsi = $_REQUEST['columns'][3]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null,
				"tanggal_awal" => $tanggal_awal, 
				"tanggal_akhir" => $tanggal_akhir,
				"id_fungsi" => $id_fungsi 
				 
		);     
           
        $row = $this->dm->data($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->data($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['lap_b_id'];
         
        	$arr_data[] = array(
        		 
								$row['nomor'],
								flipdate($row['tanggal']),
								$row['pelapor_nama'],
								$row['terlapor'],
								$row['tindak_pidana'],								 
        		  			 	($row['nama_penyidik']=="")?"<span style='color:red;'>BELUM ADA</span>":$row['nama_penyidik'], 
        		  			 
        		  			  
        		  				" 
     <a class=\"btn btn-primary\" href=\" " . site_url("$controller/detail/".$id) ."\" >Detail </a>");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
    }



function baru(){

		$data['action']="simpan";
		$data['lap_b_id']="";
		$data['mode']="I";
		$data['controller'] = $this->controller;

		$temp_lap_b_id = $this->session->userdata("temp_lap_b_id"); 
		if($temp_lap_b_id == "") {
			$xx = md5(date("dmyhis").round(0,100)); 
			$this->session->set_userdata("temp_lap_b_id",$xx);
			$temp_lap_b_id = $this->session->userdata("temp_lap_b_id"); 
		}

		// echo $this->session->userdata("temp_lap_b_id");  exit;

		//$this->session->unset_userdata("temp_lap_b_id");
		$data['temp_lap_b_id']=$temp_lap_b_id;


		$data['arr_gol_kejahatan'] = $this->cm->get_arr_dropdown("m_golongan_kejahatan", 
			"id","golongan_kejahatan",'golongan_kejahatan');

		$data['arr_jenis_lokasi'] = $this->cm->get_arr_dropdown("m_jenis_lokasi", 
			"id_jenis_lokasi","jenis_lokasi",'jenis_lokasi');

		$data['arr_fungsi'] = $this->cm->get_arr_dropdown("m_fungsi", 
			"id_fungsi","fungsi",'id_fungsi');


		$data['arr_pangkat'] = $this->cm->get_arr_dropdown("m_pangkat", 
			"id_pangkat","pangkat",'pangkat');

		$data['arr_motif'] = $this->cm->get_arr_dropdown("m_motif", 
			"id_motif","motif",'motif');

		$data['arr_pekerjaan'] = $this->cm->get_arr_dropdown("m_pekerjaan", 
			"id_pekerjaan","pekerjaan",'pekerjaan');

		$data['arr_agama'] = $this->cm->get_arr_dropdown("m_agama", 
			"id_agama","agama",'agama');
		$data['arr_pendidikan'] = $this->cm->get_arr_dropdown("m_pendidikan", 
			"id_pendidikan","pendidikan",'pendidikan');

		$data['arr_warga_negara'] = $this->cm->get_arr_dropdown("m_warga_negara", 
			"id_warga_negara","warga_negara",'warga_negara');


		$data['json_url_terlapor'] = site_url("$this->controller/temp_get_lap_b_terlapor");
		$data['json_url_saksi'] = site_url("$this->controller/temp_get_lap_b_saksi");
		$data['json_url_korban'] = site_url("$this->controller/temp_get_lap_b_korban");
		$data['json_url_barbuk'] = site_url("$this->controller/temp_get_lap_b_barbuk");


		$data['tersangka_add_url'] = site_url("$this->controller/tmp_tersangka_simpan"); 
		$data['saksi_add_url'] = site_url("$this->controller/tmp_saksi_simpan"); 
		$data['korban_add_url'] = site_url("$this->controller/tmp_korban_simpan"); 
		$data['barbuk_add_url'] = site_url("$this->controller/tmp_barbuk_simpan"); 

		$content = $this->load->view($this->controller."_view_form",$data,true);
		$this->set_subtitle("INPUT LAPORAN POLISI TIPE B");
		$this->set_title("INPUT LAPORAN POLISI TIPE B");
		$this->set_content($content);
		$this->render_baru();
	 
} 


function simpan(){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tanggal','Tanggal','required'); 
		$this->form_validation->set_rules('id_pasal','Pasal','required');
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['mode']);
			unset($data['lap_b_id']);


			$data['tanggal'] = flipdate($data['tanggal']);
			$data['pelapor_tgl_lahir'] = flipdate($data['pelapor_tgl_lahir']);
			$data['kejadian_tanggal'] = flipdate($data['kejadian_tanggal']);
			$data['kejadian_tanggal_lapor'] = flipdate($data['kejadian_tanggal_lapor']);
			 
			$userdata = $this->userdata;
			$data['user_id'] = $userdata['id'];
			// $data['tanggal'] = flipdate($data['tanggal']);

			unset($data['nomor']);

			$data['nomor'] = $this->cm->get_lap_b_number($data);

			// echo "bangkeehh..";
			// echo $data['nomor']; 
			// exit;
			// exit;



			 $res = $this->db->insert("lap_b",$data);
			 $lap_b_id = $this->db->insert_id();
			 if($res) {

			 	$temp_lap_b_id = $this->session->userdata("temp_lap_b_id");

			 	$arr_update = array("lap_b_id"=>$lap_b_id);

			 	$this->db->where("temp_lap_b_id",$temp_lap_b_id);
			 	$this->db->update("lap_b_tersangka",$arr_update);

			 	$this->db->where("temp_lap_b_id",$temp_lap_b_id);
			 	$this->db->update("lap_b_saksi",$arr_update);

			 	$this->db->where("temp_lap_b_id",$temp_lap_b_id);
			 	$this->db->update("lap_b_korban",$arr_update);

			 	$this->db->where("temp_lap_b_id",$temp_lap_b_id);
			 	$this->db->update("lap_b_barbuk",$arr_update);


			 	$this->session->unset_userdata("temp_lap_b_id");


			 	$ret = array("error"=>false,"message"=>"data laporan tipe B berhasil disimpan");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}





function edit($id){
		 
		$data = $this->dm->detail($id); 

		// show_array($data);


		// $data['tanggal'] = flipdate($data['tanggal']);
		// $data['kp_dilaporkan_pada'] = flipdate($data['kp_dilaporkan_pada']);
		// $data['kp_tanggal'] = flipdate($data['kp_tanggal']);

		// show_array($data); exit;
		//$data = $arr['message'];
		$data['action']="update";
		$data['mode']="U";
		$data['controller'] = $this->controller;


		$data['arr_gol_kejahatan'] = $this->cm->get_arr_dropdown("m_golongan_kejahatan", 
			"id","golongan_kejahatan",'golongan_kejahatan');

		$data['arr_jenis_lokasi'] = $this->cm->get_arr_dropdown("m_jenis_lokasi", 
			"id_jenis_lokasi","jenis_lokasi",'jenis_lokasi');

		$data['arr_fungsi'] = $this->cm->get_arr_dropdown("m_fungsi", 
			"id_fungsi","fungsi",'id_fungsi');


		$data['arr_pangkat'] = $this->cm->get_arr_dropdown("m_pangkat", 
			"id_pangkat","pangkat",'pangkat');

		$data['arr_motif'] = $this->cm->get_arr_dropdown("m_motif", 
			"id_motif","motif",'motif');

		$data['arr_pekerjaan'] = $this->cm->get_arr_dropdown("m_pekerjaan", 
			"id_pekerjaan","pekerjaan",'pekerjaan');

		$data['arr_agama'] = $this->cm->get_arr_dropdown("m_agama", 
			"id_agama","agama",'agama');
		$data['arr_pendidikan'] = $this->cm->get_arr_dropdown("m_pendidikan", 
			"id_pendidikan","pendidikan",'pendidikan');

		$data['arr_warga_negara'] = $this->cm->get_arr_dropdown("m_warga_negara", 
			"id_warga_negara","warga_negara",'warga_negara');


		$data['json_url_terlapor'] = site_url("$this->controller/get_lap_b_terlapor/$id");
		$data['json_url_saksi'] = site_url("$this->controller/get_lap_b_saksi/$id");
		$data['json_url_korban'] = site_url("$this->controller/get_lap_b_korban/$id");
		$data['json_url_barbuk'] = site_url("$this->controller/get_lap_b_barbuk/$id");


		$data['tersangka_add_url'] = site_url("$this->controller/tersangka_simpan/$id"); 
		$data['saksi_add_url'] = site_url("$this->controller/saksi_simpan/$id"); 
		$data['korban_add_url'] = site_url("$this->controller/korban_simpan/$id"); 
		$data['barbuk_add_url'] = site_url("$this->controller/barbuk_simpan/$id"); 


		$content = $this->load->view($this->controller."_view_form",$data,true);
		
		$this->set_subtitle("EDIT DATA LAPORAN TIPE B");
		$this->set_title("EDIT DATA LAPORAN TIPE B");
		$this->set_content($content);
		$this->render_baru();
	}
function update(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tanggal','Tanggal','required'); 
		$this->form_validation->set_rules('id_pasal','Pasal','required');
 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			unset($data['mode']);		

			$data['tanggal'] = flipdate($data['tanggal']);
			$data['pelapor_tgl_lahir'] = flipdate($data['pelapor_tgl_lahir']);
			$data['kejadian_tanggal'] = flipdate($data['kejadian_tanggal']);
			$data['kejadian_tanggal_lapor'] = flipdate($data['kejadian_tanggal_lapor']);



			$this->db->where("lap_b_id",$data['lap_b_id']);
			 $res = $this->db->update("lap_b",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"Data berhasil diupdate");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
		
		 
	}
	
function hapus(){
	$data = $this->input->post();
	$this->db->where("lap_b_id",$data['id']);
	$res = $this->db->delete("lap_b");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}

function detail($id){

	$detail = $this->dm->detail($id);
	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['pelapor_tgl_lahir'] = flipdate($detail['pelapor_tgl_lahir']);
	$detail['kejadian_tanggal'] = flipdate($detail['kejadian_tanggal']);
	$detail['kejadian_tanggal_lapor'] = flipdate($detail['kejadian_tanggal_lapor']);

	
	$detail['controller'] = $this->controller;

		$data['json_url_terlapor'] = site_url("$this->controller/get_lap_b_terlapor/$id");
		$data['json_url_saksi'] = site_url("$this->controller/get_lap_b_saksi/$id");
		$data['json_url_korban'] = site_url("$this->controller/get_lap_b_korban/$id");
		$data['json_url_barbuk'] = site_url("$this->controller/get_lap_b_barbuk/$id");


		$data['tersangka_add_url'] = site_url("$this->controller/tersangka_simpan/$id"); 
		$data['saksi_add_url'] = site_url("$this->controller/saksi_simpan/$id"); 
		$data['korban_add_url'] = site_url("$this->controller/korban_simpan/$id"); 
		$data['barbuk_add_url'] = site_url("$this->controller/barbuk_simpan/$id"); 


	//show_array($detail);
	$content = $this->load->view($this->controller."_view_detail",$detail,true);
	$this->set_subtitle("DETAIL LAPORAN POLISI TIPE B NOMOR : ".$detail['nomor']);
	$this->set_title("DETAIL  LAPORAN  POLISI TIPE B NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_admin();


}

function get_detail_json($id) {
	$detail = $this->dm->detail($id);

	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['pelapor_tgl_lahir'] = flipdate($detail['pelapor_tgl_lahir']);
	$detail['kejadian_tanggal'] = flipdate($detail['kejadian_tanggal']);
	$detail['kejadian_tanggal_lapor'] = flipdate($detail['kejadian_tanggal_lapor']);
	// show_array($detail); exit;
	echo json_encode($detail);
}

function get_pasa_edit_dropdown(){
	$post = $this->input->post();
	extract($post);
	$this->db->where("id_fungsi",$id_fungsi);
	$res = $this->db->get("m_pasal");

	$html = "";
	foreach($res->result() as $row) : 
		$sel = ($row->id == $id_pasal)?"selected":"";
		$html .= "<option value=$row->id $sel >$row->pasal </option>";
	endforeach;
	echo $html;
}


function get_lap_b_terlapor($lap_b_id) {
	$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"tanggal"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"lap_b_id" => $lap_b_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_b_terlapor($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_b_terlapor($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['tersangka_nama'],
		flipdate($row['tersangka_tgl_lahir']),
		$row['tersangka_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['tersangka_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  "<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:tersangka_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:tersangka_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




function get_lap_b_tersangka_detail($id){
	$data = $this->dm->get_lap_b_tersangka_detail($id);
	$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);
	echo json_encode($data);
}







function get_lap_b_saksi($lap_b_id) {
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"lap_b_id" => $lap_b_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_b_saksi($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_b_saksi($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['saksi_nama'],
		flipdate($row['saksi_tgl_lahir']),
		$row['saksi_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['saksi_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:saksi_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:saksi_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}


function tersangka_add($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);
	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	$data['action']="tersangka_simpan";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="I";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_tersangka",$data,true);
	$this->set_subtitle("TAMBAH DATA TERSANGKA LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("TAMBAH DATA TERSANGKA LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function tersangka_simpan($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tersangka_nama','Nama','required'); 
		$this->form_validation->set_rules('tersangka_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['tersangka_id']);
			 


			$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_tersangka",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"I"
			 		);
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}

function tersangka_edit($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);

	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	$data['id'] = $this->uri->segment(4);
	$data['action']="tersangka_update";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="U";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_tersangka",$data,true);
	$this->set_subtitle("EDIT DATA TERSANGKA LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("EDIT DATA TERSANGKA LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}

function tersangka_update($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tersangka_nama','Nama','required'); 
		$this->form_validation->set_rules('tersangka_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['tersangka_id'];
			unset($data['tersangka_id']);
			 


			$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_tersangka",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


function tersangka_hapus(){
	$data = $this->input->post();
	$this->db->where("id",$data['id']);
	$res = $this->db->delete("lap_b_tersangka");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}





///// saksi 

function saksi_add($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);
	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	$data['action']="saksi_simpan";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="I";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_saksi",$data,true);
	$this->set_subtitle("TAMBAH DATA SAKSI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("TAMBAH DATA SAKSI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function saksi_simpan($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('saksi_nama','Nama','required'); 
		$this->form_validation->set_rules('saksi_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['saksi_id']);
			 


			$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_saksi",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"I");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}

function saksi_edit($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);

	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	$data['id'] = $this->uri->segment(4);
	$data['action']="saksi_update";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="U";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_saksi",$data,true);
	$this->set_subtitle("EDIT DATA SAKSI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("EDIT DATA SAKSI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function get_lap_b_saksi_detail($id){
	$data = $this->dm->get_lap_b_saksi_detail($id);
	$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);
	echo json_encode($data);
}

function saksi_update($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('saksi_nama','Nama','required'); 
		$this->form_validation->set_rules('saksi_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['saksi_id'];
			unset($data['saksi_id']);
			 


			$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_saksi",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


function saksi_hapus(){
	$data = $this->input->post();
	$this->db->where("id",$data['id']);
	$res = $this->db->delete("lap_b_saksi");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}




/// korban section 



function get_lap_b_korban($lap_b_id) {
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"lap_b_id" => $lap_b_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_b_korban($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_b_korban($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['korban_nama'],
		flipdate($row['korban_tgl_lahir']),
		$row['korban_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['korban_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:korban_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:korban_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}



///// korban handler  

function korban_add($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);
	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	$data['action']="korban_simpan";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="I";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_korban",$data,true);
	$this->set_subtitle("TAMBAH DATA KORBAN LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("TAMBAH DATA KORBAN LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function korban_simpan($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('korban_nama','Nama','required'); 
		$this->form_validation->set_rules('korban_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['korban_id']);
			 


			$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_korban",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"I");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}

function korban_edit($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);

	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	$data['id'] = $this->uri->segment(4);
	$data['action']="korban_update";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="U";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_korban",$data,true);
	$this->set_subtitle("EDIT DATA KORBAN LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("EDIT DATA KORBAN LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function get_lap_b_korban_detail($id){
	$data = $this->dm->get_lap_b_korban_detail($id);
	$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);
	echo json_encode($data);
}

function korban_update($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('korban_nama','Nama','required'); 
		$this->form_validation->set_rules('korban_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['korban_id'];
			unset($data['korban_id']);
			 


			$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_korban",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


function korban_hapus(){
	$data = $this->input->post();
	$this->db->where("id",$data['id']);
	$res = $this->db->delete("lap_b_korban");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}

/// end of korban 







function get_lap_b_barbuk($lap_b_id) {
		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"lap_b_id" => $lap_b_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_b_barbuk($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_b_barbuk($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['barbuk_nama'],
 
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:barbuk_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:barbuk_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




//// 
///// korban handler  

function barbuk_add($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);
	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	$data['action']="barbuk_simpan";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="I";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_barbuk",$data,true);
	$this->set_subtitle("TAMBAH DATA BARANG BUKTI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("TAMBAH DATA BARANG BUKTI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function barbuk_simpan($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('barbuk_nama','Nama','required'); 
 		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['barbuk_id']);
			 


 			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_barbuk",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"I");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}

function barbuk_edit($lap_b_id){
	$detail = $this->dm->detail($lap_b_id);

	// $detail['tanggal'] = flipdate($detail['tanggal']);
	// $detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	// $detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	$data['id'] = $this->uri->segment(4);
	$data['action']="barbuk_update";
	$data['lap_b_id']=$lap_b_id; 
	$data['mode']="U";
	$data['controller'] = $this->controller;

 

	//show_array($detail);
	$content = $this->load->view("lap_b_view_detail_form_barbuk",$data,true);
	$this->set_subtitle("EDIT DATA BARANG BUKTI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_title("EDIT DATA BARANG BUKTI LAPORAN NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_baru();

}



function get_lap_b_barbuk_detail($id){
	$data = $this->dm->get_lap_b_barbuk_detail($id);
	// $data['barbuk_tgl_lahir'] = flipdate($data['barbuk_tgl_lahir']);
	echo json_encode($data);
}

function barbuk_update($lap_b_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('barbuk_nama','Nama','required'); 
 		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['barbuk_id'];
			unset($data['barbuk_id']);
			$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_barbuk",$data);
			 // echo $this->db->last_query();
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data berhasil disimpan",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


function barbuk_hapus(){
	$data = $this->input->post();
	$this->db->where("id",$data['id']);
	$res = $this->db->delete("lap_b_barbuk");
	if($res){
		$ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

	}
	else {
		$ret = array("error"=>true,"message"=>"Data gagal dihapus");
	}
	echo json_encode($ret);
}

/// end of barbuk 




function pasal_simpan(){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');


		
		$this->form_validation->set_rules('txt_id_fungsi','Fungsi Terkait','required'); 
		$this->form_validation->set_rules('txt_pasal','Pasal','required');
 		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			
			 

			$arr_pasal['id_fungsi'] = $data['txt_id_fungsi'];
			$arr_pasal['pasal'] = $data['txt_pasal'];

 			
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("m_pasal",$arr_pasal);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data pasal berhasil disimpan",
			 		"mode"=>"I");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


// #TMP 

function temp_get_lap_b_terlapor() {


		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"temp_lap_b_id" => $this->session->userdata("temp_lap_b_id"),
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->temp_get_lap_b_terlapor($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->temp_get_lap_b_terlapor($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['tersangka_nama'],
		flipdate($row['tersangka_tgl_lahir']),
		$row['tersangka_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['tersangka_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:tersangka_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:tersangka_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




function tmp_tersangka_simpan(){
		$data=$this->input->post();


		$temp_lap_b_id = $this->session->userdata("temp_lap_b_id"); 
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tersangka_nama','Nama','required'); 
		$this->form_validation->set_rules('tersangka_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['tersangka_id']);
			 


			$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);

			$data['temp_lap_b_id'] = $temp_lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_tersangka",$data);
			 // echo $this->db->last_query();
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"Data tersangka berhasil disimpan",
			 		"mode"=>"I"
			 		);
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>mysql_error()."gagal dtabase" );
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors().'validation error');
		}
		
		echo json_encode($ret);
		
	}




function tmp_tersangka_update(){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('tersangka_nama','Nama','required'); 
		$this->form_validation->set_rules('tersangka_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['tersangka_id'];
			unset($data['tersangka_id']);
			 


			$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);
			//$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_tersangka",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data tersangka berhasil  diupdate",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}








/////// =========== #SAKSI SECTION ============ ///// 

function temp_get_lap_b_saksi() {


		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"temp_lap_b_id" => $this->session->userdata("temp_lap_b_id"),
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->temp_get_lap_b_saksi($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->temp_get_lap_b_saksi($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['saksi_nama'],
		flipdate($row['saksi_tgl_lahir']),
		$row['saksi_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['saksi_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:saksi_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:saksi_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




function tmp_saksi_simpan(){
		$data=$this->input->post();


		$temp_lap_b_id = $this->session->userdata("temp_lap_b_id"); 
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('saksi_nama','Nama','required'); 
		$this->form_validation->set_rules('saksi_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['saksi_id']);
			 


			$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);

			$data['temp_lap_b_id'] = $temp_lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_saksi",$data);
			 // echo $this->db->last_query();
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"Data saksi berhasil disimpan",
			 		"mode"=>"I"
			 		);
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>mysql_error()."gagal dtabase" );
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors().'validation error');
		}
		
		echo json_encode($ret);
		
	}




function tmp_saksi_update(){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('saksi_nama','Nama','required'); 
		$this->form_validation->set_rules('saksi_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['saksi_id'];
			unset($data['saksi_id']);
			 


			$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);
			//$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_saksi",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data saksi berhasil  diupdate",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}






/////// =========== #KORBAN SECTION ============ ///// 

function temp_get_lap_b_korban() {


		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"temp_lap_b_id" => $this->session->userdata("temp_lap_b_id"),
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->temp_get_lap_b_korban($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->temp_get_lap_b_korban($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['korban_nama'],
		flipdate($row['korban_tgl_lahir']),
		$row['korban_tmp_lahir'],
		$row['agama'],
		$row['suku'],
		$row['pekerjaan'],
		$row['korban_alamat']." - ". $row['desa']." - ".$row['kecamatan']." - ".$row['kota']." -  ".$row['provinsi'],
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:korban_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:korban_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




function tmp_korban_simpan(){
		$data=$this->input->post();


		$temp_lap_b_id = $this->session->userdata("temp_lap_b_id"); 
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('korban_nama','Nama','required'); 
		$this->form_validation->set_rules('korban_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 
			unset($data['korban_id']);
			 


			$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);

			$data['temp_lap_b_id'] = $temp_lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);


			 $res = $this->db->insert("lap_b_korban",$data);
			 // echo $this->db->last_query();
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"Data korban berhasil disimpan",
			 		"mode"=>"I"
			 		);
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>mysql_error()."gagal dtabase" );
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors().'validation error');
		}
		
		echo json_encode($ret);
		
	}




function tmp_korban_update(){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('korban_nama','Nama','required'); 
		$this->form_validation->set_rules('korban_id_desa','Desa','required'); 
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['korban_id'];
			unset($data['korban_id']);
			 


			$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);
			//$data['lap_b_id'] = $lap_b_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_b_korban",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data korban berhasil  diupdate",
			 		"mode"=>"U");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}


/////// =========== #BARBUK SECTION ============ ///// 

function temp_get_lap_b_barbuk() {


		$controller = get_class($this);
	 	$userdata = $this->session->userdata("userdata");
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"id"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        // $tanggal_awal = $_REQUEST['columns'][4]['search']['value'];
        // $tanggal_akhir = $_REQUEST['columns'][6]['search']['value'];
        // $status = $_REQUEST['columns'][7]['search']['value'];


      //  order[0][column]
        $req_param = array (
        		"temp_lap_b_id" => $this->session->userdata("temp_lap_b_id"),
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->temp_get_lap_b_barbuk($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->temp_get_lap_b_barbuk($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
		//$daft_id = $row['daft_id'];
        	 
		$id = $row['id'];
         
        	$arr_data[] = array(
   		 
		$row['barbuk_nama'],
 
        		  			 
        		  			  
        		  				"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a  href=\"javascript:barbuk_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

		<li><a  href=\"javascript:barbuk_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
 	 </ul>


	</div> ");
        endforeach;

         $responce = array('draw' => $draw, // ($start==0)?1:$start,
        				  'recordsTotal' => $count, 
        				  'recordsFiltered' => $count,
        				  'data'=>$arr_data
        	);
         
        echo json_encode($responce); 
}




function simpan_penyidik(){
		$data=$this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_penyidik','Nama Penyidik','callback_cek_penyidik');	
 		 		
		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$userdata = $_SESSION['userdata'];
		     $data['id_admindik'] = $userdata['id'];
			 $data['waktu_penugasan'] = date("Y-m-d h:i:s");
			 $this->db->where("lap_b_id",$data['lap_b_id']);
			 $res = $this->db->update("lap_b",$data);
			 if($res) {
			 	$ret = array("error"=>false,"message"=>"data penyidik berhasil disimpan","mode"=>"I");
			 }
			 else {
			 	$ret = array("error"=>true,"message"=>$this->db->_error_message());
			 }
			 
		}
		else {
			$ret = array("error"=>true,"message"=>validation_errors());
		}
		
		echo json_encode($ret);
		
	}

}
?>