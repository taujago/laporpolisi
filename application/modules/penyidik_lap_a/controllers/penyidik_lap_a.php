<?php
class penyidik_lap_a extends penyidik_controller {
 	var $controller ;

	function penyidik_lap_a(){
		parent::__construct();
		 
		$this->load->model("coremodel","cm");
		$this->load->helper("tanggal");
		$this->load->model("penyidik_lap_a_model","dm");
		$this->controller = get_class($this);
		$this->userdata = $_SESSION['userdata'];

	}

	function hapus_session(){
		
		$this->session->unset_userdata("temp_lap_a_id");
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

		$this->set_subtitle("LAPORAN POLISI TIPE A");
		$this->set_title("LAPORAN  POLISI TIPE A");
		$this->set_content($content);
		$this->render_admin();
	}


function get_data(){
		$controller = get_class($this);
	 	$userdata = $_SESSION['userdata'];
      	$draw = $_REQUEST['draw']; // get the requested page 
    	$start = $_REQUEST['start'];
        $limit = $_REQUEST['length']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['order'][0]['column'])?$_REQUEST['order'][0]['column']:"level"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'][0]['dir'])?$_REQUEST['order'][0]['dir']:"desc"; // get the direction if(!$sidx) $sidx =1;  
        
        // $no_rangka = $_REQUEST['columns'][5]['search']['value'];
        $tanggal_awal = $_REQUEST['columns'][1]['search']['value'];
        $tanggal_akhir = $_REQUEST['columns'][2]['search']['value'];
        $id_fungsi = $_REQUEST['columns'][3]['search']['value'];


      //  order[0][column]
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null ,
				"tanggal_awal" => $tanggal_awal, 
				"tanggal_akhir" => $tanggal_akhir, 
				"id_fungsi" => $id_fungsi,
				"id_penyidik" => $userdata['id']
				 
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
        	 
$id = $row['lap_a_id'];
         
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


 
function detail($id){

	$detail = $this->dm->detail($id);
	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	$detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);

	
	$detail['controller'] = $this->controller;


	//show_array($detail);
	$content = $this->load->view($this->controller."_view_detail",$detail,true);
	$this->set_subtitle("DETAIL LAPORAN POLISI TIPE A NOMOR : ".$detail['nomor']);
	$this->set_title("DETAIL  LAPORAN  POLISI TIPE A NOMOR : ".$detail['nomor']);
	$this->set_content($content);
	$this->render_admin();


}

function get_detail_json($id) {
	$detail = $this->dm->detail($id);
	$detail['tanggal'] = flipdate($detail['tanggal']);
	$detail['kp_dilaporkan_pada'] = flipdate($detail['kp_dilaporkan_pada']);
	$detail['kp_tanggal'] = flipdate($detail['kp_tanggal']);
	// show_array($detail); exit;
	echo json_encode($detail);
}

 


function get_lap_a_terlapor($lap_a_id) {
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
        		"lap_a_id" => $lap_a_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_a_terlapor($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_a_terlapor($req_param)->result_array();
        

       
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




function get_lap_a_tersangka_detail($id){
	$data = $this->dm->get_lap_a_tersangka_detail($id);
	$data['tersangka_tgl_lahir'] = flipdate($data['tersangka_tgl_lahir']);
	echo json_encode($data);
}







function get_lap_a_saksi($lap_a_id) {
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
        		"lap_a_id" => $lap_a_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_a_saksi($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_a_saksi($req_param)->result_array();
        

       
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
 


function get_lap_a_saksi_detail($id){
	$data = $this->dm->get_lap_a_saksi_detail($id);
	$data['saksi_tgl_lahir'] = flipdate($data['saksi_tgl_lahir']);
	echo json_encode($data);
}
 


/// korban section 



function get_lap_a_korban($lap_a_id) {
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
        		"lap_a_id" => $lap_a_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_a_korban($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_a_korban($req_param)->result_array();
        

       
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

 



function get_lap_a_korban_detail($id){
	$data = $this->dm->get_lap_a_korban_detail($id);
	$data['korban_tgl_lahir'] = flipdate($data['korban_tgl_lahir']);
	echo json_encode($data);
}
 





function get_lap_a_barbuk($lap_a_id) {
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
        		"lap_a_id" => $lap_a_id,
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				"limit" => null 
				 
		);     
           
        $row = $this->dm->get_lap_a_barbuk($req_param)->result_array();
		
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_a_barbuk($req_param)->result_array();
        

       
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


 

function get_lap_a_barbuk_detail($id){
	$data = $this->dm->get_lap_a_barbuk_detail($id);
	// $data['barbuk_tgl_lahir'] = flipdate($data['barbuk_tgl_lahir']);
	echo json_encode($data);
}

function barbuk_update($lap_a_id){
		$data=$this->input->post();

 

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('barbuk_nama','Nama','required'); 
 		 
		$this->form_validation->set_message('required', ' %s Harus diisi ');
		
 		$this->form_validation->set_error_delimiters('', '<br>');
		if($this->form_validation->run() == TRUE ) { 

			$data['id'] = $data['barbuk_id'];
			unset($data['barbuk_id']);
			$data['lap_a_id'] = $lap_a_id;
			 

			 
			// $data['tanggal'] = flipdate($data['tanggal']);
			 $this->db->where("id",$data['id']);

			 $res = $this->db->update("lap_a_barbuk",$data);
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

function cek_penyidik($id_penyidik) {
	if($id_penyidik == "x") {
		$this->form_validation->set_message('cek_penyidik', ' %s Harus diisi ');
		return false;
	}
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
			 $this->db->where("lap_a_id",$data['lap_a_id']);
			 $res = $this->db->update("lap_a",$data);
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



function get_lap_a_catatan($lap_a_id) {
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
                "lap_a_id" => $lap_a_id,
                "sort_by" => $sidx,
                "sort_direction" => $sord,
                "limit" => null 
                 
        );     
           
        $row = $this->dm->get_lap_a_catatan($req_param)->result_array();
        
        $count = count($row); 
       
        
        $req_param['limit'] = array(
                    'start' => $start,
                    'end' => $limit
        );
          
        
        $result = $this->dm->get_lap_a_catatan($req_param)->result_array();
        

       
        $arr_data = array();
        foreach($result as $row) : 
        //$daft_id = $row['daft_id'];
            

        $id = $row['id'];
         
        $arr_data[] = array(
         
         
        flipdate($row['tanggal']),
        $row['catatan'],
         
                             
                              
                                "<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
        <li><a  href=\"javascript:catatan_edit('".$id."')\"><span class=\"glyphicon glyphicon-edit\"></span> Edit </a></li> 

        <li><a  href=\"javascript:catatan_hapus('".$id."')\"><span class=\"glyphicon glyphicon-remove\"></span> Hapus</a></li>
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



function simpan_catatan(){
        $data=$this->input->post();

 

        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tanggal','Tanggal','required'); 
        $this->form_validation->set_rules('catatan','Catatan','required'); 
         
        $this->form_validation->set_message('required', ' %s Harus diisi ');
        
        $this->form_validation->set_error_delimiters('', '<br>');
        if($this->form_validation->run() == TRUE ) { 
             

            unset($data['id']);
            $data['tanggal'] = flipdate($data['tanggal']);
          //  $data['lap_a_id'] = $lap_a_id;
             

             
            // $data['tanggal'] = flipdate($data['tanggal']);


             $res = $this->db->insert("lap_a_catatan",$data);
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

function get_json_detail_catatan($id){
    $this->db->where("id",$id);
    $data = $this->db->get("lap_a_catatan")->row_array();
    $data['tanggal'] = flipdate($data['tanggal']);
    echo json_encode($data);

}

// update_catatan
function update_catatan(){
        $data=$this->input->post();

 

        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tanggal','Tanggal','required'); 
        $this->form_validation->set_rules('catatan','Catatan','required'); 
         
        $this->form_validation->set_message('required', ' %s Harus diisi ');
        
        $this->form_validation->set_error_delimiters('', '<br>');
        if($this->form_validation->run() == TRUE ) { 
             

            // unset($data['id']);
            $data['tanggal'] = flipdate($data['tanggal']);
          //  $data['lap_a_id'] = $lap_a_id;
             

             
            // $data['tanggal'] = flipdate($data['tanggal']);
             $this->db->where("id",$data['id']);

             $res = $this->db->update("lap_a_catatan",$data);
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


function catatan_hapus(){
    $data = $this->input->post();
    $this->db->where("id",$data['id']);
    $res = $this->db->delete("lap_a_catatan");
    if($res){
        $ret = array("error"=>false,"message"=>"Data Berhasi dihapus");

    }
    else {
        $ret = array("error"=>true,"message"=>"Data gagal dihapus");
    }
    echo json_encode($ret);
}


}
?>
