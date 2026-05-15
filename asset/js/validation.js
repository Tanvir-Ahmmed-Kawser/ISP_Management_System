function validateRegister(){

    let password =
    document.getElementById("password").value;

    let confirm =
    document.getElementById("confirm_password").value;

    if(password.length < 8){
        alert("Password minimum 8 characters");
        return false;
    }

    if(password != confirm){
        alert("Passwords do not match");
        return false;
    }

    return true;
}