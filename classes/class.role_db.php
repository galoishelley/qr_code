<?php 
include_once('class.database.php');

error_reporting( E_ALL&~E_NOTICE );

class Role_DB{
    private $db;
    public $lastid;
    public function __construct(){  

   $this->db = new Database();
	/**
    if(isset($_POST['json'])){
        $json = $_POST['json'];
        $_SESSION['jsonData'] = $json;
        $json = json_decode($_SESSION["jsonData"],true);
        $this->data = $json;
        $this->action = $json['request'];
         $this->lastid = $this->db->lastInsertId();

         
    }else{
        $this->lastid = $this->db->lastInsertId();
    }
    **/
    }
    public function col_exists($role_code, $role_name){
        $count = $this->db->col_exists('qr_role','ROLE_CODE="'.$role_code.'" or ROLE_NAME="'.$role_name.'"');
        return $count;
    }

    public function create($role_values){
        if($this->col_exists($role_values['role_code'], $role_values['role_name'])){
            return 2;
        };
        // $func = $this->db->insertData('qr_role', "`FUNC_CODE`,`ROLE_NAME`,`NOTE`,`CREATE_USER`,`CREATE_DATE`,`UPDATE_USER`,`UPDATE_DATE`", $role_values);
        $ref = $this->db->insertData('qr_role', $role_values);
        return $ref;
    }

    /**
    public function save(){
        
        $this->logFile($this->data);
        $sFname = $this->data['sFname'];
        $sMname= $this->data['sMname'];
        $sLname = $this->data['sLname'];
        $sAddress = $this->data['sAddress'];
        $sNotes =$this->data['sNotes'];
    
        
        $this->lastid = $this->db->insertData('students',
                               array('sFname','sMname','sLname','sAddress','sNotes'),
                               array($sFname,$sMname,$sLname,$sAddress,$sNotes));
       
    }
    **/
    public function update($role_values){
        $role_code = $role_values['role_code'];
        unset($role_values['role_code']);  

        $ref = $this->db->updateData('qr_role', $role_values, 'role_code="'.$role_code.'"');
        return $ref;
        // $this->db->updateData('qr_role',array('role_name'=>$role_name,
        //                                         'funcion_id'=>$funcion_id,
        //                                         'note'=>$note,
        //                                       ),'role_code='.$role_code);
    }
     

    public function view(){
        $ref = $this->db->fetchAll('qr_role');
        
        return $ref;
    }
   
    public function viewAll($role_values){
        $search_con = $role_values['search_con'];
        // $sql = "SELECT concat('role_', @rownum:=@rownum+1) AS DT_RowId, qr_role.* FROM (SELECT @rownum:=0) r, qr_role where role_code like '%". $search_con ."%' or role_name like '%".$search_con ."%'";
        $sql = "SELECT concat('role_', @rownum:=@rownum+1) AS DT_RowId, a.*, GROUP_CONCAT(b.func_name) AS FUNC_NAME FROM (SELECT @rownum:=0) r, qr_role a, qr_func b where (role_code like '%". $search_con ."%' or role_name like '%".$search_con ."%') and a.func_id= b.func_id group by a.role_code";

        $ref = $this->db->fetchAll_sql($sql,null);
        
        return $ref;
    }
    
    public function remove($role_values){
        $arrlength=count($role_values);
        for($i = 0; $i < $arrlength; $i++){
            $ref = $this->db->deleteData('qr_role', 'role_code = "'.$role_values[$i].'"');
        }
        return $ref;
    }
    /**
    private function logFile($msg)
    {
        $myFile = "visibility.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
            if(is_array($msg)){
            fwrite($fh, print_r($msg, TRUE));
            
        } else {
            fwrite($fh, $msg . PHP_EOL);
        }
        fclose($fh);
    }
    **/
}
?>