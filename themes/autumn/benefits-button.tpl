{for $foo=1 to 3}
    <div class="yybutton {if (($page_name == 'benefits') && ($foo==1)) ||(($page_name == 'matbenefits') && ($foo==2)) ||
    (($page_name == 'seatbenefits') && ($foo==3))
    }yybutton-red{else}yybutton-grey{/if}" style="display: inline-block;width: 220px;">

        <a href="{if ($foo==1)}/benefits{elseif ($foo==2)}/mat-benefits{else}/active-seating-benefits{/if}">
            <div class="yybutton-cont">
                <img src="/img/list/5ticks.png" class="yybutton-image" style="{if ($foo==1)}margin-right:15px{elseif ($foo==2)}margin-right:20px{/if}" />

                <div class="yybutton-textcont">
                    <div class="yybutton-text">
                        {if ($foo==1)}
                            Benefits of Standing
                        {elseif ($foo==2)}
                            Benefits of a Mat
                        {else}
                            Benefits of Active Seats
                        {/if}

                    </div><br/>
                </div>
            </div>
        </a>
    </div>

{/for}