<?php
session_start();
include 'config.php';

if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}

$paciente_id = $_GET['paciente_id'];
$medico_id = $_SESSION['medico_id'];

// Obter nome do paciente
$sql_paciente = "SELECT nome FROM Pacientes WHERE codigo='$paciente_id'";
$result_paciente = $conn->query($sql_paciente);
$paciente_nome = $result_paciente->fetch_assoc()['nome'];

// Obter nome do médico
$sql_medico = "SELECT nome FROM Medicos WHERE codigo='$medico_id'";
$result_medico = $conn->query($sql_medico);
$medico_nome = $result_medico->fetch_assoc()['nome'];

// Obter prescrições
$sql = "SELECT * FROM Prescricoes WHERE paciente_codigo='$paciente_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Prescrições</title>
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
        <h4>Prescrições do(a) paciente: <?php echo $paciente_nome; ?></h4>
        <div class="row justify-content-end">
            <div class="col-3">
            <a href="listar_pacientes.php" class="btn btn-primary mb-2">Voltar</a>
            <a href="cadastrar_prescricao.php?paciente_id=<?php echo $paciente_id; ?>" class="btn btn-success mb-2">Cadastrar Prescrição</a>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Prescrição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['prescricao']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhuma prescrição cadastrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>