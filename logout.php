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

// Destrói todas as variáveis da sessão
$_SESSION = array();

// Se desejar destruir a sessão completamente, apague também o cookie de sessão.
// Isso vai destruir a sessão, e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão.
session_destroy();

// Redireciona o usuário para a página de login ou página inicial
header("Location: index.php");
exit;
?>
