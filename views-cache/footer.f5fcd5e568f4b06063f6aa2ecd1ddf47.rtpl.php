<?php if(!class_exists('Rain\Tpl')){exit;}?> <div class="footer-top-area">
   <br><br> <br><br>
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h3>Papelaria e Livraria J.A</h3>
                        <p><i style="color: white"  class="fa fa-map-marker"></i> SCRN 704/705 BL H, - Asa Norte - Brasília, DF - CEP: 70730-680.</p>
                        <p><i style="color: white"  class="fa fa-phone"></i> (61) 3032-1335</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Navegação </h2>
                        <ul>
                            <?php if( checkLogin(false) ){ ?>
                            <li><a href="/profile">Minha Conta</a></li>
                            <li><a href="#">Meus Pedidos</a></li>
                            <?php }else{ ?>
                             <li><a href="/login">Login</a></li>
                            <?php } ?>
                            
                        </ul>                        
                    </div>
                </div>
               
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categorias</h2>
                        <ul>
                            <?php if( totalCategories() != 0  ){ ?>
                                <?php require $this->checkTemplate("categories-menu");?>
                                <?php }else{ ?>
                                 <li>Nenhuma Cadastrada</li>
                            <?php } ?>
                            

                        </ul>                        
                    </div>
                </div>

                
              
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Entre em contato</h2>
                        <p>Para maiores informações entre em contato.</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <textarea style="width: 20em;"> </textarea>
                                 <?php if( checkLogin(false) ){ ?>
                                  <center><input type="submit" value="Enviar"></center>
                                    <?php }else{ ?>
                                <center><input  data-toggle="modal" data-target="#mensagem"type="submit" value="Enviar"></center>
                                <?php } ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->

     <!-- Modal -->
                                        <div class="modal fade" id="mensagem" tabindex="-1" role="dialog" aria-labelledby="registerAvaliaction" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>                                             
                                            </button>
                                            <h5 class="modal-title" id="exampleModalLabel"><b>
                                           Mensagem</b></h5>
                                           
                                            <br>
                                          </div>

                                          <div class="modal-body">
                                            <h4 style="font-size: 16px">Para enviar a mensagem é necessário realizar <b>login</b> ou <b>cadastro.</b> </h4>      
                                          </div> 
                                           <div class="modal-footer">
                                            <form role="form" action="/login">
                                                <input type="submit" value="logar ou cadastrar">
                                            </form>
                                          </div>                                       
                                        </div>
                                      </div>
                                    </div>  
                                     <!--End  Modal --> 

    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        
                    </div>
                </div>
                
                <div class="col-md-4">
                  <br>
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="/res/site/js/jquery.magnific-popup.js"></script>
     <script src="/res/site/js/scripts.js"></script>


    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="res/site/js/owl.carousel.min.js"></script>
    <script src="res/site/js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="res/site/js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="res/site/js/main.js"></script>

   <script type="text/javascript">
    $(function () {
     $('[data-toggle="popover"]').popover()
    })
   </script>
   
     <!-- sweetalert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="res/site/sweetalert2/dist/sweetalert2.min.js"></script>
   <script src="res/site/js/functions.js"></script>  

    
                        
    
    <!-- Slider -->
    <script type="text/javascript" src="res/site/js/bxslider.min.js"></script>
	<script type="text/javascript" src="res/site/js/script.slider.js"></script>
  </body>
</html>