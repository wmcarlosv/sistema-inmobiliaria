<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Las 4 metaetiquetas anteriores * deben * ir primero en la cabeza; cualquier otro contenido principal debe venir * después * de estas etiquetas -->

    <!-- Title -->
    <title>B&G - Grupo Inmobiliario - @yield('title','Home')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    @yield('css')

</head>

<body>
    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <i class="circle-preloader"></i>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="header-content h-100 d-flex align-items-center justify-content-between">
                            <div class="academy-logo">
                                <a href="index.html"><img src="{{ asset('img/core-img/logo.png') }}" alt=""></a>
                            </div>
                            <div class="login-content">
                                @if(!Auth::check())
                                <span>
                                    <a href="{{ route('register') }}">Registrarse</a>  
                                    /  
                                    <a href="{{ route('login') }}">Ingresar</a></span>
                                @else

                                    @if(Auth::user()->role == 'customer')
                                         <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Perfil
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('profile') }}">Mi perfil</a>
                                            <a class="dropdown-item" href="#">Intereses</a>
                                            <a class="dropdown-item" href="#">Solicitudes de Venta</a>
                                            <form action="{{ route('logout') }}" method="POST" id="logout">
                                                @csrf
                                                <a class="dropdown-item" onclick="javascript:document.querySelector('#logout').submit()" href="#">Salir</a>
                                            </form>
                                          </div>
                                        </div>
                                    @else
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Admin
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('profile') }}">Mi perfil</a>
                                            <a class="dropdown-item" href="{{ route('sales.index') }}">Ventas</a>
                                            <a class="dropdown-item" href="{{ route('rents.index') }}">Rentas</a>
                                            <a class="dropdown-item" href="#">Solicitudes de Venta</a>
                                            <a class="dropdown-item" href="#">Solicitudes de Compra</a>
                                            <form action="{{ route('logout') }}" method="POST" id="logout">
                                                @csrf
                                                <a class="dropdown-item" onclick="javascript:document.querySelector('#logout').submit()" href="#">Salir</a>
                                            </form>
                                          </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="academy-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="academyNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.html">INICIO</a></li>
                                    <li><a href="#">SERVICIOS</a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">ASESORÍA</a></li>
                                            <li><a href="about-us.html">AVALUOS</a></li>
                                            <li><a href="course.html">COMPRAR</a></li>
                                            <li><a href="blog.html">VENDER</a></li>
                                            <li><a href="blog.html">RENTAR</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about-us.html">NOSOTROS</a></li>
                                    <li><a href="course.html">UBICACIONES</a></li>
                                    <li><a href="contact.html">CONTACTO</a></li>
                                    
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Calling Info -->
                        <div class="calling-info">
                            <div class="call-center">
                                <a href="tel:+526688180888"><i class="icon-telephone-2"></i> <span>(+52) 668 818 0808 </span></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
   
    @yield('content')
    
    <footer class="footer-area">
        <div class="main-footer-area section-padding-100-0">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <a href="#"><img src="{{ asset('img/core-img/logo2.png') }}" alt=""></a>
                            </div>
                            <p>Cras vitae turpis lacinia, lacinia lacus non, fermentum nisi. Donec et sollicitudin est, in euismod erat. Ut at erat et arcu pulvinar cursus a eget.</p>
                            <div class="footer-social-info">
                                <a href="https://www.facebook.com/grupobgcom"><i class="fa fa-facebook"></i></a>
                               <!-- <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>-->
                                <a href="https://www.instagram.com/bggrupoinmobiliario/"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Usefull Links</h6>
                            </div>
                            <nav>
                                <ul class="useful-links">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Services &amp; Features</a></li>
                                    <li><a href="#">Accordions and tabs</a></li>
                                    <li><a href="#">Menu ideas</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Gallery</h6>
                            </div>
                            <div class="gallery-list d-flex justify-content-between flex-wrap">
                                <a href="img/bg-img/gallery1.jpg" class="gallery-img" title="Gallery Image 1"><img src="{{ asset('img/bg-img/gallery1.jpg') }}" alt=""></a>
                                <a href="img/bg-img/gallery2.jpg" class="gallery-img" title="Gallery Image 2"><img src="{{ asset('img/bg-img/gallery2.jpg') }}" alt=""></a>
                                <a href="img/bg-img/gallery3.jpg" class="gallery-img" title="Gallery Image 3"><img src="{{ asset('img/bg-img/gallery3.jpg') }}" alt=""></a>
                                <a href="img/bg-img/gallery4.jpg" class="gallery-img" title="Gallery Image 4"><img src="{{ asset('img/bg-img/gallery4.jpg') }}" alt=""></a>
                                <a href="img/bg-img/gallery5.jpg" class="gallery-img" title="Gallery Image 5"><img src="{{ asset('img/bg-img/gallery5.jpg') }}" alt=""></a>
                                <a href="img/bg-img/gallery6.jpg" class="gallery-img" title="Gallery Image 6"><img src="{{ asset('img/bg-img/gallery6.jpg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>B&G Grupo Inmobiliario</h6>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-placeholder"></i>
                                <p>Av. Venustiano Carranza 699 pte -6 altos,
                                    Col. Centro</p>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-telephone-1"></i>
                                <p><br>Oficina: (668) 818-0888</p>
                            </div>
                            <div class="single-contact d-flex">
                                <i class="icon-contract"></i>
                                <p>admin@grupobg.com.mx</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed & Designed <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://fb.com/DEVELOPERJ4" target="_blank">DEVELOPERJ4</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('js/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("table.data-table").DataTable();
        });
    </script>
    @yield('js')
</body>

</html>