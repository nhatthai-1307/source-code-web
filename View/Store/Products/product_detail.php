<?php
session_start();
?>
<html>
<?php include '../header.php' ?>
<?php
$products = new Product();
$categories = new Category();
$categoryCollection = $categories->getCollection();
if (!empty($_GET['id'])) {
    $product = $products->getProductById($_GET['id']);
    $productAV = $products->getAttributeValueById($_GET['id']);
    $productCollection = $products->getProductCollection();
} else {
    header('Location: ../index.php');
    die();
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <?php foreach ($categoryCollection as $category) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#"><?= $category['name'] ?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="/source-code-web/<?= $product['image'] ?>" alt="" />
                            <!-- <h3>ZOOM</h3> -->
                        </div>
                    </div>

                    <div class="col-sm-7">
                        <div class="product-information">
                            <!--/product-information-->
                            <img src="/source-code-web/View/View/images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2><?= $product['name'] ?></h2>
                            <p>Web ID: <?= $product['id'] ?></p>
                            <img src="/source-code-web/View/View/images/product-details/rating.png" alt="" /><br>
                            <span>
                                <span><?= number_format($product['price'],0,',',' ') ?></span>
                                <button id="button_add_cart" type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                            <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input id="add_to_cart" type="submit" name="add_to_cart" value="Add To Cart">
                            </form>
                            <script>
                                $('#button_add_cart').click(function() {
                                    console.log("s");
                                    $('#add_to_cart').trigger('click');
                                });
                            </script>
                            <table>
                                <?php foreach ($productAV as $pav) : ?>
                                    <tr>
                                        <td><b><?= $pav['title'] ?></b></td>
                                        <td><?= $pav['value'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <img src="/source-code-web/View/View/images/product-details/share.png" class="share img-responsive" alt="" />
                        </div>
                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->
                <?php
                $indexItemActive = 0;
                $arrayP = [];
                foreach ($productCollection as $product) {
                    array_push($arrayP, $product);
                }

                ?>
                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" style="height: 370px;" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php foreach ($arrayP as $key => $product) : ?>
                                    <?php
                                    if ($indexItemActive <= 2) :
                                    ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <a href="/source-code-web/View/Store/Products/product_detail.php?id=<?= $product['id'] ?>">
                                                        <div class="productinfo text-center">
                                                            <img src="/source-code-web/<?= $product['image'] ?>" alt="" />
                                                            <h2><?= number_format($product['price'],0,',',' ') ?></h2>
                                                            <p><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                                <input id="recommended_add_to_cart_<?= $product['id'] ?>" type="submit" name="add_to_cart" value="Add To Cart">
                                                            </form>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $('#recommended_a_add_to_cart_<?= $product['id'] ?>').click(function() {
                                                $('#recommended_add_to_cart_<?= $product['id'] ?>').trigger('click');
                                            });
                                        </script>
                                        <?php unset($arrayP[$key]);
                                        $indexItemActive += 1; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="item">
                                <?php $indexItemActive = 0; ?>
                                <?php foreach ($arrayP as $key => $product) : ?>
                                    <?php
                                    if ($indexItemActive <= 2) :
                                    ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <a href="/source-code-web/View/Store/Products/product_detail.php?id=<?= $product['id'] ?>">
                                                        <div class="productinfo text-center">
                                                            <img style="height: 170px;" src="/source-code-web/<?= $product['image'] ?>" alt="" />
                                                            <h2><?= $product['price'] ?></h2>
                                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                                <input id="recommended_add_to_cart_<?= $product['id'] ?>" type="submit" name="add_to_cart" value="Add To Cart">
                                                            </form>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $('#recommended_a_add_to_cart_<?= $product['id'] ?>').click(function() {
                                                $('#recommended_add_to_cart_<?= $product['id'] ?>').trigger('click');
                                            });
                                        </script>
                                        <?php unset($arrayP[$key]);
                                        $indexItemActive += 1; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="item">
                                <?php $indexItemActive = 0; ?>
                                <?php foreach ($arrayP as $key => $product) : ?>
                                    <?php
                                    if ($indexItemActive <= 2) :
                                    ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <a href="/source-code-web/View/Store/Products/product_detail.php?id=<?= $product['id'] ?>">
                                                        <div class="productinfo text-center">
                                                            <img style="height: 170px;" src="/source-code-web/<?= $product['image'] ?>" alt="" />
                                                            <h2><?= $product['price'] ?></h2>
                                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                                <input id="recommended_add_to_cart_<?= $product['id'] ?>" type="submit" name="add_to_cart" value="Add To Cart">
                                                            </form>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $('#recommended_a_add_to_cart_<?= $product['id'] ?>').click(function() {
                                                $('#recommended_add_to_cart_<?= $product['id'] ?>').trigger('click');
                                            });
                                        </script>
                                        <?php unset($arrayP[$key]);
                                        $indexItemActive += 1; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
<?php include '../footer.php' ?>
<script src="/source-code-web/View/View/js/jquery.js"></script>
<script src="/source-code-web/View/View/js/price-range.js"></script>
<script src="/source-code-web/View/View/js/jquery.scrollUp.min.js"></script>
<script src="/source-code-web/View/View/js/bootstrap.min.js"></script>
<script src="/source-code-web/View/View/js/jquery.prettyPhoto.js"></script>
<script src="/source-code-web/View/View/js/main.js"></script>

</html>