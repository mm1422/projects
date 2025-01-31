 <!DOCTYPE html> 
<html> 
    <head> 
    <link href="css/styles.css" rel="stylesheet" /> 
      <meta charset="utf-8"> 
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
<?php  if (isset($_GET['lisaatuote'])) { 

    ?> 
    <form action = "tietokanta3.php" method = "get"> 

       <br><br><br><br> <p><h5>Syötä kuntosali tuotteen nimi</h5></p> 
       <textarea name = "nimi"></textarea>
        <br><br><input type = "submit" value = "Tallenna"> <br>
       <br> <a href = "näyttö.html">Palaa pääsivulle</a> 
        </form> 

    <?php } elseif (isset($_GET['poistatuote'])) {  

        ?> 

<form action="tietokanta4.php" method="get">  
    <br><br><br><br>
    <p><h5>Syötä kuntosali tuotteen nimi poistaaksesi sen:</h5></p>
    <input type="text" name="poistettava_nimi">
    <input type="submit" name="poista" value="Poista"><br>
    <br>
    <a href="näyttö.html">Palaa pääsivulle</a>
</form> 

    <?php } ?> 
    <script src="js/scripts.js"></script> 

    </body> 
</html> 

 