<div class="barclaycardcw-alias-pane">
	<form class="horizontal-form barclaycardcw-alias-form" action="{$link->getModuleLink('barclaycardcw', 'payment', array(), true)}" method="POST">
	<input type="hidden" name="id_module" value="{$moduleId}" />
	{if isset($aliasTransactions) && count($aliasTransactions) > 0 && isset($selectedAlias) && !empty($selectedAlias) && $selectedAlias != 'new'}
		<div class="form-group">
			<label for="barclaycardcw_alias" class="control-label col-sm-4">{lcw s='Use stored Card' mod='barclaycardcw'}</label>
			<div class="col-sm-8">
				<select name="barclaycardcw_alias" id="barclaycardcw_alias" class="form-control">
					{foreach item=transaction from=$aliasTransactions}
						<option 
						{if isset($selectedAlias) && $selectedAlias == $transaction->getTransactionId()}
							selected="selected" 
						{/if}
						value="{$transaction->getTransactionId()}">{$transaction->getAliasForDisplay()}</option>
					{/foreach}
				</select>
			</div>
		</div>
	{/if}
	
	{if !isset($selectedAlias) || empty($selectedAlias) || $selectedAlias == 'new'}
		<div class="form-group">
			<div class="">
				<div class="checkbox">
					<label>
						<input type="hidden" name="barclaycardcw_create_new_alias_present" value="active" />
						<input type="checkbox" name="barclaycardcw_create_new_alias" value="on"
						{if $selectedAlias == 'new'} checked="checked" {/if}
						 /> {lcw s='Store card information' mod='barclaycardcw'}
					</label>
				</div>
			</div>
		</div>
	{/if}
	
		<div class="form-group">
		
			{if isset($selectedAlias) && !empty($selectedAlias) && $selectedAlias != 'new'}
				<input type="submit" name="barclaycardcw_alias_use_new_card" class="btn btn-default" value="{lcw s='Use new card' mod='barclaycardcw'}" />
			{elseif isset($aliasTransactions) && count($aliasTransactions) > 0 && (!isset($selectedAlias) || empty($selectedAlias) || $selectedAlias == 'new')}
				<input type="submit" name="barclaycardcw_alias_use_stored_card" class="btn btn-default" value="{lcw s='Use stored card' mod='barclaycardcw'}" />
			{/if}
			<noscript>
				<input type="submit" class="btn btn-default" name="update_alias" value="{lcw s='Update' mod='barclaycardcw'}" />
			</noscript>
			
		</div>
	
	</form>
	
</div>