
function sendEmail() {
    let params = {
        username: document.getElementById("name").value,
        email: document.getElementById("email").value,


    };

    emailjs.send("service_4gfetyu", "template_zlwydtb", params)
        .then(function(response) {
            console.log('Email sent:', response);
            alert("Email sent!");
        })
        .catch(function(error) {
            console.error('Error sending email:', error);
            alert("Error sending email. Please try again later.");
        });
}

// Make the sendEmail function available globally
window.sendEmail = sendEmail;
