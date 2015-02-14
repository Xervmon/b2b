/**
* @copyright	Copyright (C) 2009-2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @contact 		shyam@readybytes.in
*/

//define payplans, if not defined.
if (typeof(payplans)=='undefined'){
	var payplans = {}
}

// all admin function should be in admin scope 
if(typeof(payplans.admin)=='undefined'){
	payplans.admin = {};
}

//all admin function should be in admin scope 
if(typeof(Joomla)=='undefined'){
	Joomla = {};
}

//Backward compatibility with 1.4.x code
payplansAdmin = {};


(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.	
	
	
/*--------------------------------------------------------------
payplans.admin.grid
	submit
	filters
--------------------------------------------------------------*/
payplans.admin.grid = {
		
		//default submit function
		submit : function( view, action, validActions){
			
			// try views function if exist
			var funcName = view+'_'+ action ; 
			if(this[funcName] instanceof Function) {
				if(this[funcName].apply(this) == false)
					return false;
			}
			
			// then lastly submit form
			//submitform( action );
			if (action) {
		        document.adminForm.task.value=action;
		    }
			
			// validate actions
			//XITODO : send values as key of array , saving a loop
			validActions = eval(validActions);
			var isValidAction = false;
			for(var i=0; i < validActions.length ; i++){
				if(validActions[i] == action){
					isValidAction = true;
					break;
				}
			}
			
			
			// remove time offset
			payplans.time.removeOffset();
			
			if(isValidAction){
				if (!$('#adminForm').find("input,textarea,select").jqBootstrapValidation("hasErrors")) {
					Joomla.submitform(action, document.getElementById('adminForm'));
				}
				else{
					$('#adminForm').submit();
				}
			}else{
				Joomla.submitform(action, document.getElementById('adminForm'));
			}
			
		},
		
		filters : {
			reset : function(form){
				 // loop through form elements
			    var str = new Array();
                            var i=0;
			    for(i=0; i<form.elements.length; i++)
			    {
			        var string = form.elements[i].name;
			        if (string && string.substring(0,6) == 'filter' && (string!='filter_reset' && string!='filter_submit' && string != 'active_tab' && string != 'active_tab_content' ))
			        {
			            form.elements[i].value = '';
			        }
			    }
				this.submit(view,null,validActions);
			}
		}		
};

//Backward compatibility with 1.4.x code
payplansAdmin.submit 	= payplans.admin.grid.submit
payplansAdmin.redirect 	= payplans.url.redirect
payplansAdmin.resetFilters = payplans.admin.grid.filters.reset

/*--------------------------------------------------------------
  payplans.admin.search
	dropdown: 
	keydown :
	keyup	:
--------------------------------------------------------------*/
payplans.admin.search = {
	dropdown : function(){
        
        $(".pp-admin-search").position({
        	my:        "right top",    
        	at:        "right bottom",    
        	of:        $('#pp-button-searchpayplans'),  
        	collision: "fit"
        	})
        $(".pp-admin-search").toggle();
	},

	keydown : function(e){
		/*Track Enter and post module data for search result*/
		if (e.keyCode == 13){
			payplans.admin.search.go();
		}else if(e.keyCode == 27) { 
			payplans.admin.search.dropdown();
		}
		
		/*Ignor page postback on enter press*/
		$('#pp-search-box-form').submit(function() {return false;});
	},
 	
	keyup : function(e){
		/*Track Enter and post module data for search result*/
		if (e.keyCode != 13 && e.keyCode != 27) { 
			payplans.admin.search.go();
		}
	},

	 go: function(){
            var searchText = $('#pp-search-box-form-search-text').val();
            var referenceObj = $('#pp-search-box-form-refrence-obj').val();            
            var matchCriteria = $('#pp-search-box-form-match-criteria').val();

            // do not search for empty
            if(!searchText){
                    $('#pp-search-box-form-search-results').css('display','none');
                    return false;
            }
            
            var url = "index.php?option=com_payplans&view=dashboard&task=modsearch&headerFooter=0&domObject=payplans-search-results&searchText="+searchText+"&referenceObj="+referenceObj+"&matchCriteria="+matchCriteria;
            $('#pp-search-box-form-search-results').css('display','block');
            payplans.ajax.go(url);
    }
};


//Backward compatibility with 1.4.x code
xi.dashboard = {};
xi.dashboard.modsearch 			= payplans.admin.search.go;
payplansAdmin.searchBoxDropdown	= payplans.admin.search.dropdown;
payplansAdmin.searchBoxKeyDown	= payplans.admin.search.keydown;
payplansAdmin.searchBoxKeyUp	= payplans.admin.search.keyup;


/*--------------------------------------------------------------
  payplans.admin.migrate
  	setup	: setup the migration screen
	start	: start migration
	update	: update migration screen
	complete: post migrate information display
--------------------------------------------------------------*/
payplans.admin.migrate = {

	setup: function(plugin){
	    var url = "index.php?option=com_payplans&view=dashboard&task=migrate&plugin="+plugin+'&action=pre';
	    xi.ui.dialog.create({'url':url, 'data':{}});
	    return false;
	},

	start: function(plugin){
		var data = $('.pp-migrate-pre').closest('form').serializeArray();
	    var url = "index.php?option=com_payplans&view=dashboard&task=migrate&plugin="+plugin+'&action=Do';
	    if(typeof data == 'undefined'){
	    	xi.ui.dialog.create({'url':url, 'data':{}});
	    }
	    else{
	    	xi.ui.dialog.create({'url':url, 'data':data});
	    }
	},

	update: function(plugin, progress){
	    var url = "index.php?option=com_payplans&view=dashboard&task=migrate&plugin="+plugin+'&action=Do';
	    // update the progressbar length
	    $('#dashboard-migrate-progress-bar').css('width',progress+'%');
	    payplans.ajax.go(url);
	},

	complete: function(plugin){
	    var url = "index.php?option=com_payplans&view=dashboard&task=migrate&plugin="+plugin+'&action=post';
	    xi.ui.dialog.create({'url':url, 'data':{}});
	}	
};

// Backward compatibility with 1.4.x code
xi.dashboard = {};
xi.dashboard.preMigration 	= payplans.admin.migrate.setup;
xi.dashboard.doMigration	= payplans.admin.migrate.start;
xi.dashboard.updateMigration= payplans.admin.migrate.update;
xi.dashboard.postMigration	= payplans.admin.migrate.complete;

/*--------------------------------------------------------------
  payplans.admin.user
--------------------------------------------------------------*/
payplans.admin.user = {
    applyPlan: function(){
            window.top.document.forms.adminForm.plan_id.value = window.top.document.forms.selectPlanForm.plan_id.value;
            window.top.document.forms.adminForm.task.value = 'applyPlan';
            window.top.document.forms.adminForm.submit();                   
    }
};
    
// Backward compatibility with 1.4.x code
xi.user = {};
xi.user.applyPlan = payplans.admin.user.applyPlan;



/*--------------------------------------------------------------
	payplans.admin.subscription
	- extend : extend selected subscriptions
--------------------------------------------------------------*/
payplans.admin.subscription = {
    extend: function(){
			var extendTime = $('#pp-admin-subscription-extend').contents().find('input[name="extend_time"]').attr('value');
            
			// add extend_time element to admin Form
            var extendElement = $('<input>').attr({
            		'type' : 'hidden',
        			'name' : 'extend_time',
        			'value': extendTime
            	}).appendTo('#adminForm');

            window.top.document.forms.adminForm.task.value = 'extend';
            window.top.document.forms.adminForm.submit();                   
    }
};


//Backward compatibility with 1.4.x code
xi.subscription = {};
xi.subscription.extend = payplans.admin.subscription.extend;



/*--------------------------------------------------------------
payplans.admin.dashboard--------------------------------------------------------------*/
payplans.admin.dashboard = {
		/*
		changeStatistics : function(durationType){
					var url = 'index.php?option=com_payplans&view=dashboard&task=statisticsCharts&duration='+durationType;
					var args = {};
					payplans.ajax.go(url, args);
		},
		*/
		
		removeErrorLog : function(log_id){
			var url = 'index.php?option=com_payplans&view=dashboard&task=markRead&isAjax=true&logId='+log_id;
			var args = {};
			payplans.ajax.go(url, args);
		},
		
		customDateStatistics : function(){
			var val   = $("input[name^='statistics-date']").val();
			if(val.indexOf(':')==-1){
				alert("Please enter two valid dates, seperated by ':'. ");
				return false;
			}
			
			var values = val.split(':');
			var first=values[0];
			var last =values[1];

			var url = 'index.php?option=com_payplans&view=dashboard&task=customStatistics&statisticsFirstDate='+first+'&statisticsLastDate='+last;

			window.location.replace(xi_url_base + url);
		}

};

//Created for Handling of Rebuilding statistics process
payplans.admin.dashboard.rebuildstats = {
		
					setup: function() {
								var url = 'index.php?option=com_payplans&view=dashboard&task=rebuildstats&action=start';
								xi.ui.dialog.create({'url':url, 'data':{}},Joomla.JText._('COM_PAYPLANS_JS_DASHBOARD_REBUILD_START_DIALOG_TITLE', 'Start Rebuild'),500);
							    return false;
							},
	
					start: function(){
								 xi.ui.dialog.close();
								 var url = 'index.php?option=com_payplans&view=dashboard&task=rebuildstats&action=do&start=0';
								 xi.ui.dialog.create({'url':url, 'data':{}},Joomla.JText._('COM_PAYPLANS_JS_DASHBOARD_REBUILD_CALCULATING_DIALOG_TITLE', 'Calculating Statistics'),500);
								 return false;
							},
	
					update: function(start){
								var url = 'index.php?option=com_payplans&view=dashboard&task=rebuildstats&action=do&start='+start;
							    payplans.ajax.go(url);
							},
					complete: function (){
								xi.ui.dialog.close();
								var url = 'index.php?option=com_payplans&view=dashboard&task=rebuildstats&action=complete';
								xi.ui.dialog.create({'url':url, 'data':{}}, Joomla.JText._('COM_PAYPLANS_JS_DASHBOARD_REBUILD_COMPLETED_DIALOG_TITLE', 'Rebuilding Completed'),500);
							},
						
					close: function (){
							xi.ui.dialog.autoclose(2000);
							payplans.ajax.go("index.php?option=com_payplans&view=dashboard&task=rebuildstats&action=close");
							}
			};

   payplans.admin.config = {};
			payplans.admin.config.migrateLogs= {
					start: function(){
						 var url = 'index.php?option=com_payplans&view=config&task=migration&action=start';
						 xi.ui.dialog.create({'url':url, 'data':{}},Joomla.JText._('COM_PAYPLANS_JS_CONFIG_MIGRATING_LOGS_DIALOG_TITLE', 'Calculating Statistics'),500);
						 return false;
			},

					update: function(totalRecordToProcess,start){
								var url = 'index.php?option=com_payplans&view=config&task=migration&action=inProcess&start='+start+'&totalRecordToProcess='+totalRecordToProcess;
								payplans.ajax.go(url);
						}
			
			};


/*--------------------------------------------------------------
payplans.admin.manage
--------------------------------------------------------------*/
payplans.admin.manage = {
		install: function(plg_type, plg_name){
					var url = 'index.php?option=com_payplans&view=manage&task=install&plg_type='+plg_type+'&plg_name='+plg_name;
					var args = {};		
					payplans.jQuery('.pp-app-running-status-'+plg_type+'-'+plg_name).addClass('loading').html(Joomla.JText._('COM_PAYPLANS_JS_MANAGE_INSTALLING', 'Installing.....'));					
					payplans.jQuery('#pp-install'+'-'+plg_type+'-'+plg_name).parent().html('<div class="loading" id="pp-install'+'-'+plg_type+'-'+plg_name+'">Installing.....</div>');
					
					payplans.ajax.go(url, args);
					return false;
		},
		
		install_response : function(plg_type, plg_name, response){
					response = JSON.parse(response);
					
					var teaser = Joomla.JText._('COM_PAYPLANS_JS_MANAGE_RESPONSE_ERROR', 'Error');
					// success
					if(response.response_code == 200){
						teaser = Joomla.JText._('COM_PAYPLANS_JS_MANAGE_RESPONSE_SUCCESS', 'SUCCESS');
					}
					
					// error					
					payplans.jQuery('.pp-app-running-status-'+plg_type+'-'+plg_name).removeClass('loading').html(teaser);					
					payplans.jQuery('#pp-install'+'-'+plg_type+'-'+plg_name).html(Joomla.JText._('COM_PAYPLANS_JS_MANAGE_ERROR_CODE_'+response.error_code, response.error_code)).removeClass('loading');
					return true;
		}
};


payplans.admin.subscription = {

	subStatusGridWarning: function(statusid,entityid,recordkey){
		window.location.replace(xi_url_base +'index.php?option=com_payplans&view='+ xi_view +'&task=update&name=status&value=' + statusid +'&'+recordkey+'='+entityid);
	}
  };


/*-------------------------------------------------------------------------
 * Transaction details refund request
 --------------------------------------------------------------------------*/

payplans.admin.transaction = {
	
		refund: function(url){
				$('#payplans_refund_confirm').attr('disabled','disabled');
				var refundAmt = payplans.jQuery('#refund_amount').val();
				url = url+'&refund_amount='+refundAmt;
				payplans.ajax.go(url);
		}
};

/*------------------------------------------------------------------------
 * 	Search button is handling
 -------------------------------------------------------------------------*/
payplansAdmin.dashboard_searchRecords = function()
{
	payplans.url.modal("index.php?option=com_payplans&task=searchRecords");
	// do not submit form
	return false;
}

payplansAdmin.config_searchRecords 			= payplansAdmin.dashboard_searchRecords;
payplansAdmin.plan_searchRecords 			= payplansAdmin.dashboard_searchRecords;
payplansAdmin.invoice_searchRecords 	 	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.subscription_searchRecords 	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.app_searchRecords 		 	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.user_searchRecords 		 	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.transaction_searchRecords  	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.log_searchRecords 		 	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.prodiscount_searchRecords	 	= payplansAdmin.dashboard_searchRecords;	
payplansAdmin.advancedpricing_searchRecords	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.usedtimemonitor_searchRecords	= payplansAdmin.dashboard_searchRecords;
payplansAdmin.appmanager_searchRecords		= payplansAdmin.dashboard_searchRecords;
payplansAdmin.group_searchRecords			= payplansAdmin.dashboard_searchRecords;
payplansAdmin.reports_searchRecords			= payplansAdmin.dashboard_searchRecords;
payplansAdmin.addonservices_searchRecords		= payplansAdmin.dashboard_searchRecords;
payplansAdmin.addonservicesstats_searchRecords	= payplansAdmin.dashboard_searchRecords;

function addCssOnResize(width)
{
	if(width > 700 && width < 1000)
	{
	$('div.payplans').find('.span6').find('fieldset').addClass('form-vertical').removeClass('form-horizontal');
	}
		else
	{
	$('div.payplans').find('.span6').find('fieldset').addClass('form-horizontal').removeClass('form-vertical');
	}
}


$.fn.delay = function(options) {
    var timer;
    var delayImpl = function() {
        if (timer != null) {
            clearTimeout(timer);
        }
        var newFn = function() {
            options.fn();
        };
        timer = setTimeout(newFn, options.delay);
    }
   
    return this.each(function() {
        var obj = $(this);
        obj.bind(options.event, function() {
             delayImpl();  
        });
    });
};



/*------------------------------------------------------------------------
 * 	Reassign invoice serial on invoice screen 
 *  -------------------------------------------------------------------------*/
payplansAdmin.invoice_reassignSerial = function(confirmation)
{
	if ( confirmation != '1' ) {
		confirmation = '0';
		payplans.url.modal("index.php?option=com_payplans&view=invoice&task=reassignSerialInitialize&start=0&confirm="+confirmation, {intentionalClose:true});
		
		// do not submit form
		return false;
	}
	
	payplans.ajax.go("index.php?option=com_payplans&view=invoice&task=reassignSerialInitialize&start=0&confirm="+confirmation);
	// do not submit form
	return false;
};

payplansAdmin.invoice_updateReassignSerial = function(response)
{
	if (response.needToContinue) {
		response.start 	= parseInt(response.start);
		var total 		= payplans.jQuery('#payplans-reassign-total').html();
		
		if (response.start > total) {
			response.start = total;
		}
		
		var progress 		= (response.start/total) * 100;
		
		payplans.jQuery('#payplans-reassign-progress').width(progress+'%');
		payplans.jQuery('#payplans-reassign-total-processed').html(response.start);
		
		payplans.ajax.go("index.php?option=com_payplans&view=invoice&task=reassignSerial&start="+response.start);
		return false;
	}
	
	xi.ui.dialog.autoclose(5000);
	window.location.reload();
	return false;
};

/*--------------------------------------------------------------
  on Document ready 
--------------------------------------------------------------*/
$(document).ready(function(){
	var count = 0;
	var width = $(window).width();
	addCssOnResize(width);
	//admin update status
	$(".gridupdatestatus").change(function(){
		 var statusid = $(this).val();
		 var entityid= $(this).attr('entity-id');
		 var recordkey = $(this).attr('record-key');
		payplans.admin.subscription.subStatusGridWarning(statusid,entityid,recordkey);
	});
	
	
	
	
	// dashbord statistics
	$("input[name^='displaystatisticschart']").click(function(){
			payplans.admin.dashboard.changeStatistics(this.value);
	});
	
	$('.pp-err-cancel').click(function(){
		var value = this.id;
		
		// Step 1:- hide the div(single log entry)
		$(".pp-log-"+value).hide();
		// Step 2:- mark status of error log as read
		payplans.admin.dashboard.removeErrorLog(value);
	});
	


	/*--------------------------------------------------------------
      Backend app screen searching and filtering
     --------------------------------------------------------------*/
	$('body').on('change', '#filtertags', function(){
        var filterval = $('select#filtertags option:selected').val();
        // hide all
        $('.pp-apps:visible').css( "border-top", "" );   
        $('.f-All').hide();
        if($('.f-'+filterval).length == 0)
        {
	    	$('.pp-no-app').html("<h3 class='pp-noapp-msg'>No app available matching your criteria</h3>");
	    	return false;
        }
        $('.pp-noapp-msg').remove();
        // display selected tags 
        $('.f-'+filterval).show();
        $('.f-'+filterval+':first .pp-apps' ).css( "border-top", "1px solid #ccc" );       
     });

	
	  $('#pp-app-search').delay({
		   delay: 300,
		   event: 'keyup',
		   fn: function(){
			  var searchVal = $('#pp-app-search').val();
			  $('.pp-apps:visible').css( "border-top", "" ); 
		        if(searchVal)
		        {  
		        	$('.f-All').hide();
			        searchVal = searchVal.toLowerCase();
			        
			        if($( "div[filter*='"+searchVal+"'].pp-appscreen" ).length == 0)
			        {
				    	$('.pp-no-app').html("<h3 class='pp-noapp-msg'>No app available matching your criteria</h3>");
				    	return false;
			        }
			        $('.pp-noapp-msg').remove();
		        	$( "div[filter*='"+searchVal+"'].pp-appscreen" ).show();
		        	$( "div[filter*='"+searchVal+"'].pp-appscreen:first .pp-apps" ).css( "border-top", "1px solid #ccc" );  
		        	return false;
		        }
		        $('.pp-noapp-msg').remove();
		        $('.f-All').show();
		   }
	  });
	  
	  
	$('.pp-apps').hover(function(){
		$(this).addClass('pp-hover');
		if(!$(this).parent().prev().find('.pp-apps').length ){
			$(this).css('border-top', '1px solid #0088cc');
		}
		
		$(this).css('border-bottom', '1px solid #0088cc');
		$(this).parent().prev().find('.pp-apps').css('border-bottom', '1px solid #0088cc');
	}, 

	function(){
		$(this).removeClass('pp-hover');
		if(!$(this).parent().prev().find('.pp-apps').length ){
			$(this).css('border-top', '1px solid #ccc');
		}

		$(this).css('border-bottom', '1px solid #ccc');
		$(this).parent().prev().find('.pp-apps').css('border-bottom', '1px solid #ccc');
	});

});



//ENDING :
//Scoping code for easy and non-conflicting access to $.
//Should be last line, write code above this line.
})(payplans.jQuery);
