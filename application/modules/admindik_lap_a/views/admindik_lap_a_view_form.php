<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>


<style type="text/css">
      .umur {
            width: 100px;
      }

   .dataTables_filter {
      display: none;
    }

.datepicker{z-index:9999 !important}
</style>
<form id="formulir" method="post" action="<?php echo site_url("$controller/$action"); ?>">
<table class='table table-bordered'>
      <tr class="separator"> <td colspan="2"> <b> LAP A</b>  </td> </tr>

     <tr><td width="161">Tanggal LP </td>
            <td width="516"><input type="text" class="tanggal form-control" name="tanggal" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" 
            

              />        </td>
      <tr><td>Nomor </td>
            <td><input readonly="readonly" type="text" class="form-control" name="nomor" id="nomor" placeholder="(auto generated)" />        </td>
      <tr><td>Golongan Kejahatan </td>
            <td><!-- <input type="text" class="form-control" name="id_gol_kejahatan" id="id_gol_kejahatan" placeholder="Golongan Kejahatan" />   -->   

            <?php echo form_dropdown("id_gol_kejahatan",$arr_gol_kejahatan,'','id="id_gol_kejahatan" class="form-control"') ?>

               </td>


      <tr><td>Kategori Tempat Kejahatan</td>
            <td>

            <?php echo form_dropdown("id_jenis_lokasi",$arr_jenis_lokasi,'','id="id_jenis_lokasi" class="form-control"') ?>

               </td>


      <tr><td>Tindak Pidana </td>
            <td><input type="text" class="form-control" name="tindak_pidana" id="tindak_pidana" placeholder="Tindak Pidana" />        </td></tr>
     
      <tr><td>Fungsi Terkait </td>
            <td>
                  <?php echo form_dropdown("id_fungsi",$arr_fungsi,'','id="id_fungsi" class="form-control"') ?>

               </td>
 

              
            </tr>

      <tr><td>Pasal </td>
            <td>
                <?php echo form_dropdown("id_pasal",array(),'','id="id_pasal" class="form-control"') ?>

                <a href="javascript:tambah_pasal();"> [+] Tambah Pasal  </a>
            </td> </tr>       
   <tr> <td colspan="2"> <b> PELAPOR</b>  </td> </tr>
      <tr><td> Nama Pelapor</td>
            <td><input type="text" class="form-control" name="pelapor_nama" id="pelapor_nama" placeholder="Pelapor Nama" />        </td>
      <tr><td>Pangkat </td>
            <td> 
            <?php echo form_dropdown("pelapor_id_pangkat",$arr_pangkat,'','id="pelapor_id_pangkat" class="form-control"') ?>

            </td>
      <tr><td>Nrp </td>
            <td><input type="text" class="form-control" name="pelapor_nrp" id="pelapor_nrp" placeholder="Nrp" />        </td>
      <tr><td>Kesatuan </td>
            <td><input type="text" class="form-control" name="pelapor_kesatuan" id="pelapor_kesatuan" placeholder="Kesatuan" />        </td>       
      <tr><td>Telpon </td>
            <td><input type="text" class="form-control" name="pelapor_tel" id="pelapor_tel" placeholder="Telpon Pelapor" />        </td>

   <tr class="separator"> <td colspan="2"> <b> PERISTIWA YANG TERJADI </b>  </td> </tr>

      <tr><td>Waktu Kejadian</td>
            <td><input type="text" class="form-control" name="kp_wktu" id="kp_wktu" placeholder="Waktu Kejadian" />        </td>
      <tr><td>Tanggal Kejadian</td>
            <td><input type="text" class="tanggal form-control" name="kp_tanggal" id="kp_tanggal" placeholder="Tanggal Kejadian" data-date-format="dd-mm-yyyy" />        </td>
      <tr><td>Tempat Kejadian</td>
            <td><input type="text" class="form-control" name="kp_tempat_kejadian" id="kp_tempat_kejadian" placeholder="Tempat Kejadian" />        </td>



<tr><td>  </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="kp_tempat_id_provinsi" class="form-control" onchange="get_kota(this,\'#kp_tempat_id_kota\',1)"'); 



                ?>


                <tr><td> </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="kp_tempat_id_kota" class="form-control" onchange="get_kecamatan(this,\'#kp_tempat_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>  </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="kp_tempat_id_kecamatan" class="form-control" onchange="get_desa(this,\'#kp_tempat_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td> </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("kp_tempat_id_desa",array(),'','id="kp_tempat_id_desa" class="form-control" '); 
                ?>





      <tr><td>Apa Yang Terjadi </td>
            <td>
            <!-- <input type="text" class="form-control" name="kp_apa_yang_terjadi" id="kp_apa_yang_terjadi" placeholder="Apa Yang Terjadi" />    -->     

            <textarea class="form-control" name="kp_apa_yang_terjadi" id="kp_apa_yang_terjadi" placeholder="Apa Yang Terjadi" ></textarea></td>
      <tr><td>Bagaimana Terjadi </td>
            <td><!-- <input type="text" class="form-control" name="kp_bagaimana_terjadi" id="kp_bagaimana_terjadi" placeholder="Bagaimana Terjadi" />    -->     
               <textarea  class="form-control" name="kp_bagaimana_terjadi" id="kp_bagaimana_terjadi" placeholder="Bagaimana Terjadi" ></textarea>

            </td>
      <tr><td>Uraian Singkat </td>
            <td><!-- <input type="text" class="form-control" name="kp_uraian_singkat" id="kp_uraian_singkat" placeholder="Uraian Singkat" />    -->     
              <textarea   class="form-control" name="kp_uraian_singkat" id="kp_uraian_singkat" placeholder="Uraian Singkat" ></textarea>

            </td>
      <tr><td> Dilaporkan Pada </td>
            <td><input type="text" class="tanggal form-control" name="kp_dilaporkan_pada" id="kp_dilaporkan_pada" placeholder="Dilaporkan Pada" data-date-format="dd-mm-yyyy" />        </td>
      <tr><td>Jam Dilaporkan </td>
            <td><input type="text" class="form-control" name="kp_jam_dilaporkan" id="kp_jam_dilaporkan" placeholder="Jam Dilaporkan" />        </td>
      <tr><td>Tempat Melaporkan </td>
            <td><input type="text" class="form-control" name="kp_tempat_melaporkan" id="kp_tempat_melaporkan" placeholder="Tempat Melaporkan" />        </td>
      <tr><td>Motif Kejahatan </td>
            <td> 


                  <?php echo form_dropdown("kp_id_motif_kejahatan",$arr_motif,'','id="kp_id_motif_kejahatan" class="form-control"') ?>

            </td>

      </tr>




 <!-- BEGIN OF FORM -->


 <tr class="separator"> <td colspan="2"> <b> TERLAPOR/TERSANGKA </b>  </td> </tr>
 <tr> <td colspan="2">

<a href="javascript:tersangka_add();" id="add_tersangka" class="btn btn-primary">Tambah Data Tersangka </a><br><br>

<!-- <a href="javascript:tambah_pasal();"> [+] Tambah Pasal  </a> -->

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="terlapor" role="grid">
<thead>
   <tr >

        <th width="10%">NAMA</th>
        <th width="12%">TGL. LAHIR</th>
        <th width="15%">TMP. LAHIR</th>
        <th width="10%">AGAMA</th>
        <th width="10%">SUKU</th>
        <th width="12%">PEKERJAAN</th>
        <th width="30%">ALAMAT</th>
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>

 </td> </tr>



 <tr class="separator"> <td colspan="2"> <b> SAKSI </b>  </td> </tr>
 <tr> <td colspan="2">
<a href="javascript:saksi_add();" id="add_saksi" class="btn btn-primary">Tambah Data Saksi </a><br><br>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="saksi" role="grid">
<thead>
   <tr >

        <th width="10%">NAMA</th>
        <th width="12%">TGL. LAHIR</th>
        <th width="15%">TMP. LAHIR</th>
        <th width="10%">AGAMA</th>
        <th width="10%">SUKU</th>
        <th width="12%">PEKERJAAN</th>
        <th width="30%">ALAMAT</th>
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>

 </td> </tr> 



 <tr class="separator"> <td colspan="2"> <b> KORBAN </b>  </td> </tr>
 <tr> <td colspan="2">
<a href="javascript:korban_add();" id="add_korban" class="btn btn-primary">Tambah Data Korban </a><br><br>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="korban" role="grid">
<thead>
   <tr >

        <th width="10%">NAMA</th>
        <th width="12%">TGL. LAHIR</th>
        <th width="15%">TMP. LAHIR</th>
        <th width="10%">AGAMA</th>
        <th width="10%">SUKU</th>
        <th width="12%">PEKERJAAN</th>
        <th width="30%">ALAMAT</th>
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>

 </td> </tr> 






 <tr class="separator"> <td colspan="2"> <b> BARANG BUKTI </b>  </td> </tr>
 <tr> <td colspan="2">
<a href="javascript:barbuk_add();" id="add_korban" class="btn btn-primary">Tambah Data Barang Bukti </a><br><br>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="barbuk" role="grid">
<thead>
   <tr >

        <th width="90%">BARANG BUKTI</th>         
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>

 </td> </tr> 





 <!-- END OF FORM -->








       <tr class="separator"> <td colspan="2"> <b> TINDAKAN YANG DILAKUKAN </b>  </td> </tr>
      <tr><td>Tindakan Yang Dilakukan </td>
            <td><!-- <input type="text" class="form-control" name="tindakan_yang_dilakukan" id="tindakan_yang_dilakukan" placeholder="Tindakan Yang Dilakukan" />   -->      
            <textarea  class="form-control" name="tindakan_yang_dilakukan" id="tindakan_yang_dilakukan" placeholder="Tindakan Yang Dilakukan" ></textarea>


            </td>
      </tr>
     <tr class="separator"> <td colspan="2"> <b> PENERIMA LAPORAN </b>  </td> </tr>
      <tr><td>Nama </td>
            <td><input type="text" class="form-control" name="pen_lapor_nama" id="pen_lapor_nama" placeholder="Nama" />        </td>
      <tr><td>Pangkat  </td>
              
<td>
                   <?php echo form_dropdown("pen_lapor_id_pangkat",$arr_pangkat,'','id="pen_lapor_id_pangkat" class="form-control"') ?>
            </td>
      <tr><td>NRP </td>
            <td><input type="text" class="form-control" name="pen_lapor_nrp" id="pen_lapor_nrp" placeholder="NRP" />        </td>
      <tr><td>Kesatuan </td>
            <td><input type="text" class="form-control" name="pen_lapor_kesatuan" id="pen_lapor_kesatuan" placeholder="Kesatuan" />        </td>
      <tr><td>Jabatan </td>
            <td><input type="text" class="form-control" name="pen_lapor_jabatan" id="pen_lapor_jabatan" placeholder="Jabatan" />        </td>
      <tr><td>Telpon </td>
            <td><input type="text" class="form-control" name="pen_lapor_telpon" id="pen_lapor_telpon" placeholder="Telpon" />        </td>
            </tr>

      <tr class="separator"> <td colspan="2"> <b> MENGETAHUI </b>  </td> </tr>
      <tr><td>Nama </td>
            <td><input type="text" class="form-control" name="mengetahui_nama" id="mengetahui_nama" placeholder="Nama" />        </td>
      <tr><td>Pangkat </td>
            <td> 

                   <?php echo form_dropdown("mengetahui_id_pangkat",$arr_pangkat,'','id="mengetahui_id_pangkat" class="form-control"') ?>
            </td>

              </td>
      <tr><td>NRP </td>
            <td><input type="text" class="form-control" name="mengetahui_nrp" id="mengetahui_nrp" placeholder="NRP" />        </td>
      <tr><td>Jabatan </td>
            <td><input type="text" class="form-control" name="mengetahui_jabatan" id="mengetahui_jabatan" placeholder="Jabatan" />        </td>
     
      <tr><td colspan='2'><button type="submit" class="btn btn-primary">SIMPAN </button> 
      <a href="<?php echo site_url('lap_a') ?>" class="btn btn-default">Cancel</a>
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="lap_a_id" id="lap_a_id" value="<?php echo $lap_a_id; ?>" /> 
      </td></tr>
  
    </table></form>


<div id="row_tersangka" style="display:none">
<table><tbody id="someid"><tr><td><input type="text" name="tersangka_nama[]" class="form-control" /></td><td><?php echo form_dropdown("tersangka_jk[]",array("L"=>"L","P"=>"P"),'','class="form-control"') ?></td><td><?php 

            $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
                  "id_suku","suku",'suku');
            echo form_dropdown("tersangka_id_suku[]",$arr_suku,'','class="form-control"') ?></td> 
        <td><input type="text" name="tersangka_umur[]" class="form-control umur" /></td><td><?php 

            $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
                  "id_pekerjaan","pekerjaan",'pekerjaan');
            echo form_dropdown("tersangka_id_pekerjaan[]",$arr_pekerjaan,'','class="form-control"') ?></td><td><input type="text" name="tersangka_alamat[]" class="form-control" /> </TD><td><a href="javascript:hapus_row_tersangka('someid')">Hapus </a></td></tr></tbody></table> 


</div>



<div class="modal fade" id="pasalmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Tambah Pasal Baru</h4>
      </div>
      <div class="modal-body">
        <form id="frmModalPasal" method="post" action="<?php echo site_url("$controller/pasal_simpan") ?>">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Fungsi Terkait:</label>
            <?php echo form_dropdown("txt_id_fungsi",$arr_fungsi,'','id="txt_id_fungsi" class="form-control"'); ?>
          </div>
          <div class="form-group">
            <label for="txt_pasal" class="control-label">Pasal:</label>
            <textarea class="form-control" id="txt_pasal" name="txt_pasal"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return pasal_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="tersangka_modal" tabindex="-1" role="dialog" aria-labelledby="tersangkaModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="tersangkaModal">Tambah Tersangka Baru</h4>
      </div>
      <div class="modal-body">
        

<form action="" id="form_tersangka" method="post">
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

              <tr><td>Email </td>
              <TD><input type="text" class="form-control" name="tersangka_email" id="tersangka_email" placeholder="Email" /></TD></tr>
               <tr><td>Telpon </td>
              <TD><input type="text" class="form-control" name="tersangka_telpon" id="tersangka_telpon" placeholder="No. Telpon" /></TD></tr>


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
            </form>   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return tersangka_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="korban_modal" tabindex="-1" role="dialog" aria-labelledby="korbanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="korbanModal">Tambah Korban Baru</h4>
      </div>
      <div class="modal-body">
        
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
                <tr><td>Email </td>
              <TD><input type="text" class="form-control" name="korban_email" id="korban_email" placeholder="Email" /></TD></tr>
               <tr><td>Telpon </td>
              <TD><input type="text" class="form-control" name="korban_telpon" id="korban_telpon" placeholder="No. Telpon" /></TD></tr>

               <tr><td>Alamat </td>
              <TD><input type="text" class="form-control" name="korban_alamat" id="korban_alamat" placeholder="Alamat" /></TD></tr>


                <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="korban_id_provinsi" class="form-control" onchange="get_kota(this,\'#korban_id_kota\',1)"'); 
                  ?><tr><td>Kabupaten / Kota </td>
              <TD>
          <?php
          echo form_dropdown("",array(),'','id="korban_id_kota" class="form-control" onchange="get_kecamatan(this,\'#korban_id_kecamatan\',1)"'); 
                ?></TD></tr>

               <tr><td>Kecamatan </td>
              <TD><?php echo form_dropdown("",array(),'','id="korban_id_kecamatan" class="form-control" onchange="get_desa(this,\'#korban_id_desa\',1)"'); 
                ?></TD></tr>
              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("korban_id_desa",array(),'','id="korban_id_desa" class="form-control" '); 
                ?>

                <input type="hidden" name="korban_id" value=""  id="korban_id"  />
              </TD></tr>
            </table>
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return korban_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="saksi_modal" tabindex="-1" role="dialog" aria-labelledby="saksiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="saksiModal">Tambah Saksi Baru</h4>
      </div>
      <div class="modal-body">
        
<form action="" id="form_saksi" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Nama saksi </td>
              <TD><input type="text" class="form-control" name="saksi_nama" id="saksi_nama" placeholder="Nama saksi" /> </TD></tr>


              <tr><td >Jenis Kelamin</td>
              <TD>
              <?php 
                $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                echo form_dropdown("saksi_jk",$arr_jk,'','id="tersangja_jk" class="form-control"');
              ?>
              </TD></tr>


              <tr><td>Suku </td>
              <TD>
                <?php 
                  $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
      "id_suku","suku",'suku');

                  echo form_dropdown("saksi_id_suku",$arr_suku,'','id="saksi_id_suku" class="form-control"'); 



                ?>

              </TD></tr>


                <tr><td>Tempat Lahir </td>
              <TD><input type="text" class="form-control" name="saksi_tmp_lahir" id="saksi_tmp_lahir" placeholder="Tempat Lahir" /></TD></tr>

               <tr><td>Tanggal Lahir </td>
              <TD><input type="text" class="tanggal form-control" name="saksi_tgl_lahir" id="saksi_tgl_lahir" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" /></TD></tr>

                <tr><td>Agama </td>
              <TD>
 <?php 
                  $arr_agama = $this->cm->get_arr_dropdown("m_agama", 
      "id_agama","agama",'id_agama');

                  echo form_dropdown("saksi_id_agama",$arr_agama,'','id="saksi_id_agama" class="form-control"'); 



                ?>
              </TD></tr>



                <tr><td>Pekerjaan</td>
              <TD>
<?php 
                  $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
      "id_pekerjaan","pekerjaan",'pekerjaan');

                  echo form_dropdown("saksi_id_pekerjaan",$arr_pekerjaan,'','id="saksi_id_pekerjaan" class="form-control"'); 



                ?>

               </TD></tr>

                <tr><td>Email </td>
              <TD><input type="text" class="form-control" name="saksi_email" id="saksi_email" placeholder="Email" /></TD></tr>
               <tr><td>Telpon </td>
              <TD><input type="text" class="form-control" name="saksi_telpon" id="saksi_telpon" placeholder="No. Telpon" /></TD></tr>



                <tr><td>Alamat </td>
              <TD><input type="text" class="form-control" name="saksi_alamat" id="saksi_alamat" placeholder="Alamat" /></TD></tr>


                <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="saksi_id_provinsi" class="form-control" onchange="get_kota(this,\'#saksi_id_kota\',1)"'); 



                ?>


                <tr><td>Kabupaten / Kota </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="saksi_id_kota" class="form-control" onchange="get_kecamatan(this,\'#saksi_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="saksi_id_kecamatan" class="form-control" onchange="get_desa(this,\'#saksi_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("saksi_id_desa",array(),'','id="saksi_id_desa" class="form-control" '); 
                ?>

                <input type="hidden" name="saksi_id" value=""  id="saksi_id"  />
              </TD></tr>
            </table>
            
       
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return saksi_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="barbuk_modal" tabindex="-1" role="dialog" aria-labelledby="barbukModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="barbukModal">Tambah Barang Bukti Baru</h4>
      </div>
      <div class="modal-body">
        


<form action="<?php echo site_url("$controller/$action/$lap_a_id") ?>" id="form_barbuk" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Barang bukti </td>
              <TD><input type="text" class="form-control" name="barbuk_nama" id="barbuk_nama" placeholder="Barang bukti" /> 
              <input type="hidden" name="barbuk_id" value=""  id="barbuk_id"  />
              </TD></tr></table>
       
             </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return barbuk_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>



<?php $this->load->view($controller."_view_form_js");?>
<?php $this->load->view("js/general_js") ?>