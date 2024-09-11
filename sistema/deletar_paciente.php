<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
<?php
session_start();
include 'config.php';

if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}

$paciente_id = $_GET['paciente_id'];

$sql = "SELECT * FROM Prescricoes WHERE paciente_codigo='$paciente_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: erro.php");    
} else {
    $sql = "DELETE FROM Pacientes WHERE codigo='$paciente_id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_pacientes.php");
    } else {
        echo "Erro ao deletar paciente: " . $conn->error;
    }
}
?>
<div class="row">
    <div class="col-12 d-flex justify-content-center">
    <a href="listar_pacientes.php" class="btn btn-primary mb-2">Voltar</a>
</div>

</body>
</html>