<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller {
    public function index() {
        $moduleList = [
            'm1' => [
                'easy' => [
                    [
                        'id' => 'e1',
                        'title' => 'Constante en Functie',
                        'descriptionList' => [
                            [
                                'tagName' => 'p',
                                'textContent' => 'Schrijf een functie met de naam berekenOppervlakteCirkel die de oppervlakte van een cirkel berekent. Deze functie moet één parameters hebben, straal. De formule voor het berekenen van de oppervlakte van een cirkel is: oppervlakte = π * straal * straal.',
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'Deze functie moet de oppervlakte van een cirkel berekenen en teruggeven.',
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De waarde van π moet een constante zijn. Deze constante moet je zelf definiëren (en je mag veronderstellen dat pi gelijk is aan 3.1415).',
                            ],
                        ],
                        'outputList' => [
                            [
                                'tagName' => 'p',
                                'textContent' => 'De oppervlakte van een cirkel met een straal van {...} is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e1-radius',
                                        'data-value' => '3',
                                        'textContent' => '3',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-output-e1-surfaceArea',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => 'e2',
                        'title' => 'Meetkunde',
                        'descriptionList' => [
                            [
                                'tagName' => 'p',
                                'textContent' => 'We bouwen verder op de functie van E1 en gaan de volgende functies toevoegen:',
                            ],
                            [
                                'tagName' => 'ul',
                                'items' => [
                                    [
                                        'tagName' => 'p',
                                        'textContent' => 'berekenOppervlakteRechthoek(zijde1, zijde2)'
                                    ],
                                    [
                                        'tagName' => 'p',
                                        'textContent' => 'berekenOppervlakteVierkant(zijde)'
                                    ],
                                    [
                                        'tagName' => 'p',
                                        'textContent' => 'berekenOppervlakteDriehoek(basis, hoogte)'
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De functie berekenOppervlakteVierkant maakt intern gebruik van de functie berekenOppervlakteRechthoek. Maak voorbeeldberekeningen gebruik makend van elk van de geschreven functies en druk de uitkomsten af, we gebruiken hiervoor echo.',
                            ],
                        ],
                        'outputList' => [
                            [
                                'tagName' => 'p',
                                'textContent' => 'De oppervlakte van een rechthoek met een zijde van lengte {...}cm en een zijde van lengte {...}cm is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e2-recSideA',
                                        'data-value' => '29',
                                        'textContent' => '29',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e2-recSideB',
                                        'data-value' => '45',
                                        'textContent' => '45',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-output-e2-rectangle',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De oppervlakte van een vierkant met een zijde van lengte {...}cm is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e2-squareSide',
                                        'data-value' => '7.5',
                                        'textContent' => '7.5',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-output-e2-square',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De oppervlakte van een driehoek met een basis van lengte {...}cm en een hoogte van lengte {...}cm is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e2-triangleBase',
                                        'data-value' => '7',
                                        'textContent' => '7',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-input-e2-triangleHeight',
                                        'data-value' => '15',
                                        'textContent' => '15',
                                    ],
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm1-output-e2-triangle',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'm2' => [
                'easy' => [
                    [
                        'id' => 'e1',
                        'title' => 'Simpele Form',
                        'descriptionList' => [
                            [
                                'tagName' => 'p',
                                'textContent' => 'Maak de file index.php. Begin met de opbouw van een geldig formulier: minstens 1 tekstveld voor de username van de gebruiker en een submit-button.',
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'Maak de file process.php. Zorg dat wanneer de submit-knop ingeduwd wordt, je hier terecht komt. Denk terug aan de lessen Web Essentials en aan het action attribuut. Dit is ook een geldige html pagina. Je output de volgende paragraaf:',
                            ],
                            [
                                'tagName' => 'div',
                                'className' => 'code-container',
                                'elements' => [
                                    [
                                        'tagName' => 'p',
                                        'textContent' => 'De username is Joske',
                                    ],
                                ],
                            ],
                        ],
                        'outputList' => [
                            [
                                'tagName' => 'form',
                                'id' => 'm2-form-e1',
                                'method' => 'post',
                                'elements' => [
                                    [
                                        'tagName' => 'label',
                                        'for' => 'm2-input-e1-username',
                                    ],
                                    [
                                        'tagName' => 'input',
                                        'type' => 'text',
                                        'title' => 'You-need-between 4 and 25 alphanumeric characters. Only letters, digits, underscores, and periods are allowed. No other characters (such as spaces or special symbols) are permitted',
                                        'id' => 'm2-input-e1-username',
                                        'placeholder' => 'Uw gebruikersnaam, bv. TomBradysLover, xX_FisterMcFiddleSticks_Xx, ...',
                                        'minlength' => '4',
                                        'maxlength' => '25',
                                        'pattern' => '^(?=.*[\w.])[\w.]{4,25}$',
                                        'required' => 'true'
                                    ],
                                    [
                                        'tagName' => 'label',
                                        'for' => 'm2-input-e1-password',
                                    ],
                                    [
                                        'tagName' => 'input',
                                        'type' => 'password',
                                        'title' => 'You need between 8 and 64 alphanumeric characters and at least: one upper case, one lower case, one digit, and one of the following special characters: !@#$%^&*',
                                        'id' => 'm2-input-e1-password',
                                        'placeholder' => 'Uw paswoord',
                                        'minlength' => '8',
                                        'maxlength' => '64',
                                        'pattern' => '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$',
                                        'required' => 'true'
                                    ],
                                    [
                                        'tagName' => 'button',
                                        'type' => 'submit',
                                        'data-action' => 'data-submission',
                                        'textContent' => 'Verstuur',
                                    ],
                                    [
                                        'tagName' => 'button',
                                        'type' => 'reset',
                                        'textContent' => 'Reset',
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De username is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm2-output-e1-username',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'Het paswoord is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm2-output-e1-password',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                            [
                                'tagName' => 'p',
                                'textContent' => 'De hash is: {...}',
                                'replacements' => [
                                    [
                                        'tagName' => 'span',
                                        'id' => 'm2-output-e1-hash',
                                        'textContent' => '...',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return view('module-page', compact('moduleList'));
    }
}
