<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register | Xpress</title>
	<!-- Google Fonts -->
	<link
	  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
	  rel="stylesheet"
	/>
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
	<link rel="stylesheet" href="<?= URLROOT.'/public/css/loginAndRegister/style.css' ?>">
</head>
<body>
  <div class="preloader">
    <div class="loader"></div>
  </div>
		<section class="h-100">
  <div class="container-fluid h-100">
    <div class="row gap-3 justify-content-center align-items-center h-100 mb-4 mb-lg-0">
      <div class="col-lg-5 col-xl-5">
        <img src="<?= URLROOT.'/public/images/register/register.svg' ?>"
          class="img-fluid d-none d-lg-inline-block" alt="register image">
           <div class="text-center">
          <a href="<?= URLROOT ?>"><img class="w-50" src="<?= URLROOT.'/public/images/index/logo.png' ?>" alt="site logo"></a>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-xl-4 offset-xl-1">
       
        <h2 class="mb-4">Créez un compte</h2>
        <form id="register" method="POST" action="<?= URLROOT.'/register/create' ?>">
          <!-- Nom et Prénom input -->
          <div class="d-flex gap-3 mb-4">
              <!-- Nom input -->
              <div class="form-outline form-white nom">
                
              <input type="text" id="nom" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre nom" name="nom" />
              <label class="form-label" for="nom">Nom</label>
              <div class="form-helper text-danger nom-erreur"></div>
              
              </div>

              <!-- Prénom input -->
              <div class="form-outline form-white prenom">
                <input type="text" id="prenom" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre prénom" name="prenom" />
               <label class="form-label" for="prenom">Prénom</label>
               <div class="form-helper text-danger prenom-erreur"></div>
               </div>
          </div>
          

          <!-- CIN input -->
          <div class="form-outline form-white mb-4 cin">
            <input type="text" id="cin" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre CIN" name="cin" />
            <label class="form-label" for="cin">Carte d'identité nationale</label>
            <div class="form-helper text-danger cin-erreur"></div>
          </div>

          <!-- Telephone input -->
          <div class="form-outline form-white mb-4 telephone">
            <input type="text" id="telephone" class="form-control form-control-lg"
              placeholder="+212 XXXXXXXXX" name="telephone" />
            <label class="form-label" for="telephone">Numéro de téléphone</label>
            <div class="form-helper text-danger telephone-erreur"></div>
          </div>

          <!-- Ville et Province input -->
          <div class="d-flex gap-3 mb-4">
              <!-- Ville input -->
              <div class="form-outline form-white ville">
              <input type="text" id="ville" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre ville" name="ville" />
              <label class="form-label" for="ville">Ville</label>
              <div class="form-helper text-danger ville-erreur"></div>
              </div>

              <!-- Province input -->
              <div class="form-outline form-white province">
                <input type="text" id="province" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre province" name="province" />
               <label class="form-label" for="province">Province</label>
               <div class="form-helper text-danger province-erreur"></div>
               </div>
          </div>

          <!-- Rue et Zipcode input -->
          <div class="d-flex gap-3 mb-4">
            <!-- Rue input -->
            <div class="form-outline form-white rue">
              <input type="text" id="rue" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre rue" name="rue" />
              <label class="form-label" for="rue">Rue</label>
              <div class="form-helper text-danger rue-erreur"></div>
            </div>

            <!-- Zipcode input -->
            <div class="form-outline form-white code-postal">
              <input type="number" id="code-postal" class="form-control form-control-lg"
                placeholder="Veuillez entrer votre code postal" name="code_postal" />
              <label class="form-label" for="code-postal">Code Postal</label>
              <div class="form-helper text-danger code-postal-erreur"></div>
            </div>
          </div>
          
          
           <!-- Email input -->
          <div class="form-outline form-white mb-4 email">
            <input type="email" id="email" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre adresse email" name="email" />
            <label class="form-label" for="email">Email</label>
            <div class="form-helper text-danger email-erreur"></div>
          </div>

          <!-- Password input -->
          <div class="form-outline form-white mb-4 mdp1">
            <input type="password" id="mdp1" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre mot de passe" name="mdp1" />
            <label class="form-label" for="mdp1">Mot de passe</label>
            <div class="form-helper text-danger mdp1-erreur text-center"></div>
          </div>

          <!-- Confirm Password input -->
          <div class="form-outline form-white mb-4 mdp2">
            <input type="password" id="mdp2" class="form-control form-control-lg"
              placeholder="Veuillez confirmer votre mot de passe" name="mdp2" />
            <label class="form-label" for="mdp2">Confirmation du Mot de passe</label>
          </div>

          <div class="text-center d-md-flex justify-content-between align-items-center pt-2">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <p class="small fw-bold mb-0 mt-3 mt-md-0">Avez vous déjà un compte? <a href="<?= URLROOT.'/login' ?>"
                class="link-danger">se connecter</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>




	<!-- MDB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
  <!-- Jquery -->
  <script src="<?= URLROOT.'/public/js/jQuery/jquery-3.6.0.min.js' ?>"></script>
  <!-- Custom JS -->
  <script src="<?= URLROOT.'/public/js/loginAndRegister/register.js' ?>"></script>

    <script>
    $(window).on('load', function () {
      $('.preloader').fadeOut('slow');
    });
  </script>
</body>
</html>

