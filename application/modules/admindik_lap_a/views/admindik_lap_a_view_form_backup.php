<style type="text/css">
      .umur {
            width: 100px;
      }


</style>
<form id="formulir" method="post" action="<?php echo site_url("$controller/$action"); ?>">
<table class='table table-bordered'>
      <tr class="separator"> <td colspan="2"> <b> LAP A</b>  </td> </tr>

     <tr><td width="161">Tanggal LP </td>
            <td width="516"><input type="text" class="tanggal form-control" name="tanggal" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy"  />        </td>
      <tr><td>Nomor </td>
            <td><input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor" />        </td>
      <tr><td>Golongan Kejahatan </td>
            <td><!-- <input type="text" class="form-control" name="id_gol_kejahatan" id="id_gol_kejahatan" placeholder="Golongan Kejahatan" />   -->   

            <?php echo form_dropdown("id_gol_kejahatan",$arr_gol_kejahatan,'','id="id_gol_kejahatan" class="form-control"') ?>

               </td>


      <tr><td>Kategori Tempat Kejahatan</td>
            <td>

            <?php echo form_dropdown("id_jenis_lokasi",$arr_jenis_lokasi,'','id="id_jenis_lokasi" class="form-control"') ?>

               </td>


      <tr><td>Tindak Pidana </td>
            <td><input type="text" class="form-control" name="tindak_pidana" id="tindak_pidana" placeholder="Tindak Pidana" />        </td>
      <tr><td>Pasal </td>
            <td><input type="text" class="form-control" name="pasal" id="pasal" placeholder="Pasal" />        </td>
      <tr><td>Fungsi Terkait </td>
            <td>
                  <?php echo form_dropdown("id_fungsi",$arr_fungsi,'','id="id_fungsi" class="form-control"') ?>

               </td>
 

              </td>
            </tr>
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
      <tr><td>Apa Yang Terjadi </td>
            <td><input type="text" class="form-control" name="kp_apa_yang_terjadi" id="kp_apa_yang_terjadi" placeholder="Apa Yang Terjadi" />        </td>
      <tr><td>Bagaimana Terjadi </td>
            <td><input type="text" class="form-control" name="kp_bagaimana_terjadi" id="kp_bagaimana_terjadi" placeholder="Bagaimana Terjadi" />        </td>
      <tr><td>Uraian Singkat </td>
            <td><input type="text" class="form-control" name="kp_uraian_singkat" id="kp_uraian_singkat" placeholder="Uraian Singkat" />        </td>
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



       <tr class="separator"> <td colspan="2"> <b> TERLAPOR / TERSANGKA</b>  </td> </tr>

        <tr> <td colspan="2"> 
        <a href="javascript:tersangka_row_add()" id="tersangka_row_add">Tambahkan </a>
        <TABLE id="table_tersangka"  width="100%">
        <TR> <TH>NAMA <BR />TERSANGKA/TERLAPOR</TH><TH>JK</TH><TH>SUKU</TH><TH>UMUR</TH><TH>PEKERJAAN</TH><TH>ALAMAT</TH><th></th></TR>

        <TR> <TD><input type="text" name="tersangka_nama[]" class="form-control" /></TD> 
        <TD><?php echo form_dropdown("tersangka_jk[]",array("L"=>"L","P"=>"P"),'','class="form-control"') ?></TD> 
        <TD>
            <?php 

            $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
                  "id_suku","suku",'suku');
            echo form_dropdown("tersangka_id_suku[]",$arr_suku,'','class="form-control"') ?>
        </TD> 
        <TD><input type="text" name="tersangka_umur[]" class="form-control umur" /></TD> 
        <TD>

            <?php 

            $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
                  "id_pekerjaan","pekerjaan",'pekerjaan');
            echo form_dropdown("tersangka_id_pekerjaan[]",$arr_pekerjaan,'','class="form-control"') ?>

        </TD> 
        <TD><input type="text" name="tersangka_alamat[]" class="form-control" /></TD>
        <td></td>

        </TR>


        </TABLE>


        </td> </tr>




        <tr class="separator"> <td colspan="2"> <b> KORBAN</b>  </td> </tr>

        <tr> <td colspan="2"> 

        <TABLE>
        <TR> <TH>NAMA KORBAN</TH><TH>JK</TH><TH>SUKU</TH><TH>UMUR</TH><TH>PEKERJAAN</TH><TH>ALAMAT</TH></TR>

        <TR> <TD><input type="text" name="korban_nama[]" class="form-control" /></TD>
        <TD><?php echo form_dropdown("korban_jk[]",array("L"=>"L","P"=>"P"),'','class="form-control"') ?></TD>
        <TD>
            <?php 

            $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
                  "id_suku","suku",'suku');
            echo form_dropdown("korban_id_suku[]",$arr_suku,'','class="form-control"') ?>
        </TD>
        <TD><input type="text" name="korban_umur[]" class="umur form-control" /></TD>
        <TD>

            <?php 

            $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
                  "id_pekerjaan","pekerjaan",'pekerjaan');
            echo form_dropdown("korban_id_pekerjaan[]",$arr_pekerjaan,'','class="form-control"') ?>

        </TD>
        <TD><input type="text" name="korban_alamat[]" class="form-control" /></TD>

        </TR>


        </TABLE>


        </td> </tr>

        

 <tr class="separator"> <td colspan="2"> <b> SAKSI</b>  </td> </tr>

        <tr> <td colspan="2"> 

        <TABLE>
        <TR> <TH>NAMA SAKSI</TH><TH>JK</TH><TH>SUKU</TH><TH>UMUR</TH><TH>PEKERJAAN</TH><TH>ALAMAT</TH></TR>

        <TR> <TD><input type="text" name="saksi_nama[]" class="form-control" /></TD>
        <TD><?php echo form_dropdown("saksi_jk[]",array("L"=>"L","P"=>"P"),'','class="form-control"') ?></TD>
        <TD>
            <?php 

            $arr_suku = $this->cm->get_arr_dropdown("m_suku", 
                  "id_suku","suku",'suku');
            echo form_dropdown("saksi_id_suku[]",$arr_suku,'','class="form-control"') ?>
        </TD>
        <TD><input type="text" name="saksi_umur[]" class="umur form-control" /></TD>
        <TD>

            <?php 

            $arr_pekerjaan = $this->cm->get_arr_dropdown("m_pekerjaan", 
                  "id_pekerjaan","pekerjaan",'pekerjaan');
            echo form_dropdown("saksi_id_pekerjaan[]",$arr_pekerjaan,'','class="form-control"') ?>

        </TD>
        <TD><input type="text" name="saksi_alamat[]" class="form-control" /></TD>

        </TR>


        </TABLE>


        </td> </tr>



 <tr class="separator"> <td colspan="2"> <b> BARANG BUKTI</b>  </td> </tr>

        <tr> <td colspan="2"> 

        <TABLE width="100%">
        <TR> <TH>BARANG BUKTI</TH></TR>

        <TR> <TD><input type="text" name="barbuk_nama[]" class="form-control" /></TD>
       
        </TR>


        </TABLE>


        </td> </tr>








       <tr class="separator"> <td colspan="2"> <b> TINDAKAN YANG DILAKUKAN </b>  </td> </tr>
      <tr><td>Tindakan Yang Dilakukan </td>
            <td><input type="text" class="form-control" name="tindakan_yang_dilakukan" id="tindakan_yang_dilakukan" placeholder="Tindakan Yang Dilakukan" />        </td>
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




<?php $this->load->view($controller."_view_form_js");?>