<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/classes/cms/db/A_Dao.php";

class ConsultDao extends A_Dao
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

	function selectByKey($db, $key) {
		 
	    $sql =" select ucr_idx, name, hp, content, fg_del, regdate, fg_process, memo, procdate, upddate "
	        ." from ud_consult_req "
			." where ucr_idx = ".$this->quot($db, $key)
		;
		
		$row = null;
		$result = $db->query($sql);
		if ( $result->num_rows > 0 ) {
		    $row = $result->fetch_assoc();
		}
		
		@ $result->free();

        return $row;
	}

	function selectFirst($db, $wq) {

		$sql =" select ucr_idx, name, hp, content, fg_del, regdate, fg_process, memo, procdate, upddate "
			." from ud_consult_req"
			.$wq->getWhereQuery()
			.$wq->getOrderByQuery()
		;
		
		$row = null;

		$result = $db->query($sql);
		if ( $result->num_rows > 0 ) {
		    $row = $result->fetch_assoc();
		}
		
		@ $result->free();
		
		return $row;
	}

	function select($db, $wq) {
	    
		$sql =" select ucr_idx, name, hp, content, fg_del, regdate, fg_process, memo, procdate, upddate "
			." from ud_consult_req a "
			.$wq->getWhereQuery()
			.$wq->getOrderByQuery()
		;
		
        return $db->query($sql);
	}
	
	function selectPerPage($db, $wq, $pg) {
		
		$sql =" select @rnum:=@rnum+1 as rnum, r.* from ("
			."		select @rnum:=0, ucr_idx, name, hp, content, fg_del, regdate, fg_process, memo, procdate, upddate "
			." 		from ud_consult_req a "
			." 		INNER JOIN ( "
	        ."			select ucr_idx as idx from ud_consult_req a "
            			.$wq->getWhereQuery()
						.$wq->getOrderByQuery()
	        ."     		limit ".$pg->getStartIdx().", ".$pg->getPageSize()
	        ." 		) pg_idx "
	        ." 		on a.ucr_idx=pg_idx.idx "
			." ) r"
		;

        return $db->query($sql);
	}

	function selectCount($db, $wq) {

		$sql =" select count(*) cnt"
		    ." from ud_consult_req a "
			.$wq->getWhereQuery()
		;
		
		$row = null;
		$result = $db->query($sql);
		if ( $result->num_rows > 0 ) {
		    $row = $result->fetch_assoc();
		}
		
		@ $result->free();
		
		return $row["cnt"];
	}
	
	function exists($db, $wq) {

		$sql =" select count(*) cnt"
		    ." from ud_consult_req a "
			.$wq->getWhereQuery()
		;

		$row = null;
		$result = $db->query($sql);
		if ( $result->num_rows > 0 ) {
		    $row = $result->fetch_assoc();
		}
		
		@ $result->free();
		
		if ( $row["cnt"] > 0 ) {
			return true;
		} else {
			return false;
		}
	}

	function insert($db, $arrVal) {

	    $sql =" insert into ud_consult_req(name, hp, content, regdate)"
	        ." values ('".$this->checkMysql($db, $arrVal["name"])
				."', '".$this->checkMysql($db, $arrVal["hp"])
	            ."', '".$this->checkMysql($db, $arrVal["content"])
	            ."', now())"
		;
		
		return $db->query($sql);
	}

	function update($db, $uq, $key) {
	    
	    $sql =" update ud_consult_req"
	        .$uq->getQuery($db)
	        ." where ucr_idx = ".$this->quot($db, $key);
	        
		return $db->query($sql);
	}

	function delete($db, $key) {
	    if ($key) {
    	    $sql = "update ud_consult_req set fg_del = 1, deldate=now() where ucr_idx = ".$this->quot($db, $key);

    	    return $db->query($sql);
	    }
	}
}
?>