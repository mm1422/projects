<!DOCTYPE html> 
<html>
<head> 
        <link href="css/styles.css" rel="stylesheet" /> 
      <meta charset="utf-8"> 
        <title>Treeniohjelmisto</title> 
    </head>
<body>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">  
                    <i class="fas fa-bars"></i> 
                </button> 
                <div class="collapse navbar-collapse" id="navbarResponsive"> 
                </div> 
            </div> 
        </nav> 
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "näyttö";

$conn = new mysqli($servername, $username, $password, $dbname);
  
{
    $sql = "SELECT * FROM tuote";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Kuntosalituote: " . $row["nimi"] . "<br>";
            
        }
        {
            echo "<br><a href='näyttö.html'>Palaa pääsivulle</a>";
        }
    } else {
        echo "Ei tuotteita";
        echo "<br><a href='näyttö.html'>Palaa pääsivulle</a>";
    }
}

$conn->close();
?>

        <script src="js/scripts.js"></script> 
</body> 

</html>