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

/* AddPost.html */
class __TwigTemplate_6e349c0b3e75d9a4d5b9d94ad88274ec92c13fada1baf42758771c55fe6211fc extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'css' => [$this, 'block_css'],
            'main' => [$this, 'block_main'],
            'javaScriptEnd' => [$this, 'block_javaScriptEnd'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate(($context["extends"] ?? null), "AddPost.html", 1);
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_css($context, array $blocks = [])
    {
        // line 3
        echo "<style type=\"text/css\">
.MUxGbd {
    padding-top: 1px;
    margin-bottom: -1px;
\tfont-family: Roboto,HelveticaNeue,Arial,sans-serif;
\tfont-size: 14px;
    line-height: 20px;
}
.nCkwMd {
    box-sizing: border-box;
    padding-right: 8px;
}
.n9USt {
    flex: 1;
    max-width: 50%;
}
#google-description {
    max-height: 999999px;
    display: block;
}
.uUPGi {
    font-size: 14px;
    line-height: 20px;
}
.Hk2yDb, .Hk2yDb span {
    width: 65px;
    height: 15px;
    display: inline-block;
    background: repeat-x 0 0;
    background-size: 13px 15px;
    font-size: 0;
    line-height: 0;
}
.aLF0Z {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.Hk2yDb.KsR1A {
    background-image: url(\"data:image/svg+xml,\\00003csvg width='13px' height='15px' xmlns='http://www.w3.org/2000/svg'>\\00003cpath fill='%23d1d1d1' d='m0,7.6l4.7,0,1.5-4.5,1.5,4.5,4.7,0-3.8,2.8,1.5,4.5-3.8-2.8-3.8,2.8,1.5-4.5'/>\\00003c/svg>\");
}
.Hk2yDb.KsR1A span {
    background-image: url(\"data:image/svg+xml,\\00003csvg width='13px' height='15px' xmlns='http://www.w3.org/2000/svg'>\\00003cpath fill='%23fabb05' d='m0,7.6l4.7,0,1.5-4.5,1.5,4.5,4.7,0-3.8,2.8,1.5,4.5-3.8-2.8-3.8,2.8,1.5-4.5'/>\\00003c/svg>\");
}
.WZ8Tjf {
    color: #70757A;
}



/* Google snippet nahlady */
.google-title{
  color: #12C;   font-family: arial, sans-serif;   font-size: 20px;  font-weight: 400;   height: auto;  line-height: 19px;
  list-style-image: none;   list-style-position: outside;    list-style-type: none;    margin-bottom: 0px;   margin-left: 0px;
  margin-right: 0px;  margin-top:0px;  padding:0px;   text-align: left;  text-decoration: none;  visibility: visible;
  width: auto;
}

.google-url{
  color: #093;  display: block;   font-family: arial, sans-serif;    font-size: 14px;  font-style: normal;
  font-weight: normal;   height: auto;  line-height: 16px;   list-style-image: none;   list-style-position: outside;
  list-style-type: none;    margin:0px;   padding:0px;  text-align: left;   visibility: visible;   max-width: 600px;
}

.google-url a {
  color: #12C; display: inline; font-family: arial, sans-serif; font-size: 14px; font-style: normal; font-weight: normal; height: auto; line-height: 15px; list-style-image: none; list-style-position: outside;
  list-style-type: none; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; min-height: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;
  padding-top: 0px; text-align: left; text-decoration: none; width: auto; 
}
 
.google-grey{
  color: #666;  display: block;   font-family: arial, sans-serif;  font-size: 13px;  font-weight: normal;   height: 15px;
  line-height: 15px;  list-style-image: none;   list-style-position: outside;  list-style-type: none;   margin-bottom: 1px;
  margin-left: 0px;   margin-right: 0px;  margin-top: 0px;    overflow-y: visible;     padding-bottom: 0px;   padding-left: 0px;
  padding-right: 0px;        text-align: left;  visibility: visible;     max-width: 512px;  
  padding-top: 0px;
}


.google-desc{
  color: #222;  font-family: arial, sans-serif;   font-size: 13px;  font-weight: normal;  height: auto;   line-height: 18.2px;
  list-style-image: none;  list-style-position: outside;   list-style-type: none;   margin-bottom: 0px;  margin-left: 0px;
  margin-right: 0px;   margin-top: 0px;   padding-bottom: 0px;  padding-left: 0px;  padding-right: 0px;   padding-top: 0px;
  text-align: left;  visibility: visible;   max-width: 600px;
}


#google-nahled{
  border: 1px solid #dddddd; 
  max-width:600px;
  padding: 15px;
  margin: 0 0 10px 0;
}
    #aux {
        margin-top: 2em; 
    }
    #result{
        min-height: 10em; 
    }
    .ql-toolbar {
        margin-top: 1em; 
    }

    .ql-editor {
        min-height: 10em;  
    }

\t/* Estos son los estilos para nuestros campos inválidos */
\tinput:invalid{
\tborder-color: #900;
\tbackground-color: #FDD;
\t}

\tinput:focus:invalid {
\toutline: none;
\t}

\t/* Estos son los estilos para nuestros mensajes de error */
\t.error {
\twidth  : 100%;
\tpadding: 0;
\t
\tfont-size: 80%;
\tcolor: white;
\tbackground-color: #900;
\tborder-radius: 0 0 5px 5px;
\t
\t-moz-box-sizing: border-box;
\tbox-sizing: border-box;
\t}

\t.error.active {
\tpadding: 0.3em;
\t}
\t.emoji {
\t\tcursor: pointer;
\t}

</style>
";
    }

    // line 143
    public function block_main($context, array $blocks = [])
    {
        // line 144
        echo "<div class=\"card-body\" id=\"inputs\">
\t<section id=\"comonData\">
\t\t<section class=\"form-group\">
\t\t\t<label for=\"title\">Title</label>
\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"title\"  name=\"title\" placeholder=\"Samsung Galaxy s10\" onkeyup=\"generateLink(this)\">
\t\t\t<div class=\"invalid-feedback\">Example invalid feedback text</div>
\t\t</section>
\t\t<section class=\"form-group\">
\t\t\t<label for=\"metaTitle\">Meta title (<span style=\"font-size: 8pt;\">pixels:<span id=\"title-length\">0</span>, characters:<span id=\"title-string-length\">0</span></span>)</label>
\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"metaTitle\"  name=\"metaTitle\" maxlength=\"80\" placeholder=\"Samsung Galaxy s10\">
\t\t\t<div class=\"invalid-feedback\">Example invalid feedback text</div>
\t\t</section>
\t\t<div class=\"progress mb-2\">
\t\t\t<div class=\"progress-bar\" role=\"progressbar\" id=\"progressMetaTitle\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"80\"></div>
\t\t</div>
\t\t<section class=\"form-group\">
\t\t\t<label for=\"link\">Link</label>
\t\t\t<input required=\"\" type=\"url\" class=\"form-control\" id=\"link\"  name=\"link\"  placeholder=\"samsung-galaxy-s10\">
\t\t</section>
\t\t<section class=\"form-group mb-1\">
\t\t\t<label for=\"metaDescription\">Meta description (<span style=\"font-size: 8pt;\">pixels:<span id=\"desc-length\">0</span>, characters:<span id=\"desc-string-length\">0</span></span>)</label>
\t\t\t<textarea required=\"\" class=\"form-control\" id=\"metaDescription\" rows=\"2\" maxlength=\"210\"></textarea>
\t\t</section>
\t\t<div class=\"progress mb-2\">
\t\t\t<div class=\"progress-bar\" role=\"progressbar\" id=\"progressMetaDescription\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"210\"></div>
\t\t</div>
\t\t<section id=\"product\" class=\"form-group \">
\t\t\t<section class=\"form-check\">
\t\t\t\t<input type=\"checkbox\" class=\"form-check-input\" id=\"isAProduct\" onchange=\"isAProductFunc()\" >
\t\t\t\t<label class=\"form-check-label\" for=\"isAProduct\">Es un producto</label>
\t\t\t</section>
\t\t\t<section id=\"productDetails\" class=\"card card-body\" style=\"display: none;\">
\t\t\t\t<section class=\"form-group row\">
\t\t\t\t\t<label for=\"productName\" class=\"col-sm-2 col-form-label\">Nombre del producto: </label>
\t\t\t\t\t<input type=\"text\" class=\"form-control col-sm-10\" id=\"productName\">
\t\t\t\t</section>
\t\t\t\t<section id=\"coments\" class=\"card\">
\t\t\t\t\t<article class=\"card card-body\">
\t\t\t\t\t\t";
        // line 182
        $this->loadTemplate((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["includes"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["coment"] ?? null) : null), "AddPost.html", 182)->display(twig_to_array(["changeValoration" => true]));
        // line 183
        echo "\t\t\t\t\t</article>
\t\t\t\t</section>
\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-success car\" onclick=\"addComent()\" style=\"width: 100%;\">Añadir Comentario</button>
\t\t\t\t</div>
\t\t\t</section>
\t\t</section>
\t\t<section id=\"googlePreview\" class=\"card\">
\t\t\t<div class=\"card-body\">
\t\t\t\t<label>Google Preview:</label>
\t\t\t\t<div id=\"google-nahled\" style=\"background-color:#fff;\">                       
\t\t\t\t\t<div style=\"display:block;\" id=\"google-title\" class=\"google-title\">El título en Google tiene un límite de 580px en ordenadores.</div>   
\t\t\t\t\t<div class=\"n9USt nCkwMd\" id=\"google-valoration\" style=\"display: none;\">
\t\t\t\t\t\t<div class=\"MUxGbd lyLwlc aLF0Z\">Valoración</div><div style=\"margin-top:4px\"></div>
\t\t\t\t\t\t<div class=\"qB1bVd MUxGbd wuQ4Ob WZ8Tjf aLF0Z\"><span class=\"tP9Zud\">
\t\t\t\t\t\t\t<span id=\"ratingValue\" aria-hidden=\"true\">0</span> 
\t\t\t\t\t\t\t<div class=\"Hk2yDb KsR1A\" aria-label=\"Valoración de 0 de un máximo de 5\" role=\"img\">
\t\t\t\t\t\t\t\t<span id=\"ratingStar\" style=\"width:0px\"></span></div>
\t\t\t\t\t\t\t\t<span id=\"ratingCount\">(0)</span> 
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>             
\t\t\t\t\t<cite style=\"display:block;\" id=\"google-url\" class=\"google-url\">www.domain.com/page    
\t\t\t\t\t</cite>   
\t\t\t\t\t<div id=\"google-desc\" class=\"google-desc\">La meta descripción se corta a los ~920 pixels en ordenadores y a los  ~750px en móviles. Bing y Yahoo la cortan a los ~980px.</div>
\t\t\t\t</div>
\t\t\t\t<section id=\"googlePreviewInfo\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<span id=\"title-status\"></span>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<span id=\"desc-status\"></span>
\t\t\t\t\t</div>
\t\t\t\t</section>
\t\t\t</div>
\t\t\t<canvas id=\"canvas\" width=\"0\" height=\"0\" style=\"border:1px solid #d3d3d3;\">   Note: The canvas tag is not supported in Internet Explorer 8 and earlier versions.
\t\t</section>
\t\t</canvas>
\t\t<section class=\"form-row\" id=\"imagePost\">
\t\t\t<section class=\"form-group col-md-4\">
\t\t\t\t<label for=\"imagePostImage\">Añade una Imagen de portada:</label>
\t\t\t\t<input type=\"file\" class=\"form-control\" name=\"imagePostImage\" id=\"imagePostImage\">
\t\t\t</section>
\t\t\t<section class=\"form-group col-md-4 \">
\t\t\t\t<label for=\"imagePostName\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Es el nombre con el que se guardará el archivo en el servidor, en lugar del nombre original del archivo\">Nombre para guardar</label>
\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"imagePostName\" id=\"imagePostName\">
\t\t\t</section>
\t\t\t<section class=\"form-group col-md-4\">
\t\t\t\t<label for=\"imagePostAlt\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Cuando la imagen no se pueda mostrar, se mostrará este texto.\">Texto Alternativo</label>
\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"imagePostAlt\" id=\"imagePostAlt\">
\t\t\t</section>
\t\t</section>
\t\t<section class=\"form-group\">
\t\t\t<label for=\"description\">Description</label>
\t\t\t<textarea required=\"\" class=\"form-control\" id=\"description\" rows=\"3\"></textarea>
\t\t</section>
\t\t<label for=\"keyword\">KeyWords</label>
\t\t<section class=\"d-flex flex-wrap\" id=\"keywords\">
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"comprar\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" style=\"display: none;\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"En oferta\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"chollo\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"ganga\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t\t</article>
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"rebajado\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t\t<article class=\"col-md-2 form-row\">
\t\t\t\t<section class=\"form-group col-10 p-0\">
\t\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control keywords\" name=\"keyword\" value=\"mejor precio\">
\t\t\t\t</section>
\t\t\t\t<div class=\"form-group col-2 p-0\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeBottom\" onclick=\"removeKeyword(this)\">&#8855;</button>
\t\t\t\t</div>
\t\t\t</article>
\t\t</section>
\t\t<div class=\"form-group row\">
\t\t\t<div class=\"col-md-2\">
\t\t\t\t<button type=\"button\" class=\"btn btn-success\" onclick=\"addKeyword()\">Add keyword</button>
\t\t\t</div>
\t\t</div>
\t</section>
\t<section id=\"products\" class=\"card\">
\t\t<label class=\"card-body\">Productos</label>
\t\t<section class=\"form-group row\">
\t\t\t<label class=\"col-sm-1 col-form-label\" for=\"comentValoration\">Tipo de productos</label>
\t\t\t\t<select class=\"custom-select col-sm-11\" id=\"productsKind\">
\t\t\t\t<option value=\"none\" selected>Ninguno</option>
\t\t\t\t<option value=\"smartphone\">SmartPhone</option>
\t\t\t</select>
\t\t</section>
\t\t<article class=\"product card card-body\">
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"title\">Título</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"title\"  name=\"title\" placeholder=\"El titulo se intentará rellenar solo: Samsung Galaxy s10 64gb 4gb de ram\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"marca\">Marca</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"marca\"  name=\"marca\" placeholder=\"Samsung\" >
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"modelo\">Modelo</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"modelo\"  name=\"modelo\" placeholder=\"Galaxy s10\" >
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"procesador\">Procesador</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"procesador\"  name=\"procesador\" placeholder=\"Snapdragron 810\" >
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"memoriaRam\">Memoria RAM</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"memoriaRam\"  name=\"memoriaRam\" placeholder=\"3GB\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"almacenamiento\">Alamacenamiento</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"almacenamiento\"  name=\"almacenamiento\" placeholder=\"3GB\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"pantalla\">Pantalla</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"pantalla\"  name=\"pantalla\" placeholder=\"AMOLED 6,47 pulgadas con notch\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"dimensiones\">Diemsiones</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"dimensiones\"  name=\"dimensiones\" placeholder=\"AMOLED 6,47 pulgadas con notch\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"bateria\">Batería</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"bateria\"  name=\"bateria\" placeholder=\"3.800mA\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"sistemaOperativo\">SistemaOperativo</label>
\t\t\t\t<input required=\"\" type=\"text\" class=\"form-control\" id=\"sistemaOperativo\"  name=\"sistemaOperativo\" placeholder=\"Android 9\">
\t\t\t</section>
\t\t\t<section class=\"form-group\">
\t\t\t\t<label for=\"amazonLink\">Amazon</label>
\t\t\t\t<input required=\"\" type=\"url\" class=\"form-control\" id=\"amazonLink\"  name=\"amazonLink\">
\t\t\t</section>
\t\t\t<div class=\"form-group\">
\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" id=\"removeProduct\" onclick=\"removeProductt(this)\" style=\"display: none;\">Borrar variante</button>
\t\t\t</div>
\t\t</article>
\t\t<div id=\"buttons\" class=\"card-body row\">
\t\t\t<div class=\"col-md-2\">
\t\t\t\t<button type=\"button\" class=\"btn btn-success\" onclick=\"addProduct()\">Añadir variante</button>
\t\t\t</div>
\t\t</div>
\t</section>
\t<button class=\"btn btn-primary\" onclick=\"send()\">Send</button>
</div>
";
        // line 363
        $this->loadTemplate((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["includes"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["emojis"] ?? null) : null), "AddPost.html", 363)->display($context);
        // line 364
        echo "
";
    }

    // line 367
    public function block_javaScriptEnd($context, array $blocks = [])
    {
        // line 368
        echo "<script>
\tconst _myDomain = \"";
        // line 369
        echo twig_escape_filter($this->env, ($context["myDomain"] ?? null), "html", null, true);
        echo "\";
\tconst _UploadImageUrl = '";
        // line 370
        echo twig_escape_filter($this->env, ($context["uploadImageURL"] ?? null), "html", null, true);
        echo "';
\tconst _SendPostURL = \"";
        // line 371
        echo twig_escape_filter($this->env, ($context["postURL"] ?? null), "html", null, true);
        echo "\";
\tconst _coment = `<article class=\"card card-body\">
\t\t\t\t\t\t";
        // line 373
        $this->loadTemplate((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["includes"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["coment"] ?? null) : null), "AddPost.html", 373)->display(twig_to_array(["changeValoration" => true]));
        // line 374
        echo "\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-danger\" onclick=\"removeComent(this)\">Eliminar Comentario</button>
\t\t\t\t\t</article>`;
</script>
  <script src=\"https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js\" referrerpolicy=\"origin\"></script>
  <script src=\"public/js/description.js\" referrerpolicy=\"origin\"></script>
  <script src=\"public/js/meta.js\" referrerpolicy=\"origin\"></script>
<script>

function removeProductt(self) {
\tproducts.removeChild(self.parentNode.parentNode);
}
function addProduct() {
\tlet products = document.getElementById(\"products\");
\tlet newProduct = products.children[products.children.length-2].cloneNode(true);
\tnewProduct.getElementsByTagName(\"button\")[0].removeAttribute(\"style\");
\tproducts.insertBefore(newProduct, products.children[products.children.length-1]);
}



function stringIsCorrect(input) {
\treturn (input && input !== null && input !== \"\" && input.length > 0) ? true : false;
}

function getValue(nodeIn) {
\tlet id = null;
\tlet value = null;
\tlet error = false;
\tconst node = nodeIn;
\tconst aux = getElementWithValue(nodeIn);
\tlet input;
\tif(aux.length > 1){
\t\tconsole.error(nodeIn ,\"There are more than 1 input element.\")
\t}else if(aux.length == 0){
\t\tconsole.error(nodeIn ,\"There isn't an input element.\")
\t}else{
\t\tinput = aux[0];
\t\tid = input.id ? input.id : input.name;
\t\tswitch (aux[0].tagName) {
\t\t\tcase \"SELECT\":
\t\t\t\tvalue = input.options[input.selectedIndex].value;
\t\t\t\tbreak;
\t\t\tcase \"INPUT\":
\t\t\tcase \"TEXTAREA\":
\t\t\t\tif(input.hasAttribute(\"type\") && input.getAttribute(\"type\") == \"checkbox\"){
\t\t\t\t\tvalue = input.checked;
\t\t\t\t}else if(stringIsCorrect(input.value) && input.checkValidity()){
\t\t\t\t\tvalue = input.value;
\t\t\t\t}else{
\t\t\t\t\t//console.error(input,\"Value not valid\");
\t\t\t\t\terror = true;
\t\t\t\t}
\t\t\t\tbreak;
\t\t
\t\t\tdefault:
\t\t\t\tbreak;
\t\t}
\t}
\treturn [id, value, error];

}

function getArticleValues(node) {
\treturn getSectionsValues(node);
}

let elementsToArray = [\"ARTICLE\", ];
let elementsToGetValue = [\"INPUT\", \"TEXTAREA\"];

function getElementWithValue(node) {
\t
\treturn node.querySelectorAll(\"input, textarea, select\");

}

function getChildrenValues(node) {
\tlet result = [];
\tlet error = false;
\tlet nodeKind; 
\t
\t
\tif(node.children.length > 0){
\t\t// We detect the nodes types
\t\t 
\t\tlet i = 0; 
\t\tdo {
\t\t\tnodeKind = node.children[i].tagName;\t\t\t
\t\t} while ((nodeKind != \"ARTICLE\" && nodeKind != \"SECTION\") && ++i < node.children.length);

\t\tswitch (nodeKind) {
\t\t\tcase \"ARTICLE\":
\t\t\t\tresult = [];
\t\t\t\tfor (let index = 0; index < node.children.length; index++) {
\t\t\t\t\tconst element = node.children[index];
\t\t\t\t\tif(element.tagName === nodeKind){
\t\t\t\t\t\tlet aux = getChildrenValues(element);
\t\t\t\t\t\tresult.push(aux[0]);
\t\t\t\t\t\terror =  error || aux[1];
\t\t\t\t\t}else{
\t\t\t\t\t\tlet inputs = getElementWithValue(element);
\t\t\t\t\t\tif(inputs.length > 0){
\t\t\t\t\t\t\tconsole.err(inputs[0], \"Error: this node is not porpely formated. You have values outside of an article tag. Put all articles tag inside an section tag with an id.\");
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t}
\t\t\t\tbreak;
\t\t\tcase \"SECTION\":
\t\t\t\tresult = new Object();
\t\t\t\tfor (let index = 0; index < node.children.length; index++) {
\t\t\t\t\tconst element = node.children[index];
\t\t\t\t\tif(element.tagName === nodeKind){
\t\t\t\t\t\tlet inputs = getElementWithValue(element);
\t\t\t\t\t\tif (inputs.length == 1) {
\t\t\t\t\t\t\tlet aux = getValue(element);
\t\t\t\t\t\t\terror = error || aux[2];
\t\t\t\t\t\t\tlet id = aux[0];
\t\t\t\t\t\t\tlet value = aux[1];
\t\t\t\t\t\t\tif(aux[0]){
\t\t\t\t\t\t\t\tresult[id] = value;
\t\t\t\t\t\t\t}else{
\t\t\t\t\t\t\t\tconsole.error(element, \"Can't found a value on this node\");
\t\t\t\t\t\t\t\terror = true;
\t\t\t\t\t\t\t}
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tlet id = element.id;
\t\t\t\t\t\t\tif(!id){
\t\t\t\t\t\t\t\tconsole.error(element, \"This element must have an id.\")
\t\t\t\t\t\t\t\terror = true; 
\t\t\t\t\t\t\t}else{
\t\t\t\t\t\t\t\tlet aux = getChildrenValues(element)
\t\t\t\t\t\t\t\tif(Array.isArray(aux[0])){
\t\t\t\t\t\t\t\t\tif(aux[0].length > 0){
\t\t\t\t\t\t\t\t\t\tresult[id] = aux[0];
\t\t\t\t\t\t\t\t\t\terror = error || aux[1];
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t}else{
\t\t\t\t\t\t\t\t\tresult[id] = new Object();
\t\t\t\t\t\t\t\t\tfor(var key in aux[0]) {
\t\t\t\t\t\t\t\t\t\tresult[id][key] = aux[0][key];
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t}
\t\t\t\t\t\t}
\t\t\t\t\t}else{
\t\t\t\t\t\tlet inputs = getElementWithValue(element);
\t\t\t\t\t\tif(inputs.length > 0){
\t\t\t\t\t\t\tconsole.error(element, \"Error: this node is not porpely formated. You have values outside of a section tag.\");
\t\t\t\t\t\t\terror = true;
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t}
\t\t\t\tbreak;
\t\t\tdefault:
\t\t\t\tlet inputs = getElementWithValue(node);
\t\t\t\tif(inputs.length > 0){
\t\t\t\t\tconsole.error(node, \"Error: this node is not porpely formated. \\nYou have values outside of a section or article tag. \\nOr there are an article or a section without values\");
\t\t\t\t\terror = true;
\t\t\t\t}
\t\t\t\tbreak;
\t\t}
\t}else{
\t\tconsole.error(node, \"Error: this node is empty.\");
\t\terror = true;
\t}
\tif(false)
\tfor (let index = 0; index < node.children.length && !error; index++) {
\t\tconst element = node.children[index];
\t\tif (element.tagName === \"ARTICLE\") {
\t\t\tlet aux = getArticleValues(element);
\t\t\tresult.push(aux[0]);
\t\t\terror =  error || aux[1];
\t\t}else{
\t\t\tlet aux = getValue(element);
\t\t\terror = error || aux[2];
\t\t\tif(aux[0]){
\t\t\t\t//result[aux[0]] = aux[1];
\t\t\t\tresult.push(aux[1]);
\t\t\t}else{
\t\t\t\t//console.error(element, \"Can't found a value on this node\");
\t\t\t\t//error = true;
\t\t\t}
\t\t}
\t}
\treturn [result, error];
}

function getSectionsValues(node) {
\tlet result = new Object();
\tlet error = false; 
\tfor (let index = 0; index < node.children.length; index++) {
\t\tconst element = node.children[index];
\t\t// Ignore nodes that aren't section, like Labels or buttons
\t\tif (element.tagName === \"SECTION\") {
\t\t\tlet id = element.id; 
\t\t\tif(!id){
\t\t\t\tlet aux = getValue(element);
\t\t\t\terror = error || aux[2];
\t\t\t\tlet id = aux[0];
\t\t\t\tlet value = aux[1];
\t\t\t\tif(aux[0]){
\t\t\t\t\tresult[id] = value;
\t\t\t\t}else{
\t\t\t\t\tconsole.error(element, \"Can't found a value on this node\");
\t\t\t\t\terror = true;
\t\t\t\t}
\t\t\t}else{
\t\t\t\tlet aux = getChildrenValues(element)
\t\t\t\tif(Array.isArray(aux[0])){
\t\t\t\t\tif(aux[0].length > 0){
\t\t\t\t\t\tresult[id] = aux[0];
\t\t\t\t\t\terror = error || aux[1];
\t\t\t\t\t}
\t\t\t\t}else if(aux[0].hasOwnProperty(\"aux\")){
\t\t\t\t\tresult[id] = aux[0].aux;
\t\t\t\t}else{
\t\t\t\t\tconsole.error(aux, \"aux\");

\t\t\t\t}
\t\t\t\t
\t\t\t}
\t\t}else{
\t\t\tlet inputs = getElementWithValue(element);
\t\t\tif(inputs.length == 1){
\t\t\t\tlet aux = getValue(element);
\t\t\t\terror = error || aux[2];
\t\t\t\tlet id = aux[0];
\t\t\t\tlet value = aux[1];
\t\t\t\tif(aux[0]){
\t\t\t\t\tresult[id] = value;
\t\t\t\t}else{
\t\t\t\t\tconsole.error(element, \"Can't found a value on this node\");
\t\t\t\t\terror = true;
\t\t\t\t}
\t\t\t}else if(inputs.length > 1){
\t\t\t\tconsole.error(\"Error: this node is not porpely formated. This node have more than one value.\", element);
\t\t\t}
\t\t}
\t}
\treturn [result, error];
}
function send() {
\t//let products = document.getElementById(\"products\");

\tlet [post, error] = getChildrenValues(document.getElementById(\"inputs\"));
\tlet keywords = [];

\tlet keywordsElements = document.getElementsByClassName(\"keywords\");
\tfor(let keyword of keywordsElements){
\t\tif(stringIsCorrect(keyword.value)){
\t\t\tkeywords.push(keyword.value)
\t\t}else{
\t\t\talert(\"Hay keywords vacías.\")
\t\t\treturn;
\t\t}
\t}

\t[aux, error] = getChildrenValues(document.getElementById(\"products\").parentNode);
\tpost.products = aux.products;
  
\t//if(!error){
\tif(true){
\t\tpost.comonData[\"html\"] = descriptionEditor.body.innerHTML;
\t\tfetch(_SendPostURL, {
\t\t\t\t  method: 'POST', // or 'PUT'
\t\t\t\t  body: JSON.stringify(post), // data can be `string` or {object}!
\t\t\t\t  headers:{
\t\t\t\t    'Content-Type': 'application/json'
\t\t\t\t  }
\t\t\t\t}).then(res => {
\t\t\t\t\tif(res.ok){
\t\t\t\t\t\tres.text().then(text => {
\t\t\t\t\t\t\tconsole.log(text); 
\t\t\t\t\t\t\tlet data = JSON.parse(text);
\t\t\t\t\t\t\tconsole.log(data); 

\t\t\t\t\t\t\t

\t\t\t\t\t\t}).catch(err => {
\t\t\t\t\t\t\tconsole.log(\"Error\",err);
\t\t\t\t\t\t\t
\t\t\t\t\t\t}); 
\t\t\t\t\t}
\t\t\t\t})
\t\t\t\t.catch(error => {
\t\t\t\t\tconsole.log(\"Error\",error);
\t\t\t\t})
\t\t\t\t.then(response => console.log('Success:', response));
\t\t}

\tconsole.log(post);

}


\t
\t
\t

</script>

";
    }

    public function getTemplateName()
    {
        return "AddPost.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  446 => 374,  444 => 373,  439 => 371,  435 => 370,  431 => 369,  428 => 368,  425 => 367,  420 => 364,  418 => 363,  236 => 183,  234 => 182,  194 => 144,  191 => 143,  48 => 3,  45 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AddPost.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\AddPost.html");
    }
}
