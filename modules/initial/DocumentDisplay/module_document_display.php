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
//	Module : ModuleDocument
// --------------------------------------------------------------------------------------------

class ModuleDocumentDisplay {
	public function __construct(){}
	
	public function render($infos) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$localisation = " / ModuleDocument";
		$bts->MapperObj->AddAnotherLevel($localisation );
		$bts->LMObj->logCheckpoint("ModuleDocument");
		$bts->MapperObj->RemoveThisLevel($localisation );
		$bts->MapperObj->setSqlApplicant("ModuleDocument");
		
		$ClassLoaderObj = ClassLoader::getInstance();
		$ClassLoaderObj->provisionClass('AdminFormTool');
		$ClassLoaderObj->provisionClass('RenderTables');			//Make sure it's there
		$ClassLoaderObj->provisionClass('InteractiveElements');
		
		$SqlTableListObj = SqlTableList::getInstance(null, null);
		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
		
		$l = $bts->CMObj->getLanguageListSubEntry($WebSiteObj->getWebSiteEntry('ws_lang'), 'lang_639_3');
		$bts->I18nTransObj->apply(array( "type" => "file", "file" => $infos['module']['module_directory']."/i18n/".$l.".php", "format" => "php" ) );

		$baseUrl = $CurrentSetObj->getInstanceOfServerInfosObj()->getServerInfosEntry('base_url');
		
		if (!class_exists("DocumentData")) { include ("modules/initial/DocumentDisplay/DocumentData.php"); }
		$CurrentSetObj->setInstanceOfDocumentDataObj(new DocumentData());
		$DocumentDataObj = $CurrentSetObj->getInstanceOfDocumentDataObj();
		$DocumentDataObj->getDataFromDB();


// 		We have a document object. Now we have to process it.
		$DocumentDataObj->setDocumentDataEntry ('arti_creation_date',		date ("Y M d - H:i:s",$DocumentDataObj->getDocumentDataEntry('arti_creation_date')) );
		$DocumentDataObj->setDocumentDataEntry ('arti_validation_date',		date ("Y M d - H:i:s",$DocumentDataObj->getDocumentDataEntry('arti_validation_date')) );
		$DocumentDataObj->setDocumentDataEntry ('arti_release_date',		date ("Y M d - H:i:s",$DocumentDataObj->getDocumentDataEntry('arti_release_date')) );
		$DocumentDataObj->setDocumentDataEntry ('docu_creation_date',		date ("Y M d - H:i:s",$DocumentDataObj->getDocumentDataEntry('docu_creation_date')) );
		$DocumentDataObj->setDocumentDataEntry ('docu_examination_date',	date ("Y M d - H:i:s",$DocumentDataObj->getDocumentDataEntry('docu_examination_date')) );
		$DocumentDataObj->setDocumentDataEntry ('docu_cont_brut',			$DocumentDataObj->getDocumentDataEntry('docu_cont'));
		
		$document_list = array();
		$LD_idx = 1;
		$document_list[$LD_idx]['arti_id']					= $DocumentDataObj->getDocumentDataEntry('arti_id');
		$document_list[$LD_idx]['arti_title']				= $DocumentDataObj->getDocumentDataEntry('arti_title');
		$document_list[$LD_idx]['arti_creator_id']			= $DocumentDataObj->getDocumentDataEntry('arti_creator_id');
		$document_list[$LD_idx]['arti_creation_date']		= $DocumentDataObj->getDocumentDataEntry('arti_creation_date');
		$document_list[$LD_idx]['arti_validator_id']		= $DocumentDataObj->getDocumentDataEntry('arti_validator_id');
		$document_list[$LD_idx]['arti_validation_date']		= $DocumentDataObj->getDocumentDataEntry('arti_validation_date');
		$LD_idx++;
		$document_list[$LD_idx]['docu_id']					= $DocumentDataObj->getDocumentDataEntry('docu_id');
		$document_list[$LD_idx]['docu_name']				= $DocumentDataObj->getDocumentDataEntry('docu_name');
		$document_list[$LD_idx]['docu_creator']				= $DocumentDataObj->getDocumentDataEntry('docu_creator');
		$document_list[$LD_idx]['docu_creation_date']		= $DocumentDataObj->getDocumentDataEntry('docu_creation_date');
		$document_list[$LD_idx]['docu_examiner']			= $DocumentDataObj->getDocumentDataEntry('docu_examiner');
		$document_list[$LD_idx]['docu_examination_date']	= $DocumentDataObj->getDocumentDataEntry('docu_examination_date');
		$LD_idx++;
		
		$position_float =array( '0' => "none", '1' => "left", '2' => "right");
		$dbquery = $bts->SDDMObj->query("
		SELECT *
		FROM ".$SqlTableListObj->getSQLTableName('article_config')."
		WHERE config_id = '".$DocumentDataObj->getDocumentDataEntry('fk_config_id')."'
		;");
		while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_type',					$dbp['config_menu_type']);
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_style',					$dbp['config_menu_style']);
			$DocumentDataObj->setDocumentDataEntry ('config_menu_float_position',		$dbp['config_menu_float_position']);
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_float_position',			$position_float[$DocumentDataObj->getDocumentDataEntry ('config_menu_float_position')] );
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_float_taille_x',			$dbp['config_menu_float_size_x']);
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_float_taille_y',			$dbp['config_menu_float_size_y']);
			$DocumentDataObj->setDocumentDataEntry ('arti_menu_occurence',				$dbp['config_menu_occurence']);
			$DocumentDataObj->setDocumentDataEntry ('arti_montre_info_parution',		$dbp['config_show_release_info']);
			$DocumentDataObj->setDocumentDataEntry ('arti_montre_info_modification',	$dbp['config_show_info_update']);
		}

		// --------------------------------------------------------------------------------------------
		//	Get the article number of pages (Article != Document)
		$sqlQuery = "
		SELECT COUNT(fk_docu_id) AS arti_nbr_page
		FROM "
		.$SqlTableListObj->getSQLTableName('article')." art, "
		.$SqlTableListObj->getSQLTableName('deadline')." bcl
		WHERE art.arti_ref = '".$CurrentSetObj->getDataSubEntry('article', 'arti_ref')."'
		AND art.fk_ws_id = '".$WebSiteObj->getWebSiteEntry('ws_id')."'
		AND art.fk_deadline_id = bcl.deadline_id
		AND bcl.deadline_state = '1'
		;";
		$dbquery = $bts->SDDMObj->query($sqlQuery);
		while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) { $DocumentDataObj->setDocumentDataEntry ('arti_nbr_page', $dbp['arti_nbr_page']); }
		$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " arti_nbr_page=`".$DocumentDataObj->getDocumentDataEntry ('arti_nbr_page')."`"));
		
		// --------------------------------------------------------------------------------------------
		//	
		//	
		//	Document processing
		//	
		//	
		//	
		$Content = "";
		$Block = $ThemeDataObj->getThemeName().$infos['block'];
		
		$Content .= "
		<table class='".$Block."_ft'>\r
		<tr>\r
		<td class='".$Block."_ft1'></td>\r
		<td class='".$Block."_ft2'>".$DocumentDataObj->getDocumentDataEntry('arti_title')."</td>\r
		<td class='".$Block."_ft3'></td>\r
		</tr>\r
		</table>\r
		<h2>". $DocumentDataObj->getDocumentDataEntry('arti_subtitle') ."</h2>
			<div id='document_contenu' class='".$Block."_div_std'>
		";
		
		// --------------------------------------------------------------------------------------------
		//	Create the menu if needed
		//
		// 	If we have more than 1 page for this article, the menu is necessary.
		if ( $DocumentDataObj->getDocumentDataEntry('arti_nbr_page') > 1 && $DocumentDataObj->getDocumentDataEntry('arti_menu_type') > 0 ) {
			$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " menu needed"));
			
			$q = "
			SELECT art.arti_id, art.arti_ref, art.arti_slug, art.arti_subtitle, art.arti_page, bcl.deadline_name 
			FROM "
			.$SqlTableListObj->getSQLTableName('article')." art, "
			.$SqlTableListObj->getSQLTableName('deadline')." bcl 
			WHERE art.arti_ref = '".$CurrentSetObj->getDataSubEntry('article', 'arti_ref')."' 
			AND art.arti_validation_state = '1' 
			AND art.fk_ws_id = '".$WebSiteObj->getWebSiteEntry('ws_id')."' 
			AND art.fk_deadline_id = bcl.deadline_id 
			AND bcl.deadline_state = '1'
			;";
			$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_BREAKPOINT, 'msg' => __METHOD__ . " q=`".$q."`"));
			$dbquery = $bts->SDDMObj->query($q);
			
			$pv = array();
			$P2P_tab_ = array();
			$tab_menu_selected = array();
			$pv['1'] = 1;
			$pv['2'] = $DocumentDataObj->getDocumentDataEntry ('arti_page');
			$tab_menu_selected[$pv['2']] = " selected";
			while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
				$P2P_tab_[$pv['1']]['arti_id']			= $dbp['arti_id'];
				$P2P_tab_[$pv['1']]['arti_ref']			= $dbp['arti_ref'];
				$P2P_tab_[$pv['1']]['arti_slug']		= $dbp['arti_slug'];
				$P2P_tab_[$pv['1']]['arti_subtitle']	= $dbp['arti_subtitle'];
				$P2P_tab_[$pv['1']]['arti_page']		= $dbp['arti_page'];
// ?sw=".$WebSiteObj->getWebSiteEntry('ws_id')."&amp;l=".$WebSiteObj->getWebSiteEntry('ws_lang')."&amp;arti_ref=".$dbp['arti_ref']."&amp;arti_page=".$dbp['arti_page']."&amp;user_login=".$CurrentSetObj->getInstanceOfUserObj()->getUserEntry('login')."&amp;user_pass=".$CurrentSetObj->getInstanceOfUserObj()->getUserEntry('pass')."
				$P2P_tab_[$pv['1']]['lien']				= "
				<a class='".$Block."_lien ".$Block."_t2'
				href='".$baseUrl.$dbp['arti_slug']."/".$dbp['arti_page']."'
				onMouseOver=\"t.ToolTip('-> ". addslashes($dbp['arti_subtitle']) .", en page ".$dbp['arti_page']."');\"
				onMouseOut=\"t.ToolTip();\">".$dbp['arti_page']." ".$dbp['arti_subtitle']."</a>\r
				";
				$P2P_tab_[$pv['1']]['menu_select']		= "<option value='".$dbp['arti_page']."' ".$tab_menu_selected[$pv['1']].">".$dbp['arti_page']." - ".$dbp['arti_subtitle']."</option>\r";
				$pv['1']++;
			}
			
			$pv['p2p_count'] = $pv['1'] -1;
		
			switch ( $DocumentDataObj->getDocumentDataEntry ('arti_menu_type') ) {
				case "1":
					$T = array();
					$AD = &$T['Content'];
					$ADC = &$T['ContentCfg'];
					
					$i = 1;
					foreach ( $P2P_tab_ as $A ) {
						if ( $A['arti_page'] == $DocumentDataObj->getDocumentDataEntry ('arti_page') ) {
							$AD['1'][$i]['1']['cont'] = $A['arti_page']." ".$A['arti_subtitle'];
							$pv['p2p_marque'] = $A['arti_page'];
						}
						else { $AD['1'][$i]['1']['cont'] = $A['lien']; }
						$i++;
					}
					
					$ADC['tabs']['1']['NbrOfLines'] = ($i-1);	$ADC['tabs']['1']['NbrOfCells'] = 1;	$ADC['tabs']['1']['TableCaptionPos'] = 0;
					$T['ContentInfos'] = $bts->RenderTablesObj->getDefaultDocumentConfig($infos, ($i-1), 1);
					$T['ContentInfos']['tabTxt1']		= $bts->I18nTransObj->getI18nTransEntry('tab1');
					$T['ContentInfos']['EnableTabs']	= 0;
					
					$ContentMenu .= $bts->RenderTablesObj->render($infos, $T);
					break;
					
				case "2":
					$ContentMenu = "
					<form ACTION='/' method='post'>\r
					<table class='".$Block._CLASS_TABLE01_." ".$Block._CLASS_TBL_LGND_TOP_."' style='border:1px solid #000000; box-shadow:8px 5px 5px #80808080;'>\r
					<tr>
					<td style='font-weight:bold; font-size:150%; opacity:0.75'>Index</td>\r
					</tr>\r
					<tr>\r
					<td class='".$Block."_fca'>
					<select name='newRoute[arti_page]' class='".$Block."_form_1' style='padding:5px;' onChange=\"javascript:this.form.submit();\">\r";
					$pv['1'] = 1;
					foreach ( $P2P_tab_ as $A ) {
						if ( $A['arti_page'] == $DocumentDataObj->getDocumentDataEntry('arti_page') ) { $pv['p2p_marque'] = $A['arti_page']; }
						$ContentMenu .= $A['menu_select'];
					}
					$ContentMenu .= "</select>\r
					</tr>\r
					</table>\r
					<input type='hidden' name='newRoute[arti_slug]'				value='".$CurrentSetObj->getDataSubEntry('article', 'arti_slug')."'>
					<input type='hidden' name='formSubmitted'					value='1'>
					</form>\r
					";
				break;
				default:
					$ContentMenu = "plop";
					break;
			}
			// --------------------------------------------------------------------------------------------
			switch ( $DocumentDataObj->getDocumentDataEntry('arti_menu_style') ) {
				case "0":
				case "1":
					$ContentMenu = "<div id='document_menu' class='" . $Block."_div_std' style='padding: 10px;'>\r" . $ContentMenu . "</div>\r";
					break;
				case "2":
					( $DocumentDataObj->getDocumentDataEntry('arti_menu_float_taille_x') != 0 ) ? $tab_float_['taille_x'] = "width: ".$DocumentDataObj->getDocumentDataEntry('arti_menu_float_taille_x')."px;" : $tab_float_['taille_x'] = "width:auto; ";
					( $DocumentDataObj->getDocumentDataEntry('arti_menu_float_taille_y') != 0 ) ? $tab_float_['taille_y'] = "height: ".$DocumentDataObj->getDocumentDataEntry('arti_menu_float_taille_y')."px;" : $tab_float_['taille_y'] = "height:auto; ";
					
					$ContentMenu = "
						<div id='menu_container' style='display:block; width:".$ThemeDataObj->getThemeDataEntry('theme_module_internal_width')."px; text-align:".$DocumentDataObj->getDocumentDataEntry('arti_menu_float_position')."'> 
						<div id='document_menu' class='" . $Block."_div_std' style='display:inline-block; text-align:justify; ".$tab_float_['taille_x']." ".$tab_float_['taille_y']." padding: 10px;'>\r" . $ContentMenu . "</div>\r
						</div>
						";
					
					break;
			}
		}
		// --------------------------------------------------------------------------------------------
		//	Document evaluation and display
		// --------------------------------------------------------------------------------------------
		switch ( $DocumentDataObj->getDocumentDataEntry('arti_menu_occurence') ) {
			case "1":
			case "3":
				$Content .= $ContentMenu;
				break;
		}
		// --------------------------------------------------------------------------------------------
		$analysedContent = $DocumentDataObj->getDocumentDataEntry('docu_cont');
		
		$documentAnalyse = array();
		$documentAnalyse['mode'] = "search";
		$documentAnalyse['nbr'] = 1 ;

		// If another type is added this table must change accordingly.
		// 0:HTML	1:PHP(exec)	2:MIXED(PHP/HTML)
		$ad = array();
		$ad['0']['0'] = 0;	$ad['1']['0'] = 2;	$ad['2']['0'] = 2;
		$ad['0']['1'] = 2;	$ad['1']['1'] = 1;	$ad['2']['1'] = 2;
		$ad['0']['2'] = 2;	$ad['1']['2'] = 2;	$ad['2']['2'] = 2;
		
		while ( $documentAnalyse['mode'] == "search" ) {
			$documentAnalyse['start'] = stripos( $analysedContent , "[INCLUDE]");
			$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " Analyze n=". $documentAnalyse['nbr'] ));
			if ( $documentAnalyse['start'] !== FALSE ) {
				$documentAnalyse['contenu_include']	= "";
				$documentAnalyse['docu_type']			= 0; //MWMCODE
				$documentAnalyse['stop']				= stripos( $analysedContent , "[/INCLUDE]", $documentAnalyse['start']+9);
				$documentAnalyse['start2']				= $documentAnalyse['start'] + 9;
				$documentAnalyse['include_docu_name']	= substr($analysedContent , $documentAnalyse['start2'], ($documentAnalyse['stop'] - $documentAnalyse['start2']) );
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " [INCLUDE] requires : ". $documentAnalyse['include_docu_name'] ));
				$dbquery = $bts->SDDMObj->query("
				SELECT doc.docu_id, doc.docu_type, doc.docu_cont, doc.docu_creator, doc.docu_creation_date, doc.docu_examiner, doc.docu_examination_date
				FROM "
				.$SqlTableListObj->getSQLTableName('document')." doc, "
				.$SqlTableListObj->getSQLTableName('document_share')." ds
				WHERE doc.docu_name = '".$documentAnalyse['include_docu_name']."'
				AND doc.docu_id = ds.fk_docu_id
				AND ds.fk_ws_id = '".$WebSiteObj->getWebSiteEntry('ws_id')."'
				;");
				
				if ( $bts->SDDMObj->num_row_sql($dbquery) == 0 ) {
					$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_ERROR, 'msg' => __METHOD__ . " Could not find the document named `".$documentAnalyse['include_docu_name']."` in INCLUDE." ));
					$documentAnalyse['contenu_include']	= " ";
					$documentAnalyse['docu_type']			= 0; //MWMCODE
				}
				else {
					while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
						$documentAnalyse['contenu_include']	= $dbp['docu_cont'];
						$documentAnalyse['docu_type']		= $dbp['docu_type'];
						$document_list[$LD_idx]['docu_id']						= $DocumentDataObj->getDocumentDataEntry('docu_id');
						$document_list[$LD_idx]['docu_name']					= $DocumentDataObj->getDocumentDataEntry('docu_name');
						$document_list[$LD_idx]['docu_creator']					= $DocumentDataObj->getDocumentDataEntry('docu_creator');
						$document_list[$LD_idx]['docu_creation_date']			= $DocumentDataObj->getDocumentDataEntry('docu_creation_date');
						$document_list[$LD_idx]['docu_examiner']				= $DocumentDataObj->getDocumentDataEntry('docu_examiner');
						$document_list[$LD_idx]['docu_examination_date']		= $DocumentDataObj->getDocumentDataEntry('docu_examination_date');
						$LD_idx++;
					}
				}
				$x = $DocumentDataObj->getDocumentDataEntry('docu_type');
				$y = $documentAnalyse['docu_type'];
				
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " Document is now in the case N=". $ad[$x][$y] ));
				$DocumentDataObj->setDocumentDataEntry('docu_type', $ad[$x][$y]);
				
				$documentAnalyse['stop2'] = $documentAnalyse['stop'] + 10;
				$documentAnalyse['taille_fin'] = strlen($analysedContent) - $documentAnalyse['stop2'];
				$phpMarkupB = ($documentAnalyse['docu_type'] == 1) ? " <?php\r ": ""; 
				$phpMarkupE = ($documentAnalyse['docu_type'] == 1) ? " ?>\r ": ""; 
				
				// Will allow modular document to use external ressources from the included document
				$search = array ("{[DataLocation]}");
				$replace = array($baseUrl."websites-data/".$WebSiteObj->getWebSiteEntry('ws_directory')."/data/documents/".$document_list[$LD_idx]['docu_name']."/");
				$documentAnalyse['contenu_include'] = str_replace($search, $replace, $documentAnalyse['contenu_include']);
				
				$analysedContent = substr( $analysedContent , 0, $documentAnalyse['start'] ) .$phpMarkupB. $documentAnalyse['contenu_include'] .$phpMarkupE. substr($analysedContent ,$documentAnalyse['stop2'] , $documentAnalyse['taille_fin']) ;
				
				
			}
			else{ $documentAnalyse['mode'] = "exit"; }
			if ( $documentAnalyse['nbr'] == 15 ) { $documentAnalyse['mode'] = "exit"; }
			$documentAnalyse['nbr']++;
		}

// 		We need to modify the css classnames expressions in the script
		$search = array (	'{[block]}',	"{[DataLocation]}");
		$replace = array(	$Block,			$baseUrl."websites-data/".$WebSiteObj->getWebSiteEntry('ws_directory')."/data/documents/".$DocumentDataObj->getDocumentDataEntry('docu_name')."/");
		$analysedContent = str_replace($search, $replace, $analysedContent);
		
//		$LMObj->logDebug($analyse_document, "\$analyse_document");
		
		// --------------------------------------------------------------------------------------------
		//  
		// Time to process the document data 
		//  
		// 
		// --------------------------------------------------------------------------------------------
		//	0: Post process & convert
		//	1: No change;
		//	2: Execution without any processing
		//	3: Mixed; Execution & simple display
		switch ( $DocumentDataObj->getDocumentDataEntry('docu_type')) {
			case 0 :
				$result = $analysedContent;
// 				$result = $this->documentPostProcessing($analysedContent, $infos);
// 				$result = $this->documentConvertion($analysedContent, $infos);
// 				$result = &$analysedContent;
				break;
			case 1 :
				$result = eval ($analysedContent);
				break;
			case 2 :
				$result = $this->documentExecution($analysedContent, $infos);
				break;
		}
		
		$Content .= $result;
		

		// --------------------------------------------------------------------------------------------
		// Update document stats
		
		// 2020 09 18 - Change of plan
		// stored event is the new table. Different way of doing things.
		
		
// 		$dbquery = $SDDMObj->query("
// 		SELECT *
// 		FROM ".$SqlTableListObj->getSQLTableName('stat_document')."
// 		WHERE arti_id = '".$DocumentDataObj->getDocumentDataEntry('arti_id')."'
// 		AND  arti_page = '".$DocumentDataObj->getDocumentDataEntry('arti_page')."'
// 		;");
// 		if ( $SDDMObj->num_row_sql($dbquery) == 0 ) {
// 			$SDDMObj->query("
// 			INSERT INTO ".$SqlTableListObj->getSQLTableName('stat_document')." VALUES (
// 			'".$DocumentDataObj->getDocumentDataEntry('arti_id')."',
// 			'".$DocumentDataObj->getDocumentDataEntry('arti_page')."',
// 			'1'
// 			);");
// 		}
// 		elseif ( $SDDMObj->num_row_sql($dbquery) == 1 ) {
// 			while ($dbp = $SDDMObj->fetch_array_sql($dbquery)) { $pv['arti_count'] = $dbp['arti_count']+1; }
// // 			$pv['arti_count']++;
// 			$SDDMObj->query("
// 			UPDATE ".$SqlTableListObj->getSQLTableName('stat_document')." SET
// 			arti_count = '".$pv['arti_count']."'
// 			WHERE arti_id = '".$DocumentDataObj->getDocumentDataEntry('arti_id')."'
// 			AND arti_page = '".$DocumentDataObj->getDocumentDataEntry('arti_page')."'
// 			;");
// 		}

		switch ( $DocumentDataObj->getDocumentDataEntry('arti_menu_occurence') ) {
			case "1":
			case "3":
				$Content .= $ContentMenu;
				break;
		}
		
		// --------------------------------------------------------------------------------------------
		//	Footer
		// --------------------------------------------------------------------------------------------
		$Content .= "
		<br>\r
		</div>\r
		<div id='document_pied_de_page' style='width: ".$ThemeDataObj->getThemeDataEntry('theme_module_internal_width')."px;'>\r
		<p>";
		
		if ( $pv['p2p_count'] > 1 ) {
			$currentRouteSlug = $CurrentSetObj->getDataSubEntry('article', 'arti_slug');
			$CurrentArtiPage = $CurrentSetObj->getDataSubEntry ( 'article', 'arti_page');
			switch ($pv['p2p_marque']) {
				case "1":
					$Content .= "<a href='".$baseUrl.$currentRouteSlug."/".($CurrentArtiPage+1)."'>".$bts->I18nTransObj->getI18nTransEntry('next1')."</a>\r";
					break;
				case $pv['p2p_count']:
					$Content .= "<a href='".$baseUrl.$currentRouteSlug."/".($CurrentArtiPage-1)."'>".$bts->I18nTransObj->getI18nTransEntry('previous1')."</a>\r";
					break;
				default:
				$Content .= "
				<a href='".$baseUrl.$currentRouteSlug."/".($CurrentArtiPage-1)."'>".$bts->I18nTransObj->getI18nTransEntry('previous1')."</a>\r
				-\r
				<a href='".$baseUrl.$currentRouteSlug."/".($CurrentArtiPage+1)."'>".$bts->I18nTransObj->getI18nTransEntry('next1')."</a>\r";
					break;
			}
		}
		$Content .= "</p></div>\r";
		
		// --------------------------------------------------------------------------------------------
		//	Document information (author etc...)
		// --------------------------------------------------------------------------------------------
		
		if ( ( $DocumentDataObj->getDocumentDataEntry('arti_montre_info_modification') + $DocumentDataObj->getDocumentDataEntry('arti_montre_info_parution') ) != 0 ) {
			$ADP_users = array();
			$dbquery = $bts->SDDMObj->query("
			SELECT u.user_id,u.user_name
			FROM "
			.$SqlTableListObj->getSQLTableName('user')." u , "
			.$SqlTableListObj->getSQLTableName('group_user')." gu, "
			.$SqlTableListObj->getSQLTableName('group_website')." gw 
			WHERE u.user_id = gu.fk_user_id
			AND gu.fk_group_id = gw.fk_group_id
			AND gu.group_user_initial_group = '1'
			ORDER BY u.user_id
			;");
			while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) { $ADP_users[$dbp['user_id']] = $dbp['user_name']; }
			
			$Content .= "
			<hr>\r
			<div 
				class='".$Block._CLASS_TXT_FADE_."' 
				style='font-size:".floor($ThemeDataObj->getThemeBlockEntry($infos['block']."T", "txt_font_size")*0.75)."px'
				id='document_infos' style='position: absolute;'
			>\r
			";
			
			$pv['LD_1er'] = 1;
			foreach ( $document_list as $A ) {
				if ( $pv['LD_1er'] == 1 ) {
					$pv['C'] = "<b>'" . $A['arti_title'] . "'</b><br>\r" . $bts->I18nTransObj->getI18nTransEntry('authors_by') . $ADP_users[$A['arti_creator_id']] .
					$bts->I18nTransObj->getI18nTransEntry('authors_date') . $A['arti_creation_date'] . " - " .
					$bts->I18nTransObj->getI18nTransEntry('authors_update') . $A['arti_validation_date'] . $bts->I18nTransObj->getI18nTransEntry('authors_by') . $ADP_users[$A['arti_validator_id']] . "<br>\r";
					$pv['LD_1er'] = 0;
				}
				else {
					$pv['C'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $bts->I18nTransObj->getI18nTransEntry('authors_by') . $ADP_users[$A['docu_creator']] .
					$bts->I18nTransObj->getI18nTransEntry('authors_date') . $A['docu_creation_date'] . " - " .
					$bts->I18nTransObj->getI18nTransEntry('authors_update') . $A['docu_examination_date'] . $bts->I18nTransObj->getI18nTransEntry('authors_by') . $ADP_users[$A['docu_examiner']] . "<br>\r";
				}
				$Content .= $pv['C'];
			}
			$Content .= "
			</div>\r
			";
		}
		
		// --------------------------------------------------------------------------------------------
		//	All processing finished. We ship it.

		if ( $WebSiteObj->getWebSiteEntry('ws_info_debug') < 10 ) {
// 			if ( $document_tableau != "MAA_" ) { unset ($DT); }
// 			if ( $DT['arti_menu_occurence'] != 4 ) { unset ($document_menu_contenu); }
			unset (
					$ad,
					$ADP_users,
					$documentAnalyse,
					$dbp,
					$dbquery,
					$i,
					$P2P_tab_,
					$position_float,
					$pv,
					$x,
					$y
					);
		}
// 		$LMObj->logDebug( $DocumentDataObj->getDocumentData() , "\$DocumentDataObj->getDocumentData()");
// 		$LMObj->logDebug( $CurrentSetObj->getData() , "\$CurrentSetObj->getData()");
//		$LMObj->setInternalLogTarget($LOG_TARGET);
		
		return $Content;
	}
	
	/**
	 * 
	 * <b>DEPRECATED</b> : This function converts all tags into HTML code
	 */
// 	private function documentConvertion (&$inputContent, $infos) {
// 		$CurrentSetObj = CurrentSet::getInstance();
// 		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
// 		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
// // 		$UserObj = $CurrentSetObj->getInstanceOfUserObj();
// 		$DocumentDataObj = $CurrentSetObj->getInstanceOfDocumentDataObj();
		
// 		$directory = $DocumentDataObj->getDocumentDataEntry('arti_ref')."_p0".$DocumentDataObj->getDocumentDataEntry('arti_page');
// 		$Block = $ThemeDataObj->getThemeName().$infos['block'];
// 		$s = array();
// 		$r = array();
// 		$ptr = 0;
		
// 		for ($i = 1 ; $i < 8 ; $i++ ) {
// 			$html_str = "<span class='" .$Block."_";
// 			$html_str_p = "<p class='" . $Block."_p " . $Block."_";
// 			$s[$ptr] = "[T".$i."]";			$r[$ptr] = $html_str . "t".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[TB".$i."]";		$r[$ptr] = $html_str . "tb".$i."'> ";					$ptr++;
			
// 			$s[$ptr] = "[T".$i."]";			$r[$ptr] = $html_str_p . "t".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[TB".$i."]";		$r[$ptr] = $html_str_p . "tb".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[P".$i."]";			$r[$ptr] = $html_str_p . "t".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[PB".$i."]";		$r[$ptr] = $html_str_p . "tb".$i."'> ";					$ptr++;
			
// 			$s[$ptr] = "[P".$i."B]";		$r[$ptr] = $html_str_p . "tb".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[T".$i."B]";		$r[$ptr] = $html_str . "tb".$i."'> ";					$ptr++;
// 			$s[$ptr] = "[CODE".$i."]";		$r[$ptr] = "<div class='" . $Block."_code'><code class='" . $Block."_code " . $Block."_t".$i."'> ";	$ptr++;
			
// 			$html_str = "<td class='" . $Block."_";
// 			$s[$ptr] = "[TDFC".$i."]";		$r[$ptr] = $html_str . "fc " . $Block."_t".$i."' ";		$ptr++;
// 			$s[$ptr] = "[TDFCT".$i."]";		$r[$ptr] = $html_str . "fct " . $Block."_tb".$i."' ";	$ptr++;
			
// 			$s[$ptr] = "[TDFCA".$i."]";		$r[$ptr] = $html_str . "fca " . $Block."_t".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCB".$i."]";		$r[$ptr] = $html_str . "fcb " . $Block."_t".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCC".$i."]";		$r[$ptr] = $html_str . "fcc " . $Block."_t".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCD".$i."]";		$r[$ptr] = $html_str . "fcd " . $Block."_t".$i."' ";	$ptr++;
			
// 			$s[$ptr] = "[TDFCAB".$i."]";	$r[$ptr] = $html_str . "fca " . $Block."_tb".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCBB".$i."]";	$r[$ptr] = $html_str . "fcb " . $Block."_tb".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCCB".$i."]";	$r[$ptr] = $html_str . "fcc " . $Block."_tb".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCDB".$i."]";	$r[$ptr] = $html_str . "fcd " . $Block."_tb".$i."' ";	$ptr++;
			
// 			$s[$ptr] = "[TDFCTA".$i."]";	$r[$ptr] = $html_str . "fcta " . $Block."_t".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCTB".$i."]";	$r[$ptr] = $html_str . "fctb " . $Block."_t".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCTAB".$i."]";	$r[$ptr] = $html_str . "fcta " . $Block."_tb".$i."' ";	$ptr++;
// 			$s[$ptr] = "[TDFCTBB".$i."]";	$r[$ptr] = $html_str . "fctb " . $Block."_tb".$i."' ";	$ptr++;
			
// 			$s[$ptr] = "[L".$i."]";
// 			$r[$ptr] = "<a class='" . $Block."_lien " . $Block."_t".$i."' href='";
// 			$ptr++;
			
// 			$s[$ptr] = "[H".$i."]";			$r[$ptr] = "<h".$i."'> ";								$ptr++;
// 			$s[$ptr] = "[/H".$i."]";		$r[$ptr] = "</h".$i."'> ";								$ptr++;
// 		}
// 		$s[$ptr] = "[P]";			$r[$ptr] = "<p class='" . $Block."_p " . $Block."_t2";			$ptr++;
// 		$s[$ptr] = "[/P]";			$r[$ptr] = "</p>\r";								$ptr++;
// 		$s[$ptr] = "[TABLE]";		$r[$ptr] = "<table>\r";								$ptr++;
// 		$s[$ptr] = "[/TABLE]";		$r[$ptr] = "</table>\r";							$ptr++;
// 		$s[$ptr] = "[TW_MLI]";		$r[$ptr] = $ThemeDataObj->getThemeDataEntry('skin_module_largeur_interne');			$ptr++;
// 		$s[$ptr] = "[TAB_STD]";		$r[$ptr] = "<table ".$ThemeDataObj->getThemeDataEntry('tab_std_rules')." style='text-align: left; vertical-align: top;'width='";			$ptr++;
// 		$s[$ptr] = "[/L]";			$r[$ptr] = "</a>";									$ptr++;
// 		$s[$ptr] = "[TR]";			$r[$ptr] = "<tr>";									$ptr++;
// 		$s[$ptr] = "[/TR]";			$r[$ptr] = "</tr>\r";								$ptr++;
// 		$s[$ptr] = "[TD]";			$r[$ptr] = "<td>";									$ptr++;
// 		$s[$ptr] = "[/TD]";			$r[$ptr] = "</td>\r";								$ptr++;
// 		$s[$ptr] = "[COLSP]";		$r[$ptr] = " colspan='";							$ptr++;
// 		$s[$ptr] = "[ROWSP]";		$r[$ptr] = " rowspan='";							$ptr++;
// 		$s[$ptr] = "[CODE]";		$r[$ptr] = "<div class='" . $Block."_code'><code class='" . $Block."_code'> ";		$ptr++;
// 		$s[$ptr] = "[/CODE]";		$r[$ptr] = "</div></code>";							$ptr++;
// 		$s[$ptr] = "[FE]";			$r[$ptr] = "'>";									$ptr++;
// 		$s[$ptr] = "[F]";			$r[$ptr] = ">";										$ptr++;
		
// 		$s[$ptr] = "[J]";			$r[$ptr] = "<p style='text-align: justify;'>\r";	$ptr++;
// 		$s[$ptr] = "[/J]";			$r[$ptr] = "</p>\r";								$ptr++;
// 		$s[$ptr] = "[BR]";			$r[$ptr] = "<br>\r";								$ptr++;
// 		$s[$ptr] = "[HR]";			$r[$ptr] = "<hr>\r";								$ptr++;
// 		$s[$ptr] = "[B]";			$r[$ptr] = "<span style='font-weight: bold;'>";		$ptr++;
// 		$s[$ptr] = "[/B]";			$r[$ptr] = "</span>";								$ptr++;
// 		$s[$ptr] = "[CENTER]";		$r[$ptr] = "<p style='text-align: center;'>";		$ptr++;
// 		$s[$ptr] = "[/CENTER]";		$r[$ptr] = "</p>\r";								$ptr++;
// 		$s[$ptr] = "[TAB]";			$r[$ptr] = "&nbsp;&nbsp;&nbsp;&nbsp;";				$ptr++;
// 		$s[$ptr] = "[L_T]";			$r[$ptr] = "' target='_NEW'>";						$ptr++;
		
// 		$s[$ptr] = "[USER_L]";		$r[$ptr] = $CurrentSetObj->getInstanceOfUserObj()->getUserEntry('login');			$ptr++;
		
// 		$s[$ptr] = "[POPIMG_L]";	$r[$ptr] = "<a target='_NEW' href='../websites-data/".$WebSiteObj->getWebSiteEntry('ws_directory')."/data/documents/".$directory."/";			$ptr++;
// 		$s[$ptr] = "[/POPIMG_L]";	$r[$ptr] = "'>";			$ptr++;
		
// 		$s[$ptr] = "[POPIMG_I]";	$r[$ptr] = "<img src='../websites-data/".$WebSiteObj->getWebSiteEntry('ws_directory')."/data/documents/".$directory."/";			$ptr++;
// 		$s[$ptr] = "[POPIMG_S10]";	$r[$ptr] = "' alt='Click' width='10%' height='10%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S20]";	$r[$ptr] = "' alt='Click' width='20%' height='20%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S30]";	$r[$ptr] = "' alt='Click' width='30%' height='30%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S40]";	$r[$ptr] = "' alt='Click' width='40%' height='40%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S50]";	$r[$ptr] = "' alt='Click' width='50%' height='50%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S60]";	$r[$ptr] = "' alt='Click' width='60%' height='60%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S70]";	$r[$ptr] = "' alt='Click' width='70%' height='70%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S80]";	$r[$ptr] = "' alt='Click' width='80%' height='80%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S90]";	$r[$ptr] = "' alt='Click' width='90%' height='90%' border='0";						$ptr++;
// 		$s[$ptr] = "[POPIMG_S100]";	$r[$ptr] = "' alt='Click' width='100%' height='100%' border='0";					$ptr++;
// 		$s[$ptr] = "[/POPIMG_I]";	$r[$ptr] = "'>";																	$ptr++;
		
// 		$s[$ptr] = "[IMGSRC]";		$r[$ptr] = "<img src='../websites-data/".$WebSiteObj->getWebSiteEntry('ws_directory')."/data/documents/".$directory."/";			$ptr++;
// 		$s[$ptr] = "[IMGALT]";		$r[$ptr] = "' alt='";							$ptr++;
// 		$s[$ptr] = "[IMGBRD]";		$r[$ptr] = "' border='0'>";						$ptr++;
		
// 		$s[$ptr] = "[FLOAT_L]";		$r[$ptr] = "<div style='float: left;'>";		$ptr++;
// 		$s[$ptr] = "[FLOAT_R]";		$r[$ptr] = "<div style='float: right;'>";		$ptr++;
// 		$s[$ptr] = "[/FLOAT]";		$r[$ptr] = "</div>";							$ptr++;
		
// 		$s[$ptr] = "[/F]";			$r[$ptr] = "</span>";							$ptr++;
		
// 		$inputContent = str_replace ($s,$r,$inputContent);
// 	}
	
	/**
	 * 
	 * This function will execute & convert the document one chunk at a time as it is marked as "mixed".
	 */
	private function documentExecution (&$inputContent, $infos) {
		$CurrentSetObj = CurrentSet::getInstance();
// 		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
// 		$ThemeDataObj = $CurrentSetObj->getInstanceOfThemeDataObj();
// 		$UserObj = $CurrentSetObj->getInstanceOfUserObj();
		$DocumentDataObj = $CurrentSetObj->getInstanceOfDocumentDataObj();
		
// 		$directory = $DocumentDataObj->getDocumentDataEntry('arti_ref')."_p0".$DocumentDataObj->getDocumentDataEntry('arti_page');
// 		$Block = $ThemeDataObj->getThemeName().$infos['block'];
		
		$pv = array();
		$StartPos		= 0;
		$EndPos			= 0;
		$SearchAction	= "ON";
		$Mode			= "NORMAL";
		$Content		= "";
		
		while ( $SearchAction == "ON" ) {																		// This is ON we loop
			$SearchAction = "OFF";																				// Allow to exit the loop if no ['WM'] is found
			if ($Mode == "NORMAL") {																			// The normal mode is looking for the first ['WM']
				$StartPos = strpos ( $DocumentDataObj->getDocumentDataEntry('docu_cont') ,
						"['WM']" , $StartPos );																	// Gives the first ['WM'] position
				if ( $StartPos == false) {																		// Checks if a markup is found... or not
					if ( $EndPos == 0 ) { 																		// Finds code presence in the whole document
						// $this->documentConvertion( $inputContent , $infos );									// If there is no code to execute, we display the document directly
						$pv['wm_fini'] = 1;
					}
					if ( $pv['wm_fini'] != 1 ) {
						$pv['docu_len'] = strlen ($inputContent);												// This is the document end, it gives the length
						$pv['docu_tmp_cont'] = substr( $inputContent , $EndPos , $pv['docu_len'] - $EndPos );	// There is another wm_end as a start offset;
						// $Content = $this->documentConvertion ( $pv['docu_tmp_cont'] , $infos );
						$SearchAction = "OFF";																	// We get out
					}
				}
				else {
					$pv['docu_tmp_cont'] = substr( $inputContent, $EndPos, $StartPos - $EndPos );				// Display all that is before the code.
					// $this->documentConvertion ( $pv['docu_tmp_cont'] , $infos );
					$Content .= $pv['docu_tmp_cont'];
					$Mode ="CODE";																				// Switch for execution
					$SearchAction = "ON";																		// We found a ['WM'] markup, we stay!!!
				}
			}
			if ( $Mode == "CODE" ) {
				$EndPos = strpos ( $inputContent , "['/WM']" , $StartPos );										// Get the position of the first['/WM'] after the ['WM']
				$SearchAction = "ON";																			// Allow more parsing of the document
				if ( $EndPos == false ) {																		// Will display an error message if no mark up are found
					$SearchAction = "OFF";																		// Enable to exit if no ['WM'] are found
					$Content .= "<span class='skin_princ_".$infos['bloc']."_tb2 skin_princ_".$infos['bloc']."_warning' style='font-weight: bold'>ERR : ['/WM']/['WM']. STOP!</span>";
				}
				$pv['wm_code'] = substr( $inputContent , $StartPos + 4 , $EndPos - $StartPos -4);				// Copy the code
				$Content .= eval ($pv['wm_code']);																				// Execute the code segment
				$EndPos = $EndPos +5;																			// Put the 'end' after the ['/WM'] markup
				$StartPos = $EndPos;																			// Put the 'start' after the ['/WM'] markup
				$Mode ="NORMAL";																				// Switch to NORMAL
			}
		}
		$inputContent = $Content;																				// Saves everything in the target
		
	}
	
	/**
	 * 
	 */
	private function documentPostProcessing (&$inputContent , $infos) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$Block = $CurrentSetObj->getInstanceOfThemeDataObj()->getThemeName().$infos['block'];
		$dbquery = $bts->SDDMObj->query("
		SELECT *
		FROM ".$CurrentSetObj->getInstanceOfSqlTableListObj()->getSQLTableName('keyword')."
		WHERE arti_id = '".$CurrentSetObj->getInstanceOfDocumentDataObj()->getDocumentDataEntry('arti_id')."'
		AND keyword_state = '1'
		AND ws_id = '".$CurrentSetObj->getInstanceOfWebSiteObj()->getWebSiteEntry('ws_id')."'
		;");
		while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
			$pv['MC']['id']		= $dbp['keyword_id'];
			$pv['MC']['chaine']	= $dbp['keyword_string'];
			$pv['MC']['nbr']	= $dbp['mc_nbr'];
			$pv['MC']['type']	= $dbp['keyword_type'];
			$pv['MC']['donnee']	= $dbp['keyword_data'];
			switch ($pv['MC']['type'] ) {
				case 1:
					break;
				case 2:
					$pv['MC']['cible'] = "<a class='" . $Block."_lien' href='".$pv['MC']['donnee']."' target='_new'>".$pv['MC']['chaine']."</a>";
					$inputContent = str_replace ( $pv['MC']['chaine'] , $pv['MC']['cible'] , $inputContent , $pv['MC']['nbr'] ) ;
					break;
				case 3:
					$pv['MC']['cible'] = "<span style='font-weight: bold;' onMouseOver=\"t.ToolTip('".$pv['MC']['donnee']."')\" onMouseOut=\"Bulle()\">".$pv['MC']['chaine']."</span>\r";
					$inputContent = str_replace ( $pv['MC']['chaine'] , $pv['MC']['cible'] , $inputContent , $pv['MC']['nbr'] ) ;
					break;
			}
		}
	}
}
?>