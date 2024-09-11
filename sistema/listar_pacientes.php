<?php
session_start();
include 'config.php';

if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}

//define o nome da sessão pelo id do médico
$medico_id = $_SESSION['medico_id'];

//recupera o nome do médico de acordo com o id da sessão
$sql_medico = "SELECT nome FROM Medicos WHERE codigo='$medico_id'";
$result_medico = $conn->query($sql_medico);
$medico_nome = $result_medico->fetch_assoc()['nome'];

$sql = "SELECT * FROM Pacientes WHERE medico_codigo='$medico_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Pacientes</title>
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
        <h4>Pacientes</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="cadastrar_paciente.php" class="btn btn-success mb-2">Cadastrar Paciente</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td><a href='listar_prescricoes.php?paciente_id=".$row['codigo']."' class='btn btn-info btn-sm'>Ver Prescrições</a> ";
                        echo "<a href='deletar_paciente.php?paciente_id=".$row['codigo']."' class='btn btn-danger btn-sm'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum paciente cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>        
    </div>
</body>
</html>