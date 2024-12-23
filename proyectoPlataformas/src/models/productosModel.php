<?php
require_once "../src/db/db.php";

    class producto{
        private $db;
        public function __construct(){ //lo primero que se ejecuta, es importante ya que puede frenar la ejecución del resto de funciones
			$this->db=new Database;
			
}

    public function todosproductos(){
        $consulta=$this->db->connect()->query("SELECT * FROM productos");
        $consulta->execute();
        return $consulta->fetchAll();
    }
    
public function productoPorId($id){
        $consulta=$this->db->connect()->prepare("SELECT nombre, precio FROM `productos` WHERE id = ?");
        $consulta->execute([$id]);
        return $consulta->fetch();

    }
    public function nuevoproducto($data) {
        $inserta = $this->db->connect()->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, marca_id, imagen_url) VALUES (?, ?, ?, ?, ?, ?)");
        $inserta->execute([$data['nombre'], $data['descripcion'], $data['precio'], $data['stock'], $data['marca_id'], $data['imagen_url']]);
        return ['id' => $this->db->connect()->lastInsertId()];
    }

    // Eliminar 
    
    public function eliminarProducto($id) {
        $consulta = $this->db->connect()->prepare("DELETE FROM productos WHERE id = ?");
        return $consulta->execute([$id]);
    }

    public function actualizarProducto($id, $data){
        $consulta = $this->db->connect()->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?, marca_id=?, imagen_url=? WHERE id=?" );
        $consulta->execute([$data['nombre'], $data['descripcion'], $data['precio'], $data['stock'], $data['marca_id'], $data['imagen_url'], $id]);
        return $consulta->rowCount();
    }   


    
    

    }

    
?>
