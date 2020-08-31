<?php

/**
 * oauthuser short summary.
 *
 * oauthuser description.
 *
 * @version 1.0
 * @author Max
 */
class getriders  extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    function Init(){
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT * FROM app_riders WHERE RDR_CODE=".$sql->Param('a')." AND RDR_BIKE_CODE=".$sql->Param('b')." AND RDR_STATUS=".$sql->Param('c')." "), array($this->ridercode, $this->riderbikecode, $this->riderstatus));
        if($stmt == true){
            $result = $stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}