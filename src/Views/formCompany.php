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
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h5 class="mb-0">Cadastro de Empresa</h5>
      <a href="/mvc-php/" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <!-- ajeitar a parte de mensagens-->
        <?php if (!empty($flash['success'])): ?>
            <div class='alert alert-success mt-3 mx-auto'><?= $flash['success'] ?></div>
        <?php endif; ?>

        <?php if (!empty($flash['error'])): ?>
            <div class='alert alert-danger mt-3 mx-auto'><?= $flash['error'] ?></div>
        <?php endif; ?>

        <form id="formCadastrarEmpresa" action="/mvc-php/company/create" method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nome da Empresa</label>
              <input name="name" type="text" class="form-control" placeholder="Digite o nome da empresa" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">CNPJ</label>
              <input name="cnpj" type="text" class="form-control" placeholder="00.000.000/0000-00" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control" placeholder="empresa@exemplo.com" required/>
            </div>

            <div class="col-md-6">
              <label class="form-label">Nome Responsável</label>
              <input name="responsible" type="text" class="form-control" placeholder="João da Silva" required/>
            </div>

            <div class="col-md-6">
              <label class="form-label">CEP</label>
              <input id="cep" name="cep" type="text" class="form-control" placeholder="00000-000" required/>
            </div>

            <div class="col-md-6">
              <label class="form-label">Telefone</label>
              <input name="phone" type="text" class="form-control" placeholder="(99) 99999-9999" required/>
            </div>

            <div class="col-md-8">
              <label class="form-label">Endereço</label>
              <input name="address" type="text" class="form-control" placeholder="Rua, número, bairro" required />
            </div>

            <div class="col-md-4">
              <label class="form-label">Cidade</label>
              <input name="city" type="text" class="form-control" required />
            </div>

            <div class="col-md-4">
              <label class="form-label">Status</label>
              <select class="form-select" name="status" id="status" required>
                <option value="" disabled selected>Selecione um</option>
                <option value="Ativo">Ativo</option>
                <option value="Em Negociacao">Em Negociação</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Sobre a Empresa</label>
              <textarea name="description" class="form-control" required rows="4" placeholder="Descreva brevemente a empresa..."></textarea>
            </div>

            <div class="col-md-12 text-end">
              <button type="reset" class="btn btn-secondary">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar Empresa</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>