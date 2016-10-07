<script type="text/javascript">
  
$(document).ready(function(){

    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });



    $("#form_korban").submit(function(){  // formulir korban handler 




    $('#myPleaseWait').modal('show');
    
    $.ajax({
      url : $("#form_korban").attr('action'),
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
                $('#form_korban')[0].reset();
                $('#korban_nama').focus();
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
    url : '<?php echo site_url("$controller/get_lap_a_korban_detail/$id"); ?>/',
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_korban").modal('show');
       $("#modal_korban_judul").html('EDIT DATA KORBAN');
       $(".tombol").prop('value','UPDATE DATA KORBAN');
       $("#form_korban").prop('action','<?php echo site_url("$controller/korban_update/$lap_a_id") ?>')
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
 

<?php endif; ?>



});





</script>

<form action="<?php echo site_url("$controller/$action/$lap_a_id") ?>" id="form_korban" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Nama korban </td>
              <TD><input type="text" class="form-control" name="korban_nama" id="korban_nama" placeholder="Nama korban" /> </TD></tr>


              <tr><td >Jenis Kelamin</td>
              <TD>
              <?php 
                $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                echo form_dropdown("korban_jk",$arr_jk,'','id="tersangja_jk" class="form-control"');
              ?>
              </TD></tr>


              <tr><td>Suku </td>
              <TD>
                <?php 
                  $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
      "id_suku","suku",'suku');

                  echo form_dropdown("korban_id_suku",$arr_suku,'','id="korban_id_suku" class="form-control"'); 



                ?>

              </TD></tr>


                <tr><td>Tempat Lahir </td>
              <TD><input type="text" class="form-control" name="korban_tmp_lahir" id="korban_tmp_lahir" placeholder="Tempat Lahir" /></TD></tr>

               <tr><td>Tanggal Lahir </td>
              <TD><input type="text" class="tanggal form-control" name="korban_tgl_lahir" id="korban_tgl_lahir" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" /></TD></tr>

                <tr><td>Agama </td>
              <TD>
 <?php 
                  $arr_agama = $this->cm->get_arr_dropdown("m_agama", 
      "id_agama","agama",'id_agama');

                  echo form_dropdown("korban_id_agama",$arr_agama,'','id="korban_id_agama" class="form-control"'); 



                ?>
              </TD></tr>



                <tr><td>Pekerjaan</td>
              <TD>
<?php 
                  $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
      "id_pekerjaan","pekerjaan",'pekerjaan');

                  echo form_dropdown("korban_id_pekerjaan",$arr_pekerjaan,'','id="korban_id_pekerjaan" class="form-control"'); 



                ?>

               </TD></tr>


                <tr><td>Alamat </td>
              <TD><input type="text" class="form-control" name="korban_alamat" id="korban_alamat" placeholder="Alamat" /></TD></tr>


                <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="korban_id_provinsi" class="form-control" onchange="get_kota(this,\'#korban_id_kota\',1)"'); 



                ?>


                <tr><td>Kabupaten / Kota </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="korban_id_kota" class="form-control" onchange="get_kecamatan(this,\'#korban_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="korban_id_kecamatan" class="form-control" onchange="get_desa(this,\'#korban_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("korban_id_desa",array(),'','id="korban_id_desa" class="form-control" '); 
                ?>

                <input type="hidden" name="korban_id" value=""  id="korban_id"  />
              </TD></tr>
            </table>
            
        <br />
            <center>  
            <a id="batal" href="<?php echo site_url("$controller/detail/$lap_a_id") ?>" class="btn btn-md btn-danger">BATAL </a> 
             <input  type="submit" value="SIMPAN KORBAN" class="tombol btn btn-md btn-primary">
           
            </center>
             </form>
<?php $this->load->view("js/general_js") ?>