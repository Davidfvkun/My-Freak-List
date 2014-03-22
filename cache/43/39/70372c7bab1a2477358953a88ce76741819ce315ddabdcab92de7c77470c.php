<?php

/* login.html.twig */
class __TwigTemplate_433970372c7bab1a2477358953a88ce76741819ce315ddabdcab92de7c77470c extends Twig_Template
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

    // line 3
    public function block_contenido($context, array $blocks = array())
    {
        echo "  
        <nav role=\"navigation\" class=\"navbar navbar-default\">
            <div class=\"navbar-header\">
                <button type=\"button\" data-target=\"#navbarCollapse\" data-toggle=\"collapse\" class=\"navbar-toggle\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <label class=\"navbar-brand\">GLI Oretania</label>
            </div>
            <div id=\"navbarCollapse\" class=\"collapse navbar-collapse\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"#\">Instalador</a></li>
                </ul>
            </div>
        </nav>
        <div class=\"";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["clase"]) ? $context["clase"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["mal"]) ? $context["mal"] : null), "html", null, true);
        echo "</div><br/>
        <div class=\"Cajita\">
            <div class=\"panel panel-success\">
                <div class=\"panel-heading\">
                Login
                </div>
                <div class=\"panel-body PaddingsCajita\">
                <form method=\"POST\" action=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("inicio"), "html", null, true);
        echo "\" role=\"form\">
                    <div class=\"form-group\">
                            <label for=\"nombre\">Nick</label>
                            <input type=\"text\" name=\"nombre\" id=\"nombre\" class=\"form-control\" onBlur=\"HabilitaBoton(new Array(this.value),new Array('entr'));\" placeholder=\"Introduzca su nick de usuario\" />
                    </div>
                    <div class=\"form-group\">
                            <label for=\"clave\">Contraseña</label>
                            <input type=\"password\" name=\"clave\" id=\"clave\" class=\"form-control\" placeholder=\"Introduzca su contraseña\" />
                    </div>
                    <div class=\"center\">
                            <input type=\"submit\" value=\"Entrar\" name=\"entrar\" id=\"entr\" class=\"btn btn-primary btn-lg marg\" />
                            <input type=\"reset\" value=\"Limpiar\" name=\"limpiar\" class=\"btn btn-default btn-lg\" />
                    </div>
                </form>
                </div>
            </div>
        </div>
        <script type=\"text/JavaScript\">
            window.onload = HabilitaBoton(new Array(\"\"),new Array('entr'));
        </script>
    ";
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 27,  49 => 20,  28 => 3,);
    }
}
