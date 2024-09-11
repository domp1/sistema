<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Medicos WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $medico = $result->fetch_assoc();
        $_SESSION['medico_id'] = $medico['codigo'];
        $_SESSION['medico_nome'] = $medico['nome'];
        header("Location: listar_pacientes.php");
    } else {
        header("Location: index.php");
    }
}
?>