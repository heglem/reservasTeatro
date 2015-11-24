<?php

include_once('main.php');

if(check_login() != true) { exit; }

/*
echo"<table border=1 align=center><tr>";
echo"<td align=center><img src='img/s1.png' alt='Sector 1'></td>";
echo"<td align=center><img src='img/s2.png' alt='Sector 2'></td>";
echo"<td align=center><img src='img/s3.png' alt='Sector 3'></td>";
echo"</tr><tr>";
echo"<td align=center><img src='img/s4.png' alt='Sector 4'></td>";
echo"<td align=center><img src='img/s5.png' alt='Sector 5'></td>";
echo"<td align=center><img src='img/s6.png' alt='Sector 6'></td>";
echo"</tr><tr>";
echo"<td align=center><img src='img/s7.png' alt='Sector 7'></td>";
echo"<td align=center><img src='img/s8.png' alt='Sector 8'></td>";
echo"<td align=center><img src='img/s9.png' alt='Sector 9'></td>";
echo"</tr></table>";
*/

?>

<script>
function seleccion(opcion){
	window.alert(opcion);
}
</script>

<table border=1 align=center><tr>
<td align=center><img src='img/s1.png' alt='Sector 1' onclick='seleccion(1)' width=200 height=400></td>
<td align=center><img src='img/s2.png' alt='Sector 2' onclick='seleccion(2)' width=200 height=400></td>
<td align=center><img src='img/s3.png' alt='Sector 3' onclick='seleccion(3)' width=200 height=400></td>
</tr><tr>
<td align=center><img src='img/s4.png' alt='Sector 4' onclick='seleccion(4)' width=200 height=100></td>
<td align=center><img src='img/s5.png' alt='Sector 5' onclick='seleccion(5)' width=200 height=100></td>
<td align=center><img src='img/s6.png' alt='Sector 6' onclick='seleccion(6)' width=200 height=100></td>
</tr><tr>
<td align=center><img src='img/s7.png' alt='Sector 7' onclick='seleccion(7)' width=200 height=100></td>
<td align=center><img src='img/s8.png' alt='Sector 8' onclick='seleccion(8)' width=200 height=100></td>
<td align=center><img src='img/s9.png' alt='Sector 9' onclick='seleccion(9)' width=200 height=100></td>
</tr></table>