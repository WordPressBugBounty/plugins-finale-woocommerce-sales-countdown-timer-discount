<?php
defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce Plugin Compatibility
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the plugin to newer
 * versions in the future. If you wish to customize the plugin for your
 * needs please refer to http://www.skyverge.com
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2013, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! class_exists( 'WCCT_Compatibility' ) ) :

	/**
	 * WooCommerce Compatibility Utility Class
	 *
	 * The unfortunate purpose of this class is to provide a single point of
	 * compatibility functions for dealing with supporting multiple versions
	 * of WooCommerce.
	 *
	 * The recommended procedure is to rename this file/class, replacing "my plugin"
	 * with the particular plugin name, so as to avoid clashes between plugins.
	 * Over time we expect to remove methods from this class, using the current
	 * ones directly, as support for older versions of WooCommerce is dropped.
	 *
	 * Current Compatibility: 2.0.x - 2.1
	 *
	 * @version 1.0
	 */
	class WCCT_Compatibility {

		/**
		 * Compatibility function for outputting a woocommerce attribute label
		 *
		 * @param string $label the label to display
		 *
		 * @return string the label to display
		 * @since 1.0
		 *
		 */
		public static function wc_attribute_label( $label ) {

			if ( self::is_wc_version_gte_2_1() ) {
				return wc_attribute_label( $label );
			} else {
				global $woocommerce;

				return $woocommerce->attribute_label( $label );
			}
		}

		public static function wc_attribute_taxonomy_name( $name ) {
			if ( self::is_wc_version_gte_2_1() ) {
				return wc_attribute_taxonomy_name( $name );
			} else {
				global $woocommerce;

				return $woocommerce->attribute_taxonomy_name( $name );
			}
		}

		public static function wc_get_attribute_taxonomies() {
			global $woocommerce;
			if ( self::is_wc_version_gte_2_1() ) {
				return wc_get_attribute_taxonomies();
			} else {
				return $woocommerce->get_attribute_taxonomies();
			}
		}

		public static function wc_placeholder_img_src() {
			if ( self::is_wc_version_gte_2_1() ) {
				return wc_placeholder_img_src();
			} else {
				return woocommerce_placeholder_img_src();
			}
		}

		public static function woocommerce_get_formatted_product_name( $product ) {
			if ( self::is_wc_version_gte_2_1() ) {
				return $product->get_formatted_name();
			} else {
				return woocommerce_get_formatted_product_name( $product );
			}
		}

		/**
		 * Compatibility function to add and store a notice
		 *
		 * @param string $message The text to display in the notice.
		 * @param string $notice_type The singular name of the notice type - either error, success or notice. [optional]
		 *
		 * @since 1.0
		 *
		 */
		public static function wc_add_notice( $message, $notice_type = 'success' ) {

			if ( self::is_wc_version_gte_2_1() ) {
				wc_add_notice( $message, $notice_type );
			} else {
				global $woocommerce;

				if ( 'error' == $notice_type ) {
					$woocommerce->add_error( $message );
				} else {
					$woocommerce->add_message( $message );
				}
			}
		}

		/**
		 * Prints messages and errors which are stored in the session, then clears them.
		 *
		 * @since 1.0
		 */
		public static function wc_print_notices() {

			if ( self::is_wc_version_gte_2_1() ) {
				wc_print_notices();
			} else {
				global $woocommerce;
				$woocommerce->show_messages();
			}
		}

		/**
		 * Compatibility function to queue some JavaScript code to be output in the footer.
		 *
		 * @param string $code javascript
		 *
		 * @since 1.0
		 *
		 */
		public static function wc_enqueue_js( $code ) {

			if ( self::is_wc_version_gte_2_1() ) {
				wc_enqueue_js( $code );
			} else {
				global $woocommerce;
				$woocommerce->add_inline_js( $code );
			}
		}

		/**
		 * Sets WooCommerce messages
		 *
		 * @since 1.0
		 */
		public static function set_messages() {

			if ( self::is_wc_version_gte_2_1() ) {
				// no-op in WC 2.1+
			} else {
				global $woocommerce;
				$woocommerce->set_messages();
			}
		}

		/**
		 * Returns a new instance of the woocommerce logger
		 *
		 * @return object logger
		 * @since 1.0
		 */
		public static function new_wc_logger() {

			if ( self::is_wc_version_gte_2_1() ) {
				return new WC_Logger();
			} else {
				global $woocommerce;

				return $woocommerce->logger();
			}
		}

		/**
		 * Format decimal numbers ready for DB storage
		 *
		 * Sanitize, remove locale formatting, and optionally round + trim off zeros
		 *
		 * @param float|string $number Expects either a float or a string with a decimal separator only (no thousands)
		 * @param mixed $dp number of decimal points to use, blank to use woocommerce_price_num_decimals, or false to avoid all rounding.
		 * @param boolean $trim_zeros from end of string
		 *
		 * @return string
		 * @since 1.0
		 *
		 */
		public static function wc_format_decimal( $number, $dp = false, $trim_zeros = false ) {

			if ( self::is_wc_version_gte_2_1() ) {
				return wc_format_decimal( $number, $dp, $trim_zeros );
			} else {
				return woocommerce_format_total( $number );
			}
		}

		/**
		 * Get the count of notices added, either for all notices (default) or for one particular notice type specified
		 * by $notice_type.
		 *
		 * @param string $notice_type The name of the notice type - either error, success or notice. [optional]
		 *
		 * @return int the notice count
		 * @since 1.0
		 *
		 */
		public static function wc_notice_count( $notice_type = '' ) {

			if ( self::is_wc_version_gte_2_1() ) {
				return wc_notice_count( $notice_type );
			} else {
				global $woocommerce;

				if ( 'error' == $notice_type ) {
					return $woocommerce->error_count();
				} else {
					return $woocommerce->message_count();
				}
			}
		}

		/**
		 * Compatibility function to use the new WC_Admin_Meta_Boxes class for the save_errors() function
		 *
		 * @return old save_errors function or new class
		 * @since 1.0-1
		 */
		public static function save_errors() {

			if ( self::is_wc_version_gte_2_1() ) {
				WC_Admin_Meta_Boxes::save_errors();
			} else {
				woocommerce_meta_boxes_save_errors();
			}
		}

		/**
		 * Compatibility function to get the version of the currently installed WooCommerce
		 *
		 * @return string woocommerce version number or null
		 * @since 1.0
		 */
		public static function get_wc_version() {

			// WOOCOMMERCE_VERSION is now WC_VERSION, though WOOCOMMERCE_VERSION is still available for backwards compatibility, we'll disregard it on 2.1+
			if ( defined( 'WC_VERSION' ) && WC_VERSION ) {
				return WC_VERSION;
			}
			if ( defined( 'WOOCOMMERCE_VERSION' ) && WOOCOMMERCE_VERSION ) {
				return WOOCOMMERCE_VERSION;
			}

			return null;
		}

		/**
		 * Returns the WooCommerce instance
		 *
		 * @return WooCommerce woocommerce instance
		 * @since 1.0
		 */
		public static function WC() {

			if ( self::is_wc_version_gte_2_1() ) {
				return WC();
			} else {
				global $woocommerce;

				return $woocommerce;
			}
		}

		/**
		 * Returns true if the WooCommerce plugin is loaded
		 *
		 * @return boolean true if WooCommerce is loaded
		 * @since 1.0
		 */
		public static function is_wc_loaded() {

			if ( self::is_wc_version_gte_2_1() ) {
				return class_exists( 'WooCommerce' );
			} else {
				return class_exists( 'Woocommerce' );
			}
		}

		public static function get_order_id( $order ) {

			if ( self::is_wc_version_gte_3_0() ) {
				return $order->get_id();
			} else {
				return $order->id;

			}

		}

		/**
		 * Returns true if the installed version of WooCommerce is 2.1 or greater
		 *
		 * @return boolean true if the installed version of WooCommerce is 2.1 or greater
		 * @since 1.0
		 */
		public static function is_wc_version_gte_2_1() {

			// can't use gte 2.1 at the moment because 2.1-BETA < 2.1
			return self::is_wc_version_gt( '2.0.20' );
		}

		/**
		 * Returns true if the installed version of WooCommerce is 2.6 or greater
		 *
		 * @return boolean true if the installed version of WooCommerce is 2.1 or greater
		 * @since 1.0
		 */
		public static function is_wc_version_gte_2_6() {

			return version_compare( self::get_wc_version(), '2.6.0', 'ge' );
		}

		/**
		 * Returns true if the installed version of WooCommerce is greater than $version
		 *
		 * @param string $version the version to compare
		 *
		 * @return boolean true if the installed version of WooCommerce is > $version
		 * @since 1.0
		 *
		 */
		public static function is_wc_version_gt( $version ) {

			return self::get_wc_version() && version_compare( self::get_wc_version(), $version, '>' );
		}

		/**
		 * Returns true if the installed version of WooCommerce is greater than 3.0
		 *
		 * @return boolean true if the installed version of WooCommerce is > 3.0
		 * @since 1.0
		 *
		 */
		public static function is_wc_version_gte_3_0() {
			return self::get_wc_version() && version_compare( self::get_wc_version(), '3.0', '>=' );
		}

	}

endif; // Class exists check
