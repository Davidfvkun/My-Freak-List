<?php

/* gestionar.html.twig */
class __TwigTemplate_a11eb5874bebdf1a683d457c6037046b01e178d59c006d8103e6985d89b784f2 extends Twig_Template
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
        <div class=\"Cajita\">
                <table class=\"table table-hover MyTable\">
                    <thead>
                        <th>Nick</th>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>Administrador</th>
                    </thead>
                    <tbody>
                        ";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["losUsuarios"]) ? $context["losUsuarios"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["usuario"]) {
            // line 14
            echo "                            <tr>
                                <td>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre"), "html", null, true);
            echo "</td>
                                <td><a href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("eliminar", array("id" => $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "id"))), "html", null, true);
            echo "\">Eliminar</a></td>
                                <td><a href=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("editar", array("id" => $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "id"))), "html", null, true);
            echo "\">Editar</a></td>
                                ";
            // line 18
            if (($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "es_admin") == 1)) {
                // line 19
                echo "                                <td>Si</td>
                                ";
            } else {
                // line 21
                echo "                                <td>No</td>
                                ";
            }
            // line 23
            echo "                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['usuario'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "                    </tbody>
                </table>
        </div>
";
    }

    public function getTemplateName()
    {
        return "gestionar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 25,  77 => 23,  73 => 21,  69 => 19,  67 => 18,  63 => 17,  59 => 16,  55 => 15,  52 => 14,  48 => 13,  33 => 3,  28 => 2,);
    }
}
