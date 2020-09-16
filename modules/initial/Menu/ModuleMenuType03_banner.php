<?php
 /*Hydre-licence-debut*/
// --------------------------------------------------------------------------------------------
//
//	Hydre - Le petit moteur de web
//	Sous licence Creative Common	
//	Under Creative Common licence	CC-by-nc-sa (http://creativecommons.org)
//	CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
//	(c)Faust MARIA DE AREVALO faust@club-internet.fr
//
// --------------------------------------------------------------------------------------------
/*Hydre-licence-fin*/

class ModuleMenuType03 {
	private static $Instance = null;
	
	public function __construct() {}
	
	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new ModuleMenuType03 ();
		}
		return self::$Instance;
	}
	
	public function renderMenu($infos){
	}
}