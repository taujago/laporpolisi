<script type="text/javascript">
  
$(document).ready(function(){

    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });



    $("#form_barbuk").submit(function(){  // formulir barbuk handler 




    $('#myPleaseWait').modal('show');
    
    $.ajax({
      url : $("#form_barbuk").attr('action'),
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
            if(obj.mode == "I") {
                $('#form_barbuk')[0].reset();
                $('#barbuk_nama').focus();
             }  
             
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



<?php if($mode=="U") :  ?>

 
  $.ajax({
    url : '<?php echo site_url("$controller/get_lap_a_barbuk_detail/$id"); ?>/',
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_barbuk").modal('show');
       $("#modal_barbuk_judul").html('EDIT DATA BARANG BUKTI');
       $(".tombol").prop('value','UPDATE DATA BARANG BUKTI');
       $("#form_barbuk").prop('action','<?php echo site_url("$controller/barbuk_update/$lap_a_id") ?>'); 
       $("#barbuk_nama").val(jsonData.barbuk_nama);
       $("#barbuk_id").val(jsonData.id);
      

      
    }
  });
 

<?php endif; ?>



});





</script>

<form action="<?php echo site_url("$controller/$action/$lap_a_id") ?>" id="form_barbuk" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Barang bukti </td>
              <TD><input type="text" class="form-control" name="barbuk_nama" id="barbuk_nama" placeholder="Barang bukti" /> 
              <input type="hidden" name="barbuk_id" value=""  id="barbuk_id"  />
              </TD></tr>


              
 
                
               
            </table>
            
        <br />
            <center>  
            <a id="batal" href="<?php echo site_url("$controller/detail/$lap_a_id") ?>" class="btn btn-md btn-danger">BATAL </a> 
             <input  type="submit" value="SIMPAN BARANG BUKTI" class="tombol btn btn-md btn-primary">
           
            </center>
             </form>
<?php $this->load->view("js/general_js") ?>