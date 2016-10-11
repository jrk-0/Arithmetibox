<?php require('debut.php'); ?>
<form action='Arithmetibox.php?outil=cesa' method='post'>
Alphabet : <input size='50' name='alphabet' type='text' value='ABCDEFGHIJKLMNOPQRSTUVWXYZ'><br>

Paquet : &nbsp;&nbsp;&nbsp;&nbsp;<input size='50' name='paquet' type='text'><br>
Clef (optionnel) :&nbsp;<input size='43' name='clef' type='text'><br>
<p>Message : &nbsp;&nbsp;&nbsp;</p><textarea name='message'></textarea><br>

<input type='submit' value='Déchiffrer'  class="boutton">
</form>
<?php
    $nbcarac=strlen($_POST['alphabet'])-1;
    if(preg_match('#([0-9]*)(\-|\,|\.)([0-9]*)#',$_POST['message'])){
        preg_match('#([0-9]*)(\-|\,|\.)([0-9]*)#',$_POST['message'],$caract);
        $Amess = explode($caract[2], $_POST['message']);
    }
    
    
    
    $paquet = $_POST['paquet'];
    $mod = 0;
    for($i=0 ; $i<$paquet ; $i++) $mod = 100*$mod + $nbcarac;
    $mod=$mod+1;
    
    //$mod = 25252526
    if($_POST['paquet']!='' and $_POST['message']!=''){
        if($_POST['clef']==''){
            
            for($clef = 0 ; $clef<$mod ; $clef++){
                $test = true;
                $decrypt = "";
                //11h41
                foreach($Amess as $x){
                    $y=(int)$x-$clef;
                    $y=$y%$mod;
                    if($y<0) $y=$y+$mod;
                    
                    $Y=array();
                    for($i=0 ; $i<$paquet and $test==true; $i++){
                        $Y[$i] = $y%100;
                        $y=($y - $Y[$i])/100;
                        
                        if($Y[$i]>$nbcarac) {
                            $test=false;
                            break;
                        }
                        
                        
                    }//Fin for sur les paquet
                    if($test==false) break;
                    $Y=array_reverse($Y);
                    foreach($Y as $c => $v){
                        $decrypt = $decrypt.$_POST['alphabet'][$Y[$c]];
                    }
                }
                if($test==false) continue;
                
                echo $clef." : <br>".$decrypt."<br>";
                
            }
        }
        elseif($_POST['clef']>=0 and $_POST['clef']<$mod){
            
            $test = true;
            $decrypt = "";
            //11h41
            foreach($Amess as $x){
                $y=(int)$x-$_POST['clef'];
                $y=$y%$mod;
                if($y<0) $y=$y+$mod;
                
                $Y=array();
                for($i=0 ; $i<$paquet and $test==true; $i++){
                    $Y[$i] = $y%100;
                    $y=($y - $Y[$i])/100;
                    
                    if($Y[$i]>$nbcarac) {
                        $test=false;
                        echo "clef incorrecte";
                        break;
                    }
                    
                }//Fin for sur les paquet
                if($test==false) break;
                $Y=array_reverse($Y);
                foreach($Y as $c => $v){
                    $decrypt = $decrypt.$_POST['alphabet'][$Y[$c]];
                }
            }
            if($test!=false)
                echo $_POST['clef']." : <br>".$decrypt."<br>";
        }
    }
    
    
    
    
    //Fin du for sur les clefs
    ?>
</body>
</html> 