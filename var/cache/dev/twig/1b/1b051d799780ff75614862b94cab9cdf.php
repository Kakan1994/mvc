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

/* home/lucky.html.twig */
class __TwigTemplate_b2e3903a24baec226025ad11219a5ad8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/lucky.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/lucky.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/lucky.html.twig", 1);
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

        echo "Lucky";
        
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
        echo "    <h2>Lucky number: ";
        echo twig_escape_filter($this->env, (isset($context["lucky_number"]) || array_key_exists("lucky_number", $context) ? $context["lucky_number"] : (function () { throw new RuntimeError('Variable "lucky_number" does not exist.', 6, $this->source); })()), "html", null, true);
        echo "</h2>
    
    ";
        // line 8
        $context["interesting_objects"] = [0 => ["name" => "A beautiful sunset", "image" => "sunset.jpg"], 1 => ["name" => "A relaxing beach", "image" => "beach.jpg"], 2 => ["name" => "A serene mountain", "image" => "mountain.jpg"], 3 => ["name" => "An exciting city", "image" => "city.jpg"]];
        // line 14
        echo "    
    ";
        // line 15
        $context["random_object"] = twig_get_attribute($this->env, $this->source, (isset($context["interesting_objects"]) || array_key_exists("interesting_objects", $context) ? $context["interesting_objects"] : (function () { throw new RuntimeError('Variable "interesting_objects" does not exist.', 15, $this->source); })()), twig_random($this->env, 0, (twig_length_filter($this->env, (isset($context["interesting_objects"]) || array_key_exists("interesting_objects", $context) ? $context["interesting_objects"] : (function () { throw new RuntimeError('Variable "interesting_objects" does not exist.', 15, $this->source); })())) - 1)), [], "array", false, false, false, 15);
        // line 16
        echo "    
    <h3>";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["random_object"]) || array_key_exists("random_object", $context) ? $context["random_object"] : (function () { throw new RuntimeError('Variable "random_object" does not exist.', 17, $this->source); })()), "name", [], "any", false, false, false, 17), "html", null, true);
        echo "</h3>
    <img src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("images/" . twig_get_attribute($this->env, $this->source, (isset($context["random_object"]) || array_key_exists("random_object", $context) ? $context["random_object"] : (function () { throw new RuntimeError('Variable "random_object" does not exist.', 18, $this->source); })()), "image", [], "any", false, false, false, 18))), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["random_object"]) || array_key_exists("random_object", $context) ? $context["random_object"] : (function () { throw new RuntimeError('Variable "random_object" does not exist.', 18, $this->source); })()), "name", [], "any", false, false, false, 18), "html", null, true);
        echo "\" style=\"max-width: 100%;\">

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "home/lucky.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 18,  104 => 17,  101 => 16,  99 => 15,  96 => 14,  94 => 8,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Lucky{% endblock %}

{% block body %}
    <h2>Lucky number: {{ lucky_number }}</h2>
    
    {% set interesting_objects = [
        { 'name': 'A beautiful sunset', 'image': 'sunset.jpg' },
        { 'name': 'A relaxing beach', 'image': 'beach.jpg' },
        { 'name': 'A serene mountain', 'image': 'mountain.jpg' },
        { 'name': 'An exciting city', 'image': 'city.jpg' }
    ] %}
    
    {% set random_object = interesting_objects[random(0, interesting_objects|length - 1)] %}
    
    <h3>{{ random_object.name }}</h3>
    <img src=\"{{ asset('images/' ~ random_object.image) }}\" alt=\"{{ random_object.name }}\" style=\"max-width: 100%;\">

{% endblock %}
", "home/lucky.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/home/lucky.html.twig");
    }
}
