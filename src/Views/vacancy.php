<div class="main-content">
  <div class="topbar">
    <h5 class="m-0">Vagas da Empresa: <?= htmlspecialchars($companyName); ?></h5>
    <span class="text-muted small d-none d-sm-inline">Gestão de Vagas Disponíveis</span>
  </div>

  <?php $baseUrl = defined('BASE_URL') ? BASE_URL : ''; ?>
  <div id="conteudo" class="p-4">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5>Cadastrar Nova Vaga</h5>
        <?php if (!empty($flash['success'])): ?>
            <div class='alert alert-success mt-3 mx-auto'><?= $flash['success'] ?></div>
        <?php endif; ?>

        <?php if (!empty($flash['error'])): ?>
            <div class='alert alert-danger mt-3 mx-auto'><?= $flash['error'] ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= $baseUrl ?>/vacancy/create/<?= $companyId; ?>" class="row g-3">
          <input type="hidden" name="acao" value="cadastrar_vaga" />

          <div class="col-md-6">
            <label for="titulo" class="form-label">Título da Vaga *</label>
            <input type="text" id="titulo" name="name" class="form-control" required />
          </div>

          <div class="col-md-12">
            <label for="descricao" class="form-label">Descrição *</label>
            <textarea id="descricao" name="description" class="form-control" rows="4" required></textarea>
          </div>

          <div class="col-md-12">
            <label for="requisitos" class="form-label">Requisitos</label>
            <textarea id="requisitos" name="requirements" class="form-control" rows="3"></textarea>
          </div>

          <div class="col-md-6">
            <label for="salario" class="form-label">Salário</label>
            <input type="text" id="salario" name="wage" class="form-control" />
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Cadastrar Vaga</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Vagas Cadastradas</h5>
        <?php if(count($vacancies) === 0): ?>
          <p>Não há vagas cadastradas para esta empresa.</p>
        <?php else: ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Requisitos</th>
                <th>Salário</th>
                <th>Criado em</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($vacancies as $vacancy): ?>
                <tr>
                  <td><?= htmlspecialchars($vacancy->name); ?></td>
                  <td><?= nl2br(htmlspecialchars($vacancy->description)); ?></td>
                  <td><?= nl2br(htmlspecialchars($vacancy->requirements)); ?></td>
                  <td><?= htmlspecialchars($vacancy->wage); ?></td>
                  <td><?= date('d/m/Y', strtotime($vacancy->created_at)); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>

    <div class="mt-4">
      <a href="<?= $baseUrl ?>/company/<?= $companyId; ?>" class="btn btn-secondary">Voltar</a>
    </div>
  </div>
</div>