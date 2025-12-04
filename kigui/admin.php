<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'src/config/db.php';
require_once 'src/Models/Cancion.php';

$cancionModel = new Cancion($conn);
$mensaje = "";
$tipoMensaje = "";

if (isset($_GET['borrar'])) {
    $idBorrar = (int)$_GET['borrar'];
    
    $cancionBorrar = $cancionModel->obtenerPorId($idBorrar);

    if ($cancionBorrar) {
        if (file_exists($cancionBorrar['imagen'])) {
            unlink($cancionBorrar['imagen']);
        }
        if (file_exists($cancionBorrar['audio'])) {
            unlink($cancionBorrar['audio']);
        }

        if ($cancionModel->eliminar($idBorrar)) {
            $mensaje = "Canción eliminada correctamente.";
            $tipoMensaje = "exito";
        } else {
            $mensaje = "Error al eliminar de la base de datos.";
            $tipoMensaje = "error";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $dirImagenes = "public/assets/img/";
    $dirAudios = "public/assets/audio/";

    if (!is_dir($dirImagenes)) mkdir($dirImagenes, 0777, true);
    if (!is_dir($dirAudios)) mkdir($dirAudios, 0777, true);

    $nombreImagen = basename($_FILES["imagen"]["name"]);
    $rutaImagen = $dirImagenes . time() . "_" . $nombreImagen;
    
    $nombreAudio = basename($_FILES["audio"]["name"]);
    $rutaAudio = $dirAudios . time() . "_" . $nombreAudio;

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen) && 
        move_uploaded_file($_FILES["audio"]["tmp_name"], $rutaAudio)) {
        
        $datos = [
            'titulo' => $_POST['titulo'],
            'artista' => $_POST['artista'],
            'anio' => (int)$_POST['anio'],
            'descripcion' => $_POST['descripcion'],
            'imagen' => $rutaImagen,
            'audio' => $rutaAudio
        ];

        if ($cancionModel->crear($datos)) {
            $mensaje = "¡Canción subida correctamente!";
            $tipoMensaje = "exito";
        } else {
            $mensaje = "Error al guardar en la base de datos.";
            $tipoMensaje = "error";
        }

    } else {
        $mensaje = "Error al subir los archivos";
        $tipoMensaje = "error";
    }
}

$listaCanciones = $cancionModel->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador - Kigüi Music</title>
    <link rel="stylesheet" href="src/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main class="container">
        
        <div class="admin-contenedor">
            <div class="admin-header">
                <div class="usuario-info">
                    <i class="fas fa-user-circle"></i> 
                    Hola, <strong><?php echo $_SESSION['admin_email']; ?></strong>
                </div>
                <a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </div>

            <hr class="admin-divider">

            <h1>Subir Nueva Música</h1>
            <p class="subtitulo">Completa el formulario para agregar contenido a Kigüi Music.</p>

            <?php if ($mensaje): ?>
                <div class="alerta <?php echo $tipoMensaje; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form action="admin.php" method="POST" enctype="multipart/form-data" class="formulario-admin">
                
                <div class="campo">
                    <label>Título de la canción</label>
                    <input type="text" name="titulo" required placeholder="Ej: La Incondicional">
                </div>

                <div class="campo-doble">
                    <div class="campo">
                        <label>Artista</label>
                        <input type="text" name="artista" required placeholder="Ej: Luis Miguel">
                    </div>
                    <div class="campo">
                        <label>Año</label>
                        <input type="number" name="anio" required placeholder="Ej: 1988">
                    </div>
                </div>

                <div class="campo">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4" required placeholder="Escribe una reseña interesante..."></textarea>
                </div>

                <div class="campo-archivo">
                    <label>Imagen de portada (JPG)</label>
                    <input type="file" name="imagen" accept="image/*" required class="input-file">
                </div>

                <div class="campo-archivo">
                    <label>Archivo de audio (MP3)</label>
                    <input type="file" name="audio" accept="audio/*" required class="input-file">
                </div>

                <button type="submit" class="boton-guardar">
                    <i class="fas fa-cloud-upload-alt"></i> Publicar Canción
                </button>
            </form>

            <hr class="admin-divider" style="margin-top: 40px;">

            <h2>Gestionar Canciones Existentes</h2>
            
            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Portada</th>
                            <th>Título</th>
                            <th>Artista</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($listaCanciones && $listaCanciones->num_rows > 0) {
                            $listaCanciones->data_seek(0); 
                            while($c = $listaCanciones->fetch_assoc()): 
                        ?>
                            <tr>
                                <td><?php echo $c['id']; ?></td>
                                <td>
                                    <?php 
                                        $img = !empty($c['imagen']) ? $c['imagen'] : 'public/assets/img/joseJose.jpg'; 
                                    ?>
                                    <img src="<?php echo $img; ?>" alt="img" class="mini-portada">
                                </td>
                                <td><?php echo $c['titulo']; ?></td>
                                <td><?php echo $c['artista']; ?></td>
                                <td>
                                    <a href="admin.php?borrar=<?php echo $c['id']; ?>" 
                                       class="btn-eliminar"
                                       onclick="return confirm('¿Estás segura de que quieres borrar esta canción? Esta acción no se puede deshacer.');">
                                        <i class="fas fa-trash-alt"></i> Borrar
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        } else {
                            echo "<tr><td colspan='5'>No hay canciones registradas aún.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <a href="index.php" class="boton-volver">← Volver al sitio web</a>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>