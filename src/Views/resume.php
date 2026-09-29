<div class="main-content">
  <div class="topbar">
    <h5 class="m-0">Currículos da Empresa: <?= htmlspecialchars($companyName); ?></h5>
    <span class="text-muted small d-none d-sm-inline">Envio de Currículos para Empresas</span>
  </div>

  <?php $baseUrl = defined('BASE_URL') ? BASE_URL : ''; ?>
  <div id="conteudo" class="p-4">

    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5>Enviar Currículo</h5>
        <?php if (!empty($flash['success'])): ?>
            <div class='alert alert-success mt-3 mx-auto'><?= $flash['success'] ?></div>
        <?php endif; ?>

        <?php if (!empty($flash['error'])): ?>
            <div class='alert alert-danger mt-3 mx-auto'><?= $flash['error'] ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= $baseUrl ?>/resume/create/<?= $companyId; ?>" enctype="multipart/form-data" class="row g-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" id="name" name="name" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="email" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="telefone" class="form-label">Telefone *</label>
            <input type="text" id="telefone" name="phone" class="form-control" />
          </div>
          <div class="col-md-6">
            <label for="vaga_id" class="form-label">Vaga *</label>
            <select id="vaga_id" name="vacancy_id" class="form-control" required>
              <option value="">Selecione a vaga</option>
              <?php foreach($vacancies as $vacancy): ?>
                <option value="<?= $vacancy->id; ?>"><?= htmlspecialchars($vacancy->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="curriculo" class="form-label">Arquivo do Currículo (PDF, DOC, DOCX | max 5MB)</label>
            <input type="file" id="curriculo" name="resume" class="form-control" accept=".pdf,.doc,.docx" required />
          </div>
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">Enviar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Currículos Enviados</h5>
        <?php if(count($resumes) === 0): ?>
          <p>Nenhum currículo enviado.</p>
        <?php else: ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Vaga</th>
                <th>Arquivo</th>
                <th>Enviado em</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($resumes as $resume): ?>
                <tr>
                  <td><?= htmlspecialchars($resume->name); ?></td>
                  <td><?= htmlspecialchars($resume->email); ?></td>
                  <td><?= htmlspecialchars($resume->phone); ?></td>
                  <td><?= htmlspecialchars($resume->vacancy_name); ?></td>
                  <td>
                    <?php if ($resume->path): ?>
                      <a href="<?= $baseUrl ?>/uploads/resumes/<?= rawurlencode($resume->path); ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-file-download me-1"></i> Ver arquivo</a>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                      $dataCriadoEm = strtotime($resume->created_at ?? '');
                      echo $dataCriadoEm ? date('d/m/Y', $dataCriadoEm) : '-';
                    ?>
                  </td>
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