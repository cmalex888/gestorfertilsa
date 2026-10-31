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
    public function buscarDocumento($sigla, $tipo) {
        try {
            $sql = "SELECT * FROM documentos WHERE sigla = ? AND tipo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$sigla, $tipo]);
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




//MÉTODO PARA CARGAR INFORMACIÓN A LISTA DESPLEGABLE ENTRADAS
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


//MÉTODO PARA CARGAR INFORMACIÓN A LISTA DESPLEGABLE SALIDAS
    public function respuestaSalida(){
        try {
            // Primero aseguramos que la conexión exista
            if ($this->conn == null) {
                $this->conectar();
            }
                
            // Consulta sql
            $stmt = $this->conn->query("SELECT idocumentos, sigla, descripcionDoc FROM documentos WHERE tipo ='Salida'");
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Enviar datos en formato JSON
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    // MÉTODO PARA AGREGAR UNA SALIDA (REGISTRO)
    public function agregarSalida($idoc, $fecha, $prefijo, $csc, $ref, $descrip, $um, $cantidade, $cantidads, $observa, $bodegae, $nit) {
        try {
            $sql = "INSERT INTO movimientos (idmovimientos, fecha, documentos_sigla, consecutivo, productos_referencia, productos_descrip, productos_unidad, cantidade, cantidads, observaciones, bodega_codigo, cliente_nit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idoc, $fecha, $prefijo, $csc, $ref, $descrip, $um, $cantidade, $cantidads, $observa, $bodegae, $nit]);
        return true;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            echo "Error al agregar salida: " . $e->getMessage();
            return false;
        }
    }


    //MÉTODO PARA CONSULTAR EL SALDO DE INVENTARIO DE UNA REFERENCIA POR UNA BODEGA
    public function consultarSaldo($ref, $bodega) {
        try {
            $sql = "SELECT COALESCE((SUM(cantidade)-SUM(cantidads)),0) AS saldo FROM movimientos WHERE productos_referencia = ? AND bodega_codigo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$ref, $bodega]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    //MÉTODO PARA CONSULTAR SI UN DOCUMENTO YA EXISTE.
    public function consultarDocumento($sigla, $csc) {
        try {
            $sql = "SELECT EXISTS(SELECT 1 FROM movimientos WHERE documentos_sigla = ? AND consecutivo = ?) AS exiteregistro";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$sigla, $csc]);
            //Indica que quieres la fila devuelta como un arreglo asociativo
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }



    //MÉTODO PARA CARGAR INFORMACIÓN A LISTA DESPLEGABLE TRASLADOS
    public function respuestaTraslado(){
        try {
            // Primero aseguramos que la conexión exista
            if ($this->conn == null) {
                $this->conectar();
            }
                
            // Consulta sql
            $stmt = $this->conn->query("SELECT idocumentos, sigla, descripcionDoc FROM documentos WHERE tipo ='Traslado'");
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Enviar datos en formato JSON
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    //MÉTODO PARA CONSULTAR LISTADO DE INVENTARIO POR UNA BODEGA
    public function consultarDisponible($bodega) {
        try {
            $sql = "SELECT productos_referencia, productos_descrip, productos_unidad, bodega_codigo, (SUM(cantidade)-SUM(cantidads)) AS saldo FROM movimientos WHERE bodega_codigo = ? GROUP BY productos_referencia, productos_descrip, productos_unidad, bodega_codigo HAVING (SUM(cantidade)-SUM(cantidads)) > 0 ORDER BY productos_descrip ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$bodega]);
            //Devuelve un array con todas las filas encontradas
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }


    //MÉTODO PARA CONSULTAR LISTADO DE INVENTARIO POR UNA BODEGA AL CORTE DE UNA FECHA
    public function consultarDisponiblecorte($bodega, $fecha) {
        try {
            $sql = "SELECT productos_referencia, productos_descrip, productos_unidad, bodega_codigo, (SUM(cantidade)-SUM(cantidads)) AS saldo FROM movimientos WHERE bodega_codigo = ? AND fecha <= ? GROUP BY productos_referencia, productos_descrip, productos_unidad, bodega_codigo HAVING (SUM(cantidade)-SUM(cantidads)) > 0 ORDER BY productos_descrip ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$bodega, $fecha]);
            //Devuelve un array con todas las filas encontradas
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }


    //MÉTODO PARA CONSULTAR MOVIMIRNOS DE INVENTARIO POR UNA BODEGA A UN PERIODO DE TIEMPO
    public function consultarMovimientos($fechai, $bodega, $ref, $fechain, $fechaf, $bodegaf, $reff) {
        try {
            $sql = "SELECT fecha, documentos_sigla, consecutivo, productos_referencia, productos_descrip, bodega_codigo, observaciones, cantidade, cantidads, CAST( COALESCE((SELECT SUM(CAST(m2.cantidade AS SIGNED)) - SUM(CAST(m2.cantidads AS SIGNED)) FROM movimientos m2 WHERE m2.fecha < ? AND m2.bodega_codigo = ? AND m2.productos_referencia = ? ), 0 ) AS SIGNED)+ SUM(CAST(cantidade AS SIGNED) - CAST(cantidads AS SIGNED)) OVER (ORDER BY fecha ASC, idmovimientos ASC ) AS valor_acumulado FROM movimientos WHERE fecha BETWEEN ? AND ? AND bodega_codigo = ? AND productos_referencia = ? ORDER BY fecha ASC, idmovimientos ASC;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$fechai, $bodega, $ref, $fechain, $fechaf, $bodegaf, $reff]);
            //Devuelve un array con todas las filas encontradas
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }


    //MÉTODO PARA CONSULTAR CONSUMO POR UNA BODEGA A UN PERIODO DE TIEMPO
    public function consultarConsumos($bodega, $fechai, $fechaf) {
        try {
            $sql = "SELECT productos_referencia, productos_descrip, productos_unidad, bodega_codigo, SUM(cantidads) AS Consumo FROM movimientos WHERE documentos_sigla = 'FET' AND bodega_codigo = ? AND fecha >= ? AND fecha <= ? GROUP BY productos_referencia, productos_descrip, productos_unidad, bodega_codigo HAVING SUM(cantidads) > 0 ORDER BY productos_descrip ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$bodega, $fechai, $fechaf]);
            //Devuelve un array con todas las filas encontradas
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
























}
?>
