<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mes Locations | Xpress</title>
	<!-- Font Awesome -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	  rel="stylesheet"
	/>
	<!-- MDB -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
	  rel="stylesheet"
	/>
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/navbar.css' ?>">
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/mesLocations.css' ?>">
</head>
<body>
	<?php require_once 'includes/Navbar.php' ?>
	<div class="container mt-3"><?php flash('youCantHireManyCars') ?></div>
	<main class="container mt-3"></main>

	<!-- MDB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

	<!-- Jquery -->
  	<script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>

  	<!-- Custom JS -->
	<script src="<?= URLROOT.'/public/js/location/mesLocations.js' ?>"></script>
</body>
</html>