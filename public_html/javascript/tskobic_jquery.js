function AjaxService(endpoint, value) {
    this.endpoint = endpoint;
    this.value = value;
    this.imageFolder = 'images/users/default.jpg';
    var self = this.imageFolder;
    var name;
    var newPopup = new Popup();

    this.get = () => {
        $.ajax({
            type: "GET",
            url: this.endpoint,
            data: "all",
            dataType: "xml",
            success: function (xml) {
                $(xml).find("korisnik").each(function () { 
                    let image = $(this).find("slika").attr("url");
                    name = $(this).find("podaci").find("imePrezime").text();
                    if(image === self)
                    {
                        const img = $(document).find(".default");
                        const caption = $(img).find("figure").find("figcaption");
                        $(caption).html(name);
                        $(img).removeClass("hidden");
                        return false;
                    }
                });
            },
        });
    };

    this.getUsername = () => {
        var nameSurname = name.split(" ");
        $.ajax({
            type: "GET",
            url: this.endpoint,
            data: { ime: nameSurname[0], prezime: nameSurname[1] },
            dataType: "xml",
            success: function (xml) {
                $(xml).find("korisnici").each(function () {
                    const username = $(this).find("username").text();
                    const type = $(this).find("tip").text();

                    const cookie = new Cookie();
                    cookie.set(username, type, nameSurname[0], nameSurname[1]);

                    if(this.type !== "-1") {
                        $(".default").find(".zoom").addClass("border-width");
                    }
                    else{
                        newPopup.Show();
                        $(".popup").find(".okay").click(function () { 
                            newPopup.Remove();
                        });
                    }
                });
            },
        });
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

function Cookie() {
    this.danas = new Date();
    this.istice = new Date();

    this.set = (username, type, name, surname) => {
        this.istice.setTime(this.danas.getTime() + 1000 * 60 * 60);
        document.cookie = "username=" + username + "; expires=" + this.istice.toGMTString() + ";";
        document.cookie = "type=" + type + "; expires=" + this.istice.toGMTString() + ";";
        document.cookie = "name=" + name + "; expires=" + this.istice.toGMTString() + ";";
        document.cookie = "surname=" + surname + "; expires=" + this.istice.toGMTString() + ";";
    }

    this.get = (element) => {
        let name = element + "=";
	    let cookies = document.cookie.split(';');
	    for(let i=0;i < cookies.length;i++) {
		    let c = cookies[i];
		    while (c.charAt(0)==' ') {
                c = c.substring(1,c.length);
            }
		    if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
	    }
	    return "";
    }
}

function Registration() {
    this.name = "";
    this.surname = "";
    this.username = "";
    this.cookies = new Cookie();
    var login = this.username;

    this.get = () => {
        this.name = this.cookies.get("name");
        this.surname = this.cookies.get("surname");
        this.username = this.cookies.get("username");
        login = this.username;
    }

    this.fill = () => {
        if(this.name !== "" && this.surname !== "" && this.username !== "") {
            $(".name").val(this.name);
            $(".surname").val(this.surname);
            $(".username").val(this.username);
            $(".name").prop("disabled", true );
            $(".surname").prop("disabled", true );
            $(".username").prop("disabled", true );
        }
    }

    this.getPassword = () => {
        $.ajax({
            type: "GET",
            url: "https://barka.foi.hr/WebDiP/2020/materijali/zadace/dz3/korisnici.json",
            dataType: "json",
            success: function (json) {
                const array = json.filter(element => element.korisnicko_ime === login);
                if(array.length === 0) {
                    return false;
                }
                $(".password").val(array[0].lozinka);
                $(".password").prop("disabled", true);
                $(".password").addClass("disabled");
                $(".confirm_password").val(array[0].lozinka);
                $(".confirm_password").prop("disabled", true);
                $(".confirm_password").addClass("disabled");
            }
        });
    }
}

$(document).ready(function () {
    if (($(document).find("title").text() === "Početna")) {
        $(".table").DataTable({
            aaSorting: [[8, "desc"]],
            bPaginate: true,
            bLengthChange: true,
            bFilter: true,
            bSort: true,
            bInfo: true,
            bAutoWidth: true,
        });
    }

    if(($(document).find("title").text() === "Galerija"))
    {
        const endpoint = "http://barka.foi.hr/WebDiP/2020/materijali/zadace/dz3/userNameSurname.php?";
        const value = "images/users/default.jpg";
        const ajaxService = new AjaxService(endpoint, value);

        $(".load").click(function () {
            ajaxService.get();
        });
    
        $(".default").click(function () { 
            ajaxService.getUsername();
        });
    }

    let names = new Array();

    if (($(document).find("title").text() === "Registracija")) {
        const registration = new Registration();
        registration.get();
        registration.fill();
        registration.getPassword();

        $.getJSON("../json/imena.json", function (data) {
            $.each(data, function (key, val) {
                names.push(val);
            });
        });

        $(".name").autocomplete({
            source: names,
        });

        $(".surname").autocomplete({
            source: names,
        });

        $(".datetime").keyup(function () { 
            let value = $(".datetime").val();
            let re1 = new RegExp((/^(19|[2-9][0-9])\d{2}\/([0-2]\d|3[0-1]|[1-9])\/(0?[1-9]|1[0-2])\s(1[0-2]|0?[1-9]):([1-5][0-9]|0?[1-9])\s(AM|PM)$/));
            let re2 = new RegExp((/^([0-2]\d|3[0-1]|[1-9])\.(0?[1-9]|1[0-2])\.(19|[2-9][0-9])\d{2}\.\s(0?[1-9]|1\d|2[0-3]):([1-5][0-9]|0?[1-9])$/));
            let valid1 = re1.test(value);
            let valid2 = re2.test(value);
            if(valid1 || valid2) {
                $(".datetime").removeClass("nonvalid");
                $(".datetime").addClass("valid");
            }
            else {
                $(".datetime").removeClass("valid");
                $(".datetime").addClass("nonvalid");
            }
        });
    }
});
