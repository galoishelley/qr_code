<?php 
include_once('class.database.php');

class Func_DB{
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
    public function col_exists($func_code, $func_name){
        $count = $this->db->col_exists('qr_func','FUNC_CODE="'.$func_code.'" or FUNC_NAME="'.$func_name.'"');
        return $count;
    }

    public function create($func_values){
        if($this->col_exists($func_values['func_code'], $func_values['func_name'])){
            return 2;
        };
        // $func = $this->db->insertData('qr_func', "`FUNC_CODE`,`FUNC_NAME`,`NOTE`,`CREATE_USER`,`CREATE_DATE`,`UPDATE_USER`,`UPDATE_DATE`", $func_values);
        $func = $this->db->insertData('qr_func', $func_values);
        return $func;
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
    public function update($func_values){
        $func_code = $func_values['func_code'];
        unset($func_values['func_code']);  

        $return = $this->db->updateData('qr_func', $func_values, 'func_code="'.$func_code.'"');
        return $return;
        // $this->db->updateData('qr_role',array('role_name'=>$role_name,
        //                                         'funcion_id'=>$funcion_id,
        //                                         'note'=>$note,
        //                                       ),'func_code='.$func_code);
    }
     

    public function view(){
        $func = $this->db->fetchAll('qr_func');
        
        return $func;
    }
   
    public function viewAll($func_values){
        $search_con = $func_values['search_con'];
        $sql = "SELECT concat('func_', @rownum:=@rownum+1) AS DT_RowId, qr_func.* FROM (SELECT @rownum:=0) r, qr_func where func_code like '%". $search_con ."%' or func_name like '%".$search_con ."%'";
        $func = $this->db->fetchAll_sql($sql,null);
        
        return $func;
    }
    
    public function remove($func_values){
        $arrlength=count($func_values);
        for($i = 0; $i < $arrlength; $i++)
        $func = $this->db->deleteData('qr_func',"func_code='".$func_values[$i]."'");
        return $func;
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