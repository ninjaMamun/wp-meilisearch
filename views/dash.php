<div class="progress-container">
    <progress id="orderIndexProgress" value="0" max="100"></progress>
    <button type="button" id="startIndex">Start Index</button>
</div>


<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#startIndex').click(function () {
            indexOrders();
        })
    });

    async function indexOrders() {

        let response = await callAjax({
            'task': "countOrders",
        })

        let limit = 100;
        let totalOrders = response.count;
        let totalPage = Math.ceil(totalOrders / limit);

        renderProgress(0, {page: 0});
        let page = 1;
        while (page <= totalPage) {

            let resp = await callAjax({
                'task': "indexOrders",
                'page': page,
                'limit': limit
            });

            let progress = Math.round(page / totalPage * 10000) / 100;
            renderProgress(progress, {page: page});

            page++;
        }
    }

    function renderProgress(progress, extraData) {
        jQuery('#orderIndexProgress').val(progress);
        console.log("Progress: " + progress, extraData);
    }

    async function callAjax(data) {
        return jQuery.ajax({
            url: ajaxurl, // this will point to admin-ajax.php
            type: 'POST',
            data: {...data, action: 'meili_ajax'},
            //success: callback
        });
    }
</script>


<?php

