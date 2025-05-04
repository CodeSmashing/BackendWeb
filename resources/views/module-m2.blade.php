<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Module 2</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
	<input type="hidden" id="assignment" value="e2" disabled>
	<aside class="hidden">
		<ul>
			<li>
				<a href="#section-e1"><strong>E1:</strong> Simpele Form</a>
			</li>
			<li>
				<a href="#section-e2"><strong>E2:</strong> Simpele Form 2</a>
			</li>
			<li>
				<a href="#section-e3"><strong>E3:</strong> Simpele Cookies</a>
			</li>
			<li>
				<a href="#section-e4"><strong>E4:</strong> Simpele Cookies 2</a>
			</li>
			<li>
				<a href="#section-m1"><strong>M1:</strong> Formulier over meerdere pages</a>
			</li>
			<li>
				<a href="#section-m2"><strong>M2:</strong> Sessions</a>
			</li>
			<li>
				<a href="#section-m3"><strong>M3:</strong> Files</a>
			</li>
			<li>
				<a href="#section-h1"><strong>H1:</strong> Simpele Login</a>
			</li>
			<li>
				<a href="#section-c1"><strong>C1:</strong> Grote Form</a>
			</li>
		</ul>
	</aside>

	<h1>Module 2 exercises</h1>

	<article class="minimized" id="m2-easy">
		<button class="minimize"></button>
		<h2>Easy</h2>

		<section class="minimized" id="section-e1">
			<button class="minimize"></button>
			<h3><strong>E1:</strong> Simpele Form</h3>

			<p>
				Maak de file index.php. Begin met de opbouw van een geldig formulier: minstens 1 tekstveld voor de username van de gebruiker en een submit-button.
			</p>

			<p>
				Maak de file process.php. Zorg dat wanneer de submit-knop ingeduwd wordt, je hier terecht komt. Denk terug aan de lessen Web Essentials en aan het action attribuut. Dit is ook een geldige html pagina. Je output de volgende paragraaf:
			</p>

<div class="code-container">
<p>De username is Joske</p>
</div>

			<section class="results-container">
				<form id="form-e1" method="post">
					<label for="input-e1-username">Gebruikersnaam:</label>
					<input type="text" title="You need between 4 and 25 alphanumeric characters. Only letters, digits, underscores, and periods are allowed. No other characters (such as spaces or special symbols) are permitted" id="input-e1-username" placeholder="Uw gebruikersnaam, bv. TomBradysLover" minlength="4" maxlength="25" pattern="^(?=.*[\w.])[\w.]{4,25}$" required>

					<label for="input-e1-password">Password:</label>
					<input type="password" title="You need between 8 and 64 alphanumeric characters and at least: one upper case, one lower case, one digit, and one of the following special characters: !@#$%^&*" id="input-e1-password" placeholder="Uw paswoord" minlength="8" maxlength="64" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$" required>

					<button type="submit" data-action="data-submission">Verstuur</button>
					<button type="reset">Reset</button>
				</form>

				<p>
					De username is: <span id="output-e1-username">...</span>
				</p>
				<p>
					Het paswoord is: <span id="output-e1-password">...</span>
				</p>
				<p>
					De hash is: <span id="output-e1-hash">...</span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e2">
			<button class="minimize"></button>
			<h3><strong>E2:</strong> Simpele Form 2</h3>

			<p>
				Kopieer de index pagina van de vorige oefening. Zorg dat je nu hetzelfde process opnieuw na maakt met de volgende wijzigingen:
			</p>

			<ul>
				<li>
					<p>
						Voeg 1 extra tekstveld toe: Country
					</p>
				</li>
				<li>
					<p>
						Alle code, inclusief de succesboodschap, bevindt zich in de index.php pagina
					</p>
				</li>
				<li>
					<p>
						Voeg validatie toe:
					</p>
				</li>
				<ul>
					<li>
						<p>
							Controleer of beide velden ingevuld zijn.
						</p>
					</li>
					<li>
						<p>
							De lengte van de username moet minstens 6 karakters zijn.
						</p>
					</li>
				</ul>
			</ul>

			<p>
				Als alle validatie slaagt, tonen we enkel de succesboodschap met de data. Als de validatie niet slaagt tonen we opnieuw het formulier, met een bijhorende foutboodschap.
			</p>

			<section class="results-container">
				<form id="form-e2" method="post">
					<label for="input-e2-username">Gebruikersnaam:</label>
					<input type="text" title="You need between 4 and 25 alphanumeric characters. Only letters, digits, underscores, and periods are allowed. No other characters (such as spaces or special symbols) are permitted" id="input-e2-username" placeholder="Uw gebruikersnaam, bv. TomBradysLover" minlength="4" maxlength="25" pattern="^(?=.*[\w.])[\w.]{4,25}$" required>

					<label for="input-e2-password">Password:</label>
					<input type="password" title="You need between 8 and 64 alphanumeric characters and at least: one upper case, one lower case, one digit, and one of the following special characters: !@#$%^&*" id="input-e2-password" placeholder="Uw paswoord" minlength="8" maxlength="64" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$" required>

					<label for="input-e2-country">Land:</label>
					<input type="text" title="Vul een geldige landnaam in (alleen letters, spaties, streepjes en apostrof, 2-40 tekens)" id="input-e2-country" placeholder="Uw land van afkomst" pattern="^[A-Za-zÀ-ÿ\s\-']{2,40}$">

					<button type="submit" data-action="data-submission">Verstuur</button>
					<button type="reset">Reset</button>
				</form>

				<p>
					De username is: <span id="output-e2-username">...</span>
				</p>
				<p>
					Het paswoord is: <span id="output-e2-password">...</span>
				</p>
				<p>
					De hash is: <span id="output-e2-hash">...</span>
				</p>
				<p>
					Het land is: <span id="output-e2-country">...</span>
				</p>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e3">
			<button class="minimize"></button>
			<h3><strong>E3:</strong> Simpele Cookies</h3>

			<p>
				Maak een eenvoudige web applicatie met 2 pagina's:
			</p>

			<ul>
				<li>
					<p>
						Homepage
					</p>
				</li>
				<ul>
					<li>
						<p>
							Toont een welkomsttekst (verzin er zelf één) in één van de volgende 3 talen:
						</p>
					</li>
					<ul>
						<li>
							<p>
								Nederlands
							</p>
						</li>
						<li>
							<p>
								Frans
							</p>
						</li>
						<li>
							<p>
								Engels
							</p>
						</li>
					</ul>
					<li>
						<p>
							De welkomsttekst wordt getoond in de taal die werd ingesteld door de gebruiker. De instellingen worden opgeslagen in een cookie dat via het instellingen scherm kan worden aangemaakt. Indien er geen cookie werd aangemaakt, is de default taal Nederlands.
						</p>
					</li>
					<li>
						<p>
							Bevat een link naar instellingen pagina
						</p>
					</li>
				</ul>
				<li>
					<p>
						Instellingen
					</p>
				</li>
				<ul>
					<li>
						<p>
							Bevat een formulier waarmee de gebruiker een voorkeurstaal kan instellen(Nederlands, Frans of Engels). De keuze wordt gemaakt door middel van radiobuttons.
						</p>
					</li>
					<li>
						<p>
							Wanneer een voorkeurstaal wordt aangeduid, wordt deze preferentie opgeslagen in een tijdelijke cookie.
						</p>
					</li>
				</ul>
			</ul>

			<p>
				Test de site uit door een voorkeurstaal te kiezen. Sluit daarna je browser af. Werd de voorkeurstaal onthouden? Waarom (niet)?
			</p>

			<section class="results-container">
				<span id="output-e3"></span>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-e4">
			<button class="minimize"></button>
			<h3><strong>E4:</strong> Simpele Cookies 2</h3>

			<p>
				Kopieer de oplossing van E3 en breid ze uit met de volgende functionaliteiten:
			</p>

			<ul>
				<li>
					<p>
						Homepage
					</p>
				</li>
				<ul>
					<li>
						<p>
							De welkomsttekst wordt nog steeds weergegeven in de ingestelde taal, maar bevat nu echte naam van de bezoeker indien die gekend is (vb: “Welkom op de site Owen”). Indien de naam van de bezoeker niet gekend is, wordt de bezoeker aangesproken als “bezoeker” (vb: “Welkom bezoeker”). De naam van de bezoeker wordt bijgehouden in een cookie die wordt ingesteld via het instellingenscherm.
						</p>
					</li>
					<li>
						<p>
							De gebruiker heeft de mogelijkheid om het homescherm te customizen qua uitzicht. Via het instellingen scherm kan de gebruiker een kleur kiezen. Deze kleur zal gebruikt worden om de achtergrond van het homescherm mee te vullen. Indien geen kleur werd ingesteld door de gebruiker, is de achtergrondkleur wit. De ingestelde kleur wordt bijgehouden in een cookie die wordt ingesteld via het instellingenscherm.
						</p>
					</li>
					<li>
						<p>
							Het huidige tijdstip wordt weergegeven op het scherm (moet enkel refreshen bij het herladen van de pagina => server side code, niet client side). Aangezien de gebruikers van onze website verspreid zitten over heel de wereld, willen we de voor de gebruiker relevante lokale tijd laten zien. Het weergegeven tijdstip houdt rekening met de tijdszone die de gebruiker heeft ingesteld.
						</p>
					</li>
				</ul>
				<li>
					<p>
						Instellingen
					</p>
				</li>
				<ul>
					<li>
						<p>
							Er wordt een tekstveld toegevoegd waarin de gebruiker zijn/haar naam kan invullen. Deze informatie wordt opgeslagen in een tijdelijke cookie.
						</p>
					</li>
					<li>
						<p>
							Er wordt een keuzemenu (listbox) aangeboden waaruit de gebruiker eenachtergrondkleur voor de website kan kiezen. Deze informatie wordt opgeslagen ineen semipermanente cookie die voor een week wordt bijgehouden.
						</p>
					</li>
					<li>
						<p>
							Er wordt een keuzemenu (dropdown) aangeboden waaruit de gebruiker een tijdszonekan kiezen voor de website. Deze informatie wordt opgeslagen in eensemipermanente cookie die tot 31 december dit jaar, 23u59 wordt bijgehouden.
						</p>
					</li>
				</ul>
			</ul>

			<p>
				Test de applicatie uit door enkele instellingen te maken. Sluit daarna je browser af. Welke gegevens werden onthouden? Welke niet? Waarom (niet)? Wis de cookies voor de web applicatie uit je browser en probeer nog eens, wat is het resultaat?
			</p>

			<section class="results-container">
				<span id="output-e4"></span>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m2-medium">
		<button class="minimize"></button>
		<h2>Medium</h2>

		<section class="minimized" id="section-m1">
			<button class="minimize"></button>
			<h3><strong>M1:</strong> Formulier over meerdere pages</h3>

			<p>
				Kopieer de index pagina van de vorige oefening. Zorg ervoor dat wanneer alle validatie klopt, je doorgestuurd wordt naar je profiel pagina (profile.php). Anders navigeren we naar forbidden.php. De inhoud voor deze twee pagina's is als volgt:
			</p>

			<ul>
				<li>
					<p>
						<strong>profile.php:</strong> Toon een welkom boodschap. Data doorgeven is niet nodig.
					</p>
				</li>
				<li>
					<p>
						<strong>forbidden.php:</strong> Voorzie een tekstje dat meedeelt dat de validatie niet gelukt is. Voorzie ook een link om terug te keren naar de indexpagina.
					</p>
				</li>
			</ul>

			<p>
				Tip: navigatie in responses wordt bepaalt in de header. Zoek in de documentatie hoe je navigeert naar andere pagina's.
			</p>

			<section class="results-container">
				<span id="output-m1"></span>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m2">
			<button class="minimize"></button>
			<h3><strong>M2:</strong> Sessions</h3>

			<p>
				Kopieer de oplossing van E3 en pas ze aan.
			</p>

			<p>
				Maak vanaf nu gebruik van Sessions ipv Cookies om je gegevens op de slaan. Test de webapplicatie uit en zorg ervoor dat alle functionaliteiten nog werken.
			</p>

			<p>
				Zijn er nog steeds cookies aanwezig voor je applicatie?
			</p>

			<section class="results-container">
				<span id="output-m2"></span>
			</section>
			<hr>
		</section>

		<section class="minimized" id="section-m3">
			<button class="minimize"></button>
			<h3><strong>M3:</strong> Files</h3>

			<p>
				Maak een klein nieuw formulier (form.php) met 3 velden:
			</p>

			<ul>
				<li>
					<p>
						Titel: tekst invoerveld
					</p>
				</li>
				<li>
					<p>
						Volledige bestandsnaam: tekst invoerveld
					</p>
				</li>
				<li>
					<p>
						Profielfoto: bestandsupload
					</p>
				</li>
			</ul>

			<p>
				Maak een nieuwe pagina (upload.php). Als je alles invult op het formulier, navigeer je naar upload.php. Hier controleer je of de file de extensie 'png' of 'jpg' heeft. Indien dit correct is, verplaats je de file naar een folder 'uploads', op dezelfde locatie als je andere PHP files. Indien dit een fout bestandstype is, keer terug naar het formulier met een foutboodschap.
			</p>

			<p>
				Tip: De geüploade file bevindt zich in een specifieke superglobale $_FILES. Kijk op de officiële documentatie eens naar move_uploaded_file.
			</p>

			<section class="results-container">
				<span id="output-m3"></span>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m2-hard">
		<button class="minimize"></button>
		<h2>Hard</h2>

		<section class="minimized" id="section-h1">
			<button class="minimize"></button>
			<h3><strong>H1:</strong> Simpele Login</h3>

			<p>
				Zorg voor enkele 'beveiligde' pagina's met behulp van sessies. Maak enkele verschillende pagina's aan:
			</p>

			<ul>
				<li>
					<p>
						<strong>login.php:</strong> Deze pagina wordt gebruikt om te kunnen inloggen. Ze toont een formulier waar de gebruiker een gebruikersnaam en wachtwoord kan ingeven. Wanneer dit is gebeurd, moet je ervoor zorgen dat de gebruiker gedurende de sessie steeds op de geheime pagina's kan. De ingegeven gebruikersnaam en wachtwoord worden vergeleken met een hardcoded gebruikersnaam en wachtwoord om de authenticatie te doen slagen. Wanneer de loginpagina wordt opgevraagd wanneer de gebruiker reeds is ingelogd, wordt de pagina geheim1.php automatisch getoond.
					</p>
				</li>
				<li>
					<p>
						<strong>geheim1.php:</strong> Een eerste pagina dat niet toegankelijk mag zijn als de gebruiker zich niet eerst ingelogd heeft. Indien niet ingelogd, toon je de pagina login.php aan de gebruiker.
					</p>
				</li>
				<li>
					<p>
						<strong>geheim2.php:</strong> Een tweede pagina dat niet toegankelijk mag zijn als de gebruiker zich niet heeft ingelogd. Indien niet ingelogd, toon je de pagina login.php aan de gebruiker.
					</p>
				</li>
				<li>
					<p>
						<strong>logout.php:</strong> Deze pagina gaat de sessie verwijderen zodat de gebruiker weer eerst moet inloggen om aan de twee beveiligde pagina's te kunnen.
					</p>
				</li>
			</ul>

			<p>
				Enkele dingen die je kan uitproberen wanneer de oefening werkt:
			</p>

			<ul>
				<li>
					<p>
						Surf naar een andere pagina, nadat je bent ingelogd en probeer dan nadien direct de beveiligde pagina's te lezen.
					</p>
				</li>
				<li>
					<p>
						Sluit de browser nadat je bent ingelogd en probeer opnieuw de beveiligde pagina's te bekijken.
					</p>
				</li>
				<li>
					<p>
						Log uit en probeer met de backtoets van de browser terug naar de beveiligde pagina te surfen.
					</p>
				</li>
			</ul>

			<section class="results-container">
				<span id="output-h1"></span>
			</section>
			<hr>
		</section>
	</article>

	<article class="minimized" id="m2-challenge">
		<button class="minimize"></button>
		<h2>Challenge@home</h2>

		<section class="minimized" id="section-c1">
			<button class="minimize"></button>
			<h3><strong>@1:</strong> Grote Form</h3>

			<p>
				We combineren alle voorgaande kennis en maken 1 groot formulier met verschillende soorten input. Ditmaal met dynamische content (radiobuttons/checkboxes), meer validatie en degelijke opslag.
			</p>

			<p>
				We maken 4 files: index.php, form.php, validation.php en signup.php
			</p>

			<p>
				<strong>index.php:</strong> Pagina die alles stuurt. Algemene logica is als volgt:
			</p>

			<ul>
				<li>
					<p>
						Indien we de pagina voor het eerst bezoeken, tonen we het formulier.
					</p>
				</li>
				<li>
					<p>
						Indien we een post request krijgen, valideren we de formulier data.
					</p>
				</li>
				<ul>
					<li>
						<p>
							TEST of we het correcte formulier binnen krijgen. Gebruik een extra hidden field. Gebruik alle functies uit de validation.php file.
						</p>
					</li>
					<li>
						<p>
							Als de validatie lukt, navigeren we naar de signup.php pagina. Dit is het eindpunt met een simpele welkomstboodschap.
						</p>
					</li>
					<li>
						<p>
							Als de validatie faalt, tonen we alle specifieke errors om aan te tonen WELKE validaties niet werkten.
						</p>
					</li>
				</ul>
			</ul>

			<p>
				<strong>form.php:</strong> Bevat ENKEL de volgende elementen. Dit is GEEN volwaardige html pagina. Daarvoor dient index.php. (Kijk eens naar include())
			</p>

			<ul>
				<li>
					<p>
						HTML Titel: Food, Drinks and Boardgames!
					</p>
				</li>
				<li>
					<p>
						HTML Paragraaf: Sign up of our monthly sessions of after-work activities.
					</p>
				</li>
				<li>
					<p>
						HTML Form:
					</p>
				</li>
				<ul>
					<li>
						<p>
							Fullname - text
						</p>
					</li>
					<li>
						<p>
							Student email - text
						</p>
					</li>
					<li>
						<p>
							Date of birth - 3 number fields (day/month/year)
						</p>
					</li>
					<li>
						<p>
							City - text
						</p>
					</li>
					<li>
						<p>
							StudentID - number field
						</p>
					</li>
					<li>
						<p>
							Picture of StudentID: fileupload
						</p>
					</li>
					<li>
						<p>
							Education: dropdown
						</p>
					</li>
					<ul>
						<li>
							<p>
								Haal de waarden uit een array in PHP. De waarden zijn de volgende:
							</p>
						</li>
						<li>
							<p>
								Toegepaste Informatica
							</p>
						</li>
						<li>
							<p>
								Multimedia en Communicatietechnologie
							</p>
						</li>
						<li>
							<p>
								Graduaat Programmeren
							</p>
						</li>
						<li>
							<p>
								Graduaat Netwerken
							</p>
						</li>
						<li>
							<p>
								Postgraduaat A.I.
							</p>
						</li>
						<li>
							<p>
								Postgraduaat Coding
							</p>
						</li>
					</ul>
					<li>
						<p>
							Interests - list of checkboxes
						</p>
					</li>
					<ul>
						<li>
							<p>
								Haal de waarden uit een array. Voeg minstens 3 topics toe waar je een afterwork van zou willen zien. Bv: Boardgames, DnD, Poker, Hackaton,...
							</p>
						</li>
					</ul>
					<li>
						<p>
							Food - 2 radiobuttons
						</p>
					</li>
					<ul>
						<li>
							<p>
								'I would like there to be the option to order food for the evening'
							</p>
						</li>
						<li>
							<p>
								'I will bring my own/Do not need food'
							</p>
						</li>
					</ul>
					<li>
						<p>
							Submit button
						</p>
					</li>
				</ul>
			</ul>

			<p>
				We posten naar dezelfde pagina -> index.php. Dit is de plek waar het formulier ingeladen en gevalideerd wordt.
			</p>

			<p>
				<strong>validation.php:</strong> Bevat alle validaties. Geeft specifieke errormessages terug per validatie. De volgende validaties dienen te gebeuren op het formulier, aan jou om deze te structureren in de nodige functies.
			</p>

			<ul>
				<li>
					<p>
						Verplichte velden: alles behalve City, Interests.
					</p>
				</li>
				<li>
					<p>
						Geldige datum: Date of Birth
					</p>
				</li>
				<li>
					<p>
						StudentID: Geldig studentenid is 9 cijfers lang. En het start altijd met een geldig schooljaar. De range die we toelaten is 5 jaar terug: 2014-2019
					</p>
				</li>
				<li>
					<p>
						Geldige extensie: Picture of StudentID. Mag enkel jpg, png of pdf zijn (voor een scan).
					</p>
				</li>
				<li>
					<p>
						Filesize: Picture of StudentID. De file mag maximum 25Mb groot zijn.
					</p>
				</li>
			</ul>

			<section class="results-container">
				<span id="output-c1"></span>
			</section>
			<hr>
		</section>
	</article>
</body>

<script src="{{ asset('js/init-m2.js') }}"></script>

</html>
