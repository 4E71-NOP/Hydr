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
class DocumentShare {
	private $DocumentShare = array ();
	public function __construct() {
	}
	public function getDocumentShareDataFromDB($data) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );

		$dbquery = $SDDMObj->query ( "" );
		while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
			foreach ( $dbp as $A => $B ) { $this->DocumentShare [$A] = $B; }
		}
		
	}

	//@formatter:off
	public function getDocumentShareEntry ($data) { return $this->DocumentShare[$data]; }
	public function getDocumentShare() { return $this->DocumentShare; }
	
	public function setDocumentShareEntry ($entry, $data) { 
		if ( isset($this->DocumentShare[$entry])) { $this->DocumentShare[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setDocumentShare($DocumentShare) { $this->DocumentShare = $DocumentShare; }
	//@formatter:off

}


?>