<div class="main-content">
  <div class="topbar">
    <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
      <i class="fas fa-bars"></i>
    </button>
    <h5 class="m-0">Programa Espaço + Emprego</h5>
    <span class="text-muted small d-none d-sm-inline">Município de Nova Russas - Sistema Oficial</span>
  </div>

  <div id="conteudo" class="p-4">
    <h5 class="mb-4">Detalhes da Empresa</h5>

    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h4 class="mb-4 text-black">
          <i class="text-primary fas fa-building me-2"></i><?= htmlspecialchars($company->name); ?>
          <span
  style="
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: #f0f0f0;
    font-weight: 600;
    font-size: 1.1rem;
    padding: 0.3rem 1rem;
    border-radius: 9999px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    user-select: none;
    white-space: nowrap;
  "
>
  <i class="fas fa-briefcase" style="font-size: 1.4rem; color: #ffffffff;"></i>
  <?= $vacancies; ?> <?= $vacancies === 1 ? 'vaga' : 'vagas'; ?>
</span>
        </h4>

        <div class="table-responsive">
          <table class="table table-bordered align-middle" style="border-radius: 8px; overflow: hidden;">
            <tbody>
              <tr>
                <th class="bg-light" style="width: 180px;">
                  <i class="fas fa-id-card me-1 text-secondary"></i> CNPJ
                </th>
                <td><?= htmlspecialchars($company->cnpj); ?></td>
                <th class="bg-light" style="width: 180px;">
                  <i class="fas fa-envelope me-1 text-secondary"></i> Email
                </th>
                <td><?= htmlspecialchars($company->email); ?></td>
              </tr>

              <tr>
                <th class="bg-light">
                  <i class="fas fa-user-tie me-1 text-secondary"></i> Nome Responsável
                </th>
                <td><?= htmlspecialchars($company->responsible); ?></td>
                <th class="bg-light">
                  <i class="fas fa-mail-bulk me-1 text-secondary"></i> CEP
                </th>
                <td><?= htmlspecialchars($company->cep); ?></td>
              </tr>

              <tr>
                <th class="bg-light">
                  <i class="fas fa-phone me-1 text-secondary"></i> Telefone
                </th>
                <td><?= htmlspecialchars($company->phone); ?></td>
                <th class="bg-light">
                  <i class="fas fa-city me-1 text-secondary"></i> Cidade
                </th>
                <td><?= htmlspecialchars($company->city); ?></td>
              </tr>

              <tr>
                <th class="bg-light">
                  <i class="fas fa-map-marker-alt me-1 text-secondary"></i> Endereço
                </th>
                <td colspan="3"><?= htmlspecialchars($company->address); ?></td>
              </tr>

              <tr>
                <th class="bg-light">
                  <i class="fas fa-info-circle me-1 text-secondary"></i> Status
                </th>
                <td><?= htmlspecialchars($company->status); ?></td>
                <th class="bg-light">
                  <i class="fas fa-calendar-alt me-1 text-secondary"></i> Cadastrada em
                </th>
                <td><?= date('d/m/Y', strtotime($company->created_at)); ?></td>
              </tr>

              <tr>
                <th class="bg-light" style="vertical-align: top;">
                  <i class="fas fa-align-left me-1 text-secondary"></i> Sobre a Empresa
                </th>
                <td colspan="3" style="white-space: pre-wrap;"><?= htmlspecialchars($company->description); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <div class="mb-4">
      <a href="#" class="btn btn-success me-2">Ver/Enviar Currículos</a>
      <a href="#" class="btn btn-primary">Ver/Cadastrar Vagas</a>
    </div>

    <div class="mt-4">
      <a href="/mvc-php/" class="btn btn-secondary">Voltar</a>
      <a href="#" class="btn btn-outline-primary">Editar Empresa</a>
    </div>
  </div>
</div>