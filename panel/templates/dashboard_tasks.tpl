{include "templates/dashboard_header.tpl"}

<link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_tasks.css'>
<script src="js/tasks.js"></script>

<div class="d-flex flex-column flex-fill p-3">

    {foreach from=$tasks item=task}

        <div class="d-flex flex-column my-2">

            <div class="task-card card">
                <div class="card-header bg-dark d-flex justify-content-between">

                    <div class="task-header-group">
                        <span class="badge {if $task->priority eq 0} bg-danger"> HIGH {elseif $task->priority eq 1} bg-warning text-dark"> MEDIUM {elseif $task->priority eq 2} bg-primary"> LOW {/if}</span> 
                        <label class="text-white">{$task->title}</label>
                        <label class="task-owner fw-light">(Created by {$task->owner})</label>
                    </div>

                    <div class="task-header-group">
                        <span class="badge {if $task->status eq "PENDING"} bg-warning text-dark "> Pending {elseif $task->status eq "PROGRESS"} bg-primary"> In progress {elseif $task->status eq "FINISHED"} bg-success"> Finished {/if}</span> 
                        
                        <label class="text-white">Elapsed: <span class="time" id="time-{$task->ulid}" data-time="{$task->time}">{$task->time|formatElapsedTime:true:true:true}</span></label>
                        <input class="task-action-toggle form-check-input" type="checkbox" data-ulid="{$task->ulid}">
                        
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                {if $task->status eq "PENDING" or $task->status eq "PROGRESS"}
                                    <li><a class="dropdown-item" href="tasks/finish/{$task->ulid}"><i class="fa-solid fa-flag-checkered"></i> Finish</a></li>
                                {else}
                                    <li><a class="dropdown-item" href="tasks/retake/{$task->ulid}"><i class="fa-solid fa-rotate-left"></i> Re-take</a></li>
                                {/if}
                                <li><a class="dropdown-item" href="tasks/edit/{$task->ulid}"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="tasks/delete/{$task->ulid}"><i class="fa-solid fa-trash"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary"><a href="{$task->url}" class="card-link">{$task->sitename}</a></h6>
                    <p class="card-text">{$task->details}</p>
                </div>

            </div>
        </div>
    {/foreach}

    {if $finishedTasks}<div class="horizonal-divider"><label>FINISHED</label></div>{/if}

    <div class="mt-4">

    {foreach from=$finishedTasks item=task}

        <div class="d-flex flex-column my-2">

            <div class="task-card card">
                <div class="card-header bg-dark d-flex justify-content-between">

                    <div class="task-header-group">
                        <span class="badge {if $task->priority eq 0} bg-danger"> HIGH {elseif $task->priority eq 1} bg-warning text-dark"> MEDIUM {elseif $task->priority eq 2} bg-primary"> LOW {/if}</span> 
                        <label class="text-white">{$task->title}</label>
                        <label class="task-owner fw-light">(Created by {$task->owner})</label>
                    </div>

                    <div class="task-header-group">
                        <span class="badge {if $task->status eq "PENDING"} bg-warning text-dark "> Pending {elseif $task->status eq "PROGRESS"} bg-primary"> In progress {elseif $task->status eq "FINISHED"} bg-success"> Finished {/if}</span> 
                        <label class="text-white">Elapsed: <span class="time" id="time-{$task->ulid}" data-time="{$task->time}">{$task->time|formatElapsedTime}</span></label>
                        <a class="btn btn-sm btn-secondary" href="tasks/retake/{$task->ulid}"><i class="fa-solid fa-rotate-left"></i> Re-take</a>
                    </div>

                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-body-secondary"><a href="{$task->url}" class="card-link">{$task->sitename}</a></h6>
                    <p class="card-text">{$task->details}</p>
                </div>

            </div>
        </div>
    {/foreach}

    </div>

</div>

<div class="task-options d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
    <label class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold"><i class="fa-solid fa-list-check"></i> Create new task</span>
    </label>

    <form class="m-3" method="POST" action="tasks/create">

        <div class="mb-3">
            <label class="form-label">Site</label>
            <select class="form-select" name="task_site_id">
                {foreach from=$sites item=site}
                    <option value="{$site->id}">{$site->sitename}</option>
                {/foreach}
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select user </label>
            <select class="form-select" name="task_user_id">
                {foreach from=$users item=user}
                    <option value="{$user->id}">{$user->username}</option>
                {/foreach}
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Task title</label>
            <input type="text" class="form-control" name="task_title">
        </div>

        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea class="form-control task-details" name="task_details"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Priority</label>
            <select class="form-select" name="task_priority">
                <option value="0">HIGH</option>
                <option value="1">MEDIUM</option>
                <option value="2">LOW</option>
            </select>
        </div>

        <div class="mb-3 d-grid">
            <button type="submit" class="btn btn-primary">Create <i class="fa-solid fa-plus"></i></button>
        </div>

    </form>



</div>


{include "templates/dashboard_footer.tpl"}