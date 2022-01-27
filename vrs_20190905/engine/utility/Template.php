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

class Template {
	private static $Instance = null;

	private static $ConvertTable = array();
	
	/**
	 * Singleton : Will return the instance of this class.
	 * @return Template
	 */
	public static function getInstance() {
		if (self::$Instance == null) {
			self::$Instance = new Template ();
		}
		return self::$Instance;
	}
	
	/**
	 * Renders the last part of an admin page.
	 * It's composed of 2 to 3 buttons in several forms that will post common commands. This will end a previously opened form. Don't forget to open it. 
	 * @param array $infos
	 * @param array $i18n
	 * @return string
	 */
	public function renderAdminFormButtons (&$infos) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$Content = "
			<table style='width:100%; border-spacing: 16px;'>\r
			<tr>\r
			<td>
			<div style='display:block; width:100%; height:100%' 
				onmouseover=\"this.parentNode.style.backgroundColor='#00000020';\" 
				onmouseout=\"this.parentNode.style.backgroundColor='transparent';\" 
				onclick=\"elm.Gebi('confirmCheckboxEdit').checked ^= 1;\">\r
			";
		
		switch ( $bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode') ) {
			case "delete":
			case "edit":	$Content .= "<input type='checkbox' id='confirmCheckboxEdit' name='formGenericData[modification]'>".$bts->I18nTransObj->getI18nTransEntry('updateConfirm');		break;
			case "create":	$Content .= "<input type='checkbox' id='confirmCheckboxEdit' name='formGenericData[creation]'>"
				.$bts->I18nTransObj->getI18nTransEntry('createEditConfirm')
				."<input type='hidden' name='formGenericData[modification]'		value='on'>\r"
				;
			break;
		}
		$Content .= "
		</div>\r
		</td>\r
		<td align='right'>\r
		";
				
		$btnTxtTab = array(
				"delete"	=>	$bts->I18nTransObj->getI18nTransEntry('btnDelete'),
				"edit"		=>	$bts->I18nTransObj->getI18nTransEntry('btnUpdate'),
				"create"	=>	$bts->I18nTransObj->getI18nTransEntry('btnCreate'),
		);
		
		$SB = $bts->InteractiveElementsObj->getDefaultSubmitButtonConfig(
			$infos , 'submit', 
			$btnTxtTab[$bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode')], 192, 
			'updateButton', 
			2, 2, 
			""
		);
		$Content .= $bts->InteractiveElementsObj->renderSubmitButton($SB);
		
		$Content .= "</td>\r
		</tr>\r"
		."</form>\r
		
		<!-- __________Return button__________ -->\r
		<form ACTION='index.php?' method='post'>\r"
		."<input type='hidden'	name='formSubmitted'			value='1'>\r"
		."<input type='hidden'	name='formGenericData[origin]'	value='AdminDashboard'>\r"
		."<input type='hidden'	name='formGenericData[mode]'	value='routing'>\r"
		."<input type='hidden'	name='newRoute[arti_slug]'		value='".$CurrentSetObj->getDataSubEntry ( 'article', 'arti_slug')."'>\r"
		."<input type='hidden'	name='newRoute[arti_page]'		value='1'>\r"
		."
		<tr>\r
		<td>\r
		</td>\r
		<td align='right'>\r
		";
		
		$SB = array_merge($SB, $SB = $bts->InteractiveElementsObj->getDefaultSubmitButtonConfig(
			$infos , 'submit', 
			$bts->I18nTransObj->getI18nTransEntry('btnReturn'), 0, 
			'returnButton', 
			1, 1,
			"",1)
		);
		$Content .= $bts->InteractiveElementsObj->renderSubmitButton($SB);
		
		$Content .= "</td>\r
		</tr>\r
		</form>\r
		";
		
		switch ( $bts->RequestDataObj->getRequestDataSubEntry('formGenericData', 'mode') ) {
			case "delete":
			case "edit":
				$Content .= "
				<!-- __________Delete button__________ -->\r
				<form ACTION='index.php?' method='post'>\r"
				."<input type='hidden'	name='formSubmitted'						value='1'>\r"
				."<input type='hidden'	name='formGenericData[origin]'				value='AdminDashboard'>\r"
				."<input type='hidden'	name='formGenericData[mode]'				value='delete'>\r"
				."<input type='hidden'	name='newRoute[arti_slug]'					value='".$CurrentSetObj->getDataSubEntry ( 'article', 'arti_slug')."'>\r"
				."<input type='hidden'	name='newRoute[arti_page]'					value='1'>\r"
				."<input type='hidden'	name='".$infos['formName']."[selectionId]'	value='".$bts->RequestDataObj->getRequestDataSubEntry($infos['formName'], 'selectionId')."'>\r"
				."
				<tr>\r
				<td>\r
				<div style='display:block; width:100%; height:100%' 
				onmouseover=\"this.parentNode.style.backgroundColor='#00000020';\" 
				onmouseout=\"this.parentNode.style.backgroundColor='transparent';\" 
				onclick=\"elm.Gebi('confirmCheckboxDelete').checked ^= 1;\">\r
				<input type='checkbox' id='confirmCheckboxDelete' name='formGenericData[deletion]'>".$bts->I18nTransObj->getI18nTransEntry('deleteConfirm')."
				</div>\r
				</td>\r
				<td align='right'>\r
				";
				
				$SB = array_merge($SB, $bts->InteractiveElementsObj->getDefaultSubmitButtonConfig(
					$infos , 'submit', 
					$bts->I18nTransObj->getI18nTransEntry('btnDelete'), 0, 
					'deleteButton', 
					3, 3, 
					"",1)
				);
				$Content .= $bts->InteractiveElementsObj->renderSubmitButton($SB);
				
				$Content .= "
				</td>\r
				</tr>\r
				</form>\r
				";
				break;
		}
		
		
		$Content .= "</table>\r";
		return $Content;
		
	}
	
	/**
	 * renderAdminCreateButton
	 * @param array $infos
	 * @return string
	 * 
	 */
	public function renderAdminCreateButton (&$infos) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$Block = $CurrentSetObj->getInstanceOfThemeDataObj()->getThemeName().$infos['block'];
		$bareTableClass = $CurrentSetObj->getInstanceOfThemeDataObj()->getThemeName()."bareTable";
		
		$Content = "
			<table class='".$bareTableClass."' style='padding:16px'>\r
			<tr>\r
			<td>\r
			<form ACTION='' method='post'>\r"
			."<input type='hidden'	name='formSubmitted'						value='1'>\r"
			."<input type='hidden'	name='newRoute[arti_slug]'					value='".$CurrentSetObj->getDataSubEntry ( 'article', 'arti_slug')."'>\r"
			."<input type='hidden'	name='newRoute[arti_page]'					value='2'>\r"
			."<input type='hidden'	name='formGenericData[mode]'				value='create'>\r"
			;
		

		$SB = $bts->InteractiveElementsObj->getDefaultSubmitButtonConfig(
			$infos , 'submit', 
			$bts->I18nTransObj->getI18nTransEntry('btnCreate'), 128, 
			'createButton', 
			2, 2, 
			"",1
		);
		$Content .= $bts->InteractiveElementsObj->renderSubmitButton($SB);
		
		$Content .= "<br>\r&nbsp;
		</form>\r
		</td>\r
		</tr>\r
		</table>\r
		<br>\r
		";
		return $Content;
	}

	/**
	 * Renders a page selector
	 * @param array $data
	 * @return string
	 */
	public function renderPageSelector ($data) {
		$bts = BaseToolSet::getInstance();

		$Content = "<div style='text-align:center; item-align:center; margin:0 auto;'>\r";
		if ( strlen($data['selectionOffset']) == 0 ) { $data['selectionOffset'] = 0 ;}
		if ( $data['nbrPerPage'] != 0 ) {
			$data['PageNbr'] = $data['ItemsCount'] / $data['nbrPerPage'] ;
			$data['remainder'] = $data['ItemsCount'] % $data['nbrPerPage'];
			if ( $data['remainder'] > 0 ) { $data['PageNbr']++;}
			$data['pageCounter'] = 0;
			for ( $i = 1 ; $i <= $data['PageNbr'] ; $i++) {
				if ( $data['selectionOffset'] != $data['pageCounter'] ) {
					$Content .= "<a style='display:inline;' href='"
					."index.php?filterForm[selectionOffset]=".$data['pageCounter']
					.$data['link']
					."'>"
					.$data['elmIn']
					.$i
					.$data['elmOut']
					."</a>\r"
					;
				}
				else { $Content .= $data['elmInHighlight'].$i.$data['elmOut']."\r"; }
				$data['pageCounter']++;
			}
		}
		$Content .= "</div>\r";
		return $Content;
	}


	/**
	 * renderFilterForm
	 * @return string
	 */
	public function renderFilterForm ($infos) {
		$bts = BaseToolSet::getInstance();
		$CurrentSetObj = CurrentSet::getInstance();
		
		$SB = $bts->InteractiveElementsObj->getDefaultSubmitButtonConfig(
			$infos , 'submit', 
			$bts->I18nTransObj->getI18nTransEntry('pageSelectorBtnFilter'), 128, 
			'refreshButton', 
			1, 1, 
			"" 
		);
		
		$Content = "</form>\r
		<form ACTION='index.php?' method='post'>\r"
		."<table class='".$CurrentSetObj->getInstanceOfThemeDataObj()->getThemeName()."bareTable' style='width:50%; margin-left:auto; margin-right:0px;'>\r"
		."<tr>\r"
		."<td>".$bts->I18nTransObj->getI18nTransEntry('pageSelectorQueryLike')."</td>\r"
		."<td><input type='text' name='filterForm[query_like]' size='15' value='".$bts->RequestDataObj->getRequestDataSubEntry('filterForm', 'query_like')."'></td>\r"
		."</tr>\r"

		."<tr>\r"
		."<td>".$bts->I18nTransObj->getI18nTransEntry('pageSelectorDisplay')."</td>\r"
		."<td><input type='text' name='filterForm[nbrPerPage]' size='2' value='".$bts->RequestDataObj->getRequestDataSubEntry('filterForm', 'nbrPerPage')."'> "
		.$bts->I18nTransObj->getI18nTransEntry('pageSelectorNbrPerPage')
		."</td>\r"
		."</tr>\r"
		.$infos['insertLines']
		
		."<tr>\r"
		."<td></td>\r"
		."<td>\r<br>\r"
		.$bts->InteractiveElementsObj->renderSubmitButton($SB)
		."</td>\r"
		."</tr>\r"
		
		."</table>\r"
		."</form>\r"
		;
		
		return $Content;
	}


}