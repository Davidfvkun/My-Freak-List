function CambiaEstilos(style)
{
    document.getElementById("styl").href = "/utilidades/css/" + style + "/bootswatch.less";
    document.getElementById("styl2").href = "/utilidades/css/" + style + "/bootstrap.min.css";
}

function init()
{
    document.getElementById("nickR").addEventListener(
            'blur',
            function()
            {
                CompruebaCampo('nickR', /^[a-zA-Z0-9_]{1,50}$/, 3);
            }, false);
    document.getElementById("claveR").addEventListener(
            'blur',
            function()
            {
                CompruebaCampo('claveR', /^[a-zA-Z0-9_]{8,20}$/);
            }, false);
    document.getElementById("email").addEventListener(
            'blur',
            function()
            {
                CompruebaCampo('email', /[A-Za-z0-9_.]+@[A-Za-z]+[.]+[A-Za-z]+/);
            }, false);
}

function InitPlantillaPrincipal()
{
    document.getElementById("inputbusqueda").addEventListener(
            'keypress',
            function()
            {
                Ajax_Usuario(document.getElementById("inputbusqueda").value,
                        document.getElementById("selectfiltrausuarios").value, 1);
            }, false);
    document.getElementById("inputbusqueda1").addEventListener(
            'keypress',
            function()
            {
                Ajax_Material(document.getElementById("inputbusqueda1").value,
                        document.getElementById("A").checked,
                        document.getElementById("B").checked,
                        document.getElementById("C").checked, 2);
            }, false);
}

function CompruebaCampo(id, expresionRegular, casoNick)
{
    valor = document.getElementById(id).value;
    
        if (casoNick == 3) // En el caso del nick hay que comprobar que no esté ocupado
        {
            CompruebaNick(id, casoNick, expresionRegular, valor);
        }
        else
        {
            if (!expresionRegular.test(valor))
            {
                document.getElementById(id + "div").className = "form-group has-error";
            }
            else
            {
                document.getElementById(id + "div").className = "form-group has-success";
            }
        }
        if (document.getElementById("claveRdiv").className != "form-group has-success" ||
                document.getElementById("emaildiv").className != "form-group has-success" ||
                    document.getElementById("nickRdiv").className != "form-group has-success")
        {
            document.getElementById("registrarse").disabled = true;
        }
        else
        {
            document.getElementById("registrarse").disabled = false;
        }
}

function CompruebaNick(id, peticionn, expresionRegular1, valor1)
{
    var request;
    request = $.ajax({
        url: "/ajax.php",
        type: "GET",
        data: {val1: document.getElementById(id).value, peticion: peticionn}
    });

    request.done(function(response, textStatus, jqXHR)
    {
        coso = response;
        if (coso.indexOf("error") != -1)
        {
            document.getElementById("nickRlabel").innerHTML = "El nick ya está ocupado";
            document.getElementById("nickRdiv").className = "form-group has-error";
            return false;
        }
        else
        {
            if(!expresionRegular1.test(valor1))
            {
                document.getElementById("nickRdiv").className = "form-group has-error";
                document.getElementById("nickRlabel").innerHTML = "El nick contiene caracteres incorrectos";
            }
            else
            {
                document.getElementById("nickRdiv").className = "form-group has-success";
                document.getElementById("nickRlabel").innerHTML = "";
            }
            return true;
        }
    });
}

function Ajax_Usuario(valor1, valor2, peticionn)
{
    var request;
    request = $.ajax({
        url: "/ajax.php",
        type: "GET",
        data: {val1: valor1, val2: valor2, peticion: peticionn}
    });

    request.done(function(response, textStatus, jqXHR)
    {
        coso = JSON.parse(response);
        $("#inputbusqueda").autocomplete({
            source: coso
        });
    });
}
function Ajax_Material(valor1, valor2, valor3, valor4, peticionn)
{
    valor2 == true ? valor2 = 1 : valor2 = 0;
    valor3 == true ? valor3 = 1 : valor3 = 0;
    valor4 == true ? valor4 = 1 : valor4 = 0;
    var request;
    request = $.ajax({
        url: "/ajax.php",
        type: "GET",
        data: {val1: valor1, val2: valor2, val3: valor3, val4: valor4, peticion: peticionn}
    });

    request.done(function(response, textStatus, jqXHR)
    {
        coso = JSON.parse(response);
        $("#inputbusqueda1").autocomplete({
            source: coso
        });
    });
}



