{include "templates/dashboard_header.tpl"}

<link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_products.css'>

<script src="js/products.js"></script>

{include "templates/dashboard_products_modals.tpl"}

<div class="d-flex flex-column flex-fill p-3">

    <div class="my-3 d-flex flex-column gap-3">

        <div class="card p-3">
            <div class="d-flex flex-inline py-2 gap-3">
                <h2>Games</h2>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-game"
                    id="create-key-btn"><i class="fa-solid fa-plus"></i> Add game</button>
            </div>
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
                                        <li><a class="dropdown-item edit-game" id="edit-game"
                                                data-item-id="{$key->id}" data-bs-toggle="modal"
                                                data-bs-target="#edit-game"><i
                                                    class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="products/deletegame/{$key->id}"><i
                                                    class="fa-solid fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    {/foreach}
                </tbody>
            </table>
        </div>

        <div class="card p-3">
            <div class="d-flex flex-inline py-2 gap-3">
                <h2>Products / ID</h2>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#add-product" id="create-key-btn">
                    <i class="fa-solid fa-plus"></i> Add product id
                </button>
            </div>
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
                                        <li><a class="dropdown-item edit-public-item" id="edit-productid"
                                                data-item-id="{$key->id}" data-bs-toggle="modal"
                                                data-bs-target="#edit-productid"><i
                                                    class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="products/deleteproduct/{$key->id}"><i
                                                    class="fa-solid fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    {/foreach}
                </tbody>
            </table>
        </div>


        <div class="card p-3">
            <div class="d-flex flex-inline py-2 gap-3">
                <h2>Public download table</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-item"
                    id="create-key-btn">
                    <i class="fa-solid fa-plus"></i> Add new
                </button>
            </div>
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
                                        {* <li><a class="dropdown-item" href="{$key->id}"><i class="fa-solid fa-pen-to-square"></i>Edit</a></li> *}
                                        <li><a class="dropdown-item edit-public-item" id="edit-public-item"
                                                data-item-id="{$key->id}" data-bs-toggle="modal"
                                                data-bs-target="#edit-item"><i
                                                    class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="products/deleteitem/{$key->id}"><i
                                                    class="fa-solid fa-trash"></i>Delete</a></li>

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