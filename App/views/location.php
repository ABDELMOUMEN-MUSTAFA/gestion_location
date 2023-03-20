<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/navbar.css' ?>">
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/location.css' ?>">
	<title>Location | Xpress</title>
</head>
<body>
	<?php require_once 'includes/Navbar.php' ?>
	<main class="container-fluid mt-3">
		<div class="row">
			<div class="col-12 col-md-4 mb-3">
				<div class="card">
			 		<div class="card-header">Location informations</div>
			  		<div class="card-body p-3">
			    		<div class="card-text">
			    			<p class="fw-bold mb-0">Agence de départ </p>
			    			<hr class="mt-0" />
			    			<span class="d-block"><i class="fa-solid fa-car me-2"></i> <?= $voiture_info->agence_depart->nom ?></span>
			    			<span class="d-block"><i class="fa-solid fa-location-dot me-2"></i> <?= $voiture_info->agence_depart->rue ?>, <?= $voiture_info->agence_depart->ville ?></span>
			    			<span class="d-block"><i class="fa-solid fa-phone me-2"></i> <?= $voiture_info->agence_depart->telephone ?></span>
			    		</div>
			    		<div class="card-text mb-3">
			    			<div>
			    				<i class="fa-solid fa-calendar-days me-2"></i><span class="date-depart me-3"><?= $date_depart ?></span> 
			    				<i class="fa-solid fa-clock me-2"></i><span class="heure-depart"><?= $_SESSION['location_details']['heure_depart'] ?></span>
			    			</div>		
			    		</div>
			    		<div class="card-text">
			    			<p class="fw-bold mb-0">Agence de retour</p>
			    			<hr class="mt-0" />
			    			<span class="d-block"><i class="fa-solid fa-car me-2"></i> <?= $voiture_info->agence_retour->nom ?></span>
			    			<span class="d-block"><i class="fa-solid fa-location-dot me-2"></i> <?= $voiture_info->agence_retour->rue ?>, <?= $voiture_info->agence_retour->ville ?></span>
			    			<span class="d-block"><i class="fa-solid fa-phone me-2"></i> <?= $voiture_info->agence_retour->telephone ?></span>
			    		</div>
			    		<div class="card-text">
			    			<div>
			    				<i class="fa-solid fa-calendar-days me-2"></i><span class="date-retour me-3"> <?= $date_retour ?></span>
			    				<i class="fa-solid fa-clock me-2"></i><span class="heure-retour"><?= $_SESSION['location_details']['heure_retour'] ?></span>
			    			</div>
			    		</div>
			  		</div>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<div class="card">
			  		<div class="card-body d-flex flex-column flex-xl-row">
			  			<div class="d-flex flex-column align-items-center mb-3">
			  				<img class="car-image" src="<?= $voiture_info->photo  ?>" alt="voiture image" />
			  				<div data-mdb-toggle="tooltip" title="<?= $voiture_info->marque ?>">
			    				<img class="car-logo" src="<?= $voiture_info->logo  ?>" alt="voiture logo" />
			  				</div>
			  			</div>
			  			<div class="text-center flex-fill">
			  				<h4 class="card-title"><?= $voiture_info->titre ?></h4>
			  				<h5 class="text-muted"><?= $voiture_info->sous_titre ?></h5>
			  				<div class="d-flex flex-column flex-lg-row align-items-center gap-3 mb-3 justify-content-center">
			  					<div class="d-flex gap-3"><span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Nombre de Passagers"><i class="fa fa-users"></i> <span><?= $voiture_info->nombre_passagers ?></span></span>
					        	<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Nombre de Portes"><i class="fa fa-car"></i> <span><?= $voiture_info->nombre_portes ?></span></span>
					        	<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Nombre de Valises"><i class="fa fa-suitcase"></i> <span><?= $voiture_info->nombre_valises ?></span></span>
					        	<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Boite de Vitesse <?= $voiture_info->boite_vitesses ?>"><i class="fa fa-map-pin"></i> <span><?= strtoupper($voiture_info->boite_vitesses[0]) ?></span></span></div>
			  					<div class="d-flex gap-3">
			  						<?php if($voiture_info->climatisation == true) : ?>
					        		<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Climatisation"><i class="fa far fa-snowflake"> </i><span>A/C</span></span>
					        	<?php endif ?>
					        	<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="Carburant"><i class="fa-solid fa-gas-pump"></i><span><?= $voiture_info->type_carburant ?></span></span>
				            	<?php if($voiture_info->gps_integre == true) : ?>
				            		<span data-mdb-toggle="tooltip" class="d-flex gap-2 badge badge-danger align-items-center" title="GPS Intégré"><i class="fa-solid fa-location-dot"></i><span>GPS</span></span>
				            	<?php endif ?>
			  					</div>
					        	
					        	
					       	</div>
					       	<ul class="list-unstyled">
					        	<li>Âge minimum : 21 ans</li>
					        	<li>Année de permis minimum : <?= $voiture_info->annee_permis_min ?> ans</li>
					        	<li>Franchise accident : <?= $voiture_info->franchise_accedent ?> DH</li>
					        	<li>Franchise vol : <?= $voiture_info->franchise_vol ?> DH</li>
					        	<li>Caution : <?= $voiture_info->caution ?> DH</li>
					        </ul>
			  			</div>
			  		</div>
			  		<div class="container mb-3">
			  			<table class="table border text-white">
			  				<tbody>
			  					<tr>
			  						<td>Location <?= $voiture_info->agence_depart->nom ?></td>
			  						<td class="text-center"><?= $_SESSION['location_details']['total_jour_location'] ?> Jours x <?= $voiture_info->prix_jour ?> DH = <?= $_SESSION['location_details']['total_jour_location'] * $voiture_info->prix_jour ?> DH</td>
			  					</tr>
			  					<tr>
			  						<td>Total de la Location</td>
			  						<td class='fw-bolder text-center' style="color: #c9e77a;"><?= $_SESSION['location_details']['total_jour_location'] * $voiture_info->prix_jour ?> DH</td>
			  					</tr>
			  				</tbody>
			  			</table>
			  			<form method="POST" action="<?= URLROOT.'/location/create' ?>">
			  				<button type="submit" style="background-color: #c9e77a;" class="btn btn-block">Louer Maintenant</button>
			  			</form>
			  		</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Preloader -->
	<div class="preloader">
		<div class="loader"></div>
	</div>

	<!-- MDB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
	
	<!-- Jquery -->
    <script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>

	<script>
		$(window).on('load', function () {
			$('.preloader').fadeOut('slow');
		});
	</script>
</body>
</html>