<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();?>
<style type="text/css">
	.pp-adv-help{
		font-size: 1.1em;
		text-align: justify;
	}
</style>

<div class="row-fluid pp-advancedpricing-edit">
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
	<div class="span6">
		<fieldset class="form-horizontal">
		<legend> <?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_EDIT_DETAILS' ); ?> </legend>
			
			<!-- Title -->
			<div class="control-group">
					<div class="control-label"><?php echo $form->getLabel('title'); ?> </div>
					<div class="controls"><?php echo $form->getInput('title'); ?></div>	
			</div>	
			
			<!-- is published -->
			<div class="control-group">
					<div class="control-label"><?php echo $form->getLabel('published'); ?> </div>
					<div class="controls"><?php echo $form->getInput('published'); ?></div>					
			</div>

			<!-- plans -->
			<div class="control-group core_discount0">
						<div class="control-label">
						<label class="hasTip" title="<?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_EDIT_PLANS_TITLE_DESC'); ?>" >
							<?php echo XiText::_( 'COM_PAYPLANS_APP_ADVANCED_PRICING_SELECT_PLAN_TITLE' ); ?>
						</label>
						</div>
						<div class="controls">
							<?php $plans = $advanced_pricing->getPlans();
										$plans = JString::trim($plans, ',');
								echo PayplansHtml::_('plans.edit', 'Payplans_form[plans]', (!empty($plans))?explode(',',$plans):$plans, array('multiple'=>true));?>
						</div>
			</div>
			
			<!-- slab's min value -->
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('min_value'); ?> </div>
				<div class="controls"><?php echo $form->getInput('min_value'); ?></div>					
			</div>
			
			<!-- slab's max value -->
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('max_value'); ?> </div>
				<div class="controls"><?php echo $form->getInput('max_value'); ?></div>					
			</div>
			
			<!-- unit title -->
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('units_title'); ?> </div>
				<div class="controls"><?php echo $form->getInput('units_title'); ?></div>					
			</div>
			
			<!-- description -->
			<div class="control-group">
				<div class="control-label"><?php echo $form->getLabel('description'); ?> </div>
				<div class="controls"><?php echo $form->getInput('description'); ?></div>					
			</div>
		</fieldset>
		
		<!-- LOGS -->
		<?php echo $this->loadTemplate('edit_log'); ?>
		
</div>
<div class="span6">
		<fieldset class="form-horizontal">
			<legend><?php echo XiText::_( 'COM_PAYPLANS_APP_EDIT_APP_OPTIONAL_PARAMETERS' ); ?></legend>
			
		<?php $expiration_time = $advanced_pricing->getExpirationTime();?>
		<?php $price 	= $advanced_pricing->getPrice();?>
		<?php $records 	= count($price);?>
		
		<?php if($records == 0):?>
			<div id="pp-advanced-pricing">
				<?php $row = 0;?>
					<div class="control-group" id="row_<?php echo $row;?>">
							<div class="control-label">
								<label class="hasTip" title="<?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_TIME_AND_PRICE_COMBINATION_DESC') ?>">
									<?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_TIME_AND_PRICE_COMBINATION');?>
								</label>
							</div>
							
							<div class="controls">
									<div class="span3"><input name="Payplans_form[advanced_pricing][price][]" type="text" value="" /></div>
									<div><a href="#" class="pp-pricing-time-and-price-remove" counter="<?php echo $row;?>"><?php if($row != 0):?><i class="pp-icon-remove"></i><?php endif;?></a></div>
									<br/>
									<div class="span12"><?php echo PayplansHtml::_('timer.edit', 'Payplans_form[advanced_pricing][expiration_time][]', '000000000000', 'advanced_pricing_expiration_time_0'); ?></div>
									<br /><br />
							</div>
					</div>
			</div>
			<?php $row++;?>
			<?php else:?>
		
			<div id="pp-advanced-pricing">
					<?php for($row = 0; $row < $records; $row++):?>
							<div class="control-group" id="row_<?php echo $row;?>">
								<?php if($row == 0):?>
									<div class="control-label">
										<label class="hasTip" title="<?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_TIME_AND_PRICE_COMBINATION_DESC') ?>">
											<?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_TIME_AND_PRICE_COMBINATION');?>
										</label>		
									</div>
								<?php else:?>
									<div class="control-label">&nbsp;</div>
								<?php endif;?>
								
									<div class="controls">
											<div class="span5"><input name="Payplans_form[advanced_pricing][price][]" type="text" value="<?php echo $price[$row];?>" /></div>
											<div><a href="#" class="pp-advanced-pricing-remove" counter="<?php echo $row;?>"><?php if($row != 0):?><i class="pp-icon-remove"></i><?php endif;?></a></div>
											<br/>
											<div class="span12"><?php echo PayplansHtml::_('timer.edit', 'Payplans_form[advanced_pricing][expiration_time][]', "$expiration_time[$row]", "advanced_pricing_expiration_time_$row"); ?></div>
											<br/><br />
									</div>
							</div>
					 <?php endfor;?>			
			</div>
		<?php endif;?>
			<div class="control-group">
				<div class="control-label">&nbsp;</div>
				<div class="controls"><div id="pp-advanced-pricing-add" class="span3"><i class="pp-icon-plus"></i></div></div>
			</div>
			
			
			
		<script type="text/javascript">
			(function($){
				$(document).ready(function(){
					// Set the starting id number
					var DefaultNumber = <?php echo $row;?>;
					var timer_class = '<?php echo 'advanced_pricing_expiration_time'; ?>';
					var microsubscription = false;
					<?php if(XiFactory::getConfig()->microsubscription){?>
								microsubscription = true;
					<?php }?>
					
					$('#pp-advanced-pricing-add').click(function(){
						$( "#pp-advanced-pricing" ).append(payplans.element.planmodifier.getElementHtml(timer_class, DefaultNumber));
						
						payplans.element.timer.setup(timer_class+ '_' + DefaultNumber, '000000000000');
						
						DefaultNumber++;
						return false;
					});
					
					$('.pp-advanced-pricing-remove').live('click', function(){
						$('#row_'+ $(this).attr('counter')).remove();
						return false;
					});
					
					
					// if elements not defined already
					if(typeof(payplans.element.planmodifier)=='undefined'){
						payplans.element.planmodifier = {};
					}
			
					payplans.element.planmodifier = {
						getElementHtml : function(class_name, counter){
							var html = '';
							var timer_class = 'timer-warp-' + class_name + '_' + counter;
							var select_class = class_name + '_' + counter;
							html += '<div id="row_'+ counter +'" class="control-group">';
								html += '<div class="control-label">&nbsp;</div>';
								html += '<div class="controls">';
											html += '<div class="span3"><input type="text" value="" name="Payplans_form[advanced_pricing][price][]" class="" /></div>';
											html +=	'<span counter="'+counter+'" class="pp-advanced-pricing-remove offset2">';
											html += '<i class="icon-remove"></i>';
											html += '</span>';	
											html += '<br/>';
											html += '<div class="span12"><div id="' + timer_class +'" class="pp-element-timer">';
												html += '<div class="readable pp-mouse-pointer"><span class="pp-icon-edit">&nbsp;</span><span class="pp-content"></span></div>';
												html += '<div class="editable" style="display: none;">';
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_YEARS')." ";?></span>';
												html += '<select id="' + select_class +'_year" name="Payplans_form[' + select_class +'_year]" class="' + select_class +'">';
												for(index=0; index <= 10 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_MONTHS')." ";?></span>';
												html += '<select id="' + select_class +'_month" name="Payplans_form[' + select_class +'_month]" class="' + select_class +'">';
												for(index=0; index <= 11 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_DAYS')." ";?></span>';
												html += '<select id="' + select_class +'_day" name="Payplans_form[' + select_class +'_day]" class="' + select_class +'">';
												for(index=0; index <= 30 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
					
												if(microsubscription == false){
													html += '<span class="hide">';
												}
												
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_HOURS')." ";?></span>';
												html += '<select id="' + select_class +'_hour" name="Payplans_form[' + select_class +'_hour]" class="' + select_class +'">';
												for(index=0; index <= 23 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_MINUTES')." ";?></span>';
												html += '<select id="' + select_class +'_minute" name="Payplans_form[' + select_class +'_minute]" class="' + select_class +'">';
												for(index=0; index <= 59 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
					
												if(microsubscription == false){
													html += '</span>';
												}

												html += '<span class="hide">';
												html += '<span><?php echo XiText::_('COM_PAYPLANS_TIMER_SECONDS');?></span>';
												html += '<select id="' + select_class +'_second" name="Payplans_form[' + select_class +'_second]" class="' + select_class +'">';
												for(index=0; index <= 59 ; index++){
													html += '<option value="'+ index +'">'+index+'</option>';
												}
												html += '</select>';
												html += '</span>';
					
												html += '<input type="hidden" value="000000000000" name="Payplans_form[advanced_pricing][expiration_time][]" id="' + select_class +'">';
												html += '</div>';
												html += '</div>';
												html += '</div>';
											html += '</div>';
											html += '<br/><br /><br />';	
								html += '</div>';
							html += '</div>';
							return html;
						}
					}
				});				
			})(payplans.jQuery);
			</script>
			
			
		</fieldset>
		
		<div class="pp-adv-help">
			<fieldset class="form-horizontal">
				<legend onClick="payplans.jQuery('.pp-help-details').slideToggle();">
					<span style="font-size: 0.7em;" class=" <?php echo isset($show_log_details)? 'hide' : 'show' ;?> pp-help-details">[+]</span>
						<?php echo XiText::_('COM_PAYPLANS_APP_EDIT_APP_HELP'); ?>
				</legend>
					
				<div class="<?php echo isset($show_log_details)? 'show' : 'hide' ;?> pp-help-details">
					<div class="control-group">
						<div class="control-label">Point 1:</div>
						<div class="controls">
								While using advanced pricing app, set the plan layout as vertical. <br/>Go to <b>Payplans-Configuration Screen => Customization => Layout = 'Vertical'</b>.
								<br/>
								Note:- The default value of layout is 'Horizontal'. So you need to change the value of layout.
						</div>
					</div>
					
					<div class="control-group">
						<div class="control-label">Point 2(IMP):</div>
						<div class="controls">
								<b>Set the price of plan and slabs as per unit price only.</b> This is the important aspect for advanced pricing app setup.<br/>
								For example:-  Suppose, Price of Plan = $100 per unit and Expiration Time of Plan = 1 month<br/>
								 Now, suppose your scenario is that you have to enter different prices for 2 months, 3 months and 4 months then create different price and time combinations as follows:-<br/>
								  1. Price = $200 per unit and Expiration Time = 2 months<br/>
								  2. Price = $300 per unit and Expiration Time = 3 months<br/>
								  3. Price = $400 per unit and Expiration Time = 4 months<br/>
								  <br/>
								  The <b>advantage of this app</b> is that you can set diffrenciated prices for different time frames. For example you can set following prices:-<br/>
								  1. Price = $190 per unit and Expiration Time = 2 months<br/>
								  2. Price = $280 per unit and Expiration Time = 3 months<br/>
								  3. Price = $360 per unit and Expiration Time = 4 months<br/>
								  <br/>
								  
						</div>
					</div>
					
					<div class="control-group">
						<div class="control-label">Point 3:</div>
						<div class="controls">
								Advanced Pricing app does not work with <b>Renewal</b> and <b>Upgrade</b> apps.
						</div>
					</div>
					
					<div class="control-group">
						<div class="control-label">Point 4:</div>
						<div class="controls">
								If admin will configure differntiated prices then price differences will be visible to user at frontend (Differentiated price will be visible as discount).
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		
</div>		
	
	<?php echo $form->getInput('advancedpricing_id');?>
	<input type="hidden" name="task" value="save" />
</form>
</div>
<?php 
