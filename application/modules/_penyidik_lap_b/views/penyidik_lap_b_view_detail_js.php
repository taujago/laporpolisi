<script type="text/javascript">

$(document).ready(function(){

  $(".tanggal").datepicker()
		.on('changeDate', function(ev){                 
		    $(this).datepicker('hide');
		});



		 var dt_terlapor = $("#terlapor").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo site_url("$controller/get_lap_b_terlapor/$lap_b_id") ?>'
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
		        "ajax": '<?php echo site_url("$controller/get_lap_b_saksi/$lap_b_id") ?>'
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
		        "ajax": '<?php echo site_url("$controller/get_lap_b_korban/$lap_b_id") ?>'
		 	});

		 	var dt_korban = $("#barbuk").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo site_url("$controller/get_lap_b_barbuk/$lap_b_id") ?>'
		 	});



 		var dt_catatan = $("#tbl_catatan").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": false } ],
				"processing": true,
		        "serverSide": true,
		        "bLengthChange": false,
		        "bInfo": false,
		        "ajax": '<?php echo site_url("$controller/get_lap_b_catatan/$lap_b_id") ?>'
		 	});








});



 

function simpan_penyidik(){
   $.ajax({
      url : $("#form_penyidik").attr('action'),
      data : $("#form_penyidik").serialize(),
      type : 'post',
      dataType : 'json',
      success : function(obj) {

      if(obj.error==false){
             
         BootstrapDialog.alert({
                  type: BootstrapDialog.TYPE_PRIMARY,
                  title: 'Informasi',
                  message: obj.message,
                   
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
}

 


function tambah_catatan() {
	 
	$('#modal_catatan').modal('show');

	$("#modal_catatan_judul").html('TAMBAH DATA CATATAN PROSES'); 

	$("#form_catatan").attr('action','<?php echo site_url("$controller/simpan_catatan"); ?>');
	

}






function catatan_simpan(){
	$('#myPleaseWait').modal('show');
		
		$.ajax({
			url : $("#form_catatan").attr('action'),
			data : $("#form_catatan").serialize(),
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
						 
						$("#modal_catatan").modal('hide'); 
						$('#tbl_catatan').DataTable().ajax.reload();						 
						$('#form_catatan')[0].reset();
						 		
						 
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


function catatan_edit(id) {
	 
	$('#modal_catatan').modal('show');

	$("#modal_catatan_judul").html('EDIT DATA CATATAN PROSES'); 

	$("#form_catatan").attr('action','<?php echo site_url("$controller/update_catatan"); ?>');
	
	$.ajax({
		url : '<?php echo site_url("$controller/get_json_detail_catatan"); ?>/'+id,
		dataType : 'json',
		success : function(obj) {
				$("#id").val(obj.id);
				$("#tanggal").val(obj.tanggal);
				$("#catatan").val(obj.catatan);
		}
	});






}


 

function catatan_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA CATATAN. ANDA YAKIN  ?  ',
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
                  	url : '<?php echo site_url("$controller/catatan_hapus") ?>',
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

                  		$('#tbl_catatan').DataTable().ajax.reload();	



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