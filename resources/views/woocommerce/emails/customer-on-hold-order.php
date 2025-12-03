<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 7.3.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>Ta wiadomość jest generowana automatycznie, prosimy na nią nie odpowiadać</p>

<p>Dzień dobry,</p>

<p>bardzo dziękujemy za rejestrację na konferencję VI Forum Zakażeń, która odbędzie się w dniach 13-15 maja 2026 r. w Hotelu Windsor w Jachrance. <b>Twoje zgłoszenie zostało przyjęte.</b></p>

<b>Dane do przelewu:</b>
<p>Evereth Publishing Sp. z o.o.<br>
ul. Paprociowa 13<br>
04-751 Warszawa<br><br>
<b>nr konta:</b><br>
63 1090 1753 0000 0001 4680 1378<br>
<b>tytuł:</b><br> imię i nazwisko uczestnika – konferencja FZ2026.</p><br>

<p>Wysokość opłat znajdziesz tutaj: <a href="https://forumzakazen.com/oplata-konferencyjna/">Opłata konferencyjna</a></p><br>

<p>Prosimy o sprawdzenie, czy dane zawarte w formularzu są poprawne.</p><br>
<p>W przypadku zauważonych błędów prosimy o dokonanie ponownej rejestracji na konferencję.</p><br>

<p>W przypadku nieuiszczenia przez uczestnika opłaty w ciągu 7 dni Organizator jest zmuszony skreślić go z listy. Jeśli pomimo to uczestnik wyraża chęć wzięcia udziału w konferencji, konieczna jest ponowna rejestracja i dokonanie wpłaty (według cennika i obowiązującego terminarza znajdującego się w zakładce <a href="https://forumzakazen.com/oplata-konferencyjna/">Opłata konferencyjna</a>).</p>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
