<div class="width-100">
<fieldset class='adminform'>
	<legend><?php echo JText::_('LNG_FRONT_END_STYLE'); ?></legend>
	<TABLE class='admintable'  width=100%>
	<?php 
	foreach($this->item->defaultAtrributes as $attribute){
	?>
		<tr>
			<td class="key">
				<?php echo $attribute->name?>
			</td>
			<td>
				<select name="attribute-<?php echo $attribute->id ?>" class="inputbox input-medium">
					<?php echo JHtml::_('select.options', $this->attributeConfiguration, 'value', 'text', $attribute->config);?>
				</select>
			</td>
		</tr>
	<?php }?>
	</TABLE>
</fieldset>
</div>