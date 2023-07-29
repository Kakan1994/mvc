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

/* home/metrics.html.twig */
class __TwigTemplate_90971fb4707df0c1e15e027915154a61 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/metrics.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/metrics.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/metrics.html.twig", 1);
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

        echo "Report";
        
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
        echo "<div class=\"metrics-container\">
    <div class=\"metrics-heading\">
        <h1>Metrics</h1>
    </div>
    <div class=\"metrics-intro\">
        <h2>Introduktion</h2>
        <p>
            Som en introduktion till denna analys kommer jag att försöka beskriva de sex C:na - kodstil (codestyle),
            kodtäckning (coverage), komplexitet (complexity), sammanhållning (cohesion), koppling (coupling) och CRAP.
        </p>

        <h3>Codestyle</h3>
        <p>
            Kodstil (Codestyle) handlar om att följa konsekventa riktlinjer när man skriver kod.
            Detta kan innefatta regler för indentering, namngivning, kommentarer och kodorganisation.
            Att hålla en enhetlig kodstil förbättrar kodens läsbarhet och underhållbarhet.
        </p>


        <h3>Coverage</h3>
        <p>
            Kodtäckning, eller Coverage, refererar till den procentandel av koden som testas av automatiserade tester, ofta enhetstester.
            Målet med kodtäckning är att säkerställa att varje del av koden har blivit exekverad åtminstone en gång under testningen, vilket minskar chansen för oupptäckta fel.
            Verktyg som PHPUnit och Xdebug för PHP kan användas för att mäta kodtäckning. Även om 100% kodtäckning kan vara idealisk, är det inte alltid möjligt eller praktiskt.
            Det är viktigt att prioritera att testa de mest kritiska delarna av koden för att säkerställa korrekt funktionalitet.
            <br><br>
            Jag har valt att exkludera repository-katalogen från analysen då det är kod jag inte skrivit och är svår att testa.
            Behöver även lägga till tester för mina controllers.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/coverage.jpg"), "html", null, true);
        echo "\"
                width=\"80%\"
                alt=\"coverage\">
        </div>

        <h3>Complexity</h3>
        <p>
            Komplexitet är ett mätvärde som beskriver hur svårt det är att förstå och ändra en del av koden.
            Detta kan vara resultatet av stora klasser eller metoder, för många villkor och loopar, eller överdriven användning av arv.
            Ett högt värde indikerar att koden kan vara svår att underhålla och har en högre risk för fel.
            Verktyg som PHPMetrics kan hjälpa till att identifiera och mäta kodkomplexitet genom att analysera faktorer som
            Cyclomatic Complexity (antal linjärt oberoende stigar genom en programs källkod) och
            NPath Complexity (antalet exekveringsstigar genom en funktion).
            Genom att minska komplexiteten kan koden bli lättare att förstå, testa och underhålla.
            <br><br>
            Jag ser att i min kod så sticker Game-klassen ut med en hög komplexitet.
            Den har en hög komplexitet på 18, varav en metod har en komplexitet på 7.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/complexity.jpg"), "html", null, true);
        echo "\"
                width=\"80%\"
                alt=\"coverage\">
        </div>

        <h3>Cohesion</h3>
        <p>
            Kohesion refererar till hur nära relaterade och fokuserade klassens eller modulens ansvarsområden är.
            En hög kohesion innebär att varje klass eller modul har ett tydligt och specifikt syfte, vilket leder till enklare underhåll, förståelse och testning av koden.
            Om en klass tar på sig för många ansvarsområden - vilket kan vara ett tecken på låg kohesion - blir det mer komplicerat att ändra och testa klassen.
            Ett exempel på en teknik för att förbättra kohesionen är Single Responsibility Principle (SRP) som är en del av SOLID-principerna inom objektorienterad programmering.
            Genom att säkerställa att varje klass eller modul endast har ett ansvarsområde kan vi uppnå hög kohesion och mer underhållbar kod.
        </p>

        <h3>Coupling</h3>
        <p>
            Koppling, eller coupling på engelska, refererar till den grad av beroende mellan olika moduler eller klasser i en programvara.
            Idealiskt sett bör en modul eller klass vara så oberoende som möjligt.
            Detta innebär att ändringar i en del av programvaran inte bör påverka andra delar.
            Ju lägre koppling, desto lättare är det att ändra, testa och återanvända kod.
            Högt kopplad kod kan leda till att ändringar i en del av systemet kan få omfattande och oväntade konsekvenser på andra delar,
            vilket gör koden svårare att underhålla och utveckla. Ett vanligt sätt att minska koppling är genom att använda gränssnitt och abstraktioner,
            vilket möjliggör förändring och utveckling av delar av systemet utan att påverka andra delar.
            <br><br>
            I min kod så ser jag att förutom kontroller-klasserna så är det Game-klassen har ett högt beroende av andra klasser.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/coupling.jpg"), "html", null, true);
        echo "\"
                width=\"80%\"
                alt=\"coupling\">
        </div>

        <h3>CRAP</h3>
        <p>
            CRAP, vilket står för Change Risk Analysis and Predictions, är en metrik som används för att mäta risk och kvalitet i kod.
            CRAP-indexet är en kombination av kodens komplexitet och testtäckning.
            Med andra ord, om koden är komplex och saknar tillräckliga tester, kommer den att få ett högt CRAP-värde, vilket indikerar en hög risk för fel vid ändringar.
            Å andra sidan, om koden är enkel och vältestad, kommer den att ha ett lågt CRAP-värde, vilket innebär en lägre risk.
            Denna metrik hjälper utvecklare att identifiera delar av koden som kan behöva mer tester eller behöver förenklas för att minska risken för problem.
            <br><br>
            I min kod ser jag två metoder som sticker ut i CRAP-värde.
            Dessa är gameBlackjack i GameController med 42 och update i LibraryController med 20.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"";
        // line 107
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/crap.jpg"), "html", null, true);
        echo "\"
                width=\"80%\"
                alt=\"crap\">
        </div>
    </div>
    <h2>PHP Metrics</h2>
    <p>
        Från PHP Metrics så har jag valt ut detta att kolla närmare på:
    </p>
    <ul>
        <li>
            Komplexitet i Game-klassen (18 i cyclomatic complexity)
        </li>
        <li>
            Coupling i DeckOfCards-klassen (5 i afferent coupling)
        </li>
        <li>
            Coupling i Card-controllern (8 i efferent coupling)
        </li>
    </ul>

    <h2>Scrutinizer</h2>
        <div class=\"scrutinizer-badges\">
            <div class=\"badge scrutinizer\">
                <img
                    src=\"";
        // line 132
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/quality-score.svg"), "html", null, true);
        echo "\"
                    alt=\"quality score badge\"
                    width=\"140\"
                >
            </div>
            <div class=\"badge coverage\">
                <img
                    src=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/coverage.svg"), "html", null, true);
        echo "\"
                    alt=\"coverage badge\"
                    width=\"140\"
                >
            </div>
            <div class=\"badge build\">
                <img
                    src=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/metrics/build.svg"), "html", null, true);
        echo "\"
                    alt=\"build badge\"
                    width=\"118\"
                >
            </div>
        </div>
        <figcaption><em>Badges före åtgärder</em></figcaption>
        <p>
            Från Scrutinizer-rapporten så har jag valt ut detta att kolla närmare på:
        </p>
        <ul>
            <li>Kodtäckningen ligger endast på 52%</li>
            <li>Höga CRAP-värden på två metoder</li>
            <li>Metoden calculateScore i Game-klassen för att få upp Code quality lite till</li>
        </ul>

        <h2>Förbättringar</h2>
        <p>
            De förbättringar som jag kommer att fokusera på är att följande 3:
        </p>
        <ol>
            <li>
                Förbättra kodtäckningen
                <ul>
                    <li>Skapa tester för controllers</li>
                </ul>
            </li>
            <li>
                Öka calculateScore-metoden i Game-klassen till ett A i Scrutinizer.
            </li>
            <li>
                Minska CRAP-score för gameBlackjack i GameController
            </li>
        </ol>

</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "home/metrics.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  248 => 146,  238 => 139,  228 => 132,  200 => 107,  178 => 88,  146 => 59,  122 => 38,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Report{% endblock %}

{% block body %}
<div class=\"metrics-container\">
    <div class=\"metrics-heading\">
        <h1>Metrics</h1>
    </div>
    <div class=\"metrics-intro\">
        <h2>Introduktion</h2>
        <p>
            Som en introduktion till denna analys kommer jag att försöka beskriva de sex C:na - kodstil (codestyle),
            kodtäckning (coverage), komplexitet (complexity), sammanhållning (cohesion), koppling (coupling) och CRAP.
        </p>

        <h3>Codestyle</h3>
        <p>
            Kodstil (Codestyle) handlar om att följa konsekventa riktlinjer när man skriver kod.
            Detta kan innefatta regler för indentering, namngivning, kommentarer och kodorganisation.
            Att hålla en enhetlig kodstil förbättrar kodens läsbarhet och underhållbarhet.
        </p>


        <h3>Coverage</h3>
        <p>
            Kodtäckning, eller Coverage, refererar till den procentandel av koden som testas av automatiserade tester, ofta enhetstester.
            Målet med kodtäckning är att säkerställa att varje del av koden har blivit exekverad åtminstone en gång under testningen, vilket minskar chansen för oupptäckta fel.
            Verktyg som PHPUnit och Xdebug för PHP kan användas för att mäta kodtäckning. Även om 100% kodtäckning kan vara idealisk, är det inte alltid möjligt eller praktiskt.
            Det är viktigt att prioritera att testa de mest kritiska delarna av koden för att säkerställa korrekt funktionalitet.
            <br><br>
            Jag har valt att exkludera repository-katalogen från analysen då det är kod jag inte skrivit och är svår att testa.
            Behöver även lägga till tester för mina controllers.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"{{ asset('images/metrics/coverage.jpg') }}\"
                width=\"80%\"
                alt=\"coverage\">
        </div>

        <h3>Complexity</h3>
        <p>
            Komplexitet är ett mätvärde som beskriver hur svårt det är att förstå och ändra en del av koden.
            Detta kan vara resultatet av stora klasser eller metoder, för många villkor och loopar, eller överdriven användning av arv.
            Ett högt värde indikerar att koden kan vara svår att underhålla och har en högre risk för fel.
            Verktyg som PHPMetrics kan hjälpa till att identifiera och mäta kodkomplexitet genom att analysera faktorer som
            Cyclomatic Complexity (antal linjärt oberoende stigar genom en programs källkod) och
            NPath Complexity (antalet exekveringsstigar genom en funktion).
            Genom att minska komplexiteten kan koden bli lättare att förstå, testa och underhålla.
            <br><br>
            Jag ser att i min kod så sticker Game-klassen ut med en hög komplexitet.
            Den har en hög komplexitet på 18, varav en metod har en komplexitet på 7.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"{{ asset('images/metrics/complexity.jpg') }}\"
                width=\"80%\"
                alt=\"coverage\">
        </div>

        <h3>Cohesion</h3>
        <p>
            Kohesion refererar till hur nära relaterade och fokuserade klassens eller modulens ansvarsområden är.
            En hög kohesion innebär att varje klass eller modul har ett tydligt och specifikt syfte, vilket leder till enklare underhåll, förståelse och testning av koden.
            Om en klass tar på sig för många ansvarsområden - vilket kan vara ett tecken på låg kohesion - blir det mer komplicerat att ändra och testa klassen.
            Ett exempel på en teknik för att förbättra kohesionen är Single Responsibility Principle (SRP) som är en del av SOLID-principerna inom objektorienterad programmering.
            Genom att säkerställa att varje klass eller modul endast har ett ansvarsområde kan vi uppnå hög kohesion och mer underhållbar kod.
        </p>

        <h3>Coupling</h3>
        <p>
            Koppling, eller coupling på engelska, refererar till den grad av beroende mellan olika moduler eller klasser i en programvara.
            Idealiskt sett bör en modul eller klass vara så oberoende som möjligt.
            Detta innebär att ändringar i en del av programvaran inte bör påverka andra delar.
            Ju lägre koppling, desto lättare är det att ändra, testa och återanvända kod.
            Högt kopplad kod kan leda till att ändringar i en del av systemet kan få omfattande och oväntade konsekvenser på andra delar,
            vilket gör koden svårare att underhålla och utveckla. Ett vanligt sätt att minska koppling är genom att använda gränssnitt och abstraktioner,
            vilket möjliggör förändring och utveckling av delar av systemet utan att påverka andra delar.
            <br><br>
            I min kod så ser jag att förutom kontroller-klasserna så är det Game-klassen har ett högt beroende av andra klasser.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"{{ asset('images/metrics/coupling.jpg') }}\"
                width=\"80%\"
                alt=\"coupling\">
        </div>

        <h3>CRAP</h3>
        <p>
            CRAP, vilket står för Change Risk Analysis and Predictions, är en metrik som används för att mäta risk och kvalitet i kod.
            CRAP-indexet är en kombination av kodens komplexitet och testtäckning.
            Med andra ord, om koden är komplex och saknar tillräckliga tester, kommer den att få ett högt CRAP-värde, vilket indikerar en hög risk för fel vid ändringar.
            Å andra sidan, om koden är enkel och vältestad, kommer den att ha ett lågt CRAP-värde, vilket innebär en lägre risk.
            Denna metrik hjälper utvecklare att identifiera delar av koden som kan behöva mer tester eller behöver förenklas för att minska risken för problem.
            <br><br>
            I min kod ser jag två metoder som sticker ut i CRAP-värde.
            Dessa är gameBlackjack i GameController med 42 och update i LibraryController med 20.
        </p>
        <div class=\"analysis image\">
            <img
                class=\"analysis-image\"
                src=\"{{ asset('images/metrics/crap.jpg') }}\"
                width=\"80%\"
                alt=\"crap\">
        </div>
    </div>
    <h2>PHP Metrics</h2>
    <p>
        Från PHP Metrics så har jag valt ut detta att kolla närmare på:
    </p>
    <ul>
        <li>
            Komplexitet i Game-klassen (18 i cyclomatic complexity)
        </li>
        <li>
            Coupling i DeckOfCards-klassen (5 i afferent coupling)
        </li>
        <li>
            Coupling i Card-controllern (8 i efferent coupling)
        </li>
    </ul>

    <h2>Scrutinizer</h2>
        <div class=\"scrutinizer-badges\">
            <div class=\"badge scrutinizer\">
                <img
                    src=\"{{ asset('images/metrics/quality-score.svg') }}\"
                    alt=\"quality score badge\"
                    width=\"140\"
                >
            </div>
            <div class=\"badge coverage\">
                <img
                    src=\"{{ asset('images/metrics/coverage.svg') }}\"
                    alt=\"coverage badge\"
                    width=\"140\"
                >
            </div>
            <div class=\"badge build\">
                <img
                    src=\"{{ asset('images/metrics/build.svg') }}\"
                    alt=\"build badge\"
                    width=\"118\"
                >
            </div>
        </div>
        <figcaption><em>Badges före åtgärder</em></figcaption>
        <p>
            Från Scrutinizer-rapporten så har jag valt ut detta att kolla närmare på:
        </p>
        <ul>
            <li>Kodtäckningen ligger endast på 52%</li>
            <li>Höga CRAP-värden på två metoder</li>
            <li>Metoden calculateScore i Game-klassen för att få upp Code quality lite till</li>
        </ul>

        <h2>Förbättringar</h2>
        <p>
            De förbättringar som jag kommer att fokusera på är att följande 3:
        </p>
        <ol>
            <li>
                Förbättra kodtäckningen
                <ul>
                    <li>Skapa tester för controllers</li>
                </ul>
            </li>
            <li>
                Öka calculateScore-metoden i Game-klassen till ett A i Scrutinizer.
            </li>
            <li>
                Minska CRAP-score för gameBlackjack i GameController
            </li>
        </ol>

</div>
{% endblock %}
", "home/metrics.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/home/metrics.html.twig");
    }
}
