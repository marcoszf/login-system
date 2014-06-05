<?php
include_once 'config.php';
class User
{
	//Database conexão
	public function __construct()
	{
		$db = new DB_Class();
	}
	
	//Processo de registro
	public function register_user($name, $username, $password, $email)
	{
		$password = md5($password);
		$sqlCheckRegister = "SELECT use_uid from tb_users WHERE use_username = :username or use_email = :email"
		$sqlCheckRegister = $db->prepare($sqlRegister);
		$sqlCheckRegister->bindParam(':username', $username, PDO::PARAM_STR, 12);
		$sqlCheckRegister->bindParam(':email', $email, PDO::PARAM_STR, 12);
		$sqlCheckRegister->execute();
		$result = $sqlCheckRegister->fetch(PDO::FETCH_ASSOC);

		if ($sqlCheckRegister->rowCount() == 0)
		{
			$stmtRegister = "INSERT INTO tb_users(use_username, use_password, use_name, use_email) 
							 VALUES (:username, :password, :name, :email)";
			
			try {
				$stmtRegister->prepare($stmtRegister);
				$stmtRegister->bindParam(':username', $username, PDO::PARAM_STR, 12);
				$stmtRegister->bindParam(':password', $password, PDO::PARAM_STR, 12);
				$stmtRegister->bindParam(':name', $name, PDO::PARAM_STR, 12);
				$stmtRegister->bindParam(':email', $email, PDO::PARAM_STR, 12);
				$stmtRegister->execute();
			} catch (Exception $e) {
				die('Ocorreu um erro ao tentar inserir na base de dados: ' . $e->getMessage());
			}
			
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	// Processo de Login
	public function check_login($emailusername, $password)
	{
		$password = md5($password);
		$sqlCheckLogin = "SELECT use_uid FROM tb_users WHERE use_username = :username OR use_email = :email AND use_password = :password"
		$sqlCheckLogin = $db->prepare($sqlRegister);
		$sqlCheckLogin->bindParam(':username', $username, PDO::PARAM_STR, 12);
		$sqlCheckLogin->bindParam(':email', $email, PDO::PARAM_STR, 12);
		$sqlCheckLogin->bindParam(':password', $password, PDO::PARAM_STR, 12);
		$sqlCheckLogin->execute();
		$result = $sqlCheckLogin->fetch(PDO::FETCH_ASSOC);

		if ($sqlCheckLogin->rowCount() == 1)
		{
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $user_data['uid'];
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// Obtendo nome
	public function get_fullname($uid)
	{
		$sqlFullName = 'SELECT use_name FROM tb_users WHERE use_uid = :uid';
		$stmtFullName = $db->prepare();
		$stmtFullName->bindParam(':uid', $uid, PDO::PARAM_INT);
		$stmtFullName->execute();
		$stmtFullName->bindColumn('use_name', $name);
		$row = $stmtFullName->fetch(PDO::FETCH_BOUND)

		echo $name;
	}

	// Obtendo a sessão
	public function get_session()
	{
		return $_SESSION['login'];
	}

	//efetuando o Logout
	public function user_logout()
	{
		$_SESSION['login'] = FALSE;
		session_destroy();
	}
}
?>