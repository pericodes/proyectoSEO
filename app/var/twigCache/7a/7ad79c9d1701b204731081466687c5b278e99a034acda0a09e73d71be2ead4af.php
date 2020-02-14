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

/* includes/emojis.html */
class __TwigTemplate_6f5167f4584155294027e7df9680a7b3419f135a540f8ea201ace18cb7dea159 extends \Twig\Template
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
        echo "<div class=\"float-right\">\t\t\t\t
\t<button type=\"button\" class=\"btn btn-warning float-right fixed-bottom m-5\" style=\"left: auto;\" id=\"emojuBottom\" data-toggle=\"modal\" data-target=\"#exampleModal\">Emojis</button>
</div>
<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\" role=\"document\">
\t  <div class=\"modal-content\">
\t\t<div class=\"modal-header\">
\t\t  <h5 class=\"modal-title\" id=\"exampleModalLabel\">Click to copy the emoji</h5>
\t\t  <button type=\"button\" class=\"close\" id=\"closeModal\"   data-dismiss=\"modal\" aria-label=\"Close\">
\t\t\t<span aria-hidden=\"true\">&times;</span>
\t\t  </button>
\t\t</div>
\t\t<div class=\"modal-body d-flex flex-wrap\" style=\"font-size: larger;\">
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">👉</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">👍</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🤙</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🤝</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🙌</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">👂</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">👀</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💣</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💨</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💥</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🙈</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🙊</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🏃</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🚀</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">⏳</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">⏰</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔥</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🌡️</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔊</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔔</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💻</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">📺</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">📷</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">📹</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💸</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">💲</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔗</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">✅</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">❓</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔴</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🔵</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🚩</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🛒</div>
\t\t  <div class=\"emoji\" onclick=\"copyEmoji(this)\">🗨️</div>
\t\t</div>
\t\t<div class=\"modal-footer\">
\t\t  <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
\t\t</div>
\t  </div>
\t</div>
  </div>

  <script>
    let lastFocus;
    let metaTitle = document.getElementById(\"metaTitle\");
    let metaDescription = document.getElementById(\"metaDescription\");
    metaTitle.addEventListener('focus', (event) => {
        lastFocus = metaTitle;   
    });
    metaDescription.addEventListener('focus', (event) => {
        lastFocus = metaDescription;   
    });
    function copyEmoji(self) {
        
        copyEmojiToClipboard(self);
        if(lastFocus){
            lastFocus.value += self.textContent;
            lastFocus.focus();
            setTimeout(function(){ lastFocus.focus(); }, 50);
            setTimeout(function(){ lastFocus.focus(); }, 100);
            setTimeout(function(){ lastFocus.focus(); }, 150);
            setTimeout(function(){ lastFocus.focus(); }, 200);
            setTimeout(function(){ lastFocus.focus(); }, 250);
            setTimeout(function(){ lastFocus.focus(); }, 300);
            setTimeout(function(){ lastFocus.focus(); }, 350);
            //setTimeout(function(){ lastFocus.focus(); }, 400);
            //setTimeout(function(){ lastFocus.focus(); }, 800);
        }
            
    }
    function copyEmojiToClipboard(self) {
        var range, selection, worked;

        if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(self);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();        
            range = document.createRange();
            range.selectNodeContents(self);
            selection.removeAllRanges();
            selection.addRange(range);
        }else{
            alert('unable to copy text');
        }

        try {
            if(document.execCommand('copy')){
                document.getElementById(\"closeModal\").click();
            }else{
                alert('unable to copy text');
            }
        }
        catch (err) {
            alert('unable to copy text');
        }
    }
  </script>

";
    }

    public function getTemplateName()
    {
        return "includes/emojis.html";
    }

    public function getDebugInfo()
    {
        return array (  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "includes/emojis.html", "C:\\Users\\pedro\\OneDrive\\Pedro Luis\\Documents\\webs\\comprarmovilnuevo.es\\app\\views\\html\\includes\\emojis.html");
    }
}
