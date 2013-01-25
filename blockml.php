<?php
/*
 * Module ......: blockml
 * File ........: blockml.php
 * Description .: Simple Prestashop Module to able Mercado Livre Link on Template
 * Authot ......: Luis Machado Reis <luis.reis@singularideas.com.br>
 * Licence .....: GNU Lesser General Public License V3
 * Created .....: 01/09/2010
 */

class blockml extends Module {

	private $_html = '';
	
	private $enabled = '';
	private $type = '';
	private $customerId = '';
	private $customerSize = '';
	private $eshopId = '';
	
	function __construct() {
		$this->name = 'blockml';
		parent::__construct();

		$this->tab = 'SingularIdeas.com.br Modules';
		$this->version = '0.1';
		$this->displayName = $this->l('Mercado Livre Block');
		$this->description = $this->l('Redirect your customers to MercadoLivre.com.br');

		$this->_refresh();
	}

	function install() {
		if (parent::install() == false || $this->registerHook('leftColumn') == false) {
			return false;
		}
				
		return true;
	}

	public function getContent() {
		if (Tools::isSubmit('submit')) {
			$this->_update();
		}

		$this->_displayForm();
		return $this->_html;
	}
	
	public function _displayForm() {
		$this->_refresh();
		$this->_html .= '
			<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
				<fieldset>
					<legend><img src="../modules/'.$this->name.'/logo.gif" />'.$this->l('Mercado Livre Block Configuration').'</legend>
					<label>'.$this->l('Visible').'</label>
					<div class="margin-form">
						<input type="radio" name="enabled" value="true" '.(($this->enabled == 'true')?'CHECKED':'').'/>&nbsp;'.$this->l('Enabled').'&nbsp;&nbsp;
						<input type="radio" name="enabled" value="false" '.(($this->enabled == 'false')?'CHECKED':'').'/>&nbsp;'.$this->l('Disabled').'&nbsp;
					</div>

					<label>'.$this->l('Type').'</label>
					<div class="margin-form">
						<input type="radio" name="type" value="customer" '.(($this->type == 'customer')?'CHECKED':'').'/>&nbsp;'.$this->l('Customer').'&nbsp;&nbsp;
						<input type="radio" name="type" value="eshop" '.(($this->type == 'eshop')?'CHECKED':'').'/>&nbsp;'.$this->l('E-shop').'&nbsp;
					</div>

					<label>'.$this->l('Customer Id').'</label>
					<div class="margin-form">
						<input type="text" name="customerId" value="'.$this->customerId.'"/>
					</div>

					<label>'.$this->l('Customer Showcase').'</label>
					<div class="margin-form">
						<input type="radio" name="customerSize" value="normal" '.(($this->customerSize == 'normal')?'CHECKED':'').'/>&nbsp;'.$this->l('Normal').'&nbsp;&nbsp;
						<input type="radio" name="customerSize" value="large" '.(($this->customerSize == 'large')?'CHECKED':'').'/>&nbsp;'.$this->l('Large').'&nbsp;
					</div>

					<label>'.$this->l('E-shop Id').'</label>
					<div class="margin-form">
						<input type="text" name="eshopId" value="'.$this->eshopId.'"/>
					</div>
					<input type="submit" name="submit" value="'.$this->l('Update').'" class="button" />
				</fieldset>
			</form>';	
	}

	/**
	* Returns module content for left column
	*
	* @param array $params Parameters
	* @return string Content
	*
	* @todo Links on tags (dedicated page or search ?)
	*/
	function hookLeftColumn($params) {
		global $smarty;

		$smarty->assign('enabled', $this->enabled);
		$smarty->assign('type', $this->type);
		$smarty->assign('customerId', $this->customerId);
		$smarty->assign('customerSize', $this->customerSize);
		$smarty->assign('eshopId', $this->eshopId);
		$smarty->assign('linkPrefixImg', "/modules/blockml/img");
		

		return $this->display(__FILE__, 'blockml.tpl');
	}

	function hookRightColumn($params) {
		return $this->hookLeftColumn($params);
	}

	private function _refresh() {
		$this->enabled = Configuration::get($this->name.'_enabled');
		$this->type = Configuration::get($this->name.'_type');
		$this->customerId = Configuration::get($this->name.'_customerId');
		$this->customerSize = Configuration::get($this->name.'_customerSize');
		$this->eshopId = Configuration::get($this->name.'_eshopId');
	}
	
	private function _update() {
		Configuration::updateValue($this->name.'_enabled', Tools::getValue('enabled'));
		Configuration::updateValue($this->name.'_type', Tools::getValue('type'));
		Configuration::updateValue($this->name.'_customerId', Tools::getValue('customerId'));
		Configuration::updateValue($this->name.'_customerSize', Tools::getValue('customerSize'));
		Configuration::updateValue($this->name.'_eshopId', Tools::getValue('eshopId'));
	}
}
