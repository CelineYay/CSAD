// Functions to toggle display
// Cache DOM elements for easy access
let tColorA = document.getElementById('tColorA'),
    tColorB = document.getElementById('tColorB'),
    tColorC = document.getElementById('tColorC'),
    iconA = document.querySelector('.fa-credit-card'),
    iconB = document.querySelector('.fa-building-columns'),
    iconC = document.querySelector('.fa-wallet'),
    cDetails = document.querySelector('.card-details'),
    qrCodeContainer = document.getElementById('internet-banking');// Update to target the PayNow interface container
    points = document.getElementById('redeem-points');

// Function to show the PayNow interface
function showInternetBanking() {
    // Update tab colors
    tColorA.style.color = "#444";
    tColorB.style.color = "greenyellow";
    tColorC.style.color = "#444";
    iconA.style.color = "#aaa";
    iconB.style.color = "greenyellow";
    iconC.style.color = "#aaa";

    // Hide card payment form and show PayNow interface
    cDetails.style.display = "none"; // Hide card details form
    qrCodeContainer.style.display = "block"; // Show PayNow interface
    points.style.display = "none";
}

// Function to show the PayNow interface
function showRedeemPoints() {
    // Update tab colors
    tColorA.style.color = "#444";
    tColorB.style.color = "#444";
    tColorC.style.color = "greenyellow";
    iconA.style.color = "#aaa";
    iconB.style.color = "#aaa";
    iconC.style.color = "greenyellow";

    // Hide card payment form and show PayNow interface
    cDetails.style.display = "none"; // Hide card details form
    qrCodeContainer.style.display = "none"; // Show PayNow interface
    points.style.display = "block";
}



document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById('card-form');
    form.onsubmit = function () {
        // Here you can also add validation or other form handling
        window.location = 'confirmation.html'; // Redirect to the confirmation page
        return false; // Prevent the default form submission
    };
});

// Event listeners
document.addEventListener("DOMContentLoaded", function () {
    // Set initial state
    tColorA.style.color = "greenyellow";
    iconA.style.color = "greenyellow";
    cDetails.style.display = "block";
    qrCodeContainer.style.display = "none";

    // Event listeners
    tColorA.addEventListener("click", function () { dofun(); });
    tColorB.addEventListener("click", function () { dofunA(); });
    tColorC.addEventListener("click", function () { dofunB(); });
});
