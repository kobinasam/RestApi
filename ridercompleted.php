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
class ridercompleted extends REST
{
    function __construct(){
        parent::__construct();
        global$sql;
        $this->sql=$sql;
    }
    function Init(){
        $sql=$this->sql;
        $stmt = $sql->Execute($sql->Prepare("SELECT REQ_REQUESTORNAME,REQ_RIDERNAME,REQ_RIDERPHONE,REQ_BIKENUMBER,REQ_LOCATION,REQ_LOCATION_ID_FROM,REQ_LOCATION_FROM,REQ_ITEMS,REQ_LOCATION_ID,REQ_DESCRIPTION,REQ_PICKUP_DATE,REQ_PICKUP_TIME,REQ_TOTAL_AMOUNT,REQ_DATE,REQ_REQUESTED_DATE,REQ_RIDER_ACCEPTED_DATE, REQ_TOTAL_ITEMS,REQ_REQUESTOR_PHONE  FROM app_requests WHERE REQ_REQUEST_CODE=".$sql->Param('a')." AND REQ_REQUESTORCODE=".$sql->Param('b')." AND REQ_STATUS=5 AND REQ_DATE=".$sql->Param('d')." "),array($this->requestcode, $this->requestorcode, $this->requestdate));
        if($stmt == true){
            $result = $stmt->FetchRow();
            $this->response(array('msg'=>'success','data'=>$result),200);
        }else{
            $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),204);
        }
    }
}