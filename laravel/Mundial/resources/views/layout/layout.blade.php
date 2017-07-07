<!DOCTYPE html>
<html>
<head>
  <!-- 
 

-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Yuri Alexsander">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('/images/logo.jpg') }}" type="image/x-icon">
  <meta name="description" content="">
  <meta name=theme-color content=#7fc771>
  <link rel="stylesheet" href="{{ asset('source/fonts/fonts.css') }}">
  <link rel="stylesheet" href="{{ asset('source/all.css') }}">
   
    

 
  
</head>
<body>
     
    
     

<section id="menu-0">

    <nav class="navbar navbar-dropdown bg-color transparent navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        
                        <a class="navbar-caption" href="#top">Mundial Elevadores</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="/#top">INICIO</a></li><li class="nav-item"><a class="nav-link link" href="/#msg-box3-0">SOBRE</a></li><li class="nav-item"><a class="nav-link link" href="/#header3-8">SERVIÇOS</a></li><li class="nav-item"><a class="nav-link link" href="#contacts2-3">CONTATO</a></li><li class="nav-item"><a class="nav-link link" href="/elevac200">ELEVAC 200</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

 <section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-section-with-arrow" id="header1-1" style="background-image: url({{ asset('source/images/imagem-elevador-2000x1000.jpg') }});">

     
    <div class="mbr-table-cell">

        <div class="container">
            <div class="row">
                <div class="mbr-section col-md-10 col-md-offset-1 text-xs-center">

                    <h1 class="mbr-section-title display-1 lato">Mundial Elevadores</h1>
                    <p class="mbr-section-lead lead">Manutenção, Modernização, Montagem, Assistência Técnica e Vendas de Elevadores Residenciais e Monta-Cargas<br><br>(85) 3231-6180 | (85) 9.9991-0050<br></p>
                    
                </div>
               
            </div>
        </div>
    </div>

    <div class="mbr-arrow mbr-arrow-floating" aria-hidden="true"><a href="#msg-box3-0"><i class="mbr-arrow-icon"></i></a></div>

</section>
    
    
    
    
    
    
    
       @yield('content')
    
     
     
     
     
     
     
     
     
     
     
     
     
     
<section class="mbr-section mbr-section-md-padding mbr-footer footer2" id="contacts2-3" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-4">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif" size="3"><span style="letter-spacing: -1px; line-height: 20px;"><strong>Endereço</strong></span></font><br> Rua Dr. Pontes Neto nº 100<br>60813-600 Fortaleza - Ceará<br><br>
<strong>Contato</strong><br>mundialelevadores@terra.com.br<br>
(85)&nbsp;3231-6180<br>(85) 9.9991-0050<br><br></p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-4">
            
            
                  <div class="fb-page" data-href="https://www.facebook.com/macromixbr" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/macromixbr" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/macromixbr">Macromix Informática</a></blockquote></div>
             

            
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="mbr-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:ChIJf3vGWFhPxwcRQdRgYYj942w" allowfullscreen=""></iframe></div>
            </div>
        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-2" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    
    <div class="container">
        <p class="text-xs-center">Mundial Elevadores 2017<br>Desenvolvido por Yuri Alexsander</p>
    </div>
</footer>


 
  <script src="{{ asset('source/web/assets/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('source/all.js') }}"></script>
   
   
   
    
    <!--
    
  <script src=" {{ asset('source/web/assets/jquery/jquery.min.js') }} "></script>
  <script src=" {{ asset('source/tether/tether.min.js') }} "></script>
  <script src=" {{ asset('source/bootstrap/js/bootstrap.min.js') }} "></script>
  <script src=" {{ asset('source/smooth-scroll/smooth-scroll.js') }} "></script>
  <script src=" {{ asset('source/dropdown/js/script.min.js') }} "></script>
  <script src=" {{ asset('source/touch-swipe/jquery.touch-swipe.min.js') }} "></script>
  <script src=" {{ asset('source/viewport-checker/jquery.viewportchecker.js') }} "></script>
  <script src=" {{ asset('source/jarallax/jarallax.js') }} "></script>
  <script src=" {{ asset('source/masonry/masonry.pkgd.min.js') }} "></script>
  <script src=" {{ asset('source/imagesloaded/imagesloaded.pkgd.min.js') }} "></script>
  <script src=" {{ asset('source/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js') }} "></script>
  <script src=" {{ asset('source/theme/js/script.js') }} "></script> -->
  <script src=" {{ asset('source/mobirise-gallery/player.min.js') }} "></script>
  <script src=" {{ asset('source/mobirise-gallery/script.js') }} "></script>

    
    
    
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  
  
  <input name="animation" type="hidden">
 



    
    </body>
</html>