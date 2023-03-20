<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Recherche | Xpress</title>

	<!-- Bootsrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<!-- MDB -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
	  rel="stylesheet"
	/>

  <!-- Jquery UI Theme -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Font Awesome -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	  rel="stylesheet"
	/>

	<!-- custom CSS -->
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/searchCar.css' ?>">
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/navbar.css' ?>">

</head>
<body>
	<?php require_once 'includes/Navbar.php' ?>
    <div class="preloader">
    <div class="loader"></div>
  </div>
	<main class="wrapper h-100 mt-3">
  <div class="container">
    <div class="row">
      <div class="col">
      	<form class="d-flex flex-column flex-lg-row gap-5" id="location">
          <div>
          	<label class="form-label d-block text-white mb-0" for="agences"><i class="fa-solid fa-1">.</i> Choisissez votre agence de location</label>
            <small class="text-center text-danger d-inline-block agence-depart-error"></small>
             <div class="input-group">
                  <span class="input-group-text bg-white"><i class="fa-solid fa-house"></i></span>
                  <select class="form-select mb-3" name="agence_depart" id="agence-depart" aria-label="Default select example">
        <option disabled selected>---- Agence de départ ----</option>
        <?php foreach ($agences as $agence) : ?>
          <option value="<?= $agence->id ?>"><?= $agence->nom ?> - <?= $agence->rue ?></option>
        <?php endforeach ?>
      </select>
              </div>
      <small class="text-center text-danger d-inline-block agence-retour-error"></small>
          	<div class="input-group">
                  <span class="input-group-text bg-white"><i class="fa-solid fa-house"></i></span>
                  <select class="form-select" name="agence_retour" id="agence-retour" aria-label="Default select example">
        <option disabled selected>---- Agence de retour ----</option>
        <?php foreach ($agences as $agence) : ?>
          <option value="<?= $agence->id ?>"><?= $agence->nom ?> - <?= $agence->rue ?></option>
        <?php endforeach ?>
      </select>
            </div>
			
          </div>
          <div class="flex-fill">
           	<label class="form-label d-block text-white mb-0" for="periode"><i class="fa-solid fa-2">.</i> Période de location</label>
            <small class="text-danger d-inline-block date-depart-error heure-depart-error"></small>
           	<div class="d-flex align-items-center gap-3 mb-3">
           		<span>Du</span>
           		<!-- <input  type="text" class="form-control"> -->
              <div class="input-group">
                <span class="input-group-text bg-white" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Jour départ"
                  name="date_depart" 
                  id="date-depart"
                />
              </div>
              <div class="input-group">
                  <span class="input-group-text bg-white"><i class="fa-solid fa-clock"></i></span>
                  <select name="heure_depart" id="heure-depart" class="form-select">
                <option value="07:00">07:00</option>
                <option value="07:30">07:30</option>
                <option value="08:00">08:00</option>
                <option value="08:30" selected>08:30</option>
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
                <option value="20:30">20:30</option>
                <option value="21:00">21:00</option>
                <option value="21:30">21:30</option>
                <option value="22:00">22:00</option>
                <option value="22:30">22:30</option>
                <option value="23:00">23:00</option>
              </select>
              </div>
           		
           	</div>
           	
            <small class="text-center text-danger d-inline-block date-retour-error heure-retour-error"></small>
           	<div class="d-flex gap-3 align-items-center">
           		<span>Au</span>
              <div class="input-group">
                <span class="input-group-text bg-white" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Jour retour"
                  name="date_retour" 
                  id="date-retour"
                />
              </div>
              <div class="input-group">
                <span class="input-group-text bg-white"><i class="fa-solid fa-clock"></i></span>
                <select name="heure_retour" id="heure-retour" class="form-select">
                <option value="07:00">07:00</option>
                <option value="07:30">07:30</option>
                <option value="08:00">08:00</option>
                <option value="08:30" selected>08:30</option>
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
                <option value="20:30">20:30</option>
                <option value="21:00">21:00</option>
                <option value="21:30">21:30</option>
                <option value="22:00">22:00</option>
                <option value="22:30">22:30</option>
                <option value="23:00">23:00</option>
              </select>
              </div>
           		
           	</div>
          </div>
          	<div class="align-self-center">
	            <button type="submit" class="btn btn-light">RECHERCHE</button>
          	</div>

        </form>
      </div>
    </div>
    <hr />
    <div class="row mb-3 categories d-none">
    	<div class="col">
    		<div class="d-flex flex-column flex-lg-row">
    			<input type="radio" class="btn-check" name="categories" value="" id="all-categorie" checked />
    				<label class="btn btn-light rounded-0 flex-fill" for="all-categorie">Toutes Categories</label>
    			<?php foreach ($categories as $categorie) : ?>
    				<input type="radio" value="<?= $categorie->id ?>" class="btn-check" name="categories" id="categorie-<?= $categorie->id ?>" />
    				<label class="btn btn-light rounded-0" for="categorie-<?= $categorie->id ?>"><?= $categorie->categorie ?></label>
    			<?php endforeach ?>
    		</div>
    	</div>
    </div>
    <section id="cars" class="cars d-flex flex-column gap-3"></section>
  </div>
</main>
<?php require_once 'includes/footer.php' ?>
  <!-- MDB -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
  
   <!-- Jquery -->
  <script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>

  <!-- Jquery UI -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Custom JS -->
  <script src="<?= URLROOT.'/public/js/location/location.js' ?>"></script>

  <script>
    $(window).on('load', function () {
      $('.preloader').fadeOut('slow');
    });
  </script>
</body>
</html>