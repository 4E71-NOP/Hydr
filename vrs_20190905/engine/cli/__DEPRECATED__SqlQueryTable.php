<?php 


// Search Duplicate Article
// Search if Exists Article
// Articles
self::$SqlQueryTable['M_ARTICL_rda']['requete']		= "SELECT arti_id,arti_name FROM ".$SqlTableListObj->getSQLTableName('article')." WHERE arti_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_rda']['element']		= "Article";

self::$SqlQueryTable['M_ARTICL_reb']['requete']		= "SELECT deadline_id FROM ".$SqlTableListObj->getSQLTableName('deadline')." WHERE deadline_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_reb']['element']		= "Bouclage";
self::$SqlQueryTable['M_ARTICL_reb']['colone_1']	= "deadline_id";

self::$SqlQueryTable['M_ARTICL_reac']['requete']	= "SELECT config_id FROM ".$SqlTableListObj->getSQLTableName('article_config')." WHERE config_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_reac']['element']	= "Article_config";
self::$SqlQueryTable['M_ARTICL_reac']['colone_1']	= "config_id";

self::$SqlQueryTable['M_ARTICL_rec']['requete']		= "SELECT usr.user_id AS user_id, usr.user_login AS user_login FROM ".$SqlTableListObj->getSQLTableName('user')." usr, ".$SqlTableListObj->getSQLTableName('group_user')." gu, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE user_login = '<A1>' AND usr.user_id = gu.user_id AND gu.group_id = sg.group_id AND gu.group_user_initial_group = '1' AND sg.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_rec']['element']		= "Createur";
self::$SqlQueryTable['M_ARTICL_rec']['colone_1']	= "user_id";

self::$SqlQueryTable['M_ARTICL_rev']['requete']		= "SELECT usr.user_id AS user_id, usr.user_login AS user_login FROM ".$SqlTableListObj->getSQLTableName('user')." usr, ".$SqlTableListObj->getSQLTableName('group_user')." gu, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE user_login = '<A1>' AND usr.user_id = gu.user_id AND gu.group_id = sg.group_id AND gu.group_user_initial_group = '1' AND sg.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_rev']['element']		= "Validateur";
self::$SqlQueryTable['M_ARTICL_rev']['colone_1']	= "user_id";

self::$SqlQueryTable['M_ARTICL_rep']['requete']		= "SELECT usr.layout_id AS layout_id, usr.layout_generic_name AS layout_generic_name FROM ".$SqlTableListObj->getSQLTableName('layout')." usr , ".$SqlTableListObj->getSQLTableName('layout_theme')." sp WHERE layout_generic_name = '<A1>' AND usr.layout_id = sp.layout_id AND sp.theme_id = '<A2>';";
self::$SqlQueryTable['M_ARTICL_rep']['element']		= "Presentation";
self::$SqlQueryTable['M_ARTICL_rep']['colone_1']	= "layout_generic_name";

self::$SqlQueryTable['M_ARTICL_rea']['requete']		= "SELECT arti_id,arti_name FROM ".$SqlTableListObj->getSQLTableName('article')." WHERE arti_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_rea']['element']		= "Article";
self::$SqlQueryTable['M_ARTICL_rea']['colone_1']	= "arti_id";

self::$SqlQueryTable['M_ARTICL_red']['requete']		= "SELECT doc.docu_id AS docu_id, doc.docu_name AS docu_name FROM ".$SqlTableListObj->getSQLTableName('document')." doc , ".$SqlTableListObj->getSQLTableName('document_share')." dp WHERE doc.docu_name = '<A1>' AND dp.docu_id = doc.docu_id AND dp.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTICL_red']['element']		= "Document";
self::$SqlQueryTable['M_ARTICL_red']['colone_1']	= "docu_id";

// Article config
self::$SqlQueryTable['M_ARTCFG_rdac']['requete']	= "SELECT config_id FROM ".$SqlTableListObj->getSQLTableName('article_config')." WHERE config_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_ARTCFG_rdac']['element']	= "Article_config";

// Bouclage
self::$SqlQueryTable['M_BOUCLG_rdb']['requete']		= "SELECT deadline_id FROM ".$SqlTableListObj->getSQLTableName('deadline')." WHERE deadline_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_BOUCLG_rdb']['element']		= "Bouclage";
self::$SqlQueryTable['M_BOUCLG_reb']['requete']		= "SELECT deadline_id FROM ".$SqlTableListObj->getSQLTableName('deadline')." WHERE deadline_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_BOUCLG_reb']['element']		= "Bouclage";
self::$SqlQueryTable['M_BOUCLG_reb']['colone_1']	= "deadline_id";

// Categorie
self::$SqlQueryTable['M_CATEGO_rdc']['requete']		= "SELECT cate_id FROM ".$SqlTableListObj->getSQLTableName('category')." WHERE ws_id = '".$webSiteId."' AND cate_name = '<A1>';";
self::$SqlQueryTable['M_CATEGO_rdc']['element']		= "Categorie";
self::$SqlQueryTable['M_CATEGO_rep']['requete']		= "SELECT cate_id FROM ".$SqlTableListObj->getSQLTableName('category')." WHERE ws_id = '".$webSiteId."' AND cate_name = '<A1>';";
self::$SqlQueryTable['M_CATEGO_rep']['element']		= "Categorie";
self::$SqlQueryTable['M_CATEGO_rep']['colone_1']	= "cate_id";
self::$SqlQueryTable['M_CATEGO_reb']['requete']		= "SELECT deadline_id FROM ".$SqlTableListObj->getSQLTableName('deadline')." WHERE deadline_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_CATEGO_reb']['element']		= "Bouclage";
self::$SqlQueryTable['M_CATEGO_reb']['colone_1']	= "deadline_id";
self::$SqlQueryTable['M_CATEGO_reg']['requete']		= "SELECT grp.group_name, grp.group_id FROM ".$SqlTableListObj->getSQLTableName('group')." grp , ".$SqlTableListObj->getSQLTableName('group_website')." sg  WHERE sg.ws_id = '".$webSiteId."' AND grp.group_name = '<A1>' AND grp.group_id = sg.group_id;";
self::$SqlQueryTable['M_CATEGO_reg']['element']		= "Groupe";
self::$SqlQueryTable['M_CATEGO_reg']['colone_1']	= "group_id";
self::$SqlQueryTable['M_CATEGO_rrp']['requete']		= "SELECT cate_id FROM ".$SqlTableListObj->getSQLTableName('category')." WHERE ws_id = '".$webSiteId."' AND cate_role = '2' AND cate_lang = '".$A['Context']['ws_lang']."';";
self::$SqlQueryTable['M_CATEGO_rrp']['element']		= "Categorie";
self::$SqlQueryTable['M_CATEGO_rrp']['colone_1']	= "cate_id";

//decoration
self::$SqlQueryTable['M_DECORA_rddec']['requete']	= "SELECT deco_name FROM ".$SqlTableListObj->getSQLTableName('decoration')." WHERE deco_name = '<A1>';";
self::$SqlQueryTable['M_DECORA_rddec']['element']	= "Decoration";
self::$SqlQueryTable['M_DECORA_redec']['requete']	= "SELECT deco_ref_id FROM ".$SqlTableListObj->getSQLTableName('decoration')." WHERE deco_name = '<A1>';";
self::$SqlQueryTable['M_DECORA_redec']['element']	= "Decoration";
self::$SqlQueryTable['M_DECORA_redec']['colone_1']	= "deco_ref_id";

//	self::$SqlQueryTable['M_DECORA_rtdec']['requete']	= "SELECT deco_type FROM ".$SqlTableListObj->getSQLTableName('decoration']." WHERE deco_id = '<A1>';";
//	self::$SqlQueryTable['M_DECORA_rtdec']['element']	= "Decoration";
//	self::$SqlQueryTable['M_DECORA_rtdec']['colone_1']	= "deco_type";

// Document
self::$SqlQueryTable['M_DOCUME_rdd']['requete']		= "SELECT docu_id,docu_name FROM ".$SqlTableListObj->getSQLTableName('document')." WHERE docu_name = '<A1>';";
self::$SqlQueryTable['M_DOCUME_rdd']['element']		= "Document";
self::$SqlQueryTable['M_DOCUME_red']['requete']		= "SELECT docu_id,docu_name FROM ".$SqlTableListObj->getSQLTableName('document')." WHERE docu_name = '<A1>';";
self::$SqlQueryTable['M_DOCUME_red']['element']		= "Document";
self::$SqlQueryTable['M_DOCUME_red']['colone_1']	= "docu_id";
self::$SqlQueryTable['M_DOCUME_res']['requete']		= "SELECT ws_id FROM ".$SqlTableListObj->getSQLTableName('website')." WHERE ws_name = '<A1>';";
self::$SqlQueryTable['M_DOCUME_res']['element']		= "Site";
self::$SqlQueryTable['M_DOCUME_res']['colone_1']	= "ws_id";
self::$SqlQueryTable['M_DOCUME_rep']['requete']		= "SELECT share_id FROM ".$SqlTableListObj->getSQLTableName('document_share')." WHERE ws_id = '".$webSiteId."' AND docu_id = '<A1>';";
self::$SqlQueryTable['M_DOCUME_rep']['element']		= "Share";

// Groupe
self::$SqlQueryTable['M_GROUPE_rdg']['requete']		= "SELECT grp.group_id FROM ".$SqlTableListObj->getSQLTableName('group')." grp , ".$SqlTableListObj->getSQLTableName('group_website')." sg , ".$SqlTableListObj->getSQLTableName('website')." ws WHERE grp.group_name = '<A1>' AND grp.group_id = sg.group_id AND sg.ws_id = ws.ws_id AND ws.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_GROUPE_rdg']['element']		= "Groupe";
self::$SqlQueryTable['M_GROUPE_reg']['requete']		= "SELECT grp.group_id FROM ".$SqlTableListObj->getSQLTableName('group')." grp , ".$SqlTableListObj->getSQLTableName('group_website')." sg , ".$SqlTableListObj->getSQLTableName('website')." ws WHERE grp.group_name = '<A1>' AND grp.group_id = sg.group_id AND sg.ws_id = ws.ws_id AND ws.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_GROUPE_reg']['element']		= "Groupe";
self::$SqlQueryTable['M_GROUPE_reg']['colone_1']	= "group_id";

// Module
self::$SqlQueryTable['M_MODULE_rdm']['requete']		= "SELECT mdl.module_id FROM ".$SqlTableListObj->getSQLTableName('module')." mdl , ".$SqlTableListObj->getSQLTableName('module_website')." sm WHERE mdl.module_name = '<A1>' AND mdl.module_id = sm.module_id AND sm.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_MODULE_rdm']['element']		= "Module";
self::$SqlQueryTable['M_MODULE_regpv']['requete']	= "SELECT grp.group_id AS group_id, grp.group_name AS group_name FROM ".$SqlTableListObj->getSQLTableName('group')." grp, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE grp.group_name = '<A1>' AND grp.group_id = sg.group_id AND sg.ws_id = '".$_REQUEST['site_context']['ws_id']."';";
self::$SqlQueryTable['M_MODULE_regpv']['element']	= "Groupe";
self::$SqlQueryTable['M_MODULE_regpv']['colone_1']	= "group_id";
self::$SqlQueryTable['M_MODULE_regpu']['requete']	= "SELECT grp.group_id AS group_id, grp.group_name AS group_name FROM ".$SqlTableListObj->getSQLTableName('group')." grp, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE grp.group_name = '<A1>' AND grp.group_id = sg.group_id AND sg.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_MODULE_regpu']['element']	= "";
self::$SqlQueryTable['M_MODULE_regpu']['colone_1']	= "group_id";

// Mot cle
self::$SqlQueryTable['M_MOTCLE_rdmc']['requete']	= "SELECT keyword_id FROM ".$SqlTableListObj->getSQLTableName('keyword')." WHERE keyword_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_MOTCLE_rdmc']['element']	= "Mot cle";
self::$SqlQueryTable['M_MOTCLE_remc']['requete']	= "SELECT keyword_id FROM ".$SqlTableListObj->getSQLTableName('keyword')." WHERE keyword_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_MOTCLE_remc']['element']	= "Mot cle";
self::$SqlQueryTable['M_MOTCLE_remc']['colone_1']	= "keyword_id";

// Presentation
self::$SqlQueryTable['M_PRESNT_rdp']['requete']		= "SELECT layout_id,layout_name FROM ".$SqlTableListObj->getSQLTableName('layout')." WHERE layout_name = '<A1>';";
self::$SqlQueryTable['M_PRESNT_rdp']['element']		= "Presentation";
self::$SqlQueryTable['M_PRESNT_rep']['requete']		= "SELECT layout_id FROM ".$SqlTableListObj->getSQLTableName('layout')." WHERE layout_name = '<A1>';";
self::$SqlQueryTable['M_PRESNT_rep']['element']		= "Presentation";
self::$SqlQueryTable['M_PRESNT_rep']['colone_1']		= "layout_id";
self::$SqlQueryTable['M_PRESNT_res']['requete']		= "SELECT sd.theme_id AS theme_id, sd.theme_name AS theme_name FROM ".$SqlTableListObj->getSQLTableName('theme_descriptor')." sd, ".$SqlTableListObj->getSQLTableName('theme_website')." ss WHERE sd.theme_name = '<A1>' AND sd.theme_id = ss.theme_id AND ss.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_PRESNT_res']['element']		= "Skin";
self::$SqlQueryTable['M_PRESNT_res']['colone_1']		= "theme_id";

// Theme
self::$SqlQueryTable['M_THEME_rdt']['requete']		= "SELECT sd.theme_id, sd.theme_name FROM ".$SqlTableListObj->getSQLTableName('theme_descriptor')." sd, ".$SqlTableListObj->getSQLTableName('theme_website')." ss WHERE sd.theme_name = '<A1>' AND sd.theme_id = ss.theme_id AND ss.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_THEME_rdt']['element']		= "Theme";
self::$SqlQueryTable['M_THEME_rdt']['colone_1']		= "theme_id";
self::$SqlQueryTable['M_THEME_ret']['requete']		= "SELECT sd.theme_id, sd.theme_name FROM ".$SqlTableListObj->getSQLTableName('theme_descriptor')." sd, ".$SqlTableListObj->getSQLTableName('theme_website')." ss WHERE sd.theme_name = '<A1>' AND sd.theme_id = ss.theme_id AND ss.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_THEME_ret']['element']		= "Theme";
self::$SqlQueryTable['M_THEME_ret']['colone_1']		= "theme_id";

// Tag
// 2017 12 23
// Usage de BINARY à cause de la collation : utf8mb4_general_ci
// https://stackoverflow.com/questions/5629111/how-can-i-make-sql-case-sensitive-string-comparison-on-mysql
// http://mysqlserverteam.com/new-collations-in-mysql-8-0-0/
self::$SqlQueryTable['M_TAG_rdt']['requete']		= "SELECT tag_id,tag_name FROM ".$SqlTableListObj->getSQLTableName('tag')." WHERE BINARY tag_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_TAG_rdt']['element']		= "Tag";
self::$SqlQueryTable['M_TAG_ret']['requete']		= "SELECT tag_id,tag_name FROM ".$SqlTableListObj->getSQLTableName('tag')." WHERE BINARY tag_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_TAG_ret']['element']		= "Tag";
self::$SqlQueryTable['M_TAG_ret']['colone_1']		= "tag_id";
self::$SqlQueryTable['M_TAG_rea']['requete']		= "SELECT arti_id,arti_name FROM ".$SqlTableListObj->getSQLTableName('article')." WHERE arti_name = '<A1>' AND ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_TAG_rea']['element']		= "Article";
self::$SqlQueryTable['M_TAG_rea']['colone_1']		= "arti_id";
self::$SqlQueryTable['M_TAG_rela']['requete']		= "SELECT tag_id FROM ".$SqlTableListObj->getSQLTableName('article_tag')." WHERE tag_id = '<A1>' AND arti_id = '<A2>';";
self::$SqlQueryTable['M_TAG_rela']['element']		= "Liaison";

// User
// Look for duplicate Login
// check if Login exists
// check if Site exists
// check if Groupe exists
// check if Relation (Groupe_user) exists
self::$SqlQueryTable['M_UTILIS_rdl']['requete']		= "SELECT usr.user_id AS user_id, usr.user_login AS user_login FROM ".$SqlTableListObj->getSQLTableName('user')." usr, ".$SqlTableListObj->getSQLTableName('group_user')." gu, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE usr.user_login = '<A1>' AND usr.user_id = gu.user_id AND gu.group_id = sg.group_id AND gu.group_user_initial_group = '1' AND sg.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_UTILIS_rdl']['element']		= "Utilisateur";
self::$SqlQueryTable['M_UTILIS_rel']['requete']		= "SELECT usr.user_id AS user_id, usr.user_login AS user_login FROM ".$SqlTableListObj->getSQLTableName('user')." usr, ".$SqlTableListObj->getSQLTableName('group_user')." gu, ".$SqlTableListObj->getSQLTableName('group_website')." sg WHERE usr.user_login = '<A1>' AND usr.user_id = gu.user_id AND gu.group_id = sg.group_id AND gu.group_user_initial_group = '1' AND sg.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_UTILIS_rel']['element']		= "Utilisateur";
self::$SqlQueryTable['M_UTILIS_rel']['colone_1']	= "user_id";
self::$SqlQueryTable['M_UTILIS_res']['requete']		= "SELECT sd.theme_id AS theme_id, sd.theme_name AS theme_name FROM ".$SqlTableListObj->getSQLTableName('theme_descriptor')." sd , ".$SqlTableListObj->getSQLTableName('theme_website')." ss WHERE sd.theme_name = '<A1>' AND sd.theme_id = ss.theme_id AND ss.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_UTILIS_res']['element']		= "Theme";
self::$SqlQueryTable['M_UTILIS_res']['colone_1']	= "theme_id";
self::$SqlQueryTable['M_UTILIS_reg']['requete']		= "SELECT grp.group_id AS group_id FROM ".$SqlTableListObj->getSQLTableName('group')." grp , ".$SqlTableListObj->getSQLTableName('group_website')." sg , ".$SqlTableListObj->getSQLTableName('website')." ws WHERE grp.group_name = '<A1>' AND grp.group_id = sg.group_id AND sg.ws_id = ws.ws_id AND ws.ws_id = '".$webSiteId."';";
self::$SqlQueryTable['M_UTILIS_reg']['element']		= "Groupe";
self::$SqlQueryTable['M_UTILIS_reg']['colone_1']	= "group_id";
self::$SqlQueryTable['M_UTILIS_rer']['requete']		= "SELECT group_user_id, group_id, user_id, group_user_initial_group FROM ".$SqlTableListObj->getSQLTableName('group_user')." WHERE group_id = '<A1>' AND user_id = '<A2>';";
self::$SqlQueryTable['M_UTILIS_rer']['element']		= "Relation";


?>