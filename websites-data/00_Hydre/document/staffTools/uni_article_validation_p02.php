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
//	2005 09 22 : uni_validation_d_article_p02.php debut
//	2007 05 31 : Derniere modification
// --------------------------------------------------------------------------------------------
$_REQUEST['M_ARTICL']['arti_ref_selection'] = "mwm_fra_acceuil" ;
$_REQUEST['M_ARTICL']['arti_page_selection'] = "1" ;
//$_REQUEST['M_ARTICL']['arti_id_selection'] = "20";
$_REQUEST['uni_gestion_des_articles_p'] = 2;
/*Hydr-Content-Begin*/
$_REQUEST['sql_initiateur'] = "uni_validation_article_p02";

// --------------------------------------------------------------------------------------------
// Mise a jour du document
// --------------------------------------------------------------------------------------------
if ( $_REQUEST['M_ARTICL']['confirmation_modification_oubli'] == 1 ){ 
	$tl_['eng']['err1'] = "You asked for an article update but you didn't click on the confirmation checkbox.";
	$tl_['fra']['err1'] = "Vous avez demand&eacute; la modification de l'article mais vous n'avez pas confirm&eacute;.";
	echo ("<p class='" . $theme_tableau . $_REQUEST['bloc']."_tb3'> <p class='" . $theme_tableau . $_REQUEST['bloc']."_erreur'>".$tl_[$l]['err1']."</p>\r<br>\r<hr>\r"); 
}

if ( $_REQUEST['M_ARTICL']['modification_effectuee'] == 1 ){ 
	$tl_['eng']['err1'] = "The article named ".$_REQUEST['arti_ref_selection']." on page ".$_REQUEST['arti_page_selection']." has been updated.";
	$tl_['fra']['err1'] = "L'article ".$_REQUEST['M_ARTICL']['arti_ref_selection']." page ".$_REQUEST['M_ARTICL']['arti_page_selection']." a &eacute;t&eacute; mis a jour.";
	echo ("<p class='" . $theme_tableau . $_REQUEST['bloc']."_tb3'> <p class='" . $theme_tableau . $_REQUEST['bloc']."_avert'>".$tl_[$l]['err1']."</p><br>\r<hr>\r"); 
}
// --------------------------------------------------------------------------------------------
// Preparation des tables
// --------------------------------------------------------------------------------------------
switch ( $_REQUEST['uni_gestion_des_articles_p'] ) {
case 2:
	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT * 
	FROM ".$SQL_tab_abrege['article']." 
	WHERE arti_ref = '".$_REQUEST['M_ARTICL']['arti_ref_selection']."'
	AND arti_page = '".$_REQUEST['M_ARTICL']['arti_page_selection']."' 
	AND ws_id = '".$website['ws_id']."'
	;");
	while ($dbp = fetch_array_sql($dbquery)) {	foreach ( $dbp as $A => $B ) { $infos_article[$A] = $B; } }
	unset ( $A , $B );


	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT pre.layout_id,pre.layout_name,pre.layout_generic_name  
	FROM ".$SQL_tab_abrege['layout']." pre, ".$SQL_tab_abrege['layout_theme']." sp , ".$SQL_tab_abrege['theme_website']." ss 
	WHERE pre.layout_id = sp.layout_id 
	AND sp.theme_id = '".${$theme_tableau}['theme_id']."' 
	AND sp.theme_id = ss.theme_id 
	AND ss.ws_id = '".$website['ws_id']."' 
	AND pre.layout_generic_name = '".$infos_article['layout_generic_name']."' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { $pv['o2l12'] = $dbp['layout_generic_name']; }


	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT * 
	FROM ".$SQL_tab_abrege['article_config']." 
	WHERE ws_id = '".$website['ws_id']."' 
	AND config_id = '".$infos_article['config_id']."' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { $pv['o2l22'] = $dbp['config_name']; }


	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT deadline_id,deadline_title,deadline_name  
	FROM ".$SQL_tab_abrege['deadline']."   
	WHERE ws_id = '".$website['ws_id']."' 
	AND deadline_state != '2' 
	AND deadline_id = '".$infos_article['deadline_id']."' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { $pv['o2l32'] = $dbp['deadline_name']; }


	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT usr.user_id,usr.user_login 
	FROM ".$SQL_tab_abrege['user']." usr, ".$SQL_tab_abrege['group_user']." grp , ".$SQL_tab_abrege['group_website']." sgp 
	WHERE usr.user_id = grp.user_id 
	AND grp.group_id = sgp.group_id
	AND sgp.ws_id = '".$website['ws_id']."'
	;");
	while ($dbp = fetch_array_sql($dbquery)) {
		$pv['user_list'][$dbp['user_id']]['user_login'] = $dbp['user_login'];
	}

	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT doc.docu_id,doc.docu_name,doc.docu_type,shr.share_modification 
	FROM ".$SQL_tab_abrege['document']." doc, ".$SQL_tab_abrege['document_share']." part 
	WHERE shr.ws_id = '".$website['ws_id']."' 
	AND shr.docu_id = doc.docu_id 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { $pv['document_list'][$dbp['docu_id']]['nom'] = $dbp['docu_name']; }
	$pv['document_list'][$infos_article['docu_id']]['s'] = " selected";

	$tl_['eng']['link'] = "Link for modifying the associated document (".$pv['document_list'][$infos_article['docu_id']]['nom'].").";
	$tl_['fra']['link'] = "Lien pour modifier le document associ&eacute; a cet article (".$pv['document_list'][$infos_article['docu_id']]['nom'].").";

	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT cate_role, cate_id, arti_ref 
	FROM ".$SQL_tab['category']." 
	WHERE cate_type IN ('2', '3') 
	AND ws_id IN ('1', '".$website['ws_id']."') 
	AND lang_id = '".$website['ws_lang']."' 
	AND group_id ".$user['clause_in_group']." 
	AND cate_state = '1' 
	AND cate_role = '1'
	;");
	while ($dbp = fetch_array_sql($dbquery)) { $pv['role_article_cible'] = $dbp['arti_ref']; }

	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT  docu_id,docu_name
	FROM ".$SQL_tab_abrege['document']."  
	WHERE  docu_id = '".$infos_article['docu_id']."'
	;");
	while ($dbp = fetch_array_sql($dbquery)) {
		$pv['o3l12'] = "<a class='" . $theme_tableau . $_REQUEST['bloc']."_lien " . $theme_tableau . $_REQUEST['bloc']."_tb4' href='index.php?
	arti_ref=".$pv['role_article_cible']."
	&amp;M_DOCUME[document_selection]=".$infos_article['docu_id'].
	$bloc_html['url_slup']."
	&amp;arti_page=2'
	>".$tl_[$l]['link']."</a>\r";
	}
break;
case 3:
	$infos_article['arti_name']			= "<input type='text' name='M_ARTICL[nom]' size='35' maxlength='255' value='Nouvel_article' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$infos_article['arti_desc']			= "<input type='text' name='M_ARTICL[desc]' size='35' maxlength='255' value='Description' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$infos_article['arti_title']		= "<input type='text' name='M_ARTICL[titre]' size='35' maxlength='255' value='-' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$infos_article['arti_subtitle']	= "<input type='text' name='M_ARTICL[sous_titre]' size='35' maxlength='255' value='-' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$infos_article['arti_page']			= "<input type='text' name='M_ARTICL[page]' size='35' maxlength='255' value='1' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";

	$pv['o2l12'] = "<select name ='M_ARTICL[layout]' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$pv['o2l22'] = "<select name ='M_ARTICL[config_id]' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$pv['o2l32'] = "<select name ='M_ARTICL[deadline]' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";
	$pv['o3l12'] = "<select name ='M_ARTICL[document]' class='" . $theme_tableau . $_REQUEST['bloc']."_form_1'>\r";

	$pv['ptr'] = 0;
	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT pre.layout_id,pre.layout_name,pre.layout_generic_name  
	FROM ".$SQL_tab_abrege['layout']." pre, ".$SQL_tab_abrege['layout_theme']." sp , ".$SQL_tab_abrege['theme_website']." ss 
	WHERE pre.layout_id = sp.layout_id 
	AND sp.theme_id = '".${$theme_tableau}['theme_id']."' 
	AND sp.theme_id = ss.theme_id 
	AND ss.ws_id = '".$website['ws_id']."' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { 
		$pv['TabPres'][$pv['ptr']]['id'] = $dbp['layout_id'];
		$pv['TabPres'][$pv['ptr']]['nom'] = $dbp['layout_name'];
		$pv['TabPres'][$pv['ptr']]['nom_generique'] = $dbp['layout_generic_name'];
		$pv['ptr']++;
	}
	unset ( $A );
	foreach ( $pv['TabPres'] as $A ) { $pv['o2l12'] .= "<option value='".$A['nom']."'>".$A['nom_generique']."</option>\r"; }
	$pv['o2l12'] .= "</select>\r";

	$pv['ptr'] = 0;
	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT * 
	FROM ".$SQL_tab_abrege['article_config']." 
	WHERE ws_id = '".$website['ws_id']."' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { 
		$pv['TabConfig'][$pv['ptr']]['id'] = $dbp['config_id'];
		$pv['TabConfig'][$pv['ptr']]['nom'] = $dbp['config_name'];
		$pv['ptr']++;
	}
	unset ( $A );
	foreach ( $pv['TabConfig'] as $A ) { $pv['o2l22'] .= "<option value='".$A['nom']."'>".$A['nom']."</option>\r"; }
	$pv['o2l22'] .= "</select>\r";


	$pv['ptr'] = 0;
	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT deadline_id,deadline_title,deadline_name  
	FROM ".$SQL_tab_abrege['deadline']."   
	WHERE ws_id = '".$website['ws_id']."' 
	AND deadline_state != '2' 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { 
		$pv['TabBouclage'][$pv['ptr']]['id'] = $dbp['deadline_id'];
		$pv['TabBouclage'][$pv['ptr']]['nom'] = $dbp['deadline_name'];
		$pv['TabBouclage'][$pv['ptr']]['titre'] = $dbp['deadline_title'];
		$pv['ptr']++;
	}
	unset ( $A );
	foreach ( $pv['TabBouclage'] as $A ) { $pv['o2l32'] .= "<option value='".$A['nom']."'>".$A['titre']."</option>\r"; }
	$pv['o2l32'] .= "</select>\r";


	$pv['ptr'] = 0;
	$dbquery = requete_sql($_REQUEST['sql_initiateur'],"
	SELECT doc.docu_id,doc.docu_name,doc.docu_type,shr.share_modification 
	FROM ".$SQL_tab_abrege['document']." doc, ".$SQL_tab_abrege['document_share']." shr 
	WHERE shr.ws_id = '".$website['ws_id']."' 
	AND shr.docu_id = doc.docu_id 
	;");
	while ($dbp = fetch_array_sql($dbquery)) { 
		$pv['TabDocument'][$pv['ptr']]['id'] = $dbp['docu_id'];
		$pv['TabDocument'][$pv['ptr']]['nom'] = $dbp['docu_name'];
		$pv['ptr']++;
	}
	unset ( $A );
	foreach ( $pv['TabDocument'] as $A ) { $pv['o3l12'] .= "<option value='".$A['nom']."'>".$A['nom']."</option>\r"; }
	$pv['o2l12'] .= "</select>\r";

break;
}

// --------------------------------------------------------------------------------------------
// Preparation des elements
// --------------------------------------------------------------------------------------------
$tl_['fra']['M_ARTICL_validation']['0'] = "Non valid&eacute;";	$tl_['eng']['M_ARTICL_validation']['0'] = "Not validated";
$tl_['fra']['M_ARTICL_validation']['1'] = "Valid&eacute;";		$tl_['eng']['M_ARTICL_validation']['1'] = "Validated";

// --------------------------------------------------------------------------------------------
//	Affichage
// --------------------------------------------------------------------------------------------
$tl_['eng']['invite1'] = "This component allows you to modify an online article. You can modify more parameter than a validator. Don't forget your modifycation will be visible online directly.";
$tl_['fra']['invite1'] = "Cette partie va vous permettre de mettre &agrave; jour un article d&eacute;j&agrave; en ligne. Vous pouvez modifier un plus grand nombre de param&egrave;tres de l'article qu'un validateur. N'oubliez pas que vos modifications vont &ecirc;tre vues directement en ligne.";

echo ("
<form ACTION='index.php?' method='post'>\r
<p>
".$tl_[$l]['invite1']."<br>\r
</p>\r

<br>\r
<hr>\r
");

$tl_['eng']['d1_01'] = "Name";						$tl_['fra']['d1_01'] = "Nom";
$tl_['eng']['d1_02'] = "Description";				$tl_['fra']['d1_02'] = "Description";
$tl_['eng']['d1_03'] = "Title";						$tl_['fra']['d1_03'] = "Titre";
$tl_['eng']['d1_04'] = "?";							$tl_['fra']['d1_04'] = "Sous-titre";
$tl_['eng']['d1_05'] = "Page";						$tl_['fra']['d1_05'] = "Page";

$tl_['eng']['d2_01'] = "Display";					$tl_['fra']['d2_01'] = "Pr&eacute;sentation";
$tl_['eng']['d2_02'] = "Article configuration";		$tl_['fra']['d2_02'] = "Configuration article";
$tl_['eng']['d2_03'] = "Deadline";					$tl_['fra']['d2_03'] = "Bouclage";

$tl_['eng']['d3_01'] = "Document";					$tl_['fra']['d3_01'] = "Document";

$tl_['eng']['d4_01'] = "Creation";					$tl_['fra']['d4_01'] = "Cr&eacute;ation";
$tl_['eng']['d4_02'] = "Validation";				$tl_['fra']['d4_02'] = "Validation";
$tl_['eng']['d4_03'] = "Publication";				$tl_['fra']['d4_03'] = "Parution";

$AD['1']['1']['1']['cont'] = $tl_[$l]['d1_01'];
$AD['1']['2']['1']['cont'] = $tl_[$l]['d1_02'];
$AD['1']['3']['1']['cont'] = $tl_[$l]['d1_03'];
$AD['1']['4']['1']['cont'] = $tl_[$l]['d1_04'];
$AD['1']['5']['1']['cont'] = $tl_[$l]['d1_05'];

$AD['2']['1']['1']['cont'] = $tl_[$l]['d2_01'];
$AD['2']['2']['1']['cont'] = $tl_[$l]['d2_02'];
$AD['2']['3']['1']['cont'] = $tl_[$l]['d2_03'];

$AD['3']['1']['1']['cont'] = $tl_[$l]['d3_01'];

$AD['4']['1']['1']['cont'] = $tl_[$l]['d4_01'];
$AD['4']['2']['1']['cont'] = $tl_[$l]['d4_02'];
$AD['4']['3']['1']['cont'] = $tl_[$l]['d4_03'];



$AD['1']['1']['2']['cont'] = $infos_article['arti_name'];
$AD['1']['2']['2']['cont'] = $infos_article['arti_desc'];
$AD['1']['3']['2']['cont'] = $infos_article['arti_title'];
$AD['1']['4']['2']['cont'] = $infos_article['arti_subtitle'];
$AD['1']['5']['2']['cont'] = $infos_article['arti_page'];

$AD['2']['1']['2']['cont'] = $pv['o2l12'];
$AD['2']['2']['2']['cont'] = $pv['o2l22'];
$AD['2']['3']['2']['cont'] = $pv['o2l32'];

$AD['3']['1']['2']['cont'] = $pv['o3l12'];

$AD['4']['1']['2']['cont'] = $pv['user_list'][$infos_article['arti_creator_id']]['user_login'] . " - " . strftime ("%a %d %b %y - %H:%M", $infos_article['arti_creation_date']) ;
$AD['4']['2']['2']['cont'] = $pv['user_list'][$infos_article['arti_validator_id']]['user_login'] . " - " . strftime ("%a %d %b %y - %H:%M", $infos_article['arti_validation_date']) . "(" . $tl_[$l]['M_ARTICL_validation'][$infos_article['arti_validation_state']] .")";
$AD['4']['3']['2']['cont'] = strftime ("%a %d %b %y - %H:%M", $infos_article['arti_release_date']);


$ADC['tabs']['1']['NbrOfLines'] = 5;	$ADC['tabs']['1']['NbrOfCells'] = 2;	$ADC['tabs']['1']['TableCaptionPos'] = 2;
$ADC['tabs']['2']['NbrOfLines'] = 3;	$ADC['tabs']['2']['NbrOfCells'] = 2;	$ADC['tabs']['2']['TableCaptionPos'] = 2;
$ADC['tabs']['3']['NbrOfLines'] = 1;	$ADC['tabs']['4']['NbrOfCells'] = 2;	$ADC['tabs']['3']['TableCaptionPos'] = 2;
$ADC['tabs']['4']['NbrOfLines'] = 3;	$ADC['tabs']['3']['NbrOfCells'] = 2;	$ADC['tabs']['4']['TableCaptionPos'] = 2;

$tl_['eng']['onglet_1'] = "Informations";		$tl_['fra']['onglet_1'] = "Informations";
$tl_['eng']['onglet_2'] = "Options";			$tl_['fra']['onglet_2'] = "Options";
$tl_['eng']['onglet_3'] = "Document";			$tl_['fra']['onglet_3'] = "Document";
$tl_['eng']['onglet_4'] = "Historic / State";	$tl_['fra']['onglet_4'] = "Historique / &eacute;tat";

$tab_infos['AffOnglet']			= 1;

switch ( $_REQUEST['uni_gestion_des_articles_p'] ) {
case 2:	$tab_infos['NbrOnglet']			= 4;	break;
case 3:	$tab_infos['NbrOnglet']			= 3;	break;
}
$tab_infos['tab_comportement']	= 1;
$tab_infos['TypSurbrillance']	= 0; // 1:ligne, 2:cellule
$tab_infos['mode_rendu']		= 0;	// 0 echo 1 dans une variable
$tab_infos['doc_height']		= 224;
$tab_infos['doc_width']			= ${$theme_tableau}['theme_module_internal_width'] -24 ;
$tab_infos['group']			= "maa_grp1";
$tab_infos['cell_id']			= "tab";
$tab_infos['document']			= "doc";
$tab_infos['cell_1_txt']		= $tl_[$l]['onglet_1'];
$tab_infos['cell_2_txt']		= $tl_[$l]['onglet_2'];
$tab_infos['cell_3_txt']		= $tl_[$l]['onglet_3'];
$tab_infos['cell_4_txt']		= $tl_[$l]['onglet_4'];
$tab_infos['cell_5_txt']		= $tl_[$l]['onglet_5'];
$tab_infos['cell_6_txt']		= $tl_[$l]['onglet_6'];
include ("engine/affichage_donnees.php");

// --------------------------------------------------------------------------------------------
switch ( $_REQUEST['uni_gestion_des_articles_p'] ) {
case 2:	
$tl_['eng']['bouton1'] = "Validate";									$tl_['fra']['bouton1'] = "Valider";
$tl_['eng']['text_confirm1'] = "I confirm the article validation.";		$tl_['fra']['text_confirm1'] = "Je confirme la validation de l'article.";
$pv['textebouton1'] = "<input type='checkbox' name='M_ARTICL[confirmation_modification]' value='1'>".$tl_[$l]['text_confirm1'];
$pv['bloc_type_hidden'] = "
<input type='hidden' name='arti_page'							value='1'>\r
<input type='hidden' name='M_ARTICL[nom]'						value='".$infos_article['arti_name']."'>\r
<input type='hidden' name='M_ARTICL[ref]'						value='".$infos_article['arti_ref']."'>\r
<input type='hidden' name='M_ARTICL[validation_etat]'			value='1'>\r
<input type='hidden' name='M_ARTICL[validation_validateur]'		value='".$user['login_decode']."'>\r
<input type='hidden' name='UPDATE_action'						value='UPDATE_ARTICLE'>\r
";

break;
case 3:	
$tl_['eng']['bouton1'] = "Create";									$tl_['fra']['bouton1'] = "Cr&eacute;er";
$tl_['eng']['text_confirm1'] = "This will create an article and directly moves you to the modification panel of this new article.";
$tl_['fra']['text_confirm1'] = "Ceci va cr&eacute;er un article et vous em&egrave;nera directement dans l'interface de modification de ce nouvel article.";
$pv['textebouton1'] = $tl_[$l]['text_confirm1'];
$pv['bloc_type_hidden'] = "
<input type='hidden' name='UPDATE_action'				value='ADD_ARTICLE'>\r
";

break;
}
$tl_['eng']['retour'] = "Return to list";								$tl_['fra']['retour'] = "Retour &agrave; la liste";

echo ("
<br>\r".
$bloc_html['post_hidden_sw'].
$bloc_html['post_hidden_l'].
$bloc_html['post_hidden_arti_ref'].
$bloc_html['post_hidden_user_login'].
$bloc_html['post_hidden_user_pass'].
$pv['bloc_type_hidden']."
<table ".${$theme_tableau}['tab_std_rules']." width='".${$theme_tableau}['theme_module_internal_width']."px;'>\r
<tr>\r
<td>\r".$pv['textebouton1']."\r</td>\r
<td style='text-align: right;'>\r");
$_REQUEST['BS']['id']				= "bouton_modification";
$_REQUEST['BS']['type']				= "submit";
$_REQUEST['BS']['style_initial']	= $theme_tableau . $_REQUEST['bloc']."_t3 " . $theme_tableau . $_REQUEST['bloc']."_submit_s2_n";
$_REQUEST['BS']['style_hover']		= $theme_tableau . $_REQUEST['bloc']."_t3 " . $theme_tableau . $_REQUEST['bloc']."_submit_s2_h";
$_REQUEST['BS']['onclick']			= "";
$_REQUEST['BS']['message']			= $tl_[$l]['bouton1'];
$_REQUEST['BS']['mode']				= 1;
$_REQUEST['BS']['taille'] 			= 128;
$_REQUEST['BS']['derniere_taille']	= 0;
echo generation_bouton ();
echo ("<br>\r&nbsp;
</td>\r
</tr>\r
</form>\r

<form ACTION='index.php?' method='post'>\r".
$bloc_html['post_hidden_sw'].
$bloc_html['post_hidden_l'].
$bloc_html['post_hidden_arti_ref']."
<input type='hidden' name='arti_page'	value='1'>\r".
$bloc_html['post_hidden_user_login'].
$bloc_html['post_hidden_user_pass']."
<tr>\r
<td>\r</td>\r
<td style='text-align: right;'>\r");
$_REQUEST['BS']['id']				= "bouton_retour_liste";
$_REQUEST['BS']['type']				= "submit";
$_REQUEST['BS']['style_initial']	= $theme_tableau . $_REQUEST['bloc']."_t3 " . $theme_tableau . $_REQUEST['bloc']."_submit_s1_n";
$_REQUEST['BS']['style_hover']		= $theme_tableau . $_REQUEST['bloc']."_t3 " . $theme_tableau . $_REQUEST['bloc']."_submit_s1_h";
$_REQUEST['BS']['onclick']			= "";
$_REQUEST['BS']['message']			= $tl_[$l]['retour'];
$_REQUEST['BS']['mode']				= 1;
$_REQUEST['BS']['taille'] 			= 0;
echo generation_bouton ();
echo ("<br>\r&nbsp;
</td>\r
</tr>\r
</form>\r
</table>\r
");

//outil_debug ( $infos_article , "\$infos_article" );

if ( $website['ws_info_debug'] < 10 ) { 
	unset (
		$A , 
		$dbp , 
		$dbquery , 
		$AD,
		$ADC,
		$pv , 
		$tab_infos , 
		$tl_
	); 
}

/*Hydr-Content-End*/
?>
