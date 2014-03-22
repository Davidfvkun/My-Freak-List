<?php

/* inicio.html.twig */
class __TwigTemplate_257fcfdcef30f1b005bdb322fc65f4fd00f3f1f251f90c51a70dfc79e843580e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base2.html.twig");

        $this->blocks = array(
            'contenido2' => array($this, 'block_contenido2'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base2.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_contenido2($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"container margintop\">
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
            <!--<h2>Busqueda de animes/series/películas</h2>-->
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <ul class=\"nav nav-tabs panel-title\">
                        <li><a href=\"#tab1\" data-toggle=\"tab\">Busqueda normal</a></li>
                        <li><a href=\"#tab2\" data-toggle=\"tab\">Busqueda avanzada</a></li>
                    </ul>
                </div>
                <div class=\"panel-body\">
                    <div class=\"tab-content\">
                        <div id=\"tab1\" class=\"tab-pane fade\">
                            <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
                                <div class=\"form-group\">
                                    <label for=\"inputBusqueda\" class=\"col-lg-2 control-label\">Buscar</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" id=\"inputBusqueda\" placeholder=\"Introduce el nombre del X\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label class=\"col-lg-2 control-label\">Tipo</label>
                                    <div class=\"col-lg-10\">
                                        <div class=\"checkbox\">
                                            <label>
                                                <input type=\"checkbox\" > Anime
                                            </label>
                                        </div>
                                        <div class=\"checkbox\">
                                            <label>
                                                <input type=\"checkbox\"> Serie
                                            </label>
                                        </div>
                                        <div class=\"checkbox\">
                                            <label>
                                                <input type=\"checkbox\"> Película
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <div class=\"center\" class=\"col-lg-10\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id=\"tab2\" class=\"tab-pane fade\">
                            <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
                                <div class=\"form-group\">
                                    <label for=\"inputgenero\" class=\"col-lg-2 control-label\">Género</label>
                                    <div class=\"col-lg-10\">
                                        <select class=\"form-control\" >
                                        </select>
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputfecha\" class=\"col-lg-2 control-label\">Fecha de estreno</label>
                                    <div class=\"col-lg-10\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"Introducir año\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <div class=\"center\" class=\"col-lg-10\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-6\">
            <!--<h2>Busqueda de usuarios</h2>-->
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">Buscar usuarios</h3>
                </div>
                <div class=\"panel panel-body\">
                    <form class=\"form-horizontal\">
                        <div class=\"form-group\">
                            <label for=\"inputBusqueda\" class=\"col-lg-2 control-label\">Buscar usuario</label>
                            <div class=\"col-lg-10\">
                                <input type=\"text\" class=\"form-control\" id=\"inputBusqueda\" placeholder=\"Introduce el X del usuario\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"select\" class=\"col-lg-2 control-label\">Filtrar por</label>
                            <div class=\"col-lg-10\">
                                <select class=\"form-control\" id=\"select\">
                                    <option>Nombre</option>
                                    <option>Nick</option>
                                    <option>Material</option>
                                </select>
                            </div>
                        </div>
                        <div class=\"col-lg-10 center\">
                            <button type=\"submit\" class=\"btn btn-primary\">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">Noticias recientes</h3>
                </div>
                <div class=\"panel panel-body\">
                    Aquí se importarán desde la base de datos
                    las últimas noticias filtrando por X fecha
                </div>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "inicio.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 3,  28 => 2,);
    }
}
