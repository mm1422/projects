 <!DOCTYPE html>         
<html>   
<head>   
<link href="css/styles.css" rel="stylesheet" /> 
    <meta charset="utf-8">   
    <title></title>   
</head>   
<body>   
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style = "background-color: black;" id="mainNav">  
            <div class="container px-4 px-lg-5"> 
                <a class="navbar-brand" href="#page-top"> 
                    Treeniohjelmisto</a> 
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">  
                    <i class="fas fa-bars"></i> 
                </button> 
                <div class="collapse navbar-collapse" id="navbarResponsive"> 
                </div> 
            </div> 
        </nav> 
  
<?php   
if (isset($_GET['lisaa'])) {   
?>  
    <form action="tietokanta.php" method="get">  <br> 
       <br><br><br> <p><h5>Syötä tapahtuman nimi</h5></p>   
        <input type="text" name="tapahtumannimi"><br>   
        <p><h5>Syötä tapahtuman päivämäärä</h5></p>   
        <input type="text" name="pvm"><br>   
        <br><input type="submit" name="tallenna" value="Tallenna"> <br>   
        <br><a href = "näyttö.html">Palaa pääsivulle</a>   
    </form>  
<?php } elseif (isset($_GET['muuta'])) {   
    
?>   
 
    <?php  }  elseif (isset($_GET['hallinta'])) {  

     ?>   

    <form action = "näyttö2.php" method = "get">  
    <br><br><br><br><p><h5>Kuntosali tuotteiden hallinta</h5></p>  
    <input type = "submit" name = "lisaatuote" value = "Lisää kuntosali tuote">  
    <input type = "submit" name = "poistatuote" value = "Poista kuntosali tuote"><br>  
    <br><a href = "näyttö.html">Palaa pääsivulle</a>  
    </form>  

    <?php } elseif (isset($_GET['lisaatuote'])) {  
    ?>  

    <form action = "näyttö2.php" method= "get">  
    </form>  
    <?php } elseif (isset($_GET['poistatuote'])) {  
?>  

 <form action = "näyttö2.php" method= "get">  
    </form>  

    <div class="collapse navbar-collapse" id="navbarResponsive"> 
            <ul class="navbar-nav ms-auto"> 
               <li class="nav-item"><a class="nav-link" href="näyttö2.php?lisaatuote">Lisää kuntosali tuote</a></li> 
                <li class="nav-item"><a class="nav-link" href="näyttö2.php?poistatuote">Poista kuntosali tuote</a></li> 
            </ul> 
        </div> 
    </div> 
</nav> 

     <?php } elseif (isset($_GET['poista'])) {  

     ?>  
     <form action="tietokanta5.php" method="get">  
    <br><br><br><br>
    <p><h5>Syötä tapahtuman nimi poistaaksesi sen:</h5></p>
    <input type="text" name="poistettava_nimi">
    <input type="submit" name="poista" value="Poista"><br>
    <br>
    <a href="näyttö.html">Palaa pääsivulle</a>
</form>
    <?php } ?>  

    <script src="js/scripts.js"></script>  
</body>   
</html>   

 
 
