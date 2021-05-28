import handleValidation from './handleValidation.js';
const validationHandler = new handleValidation();

const {
    passwordValidation,
    passwordEditValidation,
    userdataValidation,
    nameSurnameValidation,
    addressValidation,
    cityValidation,
    postcodeValidation,
    phonenumberValidation,
} = validationHandler;

const oldPassword = {
    oldPasswordInput: document.getElementById('old-password'),
    oldPasswordError: {
        errorMessage: 'Hasło musi zawierać 8 znaków, literę, cyfrę oraz znak specjalny!',
        errorVisible: false,
    }
}

let {
    oldPasswordInput,
    oldPasswordError
} = oldPassword;

const newPassword = {
    newPasswordInput: document.getElementById('new-password'),
    newPasswordError: {
        errorMessage: 'Hasło musi zawierać 8 znaków, literę, cyfrę oraz znak specjalny!',
        errorVisible: false,
    }
}

let {
    newPasswordInput,
    newPasswordError
} = newPassword;

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

const oldPasswordErr = document.createElement('p');
oldPasswordErr.textContent = oldPasswordError.errorMessage;
oldPasswordErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const oldPasswordChecker = () => {

    if (passwordValidation(oldPasswordInput.value)) {
        oldPasswordInput.classList.add('valid-input');
        oldPasswordInput.classList.remove('invalid-input');
        oldPasswordError.errorVisible = false;
        oldPasswordError.errorVisible == false ? oldPasswordErr.remove() : '';
    } else {
        oldPasswordInput.classList.add('invalid-input')
        oldPasswordInput.classList.remove('valid-input');
        oldPasswordError.errorVisible = true;
        oldPasswordError.errorVisible == true ? oldPasswordInput.parentElement.append(oldPasswordErr) : '';
    }
}

const newPasswordErr = document.createElement('p');
newPasswordErr.textContent = newPasswordError.errorMessage;
newPasswordErr.setAttribute('style', 'color:  rgb(202, 21, 21); margin-left: 1em');

const newPasswordChecker = () => {

    if (passwordValidation(newPasswordInput.value)) {
        newPasswordInput.classList.add('valid-input');
        newPasswordInput.classList.remove('invalid-input');
        newPasswordError.errorVisible = false;
        newPasswordError.errorVisible == false ? newPasswordErr.remove() : '';
    } else {
        newPasswordInput.classList.add('invalid-input')
        newPasswordInput.classList.remove('valid-input');
        newPasswordError.errorVisible = true;
        newPasswordError.errorVisible == true ? newPasswordInput.parentElement.append(newPasswordErr) : '';
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

oldPasswordInput.addEventListener('keyup', () => {
    oldPasswordChecker();
});

newPasswordInput.addEventListener('keyup', () => {
    newPasswordChecker();
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

const infoForm = document.getElementById('register-form');
infoForm.addEventListener('submit', (event) => {
    event.preventDefault();

    nameChecker();
    surnameChecker();
    addressChecker();
    cityChecker();
    postcodeChecker();
    phonenumberChecker();

    return userdataValidation(infoForm.children) ? infoForm.submit() : false;
});

const passwordForm = document.getElementById('password-form');
passwordForm.addEventListener('submit', (event) => {
    event.preventDefault();

    oldPasswordChecker();
    newPasswordChecker();

    return passwordEditValidation(passwordForm.children) ? passwordForm.submit() : false;
});