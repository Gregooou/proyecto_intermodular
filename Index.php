<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadatos y enlaces a estilos e iconos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MB7HJ8K');</script>
	<!-- End Google Tag Manager -->


	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/estilos.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <title>Proyecto intermodular</title>
</head>

<body class="d-flex flex-column" >
    <header class="p-3 custom-bg-color text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="Index.php" class="navbar-brand d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="img/apuntes.jpg" width="150" height="40" class="me-2" alt="Logo">
                </a>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 ms-lg-auto me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>
                <?php
                session_start();
                if(isset($_SESSION["nombreUsu"])) {
                    // Si el usuario ha iniciado sesión, mostramos su nombre
                    $nombreUsu = $_SESSION["nombreUsu"];
                ?>
                    <div class="text-end" id="loggedUserContainer">
                        <span class="text-white me-2">¡Hola, <?php echo $nombreUsu; ?>!</span>
                        <a href="iniciosesion/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 card-welcome position-relative" style="top:120px; width: 500px;"id="bienvenido">
                    <div class="card-body" >
                        <h5 class="card-title">¡Bienvenido!</h5>
                        <p class="card-text" style="max-width: 100%;">Gracias por visitar nuestra página web. Esperamos que encuentres la información que buscas. Esta es una tarjeta más estrecha que permite más líneas de texto.</p>
                        <button type="button" class="btn btn-primary" id="explorar">Explorar</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" id="calificaciones">
                <div class="card col-lg-6 card-right" style="margin-bottom: 30px; margin-top: 60px; " id="derecha">
                    <div class="card-body" >
                        <h5 class="card-title">Documentos Mejor Valorados</h5>
                        <hr>
                        <div class="rating">
                            <p style="margin-right: auto;">Nombre del Documento</p>
                            <span class="star" data-rating="1">&#9733;</span>
                            <span class="star" data-rating="2">&#9733;</span>
                            <span class="star" data-rating="3">&#9733;</span>
                            <span class="star" data-rating="4">&#9733;</span>
                            <span class="star" data-rating="5">&#9733;</span>
                        </div>
                    </div>
                </div>

                <div class="card col-lg-6 card-right" id="izquierda">
                    <div class="card-body">
                        <h5 class="card-title">Exámenes Mejor Valorados</h5>
                        <hr>
                        <div class="rating">
                            <p style="margin-right: auto;">Nombre del Examen</p>
                            <span class="star" data-rating="1">&#9733;</span>
                            <span class="star" data-rating="2">&#9733;</span>
                            <span class="star" data-rating="3">&#9733;</span>
                            <span class="star" data-rating="4">&#9733;</span>
                            <span class="star" data-rating="5">&#9733;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Elige" style="text-align: center; margin-top: 100px; background-color: #e9f7f5; ">
    <h2 class="elige">Mira los apuntes que quieras</h2>
    <h2 class="h2peque" style="font-size: small;">En ApuntesUax, encontrarás todos los apuntes de tus asignaturas favoritas o no tan favoritas</h2>
    </div>
    <main class="flex-grow-1 overflow-auto blur-on-scroll" style="margin-bottom: 100px; margin-top: 60px;" id="botones">
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="carrera">
                <div class="col" style="margin-left: 60px;">
                    <a href="Estudios/Carreras.php" class="card-link">
                    <div class="card shadow-sm">
                        <img src="img/estudiantes.jpg" alt="Imagen Izquierda" class="bd-placeholder-img card-img-top" width="100%" height="225">
                        <div class="card-body">
                            <p class="card-text"><center>Carreras</center></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col" style="margin-left: 250px;">
                    <a href="Estudios/FPs.php" class="card-link">
                        <div class="card shadow-sm">
                            <img src="img/estudiantesFP.jpg" alt="Imagen Derecha" class="bd-placeholder-img card-img-top" width="100%" height="225">
                                <div class="card-body">
                                    <p class="card-text"><center>Grados superiores</center></p>
                                <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="custom-footer mt-auto">
    <p>&copy; 2024 Mi Página Web</p>
    <p>Contacto: infoapuntesuax@gmail.com</p>
    <p><a href="aviso-cookies.php">Política de Cookies</a></p>
</footer>
<div class="aviso-cookies" id="aviso-cookies">
    <img class="galleta" src="./img/cookie.svg" alt="Galleta">
    <h3 class="titulo">Cookies</h3>
    <p class="parrafo">Utilizamos cookies propias y de terceros para mejorar nuestros servicios.</p>
    <button class="boton" id="btn-aceptar-cookies">De acuerdo</button>
    <a class="enlace" href="aviso-cookies.php">Aviso de Cookies</a>
</div>
    <div class="fondo-aviso-cookies" id="fondo-aviso-cookies"></div>
    <script src="js/aviso-cookies.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var loginSignupContainer = document.getElementById('loginSignupContainer');
                var footer = document.querySelector('.custom-footer');
                var mainContent = document.querySelector('main');
                var blurElem = document.querySelector('.blur-on-scroll');
    
                window.addEventListener('scroll', function () {
                    var scrollPosition = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;
    
                    var totalHeight = mainContent.clientHeight;
    
                    var visibleHeight = window.innerHeight;
    
                    if (scrollPosition + visibleHeight >= totalHeight) {
                        footer.style.display = 'block';
                    } else {
                        footer.style.display = 'none';
                    }
                    if (scrollPosition > 100) {
                        blurElem.classList.add('blurred');
                    } else {
                        blurElem.classList.remove('blurred');
                    }
                });
                if (loginSignupContainer) {
                    loginSignupContainer.addEventListener('click', function(event) {
                        if (event.target.tagName == 'BUTTON') {
                            var buttonText = event.target.innerText.toLowerCase().trim();
                            if (buttonText == 'login') {
                                window.location.href = 'iniciosesion/login.php';
                            } else if (buttonText == 'sign-up') {
                                window.location.href = 'iniciosesion/sign_up.php';
                            }
                        }
                    });
                }
            });
            // Lógica de JavaScript para manejar las cookies
    document.addEventListener('DOMContentLoaded', function() {
        const botonAceptarCookies = document.getElementById('btn-aceptar-cookies');
        const avisoCookies = document.getElementById('aviso-cookies');
        const fondoAvisoCookies = document.getElementById('fondo-aviso-cookies');

        botonAceptarCookies.addEventListener('click', function() {
            avisoCookies.classList.remove('activo');
            fondoAvisoCookies.classList.remove('activo');

            // Establecer la cookie 'cookies_aceptadas' con una duración de 30 días
            var fechaExpiracion = new Date();
            fechaExpiracion.setDate(fechaExpiracion.getDate() + 30);
            document.cookie = 'cookies_aceptadas=true; expires=' + fechaExpiracion.toUTCString() + '; path=/';
        });
    });
</script>
</body>
</html>
