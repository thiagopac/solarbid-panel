function stringToCnpj(string){
    return string.toString().replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
}

function stringToCpf(string){
    return string.toString().replace(/^(\d{3})(\d{3})(\d{3})(\d{2}))/, "$1.$2.$3-$4");
}

function cnpjToString(string){
    return string.toString().replace(/[^\d]+/g,'');
}

function cpfToString(string){
    return string.toString().replace(/[^\d]+/g,'');
}

function numberToReal(number) {
    var number = number.toFixed(2).split('.');
    number[0] = number[0].split(/(?=(?:...)*$)/).join('.');
    return number.join(',');
}

function convertDateYMDtoDMY(dateString){
    var p = dateString.split(/\D/g);
    return [p[2],p[1],p[0] ].join("/");
}

function convertDateDMYtoYMD(dateString){
    var p = dateString.split(/\D/g);
    return [p[2],p[1],p[0] ].join("-");
}

function convertDateYMDHMStoDMYHMS(dateString){
    var d = new Date(dateString);
    return d.toLocaleString();
}

function compareDateWithToday(dateString){

    let today = new Date().toISOString().slice(0, 10)
    let paramDate = new Date(dateString).toISOString().slice(0, 10)

    // console.log(today);
    // console.log(paramDate);

    //true se a data atual for maior do que a data do parâmetro
    return today > paramDate;
}

function generateReferralCodeForString(string){
    var text = "";
    var possible;
    for (var j = 0; j < string.length; j++) {
        if (string[j] == " ") {
            possible = ' ';
        } else if ((string[j] == string[j].toUpperCase()) && (string[j] != string[j].toLowerCase())) {
            possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        } else if ((string[j] == string[j].toLowerCase()) && (string[j] != string[j].toUpperCase())) {
            possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        } else if ('0123456789'.indexOf(string[j]) !== -1) {
            possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        } else {
            possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }

        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    result = "";

    for (var i = 8; i > 0; --i) result += text[Math.floor(Math.random() * text.length)];

    return result;
}

function validateCnpj(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;
}

function clipText(string, limit) {
    var dots = "...";

    if(string.length > limit){
        string = string.substring(0,limit) + dots;
    }
    return string;
}