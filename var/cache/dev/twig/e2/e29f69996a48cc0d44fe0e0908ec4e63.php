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

/* game/landing.html.twig */
class __TwigTemplate_886d5881a3b2406325098d839cf1bdc8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/landing.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/landing.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "game/landing.html.twig", 1);
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
        echo "<h1>Welcome to my Card Game!</h1>

<p>This is a simple implementation of the card game Black Jack </p>
<p> The goal of the game is to get as close to 21 as possible without going over 21 </p>
<p> The rules are simple: </p>
<ul>
    <li>Each player and the dealer is dealt 2 cards</li>
    <li>The player can choose to draw another card or to stop</li>
    <li>If the player has a higher score than the dealer or if the dealer goes over 21, he wins</li>
    <li>If the player has a lower score than the dealer or is over 21, he loses</li>
    <li>If the player and the dealer have the same score, the dealer wins</li>
    <li>The dealer always stops on 17 or higher and draws otherwise</li>
    <li>The cards 1 through 9 is worths its value</li>
    <li>The cards 10, Jack, Queen and King is worth 10</li>
    <li>The card Ace is worth 1 or 11, depending on which is best for the player</li>
</ul>

<a href=\"";
        // line 23
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_blackjack");
        echo "\">Continue game</a> <!-- Starts the game -->
<a href=\"";
        // line 24
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_clear");
        echo "\">New game</a> <!-- Link to the rules -->
<a href=\"";
        // line 25
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_doc");
        echo "\">Documentation</a> <!-- Link to the documentation -->

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "game/landing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 25,  111 => 24,  107 => 23,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Card Game{% endblock %}

{% block body %}
<h1>Welcome to my Card Game!</h1>

<p>This is a simple implementation of the card game Black Jack </p>
<p> The goal of the game is to get as close to 21 as possible without going over 21 </p>
<p> The rules are simple: </p>
<ul>
    <li>Each player and the dealer is dealt 2 cards</li>
    <li>The player can choose to draw another card or to stop</li>
    <li>If the player has a higher score than the dealer or if the dealer goes over 21, he wins</li>
    <li>If the player has a lower score than the dealer or is over 21, he loses</li>
    <li>If the player and the dealer have the same score, the dealer wins</li>
    <li>The dealer always stops on 17 or higher and draws otherwise</li>
    <li>The cards 1 through 9 is worths its value</li>
    <li>The cards 10, Jack, Queen and King is worth 10</li>
    <li>The card Ace is worth 1 or 11, depending on which is best for the player</li>
</ul>

<a href=\"{{ path('game_blackjack') }}\">Continue game</a> <!-- Starts the game -->
<a href=\"{{ path('game_clear') }}\">New game</a> <!-- Link to the rules -->
<a href=\"{{ path('game_doc') }}\">Documentation</a> <!-- Link to the documentation -->

{% endblock %}
", "game/landing.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/game/landing.html.twig");
    }
}
