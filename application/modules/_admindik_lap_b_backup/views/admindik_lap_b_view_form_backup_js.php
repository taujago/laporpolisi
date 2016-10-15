<script>


$(document).ready(function(){

$(".tanggal").datepicker()
		.on('changeDate', function(ev){                 
		    $(this).datepicker('hide');
		});


	
	$("#formulir").submit(function(){

		$('#myPleaseWait').modal('show');
		
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

 
 

</script>