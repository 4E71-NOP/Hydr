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
class RenderStylesheet {
	private static $Instance = null;

	public function __construct() {}

	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new RenderStylesheet ();
		}
		return self::$Instance;
	}
	
	/**
	 * Render the stylesheet based on the theme data.
	 * @param String $tableName
	 * @param Object $ThemeDataObj
	 * @return string
	 */
	public function render($tableName, $ThemeDataObj){
		$cs = CommonSystem::getInstance();
		$cs->LMObj->InternalLog(array( 'level' => LOGLEVEL_STATEMENT, 'msg' => __METHOD__ ." Start"));
		
		$StringFormat = StringFormat::getInstance();
		
		$themeArray = $ThemeDataObj->getThemeData();
		$themeArray['tableName'] = $tableName;
		$TimeObj = Time::getInstance();
		
		$Content = "
<style type='text/css'>
<!--
/*
//----------------------------------------------------------------------------
// Hydr - Generated stylesheet
//----------------------------------------------------------------------------
// Theme : ".$themeArray['theme_name']."
// Date : ".$TimeObj->timestampToDate(time())."
// fileName : ".$themeArray['theme_name'].".css
//----------------------------------------------------------------------------
*/
";
		$blockIdList = &$themeArray['blockTFirstInLineId'];
		for ( $i = 1 ; $i <= $themeArray['blockTCount'] ; $i++ ) {
			$themeArray['currentBlock']	= $StringFormat->getDecorationBlockName( "B", $blockIdList[$i] , "");
			if ( is_array($themeArray[$themeArray['currentBlock']."T"]) ) {
				$Content .= $this->renderStylesheetDeco20($themeArray);
			}
		}
		
		$blockIdList = &$themeArray['blockGFirstInLineId'];
		for ( $i = 1 ; $i <= $themeArray['blockGCount'] ; $i++ ) {
			$themeArray['currentBlock']	= $StringFormat->getDecorationBlockName( "B", $blockIdList[$i] , "");
			$themeArray['currentBlockType'] = "G";
			if ( is_array($themeArray[$themeArray['currentBlock']."G"]) ) {
				switch ( $themeArray[$themeArray['currentBlock']."G"]['deco_type'] ) {
					case 30:	case "1_div":		$Content .= $this->renderStylesheetDeco30($themeArray);	break;
					case 40:	case "elegance":	$Content .= $this->renderStylesheetDeco40($themeArray);	break;
					case 50:	case "exquise":		$Content .= $this->renderStylesheetDeco50($themeArray);	break;
					case 60:	case "elysion":		$Content .= $this->renderStylesheetDeco60($themeArray);	break;
				}
			}
		}

		// --------------------------------------------------------------------------------
		//
		// Dedicated section for menu (which are an assembly of both text and graphical decoration type)
		//
		//
		$Content .= "\r\r\r";
		$blockIdList = &$themeArray['blockMFirstInLineId'];
		for ( $i = 1 ; $i <= $themeArray['blockMCount'] ; $i++ ) {
			$themeArray['currentBlock']	= $StringFormat->getDecorationBlockName( "B", $blockIdList[$i] , "");
			$themeArray['currentBlockType'] = "M";
			if ( is_array($themeArray[$themeArray['currentBlock']."M"]) ) {
				$p = &$themeArray[$themeArray['currentBlock']."M"];
				
				$css_menu_div = ".".$tableName."menu_lvl_".$p['niveau'].", ";
				$css_menu_lnn = ".".$tableName."menu_lvl_".$p['niveau']."_link, ";
				$css_menu_lnh = ".".$tableName."menu_lvl_".$p['niveau']."_link:hover, ";
				$css_menu_lna = ".".$tableName."menu_lvl_".$p['niveau']."_link:active, ";
				$css_menu_lnv = ".".$tableName."menu_lvl_".$p['niveau']."_link:visited, ";
				if ( isset ( $p['liste_niveaux'] ) ) {
					$css_menu_div .= $this->makeCssLevelString ($themeArray, $themeArray['currentBlock']."M", ".".$tableName."menu_lvl_", "" );
					$css_menu_lnn .= $this->makeCssLevelString ($themeArray, $themeArray['currentBlock']."M", ".".$tableName."menu_lvl_", "_link" );
					$css_menu_lnh .= $this->makeCssLevelString ($themeArray, $themeArray['currentBlock']."M", ".".$tableName."menu_lvl_", "_link:hover" );
					$css_menu_lna .= $this->makeCssLevelString ($themeArray, $themeArray['currentBlock']."M", ".".$tableName."menu_lvl_", "_link:active" );
					$css_menu_lnv .= $this->makeCssLevelString ($themeArray, $themeArray['currentBlock']."M", ".".$tableName."menu_lvl_", "_link:visited" );
				}
				$css_menu_div = substr ( $css_menu_div , 0 , -2 ) . " ";
				$css_menu_lnn = substr ( $css_menu_lnn , 0 , -2 ) . " ";
				$css_menu_lnh = substr ( $css_menu_lnh , 0 , -2 ) . " ";
				$css_menu_lna = substr ( $css_menu_lna , 0 , -2 ) . " ";
				$css_menu_lnv = substr ( $css_menu_lnv , 0 , -2 ) . " ";
				
				$Content .= $css_menu_div . " { position: absolute; margin: 0px; padding: 0px ; border: 0px; }\r";
				$Content .= $css_menu_lnn . " { ";
				$maybeMoreContent = "";
				if ( strlen($p['txt_font']) > 0 )				{ $Content .= "font-family:".		$p['txt_font']			.";	"; }
				if ( strlen($p['a_fg_col']) > 0 )				{ $Content .= "color:".				$p['a_fg_col']			.";	"; }
				if ( strlen($p['a_bg_col']) > 0 )				{ $Content .= "background-color:".	$p['a_bg_col']			.";	"; }
				if ( strlen($p['a_decoration']) > 0 )			{ $Content .= "text-decoration:".	$p['a_decoration']		.";	"; }
				if ( strlen($p['a_special']) > 0 )				{ $Content .= 						$p['a_special']; }
				$Content .= "}\r";
				
				$maybeMoreContent = "";
				if ( strlen($p['a_hover_fg_col']) > 0 )			{ $maybeMoreContent .= "color:".			$p['a_hover_fg_col']		.";	"; }
				if ( strlen($p['a_hover_bg_col']) > 0 )			{ $maybeMoreContent .= "background-color: ".$p['a_hover_bg_col']		.";	"; }
				if ( strlen($p['a_hover_decoration']) > 0 )		{ $maybeMoreContent .= "text-decoration:".	$p['a_hover_decoration']	.";	"; }
				if ( strlen($p['a_hover_special']) > 0 )		{ $maybeMoreContent .=						$p['a_hover_special']; }
				if ( strlen( $maybeMoreContent ) > 0 )			{ $Content .= $css_menu_lnh ." { ".$maybeMoreContent." }\r"; }
				
				$maybeMoreContent = "";
				if ( strlen($p['a_active_fg_col']) > 0 )		{ $maybeMoreContent .= "color:".			$p['a_active_fg_col']		.";	"; }
				if ( strlen($p['a_active_bg_col']) > 0 )		{ $maybeMoreContent .= "background-color:".	$p['a_active_bg_col']		.";	"; }
				if ( strlen($p['a_active_decoration']) > 0 )	{ $maybeMoreContent .= "text-decoration:".	$p['a_active_decoration']	.";	"; }
				if ( strlen($p['a_active_special']) > 0 )		{ $maybeMoreContent .= 						$p['a_active_special']; }
				if ( strlen( $maybeMoreContent ) > 0 )			{ $Content .= $css_menu_lna ." { ".$maybeMoreContent." }\r"; }
				
				$maybeMoreContent = "";
				if ( strlen($p['a_visited_fg_col']) > 0 )		{ $maybeMoreContent .= "color:".			$p['a_visited_fg_col']		.";	"; }
				if ( strlen($p['a_visited_bg_col']) > 0 )		{ $maybeMoreContent .= "background-color:".	$p['a_visited_bg_col']		.";	"; }
				if ( strlen($p['a_visited_decoration']) > 0 )	{ $maybeMoreContent .= "text-decoration:".	$p['a_visited_decoration']	.";	"; }
				if ( strlen($p['a_visited_special']) > 0 )		{ $maybeMoreContent .= 						$p['a_visited_special']; }
				if ( strlen( $maybeMoreContent ) > 0 )			{ $Content .= $css_menu_lnv ." { ".$maybeMoreContent." }\r"; }
				
				switch ( $themeArray[$themeArray['currentBlock']."M"]['deco_type'] ) {
					case 30:	case "1_div":		$Content .= $this->renderStylesheetDeco30($themeArray);	break;
					case 40:	case "elegance":	$Content .= $this->renderStylesheetDeco40($themeArray);	break;
					case 50:	case "exquise":		$Content .= $this->renderStylesheetDeco50($themeArray);	break;
					case 60:	case "elysion":		$Content .= $this->renderStylesheetDeco60($themeArray);	break;
				}
				$Content .= "\r\r";
				
			}
		}
		
		// --------------------------------------------------------------------------------
		$Content .= "
	.centered { text-align: center; }\r
	
	.".$tableName."bareTable	{ border-spacing:0px; border-collapse:collapse; border-width:0px; border-style:none; margin:0px; padding:0px; }\r
	.".$tableName."bareTable tr	{ background-color:transparent;  margin:0px; padding:0px; }\r
	.".$tableName."bareTable tr:hover	{ background-color:transparent; }\r
	.".$tableName."bareTable td	{  margin:0px; padding:0px; }\r
	.".$tableName."bareTable td:hover	{ background-color:transparent; }\r
	
	.".$tableName."modif_article	{ height:512px ; overflow:auto }\r
	.".$tableName."modif_category	{ height:512px ; overflow:auto }\r

	.".$tableName.CLASS_ADM_Ctrl_Switch." {	
		width: ". $themeArray['theme_admctrl_size_x'] ."px; 
		height: ". $themeArray['theme_admctrl_size_y'] ."px; 
		background-image: url(../gfx/".$themeArray['theme_directory']."/". $themeArray['theme_admctrl_switch_bg'] ."); 
		left: 0px;
		top: 0px;
		display: block;
		visibility: visible;
		background-position: center;
		background-repeat: repeat;
		position: fixed;
	}\r

	.".$tableName.CLASS_ADM_Ctrl_Panel." {
		position: absolute; 
		top: ". floor( $themeArray['theme_admctrl_size_y']/ 2 )."px; 
		left: ".floor( $themeArray['theme_admctrl_size_x']/ 2 )."px; 
		border-style: solid; 
		border-width: 8px; 
		border-color: ".$themeArray['B01T']['txt_warning_col']."; 
		margin : 0px;
		padding : 0px;
		background-image: url(../gfx/".$themeArray['theme_directory']."/".$themeArray['theme_admctrl_panel_bg'].");
		visibility: hidden; 
	}

	.".$tableName.CLASS_File_Selector_Container." {
		position: absolute; 
		border-style: solid; 
		border-width: 0px; 
		border-color: #000000; 
		margin : 0mm;
		padding : 0mm;
		background-image: url(../gfx/universal/noir_50prct.png);
		visibility: hidden; display : none;
	}
	.".$tableName.CLASS_File_Selector." {
		position: absolute; 
		border-style: solid; 
		border-width: 2.5mm; 
		border-color: ".$themeArray['B01T']['txt_warning_col']."; 
		margin : 0mm;
		padding : 0.5mm;".
		((strlen($themeArray['B01T']['txt_font'])>0) ? "font-family:".$themeArray['B01T']['txt_font'].";":"").
		((strlen($themeArray['B01T']['txt_font_size'])>0) ? "font-size:".$themeArray['B01T']['txt_font_size'].";":"").
		((strlen($themeArray['B01T']['txt_col'])>0) ? "color:".$themeArray['B01T']['txt_col'].";":"").
		((strlen($themeArray['B01T']['tab_frame_bg_img'])>0) ? "background-image: url(../gfx/".$themeArray['theme_directory']."/".$themeArray['B01T']['tab_frame_bg_img'].");":"").
		((strlen($themeArray['B01T']['tab_frame_bg_col'])>0) ? "background-color: ".$themeArray['B01T']['tab_frame_bg_col'].";":"")."
		visibility: hidden; display : none; 
		cursor: pointer;
	}

	.div_std {
	font-family: ".$themeArray['B01T']['txt_font'].";
	font-weight: normal;
	line-height: normal;
	color: ".$themeArray['B01T']['txt_col'].";
	text-align: left;
	letter-spacing : 0px;
	word-spacing : 0px;
	overflow: auto;
	}\r

	\r	/* Media screen */


@media print { BODY { font-size: 10pt; } }\r\r-->\r</style>\r";
		return $Content;
		
	}
	
	
	private function renderStylesheetDeco20 (&$infos) {
		$p = &$infos[$infos['currentBlock']."T"];

		// https://www.w3.org/Style/Examples/007/units.fr.html
		// The choice is made as 'everything' is bound to a main unit (mostly mm).
		// Font are the exeption as it can be tricky sometimes depending on browsers.
		$mainUnit = $p['main_unit'];
		$fontUnit = $p['txt_font_unit'];
		
		$Content = "";
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_ft",					" { border-spacing: 0px; border: 0px;	empty-cells: show; vertical-align: middle; } \r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_ft1",				" { padding: 0px;	border: 0px;	width: ".$p['ft1_width']."px;	height: ".$p['ft_height']."px;	".((strlen($p['ft1_bg'] )>0)? "background-image: url(../gfx/".$infos['theme_directory']."/".$p['ft1_bg'].");" :"")."	".$p['ft2_special']. " } \r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_ft2",				" { padding: 0px;	border: 0px;									height: ".$p['ft_height']."px;	".((strlen($p['ft1_bg'] )>0)? "background-image: url(../gfx/".$infos['theme_directory']."/".$p['ft2_bg'].");" :"")."	".$p['ft2_special']. " 	color: ".$p['ft2_fg_col']."; font-size:".$p['ft2_font_size'].$fontUnit."; } \r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_ft3",				" { padding: 0px;	border: 0px;	width: ".$p['ft3_width']."px;	height: ".$p['ft_height']."px;	".((strlen($p['ft1_bg'] )>0)? "background-image: url(../gfx/".$infos['theme_directory']."/".$p['ft3_bg'].");" :"")."	".$p['ft2_special']. " } \r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_n01",		" { width: ".$p['s1_01_width']."px;	height: ".$p['s1_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_n01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_n02",		" { 								height: ".$p['s1_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_n02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_col'].	";		font-weight:".$p['s1_txt_weight'].";		".$p['s1_txt_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_n03",		" { width: ".$p['s1_03_width']."px;	height: ".$p['s1_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_n03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_h01",		" { width: ".$p['s1_01_width']."px;	height: ".$p['s1_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_h01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_hover_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_h02",		" { 								height: ".$p['s1_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_h02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_hover_col'].";	font-weight:".$p['s1_txt_hover_weight'].";	".$p['s1_txt_hover_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s1_h03",		" { width: ".$p['s1_03_width']."px;	height: ".$p['s1_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s1_h03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s1_txt_hover_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_n01",		" { width: ".$p['s2_01_width']."px;	height: ".$p['s2_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_n01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_n02",		" { 								height: ".$p['s2_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_n02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_col'].";		font-weight:".$p['s2_txt_weight'].";		".$p['s2_txt_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_n03",		" { width: ".$p['s2_03_width']."px;	height: ".$p['s2_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_n03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_h01",		" { width: ".$p['s2_01_width']."px;	height: ".$p['s2_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_h01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_hover_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_h02",		" { 								height: ".$p['s2_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_h02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_hover_col'].";	font-weight:".$p['s2_txt_hover_weight'].";	".$p['s2_txt_hover_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s2_h03",		" { width: ".$p['s2_03_width']."px;	height: ".$p['s2_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s2_h03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s2_txt_hover_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_n01",		" { width: ".$p['s3_01_width']."px;	height: ".$p['s3_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_n01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_n02",		" { 								height: ".$p['s3_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_n02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_col'].";		font-weight:".$p['s3_txt_weight'].";		".$p['s3_txt_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_n03",		" { width: ".$p['s3_03_width']."px;	height: ".$p['s3_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_n03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_h01",		" { width: ".$p['s3_01_width']."px;	height: ".$p['s3_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_h01'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_hover_col'].";}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_h02",		" { 								height: ".$p['s3_01_height']."px; background: transparent;		background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_h02'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_hover_col'].";	font-weight:".$p['s3_txt_hover_weight'].";	".$p['s3_txt_hover_special'].";	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_submit_s3_h03",		" { width: ".$p['s3_03_width']."px;	height: ".$p['s3_01_height']."px; 								background-image: url(../gfx/".$infos['theme_directory']."/".$p['s3_h03'].");	border-width : 0px; 	padding: 0px;	border-style: none;	color: ".$p['s3_txt_hover_col'].";}\r\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_down_a",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_down_a'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_a_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_down_txt_col'].";																										background-color: ".$p['tab_down_txt_bg_col']."; }\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_down_b",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_down_b'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;									height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : repeat-x;	overflow:hidden;	text-align: center;	color: ".$p['tab_down_txt_col'].";	".((strlen($p['tab_down_txt_weight'])>0) ? "font-weight:".$p['tab_down_txt_weight'].";":"")."		background-color: ".$p['tab_down_txt_bg_col'].";	".$p['tab_down_txt_special']."	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_down_c",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_down_c'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_c_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_down_txt_col'].";																										background-color: ".$p['tab_down_txt_bg_col']."; }\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_up_a",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_up_a'].");		padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_a_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_up_txt_col'].";																										background-color: ".$p['tab_up_txt_bg_col']."; }\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_up_b",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_up_b'].");		padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;									height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : repeat-x;	overflow:hidden;	text-align: center;	color: ".$p['tab_up_txt_col'].";	".((strlen($p['tab_up_txt_weight'])>0) ? "font-weight:".$p['tab_up_txt_weight'].";":"")."			background-color: ".$p['tab_up_txt_bg_col'].";		".$p['tab_up_txt_special']."	}\r" );
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_up_c",			" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_up_c'].");		padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_c_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_up_txt_col'].";																										background-color: ".$p['tab_up_txt_bg_col']."; }\r" );
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_hover_a",		" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_hover_a'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_a_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_hover_txt_col'].";																										background-color: ".$p['tab_hover_txt_bg_col']."; }\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_hover_b",		" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_hover_b'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;									height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : repeat-x;	overflow:hidden;	text-align: center;	color: ".$p['tab_hover_txt_col'].";	".((strlen($p['tab_hover_txt_weight'])>0) ? "font-weight:".$p['tab_hover_txt_weight'].";":"")."		background-color: ".$p['tab_hover_txt_bg_col'].";	".$p['tab_hover_txt_special']."	}\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tab_hover_c",		" { background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_hover_c'].");	padding-top: 0px;	padding-left: 0px;	vertical-align: bottom;	width: ".$p['tab_c_width']."px;	height: ".$p['tab_height']."px;	background-position: top left;	background-repeat : no-repeat;	overflow:hidden;	text-align: center;	color: ".$p['tab_hover_txt_col'].";																										background-color: ".$p['tab_hover_txt_bg_col']."; }\r");
		$Content .= $this->makeCssIdString ($infos, ".",		$infos['currentBlock'], "T", "_tabFrame",			" { padding: 5px ; vertical-align: top; ".((strlen($p['tab_frame_bg_img'])>0) ? "background-image: url(../gfx/".$infos['theme_directory']."/".$p['tab_frame_bg_img'].");" : "")."  ".((strlen($p['tab_frame_bg_col'])>0) ? "background-color: ".$p['tab_frame_bg_col'].";":"")." }\r\r");
		
		
		
		// New stylsheet
		
		// Main module class
		$list= array( "font",	"font_size",	"col");
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"",			"{".$str."}");}

		$list= array( "ok_col",	);
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"_ok",				"",			"{".$str."}");}
		$list= array( "warning_col",	);
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"_warning",				"",			"{".$str."}");}
		$list= array( "error_col",	);
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"_error",				"",			"{".$str."}");}
		$list= array( "fade_col",	);
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"_fade",				"",			"{".$str."}");}
		$list= array( "highlight_col",	);
		$str = $this->testAndRenderCssStyle("txt", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"_highlight",				"",			"{".$str."}");}
		
		// P
		$list= array( "txt_indent",	"txt_align",	"font",	"fg_col",	"bg_col",	"mrg_top",	"mrg_bottom",	"mrg_left",	"mrg_right",	"pad_top",	"pad_bottom",	"pad_left",	"pad_right" );
		$str = $this->testAndRenderCssStyle("p", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"p",			"{".$str."}");}
		// a
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("a", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"a",			"{".$str."}");}
		// a:visited
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("a_visited", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"a:visited",	"{".$str."}");}
		// a:hover
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("a_hover", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"a:hover",		"{".$str."}");}
		// a:active
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("a_active", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"a:active",		"{".$str." color: inherit;}");}
		
		//form
		$list= array( "fg_col",	"bg_col",	"special");
		$str = $this->testAndRenderCssStyle("input", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"input[type=text]",	"{".$str."}");}
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"select",	"{".$str."}");}
		
		// code
		$list= array( "font",	"fg_col",	"bg_col",	"mrg_top",	"mrg_bottom",	"mrg_left",	"mrg_right",	"pad_top",	"pad_bottom",	"pad_left",	"pad_right", "special" ); 
		$str = $this->testAndRenderCssStyle("code", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	"",				"code",			"{".$str."}");}
		
		
		// Table with no background. Usually used to align elements like images.
		$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TableStd,		"",				"{ border-spacing:0px; width:100%; margin-left:0px; margin-right:auto;}");
		$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TableStd,		"td",			"{ text-align:center; background-color:transparent;}");
		
		// Table01
		if ( strlen($p['table_rules'])			> 0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"",				"{ ".$p['table_rules']." }"); }
		$valTest = 0;
		$sv = array();
		if ( strlen( $p['t01_caption_bg_col'])	> 0 )	{ $valTest++; $sv['a'] = "background-color:".$p['t01_caption_bg_col'].";";}
		if ( strlen( $p['t01_caption_fg_col'])	> 0 )	{ $valTest++; $sv['b'] = "color: ".$p['t01_caption_fg_col'].";";}
		if ( strlen( $p['t01_caption_special'])	> 0 )	{ $valTest++; $sv['c'] = $p['t01_caption_special'];}
		if ( $valTest > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"caption",				"{".$sv['a']." ".$sv['b']." ".$sv['c']."}");}
		
		// TR
		$valTest = 0;
		$sv = array();
		if ( strlen( $p['t01_tr_bg_col'])	> 0 )	{ $valTest++; $sv['a'] = "background-color:".$p['t01_tr_bg_col'].";";}
		if ( strlen( $p['t01_txt_col'])		> 0 )	{ $valTest++; $sv['b'] = "color:".$p['t01_txt_col']."; "; }
		if ( strlen( $p['t01_tr_special'])	> 0 )	{ $valTest++; $sv['c'] = $p['t01_tr_special'].";";}
		if ( $valTest > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"tr",	"{ ".$sv['a']." ".$sv['b']." ".$sv['c']."}"); }
		
		// TR specific
		if ( strlen( $p['t01_tr_bg_odd_col'])	>0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"tr:nth-child(2n+1)",	"{ background-color:".$p['t01_tr_bg_odd_col'].";	}");	}
		if ( strlen( $p['t01_tr_bg_even_col'])	>0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"tr:nth-child(2n)",		"{ background-color:".$p['t01_tr_bg_even_col'].";	}");	}
		if ( strlen( $p['t01_tr_bg_hover_col'])	>0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"tr:hover",				"{ background-color:".$p['t01_tr_bg_hover_col'].";	}");	}
		if ( strlen( $p['t01_td_bg_odd_col'])	>0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"td:nth-child(2n+1)",	"{ background-color:".$p['t01_td_bg_odd_col'].";	}"); 	}
		if ( strlen( $p['t01_td_bg_even_col'])	>0 )	{ $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,		"td:nth-child(2n)",		"{ background-color:".$p['t01_td_bg_even_col'].";	}");	}
		
		// td a
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("td_a", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"a",			"{".$str."}");}
		// td a:hover
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("td_a_hover", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"a:hover",		"{".$str."}");}
		// td a:active
		$list= array( "font",	"fg_col",	"bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("td_a_active", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"a:active",		"{".$str."}");}
		// td a:visited
		$list= array( "font",	"fg_col",	"td_bg_col",	"decoration",	"special");
		$str = $this->testAndRenderCssStyle("a_visited", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"a:visited",	"{".$str."}");}
		//td form
		$list= array( "fg_col",	"bg_col",	"special");
		$str = $this->testAndRenderCssStyle("td_input", $list, $p);
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"input[type=text]",	"{".$str."}");}
		if ( strlen($str) > 0 ) { $Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_Table01,				"select",			"{".$str."}");}
		
		// Table01 legend 
		$list= array( "fg_col",	"bg_col",	"special");
		$str = $this->testAndRenderCssStyle("t01_legend", $list, $p);
		if ( strlen($str) > 0 ) { 
			$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TblLgnd_Top,			"tr:first-child",	"{".$str."}");
			$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TblLgnd_Bottom,		"tr:last-child",	"{".$str."}");
			$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TblLgnd_Left,			"td:first-child",	"{".$str."}");
			$Content .= $this->makeCssSelectorList ($infos, $infos['currentBlock'],	"T",	CLASS_TblLgnd_Right,		"td:last-child",	"{".$str."}");
		}
		
		// Add title lines (first/last line +  first/last column)
		
		
		return "\r".$Content;
	}
	
	
	
	private function renderStylesheetDeco30 (&$infos) {
		return $Content;
	}
	
	private function renderStylesheetDeco40 (&$infos) {
		$type = $infos['currentBlockType'];
		$p = &$infos[$infos['currentBlock'].$type];
		$Content = "";
		$dir = $infos['theme_directory'];
		if ( strlen($p['repertoire']) != 0 ) { $dir = $p['repertoire']; }
		if ( $p['a_line_height'] > 0 ) { $supLH = "; line-height: ". $p['a_line_height']."px;"; }
	
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex11", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex11'].");	background-position:".str_replace('-', ' ', $p['ex11_bgp']).";	vertical-align: bottom;	width: ".$p['ex11_x']."px;	height: ".$p['ex11_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex12", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex12'].");	background-position:".str_replace('-', ' ', $p['ex12_bgp']).";	vertical-align: bottom;	width: ".$p['ex12_x']."px;	height: ".$p['ex12_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex13", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex13'].");	background-position:".str_replace('-', ' ', $p['ex13_bgp']).";	vertical-align: bottom;								height: ".$p['ex13_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex21", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex21'].");	background-position:".str_replace('-', ' ', $p['ex21_bgp']).";	vertical-align: bottom;	width: ".$p['ex21_x']."px;	height: ".$p['ex21_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex22", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex22'].");	background-position:".str_replace('-', ' ', $p['ex22_bgp']).";	vertical-align: bottom;	width: ".$p['ex22_x']."px;									background-repeat : repeat;		overflow:hidden".$supLH."}\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex23", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex23'].");	background-position:".str_replace('-', ' ', $p['ex23_bgp']).";	vertical-align: bottom;	width: ".$p['ex23_x']."px;	height: ".$p['ex23_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex31", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex31'].");	background-position:".str_replace('-', ' ', $p['ex31_bgp']).";	vertical-align: bottom;	width: ".$p['ex31_x']."px;	height: ".$p['ex31_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex32", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex32'].");	background-position:".str_replace('-', ' ', $p['ex32_bgp']).";	vertical-align: bottom;	width: ".$p['ex32_x']."px;	height: ".$p['ex32_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex33", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex33'].");	background-position:".str_replace('-', ' ', $p['ex33_bgp']).";	vertical-align: bottom;	width: ".$p['ex33_x']."px;	height: ".$p['ex33_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		return "\r".$Content;
	}
	
	private function renderStylesheetDeco50 (&$infos) {
		$type = $infos['currentBlockType'];
		$p = &$infos[$infos['currentBlock'].$type];
		$Content = "";
		$dir = $infos['theme_directory'];
		if ( strlen($p['repertoire']) != 0 ) { $dir = $p['repertoire']; }
		if ( $p['a_line_height'] > 0 ) { $supLH = "; line-height: ". $p['a_line_height']."px;"; }
		
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex11", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex11'].");	background-position:".str_replace('-', ' ', $p['ex11_bgp']).";	vertical-align: bottom;	width: ".$p['ex11_x']."px;	height: ".$p['ex11_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex12", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex12'].");	background-position:".str_replace('-', ' ', $p['ex12_bgp']).";	vertical-align: bottom;	width: ".$p['ex12_x']."px;	height: ".$p['ex12_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex13", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex13'].");	background-position:".str_replace('-', ' ', $p['ex13_bgp']).";	vertical-align: bottom;								height: ".$p['ex13_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex14", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex14'].");	background-position:".str_replace('-', ' ', $p['ex14_bgp']).";	vertical-align: bottom;	width: ".$p['ex14_x']."px;	height: ".$p['ex14_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex15", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex15'].");	background-position:".str_replace('-', ' ', $p['ex15_bgp']).";	vertical-align: bottom;	width: ".$p['ex15_x']."px;	height: ".$p['ex15_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex21", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex21'].");	background-position:".str_replace('-', ' ', $p['ex21_bgp']).";	vertical-align: bottom;	width: ".$p['ex21_x']."px;	height: ".$p['ex21_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex22", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex22'].");	background-position:".str_replace('-', ' ', $p['ex22_bgp']).";	vertical-align: bottom;	width: ".$p['ex22_x']."px;									background-repeat : repeat;		overflow:hidden".$supLH."}\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex25", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex25'].");	background-position:".str_replace('-', ' ', $p['ex25_bgp']).";	vertical-align: bottom;	width: ".$p['ex25_x']."px;	height: ".$p['ex25_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex31", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex31'].");	background-position:".str_replace('-', ' ', $p['ex31_bgp']).";	vertical-align: bottom;	width: ".$p['ex31_x']."px;	height: ".$p['ex31_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex35", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex35'].");	background-position:".str_replace('-', ' ', $p['ex35_bgp']).";	vertical-align: bottom;	width: ".$p['ex35_x']."px;	height: ".$p['ex35_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex41", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex41'].");	background-position:".str_replace('-', ' ', $p['ex41_bgp']).";	vertical-align: bottom;	width: ".$p['ex41_x']."px;	height: ".$p['ex41_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex45", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex45'].");	background-position:".str_replace('-', ' ', $p['ex45_bgp']).";	vertical-align: bottom;	width: ".$p['ex45_x']."px;	height: ".$p['ex45_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex51", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex51'].");	background-position:".str_replace('-', ' ', $p['ex51_bgp']).";	vertical-align: bottom;	width: ".$p['ex51_x']."px;	height: ".$p['ex51_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex52", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex52'].");	background-position:".str_replace('-', ' ', $p['ex52_bgp']).";	vertical-align: bottom;	width: ".$p['ex52_x']."px;	height: ".$p['ex52_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex53", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex53'].");	background-position:".str_replace('-', ' ', $p['ex53_bgp']).";	vertical-align: bottom;								height: ".$p['ex53_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex54", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex54'].");	background-position:".str_replace('-', ' ', $p['ex54_bgp']).";	vertical-align: bottom;	width: ".$p['ex54_x']."px;	height: ".$p['ex54_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex55", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex55'].");	background-position:".str_replace('-', ' ', $p['ex55_bgp']).";	vertical-align: bottom;	width: ".$p['ex55_x']."px;	height: ".$p['ex55_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		return "\r".$Content;
	}
	
	private function renderStylesheetDeco60 (&$infos) {
		$type = $infos['currentBlockType'];
		$p = &$infos[$infos['currentBlock'].$type];
		$Content = "";
		$dir = $infos['theme_directory'];
		if ( strlen($p['repertoire']) != 0 ) { $dir = $p['repertoire']; }
		if ( $p['a_line_height'] > 0 ) { $supLH = "; line-height: ". $p['a_line_height']."px;"; }
		
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex11", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex11'].");	background-position:".str_replace('-', ' ', $p['ex11_bgp']).";	vertical-align: bottom;	width: ".$p['ex11_x']."px;	height: ".$p['ex11_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex12", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex12'].");	background-position:".str_replace('-', ' ', $p['ex12_bgp']).";	vertical-align: bottom;	width: ".$p['ex12_x']."px;	height: ".$p['ex12_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex13", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex13'].");	background-position:".str_replace('-', ' ', $p['ex13_bgp']).";	vertical-align: bottom;								height: ".$p['ex13_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex14", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex14'].");	background-position:".str_replace('-', ' ', $p['ex14_bgp']).";	vertical-align: bottom;	width: ".$p['ex14_x']."px;	height: ".$p['ex14_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex15", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex15'].");	background-position:".str_replace('-', ' ', $p['ex15_bgp']).";	vertical-align: bottom;	width: ".$p['ex15_x']."px;	height: ".$p['ex15_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex21", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex21'].");	background-position:".str_replace('-', ' ', $p['ex21_bgp']).";	vertical-align: bottom;	width: ".$p['ex21_x']."px;	height: ".$p['ex21_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex22", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex22'].");	background-position:".str_replace('-', ' ', $p['ex22_bgp']).";	vertical-align: bottom;	width: ".$p['ex22_x']."px;									background-repeat : repeat;		overflow:hidden".$supLH."}\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex25", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex25'].");	background-position:".str_replace('-', ' ', $p['ex25_bgp']).";	vertical-align: bottom;	width: ".$p['ex25_x']."px;	height: ".$p['ex25_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex31", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex31'].");	background-position:".str_replace('-', ' ', $p['ex31_bgp']).";	vertical-align: bottom;	width: ".$p['ex31_x']."px;	height: ".$p['ex31_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex35", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex35'].");	background-position:".str_replace('-', ' ', $p['ex35_bgp']).";	vertical-align: bottom;	width: ".$p['ex35_x']."px;	height: ".$p['ex35_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex41", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex41'].");	background-position:".str_replace('-', ' ', $p['ex41_bgp']).";	vertical-align: bottom;	width: ".$p['ex41_x']."px;	height: ".$p['ex41_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex45", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex45'].");	background-position:".str_replace('-', ' ', $p['ex45_bgp']).";	vertical-align: bottom;	width: ".$p['ex45_x']."px;	height: ".$p['ex45_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex51", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex51'].");	background-position:".str_replace('-', ' ', $p['ex51_bgp']).";	vertical-align: bottom;	width: ".$p['ex51_x']."px;	height: ".$p['ex51_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex52", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex52'].");	background-position:".str_replace('-', ' ', $p['ex52_bgp']).";	vertical-align: bottom;	width: ".$p['ex52_x']."px;	height: ".$p['ex52_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex53", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex53'].");	background-position:".str_replace('-', ' ', $p['ex53_bgp']).";	vertical-align: bottom;								height: ".$p['ex53_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex54", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex54'].");	background-position:".str_replace('-', ' ', $p['ex54_bgp']).";	vertical-align: bottom;	width: ".$p['ex54_x']."px;	height: ".$p['ex54_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_ex55", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['ex55'].");	background-position:".str_replace('-', ' ', $p['ex55_bgp']).";	vertical-align: bottom;	width: ".$p['ex55_x']."px;	height: ".$p['ex55_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");

		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in11", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in11'].");	background-position:".str_replace('-', ' ', $p['in11_bgp']).";	vertical-align: bottom;	width: ".$p['in11_x']."px;	height: ".$p['in11_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in12", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in12'].");	background-position:".str_replace('-', ' ', $p['in12_bgp']).";	vertical-align: bottom;	width: ".$p['in12_x']."px;	height: ".$p['in12_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in13", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in13'].");	background-position:".str_replace('-', ' ', $p['in13_bgp']).";	vertical-align: bottom;	width: ".$p['in13_x']."px;	height: ".$p['in13_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in14", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in14'].");	background-position:".str_replace('-', ' ', $p['in14_bgp']).";	vertical-align: bottom;	width: ".$p['in14_x']."px;	height: ".$p['in14_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in15", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in15'].");	background-position:".str_replace('-', ' ', $p['in15_bgp']).";	vertical-align: bottom;	width: ".$p['in15_x']."px;	height: ".$p['in15_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in21", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in21'].");	background-position:".str_replace('-', ' ', $p['in21_bgp']).";	vertical-align: bottom;	width: ".$p['in21_x']."px;	height: ".$p['in21_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in25", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in25'].");	background-position:".str_replace('-', ' ', $p['in25_bgp']).";	vertical-align: bottom;	width: ".$p['in25_x']."px;	height: ".$p['in25_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in31", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in31'].");	background-position:".str_replace('-', ' ', $p['in31_bgp']).";	vertical-align: bottom;	width: ".$p['in31_x']."px;	height: ".$p['in31_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in35", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in35'].");	background-position:".str_replace('-', ' ', $p['in35_bgp']).";	vertical-align: bottom;	width: ".$p['in35_x']."px;	height: ".$p['in35_y']."px;		background-repeat : repeat-y;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in41", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in41'].");	background-position:".str_replace('-', ' ', $p['in41_bgp']).";	vertical-align: bottom;	width: ".$p['in41_x']."px;	height: ".$p['in41_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in45", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in45'].");	background-position:".str_replace('-', ' ', $p['in45_bgp']).";	vertical-align: bottom;	width: ".$p['in45_x']."px;	height: ".$p['in45_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in51", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in51'].");	background-position:".str_replace('-', ' ', $p['in51_bgp']).";	vertical-align: bottom;	width: ".$p['in51_x']."px;	height: ".$p['in51_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in52", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in52'].");	background-position:".str_replace('-', ' ', $p['in52_bgp']).";	vertical-align: bottom;	width: ".$p['in52_x']."px;	height: ".$p['in52_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in53", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in53'].");	background-position:".str_replace('-', ' ', $p['in53_bgp']).";	vertical-align: bottom;	width: ".$p['in53_x']."px;	height: ".$p['in53_y']."px;		background-repeat : repeat-x;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in54", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in54'].");	background-position:".str_replace('-', ' ', $p['in54_bgp']).";	vertical-align: bottom;	width: ".$p['in54_x']."px;	height: ".$p['in54_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		$Content .= $this->makeCssIdString ($infos, ".", $infos['currentBlock'], $type, "_in55", " { position: absolute; background-image: url(../gfx/".$dir."/".$p['in55'].");	background-position:".str_replace('-', ' ', $p['in55_bgp']).";	vertical-align: bottom;	width: ".$p['in55_x']."px;	height: ".$p['in55_y']."px;		background-repeat : no-repeat;	overflow:hidden }\r");
		return "\r".$Content;
	}
	
	private function makeCssIdString (&$infos, $prefix, $block, $type, $suffix, $css) {
		$p = explode( " ", trim($block." ".$infos[$block.$type]['liste_bloc']) ); // trim removes the last space in the string
		$str = "";
		if ($type != "M") { $type = "";}
		foreach ($p as $A) { $str .= $prefix.$infos['tableName'].$A.$type.$suffix.", ";}
		$str = substr ( $str , 0 , -2 )." ".$css;
		return $str;
	}

	private function makeCssLevelString(&$infos, $block, $prefix, $suffix) {
		$p = explode( " ", trim($infos[$block]['liste_niveaux']) ); // trim removes the last space in the string
		$str = "";
		foreach ($p as $A) { $str .= $prefix.$A.$suffix.", "; }
		return $str;
		
	}
	
	private function makeCssSelectorList (&$infos, $block, $type, $id, $item, $css ) {
		$p = explode( " ", trim($block." ".$infos[$block.$type]['liste_bloc']) ); // trim removes the last space in the string
		$str = "";
		foreach ($p as $A) { $str .= ".".$infos['tableName'].$A.$id." ".$item.", ";}
		$str = substr ( $str , 0 , -2 )." ".$css."\r";
		return $str;
	}
	
	private function testAndRenderCssStyle ( $elm, $infos, &$p) {
		$str = "";
		$tab = array(
				"bg_col"		=>	"background-color",
				"col"			=>	"color",
				"decoration"	=>	"text-decoration",
				"error_col"		=>	"color",
				"fade_col"		=>	"color",
				"font"			=>	"font-family",
				"fonte"			=>	"font-family",
				"font_size"		=>	"font-size",
				"fg_col"		=>	"color",
				"highlight_col" =>	"color",
				"mrg_top"		=>	"margin-top",
				"mrg_bottom"	=>	"margin-bottom",
				"mrg_left"		=>	"margin-left",
				"mrg_right"		=>	"margin-right",
				"pad_top"		=>	"padding-top",
				"pad_bottom"	=>	"padding-bottom",
				"pad_left"		=>	"padding-left",
				"pad_right"		=>	"padding-right",
				"ok_col"		=>	"color",
				"special"		=>	"",
				"txt_align"		=>	"text-align",
				"txt_indent"	=>	"text-indent",
				"warning_col"	=>	"color",
				
				
		);
		foreach ($infos as $A) {
			$mainUnit = $p['main_unit'];
			$fontUnit = $p['txt_font_unit'];
			
			switch ($A) {
				case "mrg_top":
				case "mrg_bottom":
				case "mrg_left":
				case "mrg_right":
				case "pad_top":
				case "pad_bottom":
				case "pad_left":
				case "pad_right":
				case "txt_indent":
					if ( $p[$elm.'_'.$A] != 0 )	{ $str .= $tab[$A] .":".$p[$elm.'_'.$A]."; ";}
					if ( strpos($p[$elm.'_'.$A], 'auto') === false ) { $str .= " ".$mainUnit."; ";}
					break;
				case "fonte_size":
				case "font_size":
					if ( $p[$elm.'_'.$A] != 0 )	{ $str .= $tab[$A] .":".$p[$elm.'_'.$A].$fontUnit."; ";}
					break;
				case "bg_col":
				case "col":
				case "decoration":
				case "error_col":
				case "fade_col":
				case "fg_col":
				case "font":
				case "fonte":
				case "highlight_col":
				case "ok_col":
				case "txt_align":
				case "warning_col":
					if ( strlen( $p[$elm.'_'.$A])> 0 )	{ $str .= $tab[$A] .":".$p[$elm.'_'.$A]."; ";}
					break;
				case "special":
					if ( strlen( $p[$elm.'_'.$A])> 0 )	{ $str .= $p[$elm.'_'.$A]."; ";}
					break;
					
			}
		}
		return $str;
	}
}
?>
