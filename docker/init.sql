-- Script de Inicialização do Banco de Dados PostgreSQL
-- Portal de Carreiras e Envio de Currículos para Empresas

-- Tabela de Empresas
CREATE TABLE IF NOT EXISTS companies (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    responsible VARCHAR(255) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Ativo',
    description TEXT,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Vagas
CREATE TABLE IF NOT EXISTS vacancies (
    id SERIAL PRIMARY KEY,
    company_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    requirements TEXT,
    wage VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_vacancies_company FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
);

-- Tabela de Currículos
CREATE TABLE IF NOT EXISTS resumes (
    id SERIAL PRIMARY KEY,
    vacancy_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_resumes_vacancy FOREIGN KEY (vacancy_id) REFERENCES vacancies(id) ON DELETE CASCADE
);

-- Dados Iniciais de Demonstração (Empresas e Vagas Corporativas)
INSERT INTO companies (id, name, cnpj, email, responsible, cep, phone, address, city, status, description, created_at) VALUES
(1, 'TechSolutions Inovação Digital', '12.345.678/0001-90', 'contato@techsolutions.com.br', 'Carlos Eduardo Mendes', '01310-100', '(11) 3214-5500', 'Av. Paulista, 1000 - Bela Vista', 'São Paulo', 'Ativo', 'Empresa focada em desenvolvimento de software em nuvem, consultoria em TI e engenharia de dados.', NOW()),
(2, 'Nexus Logística Integrada', '98.765.432/0001-10', 'rh@nexuslog.com.br', 'Mariana Rocha Lima', '80010-000', '(41) 3045-8800', 'Rua Marechal Deodoro, 450 - Centro', 'Curitiba', 'Ativo', 'Operador logístico com soluções de distribuição nacional, e-commerce fulfillment e supply chain.', NOW()),
(3, 'Atlas Engenharia & Consultoria', '45.123.890/0001-55', 'recrutamento@atlaseng.com.br', 'Roberto Albuquerque', '30130-110', '(31) 3320-9900', 'Av. Afonso Pena, 1500 - Savassi', 'Belo Horizonte', 'Em Negociacao', 'Consultoria e gerenciamento de grandes projetos de engenharia civil e infraestrutura sustentável.', NOW())
ON CONFLICT (id) DO NOTHING;

INSERT INTO vacancies (id, company_id, name, description, requirements, wage, created_at) VALUES
(1, 1, 'Desenvolvedor(a) Back-end PHP Pleno', 'Atuação no desenvolvimento e manutenção de APIs robustas em PHP, bancos relacionais e microsserviços.', 'Experiência com PHP 8+, PostgreSQL, Docker, Git e boas práticas de arquitetura MVC.', 'R$ 7.500,00', NOW()),
(2, 1, 'Engenheiro(a) DevOps / Cloud', 'Responsável pela sustentação e esteiras CI/CD de ambientes em nuvem, automação e monitoramento.', 'Conhecimentos em Docker, Kubernetes, AWS/GCP, Linux e automação de deploys.', 'R$ 9.000,00', NOW()),
(3, 2, 'Analista de Operações Logísticas', 'Supervisão de fluxos de expedição e transporte, análise de KPIs logísticos e contato com transportadoras.', 'Superior completo em Logística ou áreas correlatas, Excel avançado e perfil analítico.', 'R$ 4.200,00', NOW()),
(4, 3, 'Assistente de Projetos e Orçamentos', 'Elaboração de propostas comerciais técnicas, cronogramas de obras e orçamentos estruturados.', 'Formação técnica ou cursando Engenharia Civil/Produção, domínio de AutoCAD e planilhas.', 'R$ 3.200,00', NOW())
ON CONFLICT (id) DO NOTHING;

-- Sincroniza as sequências dos IDs com os dados inseridos
SELECT setval(pg_get_serial_sequence('companies', 'id'), COALESCE(MAX(id), 1)) FROM companies;
SELECT setval(pg_get_serial_sequence('vacancies', 'id'), COALESCE(MAX(id), 1)) FROM vacancies;
SELECT setval(pg_get_serial_sequence('resumes', 'id'), COALESCE(MAX(id), 1)) FROM resumes;
