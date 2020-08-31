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
class getnotifications extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    function Init(){
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT NOTI_SENDER,NOTI_RECEIVER,NOTI_MESSAGE,NOTI_TYPE,NOTI_DATE,NOTI_TITLE,NOTI_ICON,NOTI_SERVICE,NOTI_RECEIVERCOMPCODE FROM app_notifications WHERE NOTI_CODE=".$sql->Param('a')." AND NOTI_DATE=".$sql->Param('b')." AND NOTI_STATUS=".$sql->Param('c')." "),array($this->noticode, $this->notidate, $this->notistatus));
        if($stmt == true){
            $result = $stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}