<!-- footer part start  -->

<footer class="footer">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-logo-item">
                    <div class="footer-logo">
                        <a href="<?= base_url('/'); ?>">
                            <img class="footer-logo-thumb"
                                src="<?= base_url('public/assets/image/others/logo/' . ($datosEmpresa[0]['empresa_logo'] ?? 'default-logo.png')); ?>"
                                alt="footer-logo-thumb" />
                        </a>

                    </div>
                    <div class="footer-logo-text">
                        <p><?= esc($datosEmpresa[0]['empresa_descripcion']) ?></p>
                    </div>
                    <div class="footer-logo-icon">
                        <a href="https://www.facebook.com/tegnexstore.pe" target="_blank"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.tiktok.com/@tegnexstore?lang=es" target="_blank"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="https://wa.link/fryn84" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.youtube.com/@corporaciontegnex7403" target="_blank"><i
                                class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-link-df">
                    <div class="footer-link">
                        <div class="footer-link-text">
                            <h2>Links</h2>
                        </div>
                        <div class="footer-menu">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('/'); ?>">Inicio</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('#sistemasSelect'); ?>">Servicios</a>
                                </li>
                                <!--  <li>
                                        <a href="home-1-blog.html">Blog</a>
                                    </li> -->
                                <li>
                                    <a href="<?php echo base_url('/contacto'); ?>">Contactanos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-services-df">
                    <div class="footer-services">
                        <div class="footer-services-text">
                            <h2>Servicios</h2>
                        </div>
                        <div class="footer-services-menu">
                            <ul>
                                <li>
                                    <p style="color: #fff;">Facturación Eletrónica</p>
                                </li>
                                <li>
                                    <p style="color: #fff;">Sistema Food</a>
                                </li>
                                <li>
                                    <p style="color: #fff;">Integración OSE</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 ">
                <div class="official">
                    <div class="official-text">
                        <h2>Informacion Oficial:</h2>
                    </div>
                    <div class="official-item">
                        <div class="official-inner">
                            <div class="icon">
                                <a href="#"><i class="fa-solid fa-location-dot"></i></a>
                            </div>
                            <div class="text">
                                <a href="#"><?= esc($datosEmpresa[0]['empresa_direccion']) ?></a>
                            </div>
                        </div>
                        <div class="official-inner">
                            <div class="icon">
                                <a href="#"><i class="fa-solid fa-phone"></i></a>
                            </div>
                            <div class="text">
                               <a href="https://wa.link/fryn84"><?= esc($datosEmpresa[0]['empresa_telefono']) ?></a>
                            </div>

                        </div>

                    </div>

                    <div class="official-text-two">
                        <p><?= esc($datosEmpresa[0]['empresa_razonsocial']) ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <h5>Copyright © 2024 – Todo los derechos reservados <a
                                href="<?php echo base_url('/'); ?>">Tegnex</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- footer part end  -->





<!-- back-to-top part start  -->


<div class="back-to-top">
    <i class="fa-solid fa-arrow-up"></i>
</div>

<!--  back-to-top part end  -->








<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/venobox.min.js"></script>


<script src="js/isotope.pkgd.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/precios.js"></script>


</body>

</html>
<script>

</script>