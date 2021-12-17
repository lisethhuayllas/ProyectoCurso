<?php include("conexion.php");

session_start();

$id_usuario =$_SESSION['id_usuario'];

$sql = "SELECT id_usuario, nombre FROM usuarios WHERE id_usuario = '$id_usuario' ";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mostrar tareas</title>
</head>
<body>



<h2>Tareas Agendadas </h2>
<table border="1" cellspacing="0" cellpadding="3" >
<thead>
	<tr>
		<th><b>Nombre Curso</b></th>
        <th><b>Contenido</b></th>
        <th><b>Fecha_de Registro</b></th>
        <th><b>Fecha de Vencimiento</b></th>
        <th><b>Estado Tarea</b></th>
        <th><b>Opciones</b></th>
        <th><b>Prioridad</b></th>
        
    </tr>
</thead>
<tbody>

<?php
$query="SELECT *FROM tareas WHERE id_usuario=$id_usuario ORDER BY fecha_vencimiento ASC";
$result = mysqli_query($conexion, $query);

while($row = mysqli_fetch_array($result)){ ?>

   <tr>
	   <td><?php echo $row['nombre'] ?></td>
	   <td><?php echo $row['contenido'] ?></td>
	   <td><?php echo $row['fecha_registro'] ?></td>
	   <td><?php echo $row['fecha_vencimiento'] ?></td>
	   <td><?php echo $row['estado'] ?></td>


	   <td>
	   <a href="eliminar.php?id=<?php echo  $row['id']?>">🗑️Eliminar</a>
	   </td>

	   <td>

		<?php
      $fechaactual=date('Y-m-d');
		if($row['fecha_vencimiento'] < $fechaactual and ($row['estado']=='en proceso' or $row['estado']=='' ))

		  { echo "<b><FONT COLOR=red>Vencido</FONT></b>(no puedes editar esta tarea)"; }

		else if($row['estado']=='terminado')

		  { echo "<b><FONT COLOR=blue>Terminado</FONT></b>";}

        else {
         $firstDate  = new DateTime($row['fecha_vencimiento']);
         $secondDate = new DateTime($fechaactual);
         $diferencia = $firstDate->diff($secondDate);
         echo "<b><FONT COLOR=green>Quedan ".$diferencia->d." dias</FONT></b>"; 
         ?>
         <a href="modificar.php?id=<?php echo  $row['id']?>">✍Editar</a><br>

         <?php } ?>
       </td>
   </tr>

<?php } ?>

</tbody>	
</table>

 <a href="continue.php">Regresar</a> 
</body>
</html>