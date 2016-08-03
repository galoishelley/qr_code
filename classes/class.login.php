<?php
include_once ('class.login_db.php');

class Login
{
	private $users;
	private $user_name;
	private $pwd;
	public function __construct()
	{
		session_start ();
		$this->users = new User();
		
		if (isset ( $_POST ['user_name'] ) && isset ( $_POST ['pwd'] ))
		{
			
			$this->user_name = $_POST ['user_name'];
			$this->pwd = $_POST ['pwd'];
			
			$_SESSION ['user_name'] = $this->user_name;
			$_SESSION ['user_pwd'] = $this->pwd;
			
			//$json = json_decode ( $_SESSION ["jsonData"], true );
			
			//$this->data = $json;
			
			$this->action = "";
			$this->action_type ();
		}
		else
		{
			
			$this->action = "";
			$this->action_type ();
			
			// echo 'JSON is empty';
		}
	}
	public function action_type()
	{
		switch ($this->action)
		{
			case 'create' :
				$this->create ();
				break;
			case 'save' :
				$this->save ();
				break;
			case 'update' :
				$this->update ();
				break;
			case 'remove' :
				$this->remove ();
				break;
			default :
				$this->view ();
				break;
		}
	}

	public function view()
	{
		$return = array ();
		
		//login
		$return ['iCount'] = $this->users->viewCount ($this->user_name, $this->pwd);
	
		
		echo json_encode ( $return);
		//$this->logFile ( json_encode ( $return ) );
	}
}

$login = new Login ();
?>