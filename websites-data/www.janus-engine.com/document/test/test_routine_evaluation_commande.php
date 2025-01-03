<?php
 /*JanusEngine-license-start*/
// --------------------------------------------------------------------------------------------
//
//	Janus Engine - Le petit moteur de web
//	Sous licence Creative Common	
//	Under Creative Common licence	CC-by-nc-sa (http://creativecommons.org)
//	CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
//	(c)Faust MARIA DE AREVALO faust@rootwave.net
//
// --------------------------------------------------------------------------------------------
/*JanusEngine-license-end*/

/*
Il faut que la fonction puisse agir de différente manière. 
Fournir le contenu utile dans un tableau qui donne chaque commande/requete.

Controle de la fin de la commande jusqu'à ";"
passage en mode X suivant ce que l'on trouve 
	comme spérateur ( ", ' ) 
	declaratif de commentaire ( //, /*) 
en tenant compte des multilignes



Cartogrpahie de l'expression entière
Parcour de la chaine encodée pour selectionner les modes et vérifier que la chaine est conforme.
*/


include ("engine/formattage_commande.php");

$tampon_commande = '
// fluffy the world destroyer is about to kill something. We will see if he gonna do the marshmallow.
commande arg 1 arg 2;
/*
+---------------------------------------+
|		Multi-Web Manager (MWM) 		|
|		www.multiweb-manager.net 		|
|		Initial Configuration site 		|
+---------------------------------------+
*/

add site 
name				"janus-engine-core" 
abrege				"JnsEngCore" 
lang 				"fra" 
lang_select			"YES" 
title 				"Janus Engine Core" 
home				"www.janus-engine.net" 
directory			"00_JanusEngineCore" 
debug_info_level	"1" 
stylesheet			"DYNAMIC" 
etat				"OFFLINE" 
group				"Server_owner" 
user				"*utilisateur_install*" 
password			"*utilisateur_install*"
;

site_context site janus-engine-core	user "*utilisateur_install*"	password "*utilisateur_install*";
show debug_off;
show checkpoint "Janus Engine Core critique - Debut";
variable "authorisation_moniteur"	"1";

/*----------------------------------------------------------------------------------------------------------------------------------*/
/*	Defnini la table des articles																									*/
/*----------------------------------------------------------------------------------------------------------------------------------*/
/* Clefs etrangeres   																												*/ 
/*----------------------------------------------------------------------------------------------------------------------------------*/
/*
arti_type					WMCODE 0	NOCODE 1	PHP 2	MIXED 3
arti_show_info				SHOW_INFO_OFF 0	SHOW_INFO_ON 1
arti_validation_state		NON_VALIDE 0	VALIDE 1
arti_correction_etat		NON_CORRIGE 0 CORRIGE 1
*/

CREATE TABLE !table! (
arti_id 					INTEGER NOT NULL,
arti_ref					VARCHAR(255),
deadline_id					INTEGER,
arti_name					VARCHAR(255),
arti_desc					VARCHAR(255),
arti_title					VARCHAR(255),
arti_subtitle				VARCHAR(255),
arti_page					INTEGER,

layout_generic_name			VARCHAR(255),
config_id					INTEGER,

arti_creator_id				INTEGER,
arti_creation_date			INTEGER,

arti_validator_id			INTEGER,
arti_validation_date		INTEGER,
arti_validation_state		INTEGER,

arti_release_date			INTEGER,
docu_id						INTEGER,
ws_id						INTEGER,

PRIMARY KEY (arti_id)
);


//plouf
';


$pv['TabAnalyseCommande'] = array( "plouf" );

cartographie_expression ( "//" , 1 , 99999 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( "\n" , 2 , 99998 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( "/*" , 3 , 99997 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( "*/" , 4 , 99996 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( "'"  , 5 , 99995 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( "\"" , 6 , 99994 , $tampon_commande , $pv['TabAnalyseCommande'] );
cartographie_expression ( ";"  , 7 , 99993 , $tampon_commande , $pv['TabAnalyseCommande'] );

$tampon_commande_rendu_idx = 0;
$tampon_commande_rendu = array();

ksort ($pv['TabAnalyseCommande']);
reset ($pv['TabAnalyseCommande']);
formattage_commande ( $pv['TabAnalyseCommande'] , $tampon_commande , $tampon_commande_rendu  );

echo ( "|".$tampon_commande_rendu['1']['cont'] . "|");
echo ("<hr>");
echo ( print_r_html ( $tampon_commande_rendu ) );
echo ("<hr>");
echo ( print_r_html ( $pv['TabAnalyseCommande'] ) );

outil_debug ( $pv['TabAnalyseCommande'] , "\$pv['TabAnalyseCommande']");
outil_debug ( $tampon_commande_rendu , "\$tampon_commande_rendu");

?>
