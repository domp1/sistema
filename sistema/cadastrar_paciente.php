<?php
session_start();
include 'config.php';

if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}

$medico_id = $_SESSION['medico_id'];

$sql_medico = "SELECT nome FROM Medicos WHERE codigo='$medico_id'";
$result_medico = $conn->query($sql_medico);
$medico_nome = $result_medico->fetch_assoc()['nome'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_paciente = $_POST['nome_paciente'];
    $medico_id = $_SESSION['medico_id'];
    $medico_nome = $_SESSION['nome'];

    $sql = "INSERT INTO Pacientes (nome, medico_codigo) VALUES ('$nome_paciente', '$medico_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: sucesso.php");
    } else {
        echo "Erro ao cadastrar paciente: " . $conn->error;
    }
}
?>

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
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), Dr(a). <?php echo $medico_nome; ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Cadastrar Paciente</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_pacientes.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <form method="post" action="cadastrar_paciente.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome_paciente" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>