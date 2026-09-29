# Portal de Carreiras & Gestão de Currículos

Aplicação web desenvolvida em PHP com arquitetura MVC, criada para conectar empresas e candidatos através do cadastro de vagas e envio direto de currículos.

---

## Funcionalidades

- **Dashboard Administrativo**: Visão consolidada de empresas cadastradas e métricas da plataforma.
- **Gestão de Empresas**: Cadastro, edição, visualização e acompanhamento de empresas contratantes.
- **Gestão de Vagas**: Publicação de oportunidades vinculadas a cada empresa, com especificação de requisitos, descrição e remuneração.
- **Envio de Currículos**: Formulário para candidatos enviarem informações e anexo de currículo nos formatos `.pdf`, `.doc` ou `.docx` (limite de 5MB).
- **Consulta de Candidaturas**: Listagem e acesso aos currículos recebidos para cada vaga da empresa.

---

## Executando com Docker

### Requisitos

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)

### Passo a passo

1. **Clone o repositório** e entre no diretório:
   ```bash
   git clone https://github.com/ArthuPereira/mvc-php.git
   cd mvc-php
   ```

2. **Configure as variáveis de ambiente** (opcional, o arquivo `.env.example` já possui valores padrão funcionais):
   ```bash
   cp .env.example .env
   ```

3. **Inicie os containers**:
   ```bash
   docker compose up -d --build
   ```

4. **Acesse a aplicação no navegador**:
   - URL: [http://localhost:8080](http://localhost:8080)

---

## Variáveis de Ambiente

As principais variáveis configuráveis no `.env`:

| Variável | Padrão | Descrição |
|---|---|---|
| `APP_PORT` | `8080` | Porta HTTP da aplicação no host |
| `BASE_URL` | *(vazio)* | Prefixo de URL caso a aplicação esteja sob subdiretório |
| `DB_HOST` | `db` | Host do banco de dados PostgreSQL |
| `DB_PORT` | `5432` | Porta interna do PostgreSQL |
| `DB_PORT_HOST` | `5432` | Porta mapeada para o host |
| `DB_DATABASE` | `curriculos_db` | Nome da base de dados |
| `DB_USER` | `curriculos_user` | Usuário do PostgreSQL |
| `DB_PASSWORD` | `curriculos_pass` | Senha do usuário do PostgreSQL |
