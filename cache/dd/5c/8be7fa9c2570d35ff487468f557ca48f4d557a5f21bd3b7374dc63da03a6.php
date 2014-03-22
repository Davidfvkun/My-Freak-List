<?php

/* historial.html.twig */
class __TwigTemplate_dd5c8be7fa9c2570d35ff487468f557ca48f4d557a5f21bd3b7374dc63da03a6 extends Twig_Template
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
    <div class=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["clase"]) ? $context["clase"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["info"]) ? $context["info"] : null), "html", null, true);
        echo "</div><br/>
    <div class=\"";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["caja"]) ? $context["caja"] : null), "html", null, true);
        echo "\">
        <div class=\"panel panel-success\">
            <div class=\"panel-heading\">
                Busqueda de historial
            </div>
            <div class=\"panel-body PaddingsCajita\">
            <form method=\"POST\" action=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("historial"), "html", null, true);
        echo "\" role=\"form\">
                    <div class=\"form-group\">
\t\t\t    <label for=\"id\">Introduce id</label>
                            <input type=\"text\" name=\"id\" id=\"id\" class=\"form-control\" 
                                   onBlur=\"HabilitaBoton(new Array(this.value),new Array('busca'))\"
                                   placeholder=\"Introduzca el código del ejemplar\" />
                    </div>
                    <div class=\"center\">
                        <button type=\"submit\" id=\"busca\" type=\"button\" name=\"buscarHistorial\" class=\"btn btn-primary btn-lg\">Buscar</button>
                    </div>
            </form>
             </div>
         </div>
     </div>
         ";
        // line 24
        if ((((isset($context["caja"]) ? $context["caja"] : null) == "col-md-4") && ((isset($context["historial"]) ? $context["historial"] : null) != null))) {
            // line 25
            echo "            <div class=\"col-md-8\">
            <form method=\"POST\" action=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("historial"), "html", null, true);
            echo "\" role=\"form\">  
              
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>Ejemplar id</th>
                            <th>Estado de devolución</th>
                            <th>Alumno</th>
                            <th>Fecha</th>
                            <th>Anotación</th>
                        </thead>
                        <tbody>
                            ";
            // line 37
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["historial"]) ? $context["historial"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 38
                echo "                                <tr>
                                    <td>";
                // line 39
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "ejemplar_id"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 40
                if (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 1)) {
                    // line 41
                    echo "                                            Malo
                                        ";
                } elseif (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 2)) {
                    // line 42
                    echo "  
                                               Regular
                                        ";
                } elseif (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "estado") == 3)) {
                    // line 44
                    echo "  
                                               Bueno
                                        ";
                }
                // line 46
                echo "  </td>
                                    <td>";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "nombre"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "apellidos"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 48
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "fecha"), "html", null, true);
                echo "</td>
                                    <td>";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "anotacion"), "html", null, true);
                echo "</td>
                                </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "                        </tbody>
                    </table>
            </form>
           </div>
         ";
        }
        // line 57
        echo "        <script type=\"text/JavaScript\">
            window.onload = HabilitaBoton(new Array(\"\"),new Array('busca'));
        </script>
";
    }

    public function getTemplateName()
    {
        return "historial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 57,  133 => 52,  124 => 49,  120 => 48,  114 => 47,  111 => 46,  106 => 44,  101 => 42,  97 => 41,  95 => 40,  91 => 39,  88 => 38,  84 => 37,  70 => 26,  67 => 25,  65 => 24,  48 => 10,  39 => 4,  33 => 3,  28 => 2,);
    }
}
