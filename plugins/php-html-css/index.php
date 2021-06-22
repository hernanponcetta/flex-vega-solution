<?php
/**
 *Plugin Name: Pure PHP - HTML - CSS
 *Description: Reads the euro/dogecoin and euro/bitcoin prices from Kraken API and prints the bid and ask prices in a table.
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

function render_content()
{
    function fetch_pair($pair) {

        $url = "https://api.kraken.com/0/public/Ticker?pair=${pair}";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    $XDGEUR = fetch_pair('XDGEUR');
    $XXBTZEUR = fetch_pair('XXBTZEUR');

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
                    <td id="XDGEUR-bid">'.$XDGEUR['result']['XDGEUR']['b'][0].'</td>
                    <td id="XDGEUR-ask">'.$XDGEUR['result']['XDGEUR']['a'][0].'</td>
                </tr>
                <tr>
                    <th scope="row">BTZ/EUR</th>
                    <td id="XXBTZEUR-bid">'.$XXBTZEUR['result']['XXBTZEUR']['b'][0].'</td>
                    <td id="XXBTZEUR-ask">'.$XXBTZEUR['result']['XXBTZEUR']['a'][0].'</td>
                </tr>
                </tbody>
            </table>';

    return $table;
};

add_shortcode('kraken-pricing-backend','render_content');

 ?>