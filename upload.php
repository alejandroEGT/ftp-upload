<?php

// Obtener el nombre temporal del archivo
$archivoTemporal = $_FILES['doc']['tmp_name'];

// Verificar si el archivo ha sido subido mediante un formulario
if (is_uploaded_file($archivoTemporal)) {
    echo "El archivo ha sido subido correctamente a la ubicación temporal.<br>";

    // Definir la ubicación final del archivo
    $ubicacionFinal = 'uploads/' . basename($_FILES['doc']['name']);

    // Verificar si el directorio 'uploads' existe, si no, crearlo
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);  // Crear el directorio con permisos 777
        echo "El directorio 'uploads' fue creado.<br>";
    }

    // Mover el archivo desde la ubicación temporal a la final
    if (move_uploaded_file($archivoTemporal, $ubicacionFinal)) {
        echo "El archivo se ha movido correctamente a la ubicación final.";
    } else {
        echo "Error al mover el archivo a la ubicación final.";
    }
} else {
    echo "El archivo no ha sido subido correctamente.";
}


// Ruta del directorio temporal (puede ser diferente dependiendo de tu configuración de PHP)
$directorio = sys_get_temp_dir();  // Obtiene la ruta del directorio temporal del sistema

// Obtener los permisos del directorio
$permisos = fileperms($directorio);

// Verificar si se pudo obtener los permisos
if ($permisos === false) {
    echo "No se pudieron obtener los permisos para el directorio: $directorio";
} else {
    // Convertir los permisos en un formato legible (octal)
    echo "Permisos del directorio $directorio: " . substr(decoct($permisos), -4) . "\n";

    // Interpretar los permisos de forma más detallada
    echo "Permisos en formato octal: " . decoct($permisos) . "\n";
    
    // También podemos determinar si tiene permisos de lectura, escritura y ejecución:
    if (($permisos & 0x0100) != 0) {
        echo "El directorio tiene permiso de escritura para el propietario.\n";
    } else {
        echo "El directorio NO tiene permiso de escritura para el propietario.\n";
    }

    if (($permisos & 0x0040) != 0) {
        echo "El directorio tiene permiso de lectura para el propietario.\n";
    } else {
        echo "El directorio NO tiene permiso de lectura para el propietario.\n";
    }
    
    if (($permisos & 0x0800) != 0) {
        echo "El directorio tiene permiso de ejecución para el propietario.\n";
    } else {
        echo "El directorio NO tiene permiso de ejecución para el propietario.\n";
    }
}

?>