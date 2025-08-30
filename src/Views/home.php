<!-- Main content -->
<div class="main-content">
    <div class="topbar">
        <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h5 class="m-0">Programa Espaço + Emprego</h5>
        <span class="text-muted small d-none d-sm-inline">Município de Nova Russas - Sistema Oficial</span>
    </div>

    <div id="conteudo" class="p-4">
        <!-- Conteúdo carregado via AJAX será exibido aqui -->
        <h5 class="mb-4">Painel Administrativo</h5>

        <!-- Resumo -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="card-title">Empresas Cadastradas</h6>
                        <h2 class="text-success">120</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="card-title">Empresas Excluídas</h6>
                        <h2 class="text-danger">15</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="card-title">Em Negociação</h6>
                        <h2 class="text-warning">30</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Buscar por nome ou CNPJ</label>
                        <input type="text" class="form-control" placeholder="Nome ou CNPJ" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Inicial</label>
                        <input type="date" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Final</label>
                        <input type="date" class="form-control" />
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100" type="submit">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Empresas Recentes -->
        <h5 class="mb-3">Empresas Recentemente Cadastradas</h5>

        <div class="row g-4">
            <?php foreach($companies as $company): ?>
                <div class="col-md-4">
                    <div class="empresa-card shadow p-4 rounded-3">
                        <h6><?= htmlspecialchars($company->name); ?></h6>
                        <div class="empresa-info">
                            <p><strong>CNPJ:</strong> <?= htmlspecialchars($company->cnpj); ?></p>
                            <p><strong>Contato:</strong> <?= htmlspecialchars($company->phone); ?></p>
                            <p><strong>Endereço:</strong> <?= htmlspecialchars($company->address); ?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="empresa-data">Cadastrada em: <?= date('d/m/Y', strtotime($company->created_at)); ?></small>
                            <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary" title="Ver"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>