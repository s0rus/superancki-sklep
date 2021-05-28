export default class handleValidation {

    emailValidation(value) {
        const emailRegex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        return value.match(emailRegex);
    }

    passwordValidation(value) {
        const passwordRegex = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/);
        return value.match(passwordRegex);
    }

    nameSurnameValidation(value) {
        const nameSurnameRegex = new RegExp(/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/);
        return value.match(nameSurnameRegex);
    }

    addressValidation(value) {
        const addressRegex = new RegExp(/[\w',-\\/.\s]/);
        return value.match(addressRegex);
    }

    cityValidation(value) {
        const cityRegex = new RegExp(/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/);
        return value.match(cityRegex);
    }

    postcodeValidation(value) {
        const postcodeRegex = new RegExp(/^[0-9]{2}-[0-9]{3}$/);
        return value.match(postcodeRegex);
    }

    phonenumberValidation(value) {
        const phonenumberRegex = new RegExp(/^[0-9]{9}$/);
        return value.match(phonenumberRegex);
    }

    formValidation(value) {
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

        return invalidInputs.length > 0 || ifEmpty.length < 9 ? false : true;
    }

    userdataValidation(value) {
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

        return invalidInputs.length > 0 || ifEmpty.length < 7 ? false : true;
    }


    passwordEditValidation(value) {
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
}