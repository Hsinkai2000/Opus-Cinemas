document.getElementById("date").min = "2024-09-26";
var errors = [];

// Validate name: alphabet and spaces only
function validateName() {
    const name = document.getElementById("CustName").value;
    const nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(name)) {
        errors.push("Please enter a valid name with only letters and spaces.");
    }
}

// Validate email with custom rules
function validateEmail() {
    const email = document.getElementById("email").value;
    const emailRegex = /^[\w.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    if (!emailRegex.test(email)) {
        errors.push(
            "Please enter a valid email address (e.g., user@example.com)."
        );
    }
}

// Overall form validation
function validateForm() {
    // Clear previous errors from the array
    errors = [];

    // Clear the previous error messages from the UI
    var errors_block = document.getElementById("error_messages");
    errors_block.innerHTML = null;

    validateName();
    validateEmail();

    console.log(errors.toString()); // Debugging: Check if errors are being populated

    // Check if there are any errors
    if (errors.length > 0) {
        errors.forEach((error) => {
            var li = document.createElement("li"); // Create <li> for each error
            li.appendChild(document.createTextNode(error)); // Add the error message
            errors_block.appendChild(li); // Append <li> to <ul> (errors_block)
        });
        return false; // Prevent form submission if there are errors
    }

    return true; // Allow form submission if there are no errors
}

function clearError() {
    var errors_block = document.getElementById("error_messages");
    errors_block.innerHTML = null;
}
