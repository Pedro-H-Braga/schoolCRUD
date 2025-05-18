# CRUD Desafio Didati.ca

Este repositório contém um desafio de um CRUD básico utilizando Laravel no backend e Vue.js no frontend. O projeto simula o gerenciamento de uma escola com duas tabelas principais: `turmas` e `alunos`.

## Estrutura do Projeto

### Tabela: Turmas
- **id**: Identificador único da turma (integer, primary key, auto-increment).
- **nome**: Nome da turma (string).
- **ano**: Ano letivo da turma (integer).
- **periodo**: Período do dia da turma (enum: `matutino`, `vespertino`, `noturno`).

### Tabela: Alunos
- **id**: Identificador único do aluno (integer, primary key, auto-increment).
- **nome**: Nome do aluno (string).
- **email**: E-mail do aluno (string).
- **data_nascimento**: Data de nascimento do aluno (date).
- **turma_id**: Referência para a turma do aluno (integer, foreign key).

## Funcionalidades

### Backend (Laravel)
- **CRUD Turmas**:
  - Criar uma nova turma.
  - Listar todas as turmas.
  - Atualizar uma turma existente.
  - Deletar uma turma.
- **CRUD Alunos**:
  - Criar um novo aluno.
  - Listar todos os alunos.
  - Atualizar um aluno existente.
  - Deletar um aluno.

### Frontend (Vue.js)
- **Interface de Usuário**:
  - Formulários para criação e edição de turmas e alunos.
  - Listagem de turmas e alunos com opções para editar e deletar.
  - Visualização detalhada das turmas com seus respectivos alunos.

## Requisitos

- PHP 8.0+
- Composer
- Node.js 14+
- Laravel 8+
- Vue.js 3+
