# Sistema de Agendamento de Salas

O **Sistema de Agendamento de Salas** é uma solução web desenvolvida para facilitar a reserva e gestão de espaços, como salas de reuniões, auditórios e salas de aula. Este sistema permite que os usuários visualizem a disponibilidade de espaços em tempo real, façam agendamentos de forma prática e recebam confirmações de suas reservas instantaneamente.

## Funcionalidades

- **Visualização de Disponibilidade**: Os usuários podem verificar facilmente quais salas estão disponíveis em determinadas datas e horários.
- **Reserva de Salas**: Permite aos usuários reservar salas conforme a necessidade, especificando o tempo de utilização.
- **Gestão de Reservas**: Os usuários podem visualizar, modificar ou cancelar suas reservas.
- **Interface Intuitiva**: Desenvolvida para ser simples e fácil de usar, garantindo uma experiência de usuário fluida e sem complicações.

## Tecnologias Utilizadas

- **Front-end**: HTML, CSS, JavaScript
- **Back-end**: PHP
- **Banco de Dados**: MySQL

## Como Instalar

1. Clone este repositório para o seu ambiente de desenvolvimento local:
   ```bash
   git clone https://github.com/seuusuario/sistema-agendamento-salas.git

2. Importe o arquivo database.sql para o seu sistema de gerenciamento de banco de dados MySQL para criar as tabelas necessárias.
3. Adapte o arquivo de configuração de conexão com o banco de dados (db.php ou similar) com as suas credenciais do MySQL.

## Configuração do Banco de Dados
Antes de iniciar o sistema, é necessário configurar a conexão com o banco de dados. Abra o arquivo de configuração do banco de dados e atualize as seguintes linhas com as suas informações:

PHP

$servername = "localhost"; // Endereço do servidor do banco de dados
$username = "seu_usuario"; // Usuário do banco de dados
$password = "sua_senha"; // Senha do banco de dados
$database = "nome_do_seu_banco"; // Nome do banco de dados

Contribuições são sempre bem-vindas! Se você tem alguma ideia para melhorar o sistema ou corrigir um problema, sinta-se à vontade para criar um pull request ou abrir uma issue.

Créditos
Desenvolvido por Pablo Gafanha - Entre em contato pelo e-mail: devopsgafanha@gmail.com
