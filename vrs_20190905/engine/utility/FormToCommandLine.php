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
class FormToCommandLine {
	private static $Instance = null;
	private $CommandLineScript = array();
	private $CommandLineNbr = 0;

	public function __construct() {}
	
	/**
	 * Singleton : Will return the instance of this class.
	 * @return FormToCommandLine
	 */
	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new FormToCommandLine ();
		}
		return self::$Instance;
	}
	
	/**
	 * Analyze a form to create a commande line.
	 */
	public function analysis () {
		$bts = BaseToolSet::getInstance();
		$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => "FormToCommandLine/analysis(): Analysis started."));
		
		$CurrentSetObj = CurrentSet::getInstance();
		$UserObj = $CurrentSetObj->getInstanceOfUserObj();
		
		$scr = &$this->CommandLineScript;
		$cln = &$this->CommandLineNbr;
		$cln = 0;
		
		switch ($bts->RequestDataObj->getRequestDataSubEntry('formGenericData','origin')) {
			// Analyze the origin of the form
			case "ModuleQuickSkin":
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => "ModuleQuickSkin submitted a form."));
				$scr[$cln] = "update user name ".$UserObj->getUserEntry('user_login'). " pref_theme '".$bts->RequestDataObj->getRequestDataSubEntry('userForm','user_pref_theme')."'";
				$cln++;
				break;
			case "ModuleSelectLanguage":
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => "ModuleSelectLanguage submitted a form."));
				$scr[$cln] = "update user name ".$UserObj->getUserEntry('user_login'). " lang '".$bts->RequestDataObj->getRequestDataSubEntry('userForm','user_lang')."'";
				$cln++;
				break;
				
			// All AdminDashboard will provide the necessary elements to build a set of command line.
			case "AdminDashboard":
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . "AdminDashboard submitted a form."));
				$n = 1;
				while ( $n != 0 ) {
					if ( strlen($bts->RequestDataObj->getRequestDataEntry('formCommand'.$n)) > 0 ) {
						$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . "Processing formCommand".$n));
						
						$formCommand	= $bts->RequestDataObj->getRequestDataEntry('formCommand'.$n);
						$formEntity		= $bts->RequestDataObj->getRequestDataEntry('formEntity'.$n);
						$formTarget		= $bts->RequestDataObj->getRequestDataEntry('formTarget'.$n);
						$formParams		= $bts->RequestDataObj->getRequestDataEntry('formParams'.$n);
						switch ($formCommand.$formEntity) {
							case "assignlanguage":
								// This one is an additive from website manipulation
								$scr[$cln] = "reset languages on_website ".$bts->RequestDataObj->getRequestDataSubEntry('site_context','site_nom').";";
								$cln++;
								$n++;
								foreach ($formTarget as $k => $v ) {
									$str = "assign language ".$k." to_website ".$bts->RequestDataObj->getRequestDataSubEntry('site_context','site_nom').";";
									$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . "(assignlanguage) Processed =".$str));
									$scr[$cln] = $str;
									$cln++;
									$n++;
								}
								break;
							case "qsdlkfjqsdlmkfjqsmldfkj":
								
								break;
							default :
								$str = $formCommand." ".$formEntity." ";
								foreach ($formTarget as $k => $v) { $str .= $k." '".$v."' ";}
								foreach ($formParams as $k => $v) { $str .= $k." '".$v."' ";}
								$str .= ";";
								$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, __METHOD__ . 'msg' => "Processed =".$str));
								$scr[$cln] = $str;
								$cln++;
								$n++;
								
								break;
						}
						
					}
					else { $n = 0; } // Exit
				}
				break;
		}
		unset ($UserObj);
	}
	
	//@formatter:off
	public function getCommandLineScript() { return $this->CommandLineScript; }
	public function getCommandLineNbr() { return $this->CommandLineNbr; }

	public function setCommandLineScript($CommandLineScript) { $this->CommandLineScript = $CommandLineScript; }
	public function setCommandLineNbr($CommandLineNbr) { $this->CommandLineNbr = $CommandLineNbr; }
	//@formatter:on
	
}