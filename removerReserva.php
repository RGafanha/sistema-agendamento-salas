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
    echo json_encode(['success' => false, 'message' => "Erro de conexão: " . $mysqli->connect_error]);
    exit;
}

$cellId = $_POST['cellId'];
$tabela = $_POST['tabela'];
// Lista de tabelas permitidas para prevenir injeção SQL
$tabelasPermitidas = ['sala1', 'sala2', 'sala3'];

// Verifica se a tabela recebida está na lista de permitidas
if (!in_array($tabela, $tabelasPermitidas)) {
    echo json_encode(['success' => false, 'message' => "Nome de tabela inválido."]);
    exit;
}

// Prepara a consulta SQL dinamicamente usando o nome da tabela validado
$query = sprintf("DELETE FROM %s WHERE cell_id = ?", $mysqli->real_escape_string($tabela));

$stmt = $mysqli->prepare($query);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => "Erro ao preparar a consulta: " . $mysqli->error]);
    exit;
}

$stmt->bind_param("s", $cellId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => "Erro ao remover reserva: " . $stmt->error]);
}

$stmt->close();
$mysqli->close();
?>
