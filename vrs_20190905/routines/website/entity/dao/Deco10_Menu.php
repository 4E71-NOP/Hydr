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
class Deco10_Menu {
	private $Deco10_Menu = array ();
	public function __construct() {
	}
	public function getDeco10_MenuDataFromDB($id) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );
		
		$LMObj = LogManagement::getInstance();
		$dbquery = $SDDMObj->query ( "
			SELECT *
			FROM " . $SqlTableListObj->getSQLTableName ('deco_10_menu') . "
			WHERE deco_id = '" . $id . "'
			;" );
		if ( $SDDMObj->num_row_sql($dbquery) != 0 ) {
			$LMObj->InternalLog(__METHOD__ . " : Loading data for deco_10_menu id=".$id);
			while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
				$this->Deco10_Menu[$dbp['deco_variable']] = $dbp['deco_valeur'];
			}
		}
		else {
			$LMObj->InternalLog(__METHOD__ . " : No rows returned for deco_10_menu id=".$id);
		}
		
	}

	//@formatter:off
	public function getDeco10_MenuEntry ($data) { return $this->Deco10_Menu[$data]; }
	public function getDeco10_Menu() { return $this->Deco10_Menu; }
	
	public function setDeco10_MenuEntry ($entry, $data) { 
		if ( isset($this->Deco10_Menu[$entry])) { $this->Deco10_Menu[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setDeco10_Menu($Deco10_Menu) { $this->Deco10_Menu = $Deco10_Menu; }
	//@formatter:off

}


?>