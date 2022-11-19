  <!-- Footer Section Begin -->
  <footer class="footer">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="footer__about">
                      <div class="footer__logo">
                          <a href="#"><img src="img/footer-logo.png" alt=""></a>
                      </div>
                      <p>The customer is at the heart of our unique business model, which includes design.</p>
                      <a href="#"><img src="img/payment.png" alt=""></a>
                  </div>
              </div>

              <div class="col-lg-6  col-md-6 col-sm-6">
                  <div class="footer__widget">
                      <h6>NewLetter</h6>
                      <div class="footer__newslatter">
                          <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                          <form action="#">
                              <input type="text" placeholder="Your email">
                              <button type="submit"><span class="icon_mail_alt"></span></button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 text-center">
                  <div class="footer__copyright__text">
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      <p>Copyright © 2017
                          All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <?= '' ?></a>
                      </p>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Search Begin -->
  <div class="search-model">
      <div class="h-100 d-flex align-items-center justify-content-center">
          <div class="search-close-switch">+</div>
          <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => 'index.php?r=site%2Fshop', 'class' => 'search-model-for']); ?>
          <input type="text" id="search-input" placeholder="Search here.....">
          <?php \yii\widgets\ActiveForm::end(); ?>


      </div>
  </div>
  <!-- Search End -->