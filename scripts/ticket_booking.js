function check() {
    var radios = document.getElementsByName("genre");

    for (var i = 0, length = radios.length; i < length; i++) {
        var label = document.querySelector(`label[for="${radios[i].id}"]`);

        label.style.backgroundColor = "#3d3c52";
        if (radios[i].checked) {
            console.log("time " + radios[i].value);
            label.style.backgroundColor = "#9eb2e0e1";
        }
    }
}

function check2() {
    var radios = document.getElementsByName("movie");

    for (var i = 0, length = radios.length; i < length; i++) {
        var label = document.querySelector(`label[for="${radios[i].id}"]`);

        label.style.backgroundColor = "#3d3c52";

        if (radios[i].checked) {
            label.style.backgroundColor = "#9eb2e0e1";
            console.log("Checked movie:", radios[i].value);
        }
    }
}

function fetchTiming() {
    const selectCinema = document.getElementById("selectCinema");
    const selectedCinema =
        selectCinema.options[selectCinema.selectedIndex].value;

    fetch("get_timings.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `movie_id=${window.movieId}&cinema_id=${selectedCinema}`,
    })
        .then((response) => response.json())
        .then((data) => {
            const selectTiming = document.getElementById("selectTiming");
            selectTiming.innerHTML = "";
            data.timings.forEach((timing) => {
                const option = document.createElement("option");
                option.value = timing;
                option.textContent = timing;
                selectTiming.appendChild(option);
            });
            regenerateSeatingTable();
        })
        .catch((error) => console.error("Error fetching timings:", error));
}

const selectedSeats = new Set();

function toggleSeat(element) {
    const value = element.getAttribute("data-value");
    if (element.classList.contains("seat-available")) {
        element.classList.remove("seat-available");
        element.classList.add("seat-selected");
        selectedSeats.add(value);
    } else if (element.classList.contains("seat-selected")) {
        element.classList.remove("seat-selected");
        element.classList.add("seat-available");
        selectedSeats.delete(value);
    }

    updateSelectedSeats();
}

function updateSelectedSeats() {
    const selectedSeatsArray = Array.from(selectedSeats);
    const selectedSeatsLabel =
        selectedSeatsArray.length > 0 ? selectedSeatsArray.join(", ") : "-";
    const standardTicketLabel = document.getElementById("standardTicketLabel");
    const standardTicketAmt = document.getElementById("standardTicketAmt");
    const gstAmt = document.getElementById("gstAmt");
    const totalAmt = document.getElementById("totalAmt");

    standardTicketLabel.innerText =
        selectedSeatsArray.length == 0
            ? "Standard Ticket"
            : `Standard Ticket x ${selectedSeatsArray.length}`;

    standardTicketAmt.innerText =
        selectedSeatsArray.length == 0
            ? "$0.00"
            : `$9.00 x ${selectedSeatsArray.length}`;

    let subtotal = selectedSeatsArray.length * 9;
    gstAmt.innerText =
        selectedSeatsArray.length == 0
            ? "$0.00"
            : `$${(0.07 * subtotal).toFixed(2)}`;

    totalAmt.innerText =
        selectedSeatsArray.length == 0
            ? "$0.00"
            : `$${(1.07 * subtotal).toFixed(2)}`;
    document.getElementById("selected-seats").innerText = selectedSeatsLabel;
}

function regenerateSeatingTable(timing = null) {
    const selectCinema = document.getElementById("selectCinema");
    const selectedCinema =
        selectCinema.options[selectCinema.selectedIndex].value;
    const selectTiming = document.getElementById("selectTiming");
    const selectedTiming =
        selectTiming.options[selectTiming.selectedIndex].value;

    const seatingTable = document.querySelector(".seating-table");
    const rows = ["A", "B", "C", "D", "E", "F", "G", "H"];

    while (seatingTable.rows.length > 1) {
        seatingTable.deleteRow(1);
    }
    selectedSeats.clear();
    updateSelectedSeats();

    console.log("before fetch");
    fetch(
        `get_taken_seats.php?cinema_id=${selectedCinema}&movie_id=${window.movieId}&timing=${selectedTiming}`
    )
        .then((response) => response.text())
        .then((text) => {
            console.log(text);
            return JSON.parse(text);
        })
        .then((takenSeats) => {
            console.log("takenSeats");
            console.log(takenSeats);
            rows.forEach((rowLabel) => {
                const row = seatingTable.insertRow();
                const cell = row.insertCell();
                cell.innerText = rowLabel;
                if (rowLabel === "D") {
                    seatingTable.insertRow();
                    const blankRow =
                        seatingTable.rows[seatingTable.rows.length - 1];
                    blankRow.classList.add("blank-row");
                    const blankCell = blankRow.insertCell();
                    blankCell.colSpan = 14;
                    const row = seatingTable.insertRow();
                    const cell = row.insertCell();
                }

                for (let i = 1; i <= 12; i++) {
                    if (i === 6) {
                        row.insertCell();
                        row.insertCell();
                    }
                    const seatCell = row.insertCell();
                    const seatValue = rowLabel + i;
                    const seatStatus = takenSeats.includes(seatValue)
                        ? "taken"
                        : "available";

                    const seatDiv = document.createElement("div");
                    seatDiv.setAttribute("data-value", seatValue);
                    seatDiv.className = `seat-${seatStatus}`;
                    seatDiv.onclick = function () {
                        toggleSeat(this);
                    };

                    seatCell.appendChild(seatDiv);
                }
            });
        })
        .catch((error) => {
            console.error("Error fetching seat data:", error);
        });
}
function proceedToPayment() {
  const selectedSeatsArray = Array.from(selectedSeats);

  if (selectedSeatsArray.length === 0) {
      alert("Please select at least one seat before proceeding to payment.");
      return; // Prevent further action if no seats are selected
  }

  const selectCinema = document.getElementById("selectCinema");
  const selectedCinema = selectCinema.options[selectCinema.selectedIndex].value;
  const selectTiming = document.getElementById("selectTiming");
  const selectedTiming = selectTiming.options[selectTiming.selectedIndex].value;

  const data = {
      seats: selectedSeatsArray,
      cinema_id: selectedCinema,
      movie_id: window.movieId,
      timing: selectedTiming,
  };

  fetch("store_seats.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
  })
      .then((response) => {
          if (response.ok) {
              window.location.href = "payment.php";
          } else {
              console.error("Failed to store data");
          }
      })
      .catch((error) => console.error("Error:", error));
}


fetchTiming();
