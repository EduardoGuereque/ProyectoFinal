<?php 
include 'db.php'; 

$id_cancion = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM canciones WHERE id = ?");
$stmt->bind_param("i", $id_cancion);
$stmt->execute();
$resultado = $stmt->get_result();
$cancion = $resultado->fetch_assoc();

if (!$cancion) {
    echo "Canción no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $cancion['titulo']; ?> - Detalles</title>
    <link rel="stylesheet" href="src/css/style.css">
    <script src="src/js/main.js" defer></script>
    </head>

<body>
    <?php include 'components/header.php'; ?>

    <main class="container mt-5">
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
            $sql_rel = "SELECT id, titulo, imagen FROM canciones WHERE id != ? ORDER BY RAND() LIMIT 4";
            $stmt_rel = $conn->prepare($sql_rel);
            $stmt_rel->bind_param("i", $id_cancion);
            $stmt_rel->execute();
            $res_rel = $stmt_rel->get_result();

            while($rel = $res_rel->fetch_assoc()) {
                ?>
                <div class="card-relacionada">
                    <a href="cancion.php?id=<?php echo $rel['id']; ?>">
                        <img src="<?php echo $rel['imagen']; ?>" alt="<?php echo $rel['titulo']; ?>">
                        <p><?php echo $rel['titulo']; ?></p>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>