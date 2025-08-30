<!-- Sidebar Desktop -->
<div class="sidebar sidebar-desktop p-3">
  <div class="text-center mb-4">
    <img src="assets/imagens/logo.png" alt="logo" class="img-fluid logo-prefeitura mb-2" />
    <h6 class="mb-0">Prefeitura Municipal de Nova Russas</h6>
    <small>Espaço + Emprego</small>
  </div>

  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="#" class="nav-link active">
        <i class="fas fa-chart-line me-2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item mt-2">
      <a href="#" class="nav-link">
        <i class="fas fa-building me-2"></i> Cadastrar Empresa
      </a>
    </li>
    <li class="nav-item mt-2">
      <a href="#" class="nav-link" data-page="pessoas.php">
        <i class="fas fa-users me-2"></i> Pessoas
      </a>
    </li>
  </ul>

  <hr class="text-white" />
  <div class="mt-auto">
    <span class="text-white-50">Usuário: <strong>admin@prefeitura.gov.br</strong></span><br />
    <a href="logout.php" class="btn btn-outline-light btn-sm mt-2">
      <i class="fas fa-sign-out-alt me-1"></i> Sair
    </a>
  </div>
</div>

<!-- Sidebar Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
  </div>
  <div class="offcanvas-body p-3">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link">
          <i class="fas fa-chart-line me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mt-2">
        <a href="cadastrar-empresa.php" class="nav-link" >
          <i class="fas fa-building me-2"></i> Cadastrar Empresa
        </a>
      </li>
      <li class="nav-item mt-2">
        <a href="#" class="nav-link" data-page="pessoas.php">
          <i class="fas fa-users me-2"></i> Pessoas
        </a>
      </li>
    </ul>

    <hr class="text-white" />
    <div class="mt-auto">
      <span class="text-white-50">Usuário: <strong>admin@prefeitura.gov.br</strong></span><br />
      <a href="logout.php" class="btn btn-outline-light btn-sm mt-2">
        <i class="fas fa-sign-out-alt me-1"></i> Sair
      </a>
    </div>
  </div>
</div>