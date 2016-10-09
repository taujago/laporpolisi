<?php
class lap_lantas_model extends CI_Model {
	function lap_lantas_model(){
		parent::__construct();
	}

 

function data($param){

	// show_array($param);

	$arr_column = array("nomor","tanggal","pelapor_nama","tindak_pidana", "operator");

	$sort_by = $arr_column[$param['sort_by']];

	$this->db->select('*')->from('lap_laka_lantas'); 

	
	


				// "tanggal_awall" => $tanggal_awal, 
				// "tanggal_akhir" => $tanggal_akhir,
				// "id_fungsi" => $id_fungsi 

    if($param['tanggal_awal']<> '') {
    	$tanggal_awal = flipdate($param['tanggal_awal']); 
    	$tanggal_akhir = flipdate($param['tanggal_akhir']); 
    	$this->db->where("tanggal between '$tanggal_awal' and '$tanggal_akhir'",null,false);
    }

    // if($param['id_fungsi'] > 0 ){
    // 	$this->db->where("id_fungsi",$param['id_fungsi']);
    // }




	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();

}


function get_lap_lantas_pengemudi($param){
	$arr_column = array(
		"pengemudi_nama",
		"pengemudi_jk",
		"pengemudi_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama,
				desa.desa, 
				kec.id as pengemudi_kec_id, 
				kec.kecamatan, 
				kota.id as pengemudi_kota_id, 
				kota.kota, 
				prov.id as pengemudi_prov_id ,prov.provinsi '
		)->from('lap_laka_pengemudi t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.pengemudi_id_pekerjaan ','left')
	
	->join('m_agama a','a.id_agama = t.pengemudi_id_agama','left')
	->join('tiger_desa desa','desa.id = t.pengemudi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')


	->where("t.lap_laka_lantas_id",$param['lap_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();


	// $res = $this->db->get();
}


	function get_list_daftar($param) {
		 
		// echo $this->db->last_query();

		$this->db->select('*')->from('pangkat'); 
		$res = $this->db->get();
		
		$arr = array();
		if($res->num_rows() > 0 ){
			foreach($res->result() as $row) : 
				$color = ($row->approved==1)?"green":"red";


				$arr[] = array(
						 $row->pangkat_id,
						 $rot->pangkat_nama,
						"<div class=\"btn-group\"> 
     <a class=\"btn dropdown-toggle btn-primary\" data-toggle=\"dropdown\" href=\"#\">Proses<span class=\"caret\"></span></a>
     
     <ul class=\"dropdown-menu\">
		<li><a   href=\" " . site_url("baru_verifikasi/detail/".$row->daft_id) ."\" ><span class=\"glyphicon glyphicon-chevron-right\"></span> Edit </a></li>
		<li><a   href=\" " . site_url("baru_verifikasi/cetak_permohonan/".$row->daft_id) ."\" ><span class=\"glyphicon glyphicon-print\"></span> Hapus </a></li>
		 
		
       
	</ul>


	</div> "
					);
			endforeach;
			$ret = array("error"=>false,"message"=>$arr);
		}
		else {
			$ret = array("error"=>true,"message"=>"DATA TIDAK DITEMUKAN");
		}
		return $ret;
	}

 



function get_lap_lantas_pengemudi_detail($id){

	$this->db->select(
		't.* , 
				k.pekerjaan, 
				a.agama,
				kec.id as pengemudi_kec_id, 
				kec.kecamatan, 
				kota.id as pengemudi_kota_id, 
				kota.kota, 
				prov.id as pengemudi_prov_id, 
				prov.provinsi')
	->from('lap_laka_pengemudi t')
	->join('m_pekerjaan k','k.id_pekerjaan = t.pengemudi_id_pekerjaan ','left')
	->join('m_agama a','a.id_agama = t.pengemudi_id_agama','left')

	->join('tiger_desa desa','desa.id = t.pengemudi_id_desa ','left')
	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left');


	$this->db->where("t.lap_laka_lantas_pengemudi_id",$id);
	$res = $this->db->get();
	return $res->row_array();
}




function get_lap_lantas_saksi_detail($id){

	$this->db->select(
		't.* , 	k.pekerjaan, 
				a.agama,
				desa.desa, 
				kec.id as saksi_kec_id, 
				kec.kecamatan, 
				kota.id as saksi_kota_id, 
				kota.kota, 
				prov.id as saksi_prov_id, 
				prov.provinsi'
		)->from('lap_laka_saksi t')
	->join('m_pekerjaan k','k.id_pekerjaan = t.saksi_id_pekerjaan','left')	
	->join('tiger_desa desa','desa.id = t.saksi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->join('m_agama a','a.id_agama = t.saksi_id_agama','left');
	$this->db->where("t.saksi_id",$id);
	$res = $this->db->get();
	return $res->row_array();
}









function get_lap_lantas_korban_detail($id){

	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				 a.agama,
				 desa.desa, 
				kec.id as korban_kec_id, 
				kec.kecamatan, 
				kota.id as korban_kota_id, 
				kota.kota, 
				prov.id as korban_prov_id, 
				prov.provinsi '
		)->from('lap_laka_korban t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.korban_id_pekerjaan ','left')

	->join('tiger_desa desa','desa.id = t.korban_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	
	->join('m_agama a','a.id_agama = t.korban_id_agama','left');
	$this->db->where("t.korban_id",$id);
	$res = $this->db->get();
	return $res->row_array();
}








function get_data_tersangka($lap_a_id) {
	$this->db->select(
		't.* , suku.suku, 
				k.pekerjaan, 
				desa.desa, 
				kec.id as tersangka_kec_id, 
				kec.kecamatan, 
				kota.id as tersangka_kota_id, 
				kota.kota, 
				prov.id as tersangka_prov_id, 
				prov.provinsi, a.agama '
		)->from('lap_a_tersangka t')
	->join('m_suku suku','suku.id_suku = t.tersangka_id_suku','left')
	->join('m_pekerjaan k','k.id_pekerjaan = t.tersangka_id_pekerjaan ','left')
	->join('tiger_desa desa','desa.id = t.tersangka_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->join('m_agama a','a.id_agama = t.tersangka_id_agama','left')
	->where("lap_a_id",$lap_a_id);

	$res = $this->db->get();
	// echo $this->db->last_query(); 
	return $res;
}


function get_data_korban($lap_a_id) {
	$this->db->select(
		't.* , suku.suku, 
				k.pekerjaan, 
				desa.desa, 
				kec.id as korban_kec_id, 
				kec.kecamatan, 
				kota.id as korban_kota_id, 
				kota.kota, 
				prov.id as korban_prov_id, 
				prov.provinsi, a.agama '
		)->from('lap_a_korban t')
	->join('m_suku suku','suku.id_suku = t.korban_id_suku','left')
	->join('m_pekerjaan k','k.id_pekerjaan = t.korban_id_pekerjaan ','left')
	->join('tiger_desa desa','desa.id = t.korban_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->join('m_agama a','a.id_agama = t.korban_id_agama','left')
	->where("lap_a_id",$lap_a_id);

	$res = $this->db->get();
	// echo $this->db->last_query(); 
	return $res;
}


function get_data_saksi($lap_a_id) {
	$this->db->select(
		't.* , suku.suku, 
				k.pekerjaan, 
				desa.desa, 
				kec.id as saksi_kec_id, 
				kec.kecamatan, 
				kota.id as saksi_kota_id, 
				kota.kota, 
				prov.id as saksi_prov_id, 
				prov.provinsi, a.agama '
		)->from('lap_a_saksi t')
	->join('m_suku suku','suku.id_suku = t.saksi_id_suku','left')
	->join('m_pekerjaan k','k.id_pekerjaan = t.saksi_id_pekerjaan ','left')
	->join('tiger_desa desa','desa.id = t.saksi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->join('m_agama a','a.id_agama = t.saksi_id_agama','left')
	->where("lap_a_id",$lap_a_id);

	$res = $this->db->get();
	// echo $this->db->last_query(); exit;
	return $res;
}

function get_data_barbuk($lap_a_id) {
	$this->db->select(
		't.*')->from("lap_a_barbuk t")
	->where("lap_a_id",$lap_a_id);
	$res = $this->db->get();
	return $res;
}

function get_data_pengemudi($lap_laka_lantas_id) {
	$this->db->where("lap_laka_lantas_id",$lap_laka_lantas_id); 
	$data = $this->db->get("v_lap_a")->row();
	return $data->pengemudi;
}


function detail($id){
	 $this->db->select('a.*, 
	 	 
pel_pangkat.pangkat as pelapor_pangkat,

meng_pangkat.pangkat as meng_pangkat,


				



u.nama as pengguna ')
->from("lap_laka_lantas a")

->join("m_pangkat pel_pangkat","pel_pangkat.id_pangkat = a.pelapor_id_pangkat ",'left')

->join("m_pangkat meng_pangkat","meng_pangkat.id_pangkat = a.pengetahui_id_pangkat",'left')
->join("pengguna u","u.id = a.user_id",'left')



->where("a.lap_laka_lantas_id",$id);

$res = $this->db->get(); 
// show_array($res);
// exit();


$data = $res->row_array();

return $data;




	 


	// lok.id_jenis_lokasi  = a.id_jenis_lokasi
}

// Get Data Table Pengemudi
function temp_get_lap_lantas_pengemudi($param){
	$arr_column = array(
		"pengemudi_nama",
		"pengemudi_jk",
		"pengemudi_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama,
				desa.desa, 
				kec.id as pengemudi_kec_id, 
				kec.kecamatan, 
				kota.id as pengemudi_kota_id, 
				kota.kota, 
				prov.id as pengemudi_prov_id ,prov.provinsi '
		)->from('lap_laka_pengemudi t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.pengemudi_id_pekerjaan ','left')
	
	->join('m_agama a','a.id_agama = t.pengemudi_id_agama','left')
	->join('tiger_desa desa','desa.id = t.pengemudi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')


	->where("t.temp_laka_lantas_id",$param['temp_lap_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();
}

// Get Data Tabel Saksi

function temp_get_lap_lantas_saksi($param){
	$arr_column = array(
		"saksi_nama",
		"saksi_jk",
		"saksi_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama,
				desa.desa, 
				kec.id as saksi_kec_id, 
				kec.kecamatan, 
				kota.id as saksi_kota_id, 
				kota.kota, 
				prov.id as saksi_prov_id, 
				prov.provinsi '
		)->from('lap_laka_saksi t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.saksi_id_pekerjaan','left')
	
	->join('m_agama a','a.id_agama = t.saksi_id_agama','left')
	->join('tiger_desa desa','desa.id = t.saksi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->where("t.temp_laka_lantas_id",$param['temp_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


 }


 function get_lap_lantas_saksi($param){
	$arr_column = array(
		"saksi_nama",
		"saksi_jk",
		"saksi_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama,
				desa.desa, 
				kec.id as saksi_kec_id, 
				kec.kecamatan, 
				kota.id as saksi_kota_id, 
				kota.kota, 
				prov.id as saksi_prov_id, 
				prov.provinsi '
		)->from('lap_laka_saksi t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.saksi_id_pekerjaan','left')
	
	->join('m_agama a','a.id_agama = t.saksi_id_agama','left')
	->join('tiger_desa desa','desa.id = t.saksi_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	->where("t.lap_laka_lantas_id",$param['lap_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


 }

function get_lap_lantas_korban($param){
	$arr_column = array(
		"korban_nama",
		"korban_jk",
		"korban_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama ,
				desa.desa,
				kec.id as tersangka_kec_id, 
				kec.kecamatan, 
				kota.id as tersangka_kota_id, 
				kota.kota, 
				prov.id as tersangka_prov_id, 
				prov.provinsi'
		)->from('lap_laka_korban t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.korban_id_pekerjaan','left')

	->join('tiger_desa desa','desa.id = t.korban_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	
	->join('m_agama a','a.id_agama = t.korban_id_agama','left')
	->where("t.lap_laka_lantas_id",$param['lap_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();
}



function temp_get_lap_lantas_korban($param){
	$arr_column = array(
		"korban_nama",
		"korban_jk",
		"korban_tgl_lahir",
		"agama",
		"pekerjaan",
		"alamat"
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.* ,  
				k.pekerjaan, 
				a.agama ,
				desa.desa,
				kec.id as tersangka_kec_id, 
				kec.kecamatan, 
				kota.id as tersangka_kota_id, 
				kota.kota, 
				prov.id as tersangka_prov_id, 
				prov.provinsi'
		)->from('lap_laka_korban t')
	
	->join('m_pekerjaan k','k.id_pekerjaan = t.korban_id_pekerjaan','left')

	->join('tiger_desa desa','desa.id = t.korban_id_desa ','left')

	->join('tiger_kecamatan kec','kec.id = desa.id_kecamatan ','left')
	->join('tiger_kota kota','kota.id = kec.id_kota ','left')
	->join('tiger_provinsi prov','prov.id = kota.id_provinsi','left')
	
	->join('m_agama a','a.id_agama = t.korban_id_agama','left')
	->where("t.temp_laka_lantas_id",$param['temp_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
		// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();
}



function temp_get_lap_lantas_kendaraan($param){
	$arr_column = array(
		 
		'no_polisi',
		'jenis',
		'tipe',
		'model',
		'tahun_buat',
		'kondisi_ban'
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.*'
		)->from('lap_laka_kendaraan t')
	
 


	->where("t.temp_laka_lantas_id",$param['temp_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
	// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();
}



function get_lap_lantas_kendaraan($param){
	$arr_column = array(
		 
		'no_polisi',
		'jenis',
		'tipe',
		'model',
		'tahun_buat',
		'kondisi_ban'
	);

	$sort_by = $arr_column[$param['sort_by']];
 
	$this->db->select(
		't.*'
		)->from('lap_laka_kendaraan t')
	
 


	->where("t.lap_laka_lantas_id",$param['lap_laka_lantas_id']);

	($param['limit'] != null ? $this->db->limit($param['limit']['end'], $param['limit']['start']) : '');
		//$this->db->limit($param['limit']['end'], $param['limit']['start']) ;
       
    ($param['sort_by'] != null) ? $this->db->order_by($sort_by, $param['sort_direction']) :'';
        
	$res = $this->db->get();
	// echo $this->db->last_query();
 	return $res;


	$res = $this->db->get();
}



function get_lap_lantas_kendaraan_detail($id){

	$this->db->select(
		't.*')
	->from('lap_laka_kendaraan t');
	
	$this->db->where("t.id",$id);
	$res = $this->db->get();
	return $res->row_array();
}

	
}
?>