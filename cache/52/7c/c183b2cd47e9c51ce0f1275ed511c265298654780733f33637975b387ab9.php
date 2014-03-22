<?php

/* listado.html.twig */
class __TwigTemplate_527cc183b2cd47e9c51ce0f1275ed511c265298654780733f33637975b387ab9 extends Twig_Template
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
            window.onload = init2;
        </script>
        <div class=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["clase"]) ? $context["clase"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["info"]) ? $context["info"] : null), "html", null, true);
        echo "</div><br/>
        <div id=\"FormAjax\" class=\"Cargando\"><img src='/utilidades/cargando.gif' alt='cargando' /></div>
        <div class=\"";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["caja"]) ? $context["caja"] : null), "html", null, true);
        echo "\">
            <div class=\"panel panel-success \"> <!-- id=\" caja \" class=\" float \" -->
                <div class=\"panel-heading\">
                Buscar para listado
                </div>
                <div class=\"panel-body PaddingsCajita\">
                <form method=\"POST\" action=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("listado"), "html", null, true);
        echo "\" role=\"form\">
                        <div class=\"form-group\">
                              <label for=\"codigo\">Introduce ID Alumno</label>
                            <input type=\"text\" name=\"codigo\" id=\"codigoL\" class=\"form-control\" 
                                   placeholder=\"Introduzca su código\" onBlur=\"HabilitarListados(this.id);\" />
                        </div>
                        <div class=\"form-group\">
                            <label for=\"nivel\">Introduce nivel</label>
                            <select class=\"form-control\" name=\"nivel\" id=\"nivel\" onChange=\"HabilitarListados(this.id);\" >
                            </select>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"asignatura\">Introduce la asignatura</label>
                            <select class=\"form-control\" name=\"asignatura\" onChange=\"HabilitarListados(this.id);\" id=\"asignatura\">

                            </select>
                        </div>
                        <div class=\"form-group\">
                        <label for=\"estado\">Introduce estado</label>
                            <select class=\"form-control\" id=\"estado\" name=\"estado\" onChange=\"HabilitarListados(this.id);\">
                                <option></option>
                                <option value=\"3\">Bueno</option>
                                <option value=\"2\">Regular</option>
                                <option value=\"1\">Malo</option>
                                <option value=\"0\">Perdido</option>
                            </select>
                        </div>
                        <div class=\"radio\">
                             <label>
                                <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios1\" value=\"No\" 
                                       onChange=\"Habilitar(1)\">
                                No devueltos
                             </label>
                        </div>
                        <div class=\"radio\">
                            <label>
                                <input type=\"radio\" name=\"optionsRadios\" id=\"optionsRadios2\" value=\"Si\" 
                                       onChange=\"Habilitar(2)\">
                                Todos
                            </label>
                        </div>
                        <div class=\"center\">
                            <button type=\"submit\" name=\"buscarListado\" class=\"btn btn-primary btn-lg Conjunto\">Buscar</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
        ";
        // line 62
        if (((isset($context["caja"]) ? $context["caja"] : null) == "col-md-4")) {
            // line 63
            echo "            <div class=\"col-md-8\">
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>ISBN</th>
                            <th>Titulo</th>
                            <th>Estado</th>
                            <th>Asignatura</th>
                            <th>Nivel</th>
                            <th>Alumno</th>
                        </thead>
                        <tbody>
                            ";
            // line 74
            $context["cont"] = 0;
            // line 75
            echo "                            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["lista"]) ? $context["lista"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 76
                echo "                                <tr>
                                    <td>";
                // line 77
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "isbn"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 78
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "titulo"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 79
                if (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 1)) {
                    // line 80
                    echo "                                            Malo
                                        ";
                } elseif (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 2)) {
                    // line 81
                    echo "  
                                               Regular
                                        ";
                } elseif (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 3)) {
                    // line 83
                    echo "  
                                               Bueno
                                        ";
                } else {
                    // line 85
                    echo "  
                                               Perdido o de baja
                                        ";
                }
                // line 87
                echo "  </td>
                                    <td>";
                // line 88
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "nombre"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 89
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "descripcion"), "html", null, true);
                echo "</td>
                                    ";
                // line 90
                if (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "apellidos") == null)) {
                    // line 91
                    echo "                                    <td>No está prestado</td>
                                    ";
                } else {
                    // line 93
                    echo "                                    <td>";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "apellidos"), "html", null, true);
                    echo "</td>
                                    ";
                }
                // line 95
                echo "                                </tr>
                                ";
                // line 96
                $context["cont"] = ((isset($context["cont"]) ? $context["cont"] : null) + 1);
                // line 97
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                        </tbody>
                    </table>
                    <div class=\"Info\">El número de items es ";
            // line 100
            echo twig_escape_filter($this->env, (isset($context["cont"]) ? $context["cont"] : null), "html", null, true);
            echo "</div>
            </div>
        ";
        }
    }

    public function getTemplateName()
    {
        return "listado.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 100,  191 => 98,  185 => 97,  183 => 96,  180 => 95,  174 => 93,  170 => 91,  168 => 90,  164 => 89,  160 => 88,  157 => 87,  152 => 85,  147 => 83,  142 => 81,  138 => 80,  136 => 79,  132 => 78,  128 => 77,  125 => 76,  120 => 75,  118 => 74,  105 => 63,  103 => 62,  52 => 14,  43 => 8,  36 => 6,  31 => 3,  28 => 2,);
    }
}
