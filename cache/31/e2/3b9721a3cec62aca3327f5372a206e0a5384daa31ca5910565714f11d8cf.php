<?php

/* modificaciones.html.twig */
class __TwigTemplate_31e23b9721a3cec62aca3327f5372a206e0a5384daa31ca5910565714f11d8cf extends Twig_Template
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
                Modificaciones
            </div>
            <div class=\"panel-body PaddingsCajita\">
            <form method=\"POST\" action=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("modificaciones"), "html", null, true);
        echo "\" role=\"form\">
                    <div class=\"form-group\">
\t\t\t    <label for=\"id\">Introduce id</label>
                                <input type=\"text\" name=\"id\" id=\"id\" class=\"form-control\" onBlur=\"HabilitaBoton(this.value,new Array('bus'));\"
                                   placeholder=\"Introduzca el código del ejemplar\" />
                    </div>
                    <div class=\"center\">
                        <button type=\"submit\" id=\"bus\" type=\"button\" name=\"buscarModificar\" class=\"btn btn-primary btn-lg\">Buscar</button>
                    </div>
                </form>
             </div>
         </div>
       </div>
         ";
        // line 23
        if (((isset($context["caja"]) ? $context["caja"] : null) == "col-md-4")) {
            // line 24
            echo "            
            <form method=\"POST\" action=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("modificaciones"), "html", null, true);
            echo "\" role=\"form\"> 
                <input type=\"hidden\" name=\"oculto\" value=\"";
            // line 26
            echo twig_escape_filter($this->env, (isset($context["iden"]) ? $context["iden"] : null), "html", null, true);
            echo "\" />
              <div class=\"col-md-8\">
                <div class=\"panel panel-success\" >
                    <div class=\"panel-heading\">
                        Actualizar
                    </div>
                    <div class=\"panel-body PaddingsCajita\">
                       <label>El estado del ejemplar es ";
            // line 33
            echo twig_escape_filter($this->env, (isset($context["elestado"]) ? $context["elestado"] : null), "html", null, true);
            echo "
                        </label>
                       <div class=\"form-group\">
                        <label for=\"estado\">Actualiza el estado:</label>
                             <select class=\"form-control\" id=\"estado\" name=\"estado\">
                                     ";
            // line 38
            if (($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "estado") == 1)) {
                // line 39
                echo "                                        <option value=\"3\">Bueno</option>
                                        <option value=\"2\">Regular</option>
                                        <option value=\"1\" selected=\"selected\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                        ";
            } elseif (($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "estado") == 2)) {
                // line 44
                echo "                                        <option value=\"3\">Bueno</option>
                                        <option value=\"2\"  selected=\"selected\">Regular</option>
                                        <option value=\"1\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                        ";
            } elseif (($this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "estado") == 3)) {
                // line 49
                echo "                                        <option value=\"3\" selected=\"selected\">Bueno</option>
                                        <option value=\"2\">Regular</option>
                                        <option value=\"1\">Malo</option>
                                        <option value=\"0\">Perdido</option>
                                    ";
            }
            // line 54
            echo "                             </select>
                        </div>
                       <div class=\"form-group\">
                            <label for=\"fecha\">Fecha</label>
                            <input type=\"date\" name=\"fecha\" id=\"fecha\" value=\"";
            // line 58
            echo twig_escape_filter($this->env, (isset($context["fechaa"]) ? $context["fechaa"] : null), "html", null, true);
            echo "\" class=\"form-control\" />
                        </div>
                        <div class=\"form-group\">
                            <label for=\"comentario\">Añadir comentario</label>
                            <textarea rows=\"4\" cols=\"30\" name=\"comentario\" id=\"comentario\" class=\"form-control\" placeholder=\"Haga un comentario sobre este ejemplar\" ></textarea>
                        </div>
                        <div class=\"center\">
                            <button type=\"submit\" type=\"button\" name=\"actualizar\" class=\"btn btn-primary btn-lg\">Actualizar</button>
                            <button type=\"submit\" type=\"button\" name=\"baja\" class=\"btn btn-success btn-lg\">Eliminar</button>
                        </div>
                    </div>
                </div>
              </div>
            </form>
         ";
        }
        // line 73
        echo "       <script type=\"text/JavaScript\">
            window.onload = HabilitaBoton(new Array(\"\"),new Array('bus'));
        </script>
";
    }

    public function getTemplateName()
    {
        return "modificaciones.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 73,  120 => 58,  114 => 54,  107 => 49,  100 => 44,  93 => 39,  91 => 38,  83 => 33,  73 => 26,  69 => 25,  66 => 24,  64 => 23,  48 => 10,  39 => 4,  33 => 3,  28 => 2,);
    }
}
