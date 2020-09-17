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

/**
 * 
 * @author faust
 * This class is responsible for holding document data (and some article data) when processed by the corresponding module. 
 * It is NOT the document entity found in the DAO. 
 * Those two are used differently.
 */
class DocumentData {
	private $DocumentName = "";
	private $DocumentData = array();
	
	public function __construct() {}
	
	public function getDocumentDataFromDB (){
		$SDDMObj = DalFacade::getInstance()->getDALInstance();
		$SqlTableListObj = SqlTableList::getInstance(null, null);
		$RequestDataObj = RequestData::getInstance();
		$LMObj = LogManagement::getInstance();
		
		$logTarget = $LMObj->getInternalLogTarget();
		$LMObj->setInternalLogTarget("both");
		
		$CurrentSetObj = CurrentSet::getInstance();
		$WebSiteObj = $CurrentSetObj->getInstanceOfWebSiteObj();
		$UserObj = $CurrentSetObj->getInstanceOfUserObj();
		
// 		Checks if we have a requested article 
// 		if ( !isset($_REQUEST['arti_ref']) || strlen($_REQUEST['arti_ref']) == 0 ) {
		if ( strlen($RequestDataObj->getRequestDataEntry('arti_ref')) == 0 ) {
			$LMObj->InternalLog("DocumentData:getDocumentDataFromDB - No arti_ref available. Getting first article");
			$dbquery = $SDDMObj->query ( "
			SELECT cat.cate_id, cat.cate_nom, cat.arti_ref
			FROM " . $SqlTableListObj->getSQLTableName('categorie') . " cat, " . $SqlTableListObj->getSQLTableName('bouclage') . " bcl
			WHERE cat.site_id = '" . $WebSiteObj->getWebSiteEntry ('sw_id'). "'
			AND cat.cate_lang = '" . $WebSiteObj->getWebSiteEntry ('sw_lang'). "'
			AND cat.bouclage_id = bcl.bouclage_id
			AND bcl.bouclage_etat = '1'
			AND cat.cate_type IN ('0','1')
			AND cat.groupe_id " . $UserObj->getUserEntry('clause_in_groupe')."
			AND cat.cate_etat = '1'
			AND cate_doc_premier = '1'
			ORDER BY cat.cate_parent,cat.cate_position
			;" );
			while ($dbp = $SDDMObj->fetch_array_sql($dbquery)) {
				$CurrentSetObj->setInstanceOfDocumentDataObj(new DocumentData());
				$CurrentSetObj->setDataSubEntry('document', 'arti_ref', $dbp['arti_ref']);
			}
			$CurrentSetObj->setDataSubEntry('document', 'arti_page', 1);
		}
		else {
			$CurrentSetObj->setDataSubEntry('document', 'arti_ref', $RequestDataObj->getRequestDataEntry('arti_ref'));
			$CurrentSetObj->setDataSubEntry('document', 'arti_page', $RequestDataObj->getRequestDataEntry('arti_page'));
		}
		
// 		We have an article to display whatever its ID is requested or forged
		$LMObj->InternalLog("DocumentData:getDocumentDataFromDB - arti_ref=`".$CurrentSetObj->getDataSubEntry('document', 'arti_ref')."`; arti_page=`".$CurrentSetObj->getDataSubEntry('document', 'arti_page')."`");
		$dbquery = $SDDMObj->query("
		SELECT art.*, doc.docu_id, doc.docu_nom, doc.docu_type,
		doc.docu_createur, doc.docu_creation_date,
		doc.docu_correcteur, doc.docu_correction_date,
		doc.docu_origine, doc.docu_cont, sit.sw_repertoire
		FROM ".$SqlTableListObj->getSQLTableName('article')." art, ".$SqlTableListObj->getSQLTableName('document')." doc, ".$SqlTableListObj->getSQLTableName('bouclage')." bcl, ".$SqlTableListObj->getSQLTableName('site_web')." sit
		WHERE art.arti_ref = '".$CurrentSetObj->getDataSubEntry('document', 'arti_ref')."'
		AND art.arti_page = '".$CurrentSetObj->getDataSubEntry('document', 'arti_page')."'
		AND art.docu_id = doc.docu_id
		AND art.site_id = '".$WebSiteObj->getWebSiteEntry('sw_id')."'
		AND sit.sw_id = doc.docu_origine
		AND art.arti_bouclage = bcl.bouclage_id
		AND bcl.bouclage_etat = '1'
		;");
		
		if ( $SDDMObj->num_row_sql($dbquery) == 0 ) {
			$LMObj->InternalLog("DocumentData:getDocumentDataFromDB - article not found");
			
			$dbquery = $SDDMObj->query("
			SELECT doc.*
			FROM ".$SqlTableListObj->getSQLTableName('document')." doc, ".$SqlTableListObj->getSQLTableName('document_share')." ds
			WHERE doc.docu_nom LIKE '%article_inexistant%'
			AND ds.docu_id = doc.docu_id
			AND ds.site_id = '".$WebSiteObj->getWebSiteEntry('sw_id')."'
			;");
		}
		
		while ($dbp = $SDDMObj->fetch_array_sql($dbquery)) {
			$LMObj->InternalLog("DocumentData:getDocumentDataFromDB - Loading data");
			foreach ( $dbp as $A => $B ) { $this->DocumentData[$A] = $B; }
		}
		$LMObj->setInternalLogTarget($logTarget);
	}
	
	//@formatter:off
	public function getDocumentName() { return $this->DocumentName;}
	public function getDocumentData() { return $this->DocumentData; }
	public function getDocumentDataEntry ($data) { return $this->DocumentData[$data]; }
	
	public function setDocumentName($DocumentName) { $this->DocumentName = $DocumentName; }
	public function setDocumentData($DocumentData) { $this->DocumentData = $DocumentData; }
	public function setDocumentDataEntry ($entry , $data) { $this->DocumentData[$entry] = $data; }
	//@formatter:on

}
?>