<script type="text/javascript">
   $(document).ready(function(){
   

   $('<p>').appendTo('#sleman').text('SELEMAN').css({position:'absolute',
                                                 top:'100px',
                                                 left:'70px'});



    $(".tanggal").datepicker()
    .on('changeDate', function(ev){                 
        $(this).datepicker('hide');
    });
   

$("#peta").hide();

$(".petajogja").maphilight({fade: false});

 $( document ).tooltip();
 

$(".ds2").select2({
  placeholder: "Pilih "
});




// var defaultDipTooltip = 'I know you want the dip. But it\'s loaded with saturated fat, just skip it '
//         +'and enjoy as many delicious, crisp vegetables as you can eat.';

//     var carrotTooltip = 'Carrots?! I Love Carrots!';

    





$("#wates").hover(function(){
   $(this).css("background-color", "yellow");
    }, function(){
    $(this).css("background-color", "pink");
});


    $("#harian").hide();
    $("#periodik").hide();
    $("#bulanan").hide();

    $("#jenis").change(function(){

      v_jenis = $(this).val();
        if( v_jenis == "harian") {
            $("#harian").show();
            $("#periodik").hide();
            $("#bulanan").hide();
        }
        else if ( v_jenis == "periodik" ) {
            $("#harian").hide();
            $("#periodik").show();
            $("#bulanan").hide();
        }
        else if ( v_jenis == "bulanan" ) {
            $("#harian").hide();
            $("#periodik").hide();
            $("#bulanan").show();
        }
        else {
            $("#harian").hide();
            $("#periodik").hide();
            $("#bulanan").hide();
        }

    });

});






function tampildata(){
  $("#peta").hide();

  $('#myPleaseWait').modal('show');

  $.ajax({
      url : '<?php echo site_url("$this->controller/get_laporan") ?>',
      data : $("#frmlaporan").serialize(),
      type : 'post', 
      dataType : 'json',
      success : function(obj) {
        //$("#hasil").html(html);
        $("#peta").show();

        $("#sleman").prop('title',  'SLEMAN =  ' +  obj.a34_4);
        $("#wonosari").prop('title',  'GUNUNG KIDUL ' +  obj.a34_3);
        $("#jogja").prop('title',  'KOTA JOGJA ' +  obj.a34_71);
        $("#bantul").prop('title',  'BANTUL ' +  obj.a34_2);
        $("#wates").prop('title',  'KULON PROGO '  + obj.a34_1);


$("#td_jogja").html(obj.a34_71);
$("#td_bantul").html(obj.a34_2);
$("#td_sleman").html(obj.a34_4);
$("#td_gunung_kidul").html(obj.a34_3);
$("#td_kulon_progo").html(obj.a34_1);



    //     var image = $('#petajogja');



    // image.mapster(
    // {
    //     fillOpacity: 0.1,
    //     fillColor: "d42e16",
    //     isSelectable: false,
    //     singleSelect: true,
    //     mapKey: 'name',
    //     listKey: 'name',
    //     toolTipContainer: '<div style="width:100px; height:100px; color:#BBBBBB"> </div>',       
    //     showToolTip: true,
    //     toolTipClose: ["image-mouseout"],
    //     areas: [    {
    //                 key: "sleman",
    //                 toolTip: obj.a34_4
    //                 },
                        
    //                 { 
    //                 key: "wonosari",
    //                 toolTip: obj.a34_3
    //                 }]
    // })
    //     .mapster('tooltip','sleman');





        $('#myPleaseWait').modal('hide');
      }
    });
 //alert('whatadaa');
  return false;
}

 

 </script>