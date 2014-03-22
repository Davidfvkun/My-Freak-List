<?php

/* entregarlote.html.twig */
class __TwigTemplate_29979ac681bd486dadc631d345a6567bc83baf4a47676f20842077fc5943b68e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base2.html.twig");

        $this->blocks = array(
            'contenido' => array($this, 'block_contenido'),
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
    public function block_contenido($context, array $blocks = array())
    {
        // line 3
        echo "        <script type=\"text/JavaScript\">
            window.onload = init3;
        </script>
        ESTA PARTE NO ESTÁ FUNCIONAL
        SI PULSAS EL BOTÓN BUSCAR NO LLEVA A NINGÚN SITIO
        <div class=\"";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["clase"]) ? $context["clase"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["info"]) ? $context["info"] : null), "html", null, true);
        echo "</div><br/>
        <div id=\"FormAjax\" class=\"Cargando\"><img src='/utilidades/cargando.gif' alt='cargando' /></div>
        <div class=\"";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["caja"]) ? $context["caja"] : null), "html", null, true);
        echo "\">
            <div class=\"panel panel-success \">
                <div class=\"panel-heading\">
                Buscar alumno para entregar lote
                </div>
                <div class=\"panel-body PaddingsCajita\">
                <form method=\"POST\" action=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("listado"), "html", null, true);
        echo "\" role=\"form\">
                        <div class=\"form-group\">
                              <label for=\"codigo\">Introduce ID Alumno</label>
                            <input type=\"text\" name=\"codigo\" id=\"codigoE\" class=\"form-control\" 
                                   placeholder=\"Introduzca su código\" />
                        </div>
                        <div class=\"form-group\">
                            <label for=\"nivel\">Introduce nivel</label>
                            <select class=\"form-control\" name=\"nivel\" id=\"nivel\" >
                            </select>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"asignatura\">Introduce las asignatuas de las que se va a  matricular</label>
                            <div id=\"Pruebas34\"></div>
                        </div>
                        <div class=\"center\">
                            <button type=\"submit\" name=\"buscarListado\" class=\"btn btn-primary btn-lg Conjunto\">Buscar</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
        ";
        // line 38
        if (((isset($context["caja"]) ? $context["caja"] : null) == "col-md-4")) {
            // line 39
            echo "            <div class=\"col-md-8\">
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>ISBN</th>
                            <th>Titulo</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
            </div>
        ";
        }
    }

    public function getTemplateName()
    {
        return "entregarlote.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 39,  79 => 38,  54 => 16,  45 => 10,  38 => 8,  31 => 3,  28 => 2,);
    }
}
