<?php 
require_once 'src/config/db.php';
require_once 'src/Models/Cancion.php';

$cancionModel = new Cancion($conn);

$busqueda = isset($_GET['q']) ? $_GET['q'] : null;

if ($busqueda) {
    $listaCanciones = $cancionModel->buscar($busqueda);
} else {
    $listaCanciones = $cancionModel->obtenerTodas();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIGÜI MUSIC</title>
    <link rel="stylesheet" href="src/css/style.css">
    <script src="src/js/main.js" defer></script>
</head>
<body> 
    <?php include 'components/header.php'; ?>

    <main>
        <section class="tarjetaGrande">
            <form action="kigui.php" method="GET" class="buscador">
                <input type="search" 
                       name="q" 
                       placeholder="Buscar un artista o canción..." 
                       value="<?php echo isset($busqueda) ? htmlspecialchars($busqueda) : ''; ?>">
                <button type="submit" class="boton-buscar">Buscar</button>
                
                <?php if ($busqueda): ?>
                    <a href="kigui.php" class="boton-buscar" style="background-color: #666; text-align:center;">Ver todas</a>
                <?php endif; ?>
            </form>

            <div class="perfiles">
                <div class="fotoPerfil">
                    <img src="public/assets/img/joseJose.jpg" alt="Foto de Jose Jose">
                </div>
                <div class="artista">
                    <h2>José José</h2>
                    <p class="descripcion">
                        José Rómulo Sosa Ortiz, conocido como José José, fue un cantante y actor mexicano nacido el 17 de febrero de 1948 en la ciudad de 
                        México y fallecido el 28 de septiembre de 2019 en Miami, Florida.<br><br>

                        Considerado uno de los más grandes intérpretes de la música romántica en español, José José destacó por su extraordinaria voz y 
                        su capacidad para transmitir emociones. a lo largo de su carrera, vendió mas de 100 millones de discos y recibió numerosos premios
                        y reconocimientos.<br><br>

                        Su estilo único y su capacidad interpretativa lo convirtieron en un icono de la música popular latinoamericana, influenciando a generaciones
                        de cantantes.<br>
                        </p>
                    <div class="generos">
                        <span>Bolero</span>
                        <span>Balada romántica</span>
                        <span>Pop latino</span>
                        <span>Jazz</span>
                    </div>
                </div>
            </div>

            <div class="artista-contenido">

                <div class="lista-contenido">
                    <ul>
                        <?php
                            if ($listaCanciones && $listaCanciones->num_rows > 0) {
                            while($cancion = $listaCanciones->fetch_assoc()) {
                                ?>
                                <li>
                                    <a href="cancion.php?id=<?php echo $cancion['id']; ?>">
                                        <?php echo $cancion['id']; ?>. <?php echo $cancion['titulo']; ?>
                                    </a>
                                </li>
                                <?php
                            }
                        } else {
                            echo "<li>No hay canciones disponibles en este momento.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>