  <!-- Footer Section Begin -->
  <footer class="footer">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <div class="footer__copyright__text">
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      <p>
                          <?= Yii::t('app', 'All rights reserved') ?> <i class="fa fa-heart-o" aria-hidden="true"></i><?= Yii::t('app', 'by') ?> <?= Yii::$app->params['name_of_store'] ?></a>
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