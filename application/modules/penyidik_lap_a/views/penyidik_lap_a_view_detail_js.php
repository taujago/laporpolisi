<script src="<?php echo base_url("assets") ?>/js/jquery.form.js"></script>
 
</script>
<script type="text/javascript">
$(document).ready(function(){

   

$(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });


		 var dt = $("#grid_penyidik").DataTable(
		 	{
		 		// "order": [[ 0, "desc" ]],
		 		// "iDisplayLength": 50,
				"columnDefs": [ { "targets": 0, "orderable": true } ],
				"processing": true,
		        "serverSide": true,
		        "ajax": '<?php echo site_url("$controller/get_data_penyidik/$lap_a_id") ?>'
		 	});

		 
		// $("#grid_penyidik").css("display","none");  
		 
		var dt_kembang = $("#grid_perkembangan").DataTable(
      {
        // "order": [[ 0, "desc" ]],
        // "iDisplayLength": 50,
        "columnDefs": [ { "targets": 0, "orderable": true } ],
        "processing": true,
            "serverSide": true,
            "ajax": '<?php echo site_url("$controller/get_data_perkembangan/$lap_a_id") ?>'
      });
				


$("#lidik").change(function(){

    $.ajax({
      url : '<?php echo site_url("general/get_tahap") ?>/'+$(this).val(),
      success : function(htmlData) {
          $("#id_tahap").html(htmlData);
          }

    });


});


// submit formulir 

// $("#formulir_perkembangan").submit(function(){


// });				 
 


	
});




function perkembangan_baru() {
   
  $("#perkembangan_modal").modal("show");
  $("#formulir_perkembangan").attr('action','<?php echo site_url("$controller/perkembangan_simpan/") ?>');
  $("#titleModal").html('TAMBAH DATA PERKEMBANGAN KASUS');
}


function perkembangan_simpan(){

// $("#formulir_perkembangan").submit();


$('#myPleaseWait').modal('show');
  $("#formulir_perkembangan").ajaxSubmit({
     dataType : 'json',
     success : function(obj){


        $('#myPleaseWait').modal('hide');

        if(obj.error==false){
               
           BootstrapDialog.alert({
                    type: BootstrapDialog.TYPE_PRIMARY,
                    title: 'Informasi',
                    message: obj.message,
                     
                });   
           
          
          $('#grid_perkembangan').DataTable().ajax.reload(); 
          $("#perkembangan_modal").modal('hide'); 
         
           
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


function perkembangan_hapus(id){

BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PENYIDIK. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA PENYIDIK',
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
                  	url : '<?php echo site_url("$controller/perkembangan_hapus") ?>',
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

                  		$('#grid_penyidik').DataTable().ajax.reload(); 
                      
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