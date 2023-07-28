# GITHUB-repo för MVC-kursen

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Kakan1994/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Kakan1994/mvc/build-status/main)

Det här repot är en symfony-applikation

MVC
----

Model-View-Controller (MVC) är ett designmönster som strukturerar kod i tre separata enheter för att förbättra läsbarhet och skalbarhet. 'Modeller' hanterar data och databasinteraktioner, 'Vyer' visar data för användaren och 'Controllers' fungerar som mellanhänder, tar emot användarinput, arbetar med modellerna och skickar datan till vyerna för rendering. Genom att använda MVC kan utvecklare skapa kod som är enklare att underhålla och skalera.

Kodanalys
---------

Under kursen har vi använt verktyg som Scrutinizer och PHPMetrics för att förbättra och upprätthålla kodkvalitet. Scrutinizer ger en översiktlig kvalitetspoäng och identifierar potentiella förbättringsområden, medan PHPMetrics erbjuder detaljerad analys fokuserad på kodkomplexitet och objektorienterade principer. Användningen av dessa verktyg bidrar till att göra vår kod mer robust, skalbar och lättare att underhålla.

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