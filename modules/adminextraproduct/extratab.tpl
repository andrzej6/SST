<div id="extra-tab" class="panel product-tab">
	<h3 class="tab"> <i class="icon-info"></i> {l s='Extra Product Information'}</h3>


    {foreach from=$ad_extrafields item=ad_extrafield name=extrafields}


        {if $smarty.foreach.extrafields.index < 7}
			<!-- EXTRA FIELD -->
			<div class="form-group">
				<label for="ad_extrafield{$smarty.foreach.extrafields.index+1}" class="control-label col-lg-3 ">
					Extra Field {$smarty.foreach.extrafields.index+1}
				</label>

				<div class="col-lg-9">
					{assign var=use_textarea_autosize value=true}
					<textarea name="ad_extrafield{$smarty.foreach.extrafields.index+1}" id="ad_extrafield{$smarty.foreach.extrafields.index+1}" cols="136" rows="10" class="rte autoload_rte">
						{$ad_extrafield}
					</textarea>
				</div>
			</div>

			{else}

			<!-- EXTRA FIELD -->
			<div class="form-group">
				<label for="ad_extrafield{$smarty.foreach.extrafields.index+1}" class="control-label col-lg-3 ">
					Extra Field {$smarty.foreach.extrafields.index+1}
				</label>

				<div class="col-lg-9">
					<input type="text" id="ad_extrafield{$smarty.foreach.extrafields.index+1}" class="updateCurrentText" name="ad_extrafield{$smarty.foreach.extrafields.index+1}" value="{$ad_extrafield}" >
				</div>
			</div>


		{/if}



    {/foreach}




	
	
	<div class="panel-footer">
		<a href="{$link->getAdminLink('AdminProducts')}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel'}</a>
		<button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save'}</button>
		<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay'}</button>
	</div>
</div>

{if isset($tinymce) && $tinymce}
	<script type="text/javascript">
        var iso = '{$iso|addslashes}';
        var pathCSS = '{$smarty.const._THEME_CSS_DIR_|addslashes}';
        var ad = '{$ad|addslashes}';

        $(document).ready(function(){
            {block name="autoload_tinyMCE"}
            tinySetup({
                editor_selector :"autoload_rte"
            });
            {/block}
        });
	</script>
{/if}
