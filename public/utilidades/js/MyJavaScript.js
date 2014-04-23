/*
 My Freak Zone - My Freak List - Web application for films, series and animes (Japanase Animation)
 Copyright (C) 2014: David Femenía Vázquez
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Affero General Public License for more details.
 
 You should have received a copy of the GNU Affero General Public License
 along with this program.  If not, see [http://www.gnu.org/licenses/]. 
 */

function CambiaEstilos(style)
{
    document.getElementById("styl").href = "/utilidades/css/" + style + "/bootswatch.less";
    document.getElementById("styl2").href = "/utilidades/css/" + style + "/bootstrap.min.css";
}

function init()
{
    document.getElementById("nickR").addEventListener(
            'keypress',
            function()
            {
                CompruebaCampo('nickR', /^[a-zA-Z0-9_]{1,30}$/, 3);
            }, false);
    document.getElementById("claveR").addEventListener(
            'keypress',
            function()
            {
                CompruebaCampo('claveR', /^[a-zA-Z0-9_]{8,20}$/);
            }, false);
    document.getElementById("email").addEventListener(
            'keypress',
            function()
            {
                CompruebaCampo('email', /[A-Za-z0-9_.]+@[A-Za-z]+[.]+[A-Za-z]+/);
            }, false);
   document.getElementById("claveR").addEventListener(
            'blur',
            function()
            {
               CompruebaClaves(0);
            }, false);        
   document.getElementById("claveRR").addEventListener(
            'blur',
            function()
            {
                CompruebaClaves(1);
            }, false);
            
}

function CompruebaClaves(check)
{
    valor1 = document.getElementById('claveR').value;
    valor2 = document.getElementById('claveRR').value;
    if(check == 1)
    {
        if(valor1 == valor2)
        {
            document.getElementById("claveRRdiv").className = "form-group has-success";
            document.getElementById("claveRlabel").innerHTML = "";
            if(CompruebaCampo('claveRR', /^[a-zA-Z0-9_]{8,20}$/))
            {
                 document.getElementById("claveRRdiv").className = "form-group has-success";
            }
        }
        else
        {
            document.getElementById("claveRRdiv").className = "form-group has-error";
            document.getElementById("claveRlabel").innerHTML = "Las contraseñas no coinciden";
        }
    }
    else
    {
         if(valor2 != "" && valor2 != null && valor1 != valor2)
         {
            document.getElementById("claveRdiv").className = "form-group has-error";
            document.getElementById("claveRlabel").innerHTML = "Las contraseñas no coinciden";
         }
         else
         {
             document.getElementById("claveRdiv").className = "form-group has-success";
             document.getElementById("claveRlabel").innerHTML = "";
             if(CompruebaCampo('claveR', /^[a-zA-Z0-9_]{8,20}$/))
             {
                document.getElementById("claveRdiv").className = "form-group has-success";
             }
         }
    }
    
            
        
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

function InitPublicaNoticia()
{
    document.getElementById("titulonoticia").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('titulonoticia', 200,4);
            }, false);
    document.getElementById("fuentenoticia").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('fuentenoticia', 200,-1);
            }, false);
    document.getElementById("noticia").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('noticia', 100000,100);
            }, false);
     document.getElementById("tags").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('tags',200,10);
            }, false);
}

function InitNoticiasComentarios()
{
    document.getElementById("comentario").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('comentario',500,10);
            }, false);
}

function InitMaterial()
{
    document.getElementById("vista_en").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('vista_en', 100,-1);
            }, false);
    document.getElementById("comentario").addEventListener(
            'keypress',
            function()
            {
                CamposLongitud('comentario', 200,-1);
            }, false);
    /*document.getElementById("puntuacion").addEventListener(
            'keypress',
            function()
            {
                CamposNumericos('puntuacion', 10,0);
            }, false);
     document.getElementById("progreso").addEventListener(
            'keypress',
            function()
            {
                CamposNumericos('progreso',30000,0);
            }, false);*/
}

/*function CamposNumericos(id,max,min)
{
    valor = document.getElementById(id).value;
    if (valor > max || valor < min)
    {
        document.getElementById(id + "div").className = "form-group has-error";
    }
    else
    {
          document.getElementById(id + "div").className = "form-group has-success";  
    }
}*/

function CamposLongitud(id, longitudmaxima, longitudminima)
{
    valor = document.getElementById(id).value;
    if (valor.length > longitudmaxima || valor.length < longitudminima)
    {
        document.getElementById(id + "div").className = "form-group has-error";
    }
    else
    {
          document.getElementById(id + "div").className = "form-group has-success";  
    }
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
            return false;
        }
        else
        {
            document.getElementById(id + "div").className = "form-group has-success";
            return true;
        }
    }
    /*if (document.getElementById("claveRdiv").className != "form-group has-success" ||
            document.getElementById("emaildiv").className != "form-group has-success" ||
            document.getElementById("nickRdiv").className != "form-group has-success")
    {
        document.getElementById("registrarse").disabled = true;
    }
    else
    {
        document.getElementById("registrarse").disabled = false;
    }*/
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
            if (!expresionRegular1.test(valor1))
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
        /*mostrar = new Array();
         for (i = 0; i <= 6; i++)
         {
         mostrar[i] = coso[i];
         }
         alert(mostrar);*/
        $("#inputbusqueda1").autocomplete({
            source: coso
        });
    });
}


