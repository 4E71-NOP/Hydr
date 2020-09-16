<?php
/* Hydre-licence-debut */
// --------------------------------------------------------------------------------------------
//
// Hydre - Le petit moteur de web
// Sous licence Creative Common
// Under Creative Common licence CC-by-nc-sa (http://creativecommons.org)
// CC by = Attribution; CC NC = Non commercial; CC SA = Share Alike
//
// (c)Faust MARIA DE AREVALO faust@club-internet.fr
//
// --------------------------------------------------------------------------------------------
/* Hydre-licence-fin */
class ArticleTag {
	private $ArticleTag = array ();
	public function __construct() {
	}
	public function getArticleTagDataFromDB($data) {
		$SDDMObj = DalFacade::getInstance ()->getDALInstance ();
		$SqlTableListObj = SqlTableList::getInstance ( null, null );

		$dbquery = $SDDMObj->query ( "" );
		while ( $dbp = $SDDMObj->fetch_array_sql ( $dbquery ) ) {
			foreach ( $dbp as $A => $B ) { $this->ArticleTag [$A] = $B; }
		}
		
	}

	//@formatter:off
	public function getArticleTagEntry ($data) { return $this->ArticleTag[$data]; }
	public function getArticleTag() { return $this->ArticleTag; }
	
	public function setArticleTagEntry ($entry, $data) { 
		if ( isset($this->ArticleTag[$entry])) { $this->ArticleTag[$entry] = $data; }	//DB Entity objects do NOT accept new columns!  
	}

	public function setArticleTag($ArticleTag) { $this->ArticleTag = $ArticleTag; }
	//@formatter:off

}


?>