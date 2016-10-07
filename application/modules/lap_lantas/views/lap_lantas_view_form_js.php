<script>


$(document).ready(function(){

$(".tanggal").datepicker()
		.on('changeDate', function(ev){                 
		    $(this).datepicker('hide');
		});



		var dt_pengemudi = $("#pengemudi").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_pengemudi ?>'
		 	});



		 /// saksi section 
			var dt_saksi = $("#saksi").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_saksi ?>'
		 	});

		 	
		 	var dt_korban = $("#korban").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_korban ?>'
		 	});


		 	var dt_kendaraan = $("#kendaraan").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo $json_url_kendaraan ?>'
		 	});


		 	








	
	$("#formulir").submit(function(){

		// $('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#formulir").attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						
						if($("#mode").val() == "I") { 
							$('#pengemudi').DataTable().ajax.reload();
							$('#saksi').DataTable().ajax.reload();
							$('#korban').DataTable().ajax.reload();
							
						$("#formulir")[0].reset(); }


						
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
		return false;
	 
	});





<?php if($mode == "U") : ?>
$.ajax({
	url : '<?php echo site_url("$controller/get_detail_json/$lap_laka_lantas_id") ?>',
	dataType : 'json',
	type : 'post',
 	success : function(jsonData){
 		$("#formulir").loadJSON(jsonData);
 		

 	 

 		// $.ajax({
 		// 	url : '<?php echo site_url("$controller/get_pasa_edit_dropdown/") ?>',
			// type : 'post',
			// data : {id_fungsi : jsonData.id_fungsi, id_pasal : jsonData.id_pasal  },
			// success : function(pasalData) {
			// 	$("#id_pasal").html(pasalData);
			// }
 		// });




 		// $.ajax({
	  //     url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
	  //     data : {id_prop : jsonData.kp_tempat_prov_id, 
	  //     		id_kota : jsonData.kp_tempat_kota_id },
	  //     type : 'post',
	  //     success: function(data){
	  //       $("#kp_tempat_id_kota").html('').append(data);
	  //     }
	  //   });


	  //   $.ajax({
	  //     url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
	  //     data : { id_kota : jsonData.kp_tempat_kota_id, id_kec : jsonData.kp_tempat_kec_id },
	  //     type : 'post',
	  //     success: function(data){
	  //       $("#kp_tempat_id_kecamatan").html('').append(data);
	  //     }
	  //   });


	  //   $.ajax({
	  //     url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
	  //     data : { id_kec : jsonData.kp_tempat_kec_id, id_desa : jsonData.kp_tempat_id_desa  },
	  //     type : 'post',
	  //     success: function(data){
	  //       $("#kp_tempat_id_desa").html('').append(data);
	  //     }
	  //   });
 		
 		
 		
 		
 		
	 	}
});

<?php endif; ?>






});
 





var tersangka_couter = 1;
function tersangka_row_add(){

	var row_data = $("#row_tersangka").html();
	//alert(row_data);
	
	id_row = "tr_tersangka_"+tersangka_couter;
	row_data = row_data.replace("<table>",'');
	row_data = row_data.replace("</table>",'');
	row_data = row_data.replace("someid",id_row);
	row_data = row_data.replace("someid",id_row);
	console.log(row_data);
//	alert(row_data);
	$("#table_tersangka").append(row_data);
	//$("#table_tersangka").html('<h1>asshome</h1>');
	tersangka_couter++;
}


function hapus_row_tersangka(id){
	id = "#"+id;
	$(id).remove();

	//alert(id);
}


function tambah_pasal() {
	id_fungsi = $("#id_fungsi").val();
	//alert('adfdfjdk' + id_fungsi);
	$('#pasalmodal').modal('show');

}

function pasal_simpan() {
	 
	// $("#frmModalPasal").submit(function(){
		$.ajax({
			url : $("#frmModalPasal").attr('action'),
			data : $("#frmModalPasal").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#pasalmodal").modal('hide'); // tutup modal 
						$('#frmModalPasal')[0].reset();

						$("#id_fungsi").val($("#txt_id_fungsi").val()).attr('selected','selected');

						// refresh list 
						$.ajax({

							url : '<?php echo site_url("general/get_pasal") ?>',
							data : {id_fungsi : $("#txt_id_fungsi").val()},
							type : 'post',
							success : function(htmldata) {
								$("#id_pasal").html(htmldata);
							}

						});

						 
						
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
	// });
	return false;
} 
 
function pengemudi_add() {
	 
	$('#pengemudi_modal').modal('show');

	// $("#form_tersangka").attr('action','<?php echo site_url("$controller/tmp_pengemudi_simpan") ?>'); 

	$("#form_pengemudi").attr('action','<?php echo $pengemudi_add_url; ?>');
	

}
 


function pengemudi_edit(id) {
	 
$('#pengemudi_modal').modal('show');
$("#form_pengemudi").attr('action','<?php echo site_url("$controller/tmp_pengemudi_update") ?>'); 

$.ajax({
    url : '<?php echo site_url("$controller/get_lap_lantas_pengemudi_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $('#pengemudi_modal').modal('show');
       $("#modal_pengemudi_judul").html('EDIT DATA PENGEMUDI');
       $(".tombol").prop('value','UPDATE DATA PENGEMUDI');       
      $("#pengemudi_nama").val(jsonData.pengemudi_nama);
      $("#pengemudi_jk").val(jsonData.pengemudi_jk).attr('selected','selected');
      $("#pengemudi_id_agama").val(jsonData.pengemudi_id_agama).attr('selected','selected');
      $("#pengemudi_id_pekerjaan").val(jsonData.pengemudi_id_pekerjaan).attr('selected','selected');
      $("#pengemudi_alamat").val(jsonData.pengemudi_alamat);
 		$("#pengemudi_tgl_lahir").val(jsonData.pengemudi_tgl_lahir);
 		$("#lap_laka_lantas_pengemudi_id").val(jsonData.lap_laka_lantas_pengemudi_id);


    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.pengemudi_prov_id, id_kota : jsonData.pengemudi_kota_id },
      type : 'post',
      success: function(data){
        $("#pengemudi_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.pengemudi_kota_id, id_kec : jsonData.pengemudi_kec_id },
      type : 'post',
      success: function(data){
        $("#pengemudi_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.pengemudi_kec_id, id_desa : jsonData.pengemudi_id_desa  },
      type : 'post',
      success: function(data){
        $("#pengemudi_id_desa").html('').append(data);
      }
    });

      
    }
  });
	

}



function korban_edit(id) {
	 
$('#korban_modal').modal('show');
$("#form_korban").attr('action','<?php echo site_url("$controller/tmp_korban_update") ?>'); 

$.ajax({
    url : '<?php echo site_url("$controller/get_lap_lantas_korban_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $('#korban_edit').modal('show');
       $("#modal_korban_judul").html('EDIT DATA KORBAN');
       $(".tombol").prop('value','UPDATE DATA KORBAN');       
      $("#korban_nama").val(jsonData.korban_nama);
      $("#korban_jk").val(jsonData.korban_jk).attr('selected','selected');
      $("#korban_id_agama").val(jsonData.korban_id_agama).attr('selected','selected');
      $("#korban_id_pekerjaan").val(jsonData.korban_id_pekerjaan).attr('selected','selected');
      $("#korban_alamat").val(jsonData.korban_alamat);
 		$("#korban_tgl_lahir").val(jsonData.korban_tgl_lahir);
 		$("#korban_cidera").val(jsonData.korban_cidera);
 		$("#korban_tmp_dirawat").val(jsonData.korban_tmp_dirawat);
 		$("#korban_id").val(jsonData.korban_id);


 		$.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.korban_prov_id, id_kota : jsonData.korban_kota_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.korban_kota_id, id_kec : jsonData.korban_kec_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.korban_kec_id, id_desa : jsonData.korban_id_desa  },
      type : 'post',
      success: function(data){
        $("#korban_id_desa").html('').append(data);
      }
    });
    
   


      
    }
  });
	

}


 

function pengemudi_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_pengemudi").attr('action'),
			data : $("#form_pengemudi").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#pengemudi_modal").modal('hide'); 
						$('#pengemudi').DataTable().ajax.reload();						 
						$('#form_pengemudi')[0].reset();
						 		
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
		return false;
}



function tersangka_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA TERSANGKA. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/tersangka_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#terlapor').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}


function korban_add() {
	 

	$('#korban_modal').modal('show');
	// $("#form_korban").attr('action','<?php echo site_url("$controller/tmp_korban_simpan") ?>');
	$("#form_korban").attr('action','<?php echo  $korban_add_url; ?>');


	

}

function korban_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_korban").attr('action'),
			data : $("#form_korban").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#korban_modal").modal('hide'); 
						$('#korban').DataTable().ajax.reload();						 
						$('#form_korban')[0].reset();
						 		
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
		return false;
}


function ags(id){


	$('#korban_modal').modal('show');
	$("#form_korban").attr('action','<?php echo site_url("$controller/tmp_korban_update") ?>'); 


	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_a_korban_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_korban").modal('show');
       $("#modal_korban_judul").html('EDIT DATA KORBAN');
       $(".tombol").prop('value','UPDATE DATA KORBAN');
      $("#korban_nama").val(jsonData.korban_nama);
      $("#korban_jk").val(jsonData.korban_jk).attr('selected','selected');
      $("#korban_id_suku").val(jsonData.korban_id_suku).attr('selected','selected');
      $("#korban_tmp_lahir").val(jsonData.korban_tmp_lahir);
      $("#korban_tgl_lahir").val(jsonData.korban_tgl_lahir);
      $("#korban_id_agama").val(jsonData.korban_id_agama).attr('selected','selected');
      $("#korban_id_pekerjaan").val(jsonData.korban_id_pekerjaan).attr('selected','selected');
      $("#korban_alamat").val(jsonData.korban_alamat);
      $("#korban_id").val(jsonData.id);
      $("#korban_id_provinsi").val(jsonData.korban_prov_id).attr('selected','selected');

    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.korban_prov_id, id_kota : jsonData.korban_kota_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.korban_kota_id, id_kec : jsonData.korban_kec_id },
      type : 'post',
      success: function(data){
        $("#korban_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.korban_kec_id, id_desa : jsonData.korban_id_desa  },
      type : 'post',
      success: function(data){
        $("#korban_id_desa").html('').append(data);
      }
    });

      
    }
  });
}




function korban_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA KORBAN. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/korban_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#korban').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}






// #SAKSI SECTION 


function saksi_add() {
	 

	$('#saksi_modal').modal('show');
	// $("#form_saksi").attr('action','<?php echo site_url("$controller/tmp_saksi_simpan") ?>');
	$("#form_saksi").attr('action','<?php echo $saksi_add_url; ?>');


}

function saksi_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_saksi").attr('action'),
			data : $("#form_saksi").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#saksi_modal").modal('hide'); 
						$('#saksi').DataTable().ajax.reload();						 
						$('#form_saksi')[0].reset();
						 		
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
		return false;
}


function saksi_edit(id){


	$('#saksi_modal').modal('show');
	$("#form_saksi").attr('action','<?php echo site_url("$controller/tmp_saksi_update") ?>'); 


	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_lantas_saksi_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_saksi").modal('show');
       $("#modal_saksi_judul").html('EDIT DATA saksi');
       $(".tombol").prop('value','UPDATE DATA saksi');
      $("#saksi_nama").val(jsonData.saksi_nama);
      $("#saksi_jk").val(jsonData.saksi_jk).attr('selected','selected');
      $("#saksi_id_agama").val(jsonData.saksi_id_agama).attr('selected','selected');
      $("#saksi_tgl_lahir").val(jsonData.saksi_tgl_lahir).attr('selected','selected');
      $("#saksi_id_pekerjaan").val(jsonData.saksi_id_pekerjaan).attr('selected','selected');
      $("#saksi_alamat").val(jsonData.saksi_alamat);
      $("#saksi_id").val(jsonData.saksi_id);

    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.saksi_prov_id, id_kota : jsonData.saksi_kota_id },
      type : 'post',
      success: function(data){
        $("#saksi_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.saksi_kota_id, id_kec : jsonData.saksi_kec_id },
      type : 'post',
      success: function(data){
        $("#saksi_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.saksi_kec_id, id_desa : jsonData.saksi_id_desa  },
      type : 'post',
      success: function(data){
        $("#saksi_id_desa").html('').append(data);
      }
    });

      
    }
  });
}


function pengemudi_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PENGEMUDI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/pengemudi_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#pengemudi').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}



function saksi_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA SAKSI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/saksi_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#saksi').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}

// #kendaraan SECTION 


function kendaraan_add() {
	 

	$('#kendaraan_modal').modal('show');
	// $("#form_kendaraan").attr('action','<?php echo site_url("$controller/tmp_kendaraan_simpan") ?>');
	$("#form_kendaraan").attr('action','<?php echo $kendaraan_add_url ?>');
	$("#kendaraanModal").html('TAMBAH DATA KENDARAAN');


}

function kendaraan_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_kendaraan").attr('action'),
			data : $("#form_kendaraan").serialize(),
			dataType : 'json',
			type : 'post',
			success : function(obj) {
				$('#myPleaseWait').modal('hide');
				 console.log(obj);
				if(obj.error==false){
					 	 
					 	 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_PRIMARY,
			                title: 'Informasi',
			                message: obj.message,
			                 
			            });   
						 
						$("#kendaraan_modal").modal('hide'); 
						$('#kendaraan').DataTable().ajax.reload();						 
						$('#form_kendaraan')[0].reset();
						 		
						 
					}
					else {
						 BootstrapDialog.alert({
			                type: BootstrapDialog.TYPE_DANGER,
			                title: 'Error',
			                message: obj.message ,
			                 
			            }); 
					}
			}
		});
		return false;
}


function kendaraan_edit(id){

	// alert('fuck');
	$('#kendaraan_modal').modal('show');
	$("#form_kendaraan").attr('action','<?php echo site_url("$controller/tmp_kendaraan_update") ?>'); 

	$("#kendaraanModal").html('EDIT DATA KENDARAAN');
 

	$.ajax({
    url : '<?php echo site_url("$controller/get_lap_lantas_kendaraan_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_kendaraan").modal('show');
     $("#korbanModal").html('EDIT DATA KENDARAAN');
       $(".tombol").prop('value','UPDATE DATA KENDARAAN');
      $("#id").val(jsonData.id);
      $("#no_polisi").val(jsonData.no_polisi);
      $("#no_stnk").val(jsonData.no_stnk);      
      $("#jenis").val(jsonData.jenis);
      $("#model").val(jsonData.model);
      $("#merk").val(jsonData.merk);
      $("#tipe").val(jsonData.tipe);
      $("#tahun_buat").val(jsonData.tahun_buat);
      $("#vol_silinder").val(jsonData.vol_silinder);
      $("#no_rangka").val(jsonData.no_rangka);
      $("#no_mesin").val(jsonData.no_mesin);
      $("#warna_tnkb").val(jsonData.warna_tnkb);
      $("#warna_tnkb").val(jsonData.warna_tnkb);
      $("#kondisi_ban").val(jsonData.kondisi_ban);
 



      
    }
  });
}




function kendaraan_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA BARANG BUKTI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA ',
            draggable: true,
            buttons : [
              {
                label : 'IYA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                  	url : '<?php echo site_url("$controller/kendaraan_hapus") ?>',
                  	type : 'post',
                  	data : {id : id},
                  	dataType : 'json',
                  	success : function(obj) {
                  		$('#myPleaseWait').modal('hide'); 
                  		if(obj.error==false) {
                  				BootstrapDialog.alert({
				                      type: BootstrapDialog.TYPE_PRIMARY,
				                      title: 'Informasi',
				                      message: obj.message,
				                       
				                  });   

                  		$('#kendaraan').DataTable().ajax.reload();	



                  		}
                  		else {
                  			BootstrapDialog.alert({
			                      type: BootstrapDialog.TYPE_DANGER,
			                      title: 'Error',
			                      message: obj.message,
			                       
			                  }); 
                  		}
                  	}
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });
}


</script>