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
//	Module : FileSelector
// --------------------------------------------------------------------------------------------

class FileSelector {
	private static $Instance = null;
	
	public function __construct(){}
	
	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new FileSelector();
		}
		return self::$Instance;
	}

	/**
	 * Returns the fileSelector content
	 * @param array $infos
	 * @return string
	 */
	public function render (&$infos) {
		$CurrentSetObj = CurrentSet::getInstance();
		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
		$GeneratedJavaScriptObj = $CurrentSetObj->getInstanceOfGeneratedJavaScriptObj();
		
// 		$TreeData = $CurrentSetObj->getDataEntry('fs');
// 		$Block = $ThemeDataObj->getThemeName().$infos['block'];
		
		$Content = "";
		$zIndex = 500;
		
		switch ($CurrentSetObj->getDataEntry('language_id')) {
			case 38:
				$i18nDoc = array(
				"title"	=> "File selector",
				"c1"	=> "Name",
				"c2"	=> "Size",
				"c3"	=> "Date",
				);
				break;
			case 48:
				$i18nDoc = array(
				"title"	=> "Sélecteur de fichier",
				"c1"	=> "Nom",
				"c2"	=> "Taille",
				"c3"	=> "Date",
				);
				
				break;
		}
		
		$Block = $infos['block'];
		$tableStdRules = $ThemeDataObj->getThemeDataEntry('tableStdRules'); 
		$Content.= "
			<div id='FileSelectorDarkFade'
			class ='".$ThemeDataObj->getThemeName()."div_SelecteurDeFichierConteneur'
			style='display:none; visibility:hidden; z-index:".$zIndex.";'
			OnClick=\"elm.wpsa[0][de.cliEnv.browser.support](); elm.Hide( this.id ); elm.Hide('FileSelectorFrame');\">\r
			</div>\r
			
			<div id='FileSelectorFrame'
			class ='".$ThemeDataObj->getThemeName()."div_SelecteurDeFichier'
			style='left:10px;		top:10px;
			width:768px ;	height:512px;
			display:none; visibility:hidden; z-index:".($zIndex+1).";
			line-height:normal; overflow:auto;
			background-color:#".$ThemeDataObj->getThemeData('theme_bg_color').";'>\r
			
			<div id='FileSelectorCaption'>
			
			<table ".$tableStdRules." width='100%'>\r
			<tr>\r
			<td colspan='3' class='".$Block."_fcta ".$Block."_tb3'>".$i18nDoc['title']."</td>\r
			</tr>\r
			<tr>\r
			<td class='".$Block."_fctb ".$Block."_t3' width='65%'>".$i18nDoc['c1']."</td>\r
			<td class='".$Block."_fctb ".$Block."_t3' width='10%'>".$i18nDoc['c2']."</td>\r
			<td class='".$Block."_fctb ".$Block."_t3' width='25%'>".$i18nDoc['c3']."</td>\r
			</tr>\r
			</table>\r
			
			</div>\r
			<div id='FileSelectorLines'>
			</div>\r
			
			</div>\r
		";
		
		$Uri = $_SERVER['REQUEST_URI'];
		$RootUri = strpos( $_SERVER['REQUEST_URI'] , "/current/index.php" );
		$Uri = substr ( $_SERVER['REQUEST_URI'] , 0 , $RootUri );
		
		$GeneratedJavaScriptObj->insertJavaScript('File' , "engine/javascript/FileSelector.js");
		$GeneratedJavaScriptObj->insertJavaScript('Data' , "var RequestURI = \"".$Uri. "\"");
		$GeneratedJavaScriptObj->insertJavaScript('Init' , "var fs = new FileSelector('FileSelectorLines');");
		
		return $Content;
	}
}



?>