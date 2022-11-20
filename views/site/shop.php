    <?php

    use yii\helpers\Html;

    $this->title = 'shop';
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <?= Html::a(Yii::t('app', 'Home'), ['site/index']) ?>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => 'index.php?r=site%2Fshop']); ?>
                            <input type="text" id="search-input" name='q' value="<?= @$_GET['q'] ?>" placeholder="Search here.....">
                            <?php \yii\widgets\ActiveForm::end(); ?>

                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php foreach ($catigories  as $categoty) : ?>
                                                        <li>
                                                            <?= Html::a($categoty->name_ar, ['shop', 'categories' => $categoty->id]) ?>
                                                        </li>
                                                    <?php endforeach; ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing <?= $offset ?>–<?= $limit ?> of <?= $totalCount ?> results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($models as $model) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <?= $this->render('/components/product', ['model' => $model]); ?>
                            </div>
                        <?php endforeach; ?>


                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                            ]); ?>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->