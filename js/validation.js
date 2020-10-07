// Defining a function to display error message
function printError(elemId, hintMsg) {
    let element = document.getElementById(elemId);
    element.innerHTML = hintMsg;
    setTimeout(() =>{
        element.innerHTML = '';
    }, 5000)
    element.addEventListener('input', () =>{
        element.innerHTML = '';
    });
}

// Defining a function to validate form 
let signupForm = document.querySelector('signupForm');

signupForm.addEventListener('click', (e) => {
    e.preventDefault();
    // appending variables or value
    const username = document.signupForm.username.value;
    const email = document.signupForm.email.value;
    const pwd = document.signupForm.pwd.value;
    const cpwd = document.signupForm.cpwd.value;
   
	// Defining error variables with a default value
    let usernameErr = emailErr = pwd = cpwd = true;
    // Validate username
    if(username == "") {
        printError("usernameErr", "Please enter your username");
    }else {
        let regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(username) === false) {
            printError("usernameErr", "Please enter a valid username");
        } else {
            printError("usernameErr", "");
            usernameErr = false;
        }
    }
    // Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        let regex1 = /^(([^<>()[\]\\.,;\s@'']+(\.[^<>()[\]\\.,;:\s@'']+)*)|(\".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(regex1.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    // Validate password
    if(pwd == "") {
        printError("pwdErr", "Please enter your password");
    }else {
        let regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(pwd) === false) {
            printError("pwdErr", "Please enter a valid name");
        } else {
            printError("pwdErr", "");
            pwdErr = false;
        }
    }
    // Validate Confirm password
    if(cpwd == "") {
        printError("cpwdErr", "Please enter your password");
    }else {
        let regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(cpwd) === false) {
            printError("cpwdErr", "Please enter a valid name");
        } else {
            printError("cpwdErr", "");
            cpwdErr = false;
        }
    }
    
    // Prevent the form from being submitted if there are any errors
    if((nameErr || emailErr || mobileErr || countryErr || genderErr) == true) {
       return false;
    } else {
        // Creating a string from input data for preview
        let dataPreview = "You've entered the following details: \n" +
        "Full Name: " + username + "\n" +
        "Email Address: " + email + "\n" +
        "Email Address: " + pwd + "\n";
        // if(hobbies.length) {
        //     dataPreview += "Hobbies: " + hobbies.join(", ");
        // }
        alert(dataPreview);
    }
});