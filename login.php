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
 
session_start(); // Inicia a sessão
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "USUARIO_DO_BANCO", "SENHA", "BANCO_DE_DADOS");

if ($mysqli->connect_error) {
    echo json_encode(['error' => true, 'message' => "Erro de conexão: " . $mysqli->connect_error]);
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, senha FROM usuarios WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($senha, $row['senha'])) {
        // Senha correta, login bem-sucedido
        $_SESSION['usuario_logado'] = true; // Indica que o usuário está logado
		$_SESSION['usuario_id'] = $row['id']; // Salva o ID do usuário, por exemplo
        echo json_encode(['error' => false, 'message' => 'Login bem-sucedido.', 'redirect' => 'index.php']);
		exit;
		
    } else {
        // Senha incorreta
        echo json_encode(['error' => true, 'message' => " senha incorretos."]);
    }
} else {
    // E-mail não encontrado
    echo json_encode(['error' => true, 'message' => "E-mail ou senha incorretos."]);
}

$stmt->close();
$mysqli->close();
?>
