<?php
include('db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/* Exception 7class. */
//Para usar en Windows descomenten la línea de abajo (Línea 9) y comenten la línea de Linux (Línea 11)
// require 'C:\xampp\htdocs\PTCes\Backend\Exception.php';
//Linux
require '/var/www/html/PTCes/Backend/Exception.php';

/* The main PHPMailer class. */
//Para usar en Windows descomenten la línea de abajo (Línea 14) y comenten la línea de Linux (Línea 15)
// require 'C:\xampp\htdocs\PTCes\Backend\PHPMailer.php';
require '/var/www/html/PTCes/Backend/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
//Para usar en Windows descomenten la línea de abajo (Línea 20) y comenten la línea de Linux (Línea 21)
// require 'C:\xampp\htdocs\PTCes\Backend\SMTP.php';
require '/var/www/html/PTCes/Backend/SMTP.php';
if (isset($_POST['email'])) {

    //Configuración del envío de corre Pt. 1 
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server    
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "trips.sv2020@gmail.com"; // GMAIL username
    $mail->Password = "tripssv2020"; // GMAIL password
    $email_from = "trips.sv2020@gmail.com";
    $name_from = "Trips SV";

    
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
   
    $query = "SELECT * from usuarios where correo = '$email'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)>0){

    //Creación de token
    $token = openssl_random_pseudo_bytes(16); //crea una cadena aleatoria de bits
    $token = bin2hex($token); //convierte la cadena anterior en sistema hexadecimal
    
    //almacenar el token
    $ObtainUser = mysqli_fetch_array($result);
    $username = $ObtainUser["usuario"];
    
    $saveTokenInfo = "INSERT into pwdrecovery (Token, used, email, username, Timestamp) VALUES('$token', false, '$email', '$username', NOW())";
    $insertTokenInfo = mysqli_query($connection, $saveTokenInfo);
    //Configuración del envío de corre Pt. 2
    $mail->AddAddress($email, "");
    $mail->SetFrom($email_from, $name_from);
    $mail->Subject = utf8_decode("Recuperación de contraseña");
    $mail->Body = "
        <h3>Hola, $username. Haga click en el siguiente enlace para completar el formulario de recuperación de contraseña</h3>
        <a href='http://978cfbe72bc2.ngrok.io/PTCes/formRecuperar.php?account=$token'>Recuperar contraseña </a>
        <br>
        Si usted no solicitó este cambio de contraseña, por favor ignórelo.
    
    ";
    $mail->IsHTML(true);
    try {
        $mail->Send();
        // echo "Success! $result";
        echo("Se le ha enviado un correo.");
    } catch (Exception $e) {
        //Something went bad
        echo "Fail - ";
    }
    }else {
    echo "Lo sentimos, no encontramos ninguna cuenta asociada a este correo.";
}
}else
{
    echo "Esta no es una dirección de correo válida.";
}
}else{
    echo "No se ingresó una dirección de correo.";
}
?>
