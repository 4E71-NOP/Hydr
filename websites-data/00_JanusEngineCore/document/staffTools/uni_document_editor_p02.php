<?php
/*JanusEngine-license-start*/
// --------------------------------------------------------------------------------------------
//
//	Janus Engine - Le petit moteur de web
//	licence Creative Common licence, CC-by-nc-sa (http://creativecommons.org)
//	Author : Faust MARIA DE AREVALO, mailto:faust@rootwave.net
//
// --------------------------------------------------------------------------------------------
/*JanusEngine-license-end*/

/*JanusEngine-IDE-begin*/
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
/*JanusEngine-IDE-end*/

$bts->RequestDataObj->setRequestData('documentForm',
		array(
				'selectionId'	=> 1022502405601556960,
		)
);
$bts->RequestDataObj->setRequestData('formGenericData',
	array(
		'origin'		=> 'AdminDashboard',
		'section'		=> 'AdminDocumentManagementP02',
		'creation'		=> 'on',
		'modification'	=> 'on',
		'deletion'		=> 'on',
		'mode'			=> 'edit',
		// 'mode'			=> 'create',
		// 'mode'			=> 'delete',
	)
);

/*JanusEngine-Content-Begin*/
$bts->mapSegmentLocation(__METHOD__, "uni_document_editor_p02");

$bts->I18nTransObj->apply(
	array(
		"type" => "array",
		"fra" => array(
			"invite1"		=> "Cette partie va vous permettre de gérer les documents.",
			"invite2"		=> "Cette partie va vous permettre de créer un document.",
			"tabTxt1"		=> "Edition directe",
			"tabTxt2"		=> "Insertion de fichier",
			
			"t1l1c1"		=>	"ID",
			"t1l2c1"		=>	"Nom",
			"t1l3c1"		=>	"Type",
			"t1l4c1"		=>	"Modifiable par un autre site",
			"t1l5c1"		=>	"Contenu",
			
			"t2l1c1"		=>	"Information",
			"t2l1c2"		=>	"Attention. Le fichier remplacera le contenu actuel dans la BDD.",
			"t2l2c1"		=>	"Fichier",

			"type0"			=>	"HTML",
			"type1"			=>	"PHP",
			"type2"			=>	"Mixé",
			"goModif"		=>	"Modifier le contenu de ce document.",
		),
		"eng" => array(
			"no"			=>	"No",
			"yes"			=>	"Yes",
			"offline"		=> "Offline",
			"online"		=> "Online",
			
			"invite1"		=> "This part will allow you to manage documents.",
			"invite2"		=> "This part will allow you to create a document.",
			"tabTxt1"		=> "Direct edit",
			"tabTxt2"		=> "Insert file",
			
			"t1l1c1"		=>	"ID",
			"t1l2c1"		=>	"Nom",
			"t1l3c1"		=>	"Type",
			"t1l4c1"		=>	"Update-able by another site",
			"t1l5c1"		=>	"Content",

			"t2l1c1"		=>	"Information",
			"t2l1c2"		=>	"Warning. The file content will replace the content in database.",
			"t2l2c1"		=>	"File",

			"type0"			=>	"HTML",
			"type1"			=>	"PHP",
			"type2"			=>	"Mixed",
			
			"goModif"		=>	"Modify the document content.",
		)
	)
);


// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('MenuSelectTable');
$MenuSelectTableObj = MenuSelectTable::getInstance();

$tabUser = $MenuSelectTableObj->getUserList();

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('AdminFormTool');
$AdminFormToolObj = AdminFormTool::getInstance();
$Content .= $AdminFormToolObj->checkAdminDashboardForm($infos);

// --------------------------------------------------------------------------------------------
$T = array();

$ClassLoaderObj->provisionClass('Document');
$ClassLoaderObj->provisionClass('DocumentShare');
$currentDocumentObj = new Document();
$currentDocumentShareObj = new DocumentShare;
switch ($bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode')) {
	case "edit":
		$commandType = "update";
		$currentDocumentObj->getDataFromDB($bts->RequestDataObj->getRequestDataSubEntry('documentForm', 'selectionId'));
		$currentDocumentShareObj->getDataFromDBUsingDocuId( $currentDocumentObj->getDocumentEntry('docu_id') );
		$Content .= "<p>".$bts->I18nTransObj->getI18nTransEntry('invite1')."</p>\r";
		$processStep = "";
		$processTarget = "edit";
		break;
	case "create":
		// $commandType = "add";
		// $currentDocumentObj->setDocument(
		// 		array (
		// 			"docu_id"				=>	"",
		// 			"docu_name"				=>	"NewDocument",
		// 			"docu_type"				=>	0,
		// 			"docu_origin"			=>	$WebSiteObj->getWebSiteEntry('ws_id'),
		// 			"docu_creator"			=>	$CurrentSetObj->UserObj->getUserEntry('user_id'),
		// 			"docu_creation_date"	=>	time(),
		// 			"docu_validation"		=>	0,
		// 			"docu_validator"		=>	"",
		// 			"docu_validation_date"	=>	0,
		// 			"docu_cont"				=>	"",
		// 		)
		// );
		// $Content .= "<p>".$bts->I18nTransObj->getI18nTransEntry('invite2')."</p>\r";
		// $processStep = "Create";
		// $processTarget = "edit";
		break;
}

// --------------------------------------------------------------------------------------------
$Content .= 
$bts->RenderFormObj->renderformHeader('documentForm')
.$bts->RenderFormObj->renderHiddenInput(	"formSubmitted"	,				"1")
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[origin]"	,	"AdminDashboard")
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[section]"	,	"AdminDocumentEditorP02" )
.$bts->RenderFormObj->renderHiddenInput(	"formCommand1"				,	$commandType )
.$bts->RenderFormObj->renderHiddenInput(	"formEntity1"				,	"document" )
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[mode]"		,	$processTarget )
.$bts->RenderFormObj->renderHiddenInput(	"formTarget1[name]"			, 	$currentDocumentObj->getDocumentEntry('docu_name') )
.$bts->RenderFormObj->renderHiddenInput(	"documentForm[selectionId]"	,	$currentDocumentObj->getDocumentEntry('docu_id') )
."<p>\r"
;

$T['Content']['1']['1']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l1c1');
$T['Content']['1']['2']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l2c1');
$T['Content']['1']['3']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l3c1');
$T['Content']['1']['4']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l4c1');
$T['Content']['1']['5']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l5c1');

switch ( $bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode') ) {
	case "edit":
		$T['Content']['1']['1']['2']['cont'] = $currentDocumentObj->getDocumentEntry('docu_id');
		$T['Content']['1']['2']['2']['cont'] = $currentDocumentObj->getDocumentEntry('docu_name');
		break;
	case "create":
		// $T['Content']['1']['1']['2']['cont'] = "***";
		// $T['Content']['1']['2']['2']['cont'] = $bts->RenderFormObj->renderInputText('formParams1[name]',	"NewDocument".time());;
		break;
}

$documentMenuOption = $currentDocumentObj->getMenuOptionArray();

$T['Content']['1']['3']['2']['cont'] = $bts->RenderFormObj->renderMenuSelect(array(
	'name' => 'formParams1[type]',
	'defaultSelected' => $currentDocumentObj->getDocumentEntry('docu_type'),
	'options' => $documentMenuOption['type'],
));

$T['Content']['1']['4']['2']['cont'] = $bts->RenderFormObj->renderMenuSelect(array(
	'name' => 'formParams1[modification]',
	'defaultSelected' => $currentDocumentShareObj->getDocumentShareEntry('share_modification'),
	'options' => $documentMenuOption['yesno'],
));

// $T['Content']['1']['5']['2']['cont'] = $tabUser[$currentDocumentObj->getDocumentEntry('docu_validator')]['t'];
// $Content .= $bts->RenderFormObj->renderHiddenInput(	"formParams1[validator]"	,	$tabUser[$currentDocumentObj->getDocumentEntry('docu_validator')]['t'] );
$T['Content']['1']['5']['2']['cont'] = "<textarea  id='formParams1[content]' cols='100' rows='20'>".$currentDocumentObj->getDocumentEntry('docu_cont')."</textarea>";

$T['Content']['2']['1']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t2l1c1');
$T['Content']['2']['2']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t2l2c1');

$T['Content']['2']['1']['2']['cont'] = "<span class='".$Block."_warning'>". $bts->I18nTransObj->getI18nTransEntry('t2l1c2') . "</span>";

$Content .= 
 $bts->RenderFormObj->renderHiddenInput(	"formCommand2"				,	"INSERT" )
.$bts->RenderFormObj->renderHiddenInput(	"formEntity2"				,	"CONTENT" )
.$bts->RenderFormObj->renderHiddenInput(	"formTarget2[name]"			, 	$currentDocumentObj->getDocumentEntry('docu_name') )
;

$FileSelectorConfig = array_merge ( $bts->InteractiveElementsObj->getDefaultIconSelectFileConfig(
		"documentForm",
		"formParams2[file]",
		45,
		"",
		"/websites-data/",
		"/websites-data/",
		"t2l2c2",
	), 
	array(		
		"strRemove"			=> "",
		"strAdd"			=> "../",
	)
);
$infos['IconSelectFile'] = $FileSelectorConfig;
$CurrentSetObj->setDataSubEntry('fs', $CurrentSetObj->getDataEntry('fsIdx'),$FileSelectorConfig);
$CurrentSetObj->setDataEntry('fsIdx', $CurrentSetObj->getDataEntry('fsIdx')+1 );
$T['Content']['2']['2']['2']['cont']		= $bts->InteractiveElementsObj->renderIconSelectFile($infos);

// --------------------------------------------------------------------------------------------
//
//	Display
//
//
// --------------------------------------------------------------------------------------------
$T['ContentInfos'] = $bts->RenderTablesObj->getDefaultDocumentConfig($infos, 20, 2);
$T['ContentCfg']['tabs'] = array(
		1	=>	$bts->RenderTablesObj->getDefaultTableConfig(5,2,2),
		2	=>	$bts->RenderTablesObj->getDefaultTableConfig(2,2,2),
);
$Content .= $bts->RenderTablesObj->render($infos, $T);

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('Template');
$TemplateObj = Template::getInstance();
$infos['formName'] = "documentForm";
$Content .= $TemplateObj->renderAdminFormButtons($infos);

$bts->segmentEnding(__METHOD__);

/*JanusEngine-Content-End*/

?>