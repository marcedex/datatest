<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://tester-test.com
 * @since      1.0.0
 *
 * @package    Datatest
 * @subpackage Datatest/includes
 */


/*
Plugin Name: Listar Plugins Activados
Description: Este plugin muestra una lista de los plugins activados.
*/

// Agregar el shortcode
add_shortcode('listar_plugins', 'listar_plugins_function');

function listar_plugins_function($atts) {
    // Obtener la lista de plugins activados
    $plugins_activados = get_option('active_plugins');

    // Construir el contenido del shortcode
    $output = '';
    
    if (!empty($plugins_activados)) {
        $output .= '<div class="accordion accordion-flush" id="accordionFlushExample">';
        $output .= '<div class="accordion-item">';
        $output .= '<h2 class="accordion-header" id="flush-headingOne">';
        $output .= '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">';
        $output .= 'LISTA PLUGINGS ACTIVOS';
        $output .= '</button>';
        $output .= '</h2>';
        $output .= '<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">';
        $output .= '<div class="accordion-body">';
        $output .= '<ul>';
        foreach ($plugins_activados as $plugin) {
            $output .= '<li>' . esc_html($plugin) . '</li>';
        }
        $output .= '</ul>';
    } else {
        $output .= '<p>No hay plugins activados.</p>';
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}













?>
