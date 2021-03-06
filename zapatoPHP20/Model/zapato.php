<?php

class zapato{

    public $CNX;
    public $id_zapato;
    public $precio;
    public $color;
    public $id_estilo;
    public $id_talla;
    public $id_genero;
    public $cantidad;

    public function __construct(){
        try{
            $this->CNX = conexion::conectar();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function listar(){

        try{
            $query="SELECT z.id_zapato,z.precio,z.color,e.estilo,t.talla, g.genero, z.cantidad FROM dbozapato z INNER JOIN dboestilo e ON z.id_estilo = e.id_estilo INNER JOIN dbotalla t ON t.id_talla = z.id_talla INNER JOIN dbogenero g ON g.id_genero=z.id_genero
            ";
            $smt=$this->CNX->prepare($query);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function cargarEstilo(){

        try{
            $query="SELECT * FROM dboestilo";
            $smt=$this->CNX->prepare($query);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }

        
    }

    public function cargarID($id){

        try{
            $query="SELECT * FROM dbozapato WHERE id_zapato=?";
            $smt=$this->CNX->prepare($query);
            $smt->execute(array($id));
            $result = $smt->fetch(PDO::FETCH_OBJ);

            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }

    }

    public function cargarTalla(){

        try{
            $query="SELECT * FROM dbotalla";
            $smt=$this->CNX->prepare($query);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }

    }

    public function cargarGenero(){

        try{
            $query="SELECT * FROM dbogenero";
            $smt=$this->CNX->prepare($query);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_OBJ);

            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function registrar(zapato $data){
        try {
            $query = "INSERT INTO dbozapato (precio,color,id_estilo,id_talla,id_genero,cantidad) values (?,?,?,?,?,?)";
            $this->CNX->prepare($query)->execute(array($data->precio,$data->color,$data->id_estilo,$data->id_talla,$data->id_genero,$data->cantidad));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarDatos(zapato $data){
        try {
            $query = "UPDATE dbozapato SET precio=?,color=?,id_estilo=?,id_talla=?,id_genero=?,cantidad=? WHERE id_zapato=?";
            $this->CNX->prepare($query)->execute(array($data->precio,$data->color,$data->id_estilo,$data->id_talla,$data->id_genero,$data->cantidad,$data->id_zapato));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try {
            $query= "DELETE FROM dbozapato WHERE id_zapato=?";
            $smt = $this->CNX->prepare($query);
            $smt->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}   
?>