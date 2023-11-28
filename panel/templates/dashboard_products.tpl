{include "templates/dashboard_header.tpl"}

<link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_products.css'>

<script src="js/licenses.js"></script>


{* ================= CREATE GAME MODAL ================= *}
<div class="modal fade" tabindex="-1" id="add-game">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Add new game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="products/addgame">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-quote-left"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Overwatch 2">
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </div>

            </form>

        </div>
    </div>
</div> {* ================= END CREATE GAME MODAL ================= *}

{* ================= CREATE GAME MODAL ================= *}
<div class="modal fade" tabindex="-1" id="add-product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Add new game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="products/addproduct">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product ID</label>
                        <select class="form-select" name="game_id">
                            {foreach from=$games item=game}
                                <option value="{$game->id}">{$game->name}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-quote-left"></i></span>
                            <input type="text" class="form-control" name="name"
                                placeholder="nimrod_overwatch2_pixelbot">
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </div>

            </form>

        </div>
    </div>
</div> {* ================= END CREATE GAME MODAL ================= *}


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

    <div class="my-3 d-flex flex-column gap-3">

        <div class="card p-3">
            <h2>Games</h2>
            <table class="table-custom table table-striped table-sm table-rounded">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$games item=key}
                        <tr>
                            <td>{$key->name}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="products/deletegame/{$key->id}"><i
                                                    class="fa-solid fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    {/foreach}
                </tbody>
            </table>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-game"
                id="create-key-btn">
                <i class="fa-solid fa-plus"></i> Add game
            </button>

        </div>

        <div class="card p-3">
            <h2>Products / ID</h2>
            <table class="table-custom table table-striped table-sm table-rounded">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">GAME</th>
                        <th scope="col">PRODUCT ID</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$products item=key}
                        <tr>
                            <td>{$key->game_name}</td>
                            <td><b>{$key->product_name}</b></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="products/deleteproduct/{$key->id}"><i
                                                    class="fa-solid fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    {/foreach}
                </tbody>
            </table>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-product"
                id="create-key-btn">
                <i class="fa-solid fa-plus"></i> Add product id
            </button>
        </div>


        <div class="card p-3">
            <h2>Public download table</h2>
            <table class="table-custom table table-striped table-sm table-rounded">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">GAME</th>
                        <th scope="col">PRODUCT ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">VERSION</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">VISIBLE</th>
                        <th scope="col">FILENAME</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$public_list item=key}
                        <tr>
                            <td>{$key->game_name}</td>
                            <td>{$key->product_id_name}</td>
                            <td><b>{$key->name}</b></td>
                            <td>{$key->version}</td>
                            <td><label class="{if $key->status eq 'UNAVAILABLE'} text-danger {/if} ">{$key->status}</label>
                            </td>
                            <td>{if $key->visible eq 1 }
                                    YES <i class="text-primary fa-solid fa-eye"></i>
                                {else}
                                    NO <i class="text-danger fa-solid fa-eye-slash"></i>
                                {/if}
                            </td>
                            <td>{$key->filename}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button"
                                        class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{$key->id}"><i class="fa-solid fa-trash"></i>
                                                Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    {/foreach}
                </tbody>
            </table>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-item"
                id="create-key-btn">
                <i class="fa-solid fa-plus"></i> Add new
            </button>
        </div>



    </div>



{include "templates/dashboard_footer.tpl"}