<table class="table " cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom:10px;">
	<thead>
		<tr class="nodrag nodrop">
			<th>{lcw s='Item' mod='barclaycardcw'}</th>
			<th class="center" width="70px">{lcw s='Action' mod='barclaycardcw'}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$forms item=form}
			<tr class=" row_hover">
				<td>{$form->getTitle()}</td>
				<td class="center">
					<a href="{$link->getAdminLink('AdminBarclaycardCwForm')|escape:'htmlall':'UTF-8'}&form={$form->getMachineName()}" title="{lcw s='View' mod='barclaycardcw'}">
						<img src="../img/admin/details.gif" alt="{lcw s='View' mod='barclaycardcw'}">
					</a>
				</td>
			</tr>
		{/foreach}
	</tbody>
	
	
</table>