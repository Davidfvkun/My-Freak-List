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
            'keyup',
            function()
            {
                CompruebaCampo('nickR', /^[a-zA-Z0-9_]{1,30}$/, 3);
            }, false);
    document.getElementById("claveR").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('claveR', /^[a-zA-Z0-9_]{8,20}$/);
            }, false);
    document.getElementById("email").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('email', /[A-Za-z0-9_.]+@[A-Za-z]+[.]+[A-Za-z]+/);
            }, false);
   document.getElementById("claveR").addEventListener(
            'keyup',
            function()
            {
               CompruebaClaves(0);
            }, false);        
   document.getElementById("claveRR").addEventListener(
            'keyup',
            function()
            {
                CompruebaClaves(1);
            }, false);
   document.getElementById("file1").addEventListener(
       'change',
       function()
       {
           CompruebaImagen();
       }, false);
       document.getElementById("nombreR").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('nombreR', /^[áéíóúÁÉÍÓÚa-zA-Z ]{0,45}$/);
            }, false);
       document.getElementById("apellidoR").addEventListener(
            'keyup',
            function()
            {
               CompruebaCampo('apellidoR', /^[áéíóúÁÉÍÓÚa-zA-Z ]{0,45}$/);
            }, false);
      document.getElementById("descripcionR").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('descripcionR', /^[áéíóúÁÉÍÓÚa-zA-Z,. ]{0,200}$/);
            }, false);
}

function CompruebaImagen()
{
    valor = document.getElementById("file1").value;
    formato = valor.substring(valor.length-4);
    if(formato != ".png" && formato != ".jpg")
    {
         document.getElementById("errorimagen").innerHTML = "Archivo de imagen incorrecto";
         document.getElementById("errorimagen").style = "color: red";
    }
    else
    {
        document.getElementById("errorimagen").innerHTML = "Archivo de imagen correcto";
        document.getElementById("errorimagen").style = "color: green";    
    }
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

function InitPublicaMaterial()
{
    document.getElementById("nombrematerial").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('nombrematerial', 200,1);
            }, false);
    document.getElementById("sinopsismaterial").addEventListener(
            'blur',
            function()
            {
                CamposLongitud('sinopsismaterial', 1000,-1);
            }, false);
    document.getElementById("aniomaterial").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('aniomaterial', /^[0-9]{4}$/);
            }, false);
    document.getElementById("generomaterial").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('generomaterial', 100,-1);
            }, false);
}

function initDatosUsuario()
{
    document.getElementById("mensajeprivado").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('mensajeprivado', 500,0);
            }, false);
    document.getElementById("nombre").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('nombre', /^[áéíóúÁÉÍÓÚa-zA-Z ]{0,45}$/);
            }, false);
       document.getElementById("apellido").addEventListener(
            'keyup',
            function()
            {
               CompruebaCampo('apellido', /^[áéíóúÁÉÍÓÚa-zA-Z ]{0,45}$/);
            }, false);
      document.getElementById("descripcion").addEventListener(
            'keyup',
            function()
            {
                CompruebaCampo('descripcion', /^[áéíóúÁÉÍÓÚa-zA-Z,. ]{0,200}$/);
            }, false);
    /*document.getElementById("file1").addEventListener(
       'change',
       function()
       {
           CompruebaImagen();
       }, false);*/
}

function InitPlantillaPrincipal()
{
    document.getElementById("inputbusqueda").addEventListener(
            'keyup',
            function()
            {
                Ajax_Usuario(document.getElementById("inputbusqueda").value,
                        document.getElementById("selectfiltrausuarios").value, 1);
            }, false);
    document.getElementById("inputbusqueda1").addEventListener(
            'keyup',
            function()
            {
                Ajax_Material(document.getElementById("inputbusqueda1").value,
                        document.getElementById("A").checked,
                        document.getElementById("B").checked,
                        document.getElementById("C").checked, 
                        document.getElementById("geneross").value,2);
            }, false);
}

function InitPublicaNoticia()
{
    document.getElementById("titulonoticia").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('titulonoticia', 200,4);
            }, false);
    document.getElementById("fuentenoticia").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('fuentenoticia', 200,-1);
            }, false);
    document.getElementById("noticia").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('noticia', 100000,100);
            }, false);
     document.getElementById("tags").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('tags',200,10);
            }, false);
}

function InitNoticiasComentarios()
{
    document.getElementById("comentario").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('comentario',500,10);
            }, false);
}

function InitMaterial()
{
    document.getElementById("vista_en").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('vista_en', 100,-1);
            }, false);
    document.getElementById("comentario").addEventListener(
            'keyup',
            function()
            {
                CamposLongitud('comentario', 200,-1);
            }, false);
    document.getElementById("puntuacion").addEventListener(
            'keyup',
            function()
            {
                CamposNumericos('puntuacion', 10,0, /^[0-9]{1}$/);
            }, false);
     document.getElementById("progreso").addEventListener(
            'keyup',
            function()
            {
                CamposNumericos('progreso',30000,0,/^[0-9]{1,5}$/);
            }, false);
}

function CamposNumericos(id,max,min, expresion)
{
    valor = document.getElementById(id).value;
    if (valor > max || valor < min || !expresion.test(valor) && valor != "" && valor != null)
    {
        document.getElementById(id + "div").className = "form-group has-error";
    }
    else
    {
          document.getElementById(id + "div").className = "form-group has-success";  
    }
}

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
function Ajax_Material(valor1, valor2, valor3, valor4, valor5, peticionn)
{
    valor2 == true ? valor2 = 1 : valor2 = 0;
    valor3 == true ? valor3 = 1 : valor3 = 0;
    valor4 == true ? valor4 = 1 : valor4 = 0;
    var request;
    request = $.ajax({
        url: "/ajax.php",
        type: "GET",
        data: {val1: valor1, val2: valor2, val3: valor3, val4: valor4, val5: valor5, peticion: peticionn}
    });

    request.done(function(response, textStatus, jqXHR)
    {
        coso = JSON.parse(response);
        $("#inputbusqueda1").autocomplete({
            source: coso
        });
    });
}


