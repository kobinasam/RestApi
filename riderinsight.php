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
class riderinsight extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    
    function Init(){;
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT *  FROM app_requests WHERE REQ_REQUEST_CODE=".$sql->Param('a')." AND REQ_REQUESTORCODE=".$sql->Param('b')." AND REQ_DATE=".$sql->Param('c')." "),array($this->requestcode, $this->requestorcode, $this->requestdate));
        if($stmt == true){
            $result =$stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}