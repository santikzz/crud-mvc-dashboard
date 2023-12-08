{include "templates/dashboard_header.tpl"}

<link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_licenses.css'>
<script src="js/licenses.js"></script>


{* ================= CREATE LICENSE MODAL ================= *}
<div class="modal fade" tabindex="-1" id="create-key-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Create new key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <form method="POST" action="licenses/create">
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Product name / id</label>
                <select class="form-select" name="key_product_id">
                    {foreach from=$products item=product}
                        <option value="{$product->id}">({$product->game_name}) {$product->product_name}</option>
                    {/foreach}
                </select>
            </div>
            
            <div class="d-flex gap-2">
                <label class="form-label">Time</label>
                <div class="form-check">
                    <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier" value="time_hours">
                    <label class="form-check-label">
                        Hours
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier" value="time_days" checked>
                    <label class="form-check-label">
                        Days
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier" value="time_lifetime" id="key-lifetime-checkbox">
                    <label class="form-check-label">
                        Lifetime
                    </label>
                </div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-clock"></i></span>
                <input type="number" class="form-control" name="key_time" value="7" id="key-time-input">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-note-sticky"></i></span>
                    <input type="text" class="form-control" name="key_description" placeholder="@kiroshi">
                </div>
            </div>

        </div>
            
            <div class="modal-footer d-grid modal-btn-large">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
            </div>

        </form>

        </div>
    </div>
</div> {* ================= END CREATE LICENSE MODAL ================= *}

{* ================= MODIFY LICENSE MODAL ================= *}
<div class="modal fade" tabindex="-1" id="modify-key-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Modify key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <form method="POST" action="licenses/create">
                    
                    <div class="modal-body">

                    <div class="d-flex flex-inline">

                        <div class="left">

                                <div class="mb-3">
                                    <label class="form-label edit-key-keyholder">#key</label>
                                    <label class="form-label edit-key-productname">#product</label>
                                </div>

                                <div class="d-flex gap-2">
                                    <label class="form-label">Time</label>
                                    <div class="form-check">
                                        <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier"
                                            value="time_hours">
                                        <label class="form-check-label">
                                            Hours
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier"
                                            value="time_days" checked>
                                        <label class="form-check-label">
                                            Days
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input key-time-radio" type="radio" name="key_time_modifier"
                                            value="time_lifetime" id="key-lifetime-checkbox">
                                        <label class="form-check-label">
                                            Lifetime
                                        </label>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-clock"></i></span>
                                    <input type="number" class="form-control" name="key_time" value="7" id="key-time-input">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa-solid fa-note-sticky"></i></span>
                                        <input type="text" class="form-control" name="key_description" placeholder="@kiroshi">
                                    </div>
                                </div>

                        </div>

                        <div class="vr mx-4"></div>

                        <div class="right">
                                a
                        </div>

                    </div>

                </div>
            
            <div class="modal-footer d-grid modal-btn-large">
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Confirm</button>
            </div>

        </form>

        </div>
    </div>
</div> {* ================= END MODIFY LICENSE MODAL ================= *}


{* ================= DELETE LICENSE MODAL ================= *}
<div class="modal fade" tabindex="-1" id="delete-key-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-trash"></i> Delete key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="licenses/delete">
                <div class="modal-body">    
                    <div class="mb-3">
                        <h4>Are you sure you want to delete this key?</h4>
                    </div>  
                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END DELETE LICENSE MODAL ================= *}

<div class="d-flex flex-column flex-fill p-3">


    <div class="d-flex flex-inline justify-content-between ">
    
        <div class="d-flex flex-inline gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-key-modal" id="create-key-btn">
                <i class="fa-solid fa-plus"></i> Create key
            </button>
        </div>
        
        <div class="d-flex flex-inline gap-2">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter <i class="fa-solid fa-filter"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">nothing here yet</a></li>
                </ul>
            </div>
            <div class="vr mx-2"></div>
            <button class="btn btn-primary"><i class="fa-solid fa-key"></i> Total keys n/a</button>
            <button class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> Used keys n/a</button>
            <button class="btn btn-primary"><i class="fa-solid fa-stopwatch"></i> Expired keys n/a</button>
            <button class="btn btn-danger"><i class="fa-solid fa-ban"></i> Banned keys n/a</button>

        </div>
    </div>

    
    <div class="my-3">

        <table class="table table-striped table-sm table-rounded">
            <thead class="table-dark">
                <tr>
                    <th scope="col">KEY</th>
                    <th scope="col">HWID</th>
                    <th scope="col">PRODUCT ID</th>
                    <th scope="col text-center">DURATION</th>
                    <th scope="col text-center">TIME LEFT</th>
                    <th scope="col text-center">STATUS</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                {foreach from=$licenses item=key}

                    <tr>
                        <td>{$key->product_key}</th>
                        <td>{if $key->hwid eq "none"} -- not used -- {elseif $key->hwid eq "RESET"} <b>-- HWID RESET --</b> {else} {$key->hwid} {/if} </td>
                        <td>{$key->product_name}</td>
                        <td class="text-center">{if $key->lifetime eq 1} LIFETIME {else} {$key->duration|formatElapsedTime:true:false:false} {/if}</td>
                        <td class="text-center">
                            {if $key->lifetime eq 1} 
                                <i class="fa-solid fa-infinity"></i> 
                            {else} 
                                {if $key->activation_date eq 0}
                                    --
                                {else} 

                                    {if ($key->activation_date + $key->duration - $current_time) > 0}
                                        {($key->activation_date + $key->duration - $current_time)|formatElapsedTime:true:true:false} 
                                    {else}
                                        --
                                    {/if}
                                {/if} 
                            {/if}
                        </td>

                        <td class="text-center"><span class="badge 
                            {if $key->banned eq 1} bg-danger"> Banned {else}
                                {if $key->status eq "EXPIRED"} bg-warning text-dark"> Expired
                                {elseif $key->status eq "UNUSED"} bg-success"> Not used
                                {elseif $key->status eq "USED"} bg-primary"> Activated
                                {/if}
                            {/if}
                        </span></td>
                        <td>{$key->description}</td>
   
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                
                                    <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modify-key-modal" id="modify-key-btn"><i class="fa-regular fa-pen-to-square"></i> Modify</a></li>
                                    <li><a class="dropdown-item" href="licenses/resethwid/{$key->id}"><i class="fa-solid fa-rotate-left"></i> Reset HWID</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="licenses/delete/{$key->id}"><i class="fa-solid fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>

                    </tr>

                {/foreach}

            </tbody>
        </table>

    </div>



</div>



{include "templates/dashboard_footer.tpl"}