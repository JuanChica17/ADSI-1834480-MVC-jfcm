<?php
require_once 'model/usuario.php';

class UsuarioController{
	private $model;

	public function __CONSTRUCT()
	{
		$this->model = new Usuario();
	}

	/*public function validate($email, $password)
	{
		$validate = $this->model->validate($email,$password);
		return $validate;
	}*/

	public function dashboard(){
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/footer.php';
	}

	public function index(){
		$rows = $this->model->index();
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/usuario/index.php';
		require_once 'view/footer.php';
	}

	public function estadisticas(){
		$rows1 = $this->model->estadisticas();
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/usuario/estadisticas.php';
		require_once 'view/footer.php';
	}

	public function delete()
	{
		$this->model->delete($_REQUEST['id']);
		$msg = Database::encryptor("encrypt", "Usuario Eliminado Satisfactoriamente!!!");
		$err = Database::encryptor("encrypt", 2);
		header("location: index.php?c=".Database::encryptor('encrypt', 'usuario')."&a=".Database::encryptor('encrypt', 'index')."&m=".$msg."&e=".$err);
	}

	public function edit()
	{
		if(!isset($_REQUEST['id'])){
			$id = null;
			$email =  null;
			$password =  null;
			$nombre =  null;
			$genero = null;
			$select1 = null;
			$select2 = null;
			$button = 'Crear Usuario';
		}else{
			$id = $_REQUEST['id'];
			$row = $this->model->view($id);
			$email = $row->email;
			$password = $row->password;
			$nombre = $row->nombre;
			$genero = $row->genero;
			if($genero == 'Masculino'){
				$select1 = 'selected';
				$select2 = null;
			}else{
				$select2 = 'selected';
				$select1 = null;
			}
			$button = 'Actualizar Usuario';
		}
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/usuario/edit.php';
		require_once 'view/footer.php';
	}

	public function crud()
	{
		$id = $_REQUEST['id'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$nombre = $_REQUEST['nombre'];
		$genero = $_REQUEST['genero'];
		if($id == null){
			$lastId = $this->model->create($email,$password,$nombre,$genero);
			mkdir('documents/'.$lastId, 0700);
			$msg = Database::encryptor("encrypt", "Usuario Creado Satisfactoriamente!!!");
			$err = Database::encryptor("encrypt", 0);
		}else{
			$this->model->update($email,$password,$nombre,$genero,$id);
			$msg = Database::encryptor("encrypt", "Usuario Actualizado Satisfactoriamente!!!");
			$err = Database::encryptor("encrypt", 1);
		}
		header("location: index.php?c=".Database::encryptor('encrypt', 'usuario')."&a=".Database::encryptor('encrypt', 'index')."&m=".$msg."&e=".$err);
	}

	public function login(){
		require_once 'view/message.php';
		require_once 'view/usuario/login.php';
	}

	public function validate($email,$password){
		$msg = Database::encryptor('encrypt', 'El correo o la contraseña no son incorrectos');
		$err = Database::encryptor('encrypt', 2);

		$row = $this->model->validate($email,$password);
		if($row != false){
			$this->model->lastAccess($row->id);
			$_SESSION['id'] = $row->id;
			$_SESSION['nombre'] = $row->nombre;
			$_SESSION['genero'] = $row->genero;
			$msg = Database::encryptor('encrypt', 'Bienvenido al sistema querido usuario');
			$err = Database::encryptor('encrypt', 0);
		}
			header('location: index.php?m='.$msg.'&e='.$err);
	}


	public function logout(){
	$_SESSION = array();
	if(ini_get("session.use_cookies")){
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	session_destroy();
	header('location: index.php');
	}

	public function upload(){
		$id = Database::encryptor('decrypt', $_REQUEST['id']);
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/usuario/upload.php';
		require_once 'view/footer.php';
	}

	public function uploadFile(){
		$id = $_REQUEST['id'];
		$err = Database::encryptor('encrypt', 0);
		$msg = Database::encryptor('encrypt', 'Documento Subido Satisfactoriamente');

		$target_dir = "documents/$id/";

		if(!file_exists($target_dir)){
			mkdir($target_dir, 0700);
		}

		move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES["file"]["name"]);
		/*
		if($_FILES['file']["type"] == "application/pdf"){

			move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES["file"]["name"]);

		}else if($_FILES['file']["type"] == "image/jpeg"){

			move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES["file"]["name"]);

		}else if($_FILES['file']["type"] == "image/png"){

			move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES["file"]["name"]);

		}else{

		$err = Database::encryptor('encrypt', 2);
		$msg = Database::encryptor('encrypt', 'Documento Subido No Valido');
		
		}*/

		
		header("location: index.php?c=".Database::encryptor('encrypt', 'usuario')."usuario&a=".Database::encryptor('encrypt', 'index')."&m=".$msg."&e=".$err);
	}

	public function viewDoc()
	{
		$id = Database::encryptor('decrypt', $_REQUEST['id']);
		require_once 'view/header.php';
		require_once 'view/message.php';
		require_once 'view/usuario/viewDoc.php';
		require_once 'view/footer.php';
	}



}
?>