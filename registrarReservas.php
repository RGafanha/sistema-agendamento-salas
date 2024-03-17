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
$nome = $_POST['nome'];
$cor = $_POST['cor'];
$tabela = $_POST['tabela'];
// Lista de tabelas válidas para prevenir injeção SQL
$tabelasValidas = ['sala1', 'sala2', 'sala3'];

// Verifica se a tabela é válida
if (in_array($tabela, $tabelasValidas)) {
    // Prepara a query usando a variável $tabela
    // ATENÇÃO: Isto só é seguro porque estamos garantindo que o valor de $tabela é controlado e validado
    $query = sprintf("INSERT INTO %s (cell_id, nome, cor) VALUES (?, ?, ?)", $tabela);

    // Prepare a consulta com o mysqli
    if ($stmt = $mysqli->prepare($query)) {
        // Vincula os parâmetros (exemplo: 'sss' indica que os três valores são strings)
        $stmt->bind_param('sss', $cellId, $nome, $cor);

// Defina os valores de $cellId, $nome, $cor

       // Executa a consulta
if ($stmt->execute()) {
    // Alterado para retornar uma resposta JSON
    echo json_encode(['success' => true, 'message' => 'Inserção bem-sucedida.']);
} else {
    // Alterado para retornar uma resposta JSON
    echo json_encode(['success' => false, 'message' => 'Erro ao inserir: ' . $mysqli->error]);
}

$stmt->close(); // Fecha o statement
    } else {
    // Alterado para retornar uma resposta JSON
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $mysqli->error]);
}
} else {
    // Alterado para retornar uma resposta JSON
    echo json_encode(['success' => false, 'message' => 'Nome da tabela inválido.']);
}

$mysqli->close(); // Fecha a conexão
?>
