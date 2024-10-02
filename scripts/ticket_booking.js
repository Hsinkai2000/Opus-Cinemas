function check() {
    var radios = document.getElementsByName("genre");

    for (var i = 0, length = radios.length; i < length; i++) {
        var label = document.querySelector(`label[for="${radios[i].id}"]`);

        // Reset the background color of all labels to the default
        label.style.backgroundColor = "#3d3c52"; // or
        if (radios[i].checked) {
            // do whatever you want with the checked radio
            console.log("time " + radios[i].value);
            label.style.backgroundColor = "#9eb2e0e1";
        }
    }
}

function check2() {
    var radios = document.getElementsByName("movie");

    for (var i = 0, length = radios.length; i < length; i++) {
        var label = document.querySelector(`label[for="${radios[i].id}"]`);

        // Reset the background color of all labels to the default
        label.style.backgroundColor = "#3d3c52"; // or whatever the default color is

        if (radios[i].checked) {
            // Change the background color of the checked label
            label.style.backgroundColor = "#9eb2e0e1";
            console.log("Checked movie:", radios[i].value);
        }
    }
}
