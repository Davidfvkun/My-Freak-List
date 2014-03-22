<?php

/* EditarUsuarios.html.twig */
class __TwigTemplate_9f8c6657c605c45dffe1bf2cae8434244a4055bc06e1533dae54a2bd17c07af5 extends Twig_Template
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
        echo "  
        <div class=\"Cajita panel panel-success\">
            <div class=\"panel-heading\">
            ";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "
            </div>
            <div class=\"panel-body PaddingsCajita\">
            <form method=\"POST\" action=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("actualiza", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\" role=\"form\">
                    <div class=\"form-group\">
\t\t\t<label for=\"nombre\">Introduce nombre usuario</label>
\t\t\t<input type=\"text\" name=\"nombre\" id=\"nombre\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, (isset($context["nombre"]) ? $context["nombre"] : null), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"Introduzca su nombre\" />
                    </div>
                    <div class=\"form-group\">
\t\t\t<label for=\"clave\">Introduce la contraseña</label>
\t\t\t<input type=\"password\" name=\"clave\" id=\"clave\" value=\"\" class=\"form-control\" placeholder=\"Introduzca su contraseña\" />
                    </div>
                    <div class=\"form-group\">
\t\t\t<label for=\"nombreC\">Introduce nombre completo</label>
\t\t\t<input type=\"text\" name=\"nombreC\" id=\"nombreC\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["nombrec"]) ? $context["nombrec"] : null), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"Introduzca el nombre completo\" />
                    </div>
                          <div class=\"form-group\">
                            <label for=\"optionsRadios\"> ¿Administrador?</label>
                                <label>
                                    ";
        // line 24
        if (((isset($context["privilegios"]) ? $context["privilegios"] : null) == 1)) {
            // line 25
            echo "                                    <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios1\" value=\"Si\" checked>
                                    ";
        } else {
            // line 27
            echo "                                    <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios1\" value=\"Si\">
                                    ";
        }
        // line 29
        echo "\t\t\t\t Si
\t\t\t\t</label>
\t\t\t\t<label>
                                    ";
        // line 32
        if (((isset($context["privilegios"]) ? $context["privilegios"] : null) == 0)) {
            // line 33
            echo "                                    <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios2\" value=\"No\" checked>
                                    ";
        } else {
            // line 35
            echo "                                    <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios2\" value=\"No\">
                                    ";
        }
        // line 37
        echo "\t\t\t\t\tNo
\t\t\t\t</label>
                            </div>
                    <div class=\"center\">
                        <button type=\"submit\" class=\"btn btn-primary btn-lg\" name=\"";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "</button>
                    </div>
            </form>
            </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "EditarUsuarios.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 41,  91 => 37,  87 => 35,  83 => 33,  81 => 32,  76 => 29,  72 => 27,  68 => 25,  66 => 24,  58 => 19,  47 => 11,  41 => 8,  35 => 5,  28 => 2,);
    }
}
