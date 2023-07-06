<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php?vista=home">
      <img src="./img/cpu.png" width="50" height="50">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">

        <div class="navbar-item has-dropdown is-hoverable">
          
          <a class="navbar-link">Usuarios</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="index.php?vista=user_list">Usuarios</a>
            <a class="navbar-item" href="index.php?vista=user_new">Nuevo Usuario</a>
            <a class="navbar-item" href="index.php?vista=user_search">Buscar</a>
          </div>

        </div>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Equipos</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="index.php?vista=computer_list.php">Equipos de Computo</a>  
            <a class="navbar-item" href="index.php?vista=computer_new">Registrar Equipo</a>
            <a class="navbar-item" href="index.php?vista=computer_search">Buscar Equipo</a>              
          </div>
        </div>
      </div>
    <div class="navbar-end">
    
    <div class="navbar-item">
        <div class="buttons">
          <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']?>" class="button is-primary is-rounded">
            Mi Cuenta
          </a>
          <a href="index.php?vista=logout" class="button is-danger is-rounded">
            Salir
          </a>
        </div>
      </div>
    </div>

  </div>
</nav>