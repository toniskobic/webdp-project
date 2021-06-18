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
function Form(domElement) {
    this.domElement = domElement;
    this.newTutorial = new Tutorial(document.querySelector(".tutorial"));
    this.newTutorial.init();

}

function Accesibility() {
    this.domElement = document.querySelector(".accesibility");
    this.link = document.querySelector(
        "link[href='./css/main_accesibility.css']"
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
    const newAccesibility = new Accesibility();
    newAccesibility.init();

    const form = document.querySelector("form");
    const newForm = new Form(form);
    newForm.init();
});
