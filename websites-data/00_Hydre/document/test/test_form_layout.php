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
/*Hydr-Content-Begin*/
$_REQUEST['sql_initiateur'] = "fra_test_layout_formulaire";

for ( $i=1 ; $i<=4 ; $i++ ) {
	for ( $j=1 ; $j<=4 ; $j++ ) {
		for ( $k=1 ; $k<=4 ; $k++ ) {
			$AD[$i][$j][$k]['cont'] = $i . "_" . $j . "_" .  $k ;
		}
	}
}

$tl_['eng']['onglet_1'] = "Informations";	$tl_['fra']['onglet_1'] = "Informations";
$tl_['eng']['onglet_2'] = "Configuration";	$tl_['fra']['onglet_2'] = "Configuration";
$tl_['eng']['onglet_3'] = "State";			$tl_['fra']['onglet_3'] = "Etat";

$ADC['tabs']['1']['NbrOfLines'] = 4;	$ADC['tabs']['1']['NbrOfCells'] = 4;	$ADC['tabs']['1']['TableCaptionPos'] = 1;
$ADC['tabs']['2']['NbrOfLines'] = 4;	$ADC['tabs']['2']['NbrOfCells'] = 4;	$ADC['tabs']['2']['TableCaptionPos'] = 2;
$ADC['tabs']['3']['NbrOfLines'] = 4;	$ADC['tabs']['3']['NbrOfCells'] = 4;	$ADC['tabs']['3']['TableCaptionPos'] = 3;

$tab_infos['AffOnglet']			= 1;
$tab_infos['NbrOnglet']			= 3;
$tab_infos['tab_comportement']	= 1;
$tab_infos['TypSurbrillance']	= 1; // 1:ligne, 2:cellule
$tab_infos['mode_rendu']		= 0;	// 0 echo 1 dans une variable
$tab_infos['doc_height']		= 256;
$tab_infos['doc_width']			= ${$theme_tableau}['theme_module_internal_width'];
$tab_infos['group']			= "inst1";
$tab_infos['cell_id']			= "tab";
$tab_infos['document']			= "doc";
$tab_infos['cell_1_txt']		= $tl_[$l]['onglet_1'];
$tab_infos['cell_2_txt']		= $tl_[$l]['onglet_2'];
$tab_infos['cell_3_txt']		= $tl_[$l]['onglet_3'];
include ("engine/affichage_donnees.php");

/*Hydr-Content-End*/
?>
