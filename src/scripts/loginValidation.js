const loginForm = document.getElementById('login-form');

const loginValidation = (value) => {
    const inputs = [...value].map((element) => {
        return [...element.children];
    })

    let inputsArray = [];
    inputs.map((element) => {
        return element.map((x, i) => {
            inputsArray.push(x);
        });
    });

    let ifEmpty = [];
    inputs.forEach(element => {
        element.forEach((y) => {
            if (y.value) ifEmpty.push(true);
        })
    })

    let invalidInputs = [];
    inputsArray.filter((element) => {
        if (element.getAttribute('class') == 'invalid-input') {
            invalidInputs.push(true);
        };
    });

    return invalidInputs.length > 0 || ifEmpty.length < 2 ? false : true;
}

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    return loginValidation(loginForm.children) ? loginForm.submit() : false;
});