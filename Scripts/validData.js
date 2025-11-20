function validData(event) {
    const errorMessage = "Please enter correct data";
    let hasError = false;

    const name = document.getElementById("name");
    const nameError = document.getElementById("nameError");
    nameError.textContent = '';
    if (name.value.trim() === ''){
        nameError.textContent = errorMessage;
        hasError = true;
    }

    const surname = document.getElementById("surname");
    const surnameError = document.getElementById("surnameError");
    surnameError.textContent = '';
    if (surname.value.trim() === ''){
        surnameError.textContent = errorMessage;
        hasError = true;
    }

    const dateBirth = document.getElementById("dateBirth");
    const dateBirthError = document.getElementById("dateBirthError");
    dateBirthError.textContent = '';
    if (dateBirth.value.trim() === ''){
        dateBirthError.textContent = errorMessage;
        hasError = true;
    }

    const email = document.getElementById("email");
    const emailError = document.getElementById("emailError");
    const emailValue = email.value.trim();
    emailError.textContent = '';
    if (email.value.trim() === ''){
        emailError.textContent = errorMessage;
        hasError = true;
    }
    if (!emailValue.includes('@')) {
        emailError.textContent = errorMessage;
        hasError = true;
    }

    const password = document.getElementById("password");
    const passwordError = document.getElementById("passwordError");
    passwordError.textContent = '';
    if (password.value.trim() === ''){
        passwordError.textContent = errorMessage;
        hasError = true;
    }

    if (hasError) {
        event.preventDefault(); 
        return false;
    } 

    return true;
};