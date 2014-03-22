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
                CompruebaCampo('nickR', /^[a-zA-Z0-9]{1,50}$/);
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

function CompruebaCampo(id, expresionRegular)
{
    valor = document.getElementById(id).value;
    if (!expresionRegular.test(valor))
    {
        document.getElementById(id + "div").className = "form-group has-error";
    }
    else
    {
        document.getElementById(id + "div").className = "form-group has-success";
    }

    if (document.getElementById("nickRdiv").className != "form-group has-success" ||
            document.getElementById("claveRdiv").className != "form-group has-success" ||
            document.getElementById("emaildiv").className != "form-group has-success")
    {
        document.getElementById("registrarse").disabled = true;
    }
    else
    {
        document.getElementById("registrarse").disabled = false;
    }
}


