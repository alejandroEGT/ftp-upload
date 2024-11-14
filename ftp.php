<?php

if (isset($_POST['submit'])) {
    // Verificar si hubo un error en la carga del archivo
    if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        // Ruta temporal del archivo en el servidor
        $tmpFilePath = $_FILES['pdf']['tmp_name'];
        $fileName = $_FILES['pdf']['name'];

        // Detalles del servidor FTP remoto
        $ftpServer = "ftp.tuservidor.com";  // Reemplaza con la IP o dominio de tu servidor FTP
        $ftpUsername = "usuarioFTP";         // Reemplaza con tu nombre de usuario FTP
        $ftpPassword = "contraseñaFTP";      // Reemplaza con tu contraseña FTP
        $ftpRemoteDir = "/ruta/remota/";     // Directorio remoto donde se guardará el archivo

        // Conectar al servidor FTP
        $ftpConnection = ftp_connect($ftpServer);
        if ($ftpConnection) {
            // Iniciar sesión en el servidor FTP
            $ftpLogin = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);

            if ($ftpLogin) {
                // Cambiar al directorio remoto
                ftp_chdir($ftpConnection, $ftpRemoteDir);

                // Subir el archivo al servidor FTP usando la ruta temporal
                $uploadSuccess = ftp_put($ftpConnection, $ftpRemoteDir . $fileName, $tmpFilePath, FTP_BINARY);

                if ($uploadSuccess) {
                    echo "El archivo se ha subido correctamente al servidor remoto.<br>";
                } else {
                    echo "Error al subir el archivo al servidor remoto.<br>";
                }

                // Cerrar la conexión FTP
                ftp_close($ftpConnection);
            } else {
                echo "Error al iniciar sesión en el servidor FTP.<br>";
            }
        } else {
            echo "No se pudo conectar al servidor FTP.<br>";
        }
    } else {
        echo "Error al cargar el archivo.<br>";
    }
}
?>