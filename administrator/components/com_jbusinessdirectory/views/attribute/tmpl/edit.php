<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php
/*------------------------------------------------------------------------
# JAdManager
# author SoftArt
# copyright Copyright (C) 2012 SoftArt.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.SoftArt.com
# Technical Support:  Forum - http://www.SoftArt.com/forum/j-admanger-forum/?p=1
-------------------------------------------------------------------------*/
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'attribute.cancel' || !validateCmpForm()){
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=attribute');?>" method="post" name="adminForm" id="item-form">

	<fieldset class="adminform">
		<legend><?php echo JText::_('LNG_ATTRIBUTE_DETAILS'); ?></legend>
		
		<TABLE class="admintable" id="table_feature_options" border=0>
			<TR>
				<TD width=10% nowrap class="key"><?php echo JText::_("LNG_NAME")?> :</TD>
				<TD nowrap width=1%  align=left>
					<input 
						type		= "text"
						name		= "name"
						id			= "name"
						value		= '<?php echo $this->item->name?>'
						size		= 32
						maxlength	= 128
						class="validate[required] text-input"
					/>
				</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD width=10% nowrap class="key"><?php echo JText::_("LNG_CODE")?> :</TD>
				<TD nowrap width=1%  align=left>
					<input 
						type		= "text"
						name		= "code"
						id			= "code"
						value		= '<?php echo $this->item->code?>'
						size		= 32
						maxlength	= 128
						class="validate[required] text-input"
					/>
				</TD> 
				<TD>&nbsp;</TD>
			</TR>
			
			<TR style="display:none">
				<TD width=10%  class="key" nowrap><?php echo JText::_("LNG_SHOW_IN_FILTER")?> :</TD>
				<TD nowrap  align=left class="app-option">
					<input type="radio" class="validate[required] radio"
							name		= "show_in_filter"
							id			= "show_in_filter"
							value		= "1"
							<?php echo (isset($this->item->show_in_filter) && $this->item->show_in_filter==1)? " checked " :""?>
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
							onclick =""
						/>
						<?php echo JText::_("LNG_YES"); ?>
					<input type="radio" class="validate[required] radio"
						name		= "show_in_filter"
						id			= "show_in_filter"
						value		= "0"
						<?php echo (isset($this->item->show_in_filter) && $this->item->show_in_filter==0)? " checked " :"dasd"?>
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						onclick =""
					/>
					<?php echo JText::_("LNG_NO") ?>
				</TD>
			</TR>
			<TR>
				<TD width=10%  class="key" nowrap><?php echo JText::_("LNG_MANDATORY")?> :</TD>
				<TD nowrap  align=left class="app-option">
					<input type="radio" class="validate[required] radio"
							name		= "is_mandatory"
							id			= "is_mandatory"
							value		= "1"
							<?php echo (isset($this->item->is_mandatory) && $this->item->is_mandatory==1)? " checked " :""?>
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
							onclick =""
						/>
						<?php echo JText::_("LNG_YES") ?>
					<input type="radio" class="validate[required] radio"
						name		= "is_mandatory"
						id			= "is_mandatory"
						value		= "0"
						<?php echo (isset($this->item->is_mandatory) && $this->item->is_mandatory==0)? " checked " :""?>
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						onclick =""
					/>
					<?php echo JText::_("LNG_NO") ?>
				</TD>
			</TR>
			
			<TR>
				<TD width=10%  class="key" nowrap><?php echo JText::_("LNG_SHOW_IN_FRONT")?> :</TD>
				<TD nowrap  align=left class="app-option">
					<input type="radio" class="validate[required] radio"
							name		= "show_in_front"
							id			= "show_in_front"
							value		= "1"
							<?php echo (isset($this->item->show_in_front) && $this->item->show_in_front==1)? " checked " :""?>
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
							onclick =""
						/>
						<?php echo JText::_("LNG_YES") ?>
					<input type="radio" class="validate[required] radio"
						name		= "show_in_front"
						id			= "show_in_front"
						value		= "0"
						<?php echo (isset($this->item->show_in_front) && $this->item->show_in_front==0)? " checked " :""?>
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						onclick =""
					/>
					<?php echo JText::_("LNG_NO") ?>
				</TD>
			</TR>
			<TR style="display: none">
				<TD width=10%  class="key" nowrap><?php echo JText::_("LNG_SHOW_ON_SEARCH")?> :</TD>
				<TD nowrap  align=left class="app-option">
					<input type="radio" class="validate[required] radio"
							name		= "show_on_search"
							id			= "show_on_search"
							value		= "1"
							<?php echo (isset($this->item->show_on_search) && $this->item->show_on_search==1)? " checked " :""?>
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
							onclick =""
						/>
						<?php echo JText::_("LNG_YES") ?>
					<input type="radio" class="validate[required] radio"
						name		= "show_on_search"
						id			= "show_on_search"
						value		= "0"
						<?php echo (isset($this->item->show_on_search) && $this->item->show_on_search==0)? " checked " :""?>
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						onclick =""
					/>
					<?php echo JText::_("LNG_NO") ?>
				</TD>
			</TR>
			<tr>
				<td class="key"><?php echo JText::_('LNG_STATE'); ?></td>
				<td>
					<select name="status" class="inputbox input-medium" class="validate[required] select">
						<?php echo JHtml::_('select.options', $this->states, 'value', 'text', $this->item->status);?>
					</select>
				</td>
				<TD>&nbsp;</TD>
			</tr>
			<TR>
				<TD width=10%  class="key" nowrap><?php echo JText::_("LNG_TYPE")?> :</TD>
				<TD nowrap  align=left class="app-option">
				<?php 
					foreach($this->attributeTypes as $key=>$value){
				?>
					<input type="radio" class="validate[required] radio"
						name		= "type"
						id			= "type"
						value		= "<?php echo $value->id; ?>"
						<?php echo (isset($this->item->type) && $this->item->type==$value->id)? " checked " :""?>
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
						onclick ="doAction(this.value);"
					/>
					<?php echo $value->name; ?>
				<?php }?>		
				</TD>
				<TD nowrap>
					&nbsp;
				</TD>
			</TR>
			<TR>
				<TD colspan="3"><hr/></TD>
			</TR>
			<?php
			$i = 0;
			if( count($this->attributeOptions) > 0 )
			{
				foreach( $this->attributeOptions as $key => $value )
				{
				?>
				<TR id="options-attr-<?php echo $key?>"> 
					<TD  class="key" width=10% nowrap><?php echo JText::_("LNG_OPTION_NAME");?>:</TD>
					<TD nowrap align=left width=30% align=left valign=center>
						<input type='hidden' name='attribute_id[]' id='attribute_id[]' value='<?php echo $value->attribute_id?>' >
						<input 
							type		= "text"
							name		= "option_name[]"
							id			= "option_name[]"
							value		= '<?php echo $value->name?>'
							size		= 32
							maxlength	= 128
							autocomplete= OFF
						/>
						<?php
						if( $i>0)
						{
						?>
						<img
							valign		=middle
							width		=12px 
							height  	=12px
							title		='Delete option'
							src ="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName()."/assets/img/deleteIcon.png"?>"
							onclick 	="deleteAttributeOption('options-attr-<?php echo $key?>');" 
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
						>
						<?php
						}
						else if( $i==0)
						{
						?>
							<img 
								width		=16px 
								height 		=16px
								title		='Add option'
								src ="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName()."/assets/img/addIcon.jpg"?>"
								onclick 	="addAttributeOption();" 
								onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
								onmouseout	=	"this.style.cursor='default'"
							>
						</TD>
						<?php
						}
						?>
					</TD>
				</TR>
				<?php
				$i++;
				}
			}
			else 
			{
				?>
				<tr id="options_attr">
					<TD  class="key" width=10% nowrap><?php echo JText::_("LNG_OPTION_NAME");?>:</TD>
					<td>
						<input 
								type		= "text"
								name		= "option_name[]"
								id			= "option_name[]"
								value		= ''
								size		= 32
								maxlength	= 128
								autocomplete= OFF
							/>
						&nbsp;
						<img 
							width		=16px 
							height 		=16px
							title		='Add option'
							src ="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName()."/assets/img/addIcon.jpg"?>"
							onclick 	="addAttributeOption();" 
							onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
							onmouseout	=	"this.style.cursor='default'"
						>
					</TD>
				</tr>	
					<?php
			}
			?>

		</TABLE>
	</fieldset>
	<script language="javascript" type="text/javascript">
		
		function validateForm(){
			var form = document.adminForm;
		
			if( !validateField( form.name, 'string', false, "<?php echo JText::_("LNG_PLEASE_INSERT_ATTRIBUTE_NAME",true)?>" ) )
				return false;
			
			if( form.elements["option_name[]"].type !="text")
			{
				if( !validateField( form.elements["option_name[]"], 'string', false, "<?php echo JText::_("LNG_PLEASE_INSERT_OPTION_NAME",true)?>" ) )
					return false;
			}

			return true;
		}
	
		function doAction(value){
			disabled = false; 	
			if(value==1)
				disabled = true; 	
			var optionsTemp = document.getElementsByName("option_name[]");
		    for (i = 0; i < optionsTemp.length; ++i) {
		    	optionsTemp[i].disabled = disabled;
		    }
		}
		
		function deleteAttributeOption(id)
		{		
			 return (elem=document.getElementById(id)).parentNode.removeChild(elem);
		}
		
		function addAttributeOption()
		{   var attrType = document.getElementsByName("type");
			if(attrType[0].checked){
				alert('<?php echo JText::_("LNG_INPUT_TYPE_NO_OPTIONS",true);?>')
				return false; 
			}
			var tb = document.getElementById('table_feature_options');
			//alert(tb);
			if( tb==null )
			{
				alert('Undefined table, contact administrator !');
			}
			
			var td1_new			= document.createElement('td');  
			td1_new.innerHTML	= '<?php echo JText::_("LNG_OPTION_NAME",true);?>:';
			td1_new.className	='key';
			
			var td2_new			= document.createElement('td');  
			td2_new.style.textAlign='left';
		

			var input_o_new 	= document.createElement('input');
			input_o_new.setAttribute('type',		'text');
			input_o_new.setAttribute('name',		'option_name[]');
			input_o_new.setAttribute('id',			'option_name[]');
			input_o_new.setAttribute('size',		'32');
			input_o_new.setAttribute('maxlength',	'128');
			//input_o_new.autocomplete				= 'off';
			var d = new Date();
			var id = d.getTime(); 
			
			
			var tr_new = tb.insertRow(tb.rows.length);
			tr_new.setAttribute('id', 'options-attr-'+(id));
			
			var img_del		 	= document.createElement('img');
			img_del.setAttribute('src', "<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName()."/assets/img/deleteIcon.png"?>");
			img_del.setAttribute('alt', 'Delete option');
			img_del.setAttribute('height', '12px');
			img_del.setAttribute('width', '12px');
			img_del.setAttribute('onclick', 'deleteAttributeOption(\''+ 'options-attr-'+(id) +'\')');
			img_del.setAttribute('onmouseover', "this.style.cursor='hand';this.style.cursor='pointer'");
			img_del.setAttribute('onmouseout', "this.style.cursor='default'");
			
			td2_new.appendChild(input_o_new);
			td2_new.innerHTML = td2_new.innerHTML + "&nbsp;&nbsp;";
			td2_new.appendChild(img_del);


			
			tr_new.appendChild(td1_new);
			tr_new.appendChild(td2_new);

		}
		
	</script>
	<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="id" value="<?php echo $this->item->id ?>" />
	<?php echo JHTML::_( 'form.token' ); ?> 
</form>


<script>
jQuery(document).ready(function(){
	jQuery("#item-form").validationEngine('attach');
});

function validateCmpForm(){
	var isError = jQuery("#item-form").validationEngine('validate');
	return !isError;
}
</script>