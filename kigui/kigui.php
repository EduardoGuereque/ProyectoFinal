<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIGÜI MUSIC</title>
    <link rel="stylesheet" href="src/css/style.css">
    <script src="src/js/main.js" defer></script>
    <script src="src/js/canciones.js"></script>
    <script src="src/js/detalles.js" defer></script>
</head>
<body> 
    <?php include 'components/header.php'; ?>

    <main>
        <section class="tarjeta">
            <div class="canciones">
                <img src="public/assets/img/eltriste.jpeg" alt="Cancion de Jose Jose">
                <p class="titulos">El Triste</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/abrazame.jpg" alt="Cancion de Juan Gabriel">
                <p class="titulos">Abrázame Muy Fuerte</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/rakata.jpeg" alt="Cancion de Wisin y Yandel">
                <p class="titulos">Rakata</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/feliceslos4.jpeg" alt="Cancion de Maluma">
                <p class="titulos">Felices los 4</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/gavilanopaloma.jpg" alt="Cancion de Jose Jose">
                <p class="titulos">Gavilán o Paloma</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/querida.png" alt="Cancion de Juan Gabriel">
                <p class="titulos">Querida</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/algomegusta.jpg" alt="Cancion de Wisin y Yandel">
                <p class="titulos">Algo Me Gusta de Ti</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/hawai.jpeg" alt="Cancion de Maluma">
                <p class="titulos">Hawái</p>
            </div>
            <div class="canciones">
                <img src="public/assets/img/torero.jpeg" alt="Cancion de Chayanne">
                <p class="titulos">Torero</p>
            </div>
        </section>
        <section class="tarjetaGrande">
            <div class="buscador">
                <input type="search" placeholder="Buscar un artista...">
                <button class="boton-buscar">Buscar</button>
            </div>

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
                <div class="botones-categoria">
                    <button class="boton-categoria activo">Canciones más populares</button>
                    <button class="boton-categoria">Canciones más recientes</button>
                    <button class="boton-categoria">Álbumes más populares</button>
                    <button class="boton-categoria">Álbumes más recientes</button>
                </div>

                <div class="lista-contenido">
                    <ul>
                        <?php
                        $sql = "SELECT id, titulo FROM canciones";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<li><a href="cancion.php?id=' . $row["id"] . '">' . $row["id"] . '. ' . $row["titulo"] . '</a></li>';
                            }
                        } else {
                            echo "<li>No hay canciones disponibles</li>";
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