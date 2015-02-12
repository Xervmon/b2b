<?php 
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task != 'companies.delete' || confirm('<?php echo JText::_('COM_JBUSINESS_DIRECTORY_COMPANIES_CONFIRM_DELETE', true);?>'))
		{
			Joomla.submitform(task);
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=companies');?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
	<fieldset  class="boxed">
		<div class="form-box">
			<h2> <?php echo JText::_('LNG_EXPORT_CSV');?></h2>
			<div>
				<?php echo JText::_('LNG_EXPORT_CSV_TEXT');?>									
			</div>			
			</br/></br/>
				<div class="detail_box">
					<div  class="form-detail req"></div>
					<label for="delimiter"><?php echo JText::_('LNG_DELIMITER')?> </label> 
					<select name="delimiter">
						<option value=";"><?php echo JText::_('LNG_SEMICOLON')?></option>
						<option value=","><?php echo JText::_('LNG_COMMA')?></option>
					</select>
					
					<div class="clear"></div>
					
				</div>
				<div class="detail_box">
						<label for="category"><?php echo JText::_('LNG_CATEGORY')?> </label> 
							<select name="category" id="category">
								<option value="0"><?php echo JText::_("LNG_ALL_CATEGORIES") ?></option>
								<?php foreach($this->categories as $category){?>
									<option value="<?php echo $category->id?>" <?php $session = JFactory::getSession(); echo $session->get('categorySearch')==$category->id && $preserve?" selected ":"" ?> ><?php echo $category->name?></option>
									<?php foreach($this->subCategories as $subCat){?>
										<?php if($subCat->parentId == $category->id){?>
											<option value="<?php echo $subCat->id?>" <?php $session = JFactory::getSession(); echo $session->get('categorySearch')==$subCat->id && $preserve?" selected ":"" ?> >-- <?php echo $subCat->name?></option>
										<?php } ?>
									<?php }?>
								<?php }?>
							</select>
						
					</div>
					<br/><br/>
				
			<div class="clear"></div>
			<input type="submit" name="submit" value="<?php echo JText::_("LNG_EXPORT");?>">		
			
		</div>
		
	</fieldset>
	
	 <input type="hidden" name="option"	value="<?php echo JBusinessUtil::getComponentName()?>" />
	 <input type="hidden" name="task" id="task" value="companies.exportCompaniesCsv" /> 
	 <?php echo JHTML::_( 'form.token' ); ?> 
</form>