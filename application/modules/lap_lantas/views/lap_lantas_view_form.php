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
  <table class="table table-bordered">
    <tr class="separator">
      <td colspan="2"><b> LP - Laka Lantas <b></td>
    </tr>
    <tr>
      <td width="161">Tanggal LP</td>
      <td width="516"><input type="text" class="tanggal form-control" name="tanggal" id="tanggal" placeholder="Tanggal (HH-BB-TTTT)" data-date-format="dd-mm-yyyy"/></td>
    </tr>
    <tr>
      <td width="161">Nomor</td>
      <td width="516"><input readonly="readonly" type="text" class="form-control" name="nomor" id="nomor" placeholder="(auto generated)" /></td>
    </tr>
    <tr>
      <td width="161">Jam Dilaporkan</td>
      <td width="516"><input type="text" class="form-control" name="jam_dilaporkan" id="jam_dilaporkan" placeholder="Jam Dilaporkan (JJ:MM:DD)" /></td>
    </tr>
    <tr class="separator">
      <td colspan="2"><b> Pelapor <b></td>
    </tr>
    <tr>
      <td width="161">Nama Pelapor</td>
      <td width="516"><input type="text" class="form-control" name="pelapor_nama" id="pelapor_nama" placeholder="Nama Pelapor" /></td>
    </tr>
    <tr>
      <td width="161">Pangkat Pelapor</td>
      <td width="516"><?php echo form_dropdown("pelapor_id_pangkat",$arr_pangkat,'','id="pelapor_id_pangkat" class="form-control"') ?></td>
    </tr>
    <tr>
      <td width="161">NRP</td>
      <td width="516"><input type="text" class="form-control" name="pelapor_nrp" id="pelapor_nrp" placeholder="NRP (Hanya Angka)" /></td>
    </tr>
    <tr>
      <td width="161">Pelapor Jabatan</td>
      <td width="516"><input type="text" class="form-control" name="pelapor_jabatan" id="pelapor_jabatan" placeholder="Pelapor Jabatan" /></td>
    </tr>
    <tr>
      <td width="161">Pelapor Kesatuan</td>
      <td width="516"><?php 

            $arr_kesatuan = $this->cm->get_arr_dropdown("m_kesatuan","id_kesatuan","kesatuan","kesatuan");
           
            echo form_dropdown("pelapor_id_kesatuan",$arr_kesatuan,'',
              'id="pelapor_id_kesatuan" class="form-control" '); 


           
            ?></td>
    </tr>
    <tr class="separator">
      <td colspan="2"><b> Peristiwa Yang Terjadi <b></td>
    </tr>
    <tr>
      <td width="161">Tanggal Kejadian</td>
      <td width="516"><input type="text" class="tanggal form-control" name="kp_tanggal" id="kp_tanggal" placeholder="Tanggal Kejadian (HH-BB-TTTT)" data-date-format="dd-mm-yyyy"/></td>
    </tr>
    <tr>
      <td width="161">Waktu Kejadian</td>
      <td width="516"><input type="text" class="form-control" name="kp_waktu" id="kp_waktu" placeholder="Waktu Kejadian (JJ:MM:DD)" /></td>
    </tr>
    <tr>
      <td width="161">Tempat Kejadian</td>
      <td width="516"><textarea class="form-control" name="kp_tempat_kejadian" id="kp_tempat_kejadian" placeholder="Tempat Kejadian . . ." ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Apa Yang Terjadi</td>
      <td width="516"><textarea class="form-control" name="kp_apa_yang_terjadi" id="kp_apa_yang_terjadi" placeholder="Apa Yang Terjadi . . . " ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Keadaan Jalan/Cuaca</td>
      <td width="516"><textarea class="form-control" name="kp_keadaan_jalan_cuaca" id="kp_keadaan_jalan_cuaca" placeholder="Keadaan Jalan/Cuaca . . ." ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Pengendara Motor / Pengemudi Mobil serta penumpang</td>
      <td width="516"><textarea class="form-control" name="kp_pengendara_mobil_motor" id="kp_pengendara_mobil_motor" placeholder="Pengendara Motor / Pengemudi Mobil serta penumpang . . . " ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Kerusakan Benda/Kendaraan</td>
      <td width="516"><textarea class="form-control" name="kp_kerusakan" id="kp_kerusakan" placeholder="Kerusakan Benda/Kendaraan . . ." ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Perkiraan Kerugian (Rp).</td>
      <td width="516"><input type="text" class="form-control" name="kp_perkiraan_rugi" id="kp_perkiraan_rugi" placeholder="Perkiraan Kerugian (Rp)"/></td>
    </tr>
    <tr>
      <td width="161">Uraian Singkat yang dilaporkan:</td>
      <td width="516"><textarea class="form-control" name="kp_uraian" id="kp_uraian" placeholder="Uraian Singkat yang dilaporkan: . . ." ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Kesimpulan Sementara</td>
      <td width="516"><textarea class="form-control" name="kp_kesimpulan" id="kp_kesimpulan" placeholder="Kesimpulan Sementara . . ." ></textarea></td></td>
    </tr>
    <tr>
      <td width="161">Tipe Kecelakaan</td>
      <td width="516"><input type="text" class="form-control" name="kp_tipe_kecelakaan" id="kp_tipe_kecelakaan" placeholder="Tipe Kecelakaan" /></td>
    </tr>
    <tr>
      <td width="161">Pengendara/Pembonceng Pakai Helm?</td>
      <td width="516"><input type="text" class="form-control" name="kp_pengedara_helm" id="kp_pengedara_helm" placeholder="Apakah Pengendara/Pembonceng Menggunakan Helm?" /></td>
    </tr>
    <tr>
      <td width="161">Pasal </td>
      <td width="516"><input type="text" class="form-control" name="  kp_pasal" id="  kp_pasal" placeholder="Pasal"  /></td>
    </tr>
    <tr>
      <td width="161">Orang Yang ditahan:</td>
      <td width="516"><textarea class="form-control" name="kp_orang_ditahan" id="kp_orang_ditahan" placeholder="Orang Yang ditahan: . . ." ></textarea></td></td>
    </tr>
    <tr class="separator">
      <td colspan="2"><b> Identitas Pengemudi <b></td>
    </tr>
    <tr> 
      <td colspan="2">
        <a href="javascript:pengemudi_add();" id="add_pengemudi" class="btn btn-primary">Tambah Data Pengemudi </a><br><br>
        <table width="100%"  border="0" class="table table-striped table-bordered table-hover dataTable no-footer" id="pengemudi" role="grid">
          <thead>
            <tr >
              <th width="15%">NAMA</th>
              <th width="15%">JENIS KELAMIN</th>
              <th width="10%">TGL. LAHIR</th>
              <th width="15%">PEKERJAAN</th>
              <th width="10%">AGAMA</th>
              <th width="25%">ALAMAT</th>
              <th width="10%">#</th>
              </tr>   
          </thead>
        </table>
      </td>
    </tr>
    <tr class="separator">
      <td colspan="2"><b> Saksi <b></td>
    </tr>
    <tr> 
      <td colspan="2">
        <a href="javascript:saksi_add();" id="add_saksi" class="btn btn-primary">Tambah Data Saksi </a><br><br>
        <table width="100%"  border="0" class="table table-striped table-bordered table-hover dataTable no-footer" id="saksi" role="grid">
          <thead>
            <tr >
              <th width="15%">NAMA</th>
              <th width="15%">JENIS KELAMIN</th>
              <th width="10%">TGL. LAHIR</th>
              <th width="15%">PEKERJAAN</th>
              <th width="10%">AGAMA</th>
              <th width="25%">ALAMAT</th>
              <th width="10%">#</th>
              </tr>   
          </thead>
        </table>
      </td>
    </tr>
    <tr class="separator">
      <td colspan="2"><b> Korban <b></td>
    </tr>
    <tr> 
      <td colspan="2">
        <a href="javascript:korban_add();" id="add_korban" class="btn btn-primary">Tambah Data Korban </a><br><br>
        <table width="100%"  border="0" class="table table-striped table-bordered table-hover dataTable no-footer" id="korban" role="grid">
          <thead>
            <tr >
              <th width="15%">NAMA</th>
              <th width="10%">JENIS KELAMIN</th>
              <th width="10%">TGL. LAHIR</th>
              <th width="15%">PEKERJAAN</th>
              <th width="10%">AGAMA</th>
              <th width="25%">ALAMAT</th>
              <th width="25%">Cedera</th>
              <th width="25%">Tempat Dirawat</th>
              <th width="10%">#</th>
              </tr>   
          </thead>
        </table>
      </td>
    </tr>
    
    
   <tr class="separator">
      <td colspan="2"><b> Identitas Kendaraan yang terlibat Laka <b></td>
    </tr>
    <tr> 
      <td colspan="2">
        <a href="javascript:kendaraan_add();" id="add_korban" class="btn btn-primary">Tambah Data Kendaraan </a><br>
        <br>
        <table width="100%"  border="0" class="table table-striped table-bordered table-hover dataTable no-footer" id="kendaraan" role="grid">
          <thead>
            <tr >
              <th width="14%">NOPOL</th>
              <th width="11%">JENIS</th>
              <th width="10%">TIPE </th>
              <th width="13%">MODEL</th>
              <th width="20%">TAHUN BUAT</th>
              <th width="18%">KONDISI BAN</th>
              <th width="14%">#</th>
            </tr>   
          </thead>
        </table>
      </td>
    </tr>  
    
    
    
    <tr class="separator">
      <td colspan="2"><b> Mengetahui <b></td>
    </tr>
    <tr>
      <td width="161">Nama </td>
      <td width="516"><input type="text" class="form-control" name="mengetahui_nama" id="mengetahui_nama" placeholder="Nama"  /></td>
    </tr>
    <tr>
      <td width="161">Pangkat </td>
      <td width="516"><?php echo form_dropdown("pengetahui_id_pangkat",$arr_pangkat,'','id="pengetahui_id_pangkat" class="form-control"') ?></td>
    </tr>
    <tr>
      <td width="161">NRP </td>
      <td width="516"><input type="text" class="form-control" name="mengetahui_nrp" id="mengetahui_nrp" placeholder="NRP"  /></td>
    </tr>
    <tr>
      <td width="161">Jabatan </td>
      <td width="516"><input type="text" class="form-control" name="mengetahui_jabatan" id="mengetahui_jabatan" placeholder="Jabatan"  /></td>
    </tr>
    <tr>
      <td colspan='2'>
        <button type="submit" class="btn btn-primary">SIMPAN</button>
        <a href="<?php echo site_url('lap_lantas') ?>" class="btn btn-default">Cancel</a>
        <input type="hidden" name="mode" id="mode" value="<?php echo isset($mode)?$mode:""; ?>">
        <input type="hidden" name="lap_laka_lantas_id" id="lap_laka_lantas_id"  /> 
      </td>
    </tr>
  </table>
</form>


<!-- Modal Add Pengemudi -->

<div class="modal fade" id="pengemudi_modal" tabindex="-1" role="dialog" aria-labelledby="pengemudiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pengemudiModal">Tambah Pengemudi</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_pengemudi" method="post">
          <table width="100%"  class='table table-bordered'>
            <tr>  
              <tr>
                <td width="30%" >Nama Pengemudi</td>
                <TD>
                  <input type="text" class="form-control" name="pengemudi_nama" id="pengemudi_nama" placeholder="Nama Pengemudi" />                </TD>
              </tr>
              <tr>
                <td >Jenis Kelamin</td>
                <TD>
                  <?php $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                  echo form_dropdown("pengemudi_jk",$arr_jk,'','id="pengemudi_jk" class="form-control"'); ?>                </TD>
              </tr>
              <tr>
                <td width="30%" >Tanggal Lahir </td>
                <TD>
                  <input type="text" class="tanggal form-control" name="pengemudi_tgl_lahir" id="pengemudi_tgl_lahir" placeholder="Tanggal lahir" data-date-format="dd-mm-yyyy" />                </TD>
              </tr>
              <tr>
                <td>Agama </td>
                <TD>
                  <?php $arr_agama = $this->cm->get_arr_dropdown("m_agama", "id_agama","agama",'id_agama');
                    echo form_dropdown("pengemudi_id_agama",$arr_agama,'','id="pengemudi_id_agama" class="form-control"'); ?>                </TD>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <TD>
                  <?php $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", "id_pekerjaan","pekerjaan",'pekerjaan');
                  echo form_dropdown("pengemudi_id_pekerjaan",$arr_pekerjaan,'','id="pengemudi_id_pekerjaan" class="form-control"');?>                </TD>
              </tr>
              <tr>
                <td>Alamat </td>
                <TD>
                  <input type="text" class="form-control" name="pengemudi_alamat" id="pengemudi_alamat" placeholder="Alamat" />
                  <input type="hidden" name="lap_laka_lantas_pengemudi_id" value=""  id="lap_laka_lantas_pengemudi_id"  />                </TD>
              </tr>
             <tr><td>Provinsi </td>
              <TD>
          <?php 
                  $arr_provinsi = $this->cm->get_arr_dropdown("tiger_provinsi", 
      "id","provinsi",'provinsi');

                  echo form_dropdown("",$arr_provinsi,'','id="pengemudi_id_provinsi" class="form-control" onchange="get_kota(this,\'#pengemudi_id_kota\',1)"'); 



                ?>


                <tr><td>Kabupaten / Kota </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="pengemudi_id_kota" class="form-control" onchange="get_kecamatan(this,\'#pengemudi_id_kecamatan\',1)"'); 
                ?>


              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="pengemudi_id_kecamatan" class="form-control" onchange="get_desa(this,\'#pengemudi_id_desa\',1)"'); 
                ?>


              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("pengemudi_id_desa",array(),'','id="pengemudi_id_desa" class="form-control" '); 
                ?>

                
              </TD></tr>
            </table>   
        </form>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="return pengemudi_simpan();"  >Simpan</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Saksi -->


<div class="modal fade" id="saksi_modal" tabindex="-1" role="dialog" aria-labelledby="saksiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="saksiModal">Tambah Saksi</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_saksi" method="post">
          <table width="100%"  class='table table-bordered'><tr>
              <td width="30%" >Nama Saksi</td>
              <TD>
                <input type="text" class="form-control" name="saksi_nama" id="saksi_nama" placeholder="Nama Saksi" />              </TD>
              </tr>
              <tr>
                <td >Jenis Kelamin</td>
                <TD>
                  <?php $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                  echo form_dropdown("saksi_jk",$arr_jk,'','id="saksi_jk" class="form-control"'); ?>                </TD>
              </tr>
              <tr>
                <td width="30%" >Tanggal Lahir </td>
                <TD>
                  <input type="text" class="tanggal form-control" name="saksi_tgl_lahir" id="saksi_tgl_lahir" placeholder="Tanggal lahir"  data-date-format="dd-mm-yyyy" />                </TD>
              </tr>
              <tr>
                <td>Agama </td>
                <TD>
                  <?php $arr_agama = $this->cm->get_arr_dropdown("m_agama", "id_agama","agama",'id_agama');
                    echo form_dropdown("saksi_id_agama",$arr_agama,'','id="saksi_id_agama" class="form-control"'); ?>                </TD>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <TD>
                  <?php $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", "id_pekerjaan","pekerjaan",'pekerjaan');
                  echo form_dropdown("saksi_id_pekerjaan",$arr_pekerjaan,'','id="saksi_id_pekerjaan" class="form-control"');?>                </TD>
              </tr>
              <tr>
                <td>Alamat </td>
                <TD>
                  <input type="text" class="form-control" name="saksi_alamat" id="saksi_alamat" placeholder="Alamat" />
                  <input type="hidden" name="saksi_id" value=""  id="saksi_id"  />                </TD>
              </tr>
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
                ?>              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="saksi_id_kecamatan" class="form-control" onchange="get_desa(this,\'#saksi_id_desa\',1)"'); 
                ?>              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("saksi_id_desa",array(),'','id="saksi_id_desa" class="form-control" '); 
                ?>              </TD></tr> 
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


  <div class="modal fade" id="korban_modal" tabindex="-1" role="dialog" aria-labelledby="korbanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="korbanModal">Tambah Korban</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_korban" method="post">
          <table width="100%"  class='table table-bordered'>
            <tr>  
              <tr>
                <td width="30%" >Nama Korban</td>
                <TD>
                  <input type="text" class="form-control" name="korban_nama" id="korban_nama" placeholder="Nama Korban" />
                </TD>
              </tr>
              <tr>
                <td >Jenis Kelamin</td>
                <TD>
                  <?php $arr_jk = array("L"=>"Laki-laki","P"=>"Perempuan");
                  echo form_dropdown("korban_jk",$arr_jk,'','id="korban_jk" class="form-control"'); ?>
                </TD>
              </tr>
              <tr>
                <td width="30%" >Tanggal Lahir </td>
                <TD>
                  <input type="text" class="tanggal form-control" name="korban_tgl_lahir" id="korban_tgl_lahir" placeholder="Tanggal lahir "  data-date-format="dd-mm-yyyy" /> 
                </TD>
              </tr>
              <tr>
                <td>Agama </td>
                <TD>
                  <?php $arr_agama = $this->cm->get_arr_dropdown("m_agama", "id_agama","agama",'id_agama');
                    echo form_dropdown("korban_id_agama",$arr_agama,'','id="korban_id_agama" class="form-control"'); ?>
                </TD>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <TD>
                  <?php $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", "id_pekerjaan","pekerjaan",'pekerjaan');
                  echo form_dropdown("korban_id_pekerjaan",$arr_pekerjaan,'','id="korban_id_pekerjaan" class="form-control"');?>
                </TD>
              </tr>
              <tr>
                <td>Alamat </td>
                <TD>
                  <input type="text" class="form-control" name="korban_alamat" id="korban_alamat" placeholder="Alamat" />
                  <input type="hidden" name="korban_id" value=""  id="korban_id"  />
                </TD>
              </tr>
              

 </tr>
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
                ?>              </TD></tr>

               <tr><td>Kecamatan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("",array(),'','id="korban_id_kecamatan" class="form-control" onchange="get_desa(this,\'#korban_id_desa\',1)"'); 
                ?>              </TD></tr>


              <tr><td>Desa / Kelurahan </td>
              <TD>
          <?php 
                  

                  echo form_dropdown("korban_id_desa",array(),'','id="korban_id_desa" class="form-control" '); 
                ?>              </TD></tr> 
              
              
              
              
              <tr>
                <td width="30%" >Cedera</td>
                <TD>
                  <input type="text" class="form-control" name="korban_cidera" id="korban_cidera" placeholder="Cedera" />
                </TD>
              </tr>
              <tr>
                <td width="30%" >Tempat Dirawat</td>
                <TD>
                  <input type="text" class="form-control" name="korban_tmp_dirawat" id="korban_tmp_dirawat" placeholder="Tempat Dirawat" />
                </TD>
              </tr>
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
<!-- End Modal -->



  <div class="modal fade" id="kendaraan_modal" tabindex="-1" role="dialog" aria-labelledby="kendaraanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="kendaraanModal">Tambah Data Kendaraan</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_kendaraan" method="post">
          <table width="100%"  class='table table-bordered'>
            <tr><td>No Polisi </td>
            <td><input type="text" class="form-control" name="no_polisi" id="no_polisi" placeholder="No Polisi" />        </td>
	    <tr><td>No Stnk </td>
            <td><input type="text" class="form-control" name="no_stnk" id="no_stnk" placeholder="No Stnk" />        </td>
	    <tr><td>Jenis </td>
            <td><input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" />        </td>
	    <tr><td>Model </td>
            <td><input type="text" class="form-control" name="model" id="model" placeholder="Model" />        </td>
	    <tr><td>Merk </td>
            <td><input type="text" class="form-control" name="merk" id="merk" placeholder="Merk" />        </td>
	    <tr><td>Tipe </td>
            <td><input type="text" class="form-control" name="tipe" id="tipe" placeholder="Tipe" />        </td>
	    <tr><td>Tahun Buat </td>
            <td><input type="text" class="form-control" name="tahun_buat" id="tahun_buat" placeholder="Tahun Buat" />        </td>
	    <tr><td>Vol Silinder </td>
            <td><input type="text" class="form-control" name="vol_silinder" id="vol_silinder" placeholder="Vol Silinder" />        </td>
	    <tr><td>No Rangka </td>
            <td><input type="text" class="form-control" name="no_rangka" id="no_rangka" placeholder="No Rangka" />        </td>
	    <tr><td>No Mesin </td>
            <td><input type="text" class="form-control" name="no_mesin" id="no_mesin" placeholder="No Mesin" />        </td>
	    <tr><td>Warna Tnkb </td>
            <td><input type="text" class="form-control" name="warna_tnkb" id="warna_tnkb" placeholder="Warna Tnkb" />        </td>
	    <tr><td>Kondisi Ban </td>
            <td><input type="text" class="form-control" name="kondisi_ban" id="kondisi_ban" placeholder="Kondisi Ban" />        </td>
            </table>  
            <input type="hidden" name="id" id="id" /> 
          </form>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="return kendaraan_simpan();"  >Simpan</button>
        </div>
      </div>
    </div>
  </div>


<?php $this->load->view($controller."_view_form_js");?>
<?php $this->load->view("js/general_js") ?>