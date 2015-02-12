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

if( 
	JRequest::getString( 'task') !='edit' 
	&& 
	JRequest::getString( 'task') !='add' 
) 
{
?>
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
			<TABLE class="adminlist" >
					<thead>
						<th width='1%'>#</th>
						<th width='1%'  align=center>&nbsp;</th>
						<th width='20%' align=center><B><?php echo JText::_('LNG_NAME'); ?></B></th>
						<th width='20%' align=center><B><?php echo JText::_('LNG_TYPE'); ?></B></th>
						<th width='20%' align=center><B><?php echo JText::_('LNG_SUBJECT'); ?></B></th>
						<th width='30%' align=center ><B><?php echo JText::_('LNG_CONTENT'); ?></B></th>
						<th width='1%' align=center><B><?php echo JText::_('LNG_DEFAULT'); ?></B></th>
					</thead>
					<tbody>
					<?php 
					$nrcrt = 1;
					//if(0)
					for($i = 0; $i <  count( $this->items ); $i++)
					{
						$email =  $this->items[$i]; 

					?>
					<TR class="row<?php echo $i%2 ?>"
						onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
						onmouseout	=	"this.style.cursor='default'"
					>
						<TD align=center><?php echo $nrcrt++?></TD>
						<TD align=center>
							 <input type="radio" name="boxchecked"  id="boxchecked" value="<?php echo $email->email_id?>" 
								onmouseover	=	"this.style.cursor='hand';this.style.cursor='pointer'"
								onmouseout	=	"this.style.cursor='default'"
								onclick="
											adminForm.email_id.value = '<?php echo $email->email_id?>'
										" 
							/>
							
						</TD>
						<TD align=left>
							
							<a href='<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails&task=edit&email_id[]='. $email->email_id )?>'
								title		= 	"<?php echo JText::_('LNG_CLICK_TO_EDIT'); ?>"
							>
								<B><?php echo $email->email_name?></B>
							</a>	
							
						</TD>
						<TD align=center><?php echo $email->email_type?></TD>
						<TD align=center><?php echo $email->email_subject?></TD>
						<TD wrap align=left><?php echo $email->email_content?></TD>
						<TD align=center>
							<img border= 1 
								src ="<?php echo JURI::base() ."components/".getComponentName()."/assets/img/".($email->is_default==false? "unchecked.gif" : "checked.gif")?>" 
								onclick	=	"	
												<?php
												if( $email->is_default ==false )
												{
												?>
												document.location.href = '<?php echo JRoute::_( 'index.php?option=com_jbusinessdirectory&controller=manageemails&view=manageemails&task=state&email_id[]='. $email->email_id )?> '
												<?php
												}
												?>
											"
							/>
							
						</TD>
						
					</TR>
					<?php
					}
					?>
					</tbody>
				</TABLE>
	</div>
	<input type="hidden" name="option" value="<?php echo getComponentName()?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="email_id" value="" />
	<input type="hidden" name="controller" value="<?php echo JRequest::getCmd('controller', 'J-HotelReservation')?>" />
	<?php echo JHTML::_( 'form.token' ); ?> 
	<script  type="text/javascript">
		<?php
		if( getCurrentJoomlaVersion() < 1.6 )
		{
		?>
		function submitbutton(pressbutton) 
		<?php
		}
		else
		{
		?>
		Joomla.submitbutton = function(pressbutton) 
		<?php
		}
		?>
		{
			var form = document.adminForm;
			if (pressbutton == 'edit' || pressbutton == 'Delete') 
			{
				var isSel = false;
				if( form.elements['boxchecked'].length == null )
				{
					if(form.elements['boxchecked'].checked)
					{
						isSel = true;
					}
				}
				else
				{
					for( i = 0; i < form.boxchecked.length; i ++ )
					{
						if(form.elements['boxchecked'][i].checked)
						{
							isSel = true;
							break;
						}
					}
				}
				
				if( isSel == false )
				{
					alert('<?php echo JText::_('LNG_YOU_MUST_SELECT_ONE_RECORD'); ?>');
					return false;
				}
				submitform( pressbutton );
				return;
			} else {
				submitform( pressbutton );
			}
		}
	</script>
</form>
<?php
}
else 
{
?>
<script>
	jQuery(document).ready(function()
	{
		/*
		tinymce.create('tinymce.plugins.ExamplePlugin', {
			createControl: function(n, cm) {
				switch (n) {
					case 'mylistbox':
						var mlb = cm.createListBox('mylistbox', {
							 title : '<?php echo JText::_("LNG_USE_ONE_OF_EMAILS_TAG_IN_THE_EDITOR_TO_INSERT_CONTENT_WHEN_EMAIL_IS_SENT")?>',
							 onselect : function(v) 
							 {
								 tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
								 //tinyMCE.activeEditor.setContent(v);
								   tinyMCE.execCommand('mceReplaceContent',false,v);
							 }
						});

						// Add some values to the list box
						mlb.add('<?php echo EMAIL_RESERVATIONFIRSTNAME?>', '<?php echo EMAIL_RESERVATIONFIRSTNAME?>');
						mlb.add('<?php echo EMAIL_RESERVATIONLASTNAME?>', '<?php echo EMAIL_RESERVATIONLASTNAME?>');
						mlb.add('<?php echo EMAIL_RESERVATIONDETAILS?>', '<?php echo EMAIL_RESERVATIONDETAILS?>');
						mlb.add('<?php echo EMAIL_BILINGINFORMATIONS?>', '<?php echo EMAIL_BILINGINFORMATIONS?>');
						mlb.add('<?php echo EMAIL_COMPANY_NAME?>', '<?php echo EMAIL_COMPANY_NAME?>');
						
						
						mlb.add('[last_name]', '[last_name]');
						mlb.add('[reservation_details]', '[reservation_details]');
						mlb.add('[biling_informations]', '[biling_informations]');
						mlb.add('[company_name]', '[company_name]');

						// Return the new listbox instance
						return mlb;
				}

				return null;
			}
		});

		
		tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);
		
		tinyMCE.init({
			// General options
			mode : "exact",
			elements : "email_content",
			theme : "advanced",
			skin : "o2k7",
			skin_variant : "silver",
			plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
		
			// Theme options
			//theme_advanced_buttons1 : "mylistbox",
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "<?php echo JURI::base()?>components/<?php echo getComponentName()?>/assets/tiny_mce/sample/lists/template_list.js",
			external_link_list_url : "<?php echo JURI::base()?>components/<?php echo getComponentName()?>/assets/tiny_mce/sample/lists/link_list.js",
			external_image_list_url : "<?php echo JURI::base()?>components/<?php echo getComponentName()?>/assets/tiny_mce/sample/lists/image_list.js",
			media_external_list_url : "<?php echo JURI::base()?>components/<?php echo getComponentName()?>/assets/tiny_mce/sample/lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
			
		});*/
	})
	
</script>

<form action="index.php" method="post" name="adminForm">
	<fieldset class="adminform">
		<legend><?php echo JText::_('LNG_EMAIL_DETAILS'); ?></legend>
		<center>
		<TABLE class="admintable" align=center border=0>
			<TR>
				<TD width=10% nowrap class="key"><?php echo JText::_('LNG_NAME'); ?> :</TD>
				<TD nowrap width=1% align=left>
					<input 
						type		= "text"
						name		= "email_name"
						id			= "email_name"
						value		= '<?php echo $this->item->email_name?>'
						size		= 32
						maxlength	= 128
						AUTOCOMPLETE=OFF
					/>
				</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD width=10% nowrap class="key"><?php echo JText::_('LNG_TYPE'); ?> :</TD>
				<TD nowrap colspan=2 align=left>
					<select
						id 		= "email_type"
						name	= "email_type"
						style	= "width:145px"
					>
						<option <?php echo $this->item->email_type=='Review Email'? "selected" : ""?> value='Review Email'><?php echo JText::_('LNG_REVIEW_EMAIL'); ?></option>
						<option <?php echo $this->item->email_type=='Review Response Email'? "selected" : ""?> value='Review Response Email'><?php echo JText::_('LNG_REVIEW_RESPONSE_EMAIL'); ?></option>
						<option <?php echo $this->item->email_type=='Claim Response Email'? "selected" : ""?> value='Claim Response Email'><?php echo JText::_('LNG_CLAIM_RESPONSE_EMAIL'); ?></option>
						<option <?php echo $this->item->email_type=='Claim Negative Response Email'? "selected" : ""?> value='Claim Negative Response Email'><?php echo JText::_('LNG_CLAIM_NEGATIVE_RESPONSE_EMAIL'); ?></option>
					</select>
				</TD>
			</TR>
			<TR>
				<TD width=10% nowrap class="key"><?php echo JText::_('LNG_SUBJECT'); ?> :</TD>
				<TD nowrap width=1% align=left>
					<input 
						type		= "text"
						name		= "email_subject"
						id			= "email_subject"
						value		= '<?php echo $this->item->email_subject?>'
						size		= 32
						maxlength	= 128
						AUTOCOMPLETE=OFF
					/>
				</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD width=10% nowrap class="key"> <?php echo JText::_('LNG_CONTENT'); ?> :</TD>
				<TD nowrap colspan=2 ALIGN=LEFT>
					<?php echo JText::_("LNG_USE_ONE_OF_EMAILS_TAG_IN_THE_EDITOR_TO_INSERT_CONTENT_WHEN_EMAIL_IS_SENT")?>
					<select style='text-align:center; clear:both'
						onchange = 	"
										if( this.value != '')
										{
											// var oEditor = FCKeditorAPI.GetInstance('email_content') ;
											// var v= (oFCKeditor._HTMLEncode(this.value));
											// oEditor.InsertHtml(v);
											tinyMCE.execCommand('mceReplaceContent',false,this.value);
										}
									"
					>
						<option></option>
						<option value="<?php echo htmlentities(EMAIL_FIRST_NAME)?>"><?php echo htmlspecialchars(EMAIL_FIRST_NAME)?></option>
						<option value='<?php echo htmlentities(EMAIL_LAST_NAME)?>'><?php echo htmlentities(EMAIL_LAST_NAME)?></option>
						<option value='<?php echo htmlentities(EMAIL_COMPANY_NAME)?>'><?php echo htmlentities(EMAIL_COMPANY_NAME)?></option>
						<option value='<?php echo htmlentities(EMAIL_REVIEW_LINK)?>'><?php echo htmlentities(EMAIL_REVIEW_LINK)?></option>

					</select>
					<BR>					<BR>
					
					<!-- textarea style="clear:both;width:700px"  id='email_content' name='email_content' rows=20 cols=140><?php echo $this->item->email_content?></textarea-->
					<?php
						$editor = JFactory::getEditor();
						echo $editor->display('email_content', $this->item->email_content, '750', '400', '60', '20', false);
					?>
					
				</TD>
			</TR>
		</TABLE>
	</fieldset>
	<script  type="text/javascript">
	<?php
	if( getCurrentJoomlaVersion() < 1.6 )
	{
	?>
	function submitbutton(pressbutton) 
	<?php
	}
	else
	{
	?>
	Joomla.submitbutton = function(pressbutton) 
	<?php
	}
	?>
	{
		var form = document.adminForm;
		if (pressbutton == 'save') 
		{
			if( !validateField( form.elements['email_name'], 'string', false, "<?php echo JText::_('LNG_PLEASE_INSERT_EMAIL_NAME'); ?>" ) )
				return false;
			//if( !validateField( form.email_description, 'string', false, "Please insert content email !" ) )
			//	return false;
		
			submitform( pressbutton );
			return;
		} else {
			submitform( pressbutton );
		}
	}
	</script>

	<input type="hidden" name="option" value="<?php echo getComponentName()?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="email_id" value="<?php echo $this->item->email_id ?>" />
	<input type="hidden" name="is_default" value="<?php echo $this->item->is_default?>" />
	<input type="hidden" name="controller" value="manageemails" />
	<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<?php
}
?>

