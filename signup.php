<?php //signup.php
    require_once 'conexion.php';


    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
        $apellido = mysql_entities_fix_string($conexion, $_POST['apellido']);
        $username = mysql_entities_fix_string($conexion, $_POST['username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

     if($nombre=="" || $apellido=="" || $username=="" || $pw_temp=="")
      {
         echo "<b><FONT COLOR=red>ERROR...Registre todos los campos!</FONT></b>";

         echo " <br><a href='signup.php'>Regresar</a>";   
      }
      else{

        $query = "INSERT INTO usuarios 
            VALUES( null,'$nombre','$apellido','$username', '$password')";

        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        echo "Registro exitoso <a href='index.php'>Ingresar</a>";
        
    }
     }
  else
    {
        echo <<<_END
        <center><h1>Regístrate</h1>
        <img src="iconoregistro.png"  width="120" height="100">
        <form action="signup.php" method="post"><pre>
        Nombre   <input type="text" name="nombre"><br>
        Apellido <input type="text" name="apellido"><br>
        Usuario  <input type="text" name="username"><br>
        Password <input type="text" name="password"><br>
                 <input type="hidden" name="reg" value="yes">
                 <input style="border: #000 1px solid;background-color: #2980B9" type="submit" value="Enviar"><br>
                 <a href='index.php'>Regresar</a>   
        </form>
        </center>
        _END;
    }
    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        //if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }   
?>