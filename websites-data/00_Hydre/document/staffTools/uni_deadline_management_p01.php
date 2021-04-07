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
$localisation = " / uni_deadline_management_p01";
$bts->MapperObj->AddAnotherLevel($localisation );
$bts->LMObj->logCheckpoint("uni_deadline_management_p01.php");
$bts->MapperObj->RemoveThisLevel($localisation );
$bts->MapperObj->setSqlApplicant("uni_deadline_management_p01.php");

switch ($l) {
	case "fra":
		$bts->I18nObj->apply(array(
		"invite1"		=> "Cette partie va vous permettre de gérer les deadlines.",
		"col_1_txt"		=> "Nom",
		"col_2_txt"		=> "Etat",
		"col_3_txt"		=> "Date",
		"tabTxt1"		=> "Informations",
		"dlState0"		=> "Hors ligne",
		"dlState1"		=> "En ligne",
		"dlState2"		=> "Supprimé",
		));
		break;
	case "eng":
		$bts->I18nObj->apply(array(
		"invite1"		=> "This part will allow you to manage deadlines.",
		"col_1_txt"		=> "Name",
		"col_2_txt"		=> "Status",
		"col_3_txt"		=> "Date",
		"tabTxt1"		=> "Informations",
		"dlState0"		=> "Offline",
		"dlState1"		=> "Online",
		"dlState2"		=> "Deleted",
		));
		break;
}

// --------------------------------------------------------------------------------------------
$dbquery = $bts->SDDMObj->query("
SELECT bcl.*,usr.user_login 
FROM ".$SqlTableListObj->getSQLTableName('deadline')." bcl , ".$SqlTableListObj->getSQLTableName('user')." usr 
WHERE ws_id = '".$WebSiteObj->getWebSiteEntry('ws_id')."' 
AND usr.user_id = bcl.user_id
;");

$T = array();
if ( $bts->SDDMObj->num_row_sql($dbquery) == 0 ) {

	$i = 1;
	$T['AD']['1'][$i]['1']['cont'] = $bts->I18nObj->getI18nEntry('nothingToDisplay');
	$T['AD']['1'][$i]['2']['cont'] = "";
	$T['AD']['1'][$i]['3']['cont'] = "";
}
else {
	$i = 1;
	$T['AD']['1'][$i]['1']['cont']	= $bts->I18nObj->getI18nEntry('col_1_txt');
	$T['AD']['1'][$i]['2']['cont']	= $bts->I18nObj->getI18nEntry('col_2_txt');
	$T['AD']['1'][$i]['3']['cont']	= $bts->I18nObj->getI18nEntry('col_3_txt');

	
	$linkId1 = "<a class='".$Block."_lien' href='index.php?sw="
			.$WebSiteObj->getWebSiteEntry('ws_id')
			."&arti_ref=".$CurrentSetObj->getDataSubEntry('article','arti_ref')
			."&arti_page=2"
			."&l=".$CurrentSetObj->getDataEntry('language')
			."&deadlineForm[mode]=edit"
			."&deadlineForm[selectionId]="
			;
	
	$tabState = array(
		0	=> $bts->I18nObj->getI18nEntry('dlState0'),
		1	=> $bts->I18nObj->getI18nEntry('dlState1'),
		2	=> $bts->I18nObj->getI18nEntry('dlState2'),
	);
	while ($dbp = $bts->SDDMObj->fetch_array_sql($dbquery)) {
		$i++;
		$T['AD']['1'][$i]['1']['cont']	= $linkId1.$dbp['deadline_id']."'>".$dbp['deadline_title']."</a>";
		$T['AD']['1'][$i]['2']['cont']	= $tabState[$dbp['deadline_state']];
		$T['AD']['1'][$i]['3']['cont']	= date ( "Y m d H:i:s" , $dbp['deadline_end_date']);
		$T['AD']['1'][$i]['2']['tc']	= 1;
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
