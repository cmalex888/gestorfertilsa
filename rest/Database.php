<?php

class Database {
    //Atributos
    private $host = "localhost";
    private $db_name = "gestor";
    private $username = "root";
    private $password = "";
    public $conn;

    //Establecer la conexión con la bd
    public function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            ); //Establece la conexión
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Maneja los errores
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // MÉTODO PARA BUSCAR USUARIO (LOGIN)
    public function buscarUsuario($usuario, $clave) {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario = ? AND clave = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$usuario, $clave]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    // MÉTODO PARA AGREGAR USUARIO (REGISTRO)
    public function agregarUsuario($usuario, $clave, $nombre, $apellidos, $celular) {
        try {
            $sql = "INSERT INTO usuarios (usuario, clave, nombre, apellidos, celular) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$usuario, $clave, $nombre, $apellidos, $celular]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar usuario: " . $e->getMessage();
            return false;
        }
    }


    // MÉTODO PARA VERIFICAR SI USUARIO EXISTE PARA CREARLO
    public function usuarioExiste($usuario) {
        try {
            $sql = "SELECT usuario FROM usuarios WHERE usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$usuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            return false;
        }
    }

    // MÉTODO PARA AGREGAR DOCUMENTO (REGISTRO)
    public function agregarDocumento($idocumentos, $tipo, $sigla, $descripcionDoc) {
        try {
            $sql = "INSERT INTO documentos (idocumentos, tipo, sigla, descripcionDoc) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idocumentos, $tipo, $sigla, $descripcionDoc]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar documento: " . $e->getMessage();
            return false;
        }
    }

// MÉTODO PARA BUSCAR TIPO DE DOCUMENTO (DOCUMENTO)
    public function buscarDocumento($sigla) {
        try {
            $sql = "SELECT * FROM documentos WHERE sigla = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$sigla]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }


    // MÉTODO PARA AGREGAR UN PRODUCTO (REGISTRO)
    public function agregarProducto($iditem, $referencia, $descripcion, $unidad, $valor) {
        try {
            $sql = "INSERT INTO productos (iditem, referencia, descripcion, unidadmedida, valoruni) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$iditem, $referencia, $descripcion, $unidad, $valor]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar documento: " . $e->getMessage();
            return false;
        }
    }

// MÉTODO PARA BUSCAR REFERENCIA (PRODUCTO)
    public function buscarProducto($referencia) {
        try {
            $sql = "SELECT * FROM productos WHERE referencia = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$referencia]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }


    
    // MÉTODO PARA AGREGAR CLIENTE (REGISTRO)
    public function agregarCliente($nit, $razonsocial) {
        try {
            $sql = "INSERT INTO cliente (nit, razon) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nit, $razonsocial]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar cliente: " . $e->getMessage();
            return false;
        }
    }

    // MÉTODO PARA BUSCAR CLIENTE POR NIT
    public function buscarCliente($nit) {
        try {
            $sql = "SELECT * FROM cliente WHERE nit = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nit]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }



    // MÉTODO PARA AGREGAR UNA BODEGA (REGISTRO)
    public function agregarBodega($codigob, $descripb, $direcb, $ciudadbg, $phoneb) {
        try {
            $sql = "INSERT INTO bodega (codigo, nombre, direccion, ciudad, telefono) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$codigob, $descripb, $direcb, $ciudadbg, $phoneb]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar documento: " . $e->getMessage();
            return false;
        }
    }

// MÉTODO PARA BUSCAR BODEGA POR CODIGO
    public function buscarBodega($codigob) {
        try {
            $sql = "SELECT * FROM bodega WHERE codigo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$codigob]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }




//MÉTODO PARA CARGAR INFORMACIÓN A LISTA DESPLEGABLE MOVIMIENTOS
    public function respuesta(){
        try {
            // Primero aseguramos que la conexión exista
            if ($this->conn == null) {
                $this->conectar();
            }
                
            // Consulta sql
            $stmt = $this->conn->query("SELECT idocumentos, sigla, descripcionDoc FROM documentos WHERE tipo ='Entrada'");
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Enviar datos en formato JSON
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }


    // MÉTODO PARA AGREGAR UNA ENTRADA (REGISTRO)
    public function agregarEntrada($idoc, $fecha, $prefijo, $csc, $ref, $descrip, $um, $cantidade, $cantidads, $observa, $bodegae, $nit) {
        try {
            $sql = "INSERT INTO movimientos (idmovimientos, fecha, documentos_sigla, consecutivo, productos_referencia, productos_descrip, productos_unidad, cantidade, cantidads, observaciones, bodega_codigo, cliente_nit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idoc, $fecha, $prefijo, $csc, $ref, $descrip, $um, $cantidade, $cantidads, $observa, $bodegae, $nit]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar entrada: " . $e->getMessage();
            return false;
        }
    }







    


}
?>
