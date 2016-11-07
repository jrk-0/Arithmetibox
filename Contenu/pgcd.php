<?php require('debut.php');
    require('fonctions.php'); ?>
<h2 class="titreDansLaFonctions">PGCD</h2>
<form action="Arithmetibox.php?outil=pgcd" method="post">
<p>Pour calculer le PGCD nous avons besoin de : </br>
Un nombre a :<input type="text" name="nbA"/></br>
Un nombre b :<input type="text" name="nbB"/></br>
<input type="submit" value="Calculer" class="boutton"></p>
</form>
<?php
    if(isset($_POST['nbA'])and preg_match('#^[0-9]*$#',$_POST['nbA'])==true){
        $testNba=true;
    }
    
    elseif(isset($_POST['nbB'])and preg_match('#^[0-9]*$#',$_POST['nbB'])==true){
        $testNbb=true;
    }
    else{
        $testNba=false;
        $testNbb=false;
    }
    if(isset($_POST['nbB']) and isset($_POST['nbA'])){
        if($testNba!=true and $testNbb!=true) echo "Problème de saisies les valeurs, ne sont pas numériques.</br>";
        
        else {
            echo 'PGCD('.$_POST['nbA'].','.$_POST['nbB'].')=';
            echo pgcd($_POST['nbA'],$_POST['nbB']);
        }
    }
    ?>
</body>
</html>				
