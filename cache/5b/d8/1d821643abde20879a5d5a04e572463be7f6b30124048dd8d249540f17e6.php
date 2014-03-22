<?php

/* devolucionmanual.html.twig */
class __TwigTemplate_5bd81d821643abde20879a5d5a04e572463be7f6b30124048dd8d249540f17e6 extends Twig_Template
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
        echo "        <div class=\"";
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
                Buscar ejemplares para devolver
                </div>
                <div class=\"panel-body PaddingsCajita\">
                <form method=\"POST\" action=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("devolverManualmente"), "html", null, true);
        echo "\" role=\"form\">
                    <div class=\"form-group\">
                               <label>Introduce alumno</label>
                                <input type=\"text\" class=\"form-control\" name=\"alumno\" 
                                       onBlur=\"HabilitaBoton(new Array(this.value),new Array('busc'))\" />
                    </div>
                    <div class=\"center\">
                        <button type=\"submit\" name=\"buscarDevolver\" id=\"busc\" class=\"btn btn-primary btn-lg Conjunto\">Buscar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        ";
        // line 23
        if (((isset($context["ejemplares"]) ? $context["ejemplares"] : null) != null)) {
            // line 24
            echo "            <div class=\"col-md-8\" >
                <form method=\"POST\" action=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("devolverManualmente"), "html", null, true);
            echo "\">
                     <input type=\"hidden\" name=\"oculto\" value=\"";
            // line 26
            echo twig_escape_filter($this->env, (isset($context["iden"]) ? $context["iden"] : null), "html", null, true);
            echo "\" />
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>Id Ejemplar</th>
                            <th>Libro</th>
                            <th>Estado</th>
                            <th>Devolver</th>
                        </thead>
                        <tbody>
                         ";
            // line 35
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ejemplares"]) ? $context["ejemplares"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ejemplar"]) {
                // line 36
                echo "                            ";
                if ((($this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "estado") >= 1) && ($this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "estado") <= 3))) {
                    // line 37
                    echo "                            <tr>
                                <td>";
                    // line 38
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "id"), "html", null, true);
                    echo "</td>
                                <td>";
                    // line 39
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "titulo"), "html", null, true);
                    echo "</td>
                                <td>
                                    <select class=\"form-control\" name=\"";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "id"), "html", null, true);
                    echo "\">
                                        ";
                    // line 42
                    if (($this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "estado") == 1)) {
                        // line 43
                        echo "                                        <option value=\"3\">Bueno</option>
                                        <option value=\"2\">Regular</option>
                                        <option value=\"1\" selected=\"selected\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                        ";
                    } elseif (($this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "estado") == 2)) {
                        // line 48
                        echo "                                        <option value=\"3\">Bueno</option>
                                        <option value=\"2\"  selected=\"selected\">Regular</option>
                                        <option value=\"1\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                        ";
                    } elseif (($this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "estado") == 3)) {
                        // line 53
                        echo "                                        <option value=\"3\" selected=\"selected\">Bueno</option>
                                        <option value=\"2\">Regular</option>
                                        <option value=\"1\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                    ";
                    }
                    // line 58
                    echo "                                    </select>
                                </td>
                                <td><button class=\"btn btn-default btn-xs\" name=\"devolver\" value=\"";
                    // line 60
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejemplar"]) ? $context["ejemplar"] : null), "id"), "html", null, true);
                    echo "\" >Devolver</button></td>
                            </tr>
                            ";
                }
                // line 63
                echo "                         ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ejemplar'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                        </tbody>
                    </table>
                   </form>
            </div>
        ";
        }
        // line 69
        echo "        <script type=\"text/JavaScript\">
            window.onload = HabilitaBoton(new Array(\"\"),new Array('busc'));
        </script>
";
    }

    public function getTemplateName()
    {
        return "devolucionmanual.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 69,  146 => 64,  140 => 63,  134 => 60,  130 => 58,  123 => 53,  116 => 48,  109 => 43,  107 => 42,  103 => 41,  98 => 39,  94 => 38,  91 => 37,  88 => 36,  84 => 35,  72 => 26,  68 => 25,  65 => 24,  63 => 23,  47 => 10,  38 => 4,  31 => 3,  28 => 2,);
    }
}
