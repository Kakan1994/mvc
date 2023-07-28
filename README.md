# GITHUB-repo för MVC-kursen

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/build-status/main)

Det här repot är en symfony-applikation

MVC
----

Model-View-Controller, ofta förkortat till MVC, är ett arkitekturellt mönster som används i mjukvaruutveckling för att organisera kod på ett tydligt och strukturerat sätt. Mönstret hjälper till att separera applikationens data (Model), användargränssnitt (View), och den logik som sammanlänkar data och gränssnitt (Controller).

I en MVC-arkitektur, representerar 'Modeller' den underliggande datalogiken. De hanterar data, databasoperationer, och allt som rör tillståndet av applikationen. Modellerna är opartiska till användargränssnittet och fokuserar enbart på data.

'Vyer' står för presentationen av data, vilket är vad användaren faktiskt ser och interagerar med. De består vanligtvis av HTML-templater som fylls med data från modellerna.

'Controllers' fungerar som intermediärer mellan modellerna och vyerna. De tar emot användarens input, interagerar med modellerna för att hantera eller hämta data, och skickar sedan datan till en passande vy för rendering.

Genom att följa MVC-mönstret kan utvecklare skapa mer läsbar, underhållbar, och skalbar kod eftersom varje komponent (Model, View, och Controller) har ett specifikt ansvar och de olika delarna av applikationen är tydligt separerade.

Kodanalys
---------

Under kursens gång har vi utforskat betydelsen av kodstandarder och testbarhet, med stöd av olika verktyg som hjälper oss att mäta och förbättra vår kodkvalitet. Du kan hitta mer information om dessa metoder och tekniker på sidan "Metrics".

Scrutinizer och PHPMetrics är två exempel på dessa verktyg. De erbjuder automatiserade analyser för att hjälpa oss identifiera potentiella problem, förbättringsområden och hålla koden i linje med goda kodstandarder.

Scrutinizer är en kraftfull kodkvalitetsskanner som kan hjälpa oss att identifiera kodfel, strukturella problem och även ge insikter om kodens komplexitet. Den ger oss en övergripande poäng för kodkvalitet och pekar på specifika områden som behöver förbättring.

PHPMetrics, å andra sidan, ger oss en mer detaljerad analys av vår kod, med fokus på objektorienterade principer och kodkomplexitet. Verktyget ger oss metriker som kan hjälpa oss att förstå om vår kod är välstrukturerad, lätt att förstå och lätt att underhålla.

Genom att använda dessa verktyg kan vi sträva efter att ständigt förbättra vår kodkvalitet, vilket gör vår kod mer robust, skalbar och underhållbar över tid.

Bygg applikationen
------------------

För att bygga applikationen behöver du följande:

<strong>Kontrollera att du har PHP i din path:</strong>

<code>$ php --version</code>

Om du inte har rätt version (lägre än 8), kan du lägga till PHP 8 i pathen:

https://dbwebb.se/kunskap/lagg-php8-i-pathen

<strong>Kontrollera att du har composer (pakethanterare för PHP):</strong>

<code>$ composer --version</code>

Annars installerar du composer:

https://getcomposer.org/

<strong>Klona repot med:</strong>

<code>$ git clone git@github.com:kakan1994/mvc.git</code>

Koppla ditt repo till scrutinizer
---------------------------------

https://github.com/dbwebb-se/mvc/tree/main/example/scrutinizer

Kör igång appen
---------------
<code>$ php -S localhost:8888 -t public</code>