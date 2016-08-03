<?php
include_once ('class.func_db.php');
class Func
{
	private $func;
	private $func_values = array();

	public function __construct()
	{
		session_start ();
		$this->func = new Func_DB();

		if (isset ( $_POST ['action_type'] )){
				
			$action_type = $_POST ['action_type'];
			
			if($action_type == "create" || $action_type == "update"){

				if (isset ( $_POST ['func_code'] )){
					$this->func_values['func_code'] = $_POST ['func_code'];
				}

				if (isset ( $_POST ['func_name'] )){
					$this->func_values['func_name'] = $_POST ['func_name'];
				}
				if (isset ( $_POST ['note'] )){
					$this->func_values['note'] = $_POST ['note'];
				}
				
				if($action_type == "create"){
					$this->func_values['create_user'] = "admin";
					$this->func_values['create_date'] = "2014-07-10 10:33:12";
				}

				$this->func_values['update_user'] = "admin";
				$this->func_values['update_date'] = "2016-07-10 10:33:12";

			}elseif($action_type == "remove"){

				if (isset ( $_POST ['func_codes'] )){
					$this->func_values = $_POST ['func_codes'];
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
				$this->func_values['search_con'] = $_POST ['search_con'];
			}else
			{
				$this->func_values['search_con'] = 'null';
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
		$return = $this->func->create($this->func_values);
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
		$return["data"]= $this->func->viewAll ($this->func_values);

		echo json_encode ( $return );
		//$this->logFile ( json_encode ( $return ) );
	}



	public function view()
	{
		$return = array ();
		$return["data"]= $this->func->view ();

		echo json_encode ( $return );
		//$this->logFile ( json_encode ( $return ) );
	}

	 public function remove()
	{
		$return = $this->func->remove ($this->func_values);
		if($return)
			echo 1;
		else
			echo 0;
		// echo json_encode ( $return );
	}

	public function update(){
		$return = $this->func->update ($this->func_values);
		echo $return;
	}

	public function getDataTime(){
		// var d = new Date()
		// var vYear = d.getFullYear()
		// var vMon = d.getMonth() + 1
		// var vDay = d.getDate()
		// var h = d.getHours(); 
		// var m = d.getMinutes(); 
		// var se = d.getSeconds(); 
		// s=vYear+(vMon<10 ? "0" + vMon : vMon)+(vDay<10 ? "0"+ vDay : vDay)+(h<10 ? "0"+ h : h)+(m<10 ? "0" + m : m)+(se<10 ? "0" +se : se);
		//document.write(s);
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

$qr_func = new Func();
?>