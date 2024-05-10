<?php
session_start();

$servidor = "localhost";
$usuario = "ADMINPM";
$contraseña = "Pr0yect0#Interm0dul4r";
$base_de_datos = "intermodular definitivo2";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if (!isset($_SESSION['usuarioID'])) {
    // Si no se ha iniciado sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: ../iniciosesion/login.php");
    exit();
}

// Obtener el ID del usuario de la sesión
$usuarioID = $_SESSION['usuarioID'];

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha ingresado un nombre de usuario
    if (!empty($_POST["nombre_usuario"])) {
        // Guardar el nombre de usuario
        $nombreUsuario = $_POST["nombre_usuario"];

        // Verificar si se ha cargado un archivo
        if ($_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES["archivo"]["name"];
            $tempArchivo = $_FILES["archivo"]["tmp_name"];

            // Validar tipo de archivo (solo PDF)
            $permitido = 'pdf';
            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            if ($extension !== $permitido) {
                echo "Error: Solo se permiten archivos PDF.";
                exit();
            }

            // Definir el directorio de destino para cargar archivos
            $directorioDestino = "C:/xampp/htdocs/uploadapuntesUAX/";

            // Generar un nombre de archivo único
            $nombreArchivoUnico = uniqid() . "_" . $nombreArchivo;

            // Guardar el archivo en el directorio de destino
            $rutaArchivo = $directorioDestino . $nombreArchivoUnico;
            if (move_uploaded_file($tempArchivo, $rutaArchivo)) {
                // Verificar si se ha seleccionado un programa
                if (!empty($_POST["nombreProg"])) {
                    // Guardar el programa seleccionado
                    $programa = $_POST["nombreProg"];

                    // Verificar si se ha ingresado un nombre de estudio
                    if (!empty($_POST["tipoEstudio"])) {
                        // Guardar el nombre del estudio
                        $nombreEstudio = $_POST["tipoEstudio"];

                        // Obtener el ID de la asignatura
                        $asignaturaID = obtenerAsignaturaID($conexion, $programa, $nombreEstudio);

                        // Verificar si se obtuvo el ID de la asignatura
                        if ($asignaturaID !== null) {
                            // Consulta SQL para insertar el registro en la base de datos
                            $sql = "INSERT INTO documentos (usuarioID, nombre_usuario, rutaArchivo, asignaturaID) VALUES (?, ?, ?, ?)";

                            // Preparar la consulta
                            $statement = $conexion->prepare($sql);

                            // Verificar si la preparación de la consulta fue exitosa
                            if ($statement) {
                                // Enlazar los parámetros
                                $statement->bind_param("isss", $usuarioID, $nombreUsuario, $rutaArchivo, $asignaturaID);

                                // Ejecutar la consulta
                                if ($statement->execute()) {
                                    echo "El archivo se ha subido y registrado correctamente.";
                                } else {
                                    echo "Error al ejecutar la consulta: " . $statement->error;
                                }

                                // Cerrar la consulta
                                $statement->close();
                            } else {
                                echo "Error en la preparación de la consulta: " . $conexion->error;
                            }
                        } else {
                            echo "Error: No se pudo encontrar la asignatura.";
                        }
                    } else {
                        echo "Por favor, ingrese el nombre del estudio.";
                    }
                } else {
                    echo "Por favor, seleccione un programa.";
                }
            } else {
                echo "Error al mover el archivo al directorio de destino.";
            }
        } else {
            echo "Por favor, seleccione un archivo.";
        }
    } else {
        echo "Por favor, ingrese el nombre de usuario.";
    }
}

// Función para obtener el ID de la asignatura basado en el programa y el nombre del estudio
function obtenerAsignaturaID($conexion, $programa, $nombreEstudio)
{
    // Consulta SQL para obtener el ID de la asignatura
    $sql = "SELECT asignaturaID FROM asignaturastabla WHERE programaID IN (SELECT programaID FROM programas WHERE nombreProg = ?) AND nombreAs = ?";

    // Preparar la consulta
    $statement = $conexion->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($statement) {
        // Enlazar los parámetros
        $statement->bind_param("ss", $programa, $nombreEstudio);

        // Ejecutar la consulta
        if ($statement->execute()) {
            // Vincular el resultado de la consulta
            $statement->bind_result($asignaturaID);

            // Obtener el resultado
            if ($statement->fetch()) {
                // Retornar el ID de la asignatura
                return $asignaturaID;
            } else {
                // Si no se encontró la asignatura, retornar null
                return null;
            }
        } else {
            echo "Error al ejecutar la consulta: " . $statement->error;
            return null;
        }

        // Cerrar la consulta
        $statement->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
        return null;
    }
}
?>
