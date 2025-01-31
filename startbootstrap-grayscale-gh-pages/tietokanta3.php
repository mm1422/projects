<!DOCTYPE html>
<html>
 
<head> 
        <link href="css/styles.css" rel="stylesheet" /> 
      <meta charset="utf-8"> 
        <title>Treeniohjelmisto</title> 
    </head> 

<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style = "background-color: black;" id="mainNav">  
            <div class="container px-4 px-lg-5"> 
                <a class="navbar-brand" href="#page-top"> 
                    </a> 
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
      
     if ($conn->connect_error) {
         die("Yhteys epäonnistui: " . $conn->connect_error);
     }
     $nimi = isset($_GET["nimi"]) ? $_GET ["nimi"] : '';
     $sql = "INSERT INTO tuote (nimi)
VALUES ('$nimi')";

if ($conn->query($sql) === TRUE) {
  echo "<h3><br><br>Lisääminen onnistui</h3>";
  echo "<a href='näyttö.html'>Palaa pääsivulle</a>";

} else {
  echo "Virhe: " . $sql . "<br>" . $conn->error;
}
      
    
     $conn->close();
        ?>
        
    <script src="js/scripts.js"></script> 
</body>
 
</html>