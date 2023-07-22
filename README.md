# Task Manager

O Task Manager é um aplicativo web simples para gerenciar tarefas. Ele permite que os usuários criem, editem, excluam e visualizem suas tarefas.

## Tecnologias Utilizadas

- PHP (CodeIgniter 3)
- MySQL (Banco de dados)
- Bootstrap 5 (Framework CSS)
- AdminLTE (Template de painel administrativo)

## Funcionalidades

- Autenticação de usuário (Login, Register, Logout)
- Gerenciamento de tarefas (CRUD - Create, Read, Update, Delete)
- Controle de acesso por perfil de usuário (admin = 1 e usuário comum = 0)

## Instalação

1. Clone o repositório para o seu servidor web local:
git clone https://github.com/Dassuen/task_manager.git
2. Crie um banco de dados MySQL chamado `task_manager` e importe o arquivo `task_manager.sql` localizado na pasta `sql/` do projeto.

3. Configure as credenciais do banco de dados no arquivo `application/config/database.php`.

4. Acesse a URL do projeto em seu servidor local para começar a usar o Task Manager.

## Estrutura de Pastas

- **application**: Contém os arquivos principais do CodeIgniter.
- **assets**: Contém arquivos estáticos como CSS, JavaScript e bibliotecas (Bootstrap, AdminLTE).
- **sql**: Contém o arquivo SQL para criar a tabela de tarefas no banco de dados.
- **user_guide**: Documentação do CodeIgniter (opcional, pode ser removida se não for necessária).

## Como Usar

1. Acesse a página inicial do projeto e clique em "Criar conta" para se registrar como usuário.

2. Faça login com suas credenciais.

3. Na página inicial, você verá suas tarefas existentes, ou uma mensagem indicando que você não tem tarefas.

4. Para adicionar uma nova tarefa, clique em "Adicionar Tarefa" e preencha os detalhes da tarefa na modal.

5. Para editar ou excluir uma tarefa, clique nos botões correspondentes na lista de tarefas.

6. O usuário com perfil de administrador tem permissão para editar ou excluir todas as tarefas. Já os usuários comuns só podem editar ou excluir suas próprias tarefas.

## Observações

- As senhas dos usuários são armazenadas no banco de dados usando a função `password_hash()`, garantindo a segurança das informações.

- O sistema de permissões é gerenciado pelo código na controller `Tasks`, onde a função `delete_task()` verifica se o usuário tem permissão para excluir uma tarefa específica.

## Autor

Dassuen Cabral - [Unify](https://unifybrasil.com)

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## Agradecimentos

- CodeIgniter (https://codeigniter.com)
- Bootstrap (https://getbootstrap.com)
- AdminLTE (https://adminlte.io)

<!--
## Screenshots

(Inserir algumas capturas de tela do aplicativo)
-->
