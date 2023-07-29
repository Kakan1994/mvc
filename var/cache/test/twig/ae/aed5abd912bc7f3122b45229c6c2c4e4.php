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

/* api/index.html.twig */
class __TwigTemplate_52c93fdea999f129907bef2acd1baad3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "api/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "api/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "api/index.html.twig", 1);
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

        echo "API Overview";
        
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
        echo "    <h1>API Overview</h1>
    <p>
        This page provides an overview of the available JSON API routes for the Card application.
    </p>
    <ul>
        <li>
            <a href=\"";
        // line 12
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("api_quote");
        echo "\">GET api/quote</a>
            <p>Returns a random quote in JSON format.</p>
        </li>
        <br><br>
        <li>
            <a href=\"";
        // line 17
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("api_deck");
        echo "\">GET api/deck</a>
            <p>Returns a JSON structure with the entire sorted deck of cards, sorted by suit and value.</p>
        </li>
        <br><br>
        <li>
            POST api/deck/shuffle
            <p>Shuffles the deck and returns a JSON structure with the shuffled deck of cards.</p>
            <button onclick=\"postRequest('api/deck/shuffle')\">Test POST api/deck/shuffle</button>
        </li>
        <br><br>
        <li>
            POST api/deck/draw
            <p>Draws one card from the deck and returns a JSON structure with the drawn card and the remaining number of cards in the deck.</p>
            <button onclick=\"postRequest('api/deck/draw')\">Test POST api/deck/draw</button>
        </li>
        <br><br>
        <li>
            POST api/deck/draw/:number
            <p>Draws :number cards from the deck and returns a JSON structure with the drawn cards and the remaining number of cards in the deck. Replace ':number' with the desired number of cards to draw.</p>
            <input id=\"numberOfCards\" type=\"number\" min=\"1\" placeholder=\"Number of cards to draw\">
            <button onclick=\"postRequest('api/deck/draw/' + document.getElementById('numberOfCards').value)\">Test POST api/deck/draw/:number</button>
        </li>
        <br><br>
        <li>
            <a href=\"";
        // line 41
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("api_game");
        echo "\">GET api/game </a>
            <p> Show info about the active game </p>
        </li>
        <br><br>
        <li>
            <a href=\"";
        // line 46
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("api_books");
        echo "\">GET api/library/books</a>
            <p>Returns all books in the library in JSON format.</p>
        </li>
        <br><br>
        <li>
            GET api/library/book/:isbn
            <p>Displays a single book by its ISBN number. Replace ':isbn' with the desired ISBN number.</p>
            <input id=\"isbn\" type=\"text\" placeholder=\"ISBN\">
            <button onclick=\"fetch('api/library/book/' + document.getElementById('isbn').value)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                alert(JSON.stringify(data, null, 2));
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                                alert('Error: ' + error);
                            });\">Test GET api/library/book/:isbn</button>
                            <button onclick=\"postRequest('api/library/book/9780439064873')\">Test with 9780439064873</button>
        </li>
    </ul>

    <script>
    function postRequest(url) {
        fetch(url, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(JSON.stringify(data, null, 2));
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Error: ' + error);
            });
    }
    </script>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "api/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 46,  131 => 41,  104 => 17,  96 => 12,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}API Overview{% endblock %}

{% block body %}
    <h1>API Overview</h1>
    <p>
        This page provides an overview of the available JSON API routes for the Card application.
    </p>
    <ul>
        <li>
            <a href=\"{{ url('api_quote') }}\">GET api/quote</a>
            <p>Returns a random quote in JSON format.</p>
        </li>
        <br><br>
        <li>
            <a href=\"{{ url('api_deck') }}\">GET api/deck</a>
            <p>Returns a JSON structure with the entire sorted deck of cards, sorted by suit and value.</p>
        </li>
        <br><br>
        <li>
            POST api/deck/shuffle
            <p>Shuffles the deck and returns a JSON structure with the shuffled deck of cards.</p>
            <button onclick=\"postRequest('api/deck/shuffle')\">Test POST api/deck/shuffle</button>
        </li>
        <br><br>
        <li>
            POST api/deck/draw
            <p>Draws one card from the deck and returns a JSON structure with the drawn card and the remaining number of cards in the deck.</p>
            <button onclick=\"postRequest('api/deck/draw')\">Test POST api/deck/draw</button>
        </li>
        <br><br>
        <li>
            POST api/deck/draw/:number
            <p>Draws :number cards from the deck and returns a JSON structure with the drawn cards and the remaining number of cards in the deck. Replace ':number' with the desired number of cards to draw.</p>
            <input id=\"numberOfCards\" type=\"number\" min=\"1\" placeholder=\"Number of cards to draw\">
            <button onclick=\"postRequest('api/deck/draw/' + document.getElementById('numberOfCards').value)\">Test POST api/deck/draw/:number</button>
        </li>
        <br><br>
        <li>
            <a href=\"{{ url('api_game') }}\">GET api/game </a>
            <p> Show info about the active game </p>
        </li>
        <br><br>
        <li>
            <a href=\"{{ url('api_books') }}\">GET api/library/books</a>
            <p>Returns all books in the library in JSON format.</p>
        </li>
        <br><br>
        <li>
            GET api/library/book/:isbn
            <p>Displays a single book by its ISBN number. Replace ':isbn' with the desired ISBN number.</p>
            <input id=\"isbn\" type=\"text\" placeholder=\"ISBN\">
            <button onclick=\"fetch('api/library/book/' + document.getElementById('isbn').value)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                alert(JSON.stringify(data, null, 2));
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                                alert('Error: ' + error);
                            });\">Test GET api/library/book/:isbn</button>
                            <button onclick=\"postRequest('api/library/book/9780439064873')\">Test with 9780439064873</button>
        </li>
    </ul>

    <script>
    function postRequest(url) {
        fetch(url, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(JSON.stringify(data, null, 2));
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Error: ' + error);
            });
    }
    </script>

{% endblock %}
", "api/index.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/api/index.html.twig");
    }
}
