<!-- Navbar -->
<nav class="navbar navbar-expand-lg text-center sticky-top">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="<?= URLROOT ?>">
      <img class="logo" src="<?= URLROOT.'/public/images/index/logo.png' ?>" alt="site logo">
    </a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler text-white"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>



    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav m-auto gap-4 my-3 my-lg-0">
        <li class="nav-item">
          <a class="nav-link rounded-pill" href="<?= URLROOT.'/car/recherche' ?>">TARIFS ET LOCATIONS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill" href="#">NOS VEHICULES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill" href="#">NOS AGENCES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill" href="#">NOUS CONTACTER</a>
        </li>
      </ul>

      <!-- Left links -->
      <?php if(!isset($_SESSION['client'])) : ?>
        <ul class="navbar-nav gap-4">
          <li class="nav-item"><a class="nav-link rounded-pill" href="<?= URLROOT.'/login' ?>">Se connecter</a></li>
          <li class="nav-item"><a class="nav-link rounded-pill" href="<?= URLROOT.'/register' ?>"> S'inscrire</a></li>
        </ul>
      <?php endif ?>
      <?php if(isset($_SESSION['client'])) : ?>  
      <div class="d-flex align-items-center justify-content-center">   
          <div class="dropdown">
            <a
              class="dropdown-toggle d-flex align-items-center hidden-arrow rounded-circle p-1"
              href="#"
              id="navbarDropdownMenuAvatar"
              role="button"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
              style="background-color: #c9e77a;"
            >
              <img
                src="<?= URLROOT.'/public/images/login/avatar-user.png' ?>"
                height="25"
                alt="avatar user"
              />
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuAvatar"
            >
              <li>
                <a class="dropdown-item" href="<?= URLROOT.'/location/mesLocations' ?>">Mes Locations</a>
              </li>
              <li>
                <a class="dropdown-item" href="<?= URLROOT.'/client/profil' ?>">Mon Profil</a>
              </li>
              <li>
                <a class="dropdown-item bg-danger" href="<?= URLROOT.'/logout' ?>">Se déconnecter</a>
              </li>
              </ul>
            </div>
          </div>
          </div>
      <!-- Collapsible wrapper -->
      <?php endif; ?>
    </div>
  <!-- Container wrapper -->
  </div>
</nav>
<!-- Navbar -->
