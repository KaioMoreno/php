<?php
function connectMySQL() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuarios";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Erro ao conectar: ' . $conn->connect_error);
    }

    return $conn;
}

function addUser($nome, $sobrenome, $cidade, $idade) {
    $conn = connectMySQL();
    $sql = "INSERT INTO clientes (Nome, Sobrenome, Cidade, Idade) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $sobrenome, $cidade, $idade);
    
    if ($stmt->execute()) {
        echo "Usuário adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function getUser($ID) {
    $conn = connectMySQL();
    $sql = "SELECT * FROM clientes WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "Usuário encontrado:<br>";
            echo "ID: " . $row['ID'] . "<br>";
            echo "Nome: " . $row['Nome'] . "<br>";
            echo "Sobrenome: " . $row['Sobrenome'] . "<br>";
            echo "Cidade: " . $row['Cidade'] . "<br>";
            echo "Idade: " . $row['Idade'] . "<br>";
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "Erro ao buscar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function deleteUser($ID) {
    $conn = connectMySQL();
    $sql = "DELETE FROM clientes WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Usuário deletado com sucesso!";
        } else {
            echo "Nenhum usuário encontrado com o ID fornecido.";
        }
    } else {
        echo "Erro ao deletar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function updateUser($ID, $nome, $sobrenome, $cidade, $idade) {
    $conn = connectMySQL();
    $sql = "UPDATE clientes SET Nome = ?, Sobrenome = ?, Cidade = ?, Idade = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nome, $sobrenome, $cidade, $idade, $ID);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Nenhum usuário encontrado com o ID fornecido ou nenhum dado foi alterado.";
        }
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] === 'add') {
        $nome = $_POST['Nome'];
        $sobrenome = $_POST['Sobrenome'];
        $cidade = $_POST['Cidade'];
        $idade = $_POST['Idade'];
        addUser($nome, $sobrenome, $cidade, $idade);
    } elseif ($_POST['action'] === 'delete' && isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        deleteUser($id);
    } elseif ($_POST['action'] === 'update' && isset($_POST['update_id'])) {
        $id = $_POST['update_id'];
        $nome = $_POST['Nome'];
        $sobrenome = $_POST['Sobrenome'];
        $cidade = $_POST['Cidade'];
        $idade = $_POST['Idade'];
        updateUser($id, $nome, $sobrenome, $cidade, $idade);
    }
}
?>


