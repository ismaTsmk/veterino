<?php

use MailchimpTransactional\ApiClient;

/**
 * @package veterino
 * @version 1
 */
/*
Plugin Name: VeterinoFidelity
Plugin URI: https://tismatek.com/
Description: ajoute un système de carte de fidelité avec possibilité de convertir ces coupon directement depuis son espace clients
Author: Ismael Hini
Version: 1
Author URI: https://tismatek.com/
*/

// include ('wp-load.php');




// sendinblue 
// dump(__DIR__ . '/vendor/autoload.php');
// require_once(__DIR__ . '/vendor/autoload.php');
// require __DIR__.'/vendor/autoload.php';

function send_mail()
{
    require 'vendor/autoload.php';

    // require_once(__DIR__ . '/vendor/autoload.php');

    $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

    $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $credentials);

    $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
        'subject' => 'from the PHP SDK!',
        'sender' => ['name' => 'Sendinblue', 'email' => 'contact@h-vibes.fr'],
        'replyTo' => ['name' => 'Sendinblue', 'email' => 'ismaelhinitk@gmail.com'],
        'to' => [['name' => 'Max Mustermann', 'email' => 'ismaelhinitk@gmail.com']],
        'htmlContent' => '<html><body><h1>This is a transactional email {{params.bodyMessage}}</h1></body></html>',
        'params' => ['bodyMessage' => 'made just for you!']
    ]);

    echo "je suis ici";

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        dump($result);
        print_r($result);
        echo "je suis ici";
    } catch (Exception $e) {
        echo "fuck";
        echo "je suis ici";

        echo $e->getMessage(), PHP_EOL;
    }
}

//find e sendiblue


//POUR AJOUTER UN MENU A LA PAGE MON COMPTE






function my_account_rename_items($menu_items)
{
    // $menu_items['loyalty'] = __('My Loyalty', 'my_text_domain');
    $my_items = array(
        //  endpoint   => label
        'loyalty' => __('Points de fidélitées', 'woocommerce'),
    );
    $my_items = array_slice($menu_items, 0, 1, true) +
        $my_items +
        array_slice($menu_items, 1, count($menu_items), true);
    return $my_items;
}

add_filter('woocommerce_account_menu_items', 'my_account_rename_items');


function my_account_new_endpoints()
{
    add_rewrite_endpoint('loyalty', EP_PERMALINK | EP_PAGES);
}
add_action('init', 'my_account_new_endpoints');


function my_loyalty_endpoint_content()
{
    get_template_part('woocommerce/myaccount/loyalty');
}
add_action('woocommerce_account_loyalty_endpoint', 'my_loyalty_endpoint_content');



// FIN DE LAJOUT DE LITEM SUR LA NAVIGUATION DU COMPTE





// function woo_title_order_received( $title, $id ) {
// 		$title = "Thank you for your order! :)";
// 	return $title;
// }
// add_filter( 'the_title', 'woo_title_order_received', 10, 2 );

add_filter('woocommerce_thankyou_order_received_text', 'woo_change_order_received_text', 10, 2);

function woo_change_order_received_text($str, $order)
{
    $points =  get_user_meta($order->data['customer_id'], "points")[0];
    $new_str = 'Suite à votre commande vous avez maintenant <strong class="text-success">' . $points . '  points de fidelitées</strong>  ';
    ($points > 49) && $new_str .= "<br/> Vous pouvez dès a présent génerer un code promo pour vos prochains achats";
    // dump([
    //     "customer_id" => $order->data['customer_id'],
    //     "order"=>$order->data['customer_id']
    // ]);
    print_r($order->data);
    echo "<br> okeyy <br>";
    print_r($order);

    return $new_str;
}

function createPoints($order_id)
{
    // dump($data);
    $order = new WC_Order($order_id);
    $total = intval($order->total);
    $customer_id = $order->customer_id;
    $currents_points = (int) get_user_meta($customer_id, "points")[0];
    $newPoints = (int) $currents_points + (int) floor($total * 0.05);
    // dd([
    //     "newPoints = " =>  $newPoints,
    //     "currents_points = " =>$currents_points,
    //     "floor() = " => floor($total*0.05)
    // ]);
    update_user_meta($customer_id, "points", $newPoints);
}

add_action('woocommerce_checkout_order_processed', 'createPoints', 10, 1);


// This just echoes the chosen line, we'll position it later.
function hello_dolly()
{
    // orderCoupon();
    global $woocommerce;

    $current_user = wp_get_current_user();

    $points = get_user_meta($current_user->ID, "points");
    $other_user = get_users();
    $customer_country = $woocommerce->customer->get_billing_country();



    send_mail();

    echo "it's me ";

    // var_dump($points);
    // dump("eeeee");

}

// Now we set that function up to execute when the admin_notices action is called.
add_action('wp_footer', 'hello_dolly');




function filter_user($user)
{
    echo "okeyy manyy";
    return sprintf(
        $user
    );
}

add_filter('validate_username  ', 'filter_user');


// We need some CSS to position the paragraph.
function dolly_css()
{
    echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'dolly_css');



/**
 * Add the field to the checkout
 */
// add_action('woocommerce_after_order_notes', 'my_custom_checkout_field');

function my_custom_checkout_field($checkout)
{

    echo '<div id="my_custom_checkout_field"><h2>' . __('Code Promo') . '</h2>';

    woocommerce_form_field('my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Entrer un code promo maintenant'),
        'placeholder'   => __('ex  : azerty9874'),
        'required'   => "true",

    ), $checkout->get_value('promo_code'));

    echo '</div>';
}



// endpoint add 
//http://localhost/veterino/wp-json/myplugin/v1/author
add_action('rest_api_init', function () {
    register_rest_route('generate', '/coupon', array(
        'methods' => 'GET',
        'callback' => 'orderCoupon',
    ));
});

// endpoint add 
//http://localhost/veterino/wp-json/myplugin/v1/author
add_action('rest_api_init', function () {
    register_rest_route('generate', '/coupon', array(
        'methods' => 'POST',
        'callback' => 'orderCoupon',
    ));
});


function orderCoupon(WP_REST_Request $request)
{
    $data = $request->get_params();
    $percent_choice = intval($data["points"]);
    $user_email = $data["user_email"];
    // wp_send_json($user_email);
    // $current_user = get_userdata(1);
    $current_user = get_user_by("email",$user_email);
    $user_name = $current_user->user_login;
    $user_id = $current_user->ID;
    $user_points =  intval(get_user_meta($user_id, "points")[0]);
    // wp_send_json($data);


    if ($percent_choice > $user_points   ) {
        
        wp_send_json(["response" => "ko", "message" => "erreur renconter pourcentage superieur au nombre de points acquis","mail"=>$user_email,"user_points"=>$user_points,"percent_choice"=>$percent_choice]);

    } elseif ($percent_choice > 100) {
        wp_send_json(["response" => "ko", "message" => "une erreur est survenue, le pourcentage dépasse la limite maximale autoriser"]);

    } elseif ($user_points < 50) {
        wp_send_json(["response" => "ko", "message" => "Ils vous faut au minimum 50 points pour pouvoir généerer un code promo","user_points"=>$user_points]);
    }



    wp_send_mail();

    $newPoints =$user_points - $percent_choice;

    $dt = new DateTime('now');
    $dt->add(new DateInterval('P1Y'));
    $endDate = $dt->format('Y-m-d H:i:s');

    $time = time() + (60 * 60 * 24 * 365);
    // $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($StaringDate)) . " + 1 year"));
    // var_dump($current_user->display_name . $time);
    // var_dump($time);
    $coupon = new WC_Coupon();
    $code =  strval($user_name . substr($time, -5));
    // wp_send_json($code);
    $coupon->set_code($code); // Coupon code
    $coupon->set_amount($percent_choice); // Discount amount
    $coupon->set_discount_type("percent"); // Discount amount
    $coupon->set_date_expires($time); // Discount amount
    $coupon->set_usage_limit_per_user(1); // Discount amount
    $coupon->set_usage_limit(1); // Discount amount
    $coupon->set_individual_use(true); // Discount amount
    $coupon->set_maximum_amount(200); // Discount amount


    $coupon->set_description("coupon generer automatiquement par le clients grace à ces points de fidelités"); // Discount amount

    $message = [
        "from_email" => "contact@h-vibes.fr",
        "subject" => "test transac",
        "text" => "Welcome to Mailchimp Transactional!, votre coupon est le suivant : " . $current_user->display_name . $time,
        "to" => [
            [
                "email" => "ismaelhinitk@gmail.com",
                "type" => "to"
            ]
        ]
    ];

    // run($message);
    $response = $coupon->save();
    if ($coupon->save() ) {
        update_user_meta($user_id, "points", $newPoints);
    }else wp_send_json(["response" => "ko", "message" => "le coupon n'a pas pu etre générer suite a une erreur inconue"]);



    $result = [
        "response" => "success",
        "coupon_code" => $code,
        "date_expiration" => $time,
        "newPoints" =>  $newPoints,
        "currents_points" => $user_points,
        "message"=> "code promo générer avec succès"
    ];

    wp_send_json($result);
}

function run($message)
{
    require 'vendor/autoload.php';

    try {
        $mailchimp = new ApiClient();
        $mailchimp->setApiKey('nLz0KM-YdD4JUY5JYswV1w');
        $response = $mailchimp->messages->send(["message" => $message]);
        print_r($response);
    } catch (Error $e) {
        echo 'Error: ', $e->getMessage(), "\n";
    }
}



function wp_send_mail($mail = "titann2.15@outlook.com")
{
    $to = $mail;
    $subject = 'The subject';
    $body = 'The email body content';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);
}
