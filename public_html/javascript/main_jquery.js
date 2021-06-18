function AjaxService() {

    this.getUsername = () => {
        let username = $(".username").val();
        $.ajax({
            
            method: "GET",
            url:"./usernames.php",
            data: "username=" + username,
            dataType: "JSON",
            success: function(data) {

                if(data.korisnicko_ime === username) {
                    $(".username").addClass("nonvalid");
                    $( ".submit" ).prop( "disabled", true );
                }
                else {
                    $(".username").removeClass("nonvalid");
                    $( ".submit" ).prop( "disabled", false );
                }
                
            }
        });
    }

}

function Validator() {
    
    this.validateInputLength = (element) => {
        value = element.val();
        if(value.length < 3) {
            element.removeClass("valid");
            element.addClass("nonvalid");
            $( ".submit" ).prop( "disabled", true );
        } else {
            element.addClass("valid");
            element.removeClass("nonvalid");
            $( ".submit" ).prop( "disabled", false );
        }
    }

    this.validatePasswordFormat = (element) => {
        value = element.val();
        let re = new RegExp((/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/))
        let valid = re.test(value);
        if(valid) {
            element.removeClass("nonvalid");
            element.addClass("valid");
            $(".submit").prop( "disabled", false );
            return true;
        }
        else {
            element.removeClass("valid");
            element.addClass("nonvalid");
            $(".submit").prop( "disabled", true );
            return false;
        }
    }

    this.validatePasswordRepeat = (password1, password2, passwordFormat) => {
        let value1 = password1.val();
        let value2 = password2.val();
        if(value1 !== value2) {
            password2.removeClass("valid");
            password2.addClass("nonvalid");
            $(".submit").prop( "disabled", true );
        }
        else if (passwordFormat) {
            password2.removeClass("nonvalid");
            password2.addClass("valid");
            $(".submit").prop( "disabled", false );
        }
    }

    this.validateEmail = (email) => {
        let value = email.val();
        let re = new RegExp((/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/))
        let valid = re.test(value);
        if(valid) {
            email.removeClass("nonvalid");
            email.addClass("valid");
            $(".submit").prop( "disabled", false );
        } else {
            email.removeClass("valid");
            email.addClass("nonvalid");
            $(".submit").prop( "disabled", true );
        }
    }

    this.validateUsername = (username) => {
        let value = username.val();
        let re = new RegExp((/^[a-zA-Z0-9]{3,}$/));
        let valid = re.test(value);
        if(valid) {
            username.removeClass("nonvalid");
            username.addClass("valid");
            $(".submit").prop( "disabled", false );
        } else {
            username.removeClass("valid");
            username.addClass("nonvalid");
            $(".submit").prop( "disabled", true );
        }
    }
}

$(document).ready(function (){
    const title = $(document).find("title").text();
    const ajaxService = new AjaxService();

    switch(title) {
        case "Registracija":
            const validator = new Validator();

            let passwordFormat = false;

            $(".name").keyup(function () { 
                let name = $(".name");
                validator.validateInputLength(name);
            });

            $(".surname").keyup(function () { 
                let surname = $(".surname");
                validator.validateInputLength(surname);
            });

            $(".username").keyup(function () { 
                let username = $(".username");
                validator.validateUsername(username);
                ajaxService.getUsername();
            });

            $(".password").keyup(function (){
                let password1 = $(".password");
                let password2 = $(".confirm_password");

                passwordFormat = validator.validatePasswordFormat(password1);
                validator.validatePasswordRepeat(password1, password2, passwordFormat);

            });

            $(".confirm_password").keyup(function (){
                let password1 = $(".password");
                let password2 = $(".confirm_password");

                validator.validatePasswordRepeat(password1, password2, passwordFormat);
            });

            $(".email").keyup(function(){
                let email = $(".email");

                validator.validateEmail(email);
            });

            break;
        default:
            break;
    }

});