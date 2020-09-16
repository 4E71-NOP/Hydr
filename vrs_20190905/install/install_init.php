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
include ("routines/website/utility/ClassLoader.php");
$ClassLoaderObj = ClassLoader::getInstance();
$ClassLoaderObj->provisionClass('Time');
$ClassLoaderObj->provisionClass('LogManagement');
$ClassLoaderObj->provisionClass('Mapper');
$ClassLoaderObj->provisionClass('RequestData');
$ClassLoaderObj->provisionClass('I18n');

$TimeObj = Time::getInstance();

$LMObj = LogManagement::getInstance();
$LMObj->setDebugLogEcho(1);
$LMObj->setInternalLogTarget("none");

$RequestDataObj = RequestData::getInstance();
$MapperObj = Mapper::getInstance();

$ClassLoaderObj->provisionClass('ConfigurationManagement');
$CMObj = ConfigurationManagement::getInstance();

$ClassLoaderObj->provisionClass('WebSite');
// --------------------------------------------------------------------------------------------

$LMObj->setStoreStatisticsStateOn();

$localisation = " / inst";
$MapperObj->AddAnotherLevel($localisation);
$LMObj->logCheckpoint( "Install Init" );
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("Install Init");

// --------------------------------------------------------------------------------------------
//	Install options
// --------------------------------------------------------------------------------------------

error_reporting(E_ALL ^ E_NOTICE);
ini_set('log_errors', "On");
ini_set('error_log' , "/var/log/apache2/error.log");
// error_log ("(OoO)");
// error_log ("(OoO)");
// error_log ("(OoO)");
// error_log ("(OoO)");
// error_log ("(OoO)");
error_log ("********** Hydr installation Begin**********");

// --------------------------------------------------------------------------------------------
//
//	CurrentSet
//
//

$ClassLoaderObj->provisionClass('ServerInfos');
$ClassLoaderObj->provisionClass('CurrentSet');

$CurrentSetObj = CurrentSet::getInstance();
$CurrentSetObj->setInstanceOfServerInfosObj(new ServerInfos() );
$CurrentSetObj->getInstanceOfServerInfosObj()->getInfosFromServer();

$CurrentSetObj->setInstanceOfWebSiteObj(new WebSite());
$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
$WebSiteObj->setInstallationInstance();
$CurrentSetObj->setInstanceOfWebSiteContextObj($WebSiteObj);

// --------------------------------------------------------------------------------------------
//
// SQL DB dialog Management.
//
//

$ClassLoaderObj->provisionClass('SddmTools');
$ClassLoaderObj->provisionClass('DalFacade');
$ClassLoaderObj->provisionClass('SqlTableList');

$form = $RequestDataObj->getRequestDataEntry('form');
$CurrentSetObj->setInstanceOfSqlTableListObj( SqlTableList::getInstance($form['dbprefix'],$form['tabprefix']) );

// We hav a POST we immediately set RAM and execution time limit
if ( isset($form['memory_limit'])) {
	ini_set( 'memory_limit', $form['memory_limit']."M" );
	ini_set( 'max_execution_time', $form['time_limit'] );
}

// --------------------------------------------------------------------------------------------
//
//	Loading the configuration file associated with this website
//
$CMObj->LoadConfigFile();
$CMObj->setExecutionContext("installation");
$CMObj->PopulateLanguageList();

// --------------------------------------------------------------------------------------------
//	Mise en place d'un stylesheet et d'un entete HTML
// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('StringFormat');
$StringFormatObj = StringFormat::getInstance();

// --------------------------------------------------------------------------------------------
include ("../stylesheets/css_admin_install.php");
$theme_tableau = "theme_princ_";
${$theme_tableau}['theme_module_largeur_interne'] = 896;
${$theme_tableau}['theme_module_largeur'] = 896;


$ClassLoaderObj->provisionClass('ThemeData');
$CurrentSetObj->setInstanceOfThemeDataObj(new ThemeData());
$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
$ThemeDataObj->setThemeData($theme_princ_); //Better to give an array than the object itself.
$ThemeDataObj->setThemeName('theme_princ_');

$ClassLoaderObj->provisionClass('ThemeDescriptor');
$CurrentSetObj->setInstanceOfThemeDescriptorObj(new ThemeDescriptor());
$ThemeDescriptorObj = $CurrentSetObj->getInstanceOfThemeDescriptorObj();

$ClassLoaderObj->provisionClass('User');
$CurrentSetObj->setInstanceOfUserObj(new User());
$UserObj = $CurrentSetObj->getInstanceOfUserObj();

$ClassLoaderObj->provisionClass('RenderLayout');
$RenderLayoutObj = RenderLayout::getInstance();


$ClassLoaderObj->provisionClass('RenderDeco40Elegance');
$ClassLoaderObj->provisionClass('RenderDeco50Exquisite');

// --------------------------------------------------------------------------------------------
//
//	JavaScript Object
//
//
$localisation = "Prepare JavaScript Object";
$MapperObj->AddAnotherLevel($localisation );
$LMObj->logCheckpoint("Prepare JavaScript Object");
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("Prepare JavaScript Object");

$ClassLoaderObj->provisionClass('GeneratedJavaScript');
// include ("routines/website/entity/others/GeneratedJavaScript.php");
$CurrentSetObj->setInstanceOfGeneratedJavaScriptObj(new GeneratedJavaScript());
$GeneratedJavaScriptObj = $CurrentSetObj->getInstanceOfGeneratedJavaScriptObj();

$module_['module_deco'] = 1;

// --------------------------------------------------------------------------------------------
$DocContent = "<!DOCTYPE html> 
<html>\r
<head>\r
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>\r
<title>".$WebSiteObj->getWebSiteEntry('sw_title')."</title>\r
".$stylesheet."\r
</head>\r
<body id='MWMbody' text='".$ThemeDataObj->getThemeBlockEntry('B01T', 'deco_txt_col')."' link='".$ThemeDataObj->getThemeBlockEntry('B01T', 'deco_txt_l_01_fg_col')."' vlink='".$ThemeDataObj->getThemeBlockEntry('B01T', 'deco_txt_l_01_fg_visite_col')."' alink='".$ThemeDataObj->getThemeBlockEntry('B01T', 'deco_txt_l_01_fg_active_col')."' background='../graph/".${$theme_tableau}['theme_repertoire']."/".${$theme_tableau}['theme_bg']."'>\r\r
";

// --------------------------------------------------------------------------------------------
//
//
//	Start of the block to be displayed.
//
//
// --------------------------------------------------------------------------------------------
$localisation = "Content";
$MapperObj->AddAnotherLevel($localisation );
$LMObj->logCheckpoint("Content");
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("Content");


if ( strlen($RequestDataObj->getRequestDataEntry('l')) != 0){
	$langComp = array ("fra" ,"eng");
	unset ( $A );
	foreach ( $langComp as $A ) { if ( $A == $RequestDataObj->getRequestDataEntry('l')) { $langHit = 1; } }
}
if ( $langHit == 1 ) { $l = $RequestDataObj->getRequestDataEntry('l'); }
else { $l = "eng"; }

include ("install/i18n/install_init_".$l.".php");

// --------------------------------------------------------------------------------------------
if ( strlen($ThemeDataObj->getThemeDataEntry('theme_divinitial_bg') ) > 0 ) { $div_initial_bg = "background-image: url(../graph/".$ThemeDataObj->getThemeDataEntry('theme_repertoire')."/".$ThemeDataObj->getThemeDataEntry('theme_divinitial_bg')."); background-repeat: ".$ThemeDataObj->getThemeDataEntry('theme_divinitial_repeat').";" ;}
if ( $ThemeDataObj->getThemeDataEntry('theme_divinitial_dx') == 0 ) { $ThemeDataObj->setThemeDataEntry('theme_divinitial_dx', $ThemeDataObj->getThemeDataEntry('theme_module_largeur') + 16); }
if ( $ThemeDataObj->getThemeDataEntry('theme_divinitial_dy') == 0 ) { $ThemeDataObj->setThemeDataEntry('theme_divinitial_dy', $ThemeDataObj->getThemeDataEntry('theme_module_largeur') + 16); }

$DocContent .= "<!-- __________ start of modules __________ -->\r
<div id='initial_div' style='position:relative; margin-left: auto; margin-right: auto; visibility: hidden;
width:".$ThemeDataObj->getThemeDataEntry('theme_divinitial_dx')."px; 
height:".$ThemeDataObj->getThemeDataEntry('theme_divinitial_dy')."px;" .
$div_initial_bg.
"'>\r";

$infos = array(
	"mode" => 1,
	"affiche_module_mode" => "normal",
	"module_z_index" => 2,
	"block" => "B02",
	"blockG" => "B02G",
	"blockT" => "B02T",
	"deco_type" => 50,
	"module" => Array
		(
		"module_id" => 11,
		"module_deco" => 1,
		"module_deco_nbr" => 2,
		"module_deco_txt_defaut" => 3,
		"module_nom" => "Admin_install_B1",
		"module_classname" => "",
		"module_titre" => "",
		"module_fichier" => "",
		"module_desc" => "",
		"module_conteneur_nom" => "",
		"module_groupe_pour_voir" => 31,
		"module_groupe_pour_utiliser" => 31,
		"module_adm_control" => 0,
		"module_execution" => 0,
		"site_module_id" => 11,
		"site_id" => 2,
		"module_etat" => 1,
		"module_position" => 2,
		)
	);

$block = $ThemeDataObj->getThemeName().$infos['block'];

$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "px", 0 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "py", 0 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dx", $ThemeDataObj->getThemeDataEntry("theme_module_largeur") );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dy", 112 );

$RenderDeco = RenderDeco50Exquisite::getInstance();
$DocContent .= $RenderDeco->render($infos);
$DocContent .= "<p class='".$block."_tb7' style='text-align: center;'>".$i18n['b01Invite']."</p></div>\r";

// --------------------------------------------------------------------------------------------

$infos['module']['module_nom'] = "Admin_install_B2";
$infos['block'] = "B01";
$infos['blockG'] = "B01G";
$infos['blockT'] = "B01T";
$infos['deco_type'] = 40;

$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "px", 0 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "py", 120 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dx", $ThemeDataObj->getThemeDataEntry("theme_module_largeur") );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dy", 816+64 );

$RenderDeco = RenderDeco40Elegance::getInstance();
$DocContent .= $RenderDeco->render($infos);

// --------------------------------------------------------------------------------------------
//
//		Pages - Diplaying informations
//
// --------------------------------------------------------------------------------------------
$localisation = "Page";
$MapperObj->AddAnotherLevel($localisation );
$LMObj->logCheckpoint("Page");
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("Page");

$ClassLoaderObj->provisionClass('RenderTables');
// include ("routines/website/utility/RenderTables.php");
$RenderTablesObj = RenderTables::getInstance();

$ClassLoaderObj->provisionClass('InteractiveElements');
// include ("routines/website/utility/InteractiveElements.php");
$InteractiveElementsObj = InteractiveElements::getInstance();

$T = array();

if ( $RequestDataObj->getRequestDataEntry('PageInstall') == null ) { $RequestDataObj->setRequestData( 'PageInstall', 1 ); }

switch ( $RequestDataObj->getRequestDataEntry('PageInstall') ) {
	case "1":	include ( "install/install_page_01.php");	break;
	case "2":	include ( "install/install_page_02.php");	break;
}
$DocContent .= "</div>\r</div>\r";

// --------------------------------------------------------------------------------------------
// Aide dynamique
// --------------------------------------------------------------------------------------------
$infos['module']['module_conteneur_nom'] = "tooltipContainer";
$infos['module']['module_nom'] = "ToolTip";
$infos['module']['module_deco_nbr'] = 20;
$infos['module_z_index'] = 99;
$infos['block'] = "B20";
$infos['blockG'] = "B20G";
$infos['blockT'] = "B20T";
$infos['deco_type'] = 40;

$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "px", 8 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "py", 4 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dx", 320 );
$RenderLayoutObj->setLayoutModuleEntry($infos['module']['module_nom'], "dy", 192 );

$RenderDeco = RenderDeco40Elegance::getInstance();
$DocContent .= $RenderDeco->render($infos)."</div>\r</div>\r";

// $GeneratedJavaScriptObj->insertJavaScript('Data' , "var DivInitial = LocaliseElement ( 'initial_div' );");
// $GeneratedJavaScriptObj->insertJavaScript('Onload', "\tinitAdyn('".$infos['module']['module_conteneur_nom']."' , '".$infos['module']['module_nom']."_ex22' , '".$RenderLayoutObj->getLayoutModuleEntry($infos['module']['module_nom'], 'dx')."' , '".$RenderLayoutObj->getLayoutModuleEntry($infos['module']['module_nom'], 'dy')."' );");

$GeneratedJavaScriptObj->insertJavaScript('Data' , "var TabInfoModule = new Array();\r");

$GeneratedJavaScriptObj->insertJavaScript('Init', 'var t = new ToolTip();');
$GeneratedJavaScriptObj->insertJavaScript('Init', 'm.mouseFunctionList.ToolTip = { "obj": t, "method":"MouseEvent"};');
$GeneratedJavaScriptObj->insertJavaScript('Onload', "\tt.InitToolTip('".$infos['module']['module_conteneur_nom']."' , '".$infos['module']['module_nom']."_ex22' , '".$cdx."' , '".$cdy."' );");


// --------------------------------------------------------------------------------------------
// Fichier Javascript
// --------------------------------------------------------------------------------------------
unset ($A);

$GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript/lib_HydrCore.js');
$GeneratedJavaScriptObj->insertJavaScript('File', 'install/install_routines/install_test_db.js');
$GeneratedJavaScriptObj->insertJavaScript('File', 'install/install_routines/install_fonctions.js');
$GeneratedJavaScriptObj->insertJavaScript('File', '../modules/initial/Tooltip/lib_tooltip.js');
$GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript_onglet.js');
$GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript_lib_calculs_decoration.js');
$GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript/lib_ElementAnimation.js');
// $GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript_statique.js');
// $GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript_Aide_dynamique.js');
// $GeneratedJavaScriptObj->insertJavaScript('File', 'routines/website/javascript_lib_calculs_decoration.js');

$GeneratedJavaScriptObj->insertJavaScript('Onload', "\telm.Gebi( 'initial_div' ).style.visibility = 'visible';");
$GeneratedJavaScriptObj->insertJavaScript('Onload', "\telm.Gebi( 'MWMbody' ).style.visibility = 'visible';");


$GeneratedJavaScriptObj->insertJavaScript('Onload', "console.log ( TabInfoModule );");

$JavaScriptContent = "<!-- JavaScript -->\r\r";
$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptDecoratedMode("File", "<script type='text/javascript' src='", "'></script>\r");
$JavaScriptContent .= "<script type='text/javascript'>\r";

$JavaScriptContent .= "// ----------------------------------------\r//\r// Data segment\r//\r//\r";
$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode("Data");
$JavaScriptContent .= "// ----------------------------------------\r//\r// Command segment\r//\r//\r";
$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode("Command");
$JavaScriptContent .= "// ----------------------------------------\r//\r// Init segment\r//\r//\r";
$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode("Init");
$JavaScriptContent .= "// ----------------------------------------\r//\r// Onload segment\r//\r//\r";
$JavaScriptContent .= "function WindowOnload () {\r";
$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode("Onload");
$JavaScriptContent .= "
}\r
window.onload = WindowOnload;\r\r
</script>\r";

$DocContent .= $JavaScriptContent;


// --------------------------------------------------------------------------------------------
$DocContent .= "</body>\r</html>\r";
echo ($DocContent);

error_log ( 
		"> memory_get_peak_usage (real)=".floor((memory_get_peak_usage($real_usage = TRUE)/1024))."Kb".
		"; memory_get_usage (real)=".floor((memory_get_usage($real_usage = TRUE)/1024))."Kb"
);
error_log(
		"> memory_get_peak_usage=".floor((memory_get_peak_usage()/1024))."Kb".
		"; memory_get_usage=".floor((memory_get_usage()/1024))."Kb"
);

error_log ( "********** Hydr installation End **********");

?>
