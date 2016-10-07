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
		        "ajax": '<?php echo site_url("$controller/get_lap_a_terlapor/$lap_a_id") ?>'
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
		        "ajax": '<?php echo site_url("$controller/get_lap_a_saksi/$lap_a_id") ?>'
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
		        "ajax": '<?php echo site_url("$controller/get_lap_a_korban/$lap_a_id") ?>'
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
		        "ajax": '<?php echo site_url("$controller/get_lap_a_barbuk/$lap_a_id") ?>'
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


</script>