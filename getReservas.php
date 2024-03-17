<?php
/**
 * ====================================================================
 * Sistema de Agendamento de Salas
 * Desenvolvido por Pablo Gafanha
 * 
 * Este sistema foi criado para facilitar o agendamento e a utilização
 * de salas de forma eficiente e organizada. Através de uma interface
 * amigável e intuitiva, usuários podem marcar horários em salas
 * disponíveis, visualizar agendamentos e receber lembretes.
 * 
 * Se você encontrar este código útil para seus projetos, por favor,
 * dê os devidos créditos, mencionando o autor original.
 * 
 * Para mais informações, sugestões ou colaborações, você pode entrar
 * em contato através do e-mail: devopsgafanha@gmail.com
 * 
 * Agradeço pelo apoio e espero que este sistema contribua positivamente
 * para seus projetos e necessidades.
 * 
 * Pablo Gafanha
 * ====================================================================
 */
 
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "USUARIO_DO_BANCO", "SENHA", "BANCO_DE_DADOS");

if ($mysqli->connect_error) {
    echo json_encode(['error' => true, 'message' => "Erro de conexão: " . $mysqli->connect_error]);
    exit;
}

header('Content-Type: application/json');
$dados = json_decode(file_get_contents('php://input'), true); // Decodifica o JSON enviado
$tabela = $dados['tabela'];

// Lista de tabelas válidas para prevenir injeção SQL
$tabelasValidas = ['sala1', 'sala2', 'sala3'];

// Verifica se a tabela recebida está na lista de tabelas válidas
if (!in_array($tabela, $tabelasValidas)) {
    echo json_encode(['error' => true, 'message' => "Nome de tabela inválido."]);
    exit;
}

// Prepara a consulta SQL usando o nome da tabela validado
$query = "SELECT * FROM " . $tabela;

$result = $mysqli->query($query);

if ($result) {
    $reservas = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($reservas);
} else {
    echo json_encode(['error' => true, 'message' => "Erro ao buscar reservas."]);
}

$mysqli->close();
?>
