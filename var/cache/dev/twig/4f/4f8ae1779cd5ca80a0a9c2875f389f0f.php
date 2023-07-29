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

/* game/game.html.twig */
class __TwigTemplate_6413f2a089c0dc4d093eeff466c4933c extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/game.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "game/game.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "game/game.html.twig", 1);
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
        echo "<div class=\"game-container\">
<h1>Blackjack</h1>
<div class=\"last-round\">
<h2>Last round winner: ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 9, $this->source); })()), "winner", [], "any", false, false, false, 9), "html", null, true);
        echo "</h2>
<h2>Player score last round: ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 10, $this->source); })()), "getLastPlayerScore", [], "any", false, false, false, 10), "html", null, true);
        echo "</h2>
<h2>Dealer score last round: ";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 11, $this->source); })()), "getLastDealerScore", [], "any", false, false, false, 11), "html", null, true);
        echo "</h2>
</div>
<h2>Cards left in deck: ";
        // line 13
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 13, $this->source); })()), "getDeck", [], "any", false, false, false, 13), "getCards", [], "any", false, false, false, 13)), "html", null, true);
        echo "</h2>
<div class=\"player-info\">
<h2>Player: ";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 15, $this->source); })()), "getPlayerScore", [], "any", false, false, false, 15), "html", null, true);
        echo "</h2>
<!-- Display player cards -->
<div class=\"card-row\">
";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 18, $this->source); })()), "getPlayer", [], "any", false, false, false, 18), "getHand", [], "any", false, false, false, 18), "getCards", [], "any", false, false, false, 18));
        foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
            // line 19
            echo "    <span class=\"card";
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["card"], "getSuit", [], "method", false, false, false, 19), [0 => "♥", 1 => "♦"])) {
                echo " red";
            }
            echo "\">";
            echo twig_escape_filter($this->env, $context["card"], "html", null, true);
            echo "</span>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "</div>
</div>
<div class=\"dealer-info\">
<h2>Dealer: ";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 24, $this->source); })()), "getDealerScore", [], "any", false, false, false, 24), "html", null, true);
        echo "</h2>
<!-- Display dealer cards -->
<div class=\"card-row\">
";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 27, $this->source); })()), "getDealer", [], "any", false, false, false, 27), "getHand", [], "any", false, false, false, 27), "getCards", [], "any", false, false, false, 27));
        foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
            // line 28
            echo "    <span class=\"card";
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["card"], "getSuit", [], "method", false, false, false, 28), [0 => "♥", 1 => "♦"])) {
                echo " red";
            }
            echo "\">";
            echo twig_escape_filter($this->env, $context["card"], "html", null, true);
            echo "</span>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "</div>
</div>
<!-- Game control buttons -->

";
        // line 34
        if (twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 34, $this->source); })()), "isGameOver", [], "any", false, false, false, 34)) {
            // line 35
            echo "    <h2>Game over</h2>
    <h2>Winner: ";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["game"]) || array_key_exists("game", $context) ? $context["game"] : (function () { throw new RuntimeError('Variable "game" does not exist.', 36, $this->source); })()), "winner", [], "any", false, false, false, 36), "html", null, true);
            echo "</h2>
    <div class=\"game-control\">
    <a href=\"";
            // line 38
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_blackjack_action", ["action" => "next"]);
            echo "\">Next round</a>
";
        } else {
            // line 40
            echo "<div class=\"game-control\">
    <a href=\"";
            // line 41
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_blackjack_action", ["action" => "hit"]);
            echo "\">Hit</a>
    <a href=\"";
            // line 42
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_blackjack_action", ["action" => "stand"]);
            echo "\">Stand</a>
";
        }
        // line 44
        echo "</div>


<a href=\"";
        // line 47
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("game_blackjack_action", ["action" => "reset"]);
        echo "\">Reset the game</a> <!-- Starts the game -->

</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "game/game.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 47,  195 => 44,  190 => 42,  186 => 41,  183 => 40,  178 => 38,  173 => 36,  170 => 35,  168 => 34,  162 => 30,  149 => 28,  145 => 27,  139 => 24,  134 => 21,  121 => 19,  117 => 18,  111 => 15,  106 => 13,  101 => 11,  97 => 10,  93 => 9,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Card Game{% endblock %}

{% block body %}
<div class=\"game-container\">
<h1>Blackjack</h1>
<div class=\"last-round\">
<h2>Last round winner: {{ game.winner }}</h2>
<h2>Player score last round: {{ game.getLastPlayerScore }}</h2>
<h2>Dealer score last round: {{ game.getLastDealerScore }}</h2>
</div>
<h2>Cards left in deck: {{ game.getDeck.getCards|length }}</h2>
<div class=\"player-info\">
<h2>Player: {{ game.getPlayerScore }}</h2>
<!-- Display player cards -->
<div class=\"card-row\">
{% for card in game.getPlayer.getHand.getCards %}
    <span class=\"card{% if card.getSuit() in ['♥', '♦'] %} red{% endif %}\">{{ card }}</span>
{% endfor %}
</div>
</div>
<div class=\"dealer-info\">
<h2>Dealer: {{ game.getDealerScore }}</h2>
<!-- Display dealer cards -->
<div class=\"card-row\">
{% for card in game.getDealer.getHand.getCards %}
    <span class=\"card{% if card.getSuit() in ['♥', '♦'] %} red{% endif %}\">{{ card }}</span>
{% endfor %}
</div>
</div>
<!-- Game control buttons -->

{% if game.isGameOver %}
    <h2>Game over</h2>
    <h2>Winner: {{ game.winner }}</h2>
    <div class=\"game-control\">
    <a href=\"{{ path('game_blackjack_action', { 'action': 'next' }) }}\">Next round</a>
{% else %}
<div class=\"game-control\">
    <a href=\"{{ path('game_blackjack_action', { 'action': 'hit' }) }}\">Hit</a>
    <a href=\"{{ path('game_blackjack_action', { 'action': 'stand' }) }}\">Stand</a>
{% endif %}
</div>


<a href=\"{{ path('game_blackjack_action', { 'action': 'reset' }) }}\">Reset the game</a> <!-- Starts the game -->

</div>
{% endblock %}
", "game/game.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/game/game.html.twig");
    }
}
