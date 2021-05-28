import handleValidation from './handleValidation.js';
const validationHandler = new handleValidation();

const {
    emailValidation,
    formValidation,
    passwordValidation,
    nameSurnameValidation,
    addressValidation,
    cityValidation,
    postcodeValidation,
    phonenumberValidation,
} = validationHandler;

const login = {
    loginInput: document.getElementById('login'),
    loginError: {
        errorMessage: 'E-mail niepoprawny!',
        errorVisible: false,
    }
}

let {
    loginInput,
    loginError
} = login;

const password = {
    passwordInput: document.getElementById('password'),
    passwordError: {
        errorMessage: 'Hasło musi zawierać 8 znaków, literę, cyfrę oraz znak specjalny!',
        errorVisible: false,
    }
}

let {
    passwordInput,
    passwordError
} = password;

const name = {
    nameInput: document.getElementById('name'),
    nameError: {
        errorMessage: 'Imię niepoprawne!',
        errorVisible: false,
    }
}

let {
    nameInput,
    nameError
} = name;

const surname = {
    surnameInput: document.getElementById('surname'),
    surnameError: {
        errorMessage: 'Nazwisko niepoprawne!',
        errorVisible: false,
    }
}

let {
    surnameInput,
    surnameError
} = surname;

const address = {
    addressInput: document.getElementById('address'),
    addressError: {
        errorMessage: 'Adres jest niepoprawny!',
        errorVisible: false,
    }
}

let {
    addressInput,
    addressError
} = address;

const city = {
    cityInput: document.getElementById('city'),
    cityError: {
        errorMessage: 'Miejscowość jest niepoprawna!',
        errorVisible: false,
    }
}

let {
    cityInput,
    cityError
} = city;

const postcode = {
    postcodeInput: document.getElementById('postcode'),
    postcodeError: {
        errorMessage: 'Kod pocztowy jest niepoprawny!',
        errorVisible: false,
    }
}

let {
    postcodeInput,
    postcodeError
} = postcode;

const phonenumber = {
    phonenumberInput: document.getElementById('phonenumber'),
    phonenumberError: {
        errorMessage: 'Numer telefonu jest niepoprawny!',
        errorVisible: false,
    }
}

let {
    phonenumberInput,
    phonenumberError
} = phonenumber;



const loginErr = document.createElement('p');
loginErr.textContent = loginError.errorMessage;
loginErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const loginChecker = () => {

    if (emailValidation(loginInput.value)) {
        loginInput.classList.add('valid-input');
        loginInput.classList.remove('invalid-input');
        loginError.errorVisible = false;
        loginError.errorVisible == false ? loginErr.remove() : '';
    } else {
        loginInput.classList.add('invalid-input')
        loginInput.classList.remove('valid-input');
        loginError.errorVisible = true;
        loginError.errorVisible == true ? loginInput.parentElement.append(loginErr) : '';
    }
}

const passwordErr = document.createElement('p');
passwordErr.textContent = passwordError.errorMessage;
passwordErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const passwordChecker = () => {

    if (passwordValidation(passwordInput.value)) {
        passwordInput.classList.add('valid-input');
        passwordInput.classList.remove('invalid-input');
        passwordError.errorVisible = false;
        passwordError.errorVisible == false ? passwordErr.remove() : '';
    } else {
        passwordInput.classList.add('invalid-input')
        passwordInput.classList.remove('valid-input');
        passwordError.errorVisible = true;
        passwordError.errorVisible == true ? passwordInput.parentElement.append(passwordErr) : '';
    }
}

const nameErr = document.createElement('p');
nameErr.textContent = nameError.errorMessage;
nameErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const nameChecker = () => {

    if (nameSurnameValidation(nameInput.value)) {
        nameInput.classList.add('valid-input');
        nameInput.classList.remove('invalid-input');
        nameError.errorVisible = false;
        nameError.errorVisible == false ? nameErr.remove() : '';
    } else {
        nameInput.classList.add('invalid-input')
        nameInput.classList.remove('valid-input');
        nameError.errorVisible = true;
        nameError.errorVisible == true ? nameInput.parentElement.append(nameErr) : '';
    }
}

const surnameErr = document.createElement('p');
surnameErr.textContent = surnameError.errorMessage;
surnameErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const surnameChecker = () => {

    if (nameSurnameValidation(surnameInput.value)) {
        surnameInput.classList.add('valid-input');
        surnameInput.classList.remove('invalid-input');
        surnameError.errorVisible = false;
        surnameError.errorVisible == false ? surnameErr.remove() : '';
    } else {
        surnameInput.classList.add('invalid-input')
        surnameInput.classList.remove('valid-input');
        surnameError.errorVisible = true;
        surnameError.errorVisible == true ? surnameInput.parentElement.append(surnameErr) : '';
    }
}

const addressErr = document.createElement('p');
addressErr.textContent = addressError.errorMessage;
addressErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const addressChecker = () => {

    if (addressValidation(addressInput.value)) {
        addressInput.classList.add('valid-input');
        addressInput.classList.remove('invalid-input');
        addressError.errorVisible = false;
        addressError.errorVisible == false ? addressErr.remove() : '';
    } else {
        addressInput.classList.add('invalid-input')
        addressInput.classList.remove('valid-input');
        addressError.errorVisible = true;
        addressError.errorVisible == true ? addressInput.parentElement.append(addressErr) : '';
    }
}

const cityErr = document.createElement('p');
cityErr.textContent = cityError.errorMessage;
cityErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const cityChecker = () => {

    if (cityValidation(cityInput.value)) {
        cityInput.classList.add('valid-input');
        cityInput.classList.remove('invalid-input');
        cityError.errorVisible = false;
        cityError.errorVisible == false ? cityErr.remove() : '';
    } else {
        cityInput.classList.add('invalid-input')
        cityInput.classList.remove('valid-input');
        cityError.errorVisible = true;
        cityError.errorVisible == true ? cityInput.parentElement.append(cityErr) : '';
    }
}

const postcodeErr = document.createElement('p');
postcodeErr.textContent = postcodeError.errorMessage;
postcodeErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const postcodeChecker = () => {

    if (postcodeValidation(postcodeInput.value)) {
        postcodeInput.classList.add('valid-input');
        postcodeInput.classList.remove('invalid-input');
        postcodeError.errorVisible = false;
        postcodeError.errorVisible == false ? postcodeErr.remove() : '';
    } else {
        postcodeInput.classList.add('invalid-input')
        postcodeInput.classList.remove('valid-input');
        postcodeError.errorVisible = true;
        postcodeError.errorVisible == true ? postcodeInput.parentElement.append(postcodeErr) : '';
    }
}

const phonenumberErr = document.createElement('p');
phonenumberErr.textContent = phonenumberError.errorMessage;
phonenumberErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const phonenumberChecker = () => {

    if (phonenumberValidation(phonenumberInput.value)) {
        phonenumberInput.classList.add('valid-input');
        phonenumberInput.classList.remove('invalid-input');
        phonenumberError.errorVisible = false;
        phonenumberError.errorVisible == false ? phonenumberErr.remove() : '';
    } else {
        phonenumberInput.classList.add('invalid-input')
        phonenumberInput.classList.remove('valid-input');
        phonenumberError.errorVisible = true;
        phonenumberError.errorVisible == true ? phonenumberInput.parentElement.append(phonenumberErr) : '';
    }
}

loginInput.addEventListener('keyup', () => {
    loginChecker();
});

passwordInput.addEventListener('keyup', () => {
    passwordChecker();
});

nameInput.addEventListener('keyup', () => {
    nameChecker();
});

surnameInput.addEventListener('keyup', () => {
    surnameChecker();
});

addressInput.addEventListener('keyup', () => {
    addressChecker();
});

cityInput.addEventListener('keyup', () => {
    cityChecker();
});

postcodeInput.addEventListener('keyup', () => {
    postcodeChecker();
});

phonenumberInput.addEventListener('keyup', () => {
    phonenumberChecker();
});

const registerForm = document.getElementById('register-form');
registerForm.addEventListener('submit', (event) => {
    event.preventDefault();

    loginChecker();
    passwordChecker();
    nameChecker();
    surnameChecker();
    addressChecker();
    cityChecker();
    postcodeChecker();
    phonenumberChecker();

    return formValidation(registerForm.children) ? registerForm.submit() : false;
});