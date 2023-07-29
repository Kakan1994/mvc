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

/* game/doc.html.twig */
class __TwigTemplate_32b356bdb18e1d4de93effbf5f313054 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/doc.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/doc.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "game/doc.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Card Game";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "<div class=\"game-doc\">
    <h1>Documentation</h1>
    <div class=\"game-doc_flow\">
        <h2> Flow of the game </h2>
        <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/flow.png"), "html", null, true);
        echo "\" width=\"500\" alt=\"Flow of the game\">
    </div>
    <div class=\"game-doc_flow\">
        <h2> Pseudo code </h2>
        <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/code.png"), "html", null, true);
        echo "\" width=\"500\" alt=\"Pseudo code\">
    </div>
    <div class=\"game-doc_classes\">
        <h2> Classes </h2>
        <h3 class=\"class\"> Card-class </h3>
        <p>Represents a playing card. Purpose: To hold the suit and value of a card. </p>
        <h3 class=\"class\"> Deck-class </h3>
        <p>Represents a deck of cards. Purpose: To generate a standard deck of 52 playing cards, shuffle, and deal them.</p>
        <h3 class=\"class\"> Player-class </h3>
        <p>Represents a player in the game. Purpose: To hold the player's current hand and implement player actions (e.g., hit, stand).</p>
        <h3 class=\"class\"> Dealer-class </h3>
        <p>This could be a subclass of Player. Purpose: To implement dealer-specific actions (e.g., must hit until 17 or more).</p>
        <h3 class=\"class\"> Game-class </h3>
        <p>Represents the game itself. Purpose: To control the flow of the game, keep track of the deck and the players, and determine when the game is over and who has won.</p>
</div>


";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "game/doc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 14,  94 => 10,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Card Game{% endblock %}

{% block body %}
<div class=\"game-doc\">
    <h1>Documentation</h1>
    <div class=\"game-doc_flow\">
        <h2> Flow of the game </h2>
        <img src=\"{{ asset('images/flow.png') }}\" width=\"500\" alt=\"Flow of the game\">
    </div>
    <div class=\"game-doc_flow\">
        <h2> Pseudo code </h2>
        <img src=\"{{ asset('images/code.png') }}\" width=\"500\" alt=\"Pseudo code\">
    </div>
    <div class=\"game-doc_classes\">
        <h2> Classes </h2>
        <h3 class=\"class\"> Card-class </h3>
        <p>Represents a playing card. Purpose: To hold the suit and value of a card. </p>
        <h3 class=\"class\"> Deck-class </h3>
        <p>Represents a deck of cards. Purpose: To generate a standard deck of 52 playing cards, shuffle, and deal them.</p>
        <h3 class=\"class\"> Player-class </h3>
        <p>Represents a player in the game. Purpose: To hold the player's current hand and implement player actions (e.g., hit, stand).</p>
        <h3 class=\"class\"> Dealer-class </h3>
        <p>This could be a subclass of Player. Purpose: To implement dealer-specific actions (e.g., must hit until 17 or more).</p>
        <h3 class=\"class\"> Game-class </h3>
        <p>Represents the game itself. Purpose: To control the flow of the game, keep track of the deck and the players, and determine when the game is over and who has won.</p>
</div>


{% endblock %}
", "game/doc.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/game/doc.html.twig");
    }
}
