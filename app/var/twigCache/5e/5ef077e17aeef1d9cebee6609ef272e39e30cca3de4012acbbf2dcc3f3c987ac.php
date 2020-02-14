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

/* includes/afiliateLink.html */
class __TwigTemplate_25ac69e429e2193eadbf601dea58b309268cd399efc0d4dd04866d1a3b8b1c3b extends \Twig\Template
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
        echo "<a href=\"";
        echo twig_escape_filter($this->env, ($context["href"] ?? null), "html", null, true);
        echo "\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">";
        echo twig_escape_filter($this->env, ($context["text"] ?? null), "html", null, true);
        echo "</a>";
    }

    public function getTemplateName()
    {
        return "includes/afiliateLink.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "includes/afiliateLink.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\includes\\afiliateLink.html");
    }
}
