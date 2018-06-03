{if isset($category) AND $category->id AND $category->active}

    {$WPAC_categoryHeaderStyle = "|"|explode:$WPAC_categoryHeaderStyle}
    {$categoryHeaderNamePosition = $WPAC_categoryHeaderStyle[0]}
    {$categoryHeaderBreadcrumbPosition = $WPAC_categoryHeaderStyle[1]}

    <div id="category-header" {if $category->id_image}style="background-image: url('{$link->getCatImageLink($category->link_rewrite, $category->id_image, 'atmn_category')|escape:'html'}');background-size: 100% 100%;"{/if}>
        <div class="row parent">

            {if ($categoryHeaderBreadcrumbPosition == $categoryHeaderNamePosition)}

               

                <div class="row">
                    <div class="breadcrumb-wrapper column col-12-12 t-align-{$categoryHeaderBreadcrumbPosition}">
                        {include file="$tpl_dir./breadcrumb.tpl"}
                    </div>
                </div>

            {else}
            
                {if ($categoryHeaderNamePosition == "right")}
                    {$categoryHeaderNameExtraClass = "t-align-right push-6-12"}
                    {$categoryHeaderBreadcrumbExtraClass = "pull-6-12"}
                {else}
                    {$categoryHeaderNameExtraClass = ""}
                    {$categoryHeaderBreadcrumbExtraClass = "t-align-right"}
                {/if}

                <div class="one-row row valign-middle">
                    <div class="category-name column col-6-12 {$categoryHeaderNameExtraClass}">
                        <h1>{$category->name|escape:'htmlall':'UTF-8'}</h1>
                        <span class="category-product-count">
                            {include file="$tpl_dir./category-count.tpl"}
                        </span>
                    </div>

                    <div class="breadcrumb-wrapper column col-6-12 {$categoryHeaderBreadcrumbExtraClass}">
                        &nbsp;&nbsp;&nbsp;{include file="$tpl_dir./breadcrumb.tpl"}
                    </div>
                </div>

            {/if}
            
            
             

        </div>
        
        <div class="sit-stand-blocks"><img src="{$img_dir}/mypic/blocks-light1.png" /></div>
        
       
        
    </div>
{/if}