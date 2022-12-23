<style>
    /* Progress bar container */
    .progress-container {
        width: 50%;
        background: #eee;
        border-radius: 20px;
        padding: 2px;
    }

    /* Progress bar */
    progress {
        -webkit-appearance: none;
        appearance: none;
        height: 20px;
        background: #eee;
        border-radius: 20px;
        width: 100%;
    }

    /* Progress bar value */
    progress::-webkit-progress-value {
        background: #0073aa;
        border-radius: 20px;
    }

    progress::-moz-progress-bar {
        background: #0073aa;
        border-radius: 20px;
    }

    button {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .5rem 1rem;
        line-height: 1.25;
        border-radius: .3rem;
        -webkit-transition: all .15s ease-in-out;
        transition: all .15s ease-in-out;
        color: #0073aa; /* WordPress blue color */
        background-color: #fff; /* White background color */
        border-color: #0073aa; /* WordPress blue border color */
        cursor: pointer; /* Show a pointer cursor on hover */
    }

    button:hover {
        color: #fff; /* White text color on hover */
        background-color: #0073aa; /* WordPress blue background color on hover */
        border-color: #0073aa; /* WordPress blue border color on hover */
    }

    button:active {
        color: #fff; /* White text color on active */
        background-color: #004761; /* Darker WordPress blue background color on active */
        border-color: #004761; /* Darker WordPress blue border color on active */
    }

    button:focus {
        outline: 0; /* Remove the default focus outline */
    }


</style>


<div class="progress-container">
    <progress id="orderIndexProgress" value="0" max="100"></progress>
</div>

<button type="button" id="startIndex">Start Index</button>


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

