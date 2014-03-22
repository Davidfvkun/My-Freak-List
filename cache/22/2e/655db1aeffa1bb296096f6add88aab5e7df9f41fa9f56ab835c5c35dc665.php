<?php

/* altas.html.twig */
class __TwigTemplate_222e655db1aeffa1bb296096f6add88aab5e7df9f41fa9f56ab835c5c35dc665 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html.twig");

        $this->blocks = array(
            'contenido' => array($this, 'block_contenido'),
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
    public function block_contenido($context, array $blocks = array())
    {
        echo " 
    
    <form method=\"POST\" action=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("busqueda"), "html", null, true);
        echo "\" role=\"form\">
        <div class=\"row\">
            <h1>";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["encabezado"]) ? $context["encabezado"] : null), "html", null, true);
        echo "</h1>
            <div class=\"Cajita\"> 
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                        Busqueda
                        </div>
                        <div class=\"panel-body\">
                            <div class=\"form-group\">
                                <label for=\"Vuelo\">Introduce vuelo</label>
                                <input type=\"text\" name=\"Vuelo\" class=\"form-control\" 
                                       placeholder=\"Introduzca el vuelo\" />
                                <input type=\"hidden\" name=\"filtro\" value=\"";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["caso"]) ? $context["caso"] : null), "html", null, true);
        echo "\" />
                            </div>
                            <button type=\"submit\" id=\"busca\" type=\"button\" name=\"buscarHistorial\" 
                                class=\"btn btn-primary btn-sm\">Buscar</button>
                        </div>
                        
                  </div>
            </div>
        </div>        
     </form>
        <div class=\"row\">
         <div class=\"col-md-8\"> 
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>Código</th>
                            <th>Es Salida</th>
                            <th>hora</th>
                            <th>Nombre aeropuerto</th>
                        </thead>
                        <tbody>
                            ";
        // line 37
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["consulta"]) ? $context["consulta"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 38
            echo "                                <tr>
                                    <td>";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "codigo"), "html", null, true);
            echo "</td>
                                    ";
            // line 40
            if (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "es_salida") == 1)) {
                // line 41
                echo "                                        <td>Salida a ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "aeropuerto_id"), "html", null, true);
                echo "</td>
                                    ";
            } elseif (($this->getAttribute((isset($context["i"]) ? $context["i"] : null), "es_salida") == 0)) {
                // line 43
                echo "                                        <td>Llegada desde ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "aeropuerto_id"), "html", null, true);
                echo "</td>
                                    ";
            }
            // line 45
            echo "                                    <td>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "hora"), "html", null, true);
            echo "</td>
                                    <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "descripcion"), "html", null, true);
            echo "</td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 49
            echo "                                <div class=\"Info\">No hay datos</div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "                        </tbody>
                    </table>
            </div>
            <div class=\"col-md-4\"> 
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                    Aeropuertos
                    </div>
                    <div class=\"panel-body\">
                        <ul>
                        ";
        // line 61
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["consultaAeropuertos"]) ? $context["consultaAeropuertos"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 62
            echo "                            <li><a href=\"../busquedaAeropuero/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["i"]) ? $context["i"] : null), "descripcion"), "html", null, true);
            echo "</a></li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "                        </ul>
                        <a class=\"btn btn-default btn-sm\" href=\"../busquedaAeropuero/Todos\">Todos los aeropuertos</a>
                    </div>
              </div>
            </div>
          </div>
";
    }

    public function getTemplateName()
    {
        return "altas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 64,  138 => 62,  134 => 61,  122 => 51,  115 => 49,  107 => 46,  102 => 45,  96 => 43,  90 => 41,  88 => 40,  84 => 39,  81 => 38,  76 => 37,  53 => 17,  39 => 6,  34 => 4,  28 => 2,);
    }
}
