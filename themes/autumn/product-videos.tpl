{if ($product->name|in_array:['Genese Desk','UP Stool','WorkFit-T','oyo','Extension Kit',
'Under Desk Management','Basket','QuickClick - Long Rail','Basic Cable Spiral','QuickClick - Sleigh',
'Cable Spring','Liftpipe','QuickClick CPU Holder','Wide CPU Holder','Muvman Stool']) || ($product_manufacturer->name)=='Lifespan'}

    <div class="block"><p class="title_block no-bmar popular-prod">{l s='Product Video' mod='blockviewed'}</p></div>
    <div id="embedvideo">
        <iframe src=
        "{if ($product->name)=='Genese Desk'}
           //www.youtube.com/embed/-Tu7_0BrJKc
           {elseif ($product->name)=='UP Stool'}
           //www.youtube.com/embed/nOZ4egn_MDs
           {elseif ($product->name)=='WorkFit-T'}
           //www.youtube.com/embed/1c9kQC5AVJs
           {elseif ($product_manufacturer->name)=='Lifespan'}
           //www.youtube.com/embed/rSZBovwHG1Q
           {elseif ($product->name)=='oyo'}
           //www.youtube.com/embed/BIZfpQZH2Gc
           {elseif ($product->name)=='Muvman Stool'}
           //www.youtube.com/embed/-sv6i27EmyE
           {elseif ($product->name|in_array:['Extension Kit','Under Desk Management',
                  'Basket','QuickClick - Long Rail' ,'Basic Cable Spiral','QuickClick - Sleigh',
                  'Cable Spring','Liftpipe','QuickClick CPU Holder','Wide CPU Holder'])}
            //www.youtube.com/embed/C1j_U1AKzsQ
        {/if}"
        width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
    </div>

    {elseif ($product->name|in_array:['Hush Desk','MonoPro']) || ($product_manufacturer->name)=='Varidesk'}

    <div class="block"><p class="title_block no-bmar popular-prod">{l s='Product Videos' mod='blockviewed'}</p></div>

    <div id="embedvideo1">
        <iframe src=
                "{if ($product->name|in_array:['Hush Desk','MonoPro'])}
               //www.youtube.com/embed/ibE36XjjfhI
               {elseif ($product_manufacturer->name)=='Varidesk'}
               //www.youtube.com/embed/KwDaHPVHsnM
               {/if}" width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>


    <div id="embedvideo">
        <iframe src=
                "{if ($product_manufacturer->name)=='Varidesk'}
               //player.vimeo.com/video/119976615
               {elseif ($product->name)=='Hush Desk'}
               //player.vimeo.com/video/116860385
               {elseif ($product->name)=='MonoPro'}
               //www.youtube.com/embed/C1j_U1AKzsQ
               {/if} " width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>

    {elseif ($product->name|in_array:['DeskPro 1','DeskPro 2X','Swopper CLASSIC','Swopper STANDARD',
    'Swopper AIR' ,'Swopper SADDLE','Swopper WORK','Yo-Yo Desk 90',
    'Yo-Yo Desk MINI','Yo-Yo Desk 120','Yo-Yo Desk GO1','Yo-Yo Desk GO2',
    'Collaborate Double Desk','BenchPro Double Desk','DeskPro 3X','DeskPro S',
    'DeskPro 3S','Freedesk'])}
    <div class="block"><p class="title_block no-bmar popular-prod">{l s='Product Videos' mod='blockviewed'}</p></div>

    <div id="embedvideo2">
        <iframe src=
                "{if ($product->name)=='DeskPro 1'}
               //www.youtube.com/embed/p4OeVn6QIcc
               {elseif ($product->name)=='DeskPro 2X'}
               //www.youtube.com/embed/ibE36XjjfhI
               {elseif ($product->name|in_array:['Swopper CLASSIC','Swopper STANDARD','Swopper AIR',
                'Swopper SADDLE','Swopper WORK'])}
               //www.youtube.com/embed/1XC9b9VC6xk
               {elseif ($product->name|in_array:['Yo-Yo Desk 90','Yo-Yo Desk MINI','Yo-Yo Desk 120'])}
               //www.youtube.com/embed/imrQ3z03W9U
               {elseif ($product->name|in_array:['Yo-Yo Desk GO1','Yo-Yo Desk GO2'])}
               //www.youtube.com/embed/BUVwYaKJ4Pc
               {elseif ($product->name|in_array:['Collaborate Double Desk','BenchPro Double Desk','DeskPro 3X',
                'DeskPro S','DeskPro 3S','Freedesk'])}
                //www.youtube.com/embed/p4OeVn6QIcc
               {/if} " width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>

    <div id="embedvideo1">
        <iframe src=
                "{if ($product->name|in_array:['DeskPro 1','DeskPro 2X'])}
               //www.youtube.com/embed/C1j_U1AKzsQ
               {elseif ($product->name|in_array:['Swopper CLASSIC','Swopper STANDARD','Swopper AIR',
                'Swopper SADDLE','Swopper WORK'])}
                //www.youtube.com/embed/oo0TwkvqAtI
                {elseif ($product->name|in_array:['Yo-Yo Desk 90','Yo-Yo Desk MINI','Yo-Yo Desk 120',
                                                  'Yo-Yo Desk GO1','Yo-Yo Desk GO2'])}
                //www.youtube.com/embed/oTYGOvbX_is
               {elseif ($product->name)=='Collaborate Double Desk'}
               //www.youtube.com/embed/1J11jChs2Nk
               {elseif ($product->name|in_array:['BenchPro Double Desk','DeskPro 3X','DeskPro S'])}
               //www.youtube.com/embed/C1j_U1AKzsQ
               {elseif ($product->name)=='DeskPro 3S'}
               //www.youtube.com/embed/5JyPfz7G7zM
               {elseif ($product->name)=='Freedesk'}
               //www.youtube.com/embed/h0PRDBPvqMk
               {/if} " width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>

    <div id="embedvideo">
        <iframe src=
                "{if ($product->name)=='DeskPro 1'}
               //www.youtube.com/embed/NmoKqjqN-Gw
               {elseif ($product->name)=='DeskPro 2X'}
               //www.youtube.com/embed/gvgzC-mk4jc
               {elseif ($product->name|in_array:['Swopper CLASSIC','Swopper STANDARD','Swopper AIR',
                'Swopper SADDLE','Swopper WORK'])}
                //www.youtube.com/embed/X-sKT3lO1J4
                {elseif ($product->name|in_array:['Yo-Yo Desk 90','Yo-Yo Desk MINI','Yo-Yo Desk 120',
                'Yo-Yo Desk GO1','Yo-Yo Desk GO2'])}
                //www.youtube.com/embed/0MPHdv_uYQw
                {elseif ($product->name)=='Collaborate Double Desk'}
               //www.youtube.com/embed/foPMbIlg79w
               {elseif ($product->name)=='BenchPro Double Desk'}
               //www.youtube.com/embed/kNzrz0ChhmM
               {elseif ($product->name)=='DeskPro 3X'}
               //www.youtube.com/embed/BKRKGvGBt4A
               {elseif ($product->name|in_array:['DeskPro S','DeskPro 3S'])}
               //www.youtube.com/embed/-dl3avpgLcY
               {elseif ($product->name)=='Freedesk'}
               //www.youtube.com/embed/OoHGlGp9Rk0
               {/if}" width="100%"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    </div>


    {elseif ($category->name)=='Desk Risers' or ($category->name)=='Sit-Stand Desks'}

    <div id="embedvideo1">
        <iframe src="//www.youtube.com/embed/ibE36XjjfhI" width="100%"  frameborder="0"
                allowfullscreen="allowfullscreen"></iframe>
    </div>

    <div id="embedvideo">
        <iframe src="//www.youtube.com/embed/p4OeVn6QIcc" width="100%"  frameborder="0"
                allowfullscreen="allowfullscreen"></iframe>
    </div>
{/if}