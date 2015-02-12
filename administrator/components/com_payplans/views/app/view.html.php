<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplansadminViewApp extends XiView
{
	public function _displayGrid($records)
	{
		$appNames=array();
		foreach(PayplansHelperApp::getXml() as $key => $array){
			$appNames[$key] = $array['name'];
		}
	    $this->assign('pluginData', PayplansHelperApp::getPlugins());
		$this->assign('apps', PayplansHelperApp::getApps());
		$this->assign('appdata', PayplansHelperApp::getXml());
		$this->assign('appCount', PayplansHelperApp::getAppCount());
		$this->assign('app_names', $appNames );
		return parent::_displayGrid($records);
	}
	
	function _displayBlank()
	{
		$this->assign('pluginData', PayplansHelperApp::getPlugins());
		$this->assign('apps', PayplansHelperApp::getApps());
		$this->assign('appdata', PayplansHelperApp::getXml());
		$this->assign('appCount', PayplansHelperApp::getAppCount());
		return parent::_displayBlank();
	}
	
	function edit($tpl=null,$appType=null, $itemId=null)
	{
		$itemId = ($itemId === null) ? $this->getModel()->getState('id') : $itemId;
		$records = new stdClass();

		// If it is new record to add, then we need to collect apptype from request
		if(!$itemId){
			$appType =	JRequest::getVar('type',$appType);
			XiError::assert(($appType), XiText::_('COM_PAYPLANS_ERROR_APP_NO_APPLICATION_TYPE_PROVIDED'));
			$records->type = $appType;
		}
         
         $records->type = $appType;

		// Call PayplansApp GetInstance as it will autoload all apps
		$appObj	    = PayplansApp::getInstance($itemId, $appType)->bind($records);
		$logRecords	= XiFactory::getInstance('log', 'model')
								->loadRecords(array('object_id'=>$itemId, 'class'=>'PayplansApp'.JString::ucfirst($appObj->getType())));

		$xmlData	=		PayplansHelperApp::getXml();
		$appData    =  isset($xmlData[$appObj->getType()]) ? $xmlData[$appObj->getType()] : '';
		
		$this->assign('appData', $appData);
		$this->assign('app', $appObj);
		$this->assign('form',   $appObj->getModelform()->getForm($appObj));
		$this->assign('log_records', $logRecords);

		return true;
	}

	protected function _adminGridToolbar()
	{
		XiHelperToolbar::custom('myapps', 'cog.png', 'cog.png', 'New',false);
		XiHelperToolbar::editList();
		XiHelperToolbar::custom( 'copy', 'copy.png', 'copy_f2.png', 'COM_PAYPLANS_TOOLBAR_COPY', true );
		XiHelperToolbar::divider();
		XiHelperToolbar::publish();
		XiHelperToolbar::unpublish();
		XiHelperToolbar::divider();
		XiHelperToolbar::delete();
		XiHelperToolbar::divider();
		XiHelperToolbar::openPopup('searchRecords', 'search', 'search.png', 'COM_PAYPLANS_TOOLBAR_SEARCH', true );
	}

	protected function _adminEditToolbar()
	{   
		$model = $this->getModel();
		XiHelperToolbar::apply();
		XiHelperToolbar::save();
		XiHelperToolbar::cancel();
		XiHelperToolbar::divider();
		//don't display delete button when creating new app
		if($model->getId() != null){
			XiHelperToolbar::deleteRecord();
		}
	}
	
	
	public function _getDynamicJavaScript()
	{
          $url       =    "index.php?option=com_payplans&view={$this->getName()}"; 
	  $type      = JFactory::getApplication()->input->get('active_tab', array(), 'array');
	  $type      = array_shift($type);
	  ob_start(); ?>

	 payplansAdmin.app_myapps = function()
		{
			active_Tab    = payplans.jQuery('#installedapps');
			active_Tab.click();
			window.localStorage.setItem('tab-href', active_Tab.attr('href'));
			return false;
		}
	 payplans.jQuery(document).ready(function()
		{
		    var filter = <?php echo ($type)?1:0;?>;
		    var getTab = payplans.jQuery('#myTabTabs');
		    if(getTab == null)
		       return true;
		   
		    var toolbar = document.getElementById('toolbar');
		    toolbar.hide();
		    var clickedTab = this.id;

			 	if(window.location.href.indexOf("edit") > -1 ||  clickedTab == 'manageapps')
			 	{
			   			 toolbar.show();
			    }

		    if( filter ){
		     	active_Tab    = payplans.jQuery('#<?php echo JFactory::getApplication()->input->get('active_tab','installedapps');?>');
		        active_Tab.click();	
		        window.localStorage.setItem('tab-href', active_Tab.attr('href'));
		    }

		});
	       
	        payplansAdmin.app_validationForApplySelectedPlan = function()
	        {
	           
	            var e = document.getElementById("core_paramsapplyAll");
	            var applyAll = e.options[e.selectedIndex].value;
	            if(applyAll == "1")
	            {
	                return true;
	            }
	           
	            var eles = payplans.jQuery('input[name="Payplans_form[appplans][]"]');
	   
	            for(var i =0; i < eles.length; i++){
	                if(eles.hasOwnProperty(i) && eles[i].value != undefined && eles[i].value !=0 && eles[i].value.length > 0){
	                    return true;
	                }
	            }
	            
	            // this is done inorder to find the parent div.
	            var eles = payplans.jQuery('input[name="Payplans_form[appplans]"]');
	            parent = eles.closest(".control-group").first();
	            help   = parent.find('div[class="help-block"]');
	            help.html("<ul><li class='text-error'>This is required</li></ul>");
	           
	            return false;
	        }
	       
	        payplansAdmin.app_apply = payplansAdmin.app_save = function()
	        {
	            return payplansAdmin.app_validationForApplySelectedPlan();
	        }
	
	        <?php
	        $js = ob_get_contents();
	        ob_end_clean();
	        return $js;
	    }
}


