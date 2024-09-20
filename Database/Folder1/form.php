<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connect</title>
</head>
<body>

<h1>Conexão com o SQL Server</h1>

<form action="database.php" method="POST">

    <label>Nome:</label>
    <input type="text" placeholder="Digite seu nome" name="Nome" required>
    <br><br>

    <label>Sobrenome:</label>
    <input type="text" placeholder="Digite seu sobrenome" name="Sobrenome" required>
    <br><br>

    <label>Cidade:</label>
    <input type="text" placeholder="Digite sua cidade" name="Cidade" required>
    <br><br>

    <label>Idade:</label>
    <input type="number" placeholder="Digite sua idade" name="Idade" min="0" required>
    <br><br>

    <button type="submit">CRIAR USUÁRIO</button>

</form>

<h1>Procurar Usuário por ID</h1>

<form action="database.php" method="GET">
    <label>ID do usuário:</label>
    <input type="number" placeholder="Digite o ID" name="id" required>
    <br><br>

    <button type="submit">BUSCAR USUÁRIO</button>
</form>

<h1>Deletar Usuário por ID</h1>

<form action="database.php" method="POST">
    <input type="hidden" name="action" value="delete">
    <label>ID do usuário para deletar:</label>
    <input type="number" placeholder="Digite o ID" name="delete_id" required>
    <br><br>
    <button type="submit">DELETAR USUÁRIO</button>
</form>

<form action="database.php" method="POST">
    <input type="hidden" name="action" value="update">
    <label>ID do usuário a ser atualizado:</label>
    <input type="number" placeholder="Digite o ID" name="update_id" required>
    <br><br>
    <label>Novo Nome:</label>
    <input type="text" placeholder="Digite o novo nome" name="Nome" required>
    <br><br>
    <label>Novo Sobrenome:</label>
    <input type="text" placeholder="Digite o novo sobrenome" name="Sobrenome" required>
    <br><br>
    <label>Nova Cidade:</label>
    <input type="text" placeholder="Digite a nova cidade" name="Cidade" required>
    <br><br>
    <label>Nova Idade:</label>
    <input type="number" placeholder="Digite a nova idade" name="Idade" min="0" required>
    <br><br>
    <button type="submit">ATUALIZAR USUÁRIO</button>
</form>


</body>
</html>
