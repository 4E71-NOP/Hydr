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

class ThemeData {
	private $ThemeName = "";
	private $ThemeData = array();
	private $DecorationList = array();
	
	public function __construct() {
		for ( $i=0; $i<=30; $i++) {
			$b = sprintf("%02u",$i);
			$this->ThemeData["B".$b."T"] = $this->ThemeData["B".$b."G"] = array( "duplicateList" => "", "blockList" => "", "levelList" => "", );
			if ($i<10) {
				$this->ThemeData["B".$b."M"] = array( "duplicateList" => "", "blockList_menu" => "", "levelList" => "", );
			}
		}
	}

	/**
	 * Creates a list of all decorations that will be used against incoming data from the theme.
	 */
	public function setDecorationListFromDB () {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
// 		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
// 		$SqlTableListObj = SqlTableList::getInstance ( null, null );

		$sqlQuery = "
		SELECT *
		FROM ". $CurrentSetObj->getInstanceOfSqlTableListObj()->getSQLTableName('decoration')."
		;";
		$dbquery = $bts->SDDMObj->query($sqlQuery);
		$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Loading data \$q = `".$bts->StringFormatObj->formatToLog($sqlQuery)."`"));

		while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
			$this->DecorationList[$dbp['deco_name']]['fk_deco_id']	=	$this->DecorationList[$dbp['deco_ref_id']]['fk_deco_id']	=	$dbp['fk_deco_id'];
			$this->DecorationList[$dbp['deco_name']]['deco_type']	=	$this->DecorationList[$dbp['deco_ref_id']]['deco_type']		=	$dbp['deco_type'];
		}
	}
		
	/**
	 * Create the entries for block definitions.
	 * Make sure no decoration gets loaded 2 times.
	 */
	public function renderBlockData() {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();

// 		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
// 		$SqlTableListObj = SqlTableList::getInstance ( null, null );
// 		$StringFormat = StringFormat::getInstance();
		$CurrentBlock = array();
		$pv = array();
		
		$BlockAlreadyLoaded = array();
		$this->ThemeData['blockMCount'] = 0;
		$this->ThemeData['blockTCount'] = 0;
		$this->ThemeData['blockGCount'] = 0;
		
		for ( $i = 1 ; $i <= 30 ; $i++ ) {
			
			$Block = $bts->StringFormatObj->getDecorationBlockName( "", $i , "");
			$BlockG = "B" . $Block . "G";
			$BlockT = "B" . $Block . "T";
			
			$CurrentBlock['name'] = $this->ThemeData['theme_block_'.$Block.'_name'];
			
			if ( strlen($CurrentBlock['name']) > 0 ) {
				$cbn = $CurrentBlock['name'];
				$CurrentBlock['deco_type']	= $this->DecorationList[$cbn]['deco_type'];
				$CurrentBlock['fk_deco_id']	= $this->DecorationList[$cbn]['fk_deco_id'];
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Processing theme_block_".$Block."_name / ".$CurrentBlock['name']." with deco_id=".$CurrentBlock['fk_deco_id']));
				
				$cbal = &$BlockAlreadyLoaded[$CurrentBlock['deco_type']][$CurrentBlock['fk_deco_id']]; // Current Block Already Loaded
				if ( !isset( $cbal ) ) {
					$cbal = $BlockG;
					switch ($CurrentBlock ['deco_type']) {
						case 30 :
						case "1_div" :
							$DecoTmpObj = new Deco30_1Div ();
							$DecoTmpObj->getDeco30_1DivDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockG] = $DecoTmpObj->getDeco30_1Div ();
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							$this->colorToHtmlFormat ($this->ThemeData[$BlockG]);
							break;
						case 40 :
						case "elegance" :
							$DecoTmpObj = new Deco40_Elegance ();
							$DecoTmpObj->getDeco40_EleganceDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockG] = $DecoTmpObj->getDeco40_Elegance ();
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
						case 50 :
						case "exquise" :
							$DecoTmpObj = new Deco50_Exquisite ();
							$DecoTmpObj->getDeco50_ExquisiteDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockG] = $DecoTmpObj->getDeco50_Exquisite();
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
						case 60 :
						case "elysion" :
							$DecoTmpObj = new Deco60_Elysion ();
							$DecoTmpObj->getDeco60_ElysionDataFromDB( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockG] = $DecoTmpObj->getDeco60_Elysion();
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
					}
					$this->ThemeData[$BlockG]['deco_type'] = $CurrentBlock['deco_type'];
				}
				else {
					$this->ThemeData[$cbal]['duplicateList'] .= $BlockG." ";
					$this->ThemeData[$cbal]['blockList'] .= "B" . $Block." ";
					$this->ThemeData[$BlockG] = &$this->ThemeData[$cbal];
				}
			}
			if ( $addBlockFlag == 1 ) {
				$this->ThemeData['blockGCount']++;
				$this->ThemeData['blockGFirstInLineId'][$this->ThemeData['blockGCount']] = $i;
				$addBlockFlag = 0;
			}
			// --------------------------------------------------------------------------------------------
			//	Specific to Caligraph decoration type.
			// --------------------------------------------------------------------------------------------
			$CurrentBlock['name'] = $this->ThemeData['theme_block_'.$Block.'_text'];
			if ( strlen($CurrentBlock['name']) > 0 ) {
				$cbn = $CurrentBlock['name'];
				$CurrentBlock['deco_type']	= $this->DecorationList[$cbn]['deco_type'];
				$CurrentBlock['fk_deco_id']	= $this->DecorationList[$cbn]['fk_deco_id'];
				
				$cbal = &$BlockAlreadyLoaded[$CurrentBlock['deco_type']][$CurrentBlock['fk_deco_id']];	// Current Block Already Loaded
				if ( !isset( $cbal ) ) {
					$cbal = $BlockT;
					switch ( $CurrentBlock['deco_type'] ) {
						case 20:	
						case "caligraph":	
							$DecoTmpObj = new Deco20_Caligraph();
							$DecoTmpObj->getDeco20_CaligraphDataFromDB($CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockT] = $DecoTmpObj->getDeco20_Caligraph();
							$addBlockFlag = 1;
							
							if ( strlen($DecoTmpObj->getDeco20_CaligraphEntry('txt_font_filename_normal')) > 0 ) {
								if ( $BlockT == "B01T" ) {
									$this->ThemeData['stylesheet_at_fontface'] = "
									@font-face {
										font-family: '".$this->ThemeData['B01T']['txt_font_filename_normal']."'; src: url('../media/theme/".$this->ThemeData['B01T']['repertoire']."/".$this->ThemeData['B01T']['txt_font_family_dl_url']."') format('truetype');
										font-weight: normal;
										font-style: normal;
									}\r\r
									";
								}
								$this->ThemeData[$BlockT]['deco_txt_font_family'] = $this->ThemeData[$BlockT]['txt_font_filename_normal'] . ", " . $this->ThemeData[$BlockT]['txt_font_family'] ; // txt_font_family = fallback
							}
							unset ( $DecoTmpObj );
							break;
						default:
							break;
					}
					$this->colorToHtmlFormat ($this->ThemeData[$BlockT]);
				}
				else {
					$this->ThemeData[$cbal]['duplicateList'] .= $BlockT." ";
					$this->ThemeData[$cbal]['blockList'] .= "B" . $Block." ";
					$this->ThemeData[$BlockT] = &$this->ThemeData[$cbal];
				}
			}
			if ( $addBlockFlag == 1 ) {
				$this->ThemeData['blockTCount']++;
				$this->ThemeData['blockTFirstInLineId'][$this->ThemeData['blockTCount']] = $i;
				$addBlockFlag = 0;
			}
		}
		
		// --------------------------------------------------------------------------------------------
		// Specific to menu decoration type.
		// --------------------------------------------------------------------------------------------
		unset ( $BlockAlreadyLoaded );
		$BlockAlreadyLoaded = array ();

		for($i = 0; $i <= 9; $i ++) {
			$Block = $bts->StringFormatObj->getDecorationBlockName ( "", $i, "" );
			$CurrentBlock['name'] = $this->ThemeData["theme_block_" . $Block . "_menu"];
			if (strlen ( $CurrentBlock['name'] ) > 0) {
				$BlockM = "B" . $Block . "M";
				$cbn = &$CurrentBlock['name'];
				$CurrentBlock['fk_deco_id'] = $this->DecorationList [$cbn]['fk_deco_id'];
				$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Processing menu ".$cbn." with deco_id=".$CurrentBlock['fk_deco_id']));

				$cbal = &$BlockAlreadyLoaded['10'][$CurrentBlock ['fk_deco_id']];
				if (!isset ( $cbal )) {
					$dbquery = $bts->SDDMObj->query ( "
						SELECT *
						FROM " . $CurrentSetObj->getInstanceOfSqlTableListObj()->getSQLTableName ( 'deco_10_menu' ) . "
						WHERE fk_deco_id = '" . $CurrentBlock['fk_deco_id'] . "'
						;" );
					$p = &$this->ThemeData[$BlockM];
					
					while ( $dbp = $bts->SDDMObj->fetch_array_sql ( $dbquery ) ) {
						$p[$dbp['deco_variable_name']] = $dbp['deco_value'];
					}
					
					$p ['level'] = sprintf ( "%01u", $i );
					$cbal = $BlocT = $BlocG = $BlockM;
					

					$CurrentBlock['fk_deco_id'] = $this->DecorationList [$p['text']]['fk_deco_id'];
					$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Processing menu Caligraph deco_id=".$CurrentBlock['fk_deco_id']));

					$p['deco_type'] = $CurrentBlock['deco_type'] = $this->DecorationList [$p['text']]['deco_type'];
					$DecoTmpObj = new Deco20_Caligraph();
					$DecoTmpObj->getDeco20_CaligraphDataFromDB($CurrentBlock['fk_deco_id'] );
					
					$Tab01 = $this->ThemeData[$BlockM];
					$Tab02 = $DecoTmpObj->getDeco20_Caligraph();
					$this->ThemeData[$BlockM] = array_merge($Tab01, $Tab02); 
					unset ($Tab01, $Tab02);
					$addBlockFlag = 1;
					unset($DecoTmpObj);
					
					// --------------------------------------------------------------------------------------------
					$CurrentBlock ['fk_deco_id'] = $this->DecorationList[$p ['graphic']]['fk_deco_id'];
					$p['deco_type'] = $CurrentBlock['deco_type'] = $this->DecorationList [$p ['graphic']] ['deco_type'];
					$bts->LMObj->InternalLog( array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ . " : Processing menu Graphic Type=".$CurrentBlock['deco_type']."; deco_id=".$CurrentBlock['fk_deco_id']));

// 					echo ("<!-- \$p['deco_type']=".$p ['deco_type']."-->\r");
					switch ($CurrentBlock ['deco_type']) {
						case 30 :
						case "1_div" :
							$DecoTmpObj = new Deco30_1Div ();
							$DecoTmpObj->getDeco30_1DivDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockM] = array_merge( $this->ThemeData[$BlockM] , $DecoTmpObj->getDeco30_1Div ());
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							// CDS_traitement_couleurs();
							break;
						case 40 :
						case "elegance" :
							$DecoTmpObj = new Deco40_Elegance ();
							$DecoTmpObj->getDeco40_EleganceDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockM] = array_merge( $this->ThemeData[$BlockM] , $DecoTmpObj->getDeco40_Elegance ());
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
						case 50 :
						case "exquisite" :
							$DecoTmpObj = new Deco50_Exquisite ();
							$DecoTmpObj->getDeco50_ExquisiteDataFromDB ( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockM] = array_merge( $this->ThemeData[$BlockM] , $DecoTmpObj->getDeco50_Exquisite ());
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
						case 60 :
						case "elysion" :
							$DecoTmpObj = new Deco60_Elysion ();
							$DecoTmpObj->getDeco60_ElysionDataFromDB( $CurrentBlock ['fk_deco_id'] );
							$this->ThemeData[$BlockM] = array_merge( $this->ThemeData[$BlockM] , $DecoTmpObj->getDeco60_Elysion ());
							$addBlockFlag = 1;
							unset ( $DecoTmpObj );
							break;
					}
					
					$this->ThemeData['blockMCount']++;
					$this->ThemeData['blockMFirstInLineId'][$this->ThemeData['blockMCount']] = $i;
					$addBlockFlag = 0;
					
					$this->colorToHtmlFormat ($this->ThemeData[$BlockM]);
					
				} else {
					$this->ThemeData[$cbal]['duplicateList'] .= $BlockM . " ";
					$this->ThemeData[$cbal]['blockList'] .= "B" . $Block." ";
					$this->ThemeData[$cbal]['levelList'] .= $i . " ";
					$this->ThemeData[$BlockM] = &$this->ThemeData[$cbal];
				}
				$this->ThemeData[$cbal] ['blockList_menu'] .= $BlockM . " ";
			}
		}
		
		$this->ThemeData['tableStdRules'] = " style='table-layout: auto; border-spacing: 1px; empty-cells: show; vertical-align: top;' ";
		
	}
	
	/**
	 * Decorate a string with the necessary characters for HTML compatibility
	 * @param array $data
	 */
	private function colorToHtmlFormat (&$data) {
		foreach ( $data as $A => &$B ) {
			if ( strpos ( $A , "_col" ) !== FALSE && strpos ( $A , "#" ) === FALSE && strlen($B) != 0 && $B != "transparent" ) { $B = "#" . $B; }
		}
	}
	
	
	//@formatter:off
	public function getThemeDataEntry ($data) { return $this->ThemeData[$data]; }
	public function getThemeBlockEntry($lvl1 , $lvl2) { return $this->ThemeData[$lvl1][$lvl2]; }
	
	public function getThemeName() { return $this->ThemeName; }
	public function getThemeData() { return $this->ThemeData; }
	public function getDecorationList() { return $this->DecorationList; }

	public function setThemeDataEntry ($entry , $data) { $this->ThemeData[$entry] = $data; }
	public function setThemetBlockEntry($lvl1 , $lvl2, $data) { $this->ThemeData[$lvl1][$lvl2] = $data; }

	public function setThemeName($ThemeName) { $this->ThemeName = $ThemeName; }
	public function setThemeData($ThemeData) { $this->ThemeData = $ThemeData; }
	public function setDecorationList($DecorationList) { $this->DecorationList = $DecorationList; }

	//@formatter:on
}

?>
