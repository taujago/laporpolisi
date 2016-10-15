<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.css" rel="stylesheet">

<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets") ?>/js/jquery.loadJSON.js"></script>
<link href="<?php echo base_url("assets") ?>/css/eblokir.css" rel="stylesheet">

 <style type="text/css">
    .dataTables_filter {
      display: none;
    }

.datepicker{z-index:9999 !important}


 </style>

<a class="btn btn-danger" href="<?php echo site_url("$controller") ?>"><span class="glyphicon glyphicon-arrow-left"></span></i> Kembali </a>
<br />
<hr />

<h5> CATATAN PROGRESS </h5>

<a  class="btn btn-primary" href="javascript:tambah_catatan()"><span class="glyphicon glyphicon-plus"></span></i> TAMBAH CATATAN</a>
 <BR /><BR />


 <div class="row">

<div class="col-md-10">
<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="tbl_catatan" role="grid">
<thead>
   <tr >
        <th width="20%">WAKTU</th>
        <th width="70%">CATATAN</th> 
        <th width="10%">PROSES</th>         
        
    </tr>
   
</thead>
</table>
</div>
 </div>
 
 <br /><br />
 



 


<table class='table table-bordered'>
      <tr class="separator"> <td colspan="2"> <b> LAP A</b>  </td> </tr>

     <tr><td width="161">Tanggal LP </td>
            <td width="516">   

            <?php echo $tanggal; ?>
            </td>
      <tr><td>Nomor </td>
            <td><?php echo $nomor; ?> </td>
      <tr><td>Golongan Kejahatan </td>
            <td> <?php echo $golongan_kejahatan ?>

               </td>


      <tr><td>Kategori Tempat Kejahatan</td>
            <td>
 
            <?php echo $jenis_lokasi ?>
               </td>


      <tr><td>Tindak Pidana </td>
            <td> <?php echo $tindak_pidana ?>  </td>
      <tr><td>Pasal </td>
            <td><?php echo $pasal ?>   </td>
      <tr><td>Fungsi Terkait </td>
            <td>
                   
                  <?php echo $fungsi ?>
               </td>
 

              </td>
            </tr>
   <tr class="separator"> <td colspan="2"> <b> PELAPOR</b>  </td> </tr>
      <tr><td> Nama Pelapor</td>
            <td><?php echo $pelapor_nama ?>    </td>
      <tr><td>Pangkat </td>
            <td> 
             <?php echo $pelapor_pangkat; ?>

            </td>
      <tr><td>Nrp </td>
            <td> <?php echo $pelapor_nrp ?>    </td>
      <tr><td>Kesatuan </td>
            <td>  <?php echo $pelapor_kesatuan ?>   </td>       
      <tr><td>Telpon </td>
            <td><?php echo $pelapor_tel ?>    </td>

   <tr class="separator"> <td colspan="2"> <b> PERISTIWA YANG TERJADI </b>  </td> </tr>

      <tr><td>Waktu Kejadian</td>
            <td> <?php echo $kp_wktu ?> </td>
      <tr><td>Tanggal Kejadian</td>
            <td><?php echo $kp_tanggal ?>      </td>
      <tr><td>Tempat Kejadian</td>
            <td><?php echo $kp_tempat_kejadian ?>    </td>
      <tr><td>Apa Yang Terjadi </td>
            <td> <?php echo $kp_apa_yang_terjadi ?>   </td>
      <tr><td>Bagaimana Terjadi </td>
            <td><?php echo $kp_bagaimana_terjadi ?>    </td>
      <tr><td>Uraian Singkat </td>
            <td><?php echo $kp_uraian_singkat ?>     </td>
      <tr><td> Dilaporkan Pada </td>
            <td><?php echo $kp_dilaporkan_pada ?> </td>
      <tr><td>Jam Dilaporkan </td>
            <td><?php echo $kp_jam_dilaporkan ?>    </td>
      <tr><td>Tempat Melaporkan </td>
            <td><?php echo $kp_tempat_melaporkan; ?>
                 </td>
      <tr><td>Motif Kejahatan </td>
            <td> 
               <?php echo $motif ?>                

            </td>

      </tr>


      <tr class="separator"> <td colspan="2"> <b> TINDAKAN YANG DILAKUKAN </b>  </td> </tr>
      <tr><td>Tindakan Yang Dilakukan </td>
            <td><?php echo $tindakan_yang_dilakukan ?>     </td>
      </tr>
     <tr class="separator"> <td colspan="2"> <b> PENERIMA LAPORAN </b>  </td> </tr>
      <tr><td>Nama </td>
            <td><?php echo $pen_lapor_nama ?>    </td>
      <tr><td>Pangkat  </td>
              
<td>     <?php echo $penerima_pangkat ?>
                  
            </td>
      <tr><td>NRP </td>
            <td> <?php echo $pen_lapor_nrp ?>    </td>
      <tr><td>Kesatuan </td>
            <td><?php echo $pen_lapor_kesatuan ?>  </td>
      <tr><td>Jabatan </td>
            <td><?php echo $pen_lapor_jabatan ?> </td>
      <tr><td>Telpon </td>
            <td><?php echo $pen_lapor_telpon ?>  </td>
            </tr>


  

 



  </td></tr>


 <tr class="separator"> <td colspan="2"> <b> TERLAPOR/TERSANGKA </b>  </td> </tr>
 <tr> <td colspan="2">
 

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
        
      
    </tr>
   
</thead>
</table>

 </td> </tr>



 <tr class="separator"> <td colspan="2"> <b> SAKSI </b>  </td> </tr>
 <tr> <td colspan="2">
 

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
        
      
    </tr>
   
</thead>
</table>

 </td> </tr> 



 <tr class="separator"> <td colspan="2"> <b> KORBAN </b>  </td> </tr>
 <tr> <td colspan="2">
 
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
         
      
    </tr>
   
</thead>
</table>

 </td> </tr> 






 <tr class="separator"> <td colspan="2"> <b> BARANG BUKTI </b>  </td> </tr>
 <tr> <td colspan="2">
 

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="barbuk" role="grid">
<thead>
   <tr >

        <th width="90%">BARANG BUKTI</th>         
        
    </tr>
   
</thead>
</table>

 </td> </tr> 



      <tr class="separator"> <td colspan="2"> <b> MENGETAHUI </b>  </td> </tr>
      <tr><td>Nama </td>
            <td> <?php echo $mengetahui_nama ?> </td>
      <tr><td>Pangkat </td>
            <td><?php echo $mengetahui_pangkat ?></td>

          
      <tr><td>NRP </td>
            <td><?php echo $mengetahui_nrp ?>  </td>
      <tr><td>Jabatan </td>
            <td><?php echo $mengetahui_jabatan ?>   </td>
     
       
  
    </table>



     

<div class="modal fade" id="modal_catatan" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="modal-dialog" class="modal-dialog modal-vertical-centered" style="width:50%; min-height:600px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="modal_catatan_judul">
              XX
            </h4>
         </div>
         <div class="modal-body">
            <!-- Add some text here --> 

            <form action="" id="form_catatan" method="post">
              
          
         <div class="form-group">
            <label for="tanggal" class="control-label">Tanggal:</label>
            <input name="tanggal" id="tanggal" data-date-format="dd-mm-yyyy" class="form-control tanggal"></textarea>
          </div>
         


          <div class="form-group">
            <label for="txt_pasal" class="control-label">Catatan:</label>
            <textarea class="form-control" id="catatan" name="catatan"></textarea>
          </div>
         
            
        <br />
             <input type="hidden" id="lap_a_id" name="lap_a_id" value="<?php echo $lap_a_id; ?>" />
             <input type="hidden" name="id"  id="id" />
             </form>
            
            
            
         </div> <!-- end of modal body  --> 
          
             
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="return catatan_simpan();"  >Simpan</button>
      </div>


         
      </div><!-- /.modal-content -->
</div><!-- /.modal -->


 <!-- end of modal tersangka --> 


   




<?php $this->load->view($controller."_view_detail_js") ?>


