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

/**
 * fonction qui change le texte par default de confirmation de commandes
 */

function woo_change_order_received_text($str, $order)
{
    // dd($order->get_customer_id());
    $points =  get_user_meta($order->get_customer_id(), "points")[0];
    $new_str = 'Suite à votre commande vous avez maintenant <strong class="text-success">' . $points . '  points de fidelitées</strong>  ';
    ($points > 49) && $new_str .= "<br/> Vous pouvez dès à présent générer un code promo pour vos prochains achats.";

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
    update_user_meta($customer_id, "points", $newPoints);
}
/**
 * Au moment du paiement reussi, pendant le process de redirection, ajoute les points de fidelitées 
 * à l'utilisateurs  en respectant les contraintes de 5 % arroendis à l'entier inferieur
 */
add_action('woocommerce_checkout_order_processed', 'createPoints', 10, 1);


/**
 * test fonction sur footer 
 */
function hello_dolly()
{
    // orderCoupon();
    // global $woocommerce;

    // $current_user = wp_get_current_user();

    // $points = get_user_meta($current_user->ID, "points");
    // $other_user = get_users();
    // $customer_country = $woocommerce->customer->get_billing_country();

    send_mail();
    echo "it's me ";

}
add_action('wp_footer', 'hello_dolly');



/**
 * ajout du endpoint en post pour la requette ajax de création de coupon de reduction 
 * url => http://localhost/veterino/generate/coupon
 */
add_action('rest_api_init', function () {
    register_rest_route('generate', '/coupon', array(
        'methods' => 'POST',
        'callback' => 'orderCoupon',
    ));
});

/**
 * génere un code promo et reduis les points de fidelité en fonction du pourcent choisis
 * les code promo ont une limite de 100 %, pour un maximum de 200 euro d'achat, ce qui veut dire que malgrès le fait que il peuvent générer un code de 100 %; sur 200 euro max
 * cela equivaut a une réduction de 5 % car il lui faudrait avoir effectuer 2000 € d'achat pour atteindre les 100 points de fidelitées 
 */
function orderCoupon(WP_REST_Request $request)
{
    $data = $request->get_params();
    $percent_choice = intval($data["points"]);
    $user_email = $data["user_email"];
    $user_id = $data["user_id"];

    // wp_send_json($user_email);
    // $current_user = get_userdata(1);
    // $current_user = get_user_by("email",$user_email);
    $current_user = get_user_by("id",$user_id);

    if (!$current_user) {
        wp_send_json(["response" => "ko", "message" => "Erreur rencontrer, réessayer"]);
    }

    $user_name = $current_user->user_login;
    $user_id = $current_user->ID;
    $user_points =  intval(get_user_meta($user_id, "points")[0]);
    // wp_send_json($data);


    if ($percent_choice > $user_points   ) {
        
        wp_send_json(["response" => "ko", "message" => "Erreur rencontrer, pourcentage supérieur au nombre de points acquis","mail"=>$user_email,"user_points"=>$user_points,"percent_choice"=>$percent_choice]);

    } elseif ($percent_choice > 100) {
        wp_send_json(["response" => "ko", "message" => "Une erreur est survenue, le pourcentage dépasse la limite maximale autorisée."]);

    } elseif ($user_points < 50) {
        wp_send_json(["response" => "ko", "message" => "Il vous faut au minimum 50 points pour pouvoir générer un code promo.","user_points"=>$user_points]);
    }




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

    wp_send_mail($user_email,$code,$percent_choice);

    $coupon->set_description("Coupon généré automatiquement par le clients grâce à ces points de fidélités"); // Discount amount

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
    }else wp_send_json(["response" => "ko", "message" => "Le coupon n'a pas pu être généré suite à une erreur inconnue."]);



    $result = [
        "response" => "success",
        "coupon_code" => $code,
        "date_expiration" => $time,
        "newPoints" =>  $newPoints,
        "currents_points" => $user_points,
        "message"=> "Code promo généré avec succès"
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


/**
 * envoie un mail avec une fonction de wordpress car sendinblue ne fonctionnais pas 
 */
function wp_send_mail($mail = "titann2.15@outlook.com", $code = "", $percent = 0)
{
    $to = $mail;
    $subject = 'Félicitations, consultez votre code promo!';
    $body = '
        <h1>Félicitation, vous venez de générer votre code promo</h1>
        <ul>
            <li>Votre code promo :'.$code.'.</li>
            <li>Limte maximum d\'achat de 200 €.</li>
            <li>Votre code promo vous permet de bénéficier de'.$percent.' % de reduction sur vos prochain achats.</li>

        </ul>
    ';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);
}
