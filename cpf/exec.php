
<?php 
  echo '<html><head>';
  echo '<link rel="stylesheet" href="style/style.css"></head>';
  
  $pOrigen="<a href=http://lnx-01/busquedaDocs.html>Volver</a><p>";   
  $ruta=$_GET['ruta'];
  $str=$_GET['strB'];
  
  echo $pOrigen;
  
  $par='grep -lirn '.$str.' '.$ruta; 

    
  exec($par,$salida);
  echo "<table border=1>";
  foreach($salida as $line) { 
    
    $line = str_replace("/mnt/fs01", "U:", $line);
    
    $bus='/';
    
   $x=strripos($line,$bus);
  # echo"x: $x __ ";
   
   $lineV=substr($line, $x+1);
    
    echo "<tr><td><a href=$line>$lineV</a></td></tr>"; 
    
  }
    
  echo "</table>"; 
  echo '</html>';
?>

