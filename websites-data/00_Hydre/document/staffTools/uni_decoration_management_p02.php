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

$bts->RequestDataObj->setRequestData('decorationForm',
		array(
				'selectionId'	=>	4656895238074219866,
		)
);
$bts->RequestDataObj->setRequestData('formGenericData',
		array(
				'origin'		=> 'AdminDashboard',
				'section'		=> 'AdminDécorationManagementP02',
				'creation'		=> 'on',
				'modification'	=> 'on',
				'deletion'		=> 'on',
				'mode'			=> 'edit',
				// 'mode'			=> 'create',
				// 'mode'			=> 'delete',
		)
);

/*Hydr-Content-Begin*/
$localisation = " / uni_decoration_management_p02";
$bts->MapperObj->AddAnotherLevel($localisation );
$bts->LMObj->logCheckpoint("uni_decoration_management_p02.php");
$bts->MapperObj->RemoveThisLevel($localisation );
$bts->MapperObj->setSqlApplicant("uni_decoration_management_p02.php");


$bts->I18nTransObj->apply(
	array(
		"type" => "array",
		"fra" => array(
			"invite1"		=> "Cette partie va vous permettre de gérer la décoration.",
			"tabTxt1"		=> "Informations",

			'menu'			=> 'Menu',
			'caligraph'		=> 'Caligraphe',
			'1_div'			=> '1 DIV stylisé',
			'elegance'		=> 'Elégance',
			'exquisite'		=> 'Exquise',
			'elysion'		=> 'Elysion',

			"t1l1c1"		=>	"ID",
			"t1l2c1"		=>	"Nom",
			"t1l3c1"		=>	"Type",
			"t1l4c1"		=>	"Etat",
			
			"t1l2c2"		=>	"Nouvelle décoration ",
		),
		"eng" => array(
			"invite1"		=> "This part will allow you to manage this decoration.",
			"tabTxt1"		=> "Informations",

			'menu'			=> 'Menu',
			'caligraph'		=> 'Caligraph',
			'1_div'			=> '1 stylised DIV',
			'elegance'		=> 'Elegance',
			'exquisite'		=> 'Exquisite',
			'elysion'		=> 'Elysion',
	
			"t1l1c1"		=>	"ID",
			"t1l2c1"		=>	"Nom",
			"t1l3c1"		=>	"Type",
			"t1l4c1"		=>	"State",
			
			"t1l2c2"		=>	"New decoration ",
		)
	)
);

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('AdminFormTool');
$AdminFormToolObj = AdminFormTool::getInstance();
$Content .= $AdminFormToolObj->checkAdminDashboardForm($infos);


// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('Decoration');
$currentDecorationObj = new Decoration();

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('FormBuilder');
// $formBuilderObj = FormBuilder::getInstance();

// --------------------------------------------------------------------------------------------
$T = array();
switch ( $bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode') ) {
	case "delete":
	case "edit":
		$T['Content']['1']['2']['2']['cont'] = $currentDecorationObj->getDecorationEntry('deco_name');
		$currentDecorationObj->getDataFromDB($bts->RequestDataObj->getRequestDataSubEntry('decorationForm', 'selectionId'));
		$commandType = "update";
		$Content .= "<p>".$bts->I18nTransObj->getI18nTransEntry('invite1')."</p>\r";
		$processStep = "";
		$processTarget = "edit";
		break;
	case "create":
		$arrTmp = array_merge (
			$currentDecorationObj->getDecoration(),
			array(
			"deco_id"		=> "*",
			"deco_name"		=> $bts->I18nTransObj->getI18nTransEntry('t1l2c2') . "name " . time(),
			)
		);
		$T['Content']['1']['2']['2']['cont'] = $bts->RenderFormObj->renderInputText('decorationForm[name]',		$currentDecorationObj->getDecorationEntry('deco_name'));
		$currentDecorationObj->setDecoration($arrTmp);
		$commandType = "add";
		$processStep = "Create";
		$processTarget = "edit";
		$Content .= "<p>".$bts->I18nTransObj->getI18nTransEntry('invite1')."</p>\r";
		break;
}

// --------------------------------------------------------------------------------------------
$Content .= 
$bts->RenderFormObj->renderformHeader('decorationForm')
.$bts->RenderFormObj->renderHiddenInput(	"formSubmitted"	,				"1")
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[origin]"		,	"AdminDashboard")
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[section]"		,	"AdminGroupManagementP02" )
.$bts->RenderFormObj->renderHiddenInput(	"formCommand1"					,	$commandType )
.$bts->RenderFormObj->renderHiddenInput(	"formEntity1"					,	"group" )
.$bts->RenderFormObj->renderHiddenInput(	"formGenericData[mode]"			,	$processTarget )
.$bts->RenderFormObj->renderHiddenInput(	"formTarget1[name]"				, 	$currentDecorationObj->getDecorationEntry('deco_name') )
.$bts->RenderFormObj->renderHiddenInput(	"decorationForm[selectionId]"	,	$currentDecorationObj->getDecorationEntry('deco_id'))
."<p>\r"
;

// --------------------------------------------------------------------------------------------

$T['Content']['1']['1']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l1c1');
$T['Content']['1']['2']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l2c1');
$T['Content']['1']['3']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l3c1');
$T['Content']['1']['4']['1']['cont'] = $bts->I18nTransObj->getI18nTransEntry('t1l4c1');

$T['Content']['1']['1']['2']['cont'] = $currentDecorationObj->getDecorationEntry('deco_id');

$Tab = $currentDecorationObj->getMenuOptionArray();

$T['Content']['1']['3']['2']['cont'] = $bts->RenderFormObj->renderMenuSelect(array(
	'name' => 'formParams1[type]',
	'defaultSelected' => $currentDecorationObj->getDecorationEntry('deco_type'),
	'options' => $Tab['type'],
));

$T['Content']['1']['4']['2']['cont'] = $bts->RenderFormObj->renderMenuSelect(array(
	'name' => 'formParams1[state]',
	'defaultSelected' => $currentDecorationObj->getDecorationEntry('deco_state'),
	'options' => $Tab['state'],
));


// --------------------------------------------------------------------------------------------
//
//	Display
//
//
// --------------------------------------------------------------------------------------------
$T['ContentInfos'] = $bts->RenderTablesObj->getDefaultDocumentConfig($infos, 5);
$T['ContentCfg']['tabs'] = array(
		1	=>	$bts->RenderTablesObj->getDefaultTableConfig(4,2,2),
);
$Content .= $bts->RenderTablesObj->render($infos, $T);

// --------------------------------------------------------------------------------------------
$tmpDecoThemeData = new ThemeData();

switch ( $currentDecorationObj->getDecorationEntry('deco_type') ) {
	case 10:
		$ClassLoaderObj->provisionClass('Deco10_Menu');
		$TmpDeco = new Deco10_Menu();
		$TmpDeco->getDeco10_MenuDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco10Menu');
		$DecoRenderer = RenderDeco10Menu::getInstance();
		break;
	case 20:
		$ClassLoaderObj->provisionClass('Deco20_Caligraph');
		$TmpDeco = new Deco20_Caligraph();
		$TmpDeco->getDeco20_CaligraphDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco20Caligraph');
		$DecoRenderer = RenderDeco20Caligraph::getInstance();
		break;
	case 30:
		$ClassLoaderObj->provisionClass('Deco30_1Div');
		$TmpDeco = new Deco30_1Div();
		$TmpDeco->getDeco30_1DivDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco301Div');
		$DecoRenderer = RenderDeco301Div::getInstance();
		break;
	case 40:
		$ClassLoaderObj->provisionClass('Deco40_Elegance');
		$TmpDeco = new Deco40_Elegance();
		$TmpDeco->getDeco40_EleganceDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco40Elegance');
		$DecoRenderer = RenderDeco40Elegance::getInstance();
		break;
	case 50:
		$ClassLoaderObj->provisionClass('Deco50_Exquisite');
		$TmpDeco = new Deco50_Exquisite();
		$TmpDeco->getDeco50_ExquisiteDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco50Exquisite');
		$DecoRenderer = RenderDeco50Exquisite::getInstance();
		break;
	case 60:
		$ClassLoaderObj->provisionClass('Deco60_Elysion');
		$TmpDeco = new Deco60_Elysion();
		$TmpDeco->getDeco60_ElysionDataFromDB($currentDecorationObj->getDecorationEntry('deco_id'));
		$ClassLoaderObj->provisionClass('RenderDeco60Elysion');
		$DecoRenderer = RenderDeco60Elysion::getInstance();
		break;
}


$infosTmp = array(
    'module_name' 			=> 'decoSample_'.$currentDecorationObj->getDecorationEntry('deco_type'),
    'block'					=> 'B01',
    'blockG'				=> 'B01G',
    'blockT'				=> 'B01T',
    'deco_type'				=> $currentDecorationObj->getDecorationEntry('deco_type'),
	'module_display_mode'	=> 'normal',
	// 'module_display_mode'	=> 'bypass',
	'mode'					=> 1,
    'module' => array(
            'module_id'				=> 1,
            'module_name'			=> 'decoSample_'.$currentDecorationObj->getDecorationEntry('deco_type'),
			'module_container_name'	=> 'decoSample_'.$currentDecorationObj->getDecorationEntry('deco_type').'_container',
		)
	);

$Content .= "<br><div style='background-color:#00000080; width:100% height:768px; padding:64px'>"
.$DecoRenderer->render($infosTmp)
."<h1>H1 Lorem Ipsum</h1>"
."<h2>H2 Lorem Ipsum</h2>"
."<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed ipsum sed nibh tincidunt eleifend sit amet quis arcu. Quisque molestie interdum nulla vitae maximus. Nullam efficitur et leo id iaculis. Aenean id elit nec magna egestas gravida feugiat ut velit. Morbi mattis, risus quis auctor sagittis, neque massa fermentum risus, at dictum ex leo eu urna. Donec ut nulla non turpis condimentum congue. Curabitur tristique lorem nec est pulvinar, vel commodo diam tincidunt. Nulla cursus orci ac enim posuere venenatis. Aliquam eu odio ultricies, pharetra enim a, luctus ex. Aliquam tortor mauris, pharetra vitae aliquam vel, viverra a urna. Vestibulum euismod augue at ligula aliquet, at vehicula nisl sollicitudin. Phasellus at arcu enim. Quisque eleifend nunc sed blandit vehicula. Sed condimentum velit a nibh maximus, quis viverra velit ultrices. Sed sodales pulvinar convallis. Cras lorem tellus, aliquam sed lorem id, consectetur fermentum risus.</p>"
."<h3>H3 Lorem Ipsum</h3>"
."<p>Vestibulum et auctor odio. Vestibulum eu vestibulum est, quis euismod sem. Integer et augue hendrerit velit viverra dictum ac id massa. Sed dui diam, malesuada a varius at, tincidunt vel nulla. Duis augue felis, scelerisque nec sem quis, ultricies condimentum ligula. Vestibulum rhoncus enim sit amet dui vestibulum finibus. Integer magna felis, molestie ac eros eu, consequat bibendum quam. Maecenas vehicula vel metus non accumsan. Sed sodales leo et tortor venenatis porttitor. </p>"
."</div>"
."</div>"
;

// --------------------------------------------------------------------------------------------
$ClassLoaderObj->provisionClass('Template');
$TemplateObj = Template::getInstance();
$infos['formName'] = "decorationForm";
$Content .= $TemplateObj->renderAdminFormButtons($infos);




/*Hydr-Content-End*/


?>
