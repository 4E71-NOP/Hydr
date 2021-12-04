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
class HydrInstallMonitor {
	private static $Instance = null;
	private function __construct() {
	}

	/**
	 * Singleton : Will return the instance of this class.
	 *
	 * @return HydrInstall
	 */
	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new HydrInstallMonitor ();
		}
		return self::$Instance;
	}

	/**
	 * Renders the whole thing.
	 * The choice of making a main class is to help IDEs to process sources.
	 *
	 * @return string
	 */
	public function render() {
		$application = 'install';
		include ("current/define.php");
		
		include ("current/engine/utility/ClassLoader.php");
		$ClassLoaderObj = ClassLoader::getInstance ();
		
		$ClassLoaderObj->provisionClass ( 'BaseToolSet' ); // First of them all as it is used by others.
		$bts = BaseToolSet::getInstance();
		
		$bts->LMObj->setDebugLogEcho ( 1 );
		$bts->LMObj->setInternalLogTarget ( INSTALL_LOG_TARGET );
		$bts->CMObj->InitBasicSettings ();
		
		$ClassLoaderObj->provisionClass ( 'SessionManagement' );
		$bts->initSmObj ();
		$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => "*** index.php : \$_SESSION :" . $bts->StringFormatObj->arrayToString ( $_SESSION ) . " *** \$SMObj->getSession() = " . $bts->StringFormatObj->arrayToString ( $bts->SMObj->getSession () ) . " *** EOL") );
		
		$ClassLoaderObj->provisionClass ( 'WebSite' );
		
		// --------------------------------------------------------------------------------------------
		$bts->LMObj->setStoreStatisticsStateOn ();
		
		$localisation = " / inst";
		$bts->MapperObj->AddAnotherLevel ( $localisation );
		$bts->LMObj->logCheckpoint ( "Install Init" );
		$bts->MapperObj->RemoveThisLevel ( $localisation );
		$bts->MapperObj->setSqlApplicant ( "Install Init" );
		
		// --------------------------------------------------------------------------------------------
		// Install options
		// --------------------------------------------------------------------------------------------
		
		ini_set ( 'log_errors', "On" );
		ini_set ( 'error_log', "/var/log/apache2/error.log" );
		ini_set ( 'display_errors', 0 );
		error_log ( "********** Hydr installation Begin **********" );
		
		// --------------------------------------------------------------------------------------------
		//
		// CurrentSet
		//
		//

		$ClassLoaderObj->provisionClass ( 'ServerInfos' );
		$ClassLoaderObj->provisionClass ( 'CurrentSet' );

		$CurrentSetObj = CurrentSet::getInstance ();
		$CurrentSetObj->setInstanceOfServerInfosObj ( new ServerInfos () );
		$CurrentSetObj->getInstanceOfServerInfosObj ()->getInfosFromServer ();

		$CurrentSetObj->setInstanceOfWebSiteObj ( new WebSite () );
		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj ();
		$WebSiteObj->setInstallationInstance ();
		$CurrentSetObj->setInstanceOfWebSiteContextObj ( $WebSiteObj );

		// --------------------------------------------------------------------------------------------
		//
		// SQL DB dialog Management.
		//
		//

		$ClassLoaderObj->provisionClass ( 'SddmTools' );
		$ClassLoaderObj->provisionClass ( 'DalFacade' );
		$ClassLoaderObj->provisionClass ( 'SqlTableList' );

		$form = $bts->RequestDataObj->getRequestDataEntry ( 'form' );
		$CurrentSetObj->setInstanceOfSqlTableListObj ( SqlTableList::getInstance ( $form ['dbprefix'], $form ['tabprefix'] ) );

		// We have a POST so we set RAM and execution time limit immediately.
		if (isset ( $form ['memory_limit'] )) {
			ini_set ( 'memory_limit', $form ['memory_limit'] . "M" );
			ini_set ( 'max_execution_time', $form ['time_limit'] );
		}

		// --------------------------------------------------------------------------------------------
		include ("stylesheets/css_admin_install.php");
		
		// --------------------------------------------------------------------------------------------
		//
		// JavaScript Object
		//
		//
		$localisation = "Prepare JavaScript Object";
		$bts->MapperObj->AddAnotherLevel ( $localisation );
		$bts->LMObj->logCheckpoint ( "Prepare JavaScript Object" );
		$bts->MapperObj->RemoveThisLevel ( $localisation );
		$bts->MapperObj->setSqlApplicant ( "Prepare JavaScript Object" );

		$ClassLoaderObj->provisionClass ( 'GeneratedJavaScript' );
		$CurrentSetObj->setInstanceOfGeneratedJavaScriptObj ( new GeneratedJavaScript () );
		$GeneratedJavaScriptObj = $CurrentSetObj->getInstanceOfGeneratedJavaScriptObj ();

		$module_ ['module_deco'] = 1;

		// --------------------------------------------------------------------------------------------
		$ClassLoaderObj->provisionClass ( 'ThemeData' );
		$CurrentSetObj->setInstanceOfThemeDataObj ( new ThemeData () );
		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj ();
		$ThemeDataObj->setThemeData ( $mt_ ); // Better to give an array than the object itself.
		$ThemeDataObj->setThemeName ( 'mt_' );

		$ClassLoaderObj->provisionClass ( 'ThemeDescriptor' );
		$CurrentSetObj->setInstanceOfThemeDescriptorObj ( new ThemeDescriptor () );
		$ThemeDescriptorObj = $CurrentSetObj->getInstanceOfThemeDescriptorObj ();

		$ClassLoaderObj->provisionClass ( 'User' );
		$CurrentSetObj->setInstanceOfUserObj ( new User () );
		$UserObj = $CurrentSetObj->getInstanceOfUserObj ();

		$ClassLoaderObj->provisionClass ( 'RenderDeco40Elegance' );
		$ClassLoaderObj->provisionClass ( 'RenderDeco50Exquisite' );
	
		// --------------------------------------------------------------------------------------------
		// <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>\r

		$bts->CMObj->LoadConfigFile();
		$bts->CMObj->setExecutionContext("installation");
		$bts->CMObj->PopulateLanguageList();
		
		$bts->CMObj->setConfigurationEntry('dal', $form['database_dal_choix']);
		$bts->CMObj->setConfigurationEntry('host', $form['host']);
		$bts->CMObj->setConfigurationEntry('db_user_login', $form['db_admin_user']);
		$bts->CMObj->setConfigurationEntry('db_user_password', $form['db_admin_password']);

		$DALFacade = DalFacade::getInstance();
		$DALFacade->createDALInstance();		// It connects too.

		$form = $bts->RequestDataObj->getRequestDataEntry('form');
		$CurrentSetObj->setInstanceOfSqlTableListObj( SqlTableList::getInstance($form['dbprefix'],$form['tabprefix']) );
		
		$SqlTableListObj = $CurrentSetObj->getInstanceOfSqlTableListObj();
		$SDDMObj = DalFacade::getInstance()->getDALInstance();
		

		$itd = array();											// ITD for Installation Table Data
		$tmp = array();
		$itd['end_date']['inst_nbr'] = 0;
		$dbquery = $SDDMObj->query("SELECT * FROM ".$SqlTableListObj->getSQLTableName('installation'). ";");
		if ( $dbquery != false && $SDDMObj->num_row_sql($dbquery) > 0 ) { 
			while ($dbp = $SDDMObj->fetch_array_sql($dbquery)) {
				$idx = $dbp['inst_name'];
				$tmp[$idx]['inst_display']		= $dbp['inst_display'];
				$tmp[$idx]['inst_name']			= $dbp['inst_name'];
				$tmp[$idx]['inst_nbr']			= $dbp['inst_nbr'];
				$tmp[$idx]['inst_txt']			= $dbp['inst_txt'];
			}
			$idx = $bts->RequestDataObj->getRequestDataEntry('SessionID');
			if ( $bts->RequestDataObj->getRequestDataEntry('SessionID') == $tmp['SessionID']['inst_nbr'] ) { $itd = $tmp; }
		}

		$refresh = "";
		if ( $itd['end_date']['inst_nbr'] == 0 ) { $refresh = "<meta http-equiv='refresh' content='5'>\r"; }
		
		$CurrentSetObj->setDataEntry('itd',$itd);		// Save it for future use

		$DocContent = "<!DOCTYPE html>
			<html>\r
			<head>\r"
			.$refresh
			."<title>INSTALL</title>\r
			" . $stylesheet . "\r
			</head>\r
			<body id='HydrBody' text='" . $ThemeDataObj->getThemeBlockEntry ( 'B01T', 'txt_col' ) . 
			"' link='" . $ThemeDataObj->getThemeBlockEntry ( 'B01T', 'a_fg_col' ) . 
			"' vlink='" . $ThemeDataObj->getThemeBlockEntry ( 'B01T', 'a_fg_visite_col' ) . 
			"' alink='" . $ThemeDataObj->getThemeBlockEntry ( 'B01T', 'a_fg_active_col' ) . 
			"' background='media/theme/" . $ThemeDataObj->getThemeDataEntry('theme_directory') . 
			"/" . $ThemeDataObj->getThemeDataEntry('theme_bg') 
			. "' style='height:100%;'>\r\r
			";

		// --------------------------------------------------------------------------------------------
		//
		//
		// Start of the block to be displayed.
		//
		//
		// --------------------------------------------------------------------------------------------
		$localisation = "Content";
		$bts->MapperObj->AddAnotherLevel ( $localisation );
		$bts->LMObj->logCheckpoint ( "Content" );
		$bts->MapperObj->RemoveThisLevel ( $localisation );
		$bts->MapperObj->setSqlApplicant ( "Content" );

		if (strlen ( $bts->RequestDataObj->getRequestDataEntry ( 'l' ) ) != 0) {
			$langComp = array (
					"fra",
					"eng"
			);
			unset ( $A );
			foreach ( $langComp as $A ) {
				if ($A == $bts->RequestDataObj->getRequestDataEntry ( 'l' )) {
					$langHit = 1;
				}
			}
		}
		if ($langHit == 1) {
			$l = $bts->RequestDataObj->getRequestDataEntry ( 'l' );
			$CurrentSetObj->setDataEntry('language', $l);
		} else {
			$l = "eng";
			$CurrentSetObj->setDataEntry('language', "eng");
		}

		// $bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => "Loading `current/install/i18n/install_init_" . $l . ".php`"));
		$bts->I18nTransObj->apply (
			array(
				"type"		=> "file", 
				"file"		=> "current/install/i18n/install_init_" . $l . ".php",
				"format"	=>	"php"
			 ));
		// --------------------------------------------------------------------------------------------
		$DocContent .= "<!-- __________ start of modules __________ -->\r
			<div id='initial_div' style='position:relative; width:98%; height:100%; margin:16px; padding:0px; visibility:visible'>\r";


		$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." : >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>") );
		$ClassLoaderObj->provisionClass ('ModuleList');
		$CurrentSetObj->setInstanceOfModuleListObj(new ModuleList());
		$ModuleLisObj = $CurrentSetObj->getInstanceOfModuleListObj();
		
		$ClassLoaderObj->provisionClass ('LayoutProcessor');
		$LayoutProcessorObj = LayoutProcessor::getInstance();
		$ClassLoaderObj->provisionClass ( 'RenderModule' );
		$RenderModuleObj = RenderModule::getInstance ();

		// Monitor or Install screens
		if ( $bts->RequestDataObj->getRequestDataEntry ( 'PageInstall' ) != "monitor" ) {
			$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." : This is an install page") );
			$ModuleLisObj->makeInstallModuleList();
			$ContentFragments = $LayoutProcessorObj->installRender('install.lyt.html');
		}
		else { 
			$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." : This is a monitor page") );
			$ModuleLisObj->makeMonitorModuleList(); 
			$ContentFragments = $LayoutProcessorObj->installRender('install_monitor.lyt.html');
		}

		$LayoutCommands = array(
			0 => array( "regex"	=> "/{{\s*get_header\s*\(\s*\)\s*}}/", "command"	=> 'get_header'),
			1 => array( "regex"	=> "/{{\s*render_module\s*\(\s*('|\"|`)\w*('|\"|`)\s*\)\s*}}/", "command"	=> 'render_module'),
		);
		
		// We know there's only one command per entry
		$insertJavascriptDecorationMgmt = false;
		foreach ( $ContentFragments as &$A ) {
			foreach ( $LayoutCommands as $B) {
				if ( $A['type'] == "command" && preg_match($B['regex'],$A['data'],$match) === 1 ) {
					// We got the match so it's...
					switch ($B['command']) {
						case "get_header":
							break;
						case "render_module":
							// Module it is.
							if ( $insertJavascriptDecorationMgmt === false) {
								$GeneratedJavaScriptObj->insertJavaScript ( 'OnLoad', "\tdm.UpdateDecoModule(TabInfoModule);" );
								$GeneratedJavaScriptObj->insertJavaScript('OnResize', "\tdm.UpdateDecoModule(TabInfoModule);");
								$GeneratedJavaScriptObj->insertJavaScript("Data", "var TabInfoModule = new Array();\r");
								$insertJavascriptDecorationMgmt = true;
							}
							$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." : `". $A['type'] ."`; for `". $A['module_name'] ."` and data ". $A['data'] ) );
							$A['content'] = $RenderModuleObj->render($A['module_name']);
							break;
					}
				}
			}
		}
		$bts->LMObj->InternalLog ( array ('level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." : >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>") );
		
		foreach ( $ContentFragments as &$A ) {
			//	$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : ". $C['content']));
			$DocContent .= $A['content'];
		}
	
		$DocContent .= "</div>\r"; // Closing initial_div
		
		// --------------------------------------------------------------------------------------------
		// Javascript files
		// --------------------------------------------------------------------------------------------
		unset ( $A );

		$GeneratedJavaScriptObj->insertJavaScript ( 'File', 'current/engine/javascript/lib_HydrCore.js' );
		$GeneratedJavaScriptObj->insertJavaScript ( 'File', 'current/install/install_routines/install_test_db.js' );
		$GeneratedJavaScriptObj->insertJavaScript ( 'File', 'current/install/install_routines/install_fonctions.js' );
		$GeneratedJavaScriptObj->insertJavaScript ( 'File', 'current/engine/javascript/lib_DecorationManagement.js' );
		$GeneratedJavaScriptObj->insertJavaScript ( 'File', 'current/engine/javascript/lib_ElementAnimation.js' );

		$GeneratedJavaScriptObj->insertJavaScript('Init', 'var dm = new DecorationManagement();');

		$GeneratedJavaScriptObj->insertJavaScript ( 'OnLoad', "\telm.Gebi( 'initial_div' ).style.visibility = 'visible';" );
		$GeneratedJavaScriptObj->insertJavaScript ( 'OnLoad', "\telm.Gebi( 'HydrBody' ).style.visibility = 'visible';" );

		$GeneratedJavaScriptObj->insertJavaScript ( 'OnLoad', "console.log ( TabInfoModule );" );

		$JavaScriptContent = "<!-- JavaScript -->\r\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptFile( "File", "<script type='text/javascript' src='", "'></script>\r" );
		$JavaScriptContent .= "<script type='text/javascript'>\r";

		$JavaScriptContent .= "// ----------------------------------------\r//\r// Data segment\r//\r//\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode ( "Data" );
		$JavaScriptContent .= "// ----------------------------------------\r//\r// Data (Flexible) \r//\r//\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptObjects();
		$JavaScriptContent .= "// ----------------------------------------\r//\r// Command segment\r//\r//\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode ( "Command" );
		$JavaScriptContent .= "// ----------------------------------------\r//\r// Init segment\r//\r//\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode ( "Init" );
		$JavaScriptContent .= "// ----------------------------------------\r//\r// OnLoad segment\r//\r//\r";
		$JavaScriptContent .= "function WindowOnResize (){\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode ( "OnResize" );
		$JavaScriptContent .= "\r}\r";
		$JavaScriptContent .= "function WindowOnLoad () {\r";
		$JavaScriptContent .= $GeneratedJavaScriptObj->renderJavaScriptCrudeMode ( "OnLoad" );
		$JavaScriptContent .= "
		}\r
		window.onresize = WindowOnResize;\r
		window.onload = WindowOnLoad;\r\r
		</script>\r";

		$DocContent .= $JavaScriptContent;

		// --------------------------------------------------------------------------------------------
		$DocContent .= "</body>\r</html>\r";

		error_log ( "> memory_get_peak_usage (real)=" . floor ( (memory_get_peak_usage ( $real_usage = TRUE ) / 1024) ) . "Kb" . "; memory_get_usage (real)=" . floor ( (memory_get_usage ( $real_usage = TRUE ) / 1024) ) . "Kb" );
		error_log ( "> memory_get_peak_usage=" . floor ( (memory_get_peak_usage () / 1024) ) . "Kb" . "; memory_get_usage=" . floor ( (memory_get_usage () / 1024) ) . "Kb" );
		error_log ( "********** Hydr installation End **********" );
 		session_write_close ();
		return ($DocContent);
	}
}
?>
