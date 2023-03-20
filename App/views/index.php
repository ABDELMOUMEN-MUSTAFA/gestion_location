<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xpress</title>
	<link rel="icon" type="image/x-icon" href="<?= URLROOT.'/public/images/index/favicon.ico' ?>">
	<!-- Bootsrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<!-- MDB -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
	  rel="stylesheet"
	/>
	<!-- Font Awesome -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	  rel="stylesheet"
	/>

	<!-- custom CSS -->
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/index.css' ?>">
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/navbar.css' ?>">
	<style>
		section:nth-child(1){
			animation-name: fadeInSlowly_1;
			animation-duration: 2s;
			animation-iteration-count: 1;
		}

		section:nth-child(2){
			animation-name: fadeInSlowly_2;
			animation-duration: 2s;
			animation-iteration-count: 1;
		}

		@keyframes fadeInSlowly_1 {
			0% {
				transform: translateX(-100%);
				opacity: 0;
			}
			100% {
				transform: translateX(0);
				opacity: 1;
			}
		}

		@keyframes fadeInSlowly_2 {
			0% {
				transform: translateX(100%);
				opacity: 0;
			}
			100% {
				transform: translateX(0);
				opacity: 1;
			}
		}

		nav {
			transition: background-color 0.3s;
		}
	</style>
</head>
<body>
	<header>
		<?php require_once 'includes/Navbar.php' ?>
			<div class="container d-flex align-items-center justify-content-center">
			<section class="flex-fill text-center text-lg-start">
				<h1>Drive away with convenience and affordability</h1>
				<h3 class="mb-5">Choose <strong class="text-danger">Xpress</strong> Rent a Car</h3>
				<div class="wrap">
	  				<a href="<?= URLROOT.'/car/recherche' ?>" class="btn-louer text-center d-inline-block">Louer Maintenant</a>
				</div>
			</section>
			<section class="d-none d-lg-block">
				<img  src="<?= URLROOT.'/public/images/index/rent-car.png' ?>" alt="landing page rent car" class="image-fluid rent-car-keys opacity-75">
			</section>
		</div>
	</header>


	<!-- Preloader -->
    <div class="preloader">
		<div class="loader"></div>
	</div>
	<!-- MDB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


	<!-- Jquery UI -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Jquery -->
    <script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>

	<script>
		$(window).on('load', function () {
			$('.preloader').fadeOut('slow');
		});

		const $nav = $('nav');

		$(window).on('scroll', function () {
			if($(this).scrollTop() > 100){
				$nav.addClass('bg-dark');
			}else{
				$nav.removeClass('bg-dark');
			}
		});
	</script>
</body>
</html>