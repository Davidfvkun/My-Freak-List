<?php

/* base.html.twig */
class __TwigTemplate_396e0f6ac780bcf3a1cd7ce482d195d4b15b1cb20e660378256953c44a8d699b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'contenido1' => array($this, 'block_contenido1'),
            'contenido2' => array($this, 'block_contenido2'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <!-- alt + shift + f -->
        <title>My Freak Zone</title>
        <meta name=\"author\" content=\"David\" charset=\"UTF-8\" >
        <meta name=\"description\" content=\"Proyecto fin de DAW\" >
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <link rel=\"stylesheet\" href=\"/utilidades/css/Flatly/bootstrap.min.css\" id=\"styl2\">
        <link rel=\"stylesheet\" href=\"/utilidades/css/Flatly/bootswatch.less\" id=\"styl\">
        <link rel=\"stylesheet\" href=\"/utilidades/css/MyStyle.css\" type=\"text/css\" >
        <link rel=\"icon\" type=\"image/png\" href=\"/utilidades/img.png\" >
        <script type=\"text/javascript\" src=\"http://code.jquery.com/jquery.min.js\"></script>
        <script src=\"http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js\"></script>
        <script src=\"/utilidades/js/MyJavaScript.js\" type=\"text/JavaScript\"></script>
    </head>
    <body>
    ";
        // line 18
        $this->displayBlock('contenido1', $context, $blocks);
        // line 20
        echo "    ";
        $this->displayBlock('contenido2', $context, $blocks);
        // line 22
        echo "    </body>
</html>";
    }

    // line 18
    public function block_contenido1($context, array $blocks = array())
    {
        // line 19
        echo "    ";
    }

    // line 20
    public function block_contenido2($context, array $blocks = array())
    {
        // line 21
        echo "    ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  60 => 21,  57 => 20,  53 => 19,  50 => 18,  45 => 22,  42 => 20,  40 => 18,  21 => 1,);
    }
}
