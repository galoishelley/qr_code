<?php
include_once ('class.role_db.php');
class Role
{
	private $role;
	private $role_values = array();

	public function __construct()
	{
		session_start ();
		$this->role = new Role_DB();

		$this->user_name = $_SESSION ['user_name'];
		$this->user_pwd = $_SESSION ['user_pwd'];
		$this->date = date("Y-m-d h:i:s",time());
		
		if (isset ( $_POST ['action_type'] )){
				
			$action_type = $_POST ['action_type'];
			
			if($action_type == "create" || $action_type == "update"){

				if (isset ( $_POST ['role_code'] )){
					$this->role_values['role_code'] = $_POST ['role_code'];
				}

				if (isset ( $_POST ['role_name'] )){
					$this->role_values['role_name'] = $_POST ['role_name'];
				}
				if (isset ( $_POST ['func_name'] )){
					$this->role_values['func_name'] = $_POST ['func_name'];
				}
				
				if($action_type == "create"){
					$this->role_values['create_user'] = $this->user_name;
					$this->role_values['create_date'] = $this->date;
				}

				$this->role_values['update_user'] = $this->user_name;
				$this->role_values['update_date'] = $this->date;

			}elseif($action_type == "remove"){

				if (isset ( $_POST ['role_codes'] )){
					$this->role_values = $_POST ['role_codes'];
				}

			}
			
			//$_SESSION ['jsonData'] = $json;
				
			//$json = json_decode ( $_SESSION ["jsonData"], true );
				
			//$this->data = $json;
				
			$this->action = $action_type;
			$this->action_type ();
		}
		else
		{
				
			if (isset ( $_POST ['search_con'] )){
				$this->role_values['search_con'] = $_POST ['search_con'];
			}else
			{
				$this->role_values['search_con'] = 'null';
			}
			
			$this->action = "";
			$this->action_type ();
			// echo 'JSON is empty';
		}
	}
	private function action_type()
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
				$this->viewAll ();
				//$this->getDataTime();
				break;
		}
	}

	public function create()
	{
		$return = $this->role->create($this->role_values);
		echo $this->role_values;
		echo $return;
	}
	/*
	public function save()
	{
	$this->students->save ();
	$studentId = $this->students->lastid;
	$this->contacts->save ( $studentId );
	}
	public function update()
	{
	//$this->students->update ();
	$this->contacts->update ();
	}
	*/
	public function viewAll()
	{
		$return = array ();
		$return["data"]= $this->role->viewAll ($this->role_values);

		echo json_encode ( $return );
		//$this->logFile ( json_encode ( $return ) );
	}



	public function view()
	{
		$return = array ();
		$return["data"]= $this->role->view ();

		echo json_encode ( $return );
		//$this->logFile ( json_encode ( $return ) );
	}

	 public function remove()
	{
		//print_r($this->role_values);
		$return = $this->role->remove ($this->role_values);
		echo "class.role.php->remove():".$return."\n";
		echo $return;
		// echo json_encode ( $return );
	}

	public function update(){
		$return = $this->role->update ($this->role_values);
		echo $return;
	}

	// private function logFile($msg)
	// {
	// 	$myFile = "visibility.txt";
	// 	$fh = fopen ( $myFile, 'a' ) or die ( "can't open file" );
	// 	if (is_array ( $msg ))
	// 	{
	// 	fwrite ( $fh, print_r ( $msg, TRUE ) );
	// 	}
	// 	else
	// 	{
	// 	fwrite ( $fh, $msg . PHP_EOL );
	// 	}
	// 	fclose ( $fh );
	// }
}

$qr_role = new Role();
?>