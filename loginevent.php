<?php
/**
 * loginuser short summary.
 *
 * loginuser description.
 *
 * @version 1.0
 * @author Max
 */
    
    class loginevent extends REST{
        public function __construct(){
            parent :: __construct();
            global $sql;
            $this->sql=$sql;
        }
        function Init(){
            $sql=$this->sql;
            if($this->setlog==200){
                $stmta = $sql->Execute($sql->Prepare("INSERT INTO app_eventlog(EVL_EVTCODE,EVL_USERID,EVL_FULLNAME,EVL_ACTIVITIES,EVL_IP,EVL_SESSION_ID,EVL_BROWSER,EVL_RAW, EVL_INPUTEDDATE) VALUES(".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').",".$sql->Param('f').",".$sql->Param('g').",".$sql->Param('h').",".$sql->Param('g').")"),array($this->type,$this->userid,$this->ufullname,$this->activity,$this->remoteip,$this->toinsetsession,$this->useragent,$this->user));
                
                if($stmta == true ){
                    $this->response(array('msg'=>'success','data'=>'done'),200);
                }else{
                    $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),404);
                }


            }else{
                $stmte = $sql->Execute($sql->Prepare("INSERT INTO app_eventlog(EVL_EVTCODE,EVL_USERID,EVL_FULLNAME,EVL_ACTIVITIES,EVL_IP,EVL_SESSION_ID,EVL_BROWSER) VALUES(".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').",".$sql->Param('f').",".$sql->Param('g').")"),array($this->type,'0',$this->ufullname,$this->activity,$this->remoteip,$this->toinsetsession,$this->suseragent));


                if($stmte == true ){
                    $this->response(array('msg'=>'success','data'=>'done'),200);
                }else{
                    $this->response(array('msg'=>'error','data'=>$sql->ErrorMsg()),404);
                }
            }
            
        }
    }    
?>




