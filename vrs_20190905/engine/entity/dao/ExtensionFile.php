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
class ExtensionFile {
	private $ExtensionFile = array ();
	public function __construct() {
	}
	public function getExtensionFileDataFromDB($id) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );

		$LMObj = LogManagement::getInstance();
		$dbquery = $SDDMObj->query ( "
			SELECT *
			FROM " . $SqlTableListObj->getSQLTableName ('extension_files') . "
			WHERE file_id = '" . $id . "'
			;" );
		if ( $SDDMObj->num_row_sql($dbquery) != 0 ) {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : Loading data for Extension_files id=".$id));
			while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
				foreach ( $dbp as $A => $B ) { $this->ExtensionFile[$A] = $B; }
			}
		}
		else {
			$LMObj->InternalLog( array( 'level' => loglevelStatement, 'msg' => __METHOD__ . " : No rows returned for Extension_files id=".$id));
		}
		
	}

	//@formatter:off
	public function getExtensionFileEntry ($data) { return $this->ExtensionFile[$data]; }
	public function getExtensionFile() { return $this->ExtensionFile; }
	
	public function setExtensionFileEntry ($entry, $data) { 
		if ( isset($this->ExtensionFile[$entry])) { $this->ExtensionFile[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setExtensionFile($ExtensionFile) { $this->ExtensionFile = $ExtensionFile; }
	//@formatter:off

}


?>