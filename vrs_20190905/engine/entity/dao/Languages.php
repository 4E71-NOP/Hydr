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
class Languages {
	private $Languages = array ();
	public function __construct() {
	}
	public function getLanguagesDataFromDB($id) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );
		
		$LMObj = LogManagement::getInstance();
		$dbquery = $SDDMObj->query ( "
			SELECT *
			FROM " . $SqlTableListObj->getSQLTableName ('languages') . "
			WHERE lang_id = '" . $id . "'
			;" );
		if ( $SDDMObj->num_row_sql($dbquery) != 0 ) {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : Loading data for languages id=".$id));
			while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
				foreach ( $dbp as $A => $B ) { $this->Languages[$A] = $B; }
			}
		}
		else {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : No rows returned for languages id=".$id));
		}
		
	}

	//@formatter:off
	public function getLanguagesEntry ($data) { return $this->Languages[$data]; }
	public function getLanguages() { return $this->Languages; }
	
	public function setLanguagesEntry ($entry, $data) { 
		if ( isset($this->Languages[$entry])) { $this->Languages[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setLanguages($Languages) { $this->Languages = $Languages; }
	//@formatter:off

}


?>