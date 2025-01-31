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

if(isset($_GET['poista']) && isset($_GET['poistettava_nimi']))
    $poistettava_nimi = $_GET['poistettava_nimi'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Yhteys epäonnistui: " . $conn->connect_error);
    }

    $sql = "DELETE FROM tapahtuma WHERE tapahtumannimi = ?";
    $stmt = $conn->prepare($sql);

   
   

    $stmt->bind_param("s", $poistettava_nimi);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Tapahtuma nimeltä $poistettava_nimi on nyt poistettu";
        echo "<br><a href='näyttö.html'>Palaa pääsivulle</a>";
    } else {
        echo "Poistaminen epäonnistui koska tämän nimistä tapahtumaa ei löydetty";
        echo "<br><a href='näyttö.html'>Palaa pääsivulle</a>";
    }

    $stmt->close();
    $conn->close();

?>
     <script src="js/scripts.js"></script> 
</body>
 
</html>