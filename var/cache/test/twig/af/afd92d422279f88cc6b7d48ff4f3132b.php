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

/* card/index.html.twig */
class __TwigTemplate_7fefb5628a992e9da3f104d83537c06d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "card/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "card/index.html.twig", 1);
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

        echo "Card App";
        
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
        echo "<h1>Card App</h1>
<p>
    In this project, we have four main classes that represent a deck of cards and its components: Card, JokerCard, CardHand, and DeckOfCards.
    <br><br>
    1. Card: This is the base class for all card types. It holds information about the suit and value of a card. It also has a method to convert the card to a string representation.
    <br><br>
    2. JokerCard: This class is a specialized type of Card that represents a Joker card. It inherits from the Card class and overrides the string representation method to display 'Joker' instead of the suit and value.
    <br><br>
    3. CardHand: This class represents a collection of cards, typically held by a player. It contains an array of Card objects and provides methods to add cards to the hand and retrieve the cards in the hand.
    <br><br>
    4. DeckOfCards: This class represents a standard deck of cards. It holds an array of Card objects, including all suits and values. It also provides methods to shuffle the deck, draw cards from the deck, and get the remaining cards in the deck.
    <br><br>
    Below is a UML class diagram illustrating the relationships between these classes:
</p>
<img src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/Cards.png"), "html", null, true);
        echo "\" alt=\"UML-diagram\" style=\"max-width: 100%;\">

<ul>
    <li><a href=\"";
        // line 23
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("card_deck");
        echo "\">Display sorted deck of cards</a></li>
    <li><a href=\"";
        // line 24
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("card_deck_shuffle");
        echo "\">Shuffle and display deck of cards</a></li>
    <li><a href=\"";
        // line 25
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("card_deck_draw", ["count" => 1]);
        echo "\">Draw a card from the deck</a></li>
    <li><a href=\"";
        // line 26
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("card_draw_many");
        echo "\">Draw multiple cards from the deck</a></li>
</ul>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "card/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 26,  118 => 25,  114 => 24,  110 => 23,  104 => 20,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Card App{% endblock %}

{% block body %}
<h1>Card App</h1>
<p>
    In this project, we have four main classes that represent a deck of cards and its components: Card, JokerCard, CardHand, and DeckOfCards.
    <br><br>
    1. Card: This is the base class for all card types. It holds information about the suit and value of a card. It also has a method to convert the card to a string representation.
    <br><br>
    2. JokerCard: This class is a specialized type of Card that represents a Joker card. It inherits from the Card class and overrides the string representation method to display 'Joker' instead of the suit and value.
    <br><br>
    3. CardHand: This class represents a collection of cards, typically held by a player. It contains an array of Card objects and provides methods to add cards to the hand and retrieve the cards in the hand.
    <br><br>
    4. DeckOfCards: This class represents a standard deck of cards. It holds an array of Card objects, including all suits and values. It also provides methods to shuffle the deck, draw cards from the deck, and get the remaining cards in the deck.
    <br><br>
    Below is a UML class diagram illustrating the relationships between these classes:
</p>
<img src=\"{{ asset('images/Cards.png') }}\" alt=\"UML-diagram\" style=\"max-width: 100%;\">

<ul>
    <li><a href=\"{{ path('card_deck') }}\">Display sorted deck of cards</a></li>
    <li><a href=\"{{ path('card_deck_shuffle') }}\">Shuffle and display deck of cards</a></li>
    <li><a href=\"{{ path('card_deck_draw', {'count': 1}) }}\">Draw a card from the deck</a></li>
    <li><a href=\"{{ path('card_draw_many') }}\">Draw multiple cards from the deck</a></li>
</ul>

{% endblock %}
", "card/index.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/card/index.html.twig");
    }
}
