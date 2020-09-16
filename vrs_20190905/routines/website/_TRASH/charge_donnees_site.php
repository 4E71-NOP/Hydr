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

$localisation = " / charge_donnes_site";

$MapperObj->AddAnotherLevel($localisation );
$LMObj->logCheckpoint("charge_donnes_site");
$MapperObj->RemoveThisLevel($localisation );
$MapperObj->setSqlApplicant("Chargement des donnees du site");

$_REQUEST['localisation'] .= $localisation;
// statistique_checkpoint ("charge_donnes_site");
$_REQUEST['localisation'] = substr ( $_REQUEST['localisation'] , 0 , (0 - strlen( $localisation )) );
$_REQUEST['sql_initiateur'] = "Chargement des donnees du site";

// $dbquery = requete_sql($_REQUEST['sql_initiateur'],"
$dbquery = $SDDM->query("
SELECT *  
FROM ".$SQL_tab['site_web']." 
WHERE sw_id = '".$_REQUEST['sw']."' 
;");


// while ($dbp = fetch_array_sql($dbquery)) {
while ($dbp = $SDDM->fetch_array_sql($dbquery)) {
	foreach ( $dbp as $A => $B ) { $site_web[$A] = $B; }
}

$_REQUEST['site_context']['site_id'] = $site_web['sw_id'];			// Dédiée aux routines de manipulation

//journalisation_evenement ( 1 , $_REQUEST['sql_initiateur'] , "" , "INFO" , "" , $WebSiteObj->getSw_id(). "/" . $WebSiteObj->getSw_nom() );
// if ( $site_web['sw_info_debug'] < 2 ) { $_REQUEST['debug_option']['SQL_debug_level'] = 0; }
// if ( $site_web['sw_info_debug'] < 10 ) {
if ( $WebSiteObj->getWebSiteEntry('sw_info_debug') < 2 ) { $CMobj->setConfigurationEntry('DebugLevel_SQL', 0); }
if ( $WebSiteObj->getWebSiteEntry('sw_info_debug') < 10 ) {
	unset (
		$A,
		$B,
		$dbquery,
		$dbp
	);
}


?>
