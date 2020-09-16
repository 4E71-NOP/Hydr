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
// Some definitions in order to ease the IDE work.
/* @var $AdminFormToolObj AdminFormTool             */
/* @var $CMObj ConfigurationManagement              */
/* @var $ClassLoaderObj ClassLoader                 */
/* @var $LMObj LogManagement                        */
/* @var $MapperObj Mapper                           */
/* @var $I18nObj I18n                               */
/* @var $InteractiveElementsObj InteractiveElements */
/* @var $RenderTablesObj RenderTables               */
/* @var $RequestDataObj RequestData                 */
/* @var $SDDMObj DalFacade                          */
/* @var $SqlTableListObj SqlTableList               */
/* @var $StringFormatObj StringFormat               */
/* @var $TimeObj Time                               */

/* @var $CurrentSetObj CurrentSet                   */
/* @var $DocumentDataObj DocumentData               */
/* @var $RenderLayoutObj RenderLayout               */
/* @var $ThemeDataObj ThemeData                     */
/* @var $UserObj User                               */
/* @var $WebSiteObj WebSite                         */

/* @var $Block String                               */
/* @var $infos array                                */
/* @var $l String                                   */
/*Hydre-IDE-end*/

$logTarget = $LMObj->getInternalLogTarget();
$LMObj->setInternalLogTarget("both");

// --------------------------------------------------------------------------------------------
/*Hydre-contenu_debut*/
$localisation = " / uni_gestion_des_categories_p01";
$MapperObj->AddAnotherLevel($localisation );
$LMObj->logCheckpoint("uni_gestion_des_categories_p01");
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("uni_gestion_des_categories_p01");

switch ($l) {
	case "fra":
		$I18nObj->apply(array(
		"invite1"		=> "Cette partie va vous permettre de gérer les documents.",
		"col_1_txt"		=> "Nom",
		"col_2_txt"		=> "Type",
		"col_3_txt"		=> "Modifiable",
		"tabTxt1"		=> "Informations",
		"docTyp0"		=> "HydrCode",
		"docTyp1"		=> "NoCode",
		"docTyp2"		=> "PHP",
		"docTyp3"		=> "Mixed",
		"docModif0"		=> "Non",
		"docModif1"		=> "Oui",
		));
		break;
	case "eng":
		$I18nObj->apply(array(
		"invite1"		=> "This part will allow you to manage documents.",
		"col_1_txt"		=> "Name",
		"col_2_txt"		=> "Type",
		"col_3_txt"		=> "Can be modified",
		"tabTxt1"		=> "Informations",
		"docTyp0"		=> "HydrCode",
		"docTyp1"		=> "NoCode",
		"docTyp2"		=> "PHP",
		"docTyp3"		=> "Mixed",
		"docModif0"		=> "No",
		"docModif1"		=> "Yes",
		));
		break;
}
$Content .= $I18nObj->getI18nEntry('invite1')."<br>\r<br>\r";

$dbquery = $SDDMObj->query("
SELECT doc.docu_id,doc.docu_nom,doc.docu_type,part.part_modification 
FROM ".$SqlTableListObj->getSQLTableName('document')." doc, ".$SqlTableListObj->getSQLTableName('document_partage')." part 
WHERE part.site_id = '".$WebSiteObj->getWebSiteEntry('sw_id')."' 
AND part.docu_id = doc.docu_id 
AND doc.docu_origine = '".$WebSiteObj->getWebSiteEntry('sw_id')."' 
;");

$T = array();
if ( $SDDMObj->num_row_sql($dbquery) == 0 ) {
	$i = 1;
	$T['AD']['1'][$i]['1']['cont'] = $I18nObj->getI18nEntry('nothingToDisplay');
	$T['AD']['1'][$i]['2']['cont'] = "";
	$T['AD']['1'][$i]['3']['cont'] = "";
}
else {
	
	$type = array (
		0 => $I18nObj->getI18nEntry('docTyp0'),
		1 => $I18nObj->getI18nEntry('docTyp1'),
		2 => $I18nObj->getI18nEntry('docTyp2'),
		3 => $I18nObj->getI18nEntry('docTyp3'),
	);
	
	$modif = array(
		0 => $I18nObj->getI18nEntry('docModif0'),
		1 => $I18nObj->getI18nEntry('docModif1'),
	);
	
	$i = 1;
	$T['AD']['1'][$i]['1']['cont']	= $I18nObj->getI18nEntry('col_1_txt');
	$T['AD']['1'][$i]['2']['cont']	= $I18nObj->getI18nEntry('col_2_txt');
	$T['AD']['1'][$i]['3']['cont']	= $I18nObj->getI18nEntry('col_3_txt');
	
	while ($dbp = $SDDMObj->fetch_array_sql($dbquery)) {
		$i++;
		$T['AD']['1'][$i]['1']['cont']	= "
		<a class='" . $Block."_lien' href='index.php?"
			."sw=".$WebSiteObj->getWebSiteEntry('sw_id')
			."&l=".$CurrentSetObj->getDataEntry('language')
			."&arti_ref=".$CurrentSetObj->getDataSubEntry('article','arti_ref')
			."&arti_page=2"
			."&formGenericData[mode]=edit"
			."&documentForm[selectionId]=".$dbp['docu_id']
			."'>".$dbp['docu_nom']."</a>";
		$T['AD']['1'][$i]['2']['cont']	= $type[$dbp['docu_type']];
		$T['AD']['1'][$i]['3']['cont']	= $modif[$dbp['part_modification']];
	}
}
// --------------------------------------------------------------------------------------------
//
//	Display
//
//
// --------------------------------------------------------------------------------------------
$T['tab_infos'] = $RenderTablesObj->getDefaultDocumentConfig($infos, 15);
$T['ADC']['onglet'] = array(
		1	=>	$RenderTablesObj->getDefaultTableConfig($i,3,1),
);
$Content .= $RenderTablesObj->render($infos, $T);

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('Template');
$TemplateObj = Template::getInstance();
$Content .= $TemplateObj->renderAdminCreateButton($infos);

/*Hydre-contenu_fin*/

$LMObj->setInternalLogTarget($logTarget);

?>