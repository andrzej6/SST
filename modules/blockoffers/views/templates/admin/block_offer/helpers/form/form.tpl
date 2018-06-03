{extends file="helpers/form/form.tpl"}

{block name="field"}
    {if $input.type == 'file_lang'}
        <div class="col-lg-9">


            <div class="translatable-field lang">

                <div class="form-group">
                    <div class="col-lg-6">
                        <input id="{$input.name}" type="file" name="{$input.name}" class="hide" />
                        <div class="dummyfile input-group">
                            <span class="input-group-addon"><i class="icon-file"></i></span>
                            <input id="{$input.name}-name" type="text" class="disabled" name="filename" readonly />
                            <span class="input-group-btn">
								<button id="{$input.name}-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
                                    <i class="icon-folder-open"></i> {l s='Choose a file'}
                                </button>
							</span>
                        </div>
                    </div>

                </div>
                <div class="form-group">

                    <div id="{$input.name}-images-thumbnails" class="col-lg-12">
                        <img src="{$base_url}modules/blockoffers/views/img/{$simages}" class="img-thumbnail"/>
                    </div>

                </div>

            </div>

            <script>
                $(document).ready(function(){
                    $('#{$input.name}-selectbutton').click(function(e){
                        $('#{$input.name}').trigger('click');
                    });
                    $('#{$input.name}').change(function(e){
                        var val = $(this).val();
                        var file = val.split(/[\\/]/);
                        $('#{$input.name}-name').val(file[file.length-1]);
                    });
                });
            </script>

        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
