<!-- mp_tag_canvas/template/mpTagCanvas.tpl -->

<!--[if lt IE 9]><script type="text/javascript" src="{$modulePath}vendor/excanvas/excanvas.js"></script><![endif]-->
<script src="{$modulePath}vendor/tagcanvas/jquery.tagcanvas.min.js" type="text/javascript"></script>

<div class="mpTagCanvas">
    <div id="{$canvasContainerId}">
        {if $noCanvasStyles == '1'}
        <canvas id="{$canvasId}">
        {else}
        <canvas style="{$canvasStyles}" id="{$canvasId}">
        {/if}
            <p>{$canvasText}</p>
        </canvas>
    </div>

    <div id="{$tagsId}">
        <ul>
            {foreach from=$entries item=entry}
            <li>{$entry}</li>
            {/foreach}
        </ul>
    </div>

    <script type="text/javascript">
    (function($) {
        $(function() {
            var result = $('#{$canvasId}').tagcanvas({$options}, '{$tagsId}');
            if (false === result) {
                $('#{$canvasContainerId}').hide();
            }
        });
    })(jQuery);
    </script>
</div>

<!-- /mp_tag_canvas/template/mpTagCanvas.tpl -->
