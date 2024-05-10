<?php
session_start();

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "ADMINPM";
$contraseña = "Pr0yect0#Interm0dul4r";
$base_de_datos = "intermodular definitivo2";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar si se ha enviado una solicitud AJAX para obtener los programas según el tipo de estudio
if(isset($_POST['tipoEstudioID'])) {
    // Obtener el tipo de estudio seleccionado
    $tipoEstudioID = $_POST['tipoEstudioID'];
    
    // Realizar la consulta SQL para obtener los nombreProg según el tipo de estudio
    $query = "SELECT nombreProg FROM programas 
              WHERE tipoEstudioID IN (SELECT tipoEstudioID FROM tipo_estudio WHERE tipoestudio = ?)";

    // Preparar la consulta
    $statement = $conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if($statement) {
        // Enlazar el parámetro tipoEstudioID a la consulta
        $statement->bind_param("s", $tipoEstudioID); // 's' indica que es una cadena de texto
        
        // Ejecutar la consulta
        $statement->execute();
        
        // Obtener el resultado de la consulta
        $result = $statement->get_result();
        
        // Crear un arreglo para almacenar los nombres de los programas
        $programas = array();
        
        // Recorrer los resultados y almacenar los nombres de los programas en el arreglo
        while($row = $result->fetch_assoc()) {
            $programas[] = $row['nombreProg'];
        }
        
        // Cerrar la consulta
        $statement->close();
        
        // Generar las opciones del segundo select basadas en los programas obtenidos
        $options = '';
        foreach($programas as $programa) {
            $options .= '<option value="' . $programa . '">' . $programa . '</option>';
        }
        
        // Enviar las opciones de vuelta como respuesta a la solicitud AJAX
        echo $options;
        exit; // Termina la ejecución del script después de enviar la respuesta
    } else {
        // Si hubo un error en la preparación de la consulta, muestra un mensaje de error
        echo "Error en la preparación de la consulta.";
    }
}

if(isset($_POST['nombreProg'])) {
    // Obtener el nombre del programa seleccionado
    $nombreProg = $_POST['nombreProg'];

    $query = "SELECT nombreAs FROM asignaturastabla WHERE programaID IN (SELECT programaID FROM programas WHERE nombreProg = ?)";
    $statement = $conexion->prepare($query);
    
    // Verificar si la preparación de la consulta fue exitosa
    if($statement) {
        // Enlazar el parámetro nombreProg a la consulta
        $statement->bind_param("s", $nombreProg); 
        
        // Ejecutar la consulta
        $statement->execute();
        
        // Obtener el resultado de la consulta
        $result = $statement->get_result();
        

        // Crear un arreglo para almacenar los nombres de las asignaturas
        $asignaturas = array();
        
        // Recorrer los resultados y almacenar los nombres de las asignaturas en el arreglo
        while($row = $result->fetch_assoc()) {
            $asignaturas[] = $row['nombreAs'];
        }
        
        // Cerrar la consulta
        $statement->close();
        
        // Generar las opciones del tercer select basadas en las asignaturas obtenidas
        $options = '';
        foreach($asignaturas as $asignatura) {
            // Consultar la ID de la asignatura en la base de datos utilizando su nombre
            $sqlAsignatura = "SELECT asignaturaID FROM asignaturastabla WHERE nombreAs = ?";
            $statementAsignatura = $conexion->prepare($sqlAsignatura);
            if($statementAsignatura) {
                $statementAsignatura->bind_param("s", $asignatura);
                $statementAsignatura->execute();
                $resultAsignatura = $statementAsignatura->get_result();
                if($resultAsignatura->num_rows > 0) {
                    $rowAsignatura = $resultAsignatura->fetch_assoc();
                    $idAsignatura = $rowAsignatura["asignaturaID"];
                    $options .= '<option value="' . $asignatura . '">' . $asignatura . '</option>';
                } else {
                    // La asignatura no fue encontrada en la base de datos
                    echo "Asignatura no encontrada";
                }
                $statementAsignatura->close();
            } else {
                echo "Error en la preparación de la consulta.";
            }
        }
        
        // Enviar las opciones de vuelta como respuesta a la solicitud AJAX
        echo $options;
        exit; // Termina la ejecución del script después de enviar la respuesta
    } else {
        // Si hubo un error en la preparación de la consulta, muestra un mensaje de error
        echo "Error en la preparación de la consulta.";
    }
}

if (isset($_SESSION["nombreUsu"])) {
    // La sesión está iniciada, puedes acceder al nombre de usuario
    $nombreUsuario = $_SESSION["nombreUsu"];

    // Verificar si el nombre de usuario existe en la base de datos
    $queryUsuario = "SELECT usuarioID FROM usuario WHERE nombreUsu = ?";
    $statementUsuario = $conexion->prepare($queryUsuario);

    if ($statementUsuario) {
        // Enlazar el parámetro nombreUsu a la consulta
        $statementUsuario->bind_param("s", $nombreUsuario);

        // Ejecutar la consulta
        $statementUsuario->execute();

        // Obtener el resultado de la consulta
        $resultUsuario = $statementUsuario->get_result();

        // Verificar si se encontró alguna fila para el usuario
        if ($resultUsuario->num_rows > 0) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Obtener la ID del usuario desde la base de datos
                $sqlUsuario = "SELECT usuarioID FROM usuario WHERE nombreUsu = ?";
                $statementUsuario = $conexion->prepare($sqlUsuario);
                if ($statementUsuario) {
                    $statementUsuario->bind_param("s", $nombreUsuario);
                    $statementUsuario->execute();
                    $resultUsuario = $statementUsuario->get_result();
                    if ($resultUsuario->num_rows > 0) {
                        $rowUsuario = $resultUsuario->fetch_assoc();
                        $idUsuario = $rowUsuario["usuarioID"];

                        // Obtener el nombre de la asignatura seleccionada desde el formulario
                        // Realizar una consulta SQL para obtener la ID de la asignatura basada en su nombre
                        if (isset($_POST['otroSelect'])) {
                            $asignatura = $_POST['otroSelect']; // Capturamos la asignatura seleccionada en el tercer select
                            $sqlAsignatura = "SELECT asignaturaID FROM asignaturastabla WHERE nombreAs = ?";
                            $statementAsignatura = $conexion->prepare($sqlAsignatura);
                            if ($statementAsignatura) {
                                $statementAsignatura->bind_param("s", $asignatura);
                                $statementAsignatura->execute();
                                $resultAsignatura = $statementAsignatura->get_result();
                                if ($resultAsignatura->num_rows > 0) {
                                    $rowAsignatura = $resultAsignatura->fetch_assoc();
                                    $idAsignatura = $rowAsignatura["asignaturaID"];

                                    
                                } else {
                                    // La asignatura no fue encontrada en la base de datos
                                    echo "Asignatura no encontrada";
                                }
                                $statementAsignatura->close();
                            } else {
                                echo "Error en la preparación de la consulta.";
                            }
                        }
                    } else {
                        // El usuario no fue encontrado en la base de datos
                        echo "Usuario no encontrado";
                    }
                } else {
                    echo "Error en la preparación de la consulta.";
                }
            }
        } else {
            // El nombre de usuario no existe en la base de datos
            echo "El nombre de usuario no es válido.";
            exit; // Termina la ejecución del script
        }

        // Cerrar la consulta
        $statementUsuario->close();
    } else {
        // Si hubo un error en la preparación de la consulta, muestra un mensaje de error
        echo "Error en la preparación de la consulta de usuario.";
        exit; // Termina la ejecución del script
    }
} else {
    // La sesión no está iniciada, redirige al usuario o muestra un mensaje de error
    // Por ejemplo:
    header("Location: ../iniciosesion/login.php"); // Redirige a la página de inicio de sesión
    exit; // Termina el script
}
// Subida de archivos
if (isset($_FILES['file'])) {
    // Obtener información sobre el archivo subido
    $archivo_nombre = $_FILES['file']['name'];
    $archivo_tmp = $_FILES['file']['tmp_name'];
    $directorio_destino = "C:/xampp/htdocs/uploadapuntesUAX/";

    // Verificar si no hay errores en la subida del archivo
    if (move_uploaded_file($archivo_tmp, $directorio_destino . $archivo_nombre)) {
        // La subida del archivo fue exitosa
        echo "El archivo se ha subido correctamente.";

        // Verificar si se seleccionó una asignatura
        if (isset($_POST['otroSelect'])) {
            $asignatura = $_POST['otroSelect']; // Capturamos la asignatura seleccionada en el tercer select

            // Consultar la ID de la asignatura en la base de datos utilizando su nombre
            $sqlAsignatura = "SELECT asignaturaID FROM asignaturastabla WHERE nombreAs = ?";
            $statementAsignatura = $conexion->prepare($sqlAsignatura);

            if ($statementAsignatura) {
                $statementAsignatura->bind_param("s", $asignatura);
                $statementAsignatura->execute();
                $resultAsignatura = $statementAsignatura->get_result();

                if ($resultAsignatura->num_rows > 0) {
                    $rowAsignatura = $resultAsignatura->fetch_assoc();
                    $idAsignatura = $rowAsignatura["asignaturaID"];

                    // Preparar la consulta para insertar detalles del archivo en la base de datos
                    $query = "INSERT INTO documentos (usuarioID, rutaArchivo, asignaturaID) VALUES (?, ?, ?)";
                    $statementInsert = $conexion->prepare($query);

                    if ($statementInsert) {
                        // Obtener el ID del usuario desde la sesión
                        $idUsuario = $_SESSION["usuarioID"];

                        $statementInsert->bind_param("iss", $idUsuario, $archivo_nombre, $idAsignatura);
                        $statementInsert->execute();
                        $statementInsert->close();
                        
                        echo "Detalles del archivo insertados en la base de datos.";
                    } else {
                        // Manejar errores de preparación de consulta
                        echo "Error al preparar la consulta de inserción en la base de datos.";
                    }
                } else {
                    // La asignatura no fue encontrada en la base de datos
                    echo "Asignatura no encontrada";
                }
                $statementAsignatura->close();
            } else {
                echo "Error en la preparación de la consulta.";
            }
        }
    } else {
        // Error al mover el archivo
        echo "Error al subir el archivo.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos de Usuarios</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<header class="p-3 custom-bg-color text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <a href="../Index.php" class="navbar-brand d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="../img/apuntes.jpg" width="150" height="40" class="me-2" alt="Logo">
            </a>
            <form id="searchForm" class="col-12 col-lg-auto mb-3 mb-lg-0 ms-lg-auto me-lg-3">
                <input type="search" id="searchInput" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form>
            <div id="searchResults"></div>
            <?php
            if(isset($_SESSION["nombreUsu"])) {
                // Si el usuario ha iniciado sesión, mostramos su nombre
                $nombreUsu = $_SESSION["nombreUsu"];
                ?>
                <div class="text-end" id="loggedUserContainer">
                    <span class="text-white me-2">¡Hola, <?php echo $nombreUsu; ?>!</span>
                    <a href="../iniciosesion/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
                </div>
                <?php
            } else {
                // Si el usuario no ha iniciado sesión, mostramos los botones de login y sign-up como lo hacías anteriormente
                ?>
                <div class="text-end" id="loginSignupContainer">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</header>
<h1>Archivos de Usuarios</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Subir archivo PDF
</button>

<!-- Modal para seleccionar asignatura y grado -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Archivo PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
        <form id="fileForm" method="post" enctype="multipart/form-data">
            <label for="fileInput" class="form-label">Selecciona un archivo:</label>
            <input type="file" class="form-control" id="fileInput" name="file">
        </form>
        </div>
        <div class="mb-3">
            <label for="tipoEstudioSelect" class="form-label">Tipo de Estudio:</label>
            <select class="form-select" id="tipoEstudioSelect" name="tipoEstudio">
                <option selected disabled>Selecciona un tipo de estudio</option>
                <?php
                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }

                // Consulta para obtener los tipos de estudio
                $consulta = "SELECT DISTINCT tipoestudio FROM tipo_estudio";
                $resultados = $conexion->query($consulta);

                // Si hay resultados, generar las opciones del select
                if ($resultados->num_rows > 0) {
                    while ($fila = $resultados->fetch_assoc()) {
                        echo '<option value="' . $fila["tipoestudio"] . '">' . $fila["tipoestudio"] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay tipos de estudio disponibles</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nombreProgSelect" class="form-label">Nombre del Programa:</label>
            <select class="form-select" id="nombreProgSelect" name="nombreProg">
                <!-- Las opciones se cargarán dinámicamente mediante JavaScript -->
                <option selected disabled>Selecciona un programa</option>
            </select>
        </div>
        
        <form id="fileForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="otroSelect" class="form-label">Asignatura:</label>
                <select class="form-select" id="otroSelect" name="otroSelect">
                <option selected disabled>Selecciona una asignatura</option>
                </select>
            </div>
        </form>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="submitBtn">Subir</button>
      </div>
    </div>
  </div>
</div>

<table border="1">
    <thead>
    <tr>
        <th>Nombre de Usuario</th>
        <th>Asignatura</th>
        <th>Tema</th>
        <th>Archivo</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // El resto del código PHP para mostrar los archivos en la tabla permanece igual
    ?>
    </tbody>
</table>
<footer class="custom-footer mt-auto">
    <p>&copy; 2024 Mi Página Web</p>
    <p>Contacto: infoapuntesuax@gmail.com</p>
    <p><a href="../aviso-cookies.php">Política de Cookies</a></p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="<KEY>" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Manejar clic en el botón de subir
    $('#submitBtn').click(function() {
        console.log('Botón de subir clickeado');
        // Obtener los datos del formulario
        var file = $('#fileInput').prop('files')[0];
        var tipoEstudio = $('#tipoEstudioSelect').val();
        var nombreProg = $('#nombreProgSelect').val();
        var asignatura = $('#otroSelect').val(); // Capturamos la asignatura seleccionada en el tercer select

        // Validar que se hayan seleccionado todos los campos requeridos
        if (!file || !tipoEstudio || !nombreProg || !asignatura) {
            alert("Por favor completa todos los campos antes de subir el archivo.");
            return;
        }

        // Procesar el formulario sin AJAX
        document.getElementById("fileForm").submit();
    });

    // Código para cargar dinámicamente los programas basados en el tipo de estudio
    $('#tipoEstudioSelect').change(function() {
        var tipoEstudioID = $(this).val();
        $.ajax({
            type: 'POST',
            // No especificar URL ya que es el mismo archivo
            data: { tipoEstudioID: tipoEstudioID },
            success: function(response) {
                $('#nombreProgSelect').html(response);
            }
        });
    });

    // Código para cargar dinámicamente las opciones del tercer select basadas en la selección del segundo select
    $('#nombreProgSelect').change(function() {
        var nombreProg = $(this).val();
        $.ajax({
            type: 'POST',
            // No especificar URL ya que es el mismo archivo
            data: { nombreProg: nombreProg },
            success: function(response) {
                $('#otroSelect').html(response);
            }
        });
    });
});


</script>

</body>
</html>