function Tutorial(domElement) {
    this.domElement = domElement;
    this.tooltips = this.domElement.querySelectorAll(".tooltip");

    this.init = () => {
        for (let i = 0; i < this.tooltips.length; i++) {
            const tooltip = this.tooltips[i];
            const nextButton = tooltip.querySelector(".next-button");
            const expandButton = tooltip.querySelector(".help");

            expandButton.addEventListener("click", () => {
                const helpBox = tooltip.querySelector(".help-message");
                helpBox.classList.toggle("hidden");
            });

            nextButton.addEventListener("click", () => {
                tooltip.classList.add("hidden");
                if (i < this.tooltips.length - 1) {
                    this.tooltips[i + 1].classList.remove("hidden");
                }
            });
        }
    };

    this.reset = () => {
        for (let i = this.tooltips.length - 1; i >= 0; i--) {
            const tooltip = this.tooltips[i];
            const helpBox = tooltip.querySelector(".help-message");
            helpBox.classList.add("hidden");
            tooltip.classList.add("hidden");

            if (i === 0) {
                tooltip.classList.remove("hidden");
                helpBox.classList.add("hidden");
                window.scrollTo(0, 0);
            }
        }
    };
}

function Validator() {
    this.fieldTypes = {
        'text': validateDates,
        'time': validateTime,
        'fieldSet': validateFieldset,
    };

    let valid = true;

    this.validateField = (fieldType, domElement) => {
        return this.fieldTypes[fieldType](domElement);
    };

    function validateDates(element) {
        let fieldElement = element.value;
        if (fieldElement.length !== 11) {
            valid = false;
            return valid;
        } else {
            for (let index = 0; index < fieldElement.length; index++) {
                const element = fieldElement[index];
                if (index === 0) {
                    valid = true;
                    if (isNaN(element)) {
                        valid = false;
                        return valid;
                    } else if (element < 0 || element > 3) {
                        valid = false;
                        return valid;
                    }
                }
                if (index === 1 || index === 4 || (index > 5 && index < 10)) {
                    if (isNaN(element)) {
                        valid = false;
                        return valid;
                    } else if (element < 0 || element > 9) {
                        valid = false;
                        return valid;
                    }
                }
                if (index === 3) {
                    if (isNaN(element)) {
                        valid = false;
                        return valid;
                    } else if (element < 0 || element > 1) {
                        valid = false;
                        return valid;
                    }
                }
                if (index === 2 || index === 5 || index === 10) {
                    if (element != ".") {
                        valid = false;
                        return valid;
                    }
                }
            }

            return valid;
        }
    }

    function validateTime(element) {
        let timeElement = element;
        if (timeElement.value === "") {
            return false;
        }
        return true;
    }

    function validateFieldset(element) {
        const radioElements = element.querySelectorAll(".team");
        checked = false;
        for (let index = 0; index < radioElements.length; index++) {
            const radioElement = radioElements[index];
            if (radioElement.checked) {
                checked = true;
                return checked;
            }
        }

        return checked;
    }
}

function Popup() {
    this.blurElement = document.querySelector(".blur");
    this.popupElement = document.querySelector(".popup");
    this.yesElement = this.popupElement.querySelector(".yes");
    this.noElement = this.popupElement.querySelector(".no");

    this.Remove = () => {
        this.blurElement.classList.add("hidden");
        this.popupElement.classList.add("hidden");
    };

    this.Show = () => {
        this.blurElement.classList.remove("hidden");
        this.popupElement.classList.remove("hidden");
    };
}

function Form(domElement) {
    this.domElement = domElement;
    this.newTutorial = new Tutorial(document.querySelector(".tutorial"));
    this.fields = domElement.querySelectorAll("input.validate");
    this.fields2 = domElement.querySelectorAll("input.validate-onchange");
    this.submitBtn = domElement.querySelector('button[type="submit"]');
    this.validator = new Validator();
    this.newPopup = new Popup();
    this.newTutorial.init();

    this.init = () => {
        this.submitBtn.addEventListener("click", (e) => {
            const isValid = this.validateForm();
            if (!isValid) {
                e.preventDefault();
                this.newPopup.Show();
                this.newPopup.noElement.addEventListener("click", () => {
                    this.newPopup.Remove();
                });
                this.newPopup.yesElement.addEventListener("click", () => {
                    this.newPopup.Remove();
                    this.newTutorial.reset();
                });
            }
        });
    };

    this.validateOnChangeFields = () => {
        this.fields2.forEach((field) => {
            field.addEventListener("change", () => {
                valid = true;
                const labelElement = document.querySelector(
                    "label[for='date']"
                );
                let validField = this.validator.validateField(
                    field.type,
                    field
                );
                if (!validField) {
                    valid = false;
                    field.classList.add("border");
                    labelElement.classList.add("font-color");
                    if (labelElement.innerHTML.charAt(0) !== "*") {
                        labelElement.innerHTML = "*" + labelElement.innerHTML;
                    }
                    return false;
                }

                field.classList.remove("border");
                labelElement.classList.remove("font-color");
                if (labelElement.innerHTML.charAt(0) === "*") {
                    labelElement.innerHTML = labelElement.innerHTML.substring(
                        1
                    );
                }
                return valid;
            });
        });
    };

    this.validateForm = () => {
        let valid = true;
        this.fields.forEach((field) => {
            let validField = this.validator.validateField(field.type, field);
            if (!validField) {
                valid = false;
                return false;
            }
        });
        return valid;
    };
}

function Accesibility() {
    this.domElement = document.querySelector(".accesibility");
    this.link = document.querySelector(
        "link[href='../css/tskobic_accesibility.css']"
    );

    this.addCss = () => {
        this.link.rel = "stylesheet";
    };

    this.removeCss = () => {
        this.link.rel = "alternate stylesheet";
    };

    this.init = () => {
        this.domElement.addEventListener("click", () => {
            if (this.link.rel === "alternate stylesheet") {
                this.addCss();
            } else {
                this.removeCss();
            }
        });
    };
}

window.addEventListener("load", function (e) {
    const form = document.querySelector("form");
    const newForm = new Form(form);

    const newAccesibility = new Accesibility();
    newAccesibility.init();

    newForm.init();
    newForm.validateOnChangeFields();
});
