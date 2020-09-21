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
class SmallVariable {
	private $SmallVariable = array ();
	public function __construct() {
	}
	public function getSmallVariableDataFromDB($id) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );
		
		$LMObj = LogManagement::getInstance();
		$dbquery = $SDDMObj->query ( "
			SELECT *
			FROM " . $SqlTableListObj->getSQLTableName ('small_variable') . "
			WHERE small_variable_id = '" . $id . "'
			;" );
		if ( $SDDMObj->num_row_sql($dbquery) != 0 ) {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : Loading data for small_variable id=".$id));
			while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
				foreach ( $dbp as $A => $B ) { $this->SmallVariable[$A] = $B; }
			}
		}
		else {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : No rows returned for small_variable id=".$id));
		}
	}

	//@formatter:off
	public function getSmallVariableEntry ($data) { return $this->SmallVariable[$data]; }
	public function getSmallVariable() { return $this->SmallVariable; }
	
	public function setSmallVariableEntry ($entry, $data) { 
		if ( isset($this->SmallVariable[$entry])) { $this->SmallVariable[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setSmallVariable($SmallVariable) { $this->SmallVariable = $SmallVariable; }
	//@formatter:off

}


?>