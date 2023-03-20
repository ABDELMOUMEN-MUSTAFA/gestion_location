<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Xpress</title>
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
		<section>
  <div class="container-fluid">
    <div class="row gap-3 justify-content-center align-items-center mb-4 mb-lg-0">
      <div class="d-none d-lg-block col-lg-5 col-xl-5">
        <img src="<?= URLROOT.'/public/images/login/login.svg' ?>"
          class="img-fluid" alt="login image">
      </div>
      <div class="col-12 col-lg-6 col-xl-4 offset-xl-1">
        <div class="text-center">
          <a href="<?= URLROOT ?>"><img class="w-50" src="<?= URLROOT.'/public/images/index/logo.png' ?>" alt="site logo"></a>
        </div>
        <h2 class="mb-4 text-nowrap">Bienvenue, notre chauffeur !</h2>
        <?php flash('loginSuccess') ?>
        <?php flash('loginFailed') ?>
        <?php flash('mustLogin') ?>
        <form id="login" method="POST" action="<?= URLROOT.'/login/access' ?>">
          <!-- Email input -->
          <div class="form-outline form-white mb-4 email">
            <input name="email" value="<?= old('email') ?>" type="email" id="email" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre adresse email" />
            <label class="form-label" for="email">Email</label>
            <div class="form-helper text-danger email-erreur"></div>
          </div>

          <!-- Password input -->
          <div class="form-outline form-white mb-3 mdp">
            <input name="mdp" value="<?= old('mdp') ?>" type="password" id="mdp" class="form-control form-control-lg"
              placeholder="Veuillez entrer votre mot de passe" />
            <label class="form-label" for="mdp">Mot de passe</label>
            <div class="form-helper text-danger mdp-erreur"></div>
          </div>

          <div class="text-center d-md-flex justify-content-between align-items-center mt-4 pt-2">
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <p class="small fw-bold mb-0 mt-3 mt-md-0">Vous n'avez pas de compte? <a href="<?= URLROOT.'/register' ?>"
                class="link-danger">s'inscrire</a></p>
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
  <script src="<?= URLROOT.'/public/js/loginAndRegister/login.js' ?>"></script>

    <script>
    $(window).on('load', function () {
      $('.preloader').fadeOut('slow');
    });
  </script>
</body>
</html>

