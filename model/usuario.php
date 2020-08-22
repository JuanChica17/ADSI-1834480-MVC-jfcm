<?php
class Usuario
{
	//Atributo de conexion a la base de datos
	private $pdo;

	//Atributos de la clase
	public $id;
	public $email;
	public $password;
	public $nombre;

	public function __CONSTRUCT(){
		try {

			$this->pdo = Database::startUp();

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function index()
	{
		try {

			$stmt = $this->pdo->prepare("SELECT * FROM usuario");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function estadisticas()
	{
		try{
			$stmt = $this->pdo->prepare("SELECT COUNT(*) AS cantidad FROM usuario GROUP BY genero");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}catch(Exception $e){

			  die($e->getMessage());
			  
		}
	}

	public function delete($id)
	{
		try {

			$stmt = $this->pdo->prepare("DELETE FROM usuario WHERE id = ?");
			$stmt->execute(array($id));
			return true;

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function create($email,$password,$nombre,$genero)
	{
		try {

			$stmt = $this->pdo->prepare("INSERT INTO usuario (email,password,nombre,genero) VALUES (?,?,?,?)");
			$stmt->execute(array($email,$password,$nombre,$genero));
			return $this->pdo->lastInsertId();

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function view($id)
	{
		try {

			$stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
			$stmt->execute(array($id));
			return $stmt->fetch(PDO::FETCH_OBJ);

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function update($email,$password,$nombre,$genero,$id)
	{
		try {

			$stmt = $this->pdo->prepare("UPDATE usuario SET email = ?, password = ?, nombre = ?, genero = ? WHERE id = ?");
			$stmt->execute(array($email,$password,$nombre,$genero,$id));
			return true;

		} catch (Exception $e) {

			die($e->getMessage());

		}
	}

	public function validate($email, $password)
	{
	$stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ? AND password = ?");
	$stmt->execute(array($email,$password));
			if($stmt->rowCount() > 0){
				return $stmt->fetch(PDO::FETCH_OBJ);
			}else{
				return false;
			}
	}

	public function lastAccess($id){
		$dateTime = date('Y-m-d h:i:s');
		$stmt = $this->pdo->prepare("UPDATE usuario SET lastAccess = ? WHERE id = ?");
		$stmt->execute(array($dateTime, $id));
	}


}
?>