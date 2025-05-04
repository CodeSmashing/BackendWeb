<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Module 1</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
	<input type="hidden" id="assignment" value="c3" disabled>
	<aside class="hidden">
		<ul>
			<li>
				<a href="#section-e1"><strong>E1:</strong> Constante en Functie</a>
			</li>
			<li>
				<a href="#section-e2"><strong>E2:</strong> Meetkunde</a>
			</li>
			<li>
				<a href="#section-e3"><strong>E3:</strong> Globale variabele</a>
			</li>
			<li>
				<a href="#section-e4"><strong>E4:</strong> Variabelen</a>
			</li>
			<li>
				<a href="#section-e5"><strong>E5:</strong> Controlestructuren & Lussen</a>
			</li>
			<li>
				<a href="#section-e6"><strong>E6:</strong> Controlestructuren & Lussen</a>
			</li>
			<li>
				<a href="#section-m1"><strong>M1:</strong> Date-object</a>
			</li>
			<li>
				<a href="#section-m2"><strong>M2:</strong> Date-object en controlestructuren</a>
			</li>
			<li>
				<a href="#section-m3"><strong>M3:</strong> Strings</a>
			</li>
			<li>
				<a href="#section-m4"><strong>M4:</strong> Array</a>
			</li>
			<li>
				<a href="#section-m5"><strong>M5:</strong> Controlestructuren & Lussen</a>
			</li>
			<li>
				<a href="#section-m6"><strong>M6:</strong> Strings & Functies</a>
			</li>
			<li>
				<a href="#section-h1"><strong>H1:</strong> Arrays</a>
			</li>
			<li>
				<a href="#section-h2"><strong>H2:</strong> Arrays</a>
			</li>
			<li>
				<a href="#section-h3"><strong>H3:</strong> Arrays</a>
			</li>
			<li>
				<a href="#section-c1"><strong>C1:</strong> convertTextToNumber</a>
			</li>
			<li>
				<a href="#section-c2"><strong>C2:</strong> Fibonacci</a>
			</li>
			<li>
				<a href="#section-c3"><strong>C3:</strong> Veelvouden</a>
			</li>
		</ul>
	</aside>

	<h1>Module 1 exercises</h1>

	<article class="minimized" id="m1-easy">
		<button class="minimize"></button>
		<h2>Easy</h2>

		<section class="minimized" id="section-e1">
			<button class="minimize"></button>
			<h3><strong>E1:</strong> Constante en Functie</h3>

			<p>
				Schrijf een functie met de naam berekenOppervlakteCirkel die de oppervlakte van een cirkel berekent.
				Deze functie moet één parameters hebben, straal.
				De formule voor het berekenen van de oppervlakte van een cirkel is: oppervlakte = π * straal * straal.
			</p>

			<p>
				Deze functie moet de oppervlakte van een cirkel berekenen en teruggeven.
			</p>

			<p>
				De waarde van π moet een constante zijn.
				Deze constante moet je zelf definiëren (en je mag veronderstellen dat pi gelijk is aan 3.1415).
			</p>

			<section class="results-container">
				<p>
					De oppervlakte van een cirkel met een straal van <span id="input-e1-radius" data-value="3"></span> is: <span id="result-e1"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e2">
			<button class="minimize"></button>
			<h3><strong>E2:</strong> Meetkunde</h3>

			<p>
				We bouwen verder op de functie van E1 en gaan de volgende functies toevoegen:
			</p>

			<ul>
				<li>
					<p>berekenOppervlakteRechthoek(zijde1, zijde2)</p>
				</li>
				<li>
					<p>berekenOppervlakteVierkant(zijde)</p>
				</li>
				<li>
					<p>berekenOppervlakteDriehoek(basis, hoogte)</p>
				</li>
			</ul>

			<p>
				De functie berekenOppervlakteVierkant maakt intern gebruik van de functie berekenOppervlakteRechthoek.
				Maak voorbeeldberekeningen gebruik makend van elk van de geschreven functies en druk de uitkomsten af, we gebruiken hiervoor echo.
			</p>

			<section class="results-container">
				<p>
					De oppervlakte van een rechthoek met een zijde van lengte <span id="input-e2-recSideA" data-value="29"></span>cm en een zijde van lengte <span id="input-e2-recSideB" data-value="45"></span>cm is: <span id="result-e2-a"></span>
				</p>

				<p>
					De oppervlakte van een vierkant met een zijde van lengte <span id="input-e2-squareSide" data-value="7.5"></span>cm is: <span id="result-e2-b"></span>
				</p>

				<p>
					De oppervlakte van een driehoek met een basis van lengte <span id="input-e2-triangleBase" data-value="7"></span>cm en een hoogte van lengte <span id="input-e2-triangleHeight" data-value="15"></span>cm is: <span id="result-e2-c"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e3">
			<button class="minimize"></button>
			<h3><strong>E3:</strong> Globale variabele</h3>

			<p>
				We kunnen een globale variabele definiëren in PHP door de variabele buiten een functie te definiëren.
				Van zodra we binnen een functie deze variabele willen gebruiken, moeten we deze variabele global maken.
				Dit doen we door global $variabeleNaam; te schrijven.
				Van zodra we dit doen zal PHP gaan zoeken in de globale scope naar de variabele met de naam $variabeleNaam.
			</p>

			<p>
				We gaan in de globale variabele $functionsExecutedCounter bijhouden hoeveel keer we één van de bovenstaande functies hebben aangeroepen.
				Elke keer wanneer er één van de hierboven gedefinieerde functies wordt aangeroepen, moet deze teller verhoogd worden.
				Er is slechts één centrale teller voor alle functies.
			</p>

			<p>
				Druk het resultaat van de teller af.
			</p>

			<section class="results-container">
				<p>
					In het totaal zijn de functies <span id="result-e3" data-value="0"></span> aantal keer aangeroepen.
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e4">
			<button class="minimize"></button>
			<h3><strong>E4:</strong> Variabelen</h3>

			<p>
				Maak enkele variabelen aan en ken er een waarde aan toe zodat de je de volgende situaties krijgt:
			</p>

			<ul>
				<li>
					<p>isset($variabele1) == true</p>
				</li>
				<li>
					<p>isset($variabele2) == false</p>
				</li>
				<li>
					<p>empty($variabele3) == true</p>
				</li>
				<li>
					<p>empty($variabele4) == false</p>
				</li>
				<li>
					<p>isset($variabele5) == true && empty($variabele5) == false</p>
				</li>
			</ul>

			<p>
				Meer informatie over isset en empty vind je <a href="https://www.php.net/manual/en/function.isset.php">hier</a> en <a href="https://www.php.net/manual/en/function.empty.php">hier</a>.
			</p>

			<section class="results-container">
				<p>
					Resultaat:
				</p>

				<ul id="result-e4"></ul>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e5">
			<button class="minimize"></button>
			<h3><strong>E5:</strong> Controlestructuren & Lussen</h3>

			<p>
				Schrijf een PHP-functie die nagaat of een nummer gelijk is aan 30, 20 of 10.
				Indien het nummer gelijk is aan één van deze drie getallen, geef je het volgende weer:
			</p>

<div class="code-container">
	Het nummer is gelijk aan ..<br>
</div>

			<section class="results-container">
				<ul id="result-e5"></ul>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e6">
			<button class="minimize"></button>
			<h3><strong>E6:</strong> Controlestructuren & Lussen</h3>

			<p>
				Schrijf een PHP-script die de som weergeeft van alle getallen van 1 tot en met 30. Gebruik hiervoor een lus.
			</p>

			<section class="results-container">
				<p>
					Als we alle getallen van 1 tot en met 30 met elkaar optellen krijgen we: <span id="result-e6"></span>
				</p>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m1-medium">
		<button class="minimize"></button>
		<h2>Medium</h2>

		<section class="minimized" id="section-m1">
			<button class="minimize"></button>
			<h3><strong>M1:</strong> Date-object</h3>

			<p>
				Schrijf een PHP script dat de huidige datum en tijd weergeeft in de volgende formaten:
			</p>

			<ul>
				<li>
					<p>
						2024-09-20
					</p>
				</li>
				<li>
					<p>
						20/09/24 00:00:00
					</p>
				</li>
				<li>
					<p>
						Vrijdag 20/09/2024, 14:30:00
					</p>
				</li>
			</ul>

			<p>
				Je kan de verschillende mogelijkheden voor het formatteren van een datum en tijd terugvinden op <a href="https://www.php.net/manual/en/datetime.format.php">deze pagina</a>.
			</p>

			<section class="results-container">
				<ul id="result-m1"></ul>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m2">
			<button class="minimize"></button>
			<h3><strong>M2:</strong> Date-object en controlestructuren</h3>

			<p>
				Druk het juiste seizoen onder de datum af.
				Je gebruikt hiervoor de maand en hoeft dus niet de exacte data gebruiken.
			</p>

			<ul>
				<li>
					<p>
						December - Januari - Februari = Winter
					</p>
				</li>
				<li>
					<p>
						Maart - April - Mei = Lente
					</p>
				</li>
				<li>
					<p>
						Juni - Juli - Augustus = Zomer
					</p>
				</li>
				<li>
					<p>
						September - Oktober - November = Herfst
					</p>
				</li>
			</ul>

			<section class="results-container">
				<p>
					Het huidige seizoen is: <span id="result-m2"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m3">
			<button class="minimize"></button>
			<h3><strong>M3:</strong> Strings</h3>

			<p>
				Maak een PHP applicatie die 2 functies bevat met volgende signaturen:
			</p>

			<ul>
				<li>
					<p>
						splitsNaam(naam)
					</p>
				</li>
				<li>
					<p>
						voegNamenSamen(voornaam, achternaam)
					</p>
				</li>
			</ul>

			<p>
				De functie splitsNaam zal op zoek gaan naar de eerste spatie in de meegegeven string, en op die plaats de meegegeven string splitsen.
				Daarna wordt in de functie een vaste output gegenereerd van de volgende vorm:
			</p>

<div class="code-container">
<ul><li><p>Voornaam: Kevin</p></li><li><p>Achternaam: Felix</p></li></ul>
</div>

			<p>
				Wanneer de meegegeven string geen spatie bevat, stopt het programma met een foutboodschap (die).
			</p>

			<p>
				De functie voegNamenSamen, plakt de achternaam achter de voornaam met de tussenvoeging van een spatie.
			</p>

			<p>
				Test deze functies uit. (We veronderstellen dat er nooit een spatie in de voornaam voorkomt).
			</p>

			<section class="results-container">
				<div class="input-container">
					<input type="text" id="input-m3-first-name" value="Kevin Felix" placeholder="Voornaam Achternaam">
					<input type="text" id="input-m3-last-name" value=""placeholder="Voornaam Achternaam">
				</div>

				<p>
					Het resultaat is: <span id="result-m3"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m4">
			<button class="minimize"></button>
			<h3><strong>M4:</strong> Array</h3>

			<p>
				Maak een array aan waarin enkele lidstaten van de Europese Unie bewaart.
				Zorg er voor dat de array alfabetisch gesorteerd wordt.
				Druk op het scherm het totaal aantal landen in de array af en zorg ervoor dat de volledige lijst van landen in een geordende lijst wordt afgedrukt.
				De uiteindelijke HTML-code die naar de client wordt gestuurd ziet er ongeveer als volgt uit:
			</p>

<div class="code-container">
<h2>De Europese Unie:</h2>
<p>De Europese Unie telt sinds 2020 in totaal 27 lidstaten.</p>

<h3>De volledige lijst van lidstaten, alfabetisch gerangschikt</h3>

<ol><li><p>België</p></li><li><p>Bulgarije</p></li></ol>
<p>...</p>
</div>

			<section class="results-container">
				<p>
					Totaal aantal landen in de array: <span id="result-m4-a"></span>
				</p>
				<ol id="result-m4-b"></ol>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m5">
			<button class="minimize"></button>
			<h3><strong>M5:</strong> Controlestructuren & Lussen</h3>

			<p>
				Schrijf een PHP-script dat de maaltafels van 1 tot en met 6 afdrukt.
				Let op: je moet de maaltafels berekenen met behulp van een lus, dus niet gewoon overtypen.
			</p>

			<p>
				Dit zal er ongeveer als volgt uit zien:
			</p>

<div class="code-container">

1*1 = 1   2*1 = 2   3*1 = 3   4*1 = 4   5*1 = 5   6*1 = 6
1*2 = 2   2*2 = 4   3*2 = 6   4*2 = 8   5*2 = 10  6*2 = 12
1*3 = 3   2*3 = 6   3*3 = 9   4*3 = 12  5*3 = 15  6*3 = 18
1*4 = 4   2*4 = 8   3*4 = 12  4*4 = 16  5*4 = 20  6*4 = 24
1*5 = 5   2*5 = 10  3*5 = 15  4*5 = 20  5*5 = 25  6*5 = 30
1*6 = 6   2*6 = 12  3*6 = 18  4*6 = 24  5*6 = 30  6*6 = 36


</div>

			<section class="results-container">
				<table id="result-m5"></table>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m6">
			<button class="minimize"></button>
			<h3><strong>M6:</strong> Strings & Functies</h3>

			<p>
				Maak met behulp van <a href="https://www.php.net/manual/en/book.strings.php">de documentatie voor strings</a> de volgende functies:
			</p>

			<ul>
				<li>
					<p>
						caseMagic($zin): Geef van de meegegeven zin de volgende versies terug
					</p>
				</li>
				<ul>
					<li>
						<p>
							COMPLEET UPPERCASE
						</p>
					</li>
					<li>
						<p>
							compleet lowercase
						</p>
					</li>
					<li>
						<p>
							Enkel eerste letter van de zin uppercase
						</p>
					</li>
					<li>
						<p>
							Eerste Letters Van Alle Woorden Uppercase
						</p>
					</li>
				</ul>
				<li>
					<p>
						shuffleWoord($woord): Geeft de letters van het woord terug in een willekeurige volgorde
					</p>
				</li>
				<li>
					<p>
						isPalindroom($woord): Zal controleren of een woord een palindroom is (kok, radar, tacocat, ...)
					</p>
				</li>
				<li>
					<p>
						isAnagram($woord1, $woord2): Zal controleren of beide woorden anagrammen zijn van elkaar, waarbij we spaties negeren (Torchwood & Doctor Who, Tom Marvolo Riddle & I am lord Voldemort)
					</p>
				</li>
			</ul>

			<section class="results-container">
				<ul id="result-m6"></ul>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m1-hard">
		<button class="minimize"></button>
		<h2>Hard</h2>

		<section class="minimized" id="section-h1">
			<button class="minimize"></button>
			<h3><strong>H1:</strong> Arrays</h3>

			<p>
				Kopieer je array van M4. Zorg ervoor dat de lijst nu in een random volgorde wordt getoond aan de gebruiker.
			</p>

			<section class="results-container">
				<p>
					Totaal aantal landen in de array: <span id="result-h1-a"></span>
				</p>
				<ol id="result-h1-b"></ol>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-h2">
			<button class="minimize"></button>
			<h3><strong>H2:</strong> Arrays</h3>

			<p>
				Kopieer je array van M4. Zorg er nu voor dat enkel de landen die beginnen met de letter B op je scherm verschijnen.
			</p>

			<section class="results-container">
				<p>
					Totaal aantal landen in de array die beginnen met de letter 'B': <span id="result-h2-a"></span>
				</p>
				<ol id="result-h2-b"></ol>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-h3">
			<button class="minimize"></button>
			<h3><strong>H3:</strong> Arrays</h3>

			<p>
				Kopieer je array van M4. Zorg er nu voor dat alle landen die beginnen met de letter B niet op je scherm verschijnen.
				Verwijder deze elementen uit de array.
			</p>

			<section class="results-container">
				<p>
					Totaal aantal landen in de array die niet beginnen met de letter 'B': <span id="result-h3-a"></span>
				</p>
				<ol id="result-h3-b"></ol>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m1-challenge">
		<button class="minimize"></button>
		<h2>Challenge@home</h2>

		<section class="minimized" id="section-c1">
			<button class="minimize"></button>
			<h3><strong>@1:</strong> convertTextToNumber</h3>

			<p>
				Schrijf een functie convertTextToNumber($text), waarbij dit een mogelijk resultaat kan zijn:
			</p>

<div class="code-container">
<p>convertTextToNumber('een;vier;zes;zeven') => 1467</p>
</div>

			<section class="results-container">
				<p>
					De text, <span id="input-c1-textToConvert" data-value="een;vier;zes;zeven"></span>, geconverteerd naar een getal is: <span id="result-c1"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-c2">
			<button class="minimize"></button>
			<h3><strong>@2:</strong> Fibonacci</h3>

			<p>
				Schrijf een functie die n termen van de Fibonacci-reeks berekent.
				De <a href="https://nl.wikipedia.org/wiki/Rij_van_Fibonacci">Fibonacci-reeks</a> is een reeks getallen waarbij elk getal de som is van de twee voorgaande getallen. De reeks begint met 0 en 1.
			</p>

<div class="code-container">
<p>fibonacci(10) => 0, 1, 1, 2, 3, 5, 8, 13, 21, 34;</p>
</div>

			<section class="results-container">
				<p>
					De fibonacci reeks tot de <span id="result-c2-a" data-value="10">...</span><sup>de</sup> term: <span id="result-c2-b"></span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-c3">
			<button class="minimize"></button>
			<h3><strong>@3:</strong> Veelvouden</h3>

			<p>
				Schrijf een functie die je vertelt of een gegeven integer een veelvoud is van 2.
				Indien dit niet het geval is, geef het veelvoud van 2 dat er het dichtste bij ligt.
				Schijf er ook bij tot de hoeveelste macht het is.
			</p>

<div class="code-container">
<p>veelvoud(64) => 64 is een veelvoud van 2, 2^6
veelvoud(13) => 13 is geen veelvoud van 2, het dichtste veelvoud is 16, 2^4</p>
</div>

			<section class="results-container">
				<p>
					Get getal <span id="result-c3-a" data-value="127">...</span> veelvoud van 2, <span id="result-c3-b">...</span>
				</p>
			</section>
			<hr>
		</section>
	</article>
</body>

<script src="{{ asset('js/init-m1.js') }}"></script>

</html>
