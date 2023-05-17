var token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        selectable: true,
        select: function (info) {
            var startDate = info.startStr;
            var endDate = info.endStr;

            document.getElementById("startDate").value = startDate;
            document.getElementById("endDate").value = endDate;
            $("#leaveForm").modal("show");
        },
    });

    calendar.render();

    document
        .getElementById("submitLeave")
        .addEventListener("click", function () {
            var startDate = document.getElementById("startDate").value;
            var endDate = document.getElementById("endDate").value;

            $.ajax({
                url: "/request",
                method: "POST",
                data: {
                    start_time: startDate,
                    end_time: endDate,
                    _token: token,
                },
                success: function () {
                    $("#leaveForm").modal("hide");
                    calendar.refetchEvents();
                },
                error: function () {
                    alert("An error occurred. Please try again.");
                },
            });
        });
});
