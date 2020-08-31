<?php
 
/**
 * oauthuser short summary.
 *
 * oauthuser description.
 *
 * @version 1.0
 * @author Max
 */
class registeruser extends REST
{
    function __construct(){
        parent::__construct();
        global $sql;
        $this->sql = $sql; //var_dump("Iron Man");
    }
    function Init(){
        $sql = $this->sql;
        $engine = new Engine();
        $crypt = new Crypt();
        $password = $crypt->loginPassword($this->usname,$this->pwd);
        $clientid = $engine->generateCode('app_users','COL','USR_CODE');
        $userapikey = $engine->generateAPIKey();
        $email = $this->usname;
       // var_dump($clientid.' | '.$password. ' | '. $userapikey); die();

        if(!empty($this->usname) && !empty($this->pwd)){ //var_dump("Iron Man");
            $stmt = $sql->Execute($sql->Prepare("INSERT INTO 
            
            app_users (USR_CODE,USR_FIRSTNAME,USR_OTHERNAME,USR_USERNAME,USR_PASSWORD,USR_EMAIL,USR_PHONE,USR_APIKEY) 
            
            VALUES(".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').",".$sql->Param('a').")"),
            
            array($clientid,$this->firstname,$this->othernames,$this->usname,$password,$email,$this->phone,$userapikey));
            
                //var_dump($stmt);die;
            if ($stmt == true){
                $checkinit = $sql->Execute($sql->Prepare("SELECT INIT_ID FROM app_init WHERE INIT_USRCODE=".$sql->Param('a')." "),array($this->userid)); //var_dump($this->userid);
                if($checkinit->RecordCount() > 0){
                    $id = $checkinit->FetchRow();
                    $code = $id['INIT_ID'];
                    $sql->Execute($sql->Prepare("UPDATE app_init SET INIT_APIKEY=".$sql->Param('a').",INIT_USRCODE=".$sql->Param('b').",INIT_STATUS='2' WHERE INIT_ID=".$sql->Param('c').""),array($userapikey,$clientid,$code));

                    $stmte = $sql->Execute($sql->Prepare("SELECT USR_CODE,USR_FIRSTNAME,USR_OTHERNAME,USR_EMAIL,USR_APIKEY FROM app_users WHERE USR_STATUS='1' AND USR_CODE=".$sql->Param('a')." AND USR_USERNAME=".$sql->Param('b')." "),array($clientid,$this->usname));
                    $result = $stmte->FetchRow();
                    $this->response(array('msg'=>'success','data'=>$result),200);
                }else{
                    $this->response(array('msg'=>'info','data'=>'user-not-found'),304);
                }
            }else{
                $this->response(array('msg'=>'error','data'=>'Error Inserting Data '.$sql->ErrorMsg()),304);
            }
        }else{
            $this->response(array('msg'=>'info','data'=>'nouserid'),404);
        }
    }
}


