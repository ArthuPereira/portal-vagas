<!-- Main content -->
<div class="main-content">
  <div class="topbar">
    <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
      <i class="fas fa-bars"></i>
    </button>
    <h5 class="m-0">Portal de Carreiras &amp; Oportunidades</h5>
    <span class="text-muted small d-none d-sm-inline">Banco de Talentos &amp; Envio de Currículos</span>
  </div>

  <?php $baseUrl = defined('BASE_URL') ? BASE_URL : ''; ?>
  <div id="conteudo" class="p-4">
     <h5 class="mb-4">Editar Empresa</h5>

    <div class="card shadow-sm">
      <div class="card-body">
        <form method="POST" action="<?= $baseUrl ?>/company/update/<?= $company->id; ?>">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nome da Empresa</label>
              <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($company->name); ?>" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">CNPJ</label>
              <input name="cnpj" type="text" class="form-control" value="<?= htmlspecialchars($company->cnpj); ?>" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($company->email); ?>" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Nome Responsável</label>
              <input name="responsible" type="text" class="form-control" value="<?= htmlspecialchars($company->responsible); ?>" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">CEP</label>
              <input name="cep" type="text" class="form-control" value="<?= htmlspecialchars($company->cep); ?>" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Telefone</label>
              <input name="phone" type="text" class="form-control" value="<?= htmlspecialchars($company->phone); ?>" required />
            </div>

            <div class="col-md-8">
              <label class="form-label">Endereço</label>
              <input name="address" type="text" class="form-control" value="<?= htmlspecialchars($company->address); ?>" required />
            </div>

            <div class="col-md-4">
              <label class="form-label">Cidade</label>
              <input name="city" type="text" class="form-control" value="<?= htmlspecialchars($company->city); ?>" required />
            </div>

            <div class="col-md-4">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="Ativo" <?= $company->status == 'ATIVO' ? 'selected' : '' ?>>ATIVO</option>
                <option value="Em Negociacao" <?= $company->status == 'NEGOCIAÇÃO' ? 'selected' : '' ?>>EM NEGOCIAÇÃO</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Sobre a Empresa</label>
              <textarea name="description" class="form-control" required rows="4"><?= htmlspecialchars($company->description); ?></textarea>
            </div>

            <div class="col-md-12 text-end">
              <a href="<?= $baseUrl ?: '/' ?>" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-success">Salvar Alterações</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>