<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* includes/coment.html */
class __TwigTemplate_2d1abc49e7500effcf8aae0b5bcf3f93f64aafefa3c1cbf627bd3f47fba21b42 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<section class=\"form-group row\">
    <label class=\"col-sm-1 col-form-label\" for=\"comentName\">Nombre </label>
    <input required=\"\" type=\"text\" class=\"form-control col-sm-11\" id=\"comentName\"  name=\"comentName\">
</section>
<section class=\"form-group row\">
    <label class=\"col-sm-1 col-form-label\" for=\"comentTitle\">Título</label>
    <input required=\"\" type=\"text\" class=\"form-control col-sm-11\" id=\"ComentTitle\"  name=\"ComentTitle\">
</section>
<section class=\"form-group row\">
    <label class=\"col-sm-1 col-form-label\" for=\"comentComent\">Comentario</label>
    <textarea required=\"\" class=\"form-control col-sm-11\" id=\"comentComent\"  name=\"comentComent\" rows=\"3\"></textarea>
</section>
<section class=\"form-group row\">
    <label class=\"col-sm-1 col-form-label\" for=\"comentValoration\">Valoración</label>
    ";
        // line 15
        if (($context["changeValoration"] ?? null)) {
            // line 16
            echo "        <select class=\"custom-select col-sm-11 comentValoration\" id=\"comentValoration\" onchange=\"changeValoration()\">
    ";
        } else {
            // line 18
            echo "        <select class=\"custom-select col-sm-11\" id=\"comentValoration\">
    ";
        }
        // line 20
        echo "        <option value=\"0\">0</option>
        <option value=\"1\">1</option>
        <option value=\"2\">2</option>
        <option value=\"3\">3</option>
        <option value=\"4\">4</option>
        <option value=\"5\">5</option>
    </select>
</section>";
    }

    public function getTemplateName()
    {
        return "includes/coment.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 20,  57 => 18,  53 => 16,  51 => 15,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "includes/coment.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\includes\\coment.html");
    }
}
