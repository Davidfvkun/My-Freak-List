<?php

/* base2.html.twig */
class __TwigTemplate_107250ef35a757358581517022ffdefc163e97bf113bdea2054f65427585ab7f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html.twig");

        $this->blocks = array(
            'contenido1' => array($this, 'block_contenido1'),
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
    public function block_contenido1($context, array $blocks = array())
    {
        // line 3
        echo "<div class=\"navbar navbar-default navbar-fixed-top\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <a href=\"#\" class=\"navbar-brand\"><img src=\"/utilidades/img.png\" alt=\"simbolo\" /> MyFreakZone</a>
            <button class=\"navbar-toggle\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbar-main\">
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
        </div>
        <div class=\"navbar-collapse collapse\" id=\"navbar-main\">
            <ul class=\"nav navbar-nav\">
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" id=\"themes\">Anime<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" aria-labelledby=\"themes\">
                        <li><a href=\"#\">Vistos</a></li>
                        <li><a href=\"#\">Viendo</a></li>
                        <li><a href=\"#\">Pendientes</a></li>
                    </ul>
                </li>
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" id=\"themes\">Series<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" aria-labelledby=\"themes\">
                        <li><a href=\"#\">Vistas</a></li>
                        <li><a href=\"#\">Viendo</a></li>
                        <li><a href=\"#\">Pendientes</a></li>
                    </ul>
                </li>
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" id=\"themes\">Películas<span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\" aria-labelledby=\"themes\">
                        <li><a href=\"#\">Vistas</a></li>
                        <li><a href=\"#\">Viendo</a></li>
                        <li><a href=\"#\">Pendientes</a></li>
                    </ul>
                </li>
            </ul>
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"#\">Mi perfil</a></li>
                <li><a href=\"#\">Salir</a></li>
            </ul>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "base2.html.twig";
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
