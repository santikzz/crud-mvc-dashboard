function formatElapsedTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;
    const formattedTime = `${hours.toString().padStart(2, '0')}h ${minutes.toString().padStart(2, '0')}m ${remainingSeconds.toString().padStart(2, '0')}s`;
    return formattedTime;
}

$(document).ready(function () {

    // $(".time").each(function () {
    //     let t = formatElapsedTime(parseInt($(this).data('time'), 10));
    //     $(this).text(t);
    // });

    const timers = {};
    const updateInterval = 15;

    $('.task-action-toggle').change(function () {

        let checkbox = $(this);
        let ulid = checkbox.data('ulid');


        let label = $(`#time-${ulid}`);
        let time = parseInt(label.data('time'), 10);

        if (checkbox.prop('checked')) {

            let elapsed = 0;
            timers[ulid] = setInterval(function () {
                time++;
                label.text(formatElapsedTime(time));
                label.data('time', time);

                elapsed++;                
                if(elapsed % updateInterval == 0){
                    console.log(`Updating ${updateInterval}s to task/${ulid}`);
                    $.post("tasks/updateTime", { ulid: ulid, time: updateInterval }, function(data, status) {
                        // This function is executed when the request is complete
                        // if (status === "success") {
                        //     // 'data' contains the response from the server
                        //     console.log("Response data: " + data);
                        // } else {
                        //     console.error("Request failed");
                        // }
                    });
                }

            }, 1000);

        } else {
            clearInterval(timers[ulid]);
            delete timers[ulid];
        }



    });

});

