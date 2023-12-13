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
                // console.log(data);

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

    // EDIT PRICING

    function updatePriceTable(json) {

        let table = $(".pricing-table");
        table.html("");
        let data = JSON.parse(json);

        $.each(data, function (index, item) {
            let row = '<tr><td>' + item["duration"] + '</td><td>' + item["price"] + '</td><td>' + item["extra"] + '</td><tr>';
            table.append(row);
        });

    }

    $(".edit-pricing-btn").click(function () {

        let item_id = $(this).data('item-id');

        $.ajax({
            url: `products/getpricing/${item_id}`,
            type: 'GET',
            data: {},
            success: function (json_data) {
                let data = JSON.parse(json_data);

                $(".edit-price-product-id").val(data["id"]);
                $(".pricing-product-name").text(data["name"]);
                $(".price-textarea").val(data["pricing"]);

                updatePriceTable(data["pricing"])

            }
        });

    });

    $('.price-textarea').bind('input propertychange', function () {


        try {
            updatePriceTable(this.value);
            $('.price-textarea').addClass("valid-json");
            $('.price-textarea').removeClass("invalid-json");
            $('.submit-price-btn').attr("disabled", false);
        } catch (e) {
            $('.price-textarea').addClass("invalid-json");
            $('.price-textarea').removeClass("valid-json");
            $('.submit-price-btn').attr("disabled", true);
        }

    });












});