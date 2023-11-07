// var createKeyModal = document.getElementById('create-key-modal');
// var creatKeyBtn = document.getElementById('create-key-btn');

// createKeyModal.addEventListener('shown.bs.modal', function () {
//   creatKeyBtn.focus();
// });

$(document).ready(function () {

    $(".key-time-radio").change(function(){
        if ($("#key-lifetime-checkbox").is(':checked')) {
            $("#key-time-input").val(-1);
            $("#key-time-input").prop("readonly", true);
            $("#key-time-input").css("background-color", '#cfcfcf');
        }else{
            $("#key-time-input").val(7);
            $("#key-time-input").prop("readonly", false);
            $("#key-time-input").css("background-color", '#ffffff');
        }
    });


    // $("#edit-key-btn").click(function(){

    //     let modal = $("#edit-key-modal");
    //     let keyid = $(this).keyid;

    //     $.ajax({
    //         url: `licenses/getdata/{$keyid}`,
    //         method: 'GET',
    //         // data: { rowId: rowId },
    //         success: function(data) {
    //             const jsonData = JSON.parse(data);
    //             // document.getElementById('modalInput1').value = jsonData.field1;
    //             // document.getElementById('modalInput2').value = jsonData.field2;
    //             // Populate other input fields as needed
    //             console.log(data);
    //         }
    //     });

    // });

});