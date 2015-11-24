<?php

include_once('main.php');

if(check_login() != true) { exit; }

if(isset($_GET['make_reservation']))
{
	$year = datosAlumno();
	$year = $year[1];
	$week = mysql_real_escape_string($_POST['week']);
	$day = mysql_real_escape_string($_POST['day']);
	$time = mysql_real_escape_string($_POST['time']);
	echo make_reservation($year, $week, $day, $time);
}
elseif(isset($_GET['delete_reservation']))
{
	$year = datosAlumno();
	$year = $year[1];	
	$week = mysql_real_escape_string($_POST['week']);
	$day = mysql_real_escape_string($_POST['day']);
	$time = mysql_real_escape_string($_POST['time']);
	echo delete_reservation($year, $week, $day, $time);
}
elseif(isset($_GET['read_reservation']))
{
	$year = datosAlumno();
	$year = $year[1];	
	$week = mysql_real_escape_string($_POST['week']);
	$day = mysql_real_escape_string($_POST['day']);
	$time = mysql_real_escape_string($_POST['time']);
	echo read_reservation($year, $week, $day, $time);
}
elseif(isset($_GET['read_reservation_details']))
{
	$year = datosAlumno();
	$year = $year[1];	
	$week = mysql_real_escape_string($_POST['week']);
	$day = mysql_real_escape_string($_POST['day']);
	$time = mysql_real_escape_string($_POST['time']);
	echo read_reservation_details($year, $week, $day, $time);
}
elseif(isset($_GET['week']))
{

/*
echo"<script>
function seleccion(week){
		page_load('week');
		div_hide('#reservation_table_div');

		$.get('reservation.php?week='+week, function(data)
		{
			$('#reservation_table_div').html(data);
			$('#week_number_span').html(week);
			div_fadein('#reservation_table_div');
			page_loaded('week');

			if(week != global_week_number)
			{
				$('#reservation_today_button').css('visibility', 'visible');
			}

			if(week == 'today')
			{
				setTimeout(function() { $('#today_span').animate({ opacity: 0 }, 250, function() { $('#today_span').animate({ opacity: 1 }, 250);  }); }, 500);
			}
		});
	
	
}
</script>";

 * 
 */
 
$nom=datosAlumno();
$year=$nom[1];
echo "Alumno: <b>".$nom[0]."</b><br>";
echo "Turno:  <b>".$year."</b><br>";

$res=reservasAlumno();
echo $res;


		
echo"<table border=1 align=center><tr bgcolor='#ffff00'>
<td align=center><img src='img/s1.png' alt='Sector 1' onclick='seleccion(1)' width=100 height=200></td>
<td align=center><img src='img/s2.png' alt='Sector 2' onclick='seleccion(2)' width=100 height=200></td>
<td align=center><img src='img/s3.png' alt='Sector 3' onclick='seleccion(3)' width=100 height=200></td>
</tr><tr></tr><tr bgcolor='#00ff00'>
<td align=center><img src='img/s4.png' alt='Sector 4' onclick='seleccion(4)' width=100 height=50></td>
<td align=center><img src='img/s5.png' alt='Sector 5' onclick='seleccion(5)' width=100 height=50></td>
<td align=center><img src='img/s6.png' alt='Sector 6' onclick='seleccion(6)' width=100 height=50></td>
</tr><tr bgcolor='#00ff00'>
<td align=center><img src='img/s7.png' alt='Sector 7' onclick='seleccion(7)' width=100 height=50></td>
<td align=center><img src='img/s8.png' alt='Sector 8' onclick='seleccion(8)' width=100 height=50></td>
<td align=center><img src='img/s9.png' alt='Sector 9' onclick='seleccion(9)' width=100 height=50></td>
</tr></table>";		
			
	$week = $_GET['week'];
	
	echo '<table id="reservation_table"><colgroup span="1" id="reservation_time_colgroup"></colgroup><colgroup span="11" id="reservation_day_colgroup"></colgroup>';

	
	switch($week){
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
	
		
	$days_row = '<tr align=center><td id="reservation_corner_td">
	<input type="button" class="blue_button small_button" id="reservation_today_button" value="Inicio"></td>';
	$str='';
	
	foreach($sec as $i){
		$str.="<th class='reservation_day_th'>".$i."</th>";
	}
	
	$days_row.=$str.'</tr>';

	if($week == global_week_number)
	{
		echo highlight_day($days_row);
	}
	else
	{
		echo $days_row;
	}

	foreach($global_times as $time)
	{
		echo '<tr><th class="reservation_time_th">' . $time . '</th>';

		$i = 0;

		while($i < 13)
		{
			$i++;

			$celda=read_reservation($year, $week, $i, $time); 
			if($celda=='.'){
				echo '<td><div>
				<div id="div:' . $week . ':' . $i . ':' . $time . '"></div></div></td>';
			}else{
				if($celda!=''){
					echo '<td bgcolor="#CCECFB">';
				}else{
					echo '<td>';
				}
				echo'<div class="reservation_time_div">
				<div class="reservation_time_cell_div" id="div:' . $week . ':' . $i . ':' . $time . '" onclick="void(0)">' . read_reservation($year, $week, $i, $time) . '</div></div></td>';
				
			}
		}

		echo '</tr>';
	}

	echo '</table>';
}
else
{
	echo '</div>
	<div class="box_div" id="reservation_div">
	<div class="box_top_div" id="reservation_top_div">
	<div id="reservation_top_left_div"><a href="." id="previous_week_a">&lt; Sector anterior</a></div>
	<div id="reservation_top_center_div">Reservacion Sector <span id="week_number_span">' . global_week_number . '</span></div>
	<div id="reservation_top_right_div"><a href="." id="next_week_a">Sector siguiente &gt;</a></div></div>
	<div class="box_body_div"><div id="reservation_table_div"></div>
	</div></div><div id="reservation_details_div">';
}

?>
