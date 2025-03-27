<?php
if (!defined('ABSPATH')) exit;

// OpenAI API Configuration
function get_openai_api_key() {
    return defined('OPENAI_API_KEY') ? OPENAI_API_KEY : get_option('openai_api_key');
}

// Chatbot knowledge base
function get_chatbot_knowledge() {
    return array(
        "introduction" => "Hey daar! Ik ben Colin's sidekick en hier om je alles te vertellen over Colin en wat hij voor je kan betekenen. Klaar voor wat inside info?",
        "services" => array(
            "consultancy" => array(
                "description" => "Colin helpt zorginstellingen bij de digitale transformatie door ECD's slim te implementeren en te optimaliseren. Minder gedoe, meer efficiëntie!",
                "key_points" => array(
                    "Ruime ervaring in de GGZ en zorgsector.",
                    "15 jaar ervaring bij PinkRoccade Healthcare als consultant en product owner.",
                    "Expert in implementaties van EPD's en ECD's.",
                    "Hands-on begeleiding zonder onnodig gedoe.",
                    "Praktische workshops en procesoptimalisaties die echt werken."
                ),
                "contact" => "Nieuwsgierig? Stuur Colin een berichtje, hij bijt niet!"
            ),
            "ai_solutions" => array(
                "description" => "Colin maakt AI begrijpelijk en toepasbaar. Van chatbots tot data-analyse, hij vertaalt high-tech naar praktische oplossingen.",
                "key_points" => array(
                    "Praktische AI-toepassingen voor elk bedrijf.",
                    "AI die wél werkt met je bestaande systemen.",
                    "Geen nerdy taal, gewoon heldere uitleg."
                ),
                "contact" => "Wil je AI zonder hoofdpijn? Laten we praten!"
            ),
            "productowner" => array(
                "description" => "Colin verbindt business en IT als een pro. Geen vage roadmaps, maar tastbare resultaten.",
                "key_points" => array(
                    "15 jaar ervaring als product owner bij PinkRoccade Healthcare.",
                    "Sterke focus op de eindgebruiker en bedrijfsdoelen.",
                    "Expertise in zorgprocessen en planningsprocessen.",
                    "Agile aanpak zonder de buzzwords-overload."
                ),
                "contact" => "Klaar om je project naar het volgende niveau te tillen? Hit me up!"
            )
        ),
        "skills" => array(
            array(
                "skill" => "AI & Chatbots",
                "description" => "Colin bouwt slimme AI-oplossingen die écht werken, van chatbots tot data-analyse, met een focus op bruikbaarheid en impact."
            ),
            array(
                "skill" => "Procesoptimalisatie",
                "description" => "Colin weet hoe je workflows efficiënter maakt zonder dat je medewerkers het gevoel krijgen dat ze worden vervangen door robots."
            ),
            array(
                "skill" => "Agile Werken",
                "description" => "Met een Agile mindset zorgt Colin voor flexibele en resultaatgerichte implementaties, zonder de bekende Agile-bingo."
            ),
            array(
                "skill" => "Product Ownership",
                "description" => "Hij vertaalt businessbehoeften naar heldere plannen en zorgt ervoor dat iedereen op één lijn zit. (En ja, dat is een kunst op zich)."
            ),
            array(
                "skill" => "EPD- en ECD-implementaties",
                "description" => "Met jarenlange ervaring weet Colin precies hoe je een soepele overgang naar een nieuw systeem maakt, zonder stress."
            ),
            array(
                "skill" => "Technische Analyse (Crypto)",
                "description" => "Colin is niet alleen bezig met AI, maar ook met technische analyse in de cryptowereld. Grafieken en orderblocks? Daar draait hij zijn hand niet voor om."
            )
        ),
        "fun_facts" => array(
            "Colin is zelf meer een rijst-met-kip-lover, maar thuis is spaghetti de onbetwiste winnaar.",
            "Hij drinkt dagelijks 1-3 kopjes Nespresso (what else?), maar zweert dat hij er niks van voelt. 🤷‍♂️",
            "Zijn zoon Aaron speelt voetbal bij Robur en houdt van spaghetti bolognese.",
            "Colin houdt van AI en blockchain, maar hij heeft nog nooit een robot laten koken... nog niet!"
        ),
        "qa" => array(
            array(
                "question" => "Wat eet Colin het liefst?",
                "answer" => "Rijst met kip is zijn favoriet, maar als je indruk wilt maken op zijn gezin, serveer dan spaghetti en je bent de held van de avond! 🍝"
            ),
            array(
                "question" => "Heeft Colin humor?",
                "answer" => "Hij probeert het! Zijn klanten lachen… soms. Maar hij heeft een gezonde dosis zelfspot, dat scheelt."
            ),
            array(
                "question" => "Wat is Colin's superkracht?",
                "answer" => "Hij maakt complexe IT-problemen begrijpelijk en heeft een talent voor het maken van een killer spaghetti bolognese (al geeft hij dat liever niet toe)."
            ),
            array(
                "question" => "Colin in drie woorden?",
                "answer" => "Slim, pragmatisch, pastalover... of rijst-met-kip-lover eigenlijk. 😉"
            )
        ),
        "cta" => "Meer weten over Colin? Stel je vragen of bel hem, want een beller is sneller!"
    );
}

// New function to check local responses
function get_local_chatbot_response($message) {
    $json_file = dirname(dirname(dirname(__FILE__))) . '/js/chat-responses.json';
    $responses = json_decode(file_get_contents($json_file), true);
    
    // Convert message to lowercase for better matching
    $message = strtolower($message);
    
    // Check for greetings
    $greeting_patterns = ['/^(hoi|hey|hallo|hi|yo|goedemorgen|goedemiddag|goedenavond)/i'];
    foreach ($greeting_patterns as $pattern) {
        if (preg_match($pattern, $message)) {
            return $responses['greetings'][array_rand($responses['greetings'])];
        }
    }
    
    // Check topics
    foreach ($responses['topics'] as $topic => $data) {
        foreach ($data['keywords'] as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return $data['response'];
            }
        }
    }
    
    // If no match found, return null to indicate we should use OpenAI
    return null;
}

// Update the existing get_chatbot_response function
function get_chatbot_response($message) {
    // First try local responses
    $local_response = get_local_chatbot_response($message);
    if ($local_response !== null) {
        return $local_response;
    }
    
    // If no local match, use OpenAI API
    $api_key = get_openai_api_key();
    $url = 'https://api.openai.com/v1/chat/completions';
    $knowledge = get_chatbot_knowledge();

    $system_prompt = sprintf(
        "Je bent Colin's AI sidekick op ikbenlit.nl. Gebruik deze informatie over Colin en zijn diensten: %s\n\n" .
        "Richtlijnen voor je antwoorden:\n" .
        "1. Wees vriendelijk en informeel, gebruik 'je' en 'jij'\n" .
        "2. Houd antwoorden kort en to-the-point\n" .
        "3. Gebruik Colin's persoonlijkheid: pragmatisch, direct en met een vleugje humor\n" .
        "4. Verwijs bezoekers naar de contactmogelijkheden voor specifieke vragen of samenwerking\n" .
        "5. Als je iets niet weet, wees eerlijk en verwijs door naar Colin zelf",
        json_encode($knowledge, JSON_UNESCAPED_UNICODE)
    );

    $headers = array(
        'Authorization: Bearer ' . $api_key,
        'Content-Type: application/json'
    );

    $data = array(
        'model' => 'gpt-3.5-turbo',
        'messages' => array(
            array(
                'role' => 'system',
                'content' => $system_prompt
            ),
            array(
                'role' => 'user',
                'content' => $message
            )
        ),
        'max_tokens' => 150,
        'temperature' => 0.7
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        $result = json_decode($response, true);
        return $result['choices'][0]['message']['content'];
    } else {
        return 'Sorry, ik kan op dit moment niet antwoorden. Probeer het later nog eens.';
    }
}

// AJAX handlers
add_action('wp_ajax_chatbot_message', 'handle_chatbot_message');
add_action('wp_ajax_nopriv_chatbot_message', 'handle_chatbot_message');

function handle_chatbot_message() {
    $message = sanitize_text_field($_POST['message']);
    $response = get_chatbot_response($message);
    wp_send_json_success($response);
} 