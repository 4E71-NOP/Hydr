<?php
/*Hydre-licence-begin*/
// --------------------------------------------------------------------------------------------
//
//	Hydre - Le petit moteur de web
//	licence Creative Common licence, CC-by-nc-sa (http://creativecommons.org)
//	Author : Faust MARIA DE AREVALO, mailto:faust@rootwave.net
//
// --------------------------------------------------------------------------------------------
/*Hydre-licence-fin*/

/*Hydre-IDE-begin*/
// Some definitions in order to ease the IDE work and to provide information about what is already available in this context.
/* @var $bts BaseToolSet                            */
/* @var $CurrentSetObj CurrentSet                   */
/* @var $ClassLoaderObj ClassLoader                 */

/* @var $SqlTableListObj SqlTableList               */
/* @var $UserObj User                               */
/* @var $WebSiteObj WebSite                         */
/* @var $DocumentDataObj DocumentData               */
/* @var $ThemeDataObj ThemeData                     */

/* @var $Content String                             */
/* @var $Block String                               */
/* @var $infos Array                                */
/* @var $l String                                   */
/*Hydre-IDE-end*/

// $LOG_TARGET = $LMObj->getInternalLogTarget();
// $LMObj->setInternalLogTarget("both");

$bts->RequestDataObj->setRequestData('test',
		array(
				'test'		=> 1,
		)
		);

/*Hydre-contenu_debut*/
$localisation = " / uni_theme_management_p01";
$bts->MapperObj->AddAnotherLevel($localisation );
$bts->LMObj->logCheckpoint("uni_theme_management_p01.php");
$bts->MapperObj->RemoveThisLevel($localisation );
$bts->MapperObj->setSqlApplicant("uni_theme_management_p01.php");

switch ($l) {
	case "fra":
		$bts->I18nObj->apply(array(
		"invite1"		=> "Cette partie va vous permettre de gérer les themes.",
		"col_1_txt"		=> "Nom",
		"col_2_txt"		=> "Titre",
		"col_3_txt"		=> "date",
		"tabTxt1"		=> "Informations",
		"raf1"			=> "Rien a afficher",
		"btn1"			=> "Créer un theme",
		));
		break;
	case "eng":
		$bts->I18nObj->apply(array(
		"invite1"		=> "This part will allow you to manage themes.",
		"col_1_txt"		=> "Name",
		"col_2_txt"		=> "Title",
		"col_3_txt"		=> "date",
		"tabTxt1"		=> "Informations",
		"raf1"			=> "Nothing to display",
		"btn1"			=> "Create a theme",
		));
		break;
}
$Content .= $bts->I18nObj->getI18nEntry('invite1')."<br>\r<br>\r";

// --------------------------------------------------------------------------------------------

$dbquery = $bts->SDDMObj->query("
SELECT s.theme_id, s.theme_name, s.theme_title, s.theme_date 
FROM ".$SqlTableListObj->getSQLTableName('theme_descriptor')." s, ".$SqlTableListObj->getSQLTableName('theme_website')." ss 
WHERE s.theme_id = ss.theme_id 
AND ss.ws_id = '".$WebSiteObj->getWebSiteEntry('ws_id')."' 
;");

$i = 1;
if ( $bts->SDDMObj->num_row_sql($dbquery) == 0 ) {
	$T['AD']['1'][$i]['1']['cont'] = $bts->I18nObj->getI18nEntry('nothingToDisplay');
	$T['AD']['1'][$i]['2']['cont'] = "";
	$T['AD']['1'][$i]['3']['cont'] = "";
}
else {
	$T['AD']['1'][$i]['1']['cont']	= $bts->I18nObj->getI18nEntry('col_1_txt');
	$T['AD']['1'][$i]['2']['cont']	= $bts->I18nObj->getI18nEntry('col_2_txt');
	$T['AD']['1'][$i]['3']['cont']	= $bts->I18nObj->getI18nEntry('col_3_txt');
	while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) { 
		$i++;
		$T['AD']['1'][$i]['1']['cont']	= "<a class='".$Block."_lien' href='index.php?"
			."sw=".$WebSiteObj->getWebSiteEntry('ws_id')
			."&l=".$CurrentSetObj->getDataEntry('language')
			."&arti_ref=".$CurrentSetObj->getDataSubEntry('article','arti_ref')
			."&arti_page=2"
			."&formGenericData[mode]=edit"
			."&themeForm[selectionId]=".$dbp['theme_id']
			."'>"
			.$dbp['theme_name']
			."</a>\r";
		$T['AD']['1'][$i]['2']['cont']	= $dbp['theme_title'];
		$T['AD']['1'][$i]['3']['cont']	= strftime ("%a %d %b %y - %H:%M",$dbp['theme_date'] );		
		$T['AD']['1'][$i]['2']['tc']	= 2;
		$T['AD']['1'][$i]['3']['tc']	= 1;
	}
}

// --------------------------------------------------------------------------------------------
//
//	Display
//
//
// --------------------------------------------------------------------------------------------
$T['tab_infos'] = $bts->RenderTablesObj->getDefaultDocumentConfig($infos, 15);
$T['ADC']['onglet'] = array(
		1	=>	$bts->RenderTablesObj->getDefaultTableConfig($i,3,1),
);
$Content .= $bts->RenderTablesObj->render($infos, $T);

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('Template');
$TemplateObj = Template::getInstance();
$Content .= $TemplateObj->renderAdminCreateButton($infos);

/*Hydre-contenu_fin*/

// $LMObj->setInternalLogTarget($LOG_TARGET);

?>
