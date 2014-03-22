<?php

/* devolucionlote.html.twig */
class __TwigTemplate_8c1b985e87e1403ac8535cc5e895b5075fecfe0817128ac380bf85c446f89d41 extends Twig_Template
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
        
        <form method=\"POST\" action=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->urlFor("devolverLote"), "html", null, true);
        echo "\" role=\"form\">
            <div class=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["clase"]) ? $context["clase"] : null), "html", null, true);
        echo "\">
                    ";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["info"]) ? $context["info"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 7
            echo "                        ";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
            echo "
                        <br/>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "             </div><br/>
        <div class=\"row\">
          <div class=\"col-md-3\">
            <div class=\"panel panel-success \">
                <div class=\"panel-heading\">
                Alumno del lote
                </div>
                <div class=\"panel-body PaddingsCajita\">
             
                    <div class=\"form-group\">
                          <label for=\"alumno\">Introduce el alumno</label>
                          <input type=\"text\" id=\"idAl\" name=\"alumno\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["alum"]) ? $context["alum"] : null), "html", null, true);
        echo "\" 
                                 onBlur=\"HabilitaBoton(new Array(this.value,this.value,this.value,this.value,this.value), 
                                             new Array('noDev','dev', 'codBE', 'codME', 'codRE'));\"
                                 class=\"form-control\" placeholder=\"Introduce el código del alumno\" />
                   </div>
                    <div class=\"form-group\">
                              <label for=\"fecha\">Fecha</label>
                              <input type=\"date\" name=\"fecha\" id=\"fecha\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["fechaa"]) ? $context["fechaa"] : null), "html", null, true);
        echo "\" class=\"form-control\" />
                    </div>
                    <div class=\"center\">
                        <button name=\"mostrarNoDevueltos\" id=\"noDev\" class=\"btn btn-primary\" >Ejemplares no devueltos</button>
                        <button name=\"enviarDevolverLote\" id=\"dev\" class=\"btn btn-success\" >Devolver Lote</button>
                    </div>
                 </div>
            </div>
          </div>
            <div class=\"col-md-3\">
                <div class=\"panel panel-success\">
                    <div class=\"panel-heading\">
                    Devolución de un lote
                    </div>
                    <div class=\"panel-body PaddingsCajita\">
                        
                                <div class=\"form-group\">
                                        <label>Numero de ejemplares en buen estado</label>
                                        <!--<input type=\"number\" class=\"form-control\" name=\"numeroLibrosB\" />-->
                                        <textarea rows=\"15\" type=\"text\" id=\"codBE\" name=\"codigosBE\" class=\"form-control\" 
                                        placeholder=\"Introduzca los códigos de los ejemplares en buen estado\" ></textarea>
                                </div>
                    </div>
                 </div>
             </div>
             <div class=\"col-md-3\">
                    <div class=\"panel panel-success\">
                        <div class=\"panel-heading\">
                        Devolución de un lote
                        </div>
                        <div class=\"panel-body PaddingsCajita\">
                                    <div class=\"form-group\">
                                             <label>Numero de ejemplares en mal estado</label>
                                             <textarea rows=\"15\" type=\"text\" id=\"codME\" name=\"codigosME\" class=\"form-control\" 
                                            placeholder=\"Introduzca los códigos de los ejemplares en mal estado\" ></textarea>
                                    </div>
                        </div>
                    </div>
             </div>
             <div class=\"col-md-3\">
                    <div class=\"panel panel-success\">
                    <div class=\"panel-heading\">
                    Devolución de un lote
                    </div>
                    <div class=\"panel-body PaddingsCajita\">
                                <div class=\"form-group\">
                                         <label>Numero de ejemplares en estado regular</label>
                                         <textarea rows=\"15\" type=\"text\" id=\"codRE\" name=\"codigosRE\" class=\"form-control\" 
                                        placeholder=\"Introduzca los códigos de los ejemplares en estado regular\" ></textarea>
                                </div>
                    </div>
                 </div>
             </div>
        </div>
        </form>
        ";
        // line 83
        if (((isset($context["active"]) ? $context["active"] : null) == 1)) {
            // line 84
            echo "        <div class=\"row\">
            <div class=\"Cajita\">
                <table class=\"table table-hover MyTable\" >
                        <thead>
                            <th>Id del ejemplar</th>
                            <th>Estado</th>
                            <th>Alumno</th>
                            <th>Libro</th>
                        </thead>
                        <tbody>
                            ";
            // line 94
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["mostrar"]) ? $context["mostrar"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ejem"]) {
                // line 95
                echo "                                ";
                if ((($this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "estado") >= 1) && ($this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "estado") <= 3))) {
                    // line 96
                    echo "                                <tr>
                                    <td>";
                    // line 97
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "id"), "html", null, true);
                    echo "</td>
                                    <td>
                                    ";
                    // line 99
                    if (($this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "estado") == 1)) {
                        // line 100
                        echo "                                        Malo
                                        ";
                    } elseif (($this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "estado") == 2)) {
                        // line 102
                        echo "                                        Regular
                                        ";
                    } elseif (($this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "estado") == 3)) {
                        // line 104
                        echo "                                        Bueno
                                    ";
                    }
                    // line 105
                    echo "</td>
                                    <td>";
                    // line 106
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "apellidos"), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 107
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ejem"]) ? $context["ejem"] : null), "titulo"), "html", null, true);
                    echo "</td>
                                </tr>
                                ";
                }
                // line 110
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ejem'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "                        </tbody>
                    </table>
            </div>
         </div>
        ";
        }
        // line 116
        echo "        <script type=\"text/JavaScript\">
            window.onload = HabilitaBoton(
            new Array(
                document.getElementById(\"idAl\").value, document.getElementById(\"idAl\").value,
                document.getElementById(\"idAl\").value, document.getElementById(\"idAl\").value,
                document.getElementById(\"idAl\").value),
                    new Array('noDev','dev', 'codBE', 'codME', 'codRE'));
        </script>
";
    }

    public function getTemplateName()
    {
        return "devolucionlote.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 116,  199 => 111,  193 => 110,  187 => 107,  183 => 106,  180 => 105,  176 => 104,  172 => 102,  168 => 100,  166 => 99,  161 => 97,  158 => 96,  155 => 95,  151 => 94,  139 => 84,  137 => 83,  79 => 28,  69 => 21,  56 => 10,  46 => 7,  42 => 6,  38 => 5,  34 => 4,  28 => 2,);
    }
}
