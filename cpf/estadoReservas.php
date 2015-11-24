<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta charset="ISO-8859-1">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=0.6, maximum-scale=2.0">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">

	<title>Reservas - Detalle </title>
	<link rel="stylesheet" type="text/css" href="datatables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="datatables/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="datatables/examples/resources/demo.css">
		<link rel="stylesheet" type="text/css" href="datatables/media/css/buttons.dataTables.min.css">
	<style type="text/css" class="init"></style>
  <style type="text/css"> .botonExcel{cursor:pointer;} </style>
  
  <script type="text/javascript" src="jquery-1.3.2.min.js"></script>   
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/examples/resources/demo.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/media/js/dataTables.buttons.min.js"></script>



  <script language="text/javascript">

  </script>

	
  <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
	    $('#example').DataTable();
    } );
           
  </script>
 
  <script type="text/javascript" language="javascript">
		  function consultar(){
        fechaDesde = document.getElementsByName('fechaDesde')[0].value;
        fechaDesde=fechaDesde.replace("-",'');
        fechaDesde=fechaDesde.replace("-",'');
        
     }
     
     function exportar(){
       // window.alert("asdf");
		    $("#datos_a_enviar").val( $("<div>").append( $("#example").eq(0).clone()).html());
		    $("#FormularioExportacion").submit();
    }
     
     function ajustarPagina(){
       window.parent.document.body.style.zoom="70%";
    }
     
  </script>

  
</head>

<body class="dt-example">

<section>  
 

			<h1>Reservas</h1>
      
<form onclick='return exportar()' action="ficheroExcel.php" method="post" target='_blank' id="FormularioExportacion">
<p>Exportar a Excel  <img src="export_to_excel.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" /> </form>      
         
<!--p><form onsubmit='return consultar()'>
<p>
  Fecha Desde: <input type="date" id="fechaDesde" name="fechaDesde" value="<?php echo date('Y-m-d');?>" autofocus required />
        Hasta: <input type="date" id="fechaHasta" name="fechaHasta" value="<?php echo date('Y-m-d');?>" autofocus required />
  <br><br>
  <input type="submit" value="Consultar"  />
  <br><br><br-->

<?php
include_once('functions.php');
header("Content-Type: text/html; charset=iso-8859-1"); 

/*
 $fechaDesde=$_GET['fechaDesde'];
 $fechaHastaI=$_GET['fechaHasta'];
 $fechaHasta = date('Y-m-d', strtotime("$fechaHastaI + 1 day"));


echo "<p> Resultados desde: ".$fechaDesde." hasta: ".$fechaHastaI."<p>";
*/

#if ($_GET['fechaDesde']!==null){

//if ($fechaDesde!==null){
    
 $conexion=mysql_connect("localhost","root","italia1") or die("Error de conexion.");
 mysql_select_db('phpmyreservation',$conexion) or die("Error de seleccion de base de datos.");
   
$registros = mysql_query("
SELECT reservation_id, reservation_user_name, A.nombre as nombre,
reservation_year, reservation_week, reservation_time, reservation_day,
reservation_user_email, reservation_made_time
FROM phpmyreservation_reservations R, alumnos A
where R.reservation_user_name=A.numero 
and reservation_user_name !='.'
and reservation_user_name !='cpf'
order by reservation_user_name")
or die('<span class="error_span"><u>MySQL error:</u> ' . htmlspecialchars(mysql_error()) . '</span>');
 
  echo "<table id='example' class='display' cellspacing='0' width='100%'>";
 
 echo "<thead><tr>";
   echo "<th>Nro Reserva</th>
   <th>Nro Alumno</th>
   <th>Alumno</th>
   <th>Turno</th>  
   <th>Sector</th>
   <th>Fila</th>
   <th>Asiento</th>
   <th>Email</th>
   <th>Fecha</th>";
 echo "</tr></thead>";
 
 echo "<tbody font size='1'>";

/* 
// conversion a numero de asiento correcto

function mapeaAsiento($sector, $asientoC){

	switch($sector){
		case 1:
			$sec=array(33,31,29,27,25,23,21,19,17,15,13);
			break;
		case 2:
			$sec=array(11,9,7,5,3,1,2,4,6,8,10);
			break;
		case 3:
			$sec=array(12,14,16,18,20,22,24,26,28,30,32);
			break;
		case 4:
			$sec=array(33,31,29,27,25,23,21,19,17,15);
			break;
		case 5:
			$sec=array(13,11,9,7,5,3,1,2,4,6,8,10,12);
			break;
		case 6:
			$sec=array(14,16,18,20,22,24,26,28,30,32);
			break;
		case 7:
			$sec=array(31,29,27,25,23,21,19,17,15,13,11);
			break;
		case 8:
			$sec=array(9,7,5,3,1,2,4,6,8,10);
			break;
		case 9:
			$sec=array(12,14,16,18,20,22,24,26,28,30,32);
			break;																					
	}
    $asientoN=$sec[$asientoC-1];
	return $asientoN;
}
 */ 
    
   while ($reg=mysql_fetch_array($registros))
   {
     echo '<tr>';
       echo '<td>'.$reg['reservation_id'].'</td>';     
	   echo '<td>'.$reg['reservation_user_name'].'</td>';	
       echo '<td>'.$reg['nombre'].'</td>';
       echo '<td>'.$reg['reservation_year'].'</td>';  	   
       echo '<td>'.$reg['reservation_week'].'</td>';       
       echo '<td>'.$reg['reservation_time'].'</td>';
       echo '<td>'.mapeaAsiento($reg['reservation_week'],$reg['reservation_day']).'</td>';
       echo '<td>'.$reg['reservation_user_email'].'</td>';
       echo '<td>'.$reg['reservation_made_time'].'</td>';	      
     echo '</tr>';
   }  

 
 echo "</tbody></table>";
 
 
 mssql_close($conexion);
 
//} 
 
?>


</section>

<script type="text/javascript" language="javascript">
    ajustarPagina();
</script>
  
</body>
</html>
