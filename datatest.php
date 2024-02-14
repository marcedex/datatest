<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tester-test.com
 * @since             1.0.0
 * @package           Datatest
 *
 * @wordpress-plugin
 * Plugin Name:       tester test
 * Plugin URI:        https://tester.com
 * Description:       comlpemento para testar
 * Version:           1.0.0
 * Author:            marcelo mareco
 * Author URI:        https://tester-test.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       datatest
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DATATEST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-datatest-activator.php
 */
function activate_datatest() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-datatest-activator.php';
	Datatest_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-datatest-deactivator.php
 */
function deactivate_datatest() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-datatest-deactivator.php';
	Datatest_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_datatest' );
register_deactivation_hook( __FILE__, 'deactivate_datatest' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-datatest.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-datatest-shortcode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_datatest() {

	$plugin = new Datatest();
	$plugin->run();

}
run_datatest();


// Agregar el icono al menú
add_action('admin_menu', 'datatest_add_menu_icon');

function datatest_add_menu_icon() {
    // Obtener la URL del directorio del plugin
    $plugin_dir_url = plugin_dir_url(__FILE__);

    // Agregar el menú con el icono
    add_menu_page(
        'Testing Data Test!',         // Página del menú
        'DataTest',         // Título del menú
        'manage_options',   // Capacidad requerida para acceder
        'datatest_menu',    // Slug de la página
        'datatest_menu_page',// Función para mostrar la página
        $plugin_dir_url . '/includes/assets/img/test-50.png', // URL del icono
        20                  // Posición en el menú
    );
}

function datatest_menu_page() {
    // Contenido de la página del menú
    echo '<div class="wrap">';
    echo '<h2>DataTest Plugin</h2>';
    echo '<p>Bienvenido a la página de configuración de DataTest.</p>';
    // Agrega aquí cualquier contenido adicional que desees mostrar en la página del menú.
    echo '</div>';
}


// Agregar el shortcode
add_shortcode('datatest_shortcode', 'datatest_shortcode_function');

function datatest_shortcode_function($atts) {
	$site_data = array(
		'name_site' => get_bloginfo('name'),
		'url' => get_bloginfo('url'),
		'dominio' => home_url()
	);

	$redes = get_field('redes_sociales', 'options');

	/* INI: TEST DEBUGGER */
	//var_dump($redes); die();
	/* END: TEST DEBUGGER */
          
    $xxxx = $redes["facebook"];

	// Construir el contenido del shortcode
    $output = '<div class="datatest-info">';
    $output .= '<h2>' . esc_html($site_data['name_site']) . '</h2>';
    $output .= '<p>URL: ' . esc_url($site_data['url']) . '</p>';
    $output .= '<p>DOMINIO: ' . esc_url($site_data['dominio']) . '</p>';
    $output .= '<p>TEST: ' . $xxxx . '</p>';
    $output .= '</div>';



    // Contenido del shortcode
    return $output;
}



