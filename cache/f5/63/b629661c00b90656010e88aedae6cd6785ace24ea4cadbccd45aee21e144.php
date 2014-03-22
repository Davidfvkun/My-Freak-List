<?php

/* myfreakzone.html.twig */
class __TwigTemplate_f563b629661c00b90656010e88aedae6cd6785ace24ea4cadbccd45aee21e144 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html.twig");

        $this->blocks = array(
            'contenido2' => array($this, 'block_contenido2'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_contenido2($context, array $blocks = array())
    {
        // line 3
        echo "<!--
    Cosas pendientes de esta plantilla.
    1. Colocar names e ids en los inputs para poder empezar a trabajar con PHP y JavaScript.
    2. El enlace de '¿Ha olvidado la contraseña?' Debe llevar a algún lado.
    3. Comprobar con JavaScript y PHP que metes un nick y clave validos al registrarte.
    4. Enviar un correo a la dirección de email introducida para confirmar el registro *(Ni idea de como hacerlo aun)
    5 ?¿?¿ (De momento creo que nada mas)
-->
<div class=\"navbar navbar-default navbar-fixed-top\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <a href=\"#\" class=\"navbar-brand\"><img src=\"/utilidades/img.png\" alt=\"simbolo\" /> MyFreakZone</a>
            <button class=\"navbar-toggle\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbar-main\">
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
        </div>
        <div class=\"navbar-collapse collapse\" id=\"navbar-main\">
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"#\">Ni idea de que poner aqui</a></li>
            </ul>
        </div>
    </div>
</div>
<div class=\"container margintop\">
    <div class=\"row\">
        <div class=\"col-lg-2\">
            <label class=\"minibuttons flatly\" onClick=\"CambiaEstilos('Flatly')\">&#9679;</label>
            <label class=\"minibuttons readable\" onClick=\"CambiaEstilos('Readable')\">&#9679;</label>
            <label class=\"minibuttons cosmo\" onClick=\"CambiaEstilos('Cosmo')\">&#9679;</label>
            <label class=\"minibuttons cerulean\" onClick=\"CambiaEstilos('Cerulean')\">&#9679;</label>
            <label class=\"minibuttons cyborg\" onClick=\"CambiaEstilos('Cyborg')\">&#9679;</label>
            <label class=\"minibuttons lumen\" onClick=\"CambiaEstilos('Lumen')\">&#9679;</label>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <ul class=\"nav nav-tabs panel-title\">
                        <li><a href=\"#tab1\" data-toggle=\"tab\">Login</a></li>
                        <li><a href=\"#tab2\" data-toggle=\"tab\">Registrate</a></li>
                    </ul>
                </div>
                <div class=\"panel-body\">
                    <div class=\"tab-content\">
                        <div id=\"tab1\" class=\"tab-pane fade\">
                            <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
                                <div class=\"form-group\">
                                    <label for=\"inputnick\" class=\"col-lg-2 control-label\">Nick</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introduce tu nick de usuario\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputclave\" class=\"col-lg-2 control-label\">Clave</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"password\" class=\"form-control\" placeholder=\"Introduce tu contraseña\">
                                    </div>
                                </div>
                                <div class=\"center\" class=\"col-lg-2 control-label\">
                                    <input type=\"submit\" value=\"Entrar\" name=\"entrar\" class=\"btn btn-primary\" />
                                    <input type=\"reset\" value=\"Limpiar\" name=\"limpiar\" class=\"btn btn-default\" /><br/><br/>
                                    <a>¿Ha olvidado su contraseña?</a>
                                </div>
                            </form>
                        </div>
                        <div id=\"tab2\" class=\"tab-pane fade\">
                            <form class=\"form-horizontal\" method=\"POST\" action=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("registro"), "html", null, true);
        echo "\">
                                <div class=\"form-group\">
                                    <label for=\"inputnick\" class=\"col-lg-2 control-label\">Nick *</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introduce tu nick de usuario\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputclave\" class=\"col-lg-2 control-label\">Clave *</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"password\" class=\"form-control\" placeholder=\"Introduce tu contraseña\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputemail\" class=\"col-lg-2 control-label\">Email *</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introduce tu email\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputdescripcion\" class=\"col-lg-2 control-label\">Nombre</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introduce aquí tu nombre\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputdescripcion\" class=\"col-lg-2 control-label\">Apellido</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introduce aquí tu apellido\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputdescripcion\" class=\"col-lg-2 control-label\">Algo sobre ti</label>
                                    <div class=\"col-lg-10\">
                                        <textarea rows=\"15\" type=\"text\"class=\"form-control\" 
                                                  placeholder=\"Introduce aquí lo que quieras contar sobre ti\"></textarea>
                                    </div>
                                </div>
                                <div class=\"center\" class=\"col-lg-2 control-label\">
                                    <input type=\"submit\" value=\"Registrarse\" name=\"registrarse\" class=\"btn btn-primary\" />
                                    <input type=\"reset\" value=\"Limpiar\" name=\"limpiar\" class=\"btn btn-default\" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">Datos del sitio</h3>
                </div>
                <div class=\"panel-body\">
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                    Aquí escribiré los datos del sitio
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "myfreakzone.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 72,  31 => 3,  28 => 2,);
    }
}
