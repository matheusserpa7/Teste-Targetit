
<div class="sidebar" data-color="purple" data-background-color="white" data-image="{!!asset('materialize/assets/img/sidebar-1.jpg')!!}">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
  <div class="logo">
    <a  class="simple-text logo-normal">
      Painel Admin
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php echo$op1?>">
        <a class="nav-link" href="usuario">
          <i class="material-icons">person</i>
          <p>Cadastrar Usuarios</p>
        </a>
      </li>
      <li class="nav-item <?php echo$op2?>">
        <a class="nav-link" href="setor">
          <i class="material-icons">dashboard</i>
          <p>Cadastrar Setores</p>
        </a>
      </li>
      <li class="nav-item <?php echo$op3?>">
        <a class="nav-link" href="salas">
          <i class="material-icons">content_paste</i>
          <p>Cadastrar Salas</p>
        </a>
      </li>

    </ul>
  </div>
</div>
<div class="main-panel">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="">Sistema Agendamento</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
    </div>
  </nav>
