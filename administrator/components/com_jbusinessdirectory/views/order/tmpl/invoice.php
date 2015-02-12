<?php // no direct access
/**
 * @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('_JEXEC') or die('Restricted access');

?>
<div>
	<h1>Invoice</h1>
	<div>
		<table width="95%">
			<tbody>
				<tr>
					<td valign="top" align="left"><table>
							<tbody>
								<tr>
									<td><b><?php echo JText::_('LNG_INVOICE_NUMBER'); ?>: </b></td>
									<td><?php echo $this->item->id ?></td>
								</tr>
								<tr>
									<td><b><?php echo JText::_('LNG_INVOICE_DATE'); ?>:</b></td>
									<td><?php echo $this->item->created ?></td>
								</tr>
								<tr>
									<td><b><?php echo JText::_('LNG_ORDER_ID'); ?>:</b></td>
									<td><?php echo $this->item->order_id ?></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="40%">
						<strong><?php echo  $this->item->company->name?></strong><br/>
						<?php echo $this->item->company->street_number?> <?php echo $this->item->company->address?>, <?php echo  $this->item->company->city?>, <br/>
						<?php echo  $this->item->company->postalCode?>, <?php echo  $this->item->company->country_name?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<table class="address" width="95%">
		<tbody>
			<tr bgcolor="#D9E5EE" class="heading">
				<td width="50%"><b><?php echo JText::_('LNG_TO'); ?></b></td>
			</tr>
			<tr>
				<td><?php echo $this->item->user_name ?></td>
			</tr>
		</tbody>
	</table>
	<br/>

	<table class="product" width="95%">

		<tbody>
			<tr  bgcolor="#D9E5EE" class="heading">
				<td><b><?php echo JText::_('LNG_PRODUCT_SERVICE'); ?></b></td>
				<td><b><?php echo JText::_('LNG_DESCRIPTION'); ?></b></td>
				<td align="right"><b><?php echo JText::_('LNG_QUANTITY'); ?></b></td>
				<td align="right"><b><?php echo JText::_('LNG_UNIT_PRICE'); ?></b></td>
				<td align="right"><b><?php echo JText::_('LNG_TOTAL'); ?></b></td>
			</tr>
			
			<tr>
				<td><?php echo $this->item->service ?></td>
				<td><?php echo $this->item->description ?></td>
				<td align="right">1</td>
				<td align="right"><?php echo $this->item->package->price ?></td>
				<td align="right"><?php echo $this->item->package->price ?></td>
			</tr>
			<tr>
				<td align="right" colspan="4"><b><?php echo JText::_('LNG_SUB_TOTAL'); ?>:</b></td>
				<td align="right"><?php echo number_format($this->item->package->price,2) ?> <?php echo $this->appSettings->currency_name?></td>
			</tr>
			<?php if($this->appSettings->vat>0){?>
				<tr>
					<td align="right" colspan="4"><b><?php echo JText::_('LNG_VAT'); ?> (<?php echo $this->appSettings->vat?>%):</b></td>
					<td align="right"><?php echo number_format($this->item->package->price * $this->appSettings->vat/100,2)?> <?php echo $this->appSettings->currency_name?></td>
				</tr>
			<?php } ?>
			<tr>
				<td align="right" colspan="4"><b><?php echo JText::_('LNG_TOTAL'); ?>:</b></td>
				<td align="right"><?php echo number_format($this->item->package->price + $this->item->package->price * $this->appSettings->vat/100,2) ?> <?php echo $this->appSettings->currency_name?></td>
			</tr>
		</tbody>
	</table>


	<div class="printbutton">
		<a onclick="window.print()" href="javascript:void(0);"><?php echo JText::_("LNG_PRINT")?></a>
	</div>

</div>
