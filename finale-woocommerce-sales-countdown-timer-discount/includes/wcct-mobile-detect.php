<?php

class WCCT_Mobile_Detect {
	/**
	 * List of mobile User-Agents for basic mobile detection
	 */
	protected $mobileagents = [
		'Mobile',
		'Android',
		'Silk/',
		'Kindle',
		'BlackBerry',
		'Opera Mini',
		'Opera Mobi',
		'Windows Phone',
		'IEMobile',
		'iPhone',
		'iPod',
		'iPad',
		'webOS',
		'Symbian',
		'Samsung',
		'LG',
		'UCWEB',
		'MICROMAX',
		'LAVA',
		'Mobi',
		'Maemo',
		'Palm',
		'CoMo',
		'Series60',
		'Series40',
		'J2ME',
		'Fennec',
		'DoCoMo',
		'Novarra',
		'NetFront',
		'Firefox Mobile',
		'Blazer',
		'MEIZU',
		'Midori',
		'SymbianOS',
		'S60',
		'Windows CE',
		'Phone',
		'MobileExplorer',
		'Opera mobi',
		'Opera Mini',
		'AvantGo',
		'Minimo',
		'Bolt',
		'Fennec',
		'Iris',
		'Maemo Browser',
		'MIB',
		'Semc',
		'Teleca',
		'Obigo',
		'NetFront',
		'Polaris',
		'BREW',
		'Nintendo',
		'Playstation',
		'Danger Hiptop',
		'Google Wireless Transcoder',
		'Palm',
		'Amazon Kindle',
		'Mobile',
		'Ave Front',
		'Mazingo',
		'Motorola',
		'Nokia',
		'Palm',
		'SonyEricsson',
		'Samsung',
		'Ericsson',
		'BlackBerry',
		'Sony Ericsson',
		'Wap',
		'Smartphone',
		'Symbian',
		'SymbianOS',
		'Symbian S60',
		'Ubuntu Mobile',
		'Windows Mobile',
		'Mac OS X',
		'AdobeAIR',
		'PlayBook',
		'Xoom',
		'P160U',
		'Kindle Fire',
		'Silk',
		'GT-P1000',
		'Nexus 7',
		'HTC',
		'Dream',
		'CUPCAKE',
		'Froyo',
		'Honeycomb',
		'Ice Cream Sandwich',
		'Jelly Bean',
		'KitKat',
		'Lollipop',
		'Marshmallow',
		'Nougat',
		'Oreo',
		'Pie',
		'Android 10',
		'Android 11',
		'Android 12'
	];

	/**
	 * List of tablet User-Agents for basic tablet detection
	 */
	protected $tabletagents = [
		'iPad',
		'Kindle',
		'Silk',
		'PlayBook',
		'Tablet',
		'Xoom',
		'Galaxy Tab',
		'Nexus 7',
		'Nexus 10',
		'SM-T',
		'Shield Tablet',
		'HP Slate'
	];

	/**
	 * Detect if the current device is a mobile device based on the User-Agent string.
	 *
	 * @return bool True if the device is a mobile device, false otherwise.
	 */
	public function isMobile() {
		return $this->detect_device( $this->mobileagents );
	}

	/**
	 * Detect if the current device is a tablet based on the User-Agent string.
	 *
	 * @return bool True if the device is a tablet, false otherwise.
	 */
	public function isTablet() {
		return $this->detect_device( $this->tabletagents );
	}

	/**
	 * Helper function to perform the actual detection of devices.
	 *
	 * @param array $agents Array of User-Agent substrings for detection
	 *
	 * @return bool True if a match is found, false otherwise.
	 */
	protected function detect_device( array $agents ) {
		$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
		foreach ( $agents as $agent ) {
			if ( stripos( $user_agent, $agent ) !== false ) {
				return true;
			}
		}

		return false;
	}
}
