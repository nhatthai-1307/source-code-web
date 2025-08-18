<?php
include '/xampp/htdocs/source-code-web/Connect/Connection.php';
include '/xampp/htdocs/source-code-web/Model/Customer/Customer.php';
include '/xampp/htdocs/source-code-web/Model/Product/Product.php';
include '/xampp/htdocs/source-code-web/Model/Category/Category.php';
include '/xampp/htdocs/source-code-web/Model/Cart/Cart.php';
include '/xampp/htdocs/source-code-web/Model/Order/Order.php';
include '/xampp/htdocs/source-code-web/Model/Payment/Payment.php';

$customer = new Customer();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Header | DMD</title>
	<link href="/source-code-web/View/View/Css/store-styles.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/bootstrap.min.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/font-awesome.min.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/prettyPhoto.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/price-range.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/animate.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/main.css" rel="stylesheet">
	<link href="/source-code-web/View/View/Css/responsive.css" rel="stylesheet">
	<link rel="shortcut icon" href="/source-code-web/View/View/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/source-code-web/View/View/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/source-code-web/View/View/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/source-code-web/View/View/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/source-code-web/View/View/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
	<header id="header">
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +84 348 732 716</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> nhatthai130705@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=" "><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/source-code-web/View/Store/index.php"><img src="/source-code-web/View/View/images/home/logo2.png" alt="" style="width: 150px;" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php if (!empty($_SESSION['userId'])) : ?>
									<?php
									$customerNow = $customer->getCustomerById($_SESSION['userId']);
									?>
									<li><a href="/source-code-web/View/Store/Customers/customer.php"><i class="fa fa-user"></i><?= $customerNow['first_name'] . ' ' . $customerNow['last_name'] ?></a></li>
									<li><a href="/source-code-web/View/Store/Carts/cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
									<li><a href="/source-code-web/Controller/Store/Login.php?action=logout" class="active"><i class="fa fa-lock"></i> Logout</a></li>
								<?php else : ?>
									<li><a href="/source-code-web/View/Store/Carts/cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
									<li><a href="/source-code-web/View/Store/Login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/source-code-web/View/Store/index.php">Home</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input id="search" type="text" placeholder="Search" />
						</div>
						<script>
							var search = document.getElementById("search");
							search.addEventListener("keypress", function(event) {
								if (event.key === "Enter") {
									event.preventDefault();
									document.location = 'http://localhost/source-code-web/View/Store/index.php?search=' + search.value;
								}
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</header>

	<script src="/source-code-web/View/View/js/jquery.js"></script>
	<script src="/source-code-web/View/View/js/price-range.js"></script>
	<script src="/source-code-web/View/View/js/jquery.scrollUp.min.js"></script>
	<script src="/source-code-web/View/View/js/bootstrap.min.js"></script>
	<script src="/source-code-web/View/View/js/jquery.prettyPhoto.js"></script>
	<script src="/source-code-web/View/View/js/main.js"></script>
</body>

</html>