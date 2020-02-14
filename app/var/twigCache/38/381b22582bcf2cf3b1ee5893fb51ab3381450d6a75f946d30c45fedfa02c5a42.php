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

/* base.html */
class __TwigTemplate_bfe6b205caaefe744dca4ae30517b3c455460ea1204861ed4abdc65a37f64699 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'bootstrap_css' => [$this, 'block_bootstrap_css'],
            'jquery' => [$this, 'block_jquery'],
            'bootstrap_js' => [$this, 'block_bootstrap_js'],
            'css_base' => [$this, 'block_css_base'],
            'fontawesome' => [$this, 'block_fontawesome'],
            'css' => [$this, 'block_css'],
            'javaScriptStart' => [$this, 'block_javaScriptStart'],
            'main' => [$this, 'block_main'],
            'javaScriptEnd' => [$this, 'block_javaScriptEnd'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<!-- metaTags -->
\t<meta charset=\"utf-8\"/>
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
\t";
        // line 7
        if (($context["meta"] ?? null)) {
            // line 8
            echo "\t\t";
            echo ($context["meta"] ?? null);
            echo "
\t";
        }
        // line 10
        echo "
\t";
        // line 11
        $this->displayBlock('bootstrap_css', $context, $blocks);
        // line 14
        echo "    ";
        $this->displayBlock('jquery', $context, $blocks);
        // line 17
        echo "    ";
        $this->displayBlock('bootstrap_js', $context, $blocks);
        // line 20
        echo "    ";
        $this->displayBlock('css_base', $context, $blocks);
        // line 23
        echo "    ";
        $this->displayBlock('fontawesome', $context, $blocks);
        // line 26
        $this->displayBlock('css', $context, $blocks);
        // line 27
        $this->displayBlock('javaScriptStart', $context, $blocks);
        // line 28
        echo "</head>

<body>
\t<header>
\t\t<div>
\t\t\t<h1>Generic Project</h1>
\t\t</div>
\t\t<section id=\"menu\" class=\"row d-flex justify-content-center bg-dark\">
\t\t\t<nav class=\"navbar navbar-expand-md bg-dark navbar-dark col-10\">
\t\t\t  <a class=\"navbar-brand\" href=\"./\">Home</a>
\t\t\t  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">
\t\t\t    <span class=\"navbar-toggler-icon\"></span>
\t\t\t  </button>
\t\t\t  <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">
\t\t\t    <ul class=\"navbar-nav\">
\t\t\t      <li class=\"nav-item\">
\t\t\t        <a class=\"nav-link\" href=\"#\">Delete my account</a>
\t\t\t      </li>
\t\t\t      <li class=\"nav-item\">
\t\t\t        <a class=\"nav-link\" href=\"#\">Link</a>
\t\t\t      </li>
\t\t\t      <li class=\"nav-item\">
\t\t\t        <a class=\"nav-link\" href=\"#\">Link</a>
\t\t\t      </li>    
\t\t\t    </ul>
\t\t\t  </div>  
\t\t\t</nav>
\t\t</section>
\t</header>
\t<div class=\"row d-flex justify-content-center\">
\t\t<main class=\"col-sm-10 card\">
\t\t\t";
        // line 59
        $this->displayBlock('main', $context, $blocks);
        // line 60
        echo "\t\t</main>
\t\t<!--<aside class=\"col-sm-3 card\">
\t\t\t<div class=\"card-body\">
\t\t\t\t<section id=\"generic-login\" class=\"border-bottom  pb-3\">
\t\t\t\t\t<form>
\t\t\t\t\t  <div class=\"form-group\">
\t\t\t\t\t    <label for=\"exampleInputEmail1\">Email address</label>
\t\t\t\t\t    <input type=\"email\" class=\"form-control\" id=\"exampleInputEmail1\" aria-describedby=\"emailHelp\" placeholder=\"Enter email\">
\t\t\t\t\t    <small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>
\t\t\t\t\t  </div>
\t\t\t\t\t  <div class=\"form-group\">
\t\t\t\t\t    <label for=\"exampleInputPassword1\">Password</label>
\t\t\t\t\t    <input type=\"password\" class=\"form-control\" id=\"exampleInputPassword1\" placeholder=\"Password\">
\t\t\t\t\t  </div>
\t\t\t\t\t  <div class=\"form-check\">
\t\t\t\t\t    <input type=\"checkbox\" class=\"form-check-input\" id=\"exampleCheck1\">
\t\t\t\t\t    <label class=\"form-check-label\" for=\"exampleCheck1\">Check me out</label>
\t\t\t\t\t  </div>
\t\t\t\t\t  <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
\t\t\t\t\t</form>
\t\t\t\t</section>

\t\t\t</div>
\t\t</aside>-->
\t</div>
\t";
        // line 85
        $this->displayBlock('javaScriptEnd', $context, $blocks);
        // line 86
        echo "</body>
</html>";
    }

    // line 11
    public function block_bootstrap_css($context, array $blocks = [])
    {
        // line 12
        echo "\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
\t";
    }

    // line 14
    public function block_jquery($context, array $blocks = [])
    {
        // line 15
        echo "  \t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
    ";
    }

    // line 17
    public function block_bootstrap_js($context, array $blocks = [])
    {
        // line 18
        echo "  \t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
    ";
    }

    // line 20
    public function block_css_base($context, array $blocks = [])
    {
        // line 21
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"public/css/base.css\"/>
    ";
    }

    // line 23
    public function block_fontawesome($context, array $blocks = [])
    {
        // line 24
        echo "    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    ";
    }

    // line 26
    public function block_css($context, array $blocks = [])
    {
    }

    // line 27
    public function block_javaScriptStart($context, array $blocks = [])
    {
    }

    // line 59
    public function block_main($context, array $blocks = [])
    {
    }

    // line 85
    public function block_javaScriptEnd($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 85,  200 => 59,  195 => 27,  190 => 26,  185 => 24,  182 => 23,  177 => 21,  174 => 20,  169 => 18,  166 => 17,  161 => 15,  158 => 14,  153 => 12,  150 => 11,  145 => 86,  143 => 85,  116 => 60,  114 => 59,  81 => 28,  79 => 27,  77 => 26,  74 => 23,  71 => 20,  68 => 17,  65 => 14,  63 => 11,  60 => 10,  54 => 8,  52 => 7,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\base.html");
    }
}
