<?php

/**
 * oauthuser short summary.
 *
 * oauthuser description.
 *
 * @version 1.0
 * @author Max
 */
class getusers extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    function Init(){
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT USR_FIRSTNAME, USR_OTHERNAME, USR_EMAIL,USR_PHONE FROM app_users WHERE USR_CODE=".$sql->Param('a')." AND USR_ACTOR_ID=".$sql->Param('b')." AND USR_BRANCH_CODE=".$sql->Param('c')." "),array($this->usrcode,$this->usractid, $this->usrbrcode));
        if($stmt == true){
            $result = $stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}