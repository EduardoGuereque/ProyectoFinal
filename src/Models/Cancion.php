<?php

class Cancion {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function obtenerTodas() {
        $sql = "SELECT id, titulo, artista FROM canciones";
        $resultado = $this->db->query($sql);

        return $resultado; 
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM canciones WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function obtenerRelacionadas($idActual, $limite = 4) {
        $sql = "SELECT id, titulo, imagen FROM canciones WHERE id != ? ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $idActual, $limite);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    public function buscar($termino) {
        $terminoLike = "%" . $termino . "%";
        
        $sql = "SELECT id, titulo, artista FROM canciones WHERE titulo LIKE ? OR artista LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $terminoLike, $terminoLike);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    public function crear($datos) {
        $sql = "INSERT INTO canciones (titulo, artista, anio, descripcion, imagen, audio) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("sissss", 
            $datos['titulo'], 
            $datos['artista'], 
            $datos['anio'], 
            $datos['descripcion'], 
            $datos['imagen'], 
            $datos['audio']
        );
        
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM canciones WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
?>