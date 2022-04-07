<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $tel = trim($_POST["tel"]);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Por favor terminar de llenar el formulario";

            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "ventas@bienesraicescc.com";

        // Set the email subject.
        $subject = "Mensaje desde la Pagina de $name";

        // Build the email content.
        $email_content = "Nombre: $name\n";
        $email_content .= "Telefono: $tel\n\n";
        $email_content .= "Comentario:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo '   <!DOCTYPE html>
            <html lang="zxx">
            <head>
                <title>BRCC | Bienes Raices Corredor Comercial</title>
                 <script src="modules/js/sweetalert2.all.js"></script>
            </head>
            <body>

            <script>

                swal({

                    type: "success",
                    title: "¡Su mensaje se envió correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){

                        window.location = "../index.php";

                    }

                });


            </script>
        </body>
        </html>';
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo '
            <!DOCTYPE html>
            <html lang="zxx">
            <head>
                <title> BRCC | Bienes Raices Corredor Comercial</title>
                 <script src="modules/js/sweetalert2.all.js"></script>
            </head>
            <body>
            <script>

            swal({

                type: "error",
                title: "¡Tenemos problemas para enviar su correo, intente mas tarde o verifique su mensaje!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"

            }).then(function(result){

                if(result.value){

                    window.location = "contact.php";

                }

            });


        </script>
        </body>
        </html>';
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Tuvimos un error favor de intentarlo de nuevo";
    }

?>
