function validateForm() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (username === "") {
        //document.getElementById("error-message").innerHTML = "Please enter your username";
        alert("Name musst be filled out");
        return false;
    }

    if (password === "") {
        //document.getElementById("error-message").innerHTML = "Please enter your password";
        alert("Pass must be filled out");
        return false;
    }

return true;
}