<script type="text/javascript">
  
$(document).ready(function(){

    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });



    $("#form_tersangka").submit(function(){  // formulir tersangka handler 




    $('#myPleaseWait').modal('show');
    
    $.ajax({
      url : $("#form_tersangka").attr('action'),
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
                $('#form_tersangka')[0].reset();
                $('#tersangka_nama').focus();
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
    url : '<?php echo site_url("$controller/get_lap_b_tersangka_detail/$id"); ?>/',
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_tersangka").modal('show');
       $("#modal_tersangka_judul").html('EDIT DATA TERSANGKA');
       $(".tombol").prop('value','SIMPAN DATA TERSANGKA');
       $("#form_tersangka").prop('action','<?php echo site_url("$controller/tersangka_update/$lap_b_id") ?>')
      $("#tersangka_nama").val(jsonData.tersangka_nama);
      $("#tersangka_jk").val(jsonData.tersangka_jk).attr('selected','selected');
      $("#tersangka_id_suku").val(jsonData.tersangka_id_suku).attr('selected','selected');
      $("#tersangka_tmp_lahir").val(jsonData.tersangka_tmp_lahir);
      $("#tersangka_tgl_lahir").val(jsonData.tersangka_tgl_lahir);
      $("#tersangka_id_agama").val(jsonData.tersangka_id_agama).attr('selected','selected');
      $("#tersangka_id_pekerjaan").val(jsonData.tersangka_id_pekerjaan).attr('selected','selected');
      $("#tersangka_alamat").val(jsonData.tersangka_alamat);
      $("#tersangka_id").val(jsonData.id);
      $("#tersangka_id_provinsi").val(jsonData.tersangka_prov_id).attr('selected','selected');

    
    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kota_by_prop"); ?>/',
      data : {id_prop : jsonData.tersangka_prov_id, id_kota : jsonData.tersangka_kota_id },
      type : 'post',
      success: function(data){
        $("#tersangka_id_kota").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_kec_by_kota"); ?>/',
      data : { id_kota : jsonData.tersangka_kota_id, id_kec : jsonData.tersangka_kec_id },
      type : 'post',
      success: function(data){
        $("#tersangka_id_kecamatan").html('').append(data);
      }
    });


    $.ajax({
      url:'<?php echo site_url("general/get_dropdown_desa_by_kec"); ?>/',
      data : { id_kec : jsonData.tersangka_kec_id, id_desa : jsonData.tersangka_id_desa  },
      type : 'post',
      success: function(data){
        $("#tersangka_id_desa").html('').append(data);
      }
    });

      
    }
  });
 

<?php endif; ?>



});





</script>

<form action="<?php echo site_url("$controller/$action/$lap_b_id") ?>" id="form_tersangka" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Nama Tersangka </td>
              <TD><input type="text" class="form-control" name="tersangka_nama" id="tersangka_nama" placeholder="Nama Tersangka" /> </TD></tr>


              <tr><td >Jenis Kelamin</td>
              <TD>
              <?php 
                $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                echo form_dropdown("tersangka_jk",$arr_jk,'','id="tersangja_jk" class="form-control"');
              ?>
              </TD></tr>


              <tr><td>Suku </td>
              <TD>
                <?php 
                  $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
      "id_suku","suku",'suku');

                  echo form_dropdown("tersangka_id_suku",$arr_suku,'','id="tersangka_id_suku" class="form-control"'); 



                ?>

              </TD></tr>


                <tr><td>Tempat Lahir </td>
              <TD><input type="text" class="form-control" name="tersangka_tmp_lahir" id="tersangka_tmp_lahir" placeholder="Tempat Lahir" /></TD></tr>

               <tr><td>Tanggal Lahir </td>
              <TD><input type="text" class="tanggal form-control" name="tersangka_tgl_lahir" id="tersangka_tgl_lahir" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" /></TD></tr>

                <tr><td>Agama </td>
              <TD>
 <?php 
                  $arr_agama = $this->cm->get_arr_dropdown("m_agama", 
      "id_agama","agama",'id_agama');

                  echo form_dropdown("tersangka_id_agama",$arr_agama,'','id="tersangka_id_agama" class="form-control"'); 



                ?>
              </TD></tr>



                <tr><td>Pekerjaan</td>
              <TD>
<?php 
                  $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
      "id_pekerjaan","pekerjaan",'pekerjaan');

                  echo form_dropdown("tersangka_id_pekerjaan",$arr_pekerjaan,'','id="tersangka_id_pekerjaan" class="form-control"'); 



                ?>

               </TD></tr>


                <tr><td>Alamat </td>
              <TD><input type="text" class="form-control" name="tersangka_alamat" id="tersangka_alamat" placeholder="Alamat" /></TD></tr>


                <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="tersangka_id_provinsi" class="form-control" onchange="get_kota(this,\'#tersangka_id_kota\',1)"'); 



                ?>


                <tr><td>Kabupaten / Kota </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="tersangka_id_kota" class="form-control" onchange="get_kecamatan(this,\'#tersangka_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="tersangka_id_kecamatan" class="form-control" onchange="get_desa(this,\'#tersangka_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("tersangka_id_desa",array(),'','id="tersangka_id_desa" class="form-control" '); 
                ?>

                <input type="hidden" name="tersangka_id" value=""  id="tersangka_id"  />
              </TD></tr>
            </table>
            
        <br />
            <center>  
            <a id="batal" href="<?php echo site_url("$controller/detail/$lap_b_id") ?>" class="btn btn-md btn-danger">BATAL </a> 
             <input  type="submit" value="SIMPAN TERSANGKA" class="tombol btn btn-md btn-primary">
           
            </center>
             </form>
<?php $this->load->view("js/general_js") ?>