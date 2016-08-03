<?php
include_once ('class.students.php');
include_once ('class.contacts.php');
class Main
{
	private $students;
	private $contacts;
	private $action;
	private $data;
	private $studentId;
	public function __construct()
	{
		session_start ();
		$this->students = new Students ();
		$this->contacts = new Contacts ();
		
		if (isset ( $_POST ['json'] ))
		{
			
			$json = $_POST ['json'];
			$_SESSION ['jsonData'] = $json;
			
			$json = json_decode ( $_SESSION ["jsonData"], true );
			
			$this->data = $json;
			
			$this->action = $json ['request'];
			$this->action_type ();
		}
		else
		{
			
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
				$this->view ();
				break;
		}
	}
	public function create()
	{
		$this->contacts->create();
	}
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
	public function view()
	{
		$return = array ();
		$return ['contacts'] = $this->contacts->view ();
		
		
		echo json_encode ( $return );
		$this->logFile ( json_encode ( $return ) );
	}
	public function remove()
	{
		//$this->business->remove ();
		$this->contacts->remove ();
	}
	private function logFile($msg)
	{
		$myFile = "visibility.txt";
		$fh = fopen ( $myFile, 'a' ) or die ( "can't open file" );
		if (is_array ( $msg ))
		{
			fwrite ( $fh, print_r ( $msg, TRUE ) );
		}
		else
		{
			fwrite ( $fh, $msg . PHP_EOL );
		}
		fclose ( $fh );
	}
}

$main = new Main ();
?>