import Chart from "chart.js";
import $ from "jquery";

let char = $(".users")[0].getContext("2d");

char = new Chart(char, {
    type: "doughnut",
    data: {
        labels: ["Users", "Paid"],
        datasets: [
            {
                label: "Users to Artist",
                data: [users, artists],
                backgroundColor: ["rgba(255, 99, 132)", "rgba(54, 162, 235)"],
                borderColor: ["rgba(255, 99, 132)", "rgba(54, 162, 235)"],
                borderWidth: 1
            }
        ]
    }
});

console.log(artists);
