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

{* ================= EDIT GAME MODAL ================= *}
<div class="modal fade" tabindex="-1" id="edit-game">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Edit game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="products/editgame">
                <input type="hidden" name="id" class="edit-game-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-quote-left"></i></span>
                            <input type="text" class="form-control edit-game-name" name="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Modify</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END EDIT GAME MODAL ================= *}

{* ================= CREATE PRODUCT MODAL ================= *}
<div class="modal fade" tabindex="-1" id="add-product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Add new product</h5>
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
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END CREATE PRODUCT MODAL ================= *}

{* ================= EDIT PRODUCT MODAL ================= *}
<div class="modal fade" tabindex="-1" id="edit-productid">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-key"></i> Edit product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="products/editproductid">

                <input type="hidden" name="id" value="-1" class="edit-product-id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product ID</label>
                        <select class="form-select edit-product-gameid" name="game_id">
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
                            <input type="text" class="form-control edit-product-name" name="name">
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                        Modify</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END EDIT PRODUCT MODAL ================= *}

{* ================= CREATE PUBLIC ITEM MODAL ================= *}
<div class="modal fade" tabindex="-1" id="add-item">
    <div class="public-item-modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-tag"></i> Add new public item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="products/addpublicitem">
                <div class="modal-body">

                    <div class="d-flex flex-inline flex-fill">

                        <div class="left">

                            <div class="mb-3">
                                <label class="form-label">Game / Product ID</label>
                                <select class="form-select" name="product_id">
                                    {foreach from=$products item=product}
                                        <option value="{$product->id}">{$product->game_name} - {$product->product_name}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-quote-left"></i></span>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Version</label>
                                <input type="text" class="form-control" name="version">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="AVAILABLE" selected>AVAILABLE</option>
                                    <option value="UNAVAILABLE">UNAVAILABLE</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Visible</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-eye"></i></span>
                                    <select class="form-select" name="visible">
                                        <option value="1" selected>YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="vr mx-4"></div>

                        <div class="right">
                            <label class="custum-file-upload" for="file">
                                <div class="icon">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="text">
                                    <span>Click to upload file</span>
                                </div>
                                <input type="file" id="file">
                            </label>
                        </div>

                    </div>

                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END CREATE PUBLIC ITEM MODAL ================= *}

{* ================= EDIT PUBLIC ITEM MODAL ================= *}
<div class="modal fade" tabindex="-1" id="edit-item">
    <div class="public-item-modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-tag"></i> Modify public item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="products/editpublicitem">
                <div class="modal-body">

                    <input type="hidden" name="id" value="-1" class="edit-item-id">

                    <div class="d-flex flex-inline flex-fill">

                        <div class="left">

                            <div class="mb-3">
                                <label class="form-label">Game / Product ID</label>
                                <select class="form-select edit-item-productid" name="product_id">
                                    {foreach from=$products item=product}
                                        <option value="{$product->id}">{$product->game_name} - {$product->product_name}
                                        </option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-quote-left"></i></span>
                                    <input type="text" class="form-control edit-item-name" name="name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Version</label>
                                <input type="text" class="form-control edit-item-version" name="version">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select edit-item-status" name="status">
                                    <option value="AVAILABLE">AVAILABLE</option>
                                    <option value="UNAVAILABLE">UNAVAILABLE</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Visible</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-eye"></i></span>
                                    <select class="form-select edit-item-visible" name="visible">
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="vr mx-4"></div>

                        <div class="right">
                            <label class="custum-file-upload" for="file">
                                <div class="icon">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="text">
                                    <span>Click to upload file</span>
                                </div>
                                <input type="file" id="file">
                            </label>
                        </div>

                    </div>

                </div>
                <div class="modal-footer d-grid modal-btn-large">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                        Modify</button>
                </div>
            </form>
        </div>
    </div>
</div> {* ================= END EDIT PUBLIC ITEM MODAL ================= *}

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