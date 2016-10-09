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
<table class='table table-bordered' width="100%">
      <tr class="separator"> <td colspan="2"> <b> LAP B</b>  </td> </tr>

     <tr><td width="161">Tanggal LP </td>
            <td width="516"><input type="text" class="tanggal form-control" name="tanggal" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" 
            

              />        </td>
      <tr><td>Nomor </td>
            <td><input readonly="readonly" type="text" class="form-control" name="nomor" id="nomor" placeholder="(auto generated)" />        </td>
     

     <tr><td>Golongan Kejahatan </td>
            <td>  

            <?php 

            $arr_kelompok_kejahan = $this->cm->get_arr_dropdown("m_kelompok_kejahatan","id_kelompok","kelompok","kelompok");

            $arr_kelompok_kejahan = add_arr_head($arr_kelompok_kejahan,"x","== PILIH ==");
           
            echo form_dropdown("",$arr_kelompok_kejahan,'',
              'id="id_kelompok" class="form-control" 
               onchange="get_data_kejahatan(this,\'#id_gol_kejahatan\',1)"

              '); 


           
            ?>
      </td>



      <tr><td> </td>
            <td>  

            <?php echo form_dropdown("id_gol_kejahatan",array(),'','id="id_gol_kejahatan" class="form-control"') ?>

      </td>


      <tr><td>Tempat Kejadian Perkara</td>
            <td>

            <?php 

            $arr_jenis_lokasi = add_arr_head($arr_jenis_lokasi,"x","= PILIH =");
            echo form_dropdown("id_jenis_lokasi",$arr_jenis_lokasi,'','id="id_jenis_lokasi" class="form-control"') ?>

               </td>


      
     
      <tr><td>Fungsi Terkait </td>
            <td>
                  <?php 

                  $arr_fungsi = add_arr_head($arr_fungsi,"x","= PILIH =");
                  echo form_dropdown("id_fungsi",$arr_fungsi,'','id="id_fungsi" class="form-control"') ?>

               </td>
 

              
            </tr>

            <tr><td>Tindak Pidana </td>
            <td><textarea name="tindak_pidana" id="tindak_pidana" placeholder="Tindak Pidana" class="form-control"></textarea>

            </td></tr>


<tr> <td colspan="2"> <b> PASAL</b>  </td> </tr>


      <tr> 
            <td colspan="2">
               
<a href="javascript:pasal_add();" id="xadd_pasal" class="btn btn-primary">Tambah Data Pasal</a>
<br><br>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="pasallap" role="grid">
<thead>
   <tr >

         
        <th width="90%">PASAL</th>
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>



            </td> </tr>    

               
   <tr> <td colspan="2"> <b> PELAPOR</b>  </td> </tr>
   <tr>
      <td> Nama </td>
            <td><input type="text" class="form-control" name="pelapor_nama" id="pelapor_nama" placeholder=" Nama" />
        </td>
      <tr><td> Tmp Lahir </td>
            <td><input type="text" class="form-control" name="pelapor_tmp_lahir" id="pelapor_tmp_lahir" placeholder=" Tmp Lahir" />
        </td>
      <tr><td> Tgl Lahir </td>
            <td><input type="text" class="tanggal form-control" name="pelapor_tgl_lahir" id="pelapor_tgl_lahir" placeholder=" Tgl Lahir" data-date-format="dd-mm-yyyy" />
        </td>
      <tr><td> Jk </td>
            <td>
            <?php 
            $arr = array("L"=>"Laki-laki","P"=>"Perempuan");
            echo form_dropdown("pelapor_jk",$arr,'','id="pelapor_jk" class="form-control"');

            ?>
        </td>
      <tr><td>Pekerjaan </td>
            <td> 
            <?php 
            
            echo form_dropdown("pelapor_id_pekerjaan",$arr_pekerjaan,'','id="pelapor_id_pekerjaan" class="form-control"');

            ?>
        </td>
      <tr><td> Alamat </td>
            <td><input type="text" class="form-control" name="pelapor_alamat" id="pelapor_alamat" placeholder=" Alamat" />
        </td>
      <tr>
       <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="pelapor_id_provinsi" class="form-control" onchange="get_kota(this,\'#pelapor_id_kota\',1)"'); 



                ?>


                <tr><td>Kabupaten / Kota </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="pelapor_id_kota" class="form-control" onchange="get_kecamatan(this,\'#pelapor_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="pelapor_id_kecamatan" class="form-control" onchange="get_desa(this,\'#pelapor_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("pelapor_id_desa",array(),'','id="pelapor_id_desa" class="form-control" '); 
                ?>
                </TD></tr>

            <td>Telpon </td>
            <td><input type="text" class="form-control" name="pelapor_telpon" id="pelapor_telpon" placeholder="Telpon" />
        </td>
      <tr><td>Agama </td>
            <td> 
            <?php 
            
            echo form_dropdown("pelapor_id_agama",$arr_agama,'','id="pelapor_id_agama" class="form-control"');

            ?>
        </td>
      <tr><td>Pendidikan </td>
            <td> 
              <?php 
            
            echo form_dropdown("pelapor_id_pendidikan",$arr_pendidikan,'','id="pelapor_id_pendidikan" class="form-control"');

            ?>
        </td>
      <tr><td>Warga Negara </td>
            <td> 
               <?php 
            
            echo form_dropdown("pelapor_id_warga_negara",$arr_warga_negara,'','id="pelapor_id_warga_negara" class="form-control"');

            ?>

        </td>
        </tr>





   <tr class="separator"> <td colspan="2"> <b> PERISTIWA YANG DILAPORKAN </b>  </td> </tr>
   <tr>
     <td>Tanggal </td>
            <td><input type="text" class="tanggal form-control" name="kejadian_tanggal" id="kejadian_tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" />
        </td>
      <tr><td>Jam </td>
            <td><input type="text" class="form-control" name="kejadian_jam" id="kejadian_jam" placeholder="Jam" />
        </td>
      <tr><td>Tempat </td>
            <td><input type="text" class="form-control" name="kejadian_tempat" id="kejadian_tempat" placeholder="Tempat" />
        </td>

      <tr><td>Provinsi  </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');
      
                $arr_provinsi = add_arr_head($arr_provinsi,"x","= PILIH PROPINSI =");

                  echo form_dropdown("",$arr_provinsi,'','id="kejadian_id_provinsi" class="form-control" onchange="get_kota(this,\'#kejadian_id_kota\',1)"'); 



                ?>


                <tr><td> Kabupaten / Kota  </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="kejadian_id_kota" class="form-control" onchange="get_kecamatan(this,\'#kejadian_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>  Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="kejadian_id_kecamatan" class="form-control" onchange="get_desa(this,\'#kejadian_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("kejadian_id_desa",array(),'','id="kejadian_id_desa" class="form-control" '); 
                ?>  





      <tr><td>Apa Yang Terjadi </td>
            <td><textarea name="kejadian_apa" id="kejadian_apa" placeholder="Apa yang terjadi" class="form-control"></textarea>
        </td>
      <tr><td>Uraian Kejadian </td>
            <td><textarea name="kejadian_uraian" id="kejadian_uraian" placeholder="Uraian Kejadian" class="form-control"></textarea>
        </td>
      <tr><td>Bagaimana Terjadi </td>
            <td><textarea name="kejadian_bagaimaan" id="kejadian_bagaimaan" placeholder="Bagaimana Terjadi" class="form-control"></textarea>
        </td>
      <tr><td>Motif Kejahatan </td>
            <td>
            <?php echo form_dropdown("kejadian_id_motif_kejahatan",$arr_motif,'','id="kejadian_id_motif_kejahatan" class="form-control"') ?>
        </td>

<tr><td>Modus Operandi </td>
            <td><textarea name="modus_operandi" id="modus_operandi" placeholder="Modus Operandi" class="form-control"></textarea>
        </td>



      <tr><td>Tanggal Dilaporkan</td>
            <td><input type="text" class="tanggal form-control" name="kejadian_tanggal_lapor" id="kejadian_tanggal_lapor" placeholder="Tanggal Dilaporkan" data-date-format="dd-mm-yyyy" />
        </td>
      <tr><td>Jam Dilaporkan</td>
            <td><input type="text" class="form-control" name="kejadian_jam_lapor" id="kejadian_jam_lapor" placeholder="Jam Dilaporkan" />
        </td> </tr>
     

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

        <th width="70%">BARANG BUKTI</th>     
        <th width="10%">JUMLAH</th>    
        <th width="10%">SATUAN</th>        
        <th width="10%">PROS</th>
      
    </tr>
   
</thead>
</table>

 </td> </tr> 





 
 <tr class="separator"> <td colspan="2"> <b> PENERIMA LAPORAN </b>  </td> </tr>
<tr>
<td>Nama </td>
            <td><input type="text" class="form-control" name="pen_lapor_nama" id="pen_lapor_nama" placeholder="Nama"  />
        </td>
      <tr><td>Pangkat </td>
            <td>
            <?php echo form_dropdown("pen_lapor_id_pangkat",$arr_pangkat,'','id="pen_lapor_id_pangkat" class="form-control"') ?>
        </td>
      <tr>
            <td>NRP </td>
            <td><input type="text" class="form-control" name="pen_lapor_nrp" id="pen_lapor_nrp" placeholder="NRP"   />
        </td>
     
      <tr><td>Jabatan </td>
            <td><input type="text" class="form-control" name="pen_lapor_jabatan" id="pen_lapor_jabatan" placeholder="Jabatan"   />
        </td>
      



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
      <a href="<?php echo site_url('lap_b') ?>" class="btn btn-default">Cancel</a>
      <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
      <input type="hidden" name="lap_b_id" id="lap_b_id" value="<?php echo $lap_b_id; ?>" /> 
      </td></tr>
  
    </table></form>





<div class="modal fade" id="pasalmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Tambah Pasal Baru</h4>
      </div>
      <div class="modal-body">
        <form id="form_pasal" method="post" action="">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Fungsi Terkait:</label>
            <?php 
            echo form_dropdown("",$arr_fungsi,'','id="txt_id_fungsi" class="form-control"'); ?>
          </div>
          <div class="form-group">
            <label for="txt_pasal" class="control-label">Pasal:</label>
             <?php 
            echo form_dropdown("id_pasal",array(),'','id="id_pasal" class="form-control"'); ?>
          </div>
          <input type="hidden" name="id" value="" id="id" />
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


               <tr><td>Pendidikan </td>
              <TD>
              <?php 
                  $arr_pendidikan = $this->cm->get_arr_dropdown("m_pendidikan", 
                "id_pendidikan","pendidikan",'pendidikan');

                  echo form_dropdown("tersangka_id_pendidikan",$arr_pendidikan,'','id="tersangka_id_pendidikan" class="form-control"'); 



                ?>
                  
                </TD></tr>

                <tr><td>Warga Negara </td>
              <TD><input type="text" class="form-control" name="tersangka_wn" id="tersangka_wn" placeholder="Warga negara" /></TD></tr>

              <tr><td>No. KTP</td>
              <TD><input type="text" class="form-control" name="tersangka_nik" id="tersangka_nik" placeholder="Nomor KTP" /></TD></tr>

              <tr><td>No. Passport</td>
              <TD><input type="text" class="form-control" name="tersangka_no_passport" id="tersangka_no_passport" placeholder="Nomor Passport" /></TD></tr>


              <tr><td>No. Kitas</td>
              <TD><input type="text" class="form-control" name="tersangka_no_kitas" id="tersangka_no_kitas" placeholder="Nomor KItas" /></TD></tr>

              <tr><td>Residivis ? </td>
              <TD>
              <?php 
                  $arr_rsdv = array("ya"=>"Ya","tidak"=>"Tidak");

                  echo form_dropdown("tersangka_residivis",$arr_rsdv,'','id="tesangka_residivis" class="form-control"');                ?>
                
              </TD></tr>


              <tr><td>Jika Ya, Apa </td>
              <TD>
              <?php 
                  $arr_rsdv = array(
                      ""=>"TIDAK ADA ",
                      "PRODUSEN" => "PRODUSEN",
                      "BANDAR" => "BANDAR",
                      "PENGEDAR" => "PENGEDAR",
                      "PENGGUNA" => "PENGGUNA"

                    );

                  echo form_dropdown("tersangka_klasifikasi",$arr_rsdv,'','id="  tersangka_klasifikasi" class="form-control"');                ?>
                
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
        
<form action="" id="form_korban" method="post">
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
                  
                <tr><td>Email </td>
              <TD><input type="text" class="form-control" name="korban_email" id="korban_email" placeholder="Email" /></TD></tr>
               <tr><td>Telpon </td>
              <TD><input type="text" class="form-control" name="korban_telpon" id="korban_telpon" placeholder="No. Telpon" /></TD></tr>

                </TD></tr>


                 <tr><td>Pendidikan </td>
              <TD>
              <?php 
                  $arr_pendidikan = $this->cm->get_arr_dropdown("m_pendidikan", 
                "id_pendidikan","pendidikan",'pendidikan');

                  echo form_dropdown("korban_id_pendidikan",$arr_pendidikan,'','id="korban_id_pendidikan" class="form-control"'); 



                ?>
                  
                </TD></tr>

                <tr><td>Warga Negara </td>
              <TD><input type="text" class="form-control" name="korban_wn" id="korban_wn" placeholder="Warga negara" /></TD></tr>

              <tr><td>No. KTP</td>
              <TD><input type="text" class="form-control" name="korban_nik" id="korban_nik" placeholder="Nomor KTP" /></TD></tr>

              <tr><td>No. Passport</td>
              <TD><input type="text" class="form-control" name="korban_no_passport" id="korban_no_passport" placeholder="Nomor Passport" /></TD></tr>


              <tr><td>No. Kitas</td>
              <TD><input type="text" class="form-control" name="korban_no_kitas" id="korban_no_kitas" placeholder="Nomor KItas" /></TD></tr>

              <tr><td>Residivis ? </td>
              <TD>
              <?php 
                  $arr_rsdv = array("ya"=>"Ya","tidak"=>"Tidak");

                  echo form_dropdown("korban_residivis",$arr_rsdv,'','id="tesangka_residivis" class="form-control"');                ?>
                
              </TD></tr>


              <tr><td>Jika Ya, Apa </td>
              <TD>
              <?php 
                  $arr_rsdv = array(
                      ""=>"TIDAK ADA ",
                      "PRODUSEN" => "PRODUSEN",
                      "BANDAR" => "BANDAR",
                      "PENGEDAR" => "PENGEDAR",
                      "PENGGUNA" => "PENGGUNA"

                    );

                  echo form_dropdown("korban_klasifikasi",$arr_rsdv,'','id="  korban_klasifikasi" class="form-control"');                ?>
                
              </TD></tr>



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


               <tr><td>Pendidikan </td>
              <TD>
              <?php 
                  $arr_pendidikan = $this->cm->get_arr_dropdown("m_pendidikan", 
                "id_pendidikan","pendidikan",'pendidikan');

                  echo form_dropdown("saksi_id_pendidikan",$arr_pendidikan,'','id="saksi_id_pendidikan" class="form-control"'); 



                ?>
                  
                </TD></tr>

                <tr><td>Warga Negara </td>
              <TD><input type="text" class="form-control" name="saksi_wn" id="saksi_wn" placeholder="Warga negara" /></TD></tr>

              <tr><td>No. KTP</td>
              <TD><input type="text" class="form-control" name="saksi_nik" id="saksi_nik" placeholder="Nomor KTP" /></TD></tr>

              <tr><td>No. Passport</td>
              <TD><input type="text" class="form-control" name="saksi_no_passport" id="saksi_no_passport" placeholder="Nomor Passport" /></TD></tr>


              <tr><td>No. Kitas</td>
              <TD><input type="text" class="form-control" name="saksi_no_kitas" id="saksi_no_kitas" placeholder="Nomor KItas" /></TD></tr>

              <tr><td>Residivis ? </td>
              <TD>
              <?php 
                  $arr_rsdv = array("ya"=>"Ya","tidak"=>"Tidak");

                  echo form_dropdown("saksi_residivis",$arr_rsdv,'','id="tesangka_residivis" class="form-control"');                ?>
                
              </TD></tr>


              <tr><td>Jika Ya, Apa </td>
              <TD>
              <?php 
                  $arr_rsdv = array(
                      ""=>"TIDAK ADA ",
                      "PRODUSEN" => "PRODUSEN",
                      "BANDAR" => "BANDAR",
                      "PENGEDAR" => "PENGEDAR",
                      "PENGGUNA" => "PENGGUNA"

                    );

                  echo form_dropdown("saksi_klasifikasi",$arr_rsdv,'','id="  saksi_klasifikasi" class="form-control"');                ?>
                
              </TD></tr>


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
        


<form action="<?php echo site_url("$controller/$action/$lap_b_id") ?>" id="form_barbuk" method="post">
            <table width="100%"  class='table table-bordered'>
              <tr>
               
              <tr><td width="30%" >Barang bukti </td>
              <TD>
               <input type="text" class="form-control" name="barbuk_nama" id="barbuk_nama" placeholder="Barang bukti" /> </TD>
              </TD></tr>

           


             


              <tr><td>Jumlah </td>
              <TD>
              <input type="text" class="form-control" name="barbuk_jumlah" id="barbuk_jumlah" placeholder="Jumlah" /> </TD>
              </tr>

              <tr><td>Satuan </td>
              <TD>
              <input type="text" class="form-control" name="barbuk_satuan" id="barbuk_satuan" placeholder="Satuan" /> </TD>
              </tr>



              </table>
        <input type="hidden" name="barbuk_id" value=""  id="barbuk_id"  />
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