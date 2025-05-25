<?php
/**
 * Template Name: Algemene Voorwaarden
 */

get_header();
?>

<style>
.algemene-voorwaarden {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    line-height: 1.6;
    color: #333;
}

.algemene-voorwaarden h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 30px;
    text-align: center;
    border-bottom: 3px solid #3498db;
    padding-bottom: 15px;
}

.algemene-voorwaarden h2 {
    font-size: 1.5rem;
    color: #34495e;
    margin-top: 40px;
    margin-bottom: 20px;
    padding-left: 15px;
    border-left: 4px solid #3498db;
}

.algemene-voorwaarden h3 {
    font-size: 1.2rem;
    color: #2c3e50;
    margin-top: 25px;
    margin-bottom: 15px;
}

.algemene-voorwaarden p {
    margin-bottom: 15px;
    text-align: justify;
}

.algemene-voorwaarden ul, .algemene-voorwaarden ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.algemene-voorwaarden li {
    margin-bottom: 8px;
}

.algemene-voorwaarden strong {
    color: #2c3e50;
    font-weight: 600;
}

.algemene-voorwaarden hr {
    border: none;
    height: 2px;
    background: linear-gradient(to right, #3498db, #e74c3c);
    margin: 40px 0;
}

.contact-info {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 25px;
    margin-top: 40px;
}

.contact-info h3 {
    color: #2c3e50;
    margin-top: 0;
    margin-bottom: 15px;
}

.version-info {
    text-align: center;
    font-style: italic;
    color: #6c757d;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #dee2e6;
}

@media (max-width: 768px) {
    .algemene-voorwaarden {
        padding: 20px 15px;
    }
    
    .algemene-voorwaarden h1 {
        font-size: 2rem;
    }
    
    .algemene-voorwaarden h2 {
        font-size: 1.3rem;
    }
}
</style>

<div class="algemene-voorwaarden">
    <?php
    // Include Parsedown.
    require_once get_template_directory() . '/vendor/parsedown/Parsedown.php';
    $parsedown = new Parsedown();

    // Get current page slug to determine which markdown file to load
    $page_slug = get_post_field('post_name', get_post());
    
    // Determine which markdown file to load based on page slug
    if ($page_slug === 'algemene-voorwaarden-zakelijk') {
        $markdown_file = 'algemene_voorwaarden_b2b.md';
        $page_type = 'zakelijk';
    } elseif ($page_slug === 'algemene-voorwaarden-consument') {
        $markdown_file = 'algemene_voorwaarden_b2c.md';
        $page_type = 'consument';
    } else {
        // Fallback for other pages
        $markdown_file = 'algemene_voorwaarden_b2c.md';
        $page_type = 'consument';
    }

    // Get the content of the Markdown file.
    $markdown_file_path = get_template_directory() . '/docs/' . $markdown_file;
    if (file_exists($markdown_file_path)) {
        $markdown_content = file_get_contents($markdown_file_path);
        
        // Convert Markdown to HTML.
        $html_content = $parsedown->text($markdown_content);
        
        // Add special styling to contact info section
        $html_content = str_replace(
            '<strong>Contactgegevens:</strong>',
            '<div class="contact-info"><h3>Contactgegevens:</h3>',
            $html_content
        );
        
        // Close contact info div before version info
        $html_content = str_replace(
            '<strong>Versie: mei 2025</strong>',
            '</div><div class="version-info"><strong>Versie: mei 2025</strong>',
            $html_content
        );
        
        // Close version info div at the end
        $html_content .= '</div>';
        
        echo $html_content;
    } else {
        echo '<div class="error-message">';
        echo '<h2>Fout bij laden</h2>';
        echo '<p>Kon de algemene voorwaarden niet laden. Neem contact op met de beheerder.</p>';
        echo '</div>';
    }
    ?>
</div>

<?php
get_footer(); 