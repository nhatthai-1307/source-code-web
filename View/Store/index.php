<?php
session_start();

?>
<html lang="en">

<head>
    <title>Store | DMD</title>
</head>

<?php include 'header.php' ?>
<?php
$products = new Product();
$categories = new Category();
$categoryCollection = $categories->getCollection();
$productCollection = null;
if (!empty($_GET['search'])) {
    $productCollection = $products->getProductCollectionBySearch($_GET['search']);
} elseif (!empty($_GET['category'])) {
    $productCollection = $products->getProductCollectionByCategoryId($_GET['category']);
} else {
    $productCollection = $products->getProductCollection();
}
?>
<?php include 'slider.php' ?>
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
                                    <h4 class="panel-title"><a href="?category=<?= $category['id'] ?>"><?= $category['name'] ?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Features Items</h2>
                    <?php foreach ($productCollection as $product) : ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <a href="/source-code-web/View/Store/Products/product_detail.php?id=<?= $product['id'] ?>">
                                        <div class="productinfo text-center">
                                            <img style="height: 170px;" src="../../<?= $product['image'] ?>" alt="" />
                                            <h2><?= number_format($product['price'],0,',',' ') ?></h2>
                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                            <a id="a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <form hidden action="../../Controller/Store/Cart.php" method="post">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <input id="add_to_cart_<?= $product['id'] ?>" type="submit" name="add_to_cart" value="Add To Cart">
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#a_add_to_cart_<?= $product['id'] ?>').click(function() {
                                console.log("s");
                                $('#add_to_cart_<?= $product['id'] ?>').trigger('click');
                            });
                        </script>
                    <?php endforeach; ?>
                </div>
                <?php
                $indexItemActive = 0;
                $arrayP = [];
                foreach ($productCollection as $product) {
                    array_push($arrayP, $product);
                }

                ?>
                <div class="recommended_items">
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
                                                            <img style="height: 170px;" src="../../<?= $product['image'] ?>" alt="" />
                                                            <h2><?= number_format($product['price'],0,',',' ') ?></h2>
                                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="../../Controller/Store/Cart.php" method="post">
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
                                                            <img style="height: 170px;" src="../../<?= $product['image'] ?>" alt="" />
                                                            <h2><?= $product['price'] ?></h2>
                                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="../../Controller/Store/Cart.php" method="post">
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
                                                            <img style="height: 170px;" src="../../<?= $product['image'] ?>" alt="" />
                                                            <h2><?= $product['price'] ?></h2>
                                                            <p style="height: 40px;"><?= $product['name'] ?></p>
                                                            <a id="recommended_a_add_to_cart_<?= $product['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                            <form hidden action="../../Controller/Store/Cart.php" method="post">
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
<?php include 'footer.php' ?>
<script src="../View/js/jquery.js"></script>
<script src="../View/js/price-range.js"></script>
<script src="../View/js/jquery.scrollUp.min.js"></script>
<script src="../View/js/bootstrap.min.js"></script>
<script src="../View/js/jquery.prettyPhoto.js"></script>
<script src="../View/js/main.js"></script>

</html>