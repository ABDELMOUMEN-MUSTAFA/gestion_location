<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil | Xpress</title>
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
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/navbar.css' ?>">
</head>
<body>
	<?php require_once 'includes/Navbar.php' ?>
	<main class="container mt-5">
		<?php flash('editSuccess') ?>
		<form id="edit-profil" method="POST" action="<?= URLROOT.'/client/profil' ?>">
          <!-- Nom et Prénom input -->
          <div class="d-flex gap-3 mb-4">
              <!-- Nom input -->
              <div class="form-outline form-white nom">
                
              <input type="text" id="nom" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre nom" name="nom" value="<?= $client->nom ?>" />
              <label class="form-label" for="nom">Nom</label>
              <div class="form-helper text-danger nom-erreur"></div>
              
              </div>

              <!-- Prénom input -->
              <div class="form-outline form-white prenom">
                <input type="text" id="prenom" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre prénom" name="prenom" value="<?= $client->prenom ?>" />
               <label class="form-label" for="prenom">Prénom</label>
               <div class="form-helper text-danger prenom-erreur"></div>
               </div>
          </div>
          

          <!-- CIN input -->
          <div class="form-outline form-white mb-4 cin">
            <input type="text" id="cin" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre CIN" name="cin" value="<?= $client->cin ?>" />
            <label class="form-label" for="cin">Carte d'identité nationale</label>
            <div class="form-helper text-danger cin-erreur"></div>
          </div>

          <!-- Telephone input -->
          <div class="form-outline form-white mb-4 telephone">
            <input type="text" id="telephone" class="form-control form-control-lg"
              placeholder="+212 XXXXXXXXX" name="telephone" value="<?= $client->telephone ?>" />
            <label class="form-label" for="telephone">Numéro de téléphone</label>
            <div class="form-helper text-danger telephone-erreur"></div>
          </div>

          <!-- Ville et Province input -->
          <div class="d-flex gap-3 mb-4">
              <!-- Ville input -->
              <div class="form-outline form-white ville">
              <input type="text" id="ville" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre ville" name="ville" value="<?= $client->ville ?>" />
              <label class="form-label" for="ville">Ville</label>
              <div class="form-helper text-danger ville-erreur"></div>
              </div>

              <!-- Province input -->
              <div class="form-outline form-white province">
                <input type="text" id="province" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre province" name="province" value="<?= $client->province ?>" />
               <label class="form-label" for="province">Province</label>
               <div class="form-helper text-danger province-erreur"></div>
               </div>
          </div>

          <!-- Rue et Zipcode input -->
          <div class="d-flex gap-3 mb-4">
            <!-- Rue input -->
            <div class="form-outline form-white rue">
              <input type="text" id="rue" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre rue" name="rue" value="<?= $client->rue ?>" />
              <label class="form-label" for="rue">Rue</label>
              <div class="form-helper text-danger rue-erreur"></div>
            </div>

            <!-- Zipcode input -->
            <div class="form-outline form-white code-postal">
              <input type="number" id="code-postal" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre code postal" name="code_postal" value="<?= $client->code_postal ?>" />
              <label class="form-label" for="code-postal">Code Postal</label>
              <div class="form-helper text-danger code-postal-erreur"></div>
            </div>
          </div>
          
          
           <!-- Email input -->
          <div class="form-outline form-white mb-4 email">
            <input type="email" id="email" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre adresse email" name="email" value="<?= $client->email ?>" />
            <label class="form-label" for="email">Email</label>
            <div class="form-helper text-danger email-erreur"></div>
          </div>

           <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
	</main>

	<!-- Preloader -->
    <div class="preloader">
		<div class="loader"></div>
	</div>

	<!-- MDB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

	<!-- Jquery -->
  	<script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>

	<!-- Custom JS -->
	<script src="<?= URLROOT.'/public/js/profil.js' ?>"></script>  	

	
	<script>
		$(window).on('load', function () {
			$('.preloader').fadeOut('slow');
		});
	</script>
</body>
</html>