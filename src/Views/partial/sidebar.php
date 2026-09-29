<?php $baseUrl = defined('BASE_URL') ? BASE_URL : ''; ?>
<!-- Sidebar Desktop -->
<div class="sidebar sidebar-desktop p-3">
  <div class="text-center mb-4">
    <a href="<?= $baseUrl ?: '/' ?>" class="text-decoration-none">
      <img src="<?= $baseUrl ?>/assets/imagens/logo.png" alt="Logo Portal de Carreiras" class="img-fluid logo-portal mb-2" />
      <h6 class="mb-0 text-white">Portal de Carreiras</h6>
      <small class="text-white-50">Envio de Currículos &amp; Vagas</small>
    </a>
  </div>

  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="<?= $baseUrl ?: '/' ?>" class="nav-link active">
        <i class="fas fa-chart-line me-2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item mt-2">
      <a href="<?= $baseUrl ?>/company/form" class="nav-link">
        <i class="fas fa-building me-2"></i> Cadastrar Empresa
      </a>
    </li>
  </ul>

  <hr class="text-white" />
  <div class="mt-auto">
    <span class="text-white-50">Usuário: <strong>admin@empresas.com</strong></span><br />
    <a href="<?= $baseUrl ?: '/' ?>" class="btn btn-outline-light btn-sm mt-2">
      <i class="fas fa-sign-out-alt me-1"></i> Sair
    </a>
  </div>
</div>

<!-- Sidebar Mobile (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title text-white" id="offcanvasSidebarLabel">Portal de Carreiras</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
  </div>
  <div class="offcanvas-body p-3">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="<?= $baseUrl ?: '/' ?>" class="nav-link active">
          <i class="fas fa-chart-line me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mt-2">
        <a href="<?= $baseUrl ?>/company/form" class="nav-link">
          <i class="fas fa-building me-2"></i> Cadastrar Empresa
        </a>
      </li>
    </ul>

    <hr class="text-white" />
    <div class="mt-auto">
      <span class="text-white-50">Usuário: <strong>admin@empresas.com</strong></span><br />
      <a href="<?= $baseUrl ?: '/' ?>" class="btn btn-outline-light btn-sm mt-2">
        <i class="fas fa-sign-out-alt me-1"></i> Sair
      </a>
    </div>
  </div>
</div>