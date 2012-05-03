<?php session_start();
include('../includes/dbconnect.php'); 
 
 $db = new dbconnect();
 $dbc = $db->getConnection();
function quitar($mensaje)
{
    $nopermitidos = array("'",'\\','<','>',"\"");
    $mensaje = str_replace($nopermitidos, "", $mensaje);
    return $mensaje;
}     
 
if(trim($_POST["email"]) != "" && trim($_POST["password"]) != "")
{
    // o puedes convertir los a su entidad HTML aplicable con htmlentities
    $email = strtolower(htmlentities($_POST["email"], ENT_QUOTES));   
    $password = $_POST["password"];
    $result = $dbc->query('SELECT Contrasena, Email, UsuarioId, PermisosId FROM usuario WHERE Email=\''.$email.'\' AND Activo IS NULL AND PermisosId != "3"');
    if($row = $result->fetch_array()){
        
        if($row["Contrasena"] == $password){
 
            $_SESSION["k_email"] = $row['Email'];
            $_SESSION["k_userid"] = $row['UsuarioId'];
            $_SESSION["k_permisosid"] = $row['PermisosId'];
            echo  $_SESSION["k_userid"];
            echo '-success';
 
        }else{
            echo 'Password incorrecto';
        }
    }else{
        echo 'Usuario no existente en la base de datos';
    }
}else{
    echo 'Debe especificar un usuario y password';
}
?>