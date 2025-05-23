<?php
require_once __DIR__ . '/../../models/Contacto.php';
// PHPMailer manual include
require_once __DIR__ . '/../../phpmailer/Exception.php';
require_once __DIR__ . '/../../phpmailer/PHPMailer.php';
require_once __DIR__ . '/../../phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

class recuperarcuentacontroller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo'])) {
            $correo = $_POST['correo'];
            $contacto = new Contacto();
            $usuario = $contacto->buscarcorreo($correo);

            if ($usuario) {
                // Solo si el usuario existe en la BD se envía el correo
                $nombreDeUsuario = $usuario['username'];
                // Generar token y expiración (1 hora)
                $token = bin2hex(random_bytes(32));
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $created_at = date('Y-m-d H:i:s');
                // Guardar en password_resets
                $contacto->guardarTokenRecuperacion($correo, $token, $expires_at, $created_at);

                // Enviar correo con PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'rafaelalex6949@gmail.com';
                    $mail->Password = 'fcwb ploz ktld aqce';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 587;

                    $mail->setFrom('rafaelalex6949@gmail.com', 'Boutique Orange');
                    $mail->addAddress($correo);

                    // HTML personalizado
                    $resetLink = "http://{$_SERVER['HTTP_HOST']}/BoutiqueOrange/index.php?view=recuperarcuenta&token=$token";
                    $htmlContent = <<<HTML
                        <!DOCTYPE html>
                        <html lang="es">
                        <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <style>
                        body, html {
                            margin: 0;
                            padding: 0;
                            font-family: 'Arial', sans-serif;
                        }
                        .container {
                            width: 100%;
                            max-width: 600px;
                            margin: auto;
                            background-color: #fff;
                            color: #333;
                            border: 1px solid #ddd;
                        }
                        .header {
                            background-color: #ea580c;
                            color: #fff;
                            padding: 10px;
                        }
                        .main-content {
                            padding: 20px;
                        }
                        .footer {
                            background-color: #ea580c;
                            color: #fff;
                            text-align: center;
                            padding: 10px;
                            font-size: 12px;
                        }
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            margin: 10px 0;
                            background-color: #ea580c;
                            color: #fff;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                        img {
                            max-width: 100%;
                            height: 100px;
                            width: 100px;
                        }
                        </style>
                        </head>
                        <body>
                        <div class="container">
                            <div class="header">
                                <h1>Boutique Orange</h1>
                            </div>
                            <div class="main-content">
                                <h2>Restablecer Contraseña</h2>
                                <p>Hola $nombreDeUsuario,<br>Hemos recibido una solicitud para restablecer tu contraseña.<br><br>
                                Haz clic en el botón de abajo para continuar.<br><br>
                                <a href="$resetLink" class="button">Restablecer Contraseña</a><br><br>
                                Si no solicitaste este cambio, puedes ignorar este correo.<br>Saludos,<br>Boutique Orange.</p>
                            </div>
                            <div class="footer">
                                <p>Copyright © 2024 Boutique Orange.</p>
                            </div>
                        </div>
                        </body>
                        </html>
                    HTML;

                    $mail->isHTML(true);
                    $mail->Subject = 'Restablece tu contraseña - Boutique Orange';
                    $mail->Body = $htmlContent;
                    $mail->send();
                    echo "<script>alert('Correo de recuperación enviado.'); window.location.href = window.location.pathname;</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href = window.location.pathname;</script>";
                }
            } else {
                // Si el correo no está registrado, muestra alerta y NO envía correo
                echo "<script>alert('Correo no encontrado.'); window.location.href = window.location.pathname;</script>";
            }
        } elseif (isset($_GET['token'])) {
            // Validar token
            $token = $_GET['token'];
            $contacto = new Contacto();
            $reset = $contacto->obtenerResetPorToken($token);
            if ($reset && strtotime($reset['expires_at']) > time()) {
                // Token válido, mostrar formulario para nueva contraseña
                require __DIR__ . '/../../views/viewslogin/newpassword.php';
            } else {
                // Token inválido o expirado
                echo "<script>alert('Token inválido o expirado.'); window.location.href = '/BoutiqueOrange/index.php?view=home';</script>";
            }
        } else {
            require_once __DIR__ . '/../../views/viewslogin/recuperarcuenta.php';
        }
    }

    public function actualizarPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['password'])) {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $contacto = new Contacto();
            $reset = $contacto->obtenerResetPorToken($token);
            if ($reset && strtotime($reset['expires_at']) > time()) {
                // Actualizar contraseña
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $contacto->actualizarPasswordPorCorreo($reset['email'], $hash);
                // Eliminar el token usado
                $contacto->eliminarToken($token);
                echo "<script>alert('Contraseña actualizada correctamente.'); window.location.href = '/BoutiqueOrange/index.php?view=login';</script>";
            } else {
                echo "<script>alert('Token inválido o expirado.'); window.location.href = '/BoutiqueOrange/index.php?view=home';</script>";
            }
        }
    }
}