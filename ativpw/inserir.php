<?php
$nome = $_POST['nome'];
$preco = $_POST['preco'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atividadepw";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO produtos
(nome,preco) VALUES ('$nome', '$preco')";
mysqli_query($conn, $sql);

if($conn->query($sql) === TRUE) {
    echo "Produto inserido com sucesso";
   } else {
       echo "Erro ao inserir Produto! ". $conn->error;
   }

$sql = "SELECT * FROM produtos";
$resultado = mysqli_query ($conn, $sql);

echo "<table>";
echo "<tr><th>ID</th><th>Nome</th><th>Preço</th></tr>";

while ($linha = mysqli_fetch_assoc($resultado)) 
{
    echo "<tr>"
    echo "<td> .$linha['id']. "</td>";
    echo "<td> .$linha['nome']. "</td>";
    echo "<td> .$linha['preco']. "</td>";
    echo "<td> "<a href="editar.php?id=" .$linha['id'].>Editar</a> </td>";
    echo </tr>";
}
    echo "</table>";

   $conn->close();
   ?>