<?php
/**
 *Plugin Name: Pure Js - HTML - CSS
 *Description: Reads the euro/dogecoin and euro/bitcoin prices from Kraken API and prints the bid and ask prices in a table every 30 seconds.
 **/


function bootstrap_css() {
	wp_enqueue_style('bootstrap_css', 
    plugins_url('css/bootstrap.min.css', __FILE__), 
    ); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_css', 99);

function bootstrap_js() {
	wp_enqueue_script( 'bootstrap_js', 
    plugins_url('js/bootstrap.min.js', __FILE__), 
    array('jquery'), 
    ); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_js');

function prices_script_js() {
	wp_enqueue_script( 'prices_js', 
    plugins_url('js/prices_script.js', __FILE__), 
    ); 
}
add_action( 'wp_enqueue_scripts', 'prices_script_js');

function render_content()
{

    $table = '<table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Pair</th>
                    <th scope="col">Bid</th>
                    <th scope="col">Ask</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">DG/EUR</th>
                    <td id="XDGEUR-bid"></td>
                    <td id="XDGEUR-ask"></td>
                </tr>
                <tr>
                    <th scope="row">BTZ/EUR</th>
                    <td id="XXBTZEUR-bid"></td>
                    <td id="XXBTZEUR-ask"></td>
                </tr>
                </tbody>
            </table>';

    return $table;
};

add_shortcode('kraken-pricing-frontend','render_content');

?>