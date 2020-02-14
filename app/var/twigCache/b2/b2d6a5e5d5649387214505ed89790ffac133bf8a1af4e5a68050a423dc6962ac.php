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

/* Post.html */
class __TwigTemplate_52f9ebdfdcd56a700828366633e569e33b0bf2289d0e9394f35819d7e323e43d extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "Post.html", 1);
        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_main($context, array $blocks = [])
    {
        // line 3
        echo "<div class=\"card-body\">
<section id=\"post\" class=\"border-bottom pb-3\">
\t<section id=\"postTitle\">
        <h1>";
        // line 6
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</h1>
    </section>
    <section id=\"postDescription\">
        ";
        // line 9
        echo twig_escape_filter($this->env, ($context["description"] ?? null), "html", null, true);
        echo "
    </section>
    <section id=\"products\">
        ";
        // line 12
        $this->loadTemplate("includes/afiliateLink.html", "Post.html", 12)->display(twig_to_array(["href" => "https://www.google.es/", "text" => "hola"]));
        // line 13
        echo "    </section>
    <section id=\"opinions\">
        <ul class=\"product_comments row\">
            <li class=\"col-lg-12\" itemprop=\"review\" itemscope itemtype=\"https://schema.org/Review\">
                <meta itemprop=\"itemReviewed\" content=\"Hummingbird printed t-shirt\" />
                <div class=\"row comment\">
                    <div class=\"comment_header col-md-12\">
                        <div class=\"star_content clearfix\"  itemprop=\"reviewRating\" itemscope itemtype=\"https://schema.org/Rating\">
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <meta itemprop=\"worstRating\" content=\"1\" />
                            <meta itemprop=\"ratingValue\" content=\"5\" />
                            <meta itemprop=\"bestRating\" content=\"5\" />
                        </div>
         
                        <div itemprop=\"name\" class=\"title_block\">Lorem ipsum</div>
                    </div>
         
                    <div class=\"comment_author_infos col-md-12\">
                        <span>Por</span>
                        <span itemprop=\"author\" class=\"author\">John Doe</span>
                        <span>el</span>
                        <meta itemprop=\"datePublished\" content=\"2019-04-26\" />
                        <span>26/04/2019</span>
                    </div>    
                    <div class=\"comment_details col-md-12\">
                        <p itemprop=\"description\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
                    </div>
                </div>
            </li>
            <li class=\"col-lg-12\" itemprop=\"review\" itemscope itemtype=\"https://schema.org/Review\">
                <meta itemprop=\"itemReviewed\" content=\"Hummingbird printed t-shirt\" />
                <div class=\"row comment\">
                    <div class=\"comment_header col-md-12\">
                        <div class=\"star_content clearfix\" itemprop=\"reviewRating\" itemscope itemtype=\"https://schema.org/Rating\">
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star\"></div>
                            <div class=\"star\"></div>
                            <meta itemprop=\"worstRating\" content=\"1\" />
                            <meta itemprop=\"ratingValue\" content=\"3\" />
                            <meta itemprop=\"bestRating\" content=\"5\" />
                        </div>
         
                        <div itemprop=\"name\" class=\"title_block\">Lorem ipsum</div>
                    </div>
         
                    <div class=\"comment_author_infos col-md-12\">
                        <span>Por</span>
                        <span itemprop=\"author\" class=\"author\">Benny Hill</span>
                        <span>el</span>
                        <meta itemprop=\"datePublished\" content=\"2019-03-15\" />
                        <span>15/03/2019</span>
                    </div>    
                    <div class=\"comment_details col-md-12\">
                        <p itemprop=\"description\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
                    </div>
                </div>
            </li>
            <li class=\"col-lg-12\" itemprop=\"review\" itemscope itemtype=\"https://schema.org/Review\">
                <meta itemprop=\"itemReviewed\" content=\"Hummingbird printed t-shirt\" />
                <div class=\"row comment\">
                    <div class=\"comment_header col-md-12\">
                        <div class=\"star_content clearfix\"  itemprop=\"reviewRating\" itemscope itemtype=\"https://schema.org/Rating\">
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star star_on\"></div>
                            <div class=\"star\"></div>
                            <meta itemprop=\"worstRating\" content=\"1\" />
                            <meta itemprop=\"ratingValue\" content=\"4\" />
                            <meta itemprop=\"bestRating\" content=\"5\" />
                        </div>
         
                        <div itemprop=\"name\" class=\"title_block\">Lorem ipsum</div>
                    </div>
         
                    <div class=\"comment_author_infos col-md-12\">
                        <span>Por</span>
                        <span itemprop=\"author\" class=\"author\">Brenda Bullock</span>
                        <span>el</span>
                        <meta itemprop=\"datePublished\" content=\"2019-02-10\" />
                        <span>10/02/2019</span>
                    </div>    
                    <div class=\"comment_details col-md-12\">
                        <p itemprop=\"description\">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
                    </div>
                </div>
            </li>
        </ul>
    </section>
</section>
</div>
";
    }

    public function getTemplateName()
    {
        return "Post.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 13,  64 => 12,  58 => 9,  52 => 6,  47 => 3,  44 => 2,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Post.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\Post.html");
    }
}
