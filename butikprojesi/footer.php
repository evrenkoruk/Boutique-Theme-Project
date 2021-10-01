                   <!-- start instagram-section -->
       <section class="instagram-section">
        <div class="container-1410">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="instagram-inner">
                        <div class="instagram-text">
                            <h3>Bizi Instagram`da Takip Edin</h3>
                            <p>@ksenyabutik</p>
                        </div>
                        <div class="instagram-grids clearfix">
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/1.jpg" alt></a>
                            </div>
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/3.jpg" alt></a>
                            </div>
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/4.jpg" alt></a>
                            </div>
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/2.jpg" alt></a>
                            </div>
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/5.jpg" alt></a>
                            </div>
                            <div class="grid">
                                <a href="shop-single.html"><img loading=lazy src="assets/images/instagram/6.jpg" alt></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end instagram-section -->  


                <!-- start site-footer -->
        <footer class="site-footer">
            <div class="container-1410">
                <div class="row widget-area">
                    <div class="col-lg-4 col-xs-6  widget-col about-widget-col">
                        <div class="widget newsletter-widget">
                            <div class="inner">
                                <h3>HABER BÜLTENİ</h3>
                                <p>E-Mail bültenimize kayıt olarak en yeni ürünlerden ve fırsatlardan haberdar olabilirsiniz</p>
                                <form>
                                    <div class="input-1">
                                        <input type="email" class="form-control" placeholder="E-Posta Adresiniz *" required>
                                    </div>
                                    <div class="submit clearfix">
                                        <button type="submit">Kayıt Ol</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6 widget-col">
                        <div class="widget contact-widget">
                            <h3>İLETİŞİM BİLGİLERİMİZ</h3>
                            <ul>
                                <li><strong>Telefon:</strong> +90 543 544 31 34</li>
                                <li><strong>Whatsapp:</strong> +90 543 544 31 34</li>
                                <li><strong>Email:</strong> info@ksenyabutik.com</li>
                                <li><strong>Adres:</strong> Fetih Mahallesi, Elçiler Sokak, No:19/4 Ataşehir, İstanbul</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-6 widget-col">
                        <div class="widget company-widget">
                            <h3>KSENYA BUTİK</h3>
                            <ul>
                                <li><a href="hakkimizda.html">Hakkımızda</a></li>
                                <li><a href="iletisim.html">Bize Ulaşın</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-6 widget-col">
                        <div class="widget payment-widget">
                            <h3>ÜRÜN GRUPLARIMIZ</h3>
                            <ul>

                                <?php

                                        $hizmetler = $wo_db->query("select * from sayfalar where ust_id=5 order by id ASC");

                                        foreach ($hizmetler as $hizmet){

                                            $sayfa_id = $hizmet["id"];

                                            $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
                                            foreach ($sayfaKontrol as $sayfa) {
                                                $sayfa_baslik = $sayfa["baslik"];
                                                $h_url = 'urunler/'.$hizmet["id"].'/'.wo_seo($sayfa_baslik).'.html';
                                            }

                                            
                                            
                                            ?>

                                                <li><a href="<?=$h_url;?>"><?=$sayfa_baslik;?>  <i class="fa fa-angle-down"></i></a></li>
                                            <?
                                        }

                                    ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->

            <div class="lower-footer">
                <div class="container-1410">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lower-footer-inner clearfix">
                                <div>
                                    <p>&copy; 2021 Ksenya Butik - Tüm Hakları Saklıdır</p>
                                </div>
                                <div class="social">
                                    <ul class="clearfix">
                                        <li><a href="#" title="Facebook">fb</a></li>
                                        <li><a href="#" title="Twitter">tw</a></li>
                                        <li><a href="#" title="Instagram">ig</a></li>
                                        <li><a href="#" title="Pinterest">pr</a></li>
                                    </ul>
                                </div>
                                <div class="extra-link">
                                    <ul>
                                        <li><a href="#">Kullanıcı Sözleşmesi </a></li>
                                        <li><a href="#">Çerez Politikası</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end site-footer -->


                <!-- start newsletter-popup-area-section -->
        <!-- <section class="newsletter-popup-area-section">
            <div class="newsletter-popup-area">
                <div class="newsletter-popup-ineer">
                    <button class="btn newsletter-close-btn"><i class="pe-7s-close-circle"></i></button>
                    <div class="img-holder">
                        <img src="assets/images/newsletter.jpg" loading=lazy alt>
                    </div>
                    <div class="details">
                        <h4>Get 25% discount shipped to your inbox</h4>
                        <p>Subscribe to the Zango eCommerce newsletter to receive timely updates to your favorite
                            products</p>
                        <form>
                            <div>
                                <input type="email" placeholder="Enter your email" />
                                <button type="submit">Subscribe</button>
                            </div>
                            <div>
                                <label class="checkbox-holder"> Don't show this popup again!
                                    <input type="checkbox" class="show-message">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- end newsletter-popup-area-section -->       

    </div>
    <!-- end of page-wrapper -->



    <!-- All JavaScript files
    ================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins for this template -->
    <script src="assets/js/jquery-plugin-collection.js"></script>

    <!-- Custom script for this template -->
    <script src="assets/js/script.js"></script>

    <style type="text/css">
        .sc-7dvmpp-1{
            display: none;
        }

        .hasyTc{
            display: none;
        }
    </style>


    <!-- WHATSAPP BUTONU -->
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+90 543 544 31 34", // WhatsApp number
            instagram: "ksenyabutik", // Instagram username
            call: "+90 543 544 31 34", // Call phone number
            call_to_action: "Bize mesaj gönderin", // Call to action
            button_color: "#000000", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "whatsapp,instagram", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->


</body>
</html>