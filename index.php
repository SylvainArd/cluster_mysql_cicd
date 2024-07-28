<?php
$servername = "aurora-cluster.cluster-c52ewkus4mtn.us-east-1.rds.amazonaws.com";
$username = "exemple";
$password = "2698$f!!:NbOIUY";
$dbname = "exemple";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insertion d'un nouvel exemple
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exemple'])) {
  $exemple = $_POST['exemple'];
  $sql = "INSERT INTO exemple (exemple) VALUES ('$exemple')";
  if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Récupération des exemples
$sql = "SELECT * FROM exemple";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Exemples</title>
</head>
<body>
  <h1>Ajouter un exemple</h1>
  <form method="post" action="">
    Exemple: <input type="text" name="exemple">
    <input type="submit" value="Ajouter">
  </form>

  <h1>Liste des exemples</h1>
  <table border="1">
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["exemple"]. "</td></tr>";
      }
    } else {
      echo "<tr><td>Aucun exemple trouvé</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
