<?php
/* Hydre-licence-debut */
// --------------------------------------------------------------------------------------------
//
// Hydre - Le petit moteur de web
// Sous licence Creative Common
// Under Creative Common licence CC-by-nc-sa (http://creativecommons.org)
// CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
// (c)Faust MARIA DE AREVALO faust@club-internet.fr
//
// --------------------------------------------------------------------------------------------
/* Hydre-licence-fin */
class Category {
	private $Category = array ();
	
	public function __construct() {}
	
	/**
	 * Gets category data from the database.<br>
	 * <br>
	 * It uses the current WebSiteObj to restrict the category selection to the website ID only. 
	 * @param integer $id
	 */
	public function getCategoryDataFromDB($id) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$dbquery = $dbquery = $bts->SDDMObj->query("
			SELECT * 
			FROM ".$CurrentSetObj->getInstanceOfSqlTableListObj()->getSQLTableName('category')." 
			WHERE cate_id = '".$id."'
			AND ws_id = '".$CurrentSetObj->getInstanceOfWebSiteObj()->getWebSiteEntry('ws_id')."'
		;");
		
		if ( $bts->SDDMObj->num_row_sql($dbquery) != 0 ) {
			$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Loading data for category id=".$id));
			while ( $dbp = $bts->SDDMObj->fetch_array_sql ( $dbquery ) ) {
				foreach ( $dbp as $A => $B ) { $this->Category[$A] = $B; }
			}
		}
		else {
			$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : No rows returned for category id=".$id));
		}
		
	}
	
	//@formatter:off
	public function getCategoryEntry ($data) { return $this->Category[$data]; }
	public function getCategory() { return $this->Category; }
	
	public function setCategoryEntry ($entry, $data) { 
		if ( isset($this->Category[$entry])) { $this->Category[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setCategory($Category) { $this->Category = $Category; }
	//@formatter:off

}


?>