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
//	Module : Authentification
// --------------------------------------------------------------------------------------------

class ModuleAuthentification {
	public function __construct(){}
	
	public function render ($infos) {
		$MapperObj = Mapper::getInstance();
		$LMObj = LogManagement::getInstance();
		$InteractiveElementsObj = InteractiveElements::getInstance();
		$SMObj = SessionManagement::getInstance(null);
		$CMObj = ConfigurationManagement::getInstance();
		$StringFormatObj = StringFormat::getInstance();
		$RequestDataObj = RequestData::getInstance();
		$AUObj = AuthenticateUser::getInstance();
		
		$logTarget = $LMObj->getInternalLogTarget();
		$LMObj->setInternalLogTarget(logTarget);
		
		$localisation = " / ModuleAuthentification";
		$MapperObj->AddAnotherLevel($localisation );
		$LMObj->logCheckpoint("ModuleAuthentification");
		$MapperObj->RemoveThisLevel($localisation );
		$MapperObj->setSqlApplicant("ModuleAuthentification");
		
		$CurrentSetObj = CurrentSet::getInstance();
		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
// 		$UserObj = $CurrentSet->getInstanceOfUserObj();
		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
		
		$LMObj->InternalLog("ModuleAuthentification->render start");
		
		$cnxResult = $AUObj->getDataEntry('errorType');
// 		$mod_auth_demande_connexion_resultat_test = "Connexion R&eacute;ussie";
		$l = $CMObj->getLanguageListSubEntry($WebSiteObj->getWebSiteEntry('ws_lang'), 'langue_639_3');
		
		$i18n = array();
		include ($infos['module']['module_directory']."/i18n/".$l.".php");
		
		
		$LMObj->InternalLog("ModuleAuthentification:render() : user_login=".$SMObj->getSessionEntry('user_login'));
		
		$Content = "";
		if ( $SMObj->getSessionEntry('user_login') == "anonymous") {
			if ( $RequestDataObj->getRequestDataEntry('formSubmitted') == 1 && 
					$RequestDataObj->getRequestDataSubEntry('authentificationForm', 'user_login') != "anonymous" &&
					$RequestDataObj->getRequestDataSubEntry('formGenericData', 'action') != "disconnection"
					) {
				$Content .= "<span class='" . $ThemeDataObj->getThemeName().$infos['block']."_t3 " . $ThemeDataObj->getThemeName().$infos['block']."_avert' style='text-align: center;'>". $i18n['cnxResult'][$cnxResult] ."</span>"; 
			}

			$Content .= "
			<form ACTION='index.php?' method='post'>\r
		
			<table style='width:".(
					$ThemeDataObj->getThemeDataEntry('theme_module_largeur_interne')-16)."px; margin-right: auto; margin-left: auto'>\r
			<tr>\r<td class='".$ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align:center;'>".$i18n['id']."</td>\r</tr>\r
			<tr>\r<td class='".$ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align:center; padding-bottom:8px;'><input class='" . $ThemeDataObj->getThemeName().$infos['block']."_form_1 " . $ThemeDataObj->getThemeName().$infos['block']."_t3' type='text' name='authentificationForm[user_login]' size='16' maxlength='64' value='anonymous'></td>\r</tr>\r
			<tr>\r<td class='".$ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align:center;'>".$i18n['ps']."</td>\r</tr>\r
			<tr>\r<td class='".$ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align:center; padding-bottom:8px;'><input class='" . $ThemeDataObj->getThemeName().$infos['block']."_form_1 " . $ThemeDataObj->getThemeName().$infos['block']."_t3' type='password' name='authentificationForm[user_password]' size='16' maxlength='64' value='anonymous'></td>\r</tr>\r
			</table>\r".
			
// 			"<!--".$StringFormatObj->print_r_debug($CurrentSetObj->getData())."-->".
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_ws').
// 			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_l').
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_arti_ref').
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_arti_page').
			"
			<input type='hidden' name='formSubmitted'				value='1'>
			<input type='hidden' name='formGenericData[origin]'		value='ModuleAuthentification'>
			<input type='hidden' name='formGenericData[action]' 	value='connectionAttempt'>\r


			<table cellpadding='0' cellspacing='0' style='margin-left: auto; margin-right: auto;'>
			<tr>\r
			<td>\r
			";
		
// 			$SB as Submit Button
			$SB = array(
				"id"				=> "bouton_authentif",
				"type"				=> "submit",
				"initialStyle"		=> $ThemeDataObj->getThemeName().$infos['block']."_t3 " . $ThemeDataObj->getThemeName().$infos['block']."_submit_s2_n",
				"hoverStyle"		=> $ThemeDataObj->getThemeName().$infos['block']."_t3 " . $ThemeDataObj->getThemeName().$infos['block']."_submit_s2_h",
				"onclick"			=> "",
				"message"			=> $i18n['login'],
				"mode"				=> 0,
				"size" 				=> 0,
				"lastSize"			=> 0,
			);
			$Content .= $InteractiveElementsObj->renderSubmitButton($SB); 
			$Content .= "
			</td>\r
			</tr>\r
			</table>\r
			</form>\r
			";
		}
		else {
			$SB = array(
				"id"				=> "bouton_deconexion",
				"type"				=> "submit",
				"initialStyle"		=> $ThemeDataObj->getThemeName().$infos['block']."_t3 " . $ThemeDataObj->getThemeName().$infos['block']."_submit_s2_n",
				"hoverStyle"		=> $ThemeDataObj->getThemeName().$infos['block']."_t3 " . $ThemeDataObj->getThemeName().$infos['block']."_submit_s2_h",
				"onclick"			=> "",
				"message"			=> $i18n['disconnect'],
				"mode"				=> 0,
				"size" 				=> 0,
				"lastSize"			=> 0,
			);
		
			$pv['SSL_etat'] = "<span class='" . $ThemeDataObj->getThemeName().$infos['block']."_fade'>\r".$i18n['via80']."</span>\r"; 
			if ( isset($_SERVER['HTTPS']) ) {
				if ( isset($_SERVER['SERVER_PORT'] ) && ( $_SERVER['SERVER_PORT'] == '443' ) ) { 
					$pv['SSL_etat'] = "<span class='" . $ThemeDataObj->getThemeName().$infos['block']."_fade'>\r".$i18n['viassl']."</span>\r"; 
				}
			}
		
			$pv['table_hauteur'] = 128;
		
			$Content .= "
			<form ACTION='index.php?' method='post'>\r
			<input type='hidden' name='user_login' value='anonymous'>\r
			<input type='hidden' name='user_pass' value=''>\r
			".
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_ws').
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_l').
			"
			<input type='hidden' name='arti_ref' value=''>\r".
			$CurrentSetObj->getDataSubEntry('block_HTML', 'post_hidden_arti_page')."
			<input type='hidden' name='formSubmitted'				value='1'>
			<input type='hidden' name='formGenericData[origin]'		value='ModuleAuthentification'>
			<input type='hidden' name='formGenericData[action]' 	value='disconnection'>\r
		
			<table cellpadding='0' cellspacing='0' style='height: ".$pv['table_hauteur']."px; margin-left: auto; margin-right: auto;'>
		
			<tr>\r
			<td class='" . $ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align: center;'>\r".
			$i18n['txt1'].
			"<span class='" . $ThemeDataObj->getThemeName().$infos['block']."_tb3'>".$SMObj->getSessionEntry('user_login')."</span>\r
			</td>\r
			</tr>\r
			
			<tr>\r
			<td class='" . $ThemeDataObj->getThemeName().$infos['block']."_t3' style='text-align: center;'>\r
			<span style='text-align: center;'>\r
			" .
			$InteractiveElementsObj->renderSubmitButton($SB).
			"
			</span>\r
			</td>\r
			</tr>\r
		
			<tr>\r
			<td class='" . $ThemeDataObj->getThemeName().$infos['block']."_t1' style='text-align: center;'>\r".
			$pv['SSL_etat']	.
			"</td>\r
			</tr>\r
			</table>\r
		
			</form>\r
			";
		
		}
		
		$LMObj->setInternalLogTarget($logTarget);
		// Cleaning up
		if ( $WebSiteObj->getWebSiteEntry('ws_info_debug') < 10 ) { 
			unset (
			$i18n,
			$localisation,
			$MapperObj,
			$LMObj,
			$MapperObj,
			$InteractiveElementsObj,
			$CurrentSetObj,
			$WebSiteObj,
			$ThemeDataObj,
			$SMObj,
			$CMObj,
			$SB
			);
		}
		return $Content;
	}

}

?>
