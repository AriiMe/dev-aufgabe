import "./bootstrap";
import { Calendar } from "@fullcalendar/core";

console.log("|triggered");

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var calendar = new Calendar(calendarEl, {
        initialView: "dayGridMonth",
    });

    calendar.render();
});
