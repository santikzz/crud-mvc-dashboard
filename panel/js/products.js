$(document).ready(function () {

    // EDIT PUBLIC ITEM MODAL
    $(".edit-public-item").click(function () {

        let item_id = $(this).data('item-id');

        $.ajax({
            url: `products/getitem/${item_id}`,
            type: 'GET',
            data: {},
            success: function (json_data) {

                let data = JSON.parse(json_data);
                // console.log(data);

                $(".edit-item-id").val(data["id"]);

                $(".edit-item-productid option").each(function () {
                    let option = $(this).val();
                    if (option == data["product_id"]) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });

                $(".edit-item-name").val(data["name"]);
                $(".edit-item-version").val(data["version"]);

                $(".edit-item-status option").each(function () {
                    let option = $(this).val();
                    if (option == data["status"]) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });

                $(".edit-item-visible option").each(function () {
                    let option = $(this).val();
                    if (option == data["visible"]) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });


            }
        });

    });
    // END EDIT PUBLIC ITEM MODAL 

    // EDIT PRODUCT
    $(".edit-public-item").click(function () {

        let item_id = $(this).data('item-id');

        $.ajax({
            url: `products/getproduct/${item_id}`,
            type: 'GET',
            data: {},
            success: function (json_data) {

                let data = JSON.parse(json_data);
                console.log(data);

                $(".edit-product-id").val(data["id"]);

                $(".edit-product-gameid option").each(function () {
                    let option = $(this).val();
                    if (option == data["game_id"]) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });

                $(".edit-product-name").val(data["name"]);
            }
        });


    });


    // EDIT GAME
    $(".edit-game").click(function () {
        let item_id = $(this).data('item-id');
        $.ajax({
            url: `products/getgame/${item_id}`,
            type: 'GET',
            data: {},
            success: function (json_data) {
                let data = JSON.parse(json_data);
                $(".edit-game-id").val(data["id"]);
                $(".edit-game-name").val(data["name"]);
            }
        });
    });




});