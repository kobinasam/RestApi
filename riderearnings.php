


<?php
        //echo 'Iron Man';

        //var_dump('Iron Man');
/**
 * oauthuser short summary.
 *
 * oauthuser description.
 *
 * @version 1.0
 * @author Max
 */
class riderearnings extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    function Init(){
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT *  FROM app_payrider WHERE PRD_CODE=".$sql->Param('a')." AND PRD_RIDERCODE=".$sql->Param('b')." AND PRD_DATEPAID=".$sql->Param('c')." "),array($this->payridercode, $this->ridercode, $this->datepaid));
        if($stmt == true){
            $result = $stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}