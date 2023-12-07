{include "templates/dashboard_header.tpl"}

<link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_tasks.css'>
<script src="js/tasks.js"></script>

<div class="d-flex flex-column flex-fill p-3">

{foreach from=$statistics item=stat}
    <label>Total time lost on '{$stat->sitename}' (<b>{$stat->total_time|formatElapsedTime:true:true:true}</b>) (Done {$stat->finished_tasks} of {$stat->total_tasks})</label>
    </br>
{/foreach}

</div>


{include "templates/dashboard_footer.tpl"}