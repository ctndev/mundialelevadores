
<section class="mbr-section mbr-section-md-padding mbr-footer footer2 bg-verde-2" id="contacts2-3" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-4">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif" size="3"><span style="letter-spacing: -1px; line-height: 20px;"><strong>Endereço</strong></span></font><br> Rua Coronel João Carneiro, 261 - Fátima<br>60040-560 Fortaleza - Ceará<br><br>
<strong>Contato</strong><br>mundialelevadores.for@gmail.com<br>
<?php echo $phone1?><br><?php echo $phone2?><br><br></p>
            </div>
            <!-- <div class="mbr-footer-content col-xs-12 col-md-4">
            
            
                  <div class="fb-page" data-href="https://www.facebook.com/mundialelevadores/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/mundialelevadores/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/mundialelevadores/">Mundial Elevadores</a></blockquote></div>
             

            
            </div> -->
            <div class="col-xs-12 col-md-4">
                <div class="mbr-map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2815.1699484733535!2d-38.52329464510839!3d-3.7553298861864364!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c748f75427a4a5%3A0x9e44b04f5034214a!2sMundial%20Elevadores%20Fortaleza%20LTDA!5e0!3m2!1spt-BR!2sus!4v1749085392005!5m2!1spt-BR!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding bg-verde-3" id="footer1-2" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    
    <div class="container">
        <p class="text-xs-center"><?php echo $siteName.' - '.Date('Y') ?></p>
    </div>
</footer>

<script>
    // Select the image element
    const imgElement = document.querySelector('.wpp');

    // Set initial width
    let currentWidth = 80;
    let growing = true;

    // Function to gradually change the width
    function pulseEffect() {
        if (growing) {
            currentWidth++;
            if (currentWidth >= 90) {
                growing = false;
            }
        } else {
            currentWidth--;
            if (currentWidth <= 80) {
                growing = true;
            }
        }
        imgElement.style.width = currentWidth + 'px';
    }

    // Set interval to create the pulsating effect
    setInterval(pulseEffect, 100); // Adjust the interval time for smoother or faster animation
</script>

  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/all.js"></script>
   
  
  
  
  <input name="animation" type="hidden">
  
 
  </body>
</html>