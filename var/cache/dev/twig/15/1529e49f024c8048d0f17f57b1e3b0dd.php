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

/* home/report.html.twig */
class __TwigTemplate_51578e46572fe6890c995d03df14889d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/report.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/report.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/report.html.twig", 1);
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
        echo "<article>
    <h1>Redovisning av kursmoment i kursen Objektorienterade webbteknologier</h1>

    <section>
    <h2>Kmom01</h2>
    <p>
        Jag har tidigare studerat objektorientering under min utbildning och har erfarenhet av att arbeta med objektorienterad programmering i Python och lite C#.
        <br><br>
        PHPs modell för klasser och objekt liknar mycket det som används i andra objektorienterade språk, såsom Python och C#.
        För att komma igång och skapa sina första klasser i PHP behöver man förstå begrepp som egenskaper, metoder, inkapsling och arv.
        <br><br>
        Kodbasen för uppgiften me/report var relativt enkel och följde en MVC-struktur med Twig som template engine.
        Strukturen var logiskt uppdelad i separata mappar för modeller, vyer och kontroller.
        <br><br>
        Artikeln \"PHP The Right Way\" ger en bra överblick över hur man kan arbeta med PHP på ett professionellt sätt.
        Jag tycker särskilt att delarna om felhantering, databasåtkomst och pakethantering är intressanta och värdefulla.
        Jag skulle vilja fördjupa mig mer inom dessa områden för att kunna förbättra mina kunskaper inom PHP.
        <br><br>
        Min TIL för detta kmom är hur man kan använda Symfony och Twig tillsammans för att skapa webbapplikationer med PHP.
        <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom02</h2>
    <p>
        I detta kursmoment har vi utforskat objektorienterade konstruktioner i PHP, såsom arv, komposition,
        interface och trait, samt arbetat med Symfony och MVC-arkitektur.
        Här följer en kort förklaring av dessa koncept och hur de används i PHP:
        <br><br>
        1. Arv: Arv innebär att en klass kan ärva egenskaper och metoder från en annan klass.
        Detta används för att skapa en hierarki av klasser där en underklass kan utöka eller specialisera en överklass.
        I PHP används extends-nyckelordet för att skapa arv.
        <br><br>
        2. Komposition: Komposition är ett sätt att bygga komplexa objekt genom att kombinera enkla objekt.
        Det innebär att en klass har en eller flera instanser av andra klasser som attribut.
        Komposition används för att skapa modularitet och återanvändning av kod.
        <br><br>
        3. Interface: Interface definierar en kontrakt för vilka metoder en klass måste implementera.
        Det garanterar att en klass som implementerar ett interface har vissa metoder med vissa signaturer.
        I PHP används implements-nyckelordet för att implementera ett interface.
        <br><br>
        4. Trait: Traits är en mekanism för att återanvända kod i PHP genom att inkapsla
        återanvändbara metoder i separata enheter som kan inkluderas i flera klasser.
        Traits används för att dela gemensam funktionalitet mellan klasser utan att använda arv.
        <br><br>
        Under uppgiften implementerade jag ett kortspel med hjälp av klasser och objektorienterade konstruktioner.
        Jag är nöjd med min implementation, men det finns alltid utrymme för förbättringar.
        Jag skulle kunna strukturera koden ännu bättre och göra den mer lättläst och underhållbar.
        <br><br>
        Arbetet med Symfony och MVC-arkitektur har gett mig en djupare förståelse för hur man kan strukturera en webbapplikation.
        Det har varit intressant att se hur Symfony hjälper till att separera ansvarsområden mellan modell, vy och kontroller.
        Detta gör att koden blir mer organiserad och lättare att underhålla.
        <br><br>
        Min TIL (Today I Learned) för detta kursmoment är hur man kan använda objektorienterade konstruktioner i PHP för att skapa modulär och återanvändbar kod.
        Jag har också lärt mig hur Symfony och MVC-arkitektur kan användas för att bygga välstrukturerade webbapplikationer.
        <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom03</h2>
    <p>
    Att modellera ett kortspel med hjälp av flödesdiagram och pseudokod var både utmanande och givande. Detta verktyg erbjöd en visuell representation av problemet som hjälpte till att klargöra och förstå problemets komplexitet innan kodning började. Jag tror att denna metod kan vara mycket effektiv för att förbättra problemlösningsprocessen, eftersom det tvingar oss att tänka igenom hela applikationens flöde innan vi skriver den första koden. På detta sätt blir kodstrukturen mer genomtänkt och logisk, vilket minskar risken för misstag och missförstånd längre fram i utvecklingsprocessen.
    <br><br>
    När det gäller implementationen av uppgiften, valde jag att skapa olika klasser för att representera olika delar av spelet, såsom spelaren, dealern och kortleken. Jag är i stort sett nöjd med resultatet, även om jag inser att det finns rum för förbättringar. Specifikt skulle jag vilja förbättra koden för att göra den mer återanvändbar och underhållbar. Till exempel kan vissa metoder i mina klasser vara mer generella för att kunna hantera fler olika typer av kortspel, inte bara Blackjack.
    <br><br>
    Att koda i Symfony är en ny upplevelse för mig, men jag tycker att det har gått bra hittills. Ramverket är kraftfullt och erbjuder en hel del flexibilitet, vilket gör det möjligt att bygga komplexa applikationer med mindre ansträngning jämfört med att koda allt från grunden. Men det kräver också en del tid att lära sig ramverkets koncept och struktur.
    <br><br>
    Min TIL (Today I Learned) för detta kursmoment var att förstå hur man använder flödesdiagram och pseudokod för att modellera ett problem innan kodning börjar. Detta var en viktig insikt för mig, eftersom det inte bara hjälpte mig att strukturera koden bättre, utan också förbättrade min allmänna problemlösningsförmåga. Framöver kommer jag definitivt att använda dessa verktyg mer i mitt arbete.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom04</h2>
    <p>
    Under detta kursmomentet har jag fått möjlighet att arbeta med PHPUnit, ett testramverk för PHP.
    Mitt inledande intryck av att skriva kod som testar annan kod var lite överväldigande.
    Det var en ganska ny erfarenhet att ha kod som granskar funktionen av annan kod, men jag har funnit det mycket lärorikt.
    <br><br>
    Allmänt sett, har jag funnit PHPUnit vara en kraftfull resurs. 
    Dess förmåga att upptäcka och peka ut fel och brister i koden är ovärderlig. 
    Det kan vara lite klurigt att ställa in och komma igång, men de fördelar det ger är det värt mödan.
    <br><br>
    När jag reflekterar över min kod ur ett \"testbarhet\"-perspektiv, inser jag att det finns rum för förbättringar.
    Vissa delar av koden var svårare att testa än andra, kanske på grund av hur de var strukturerade eller vilka beroenden de hade.
    Jag tror att refaktorering för att förenkla och avkoda vissa delar av koden skulle förbättra dess testbarhet.
    <br><br>
    Jag valde att göra små förändringar i min kod, främst för att förbättra läsbarheten.
    Jag gjorde inga större överhalningar, men jag funderar på att göra det i framtiden baserat på vad jag har lärt mig.
    <br><br>
    Ämnet \"testbar kod\" har fått mig att tänka på vad som gör kod \"snygg\" eller \"ren\".
    Testbar kod är ofta väl strukturerad, vilket underlättar förståelsen av vad koden gör.
    Det skulle jag säga är en indikator på \"ren\" kod.
    <br><br>
    Min \"Today I Learned\" (TIL) för detta kursmoment är att testning är en central del av modern programutveckling.
    Det är inte bara ett sätt att hitta fel, utan det kan också fungera som en vägledning för att skriva bättre kod.
    Med hjälp av PHPUnit har jag lärt mig att det är möjligt att skriva kod som effektivt kan granska och testa annan kod,
    vilket är en viktig färdighet som jag kommer att ta med mig i mitt framtida arbete.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom05</h2>
    <p>
    Detta kursmoment har varit en fortsatt givande övning i att fördjupa min förståelse för Symfony och Doctrine.
    Genom mina tidigare erfarenheter med dessa verktyg under kursens gång,
    har jag successivt blivit mer bekväm med att navigera i Symfony's robusta struktur
    och använder Doctrine's kraftfulla verktyg för att arbeta med databaser.
    Att applicera dessa kunskaper i en ny, mer komplex kontext,
    har ytterligare understrukit hur kraftfulla och flexibla dessa verktyg kan vara.
    <br><br>
    Min applikation är en enkel biblioteksapplikation för att hantera böcker.
    Jag tänkte mycket på användargränssnittet och försökte göra det så intuitivt och användarvänligt som möjligt.
    Jag ville att det skulle vara enkelt att lägga till, redigera och ta bort böcker från biblioteket.
    <br><br>
    Arbeta med ORM i CRUD gick mycket smidigare än jag förväntade mig.
    Jag har tidigare erfarenhet av att arbeta med SQL och jämfört med det, har ORM visat sig vara mer organiserat och effektivt.
    Med ORM kunde jag fokusera mer på objekten och deras relationer istället för att oroa mig för databasens detaljer.
    <br><br>
    Min uppfattning om ORM hittills är mycket positiv.
    Det är ett mycket kraftfullt verktyg för att arbeta med databaser.
    Det minimerar behovet av att skriva repetitiva SQL-kommandon och hjälper till att hålla koden DRY.
    Det hjälper också till att hålla applikationen säker från SQL-injektion eftersom det mesta av databasinteraktionen sköts av ORM.
    <br><br>
    Min TIL (Today I Learned) för detta kursmoment är hur effektivt det kan vara att arbeta med ORM som Doctrine.
    Det var en ögonöppnare för mig att se hur det kunde förenkla databasinteraktioner och göra koden mer läsbar och underhållbar.
    Jag ser fram emot att fortsätta använda och lära mig mer om ORM i framtida projekt.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom06</h2>
    <p>
    </p>
    </section>

    <section>
    <h2>Kmom07-10</h2>
    <p>
    </p>
    </section>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "home/report.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Report{% endblock %}

{% block body %}
<article>
    <h1>Redovisning av kursmoment i kursen Objektorienterade webbteknologier</h1>

    <section>
    <h2>Kmom01</h2>
    <p>
        Jag har tidigare studerat objektorientering under min utbildning och har erfarenhet av att arbeta med objektorienterad programmering i Python och lite C#.
        <br><br>
        PHPs modell för klasser och objekt liknar mycket det som används i andra objektorienterade språk, såsom Python och C#.
        För att komma igång och skapa sina första klasser i PHP behöver man förstå begrepp som egenskaper, metoder, inkapsling och arv.
        <br><br>
        Kodbasen för uppgiften me/report var relativt enkel och följde en MVC-struktur med Twig som template engine.
        Strukturen var logiskt uppdelad i separata mappar för modeller, vyer och kontroller.
        <br><br>
        Artikeln \"PHP The Right Way\" ger en bra överblick över hur man kan arbeta med PHP på ett professionellt sätt.
        Jag tycker särskilt att delarna om felhantering, databasåtkomst och pakethantering är intressanta och värdefulla.
        Jag skulle vilja fördjupa mig mer inom dessa områden för att kunna förbättra mina kunskaper inom PHP.
        <br><br>
        Min TIL för detta kmom är hur man kan använda Symfony och Twig tillsammans för att skapa webbapplikationer med PHP.
        <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom02</h2>
    <p>
        I detta kursmoment har vi utforskat objektorienterade konstruktioner i PHP, såsom arv, komposition,
        interface och trait, samt arbetat med Symfony och MVC-arkitektur.
        Här följer en kort förklaring av dessa koncept och hur de används i PHP:
        <br><br>
        1. Arv: Arv innebär att en klass kan ärva egenskaper och metoder från en annan klass.
        Detta används för att skapa en hierarki av klasser där en underklass kan utöka eller specialisera en överklass.
        I PHP används extends-nyckelordet för att skapa arv.
        <br><br>
        2. Komposition: Komposition är ett sätt att bygga komplexa objekt genom att kombinera enkla objekt.
        Det innebär att en klass har en eller flera instanser av andra klasser som attribut.
        Komposition används för att skapa modularitet och återanvändning av kod.
        <br><br>
        3. Interface: Interface definierar en kontrakt för vilka metoder en klass måste implementera.
        Det garanterar att en klass som implementerar ett interface har vissa metoder med vissa signaturer.
        I PHP används implements-nyckelordet för att implementera ett interface.
        <br><br>
        4. Trait: Traits är en mekanism för att återanvända kod i PHP genom att inkapsla
        återanvändbara metoder i separata enheter som kan inkluderas i flera klasser.
        Traits används för att dela gemensam funktionalitet mellan klasser utan att använda arv.
        <br><br>
        Under uppgiften implementerade jag ett kortspel med hjälp av klasser och objektorienterade konstruktioner.
        Jag är nöjd med min implementation, men det finns alltid utrymme för förbättringar.
        Jag skulle kunna strukturera koden ännu bättre och göra den mer lättläst och underhållbar.
        <br><br>
        Arbetet med Symfony och MVC-arkitektur har gett mig en djupare förståelse för hur man kan strukturera en webbapplikation.
        Det har varit intressant att se hur Symfony hjälper till att separera ansvarsområden mellan modell, vy och kontroller.
        Detta gör att koden blir mer organiserad och lättare att underhålla.
        <br><br>
        Min TIL (Today I Learned) för detta kursmoment är hur man kan använda objektorienterade konstruktioner i PHP för att skapa modulär och återanvändbar kod.
        Jag har också lärt mig hur Symfony och MVC-arkitektur kan användas för att bygga välstrukturerade webbapplikationer.
        <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom03</h2>
    <p>
    Att modellera ett kortspel med hjälp av flödesdiagram och pseudokod var både utmanande och givande. Detta verktyg erbjöd en visuell representation av problemet som hjälpte till att klargöra och förstå problemets komplexitet innan kodning började. Jag tror att denna metod kan vara mycket effektiv för att förbättra problemlösningsprocessen, eftersom det tvingar oss att tänka igenom hela applikationens flöde innan vi skriver den första koden. På detta sätt blir kodstrukturen mer genomtänkt och logisk, vilket minskar risken för misstag och missförstånd längre fram i utvecklingsprocessen.
    <br><br>
    När det gäller implementationen av uppgiften, valde jag att skapa olika klasser för att representera olika delar av spelet, såsom spelaren, dealern och kortleken. Jag är i stort sett nöjd med resultatet, även om jag inser att det finns rum för förbättringar. Specifikt skulle jag vilja förbättra koden för att göra den mer återanvändbar och underhållbar. Till exempel kan vissa metoder i mina klasser vara mer generella för att kunna hantera fler olika typer av kortspel, inte bara Blackjack.
    <br><br>
    Att koda i Symfony är en ny upplevelse för mig, men jag tycker att det har gått bra hittills. Ramverket är kraftfullt och erbjuder en hel del flexibilitet, vilket gör det möjligt att bygga komplexa applikationer med mindre ansträngning jämfört med att koda allt från grunden. Men det kräver också en del tid att lära sig ramverkets koncept och struktur.
    <br><br>
    Min TIL (Today I Learned) för detta kursmoment var att förstå hur man använder flödesdiagram och pseudokod för att modellera ett problem innan kodning börjar. Detta var en viktig insikt för mig, eftersom det inte bara hjälpte mig att strukturera koden bättre, utan också förbättrade min allmänna problemlösningsförmåga. Framöver kommer jag definitivt att använda dessa verktyg mer i mitt arbete.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom04</h2>
    <p>
    Under detta kursmomentet har jag fått möjlighet att arbeta med PHPUnit, ett testramverk för PHP.
    Mitt inledande intryck av att skriva kod som testar annan kod var lite överväldigande.
    Det var en ganska ny erfarenhet att ha kod som granskar funktionen av annan kod, men jag har funnit det mycket lärorikt.
    <br><br>
    Allmänt sett, har jag funnit PHPUnit vara en kraftfull resurs. 
    Dess förmåga att upptäcka och peka ut fel och brister i koden är ovärderlig. 
    Det kan vara lite klurigt att ställa in och komma igång, men de fördelar det ger är det värt mödan.
    <br><br>
    När jag reflekterar över min kod ur ett \"testbarhet\"-perspektiv, inser jag att det finns rum för förbättringar.
    Vissa delar av koden var svårare att testa än andra, kanske på grund av hur de var strukturerade eller vilka beroenden de hade.
    Jag tror att refaktorering för att förenkla och avkoda vissa delar av koden skulle förbättra dess testbarhet.
    <br><br>
    Jag valde att göra små förändringar i min kod, främst för att förbättra läsbarheten.
    Jag gjorde inga större överhalningar, men jag funderar på att göra det i framtiden baserat på vad jag har lärt mig.
    <br><br>
    Ämnet \"testbar kod\" har fått mig att tänka på vad som gör kod \"snygg\" eller \"ren\".
    Testbar kod är ofta väl strukturerad, vilket underlättar förståelsen av vad koden gör.
    Det skulle jag säga är en indikator på \"ren\" kod.
    <br><br>
    Min \"Today I Learned\" (TIL) för detta kursmoment är att testning är en central del av modern programutveckling.
    Det är inte bara ett sätt att hitta fel, utan det kan också fungera som en vägledning för att skriva bättre kod.
    Med hjälp av PHPUnit har jag lärt mig att det är möjligt att skriva kod som effektivt kan granska och testa annan kod,
    vilket är en viktig färdighet som jag kommer att ta med mig i mitt framtida arbete.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom05</h2>
    <p>
    Detta kursmoment har varit en fortsatt givande övning i att fördjupa min förståelse för Symfony och Doctrine.
    Genom mina tidigare erfarenheter med dessa verktyg under kursens gång,
    har jag successivt blivit mer bekväm med att navigera i Symfony's robusta struktur
    och använder Doctrine's kraftfulla verktyg för att arbeta med databaser.
    Att applicera dessa kunskaper i en ny, mer komplex kontext,
    har ytterligare understrukit hur kraftfulla och flexibla dessa verktyg kan vara.
    <br><br>
    Min applikation är en enkel biblioteksapplikation för att hantera böcker.
    Jag tänkte mycket på användargränssnittet och försökte göra det så intuitivt och användarvänligt som möjligt.
    Jag ville att det skulle vara enkelt att lägga till, redigera och ta bort böcker från biblioteket.
    <br><br>
    Arbeta med ORM i CRUD gick mycket smidigare än jag förväntade mig.
    Jag har tidigare erfarenhet av att arbeta med SQL och jämfört med det, har ORM visat sig vara mer organiserat och effektivt.
    Med ORM kunde jag fokusera mer på objekten och deras relationer istället för att oroa mig för databasens detaljer.
    <br><br>
    Min uppfattning om ORM hittills är mycket positiv.
    Det är ett mycket kraftfullt verktyg för att arbeta med databaser.
    Det minimerar behovet av att skriva repetitiva SQL-kommandon och hjälper till att hålla koden DRY.
    Det hjälper också till att hålla applikationen säker från SQL-injektion eftersom det mesta av databasinteraktionen sköts av ORM.
    <br><br>
    Min TIL (Today I Learned) för detta kursmoment är hur effektivt det kan vara att arbeta med ORM som Doctrine.
    Det var en ögonöppnare för mig att se hur det kunde förenkla databasinteraktioner och göra koden mer läsbar och underhållbar.
    Jag ser fram emot att fortsätta använda och lära mig mer om ORM i framtida projekt.
    <br><br>
    </p>
    </section>

    <section>
    <h2>Kmom06</h2>
    <p>
    </p>
    </section>

    <section>
    <h2>Kmom07-10</h2>
    <p>
    </p>
    </section>
{% endblock %}
", "home/report.html.twig", "/home/kalo22/dbwebb-kurser/mvc/me/report/templates/home/report.html.twig");
    }
}
