<?php

echo "hola mundo";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="">Subir doc</label>
        <input type="file" name="doc" id="doc">

        <button type="submit">enviar</button>
    </form>
</body>
</html>