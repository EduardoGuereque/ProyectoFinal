<?php 
require_once 'src/config/db.php';
require_once 'src/Models/Cancion.php';

$id_cancion = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$cancionModel = new Cancion($conn);

$cancion = $cancionModel->obtenerPorId($id_cancion);

$relacionadas = null;
if ($cancion) {
    $relacionadas = $cancionModel->obtenerRelacionadas($id_cancion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $cancion ? $cancion['titulo'] : 'Canción no encontrada'; ?> - Kigüi Music</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <script src="src/js/main.js" defer></script>
</head>

<body>
    <?php include 'components/header.php'; ?>

    <main class="container mt-5">
        
        <?php if ($cancion): ?>
            <div id="detalle-cancion-php" class="detalle-wrapper">
                <div class="row">
                    <div class="col-imagen">
                        <img src="<?php echo $cancion['imagen']; ?>" alt="<?php echo $cancion['titulo']; ?>" class="img-fluid">
                    </div>
                    
                    <div class="col-info">
                        <h1><?php echo $cancion['titulo']; ?></h1>
                        <h2><?php echo $cancion['artista']; ?> (<?php echo $cancion['anio']; ?>)</h2>
                        
                        <p class="descripcion-texto">
                            <?php echo $cancion['descripcion']; ?>
                        </p>

                        <?php if (!empty($cancion['audio'])): ?>
                            <div class="reproductor-container">
                                <audio controls>
                                    <source src="<?php echo $cancion['audio']; ?>" type="audio/mpeg">
                                    Tu navegador no soporta el elemento de audio.
                                </audio>
                            </div>
                        <?php else: ?>
                            <p><em>Audio no disponible para esta canción.</em></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <h3 class="mt-5">Más canciones</h3>
            
            <div id="canciones-relacionadas-php" class="row g-4">
                <?php
                if ($relacionadas && $relacionadas->num_rows > 0) {
                    while($rel = $relacionadas->fetch_assoc()) {
                        ?>
                        <div class="card-relacionada">
                            <a href="cancion.php?id=<?php echo $rel['id']; ?>">
                                <img src="<?php echo $rel['imagen']; ?>" alt="<?php echo $rel['titulo']; ?>">
                                <p><?php echo $rel['titulo']; ?></p>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No hay canciones relacionadas por ahora.</p>";
                }
                ?>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <h1>Canción no encontrada</h1>
                <p>la canción que buscas no existe</p>
                <a href="kigui.php" class="boton-buscar" style="text-decoration: none;">Volver al inicio</a>
            </div>
        <?php endif; ?>

    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>