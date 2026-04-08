{breadcrumbs}<a href="{$GLOBALS.site_url}/task-scheduler-settings/">[[Task Scheduler Settings]]</a> / [[Log View]]{/breadcrumbs}

<div class="page-title">
    <h1 class="title">[[Log View]]</h1>
</div>
<div class="panel panel--default panel--wide">
    <p>[[Show last 200 records from logs]]</p>
    <textarea style="width:100%;height:400px;font-size:0.9em;" readonly="readonly">{foreach from=$log_content item=record}{$record}{/foreach}</textarea>
</div>
