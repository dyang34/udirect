<?php
require_once $_SERVER['DOCUMENT_ROOT']."/classes/admin/AdmMemberDao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/A_Mgr.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/DbUtil.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/WhereQuery.php";

class AdmMemberMgr extends A_Mgr
{
    private static $instance = null;
    
    private function __construct() {
        // getInstance() 이용.
    }
    
    static function getInstance() {
        if ( self::$instance == null ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    function getByKey($key) {
        
        $row = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $row = AdmMemberDao::getInstance()->selectByKey($db, $key);
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $row;
    }
    function getFirst($wq) {
        
        $row = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $row = AdmMemberDao::getInstance()->selectFirst($db, $wq);

        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
      @ $db->close();
        return $row;
    }
    
    /*
     *	$result 사용후 반드시 @ $result->free(); 해줘야 한다.
     */
    function getList($wq) {
        
        $result = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $result = AdmMemberDao::getInstance()->select($db, $wq);
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $result;
    }
    
    /*
     *	$result 사용후 반드시 @ $result->free(); 해줘야 한다.
     */
    function getListPerPage($wq, $pg) {
        
        $result = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $pg->setTotalCount(AdmMemberDao::getInstance()->selectCount($db, $wq));
            $result = AdmMemberDao::getInstance()->selectPerPage($db, $wq, $pg);
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $result;
    }

    function getCount($wq) {
        
        $result = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $result = AdmMemberDao::getInstance()->selectCount($db, $wq);
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $result;
    }
    
    function exists($wq) {
        
        $result = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            $result = AdmMemberDao::getInstance()->exists($db, $wq);
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $result;
    }
    
    function add($arrVal) {
        
        $isOk = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            //            $this->startTran($db);
            
            $isOk = AdmMemberDao::getInstance()->insert($db, $arrVal);
            
            //            $this->commit($db);
            
        } catch(Exception $e) {
            //            $this->rollback($db);
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $isOk;
    }
    
    function edit($uq, $key) {
        
        $isOk = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            //$this->startTran($db);
            
            $isOk = AdmMemberDao::getInstance()->update($db, $uq, $key);
            
            //$this->commit($db);
            
        } catch(Exception $e) {
            //$this->rollback($db);
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $isOk;
    }
    
    function delete($key) {
        
        $isOk = null;
        $db = null;
        
        try {
            $db = DbUtil::getConnection();
            
            //$this->startTran($db);
            
            $isOk = AdmMemberDao::getInstance()->delete($db, $key);
            
            //$this->commit($db);
            
        } catch(Exception $e) {
            //$this->rollback($db);
            echo $e->getMessage();
        }
        
        @ $db->close();
        return $isOk;
    }
}
?>