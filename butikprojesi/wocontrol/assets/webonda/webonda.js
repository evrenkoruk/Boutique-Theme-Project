
    
    function gorsel_sil(gorsel_id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=gorsel_sil",
        data:"gorsel_id="+gorsel_id,
        type:"post",
        success:function(cevap){

          if(cevap == "ok"){

            $("#gorsel"+gorsel_id).hide();

          }else{
            alert("Hata ! Görsel Silinemedi.");
          }

        }
      });

    }


    function veri_sil(baslik,veri,id){

      $("#verisil_status").html('<center><img src="assets/img/dikkat.png" class="animated flash" style="width: 80px; margin-bottom: 13px;"><br><strong>'+baslik+'</strong> verisini <b>kalıcı</b> olarak silmek üzeresiniz !</center>');

      $("#sil_footer").html('<button type="button" class="btn btn-warning" data-dismiss="modal" style="margin-bottom:0px;" onclick="veri_sil2(\''+veri+'\',\''+id+'\')">Seçili Veriyi Sil</button><button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>');


    }


    function veri_sil2(veri,id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=veri_sil",
        data:"veri="+veri+"&id="+id,
        type:"post",
        success:function(cevap){

          if(cevap == "ok"){

            $("#veri"+id).hide(250);

          }else{
            alert("Hay Aksi ! Birşeyler ters gitti.");
          }

        }
      });

    }



    function ilan_oku(baslik,id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=ilanlar/ilan_oku",
        data:"ilan_id="+id,
        type:"post",
        success:function(cevap){

          if(cevap == ""){

            alert("Hay Aksi ! Birşeyler ters gitti.");

          }else{
            $("#m_ilanbaslik").html(baslik);
            $("#ilan_icerik").html(cevap);


          }

        }
      });

    }



    function ilan_yayinla(baslik,id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=ilanlar/ilan_islem",
        data:"ilan_id="+id+"&islem=yayinla",
        type:"post",
        success:function(cevap){

          if(cevap == "ok"){

            $("#ilan_status").html('<center><img src="assets/img/onay.png" class="animated flash" style="width: 80px; margin-bottom: 13px;"><br><strong>'+baslik+'</strong> başlıklı ilan başarıyla yayınlandı.</center>');

          }else{
            alert("Hay Aksi ! Birşeyler ters gitti.");
          }

        }
      });

    }

     function ilan_pasif(baslik,id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=ilanlar/ilan_islem",
        data:"ilan_id="+id+"&islem=pasif",
        type:"post",
        success:function(cevap){

          if(cevap == "ok"){

            $("#ilan_status").html('<center><img src="assets/img/onay.png" class="animated flash" style="width: 80px; margin-bottom: 13px;"><br><strong>'+baslik+'</strong> başlıklı ilan başarıyla yayından kaldırıldı.</center>');

          }else{
            alert("Hay Aksi ! Birşeyler ters gitti.");
          }

        }
      });

    }


    function mesaj_oku(baslik,id){

      $.ajax({
        url:"/wocontrol/ajax.php?p=mesajlar/mesaj_oku",
        data:"mesaj_id="+id,
        type:"post",
        success:function(cevap){

          if(cevap == ""){

            alert("Hay Aksi ! Birşeyler ters gitti.");

          }else{
            $("#m_ilanbaslik").html(baslik);
            $("#ilan_icerik").html(cevap);


          }

        }
      });

    }