<?php
/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		support+payplans@readybytes.in
* website		http://www.readybytes.net
* Technical Support : Forum -	http://www.readybytes.net/payplans/forum.html
*/
if(defined('_JEXEC')===false) die();?>
<div class="pp-user-edit">
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="row-fluid">
	<div class="span6">		
		<fieldset class="form-horizontal">
			<legend> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_DETAILS' ); ?> </legend>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_ID') ?> </div>
				<div class="controls"><?php echo $user->getId(); ?>
				<input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>" />
				</div>
			</div>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USERNAME') ?> </div>
				<div class="controls"><?php echo PayplansHtml::link(XiHelperJoomla::getUserEditLink($user), $user->getUsername()); ?>	</div>				
			</div>

			<div class="control-group">
				<div class="control-label"><?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_NAME') ?> </div>
				<div class="controls"><?php echo $user->getRealname(); ?></div>				
			</div>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_EMAIL') ?> </div>
				<div class="controls"><?php echo $user->getEmail(); ?>	</div>				
			</div>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_USERTYPE') ?> </div>
				<div class="controls"><?php echo $user->getUsertype(); ?></div>				
			</div>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_REGISTERDATE') ?> </div>
				<div class="controls"><?php echo XiDate::timeago($user->getRegisterDate()); ?></div>				
			</div>
			
			<div class="control-group">
				<div class="control-label"> <?php echo XiText::_('COM_PAYPLANS_USER_EDIT_USER_LASTVISITDATE') ?> </div>
				<div class="controls"><?php echo XiDate::timeago($user->getLastvisitDate()); ?>	</div>				
			</div>
	
			<!-- address details  -->
			<?php foreach ($form->getFieldset('addressdetails') as $field):?>
					<?php $class = $field->group.$field->fieldname; ?>
					<div class="control-group <?php echo $class;?>">
						<div class="control-label"><?php echo $field->label; ?> </div>
						<div class="controls"><?php echo $field->input; ?></div>								
					</div>
			<?php endforeach;?>
		</fieldset>
		
		 <?php 
		     	$position = 'pp-user-details';
                echo $this->loadTemplate('partial_position',compact('plugin_result','position'));
         ?>
         
         	<!-- user preferences  -->
            <fieldset class="form-horizontal">
				<legend  onClick="xi.jQuery('.pp-user-preferences').slideToggle();">
					<span style="font-size: 0.7em;"  class="show pp-user-preferences">[+]</span>
						 <?php echo XiText::_( 'COM_PAYPLANS_USER_EDIT_USER_PREFERENCE' ); ?>
				</legend>
				<div class="hide pp-user-preferences">
					<?php foreach ($form->getFieldset('preference') as $field):?>
						<?php $class = $field->group.$field->fieldname; ?>
							<div class="control-group <?php echo $class;?>">
								<div class="control-label"><?php echo $field->label; ?> </div>
								<div class="controls"><?php echo $field->input; ?></div>								
							</div>
					<?php endforeach;?>
				</div>
		</fieldset>
       
       <!-- params  -->  
		<fieldset class="form-horizontal">
			<legend onClick="xi.jQuery('.pp-user-params').slideToggle();">
				<span style="font-size: 0.7em;"  style="font-size: 0.7em;" class="show pp-user-params">[+]</span>
				 	<?php echo XiText::_( 'COM_PAYPLANS_USER_EDIT_USER_PARAMS' ); ?>
			</legend>
			<div class="hide pp-user-params">
				<?php foreach ($form->getFieldset('params') as $field):?>
					<?php $class = $field->group.$field->fieldname; ?>
					<div class="control-group <?php echo $class;?>">
						<div class="control-label"><?php echo $field->label; ?> </div>
						<div class="controls"><?php echo $field->input; ?></div>								
					</div>
				<?php endforeach;?>
			</div>
			
		</fieldset>
		
		<!-- LOGS -->
		<?php echo $this->loadTemplate('edit_log'); ?>
	</div>

	<div class="span6">
		<?php echo $this->loadTemplate('user_order');?>
	</div>
	
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="boxchecked" value="1" />
</div>
</form>
</div>

<?php 
