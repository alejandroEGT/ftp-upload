<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Documento</title>
</head>
<body>
    <label for="doc">Subir documento:</label>
    <input type="file" id="doc" name="doc">
    <button id="btnEnviar">Enviar</button>

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#btnEnviar").click(function() {
                var form = new FormData();  // Crear un nuevo objeto FormData

                // Verificar si el usuario seleccionó un archivo
                if ($("#doc")[0].files.length > 0) {
                    // Agregar el archivo al objeto FormData
                    form.append("doc", $("#doc")[0].files[0]);
                    form.append("usuario", "alejandro");

                    // Realizar la solicitud AJAX
                    $.ajax({
                        url: 'upload.php',  // URL donde se enviarán los datos
                        type: 'POST',  // Método de envío
                        data: form,
                        dataType: 'json', // Esperar una respuesta en JSON
                        processData: false,  // No procesar los datos
                        contentType: false,  // No establecer tipo de contenido (esto es importante cuando se suben archivos)
                        success: function(response) {
                            // Si la respuesta del servidor es exitosa
                            if (response.status === 'success') {
                                alert("Archivo subido con éxito.");
                            } else {
                                // Mostrar el mensaje de error si la respuesta no es 'success'
                                alert("Error: " + response.message);
                            }
                        },
                        error: function(err) {
                            // Si ocurre un error en la solicitud AJAX
                            console.log(err);
                            alert("Hubo un error al enviar los datos. Intenta nuevamente.");
                        }
                    });
                } else {
                    alert("Por favor, selecciona un archivo.");
                }
            });
        });
    </script>
</body>
</html>