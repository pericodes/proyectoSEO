<?php

/**
 * Open Graph protocol type labels are passed through gettext message interpreters for the current context.
 * Fake the interpreter function alias if not defined
 */
if ( !function_exists('_') ):
function _( $text, $domain='' ) {
	return $text;
}
endif;
/**
 * Validate inputted text against Open Graph Protocol requirements by parameter.
 *
 * @link http://ogp.me/ Open Graph Protocol
 * @version 1.3
 */
class OpenGraphProtocol {
	/**
	 * Version
	 * @var string
	 */
	const VERSION = '1.3';
	/**
	 * Should we remotely request each referenced URL to make sure it exists and returns the expected Internet media type?
	 * @var bool
	 */
	const VERIFY_URLS = false;
	/**
	 * Meta attribute name. Use 'property' if you prefer RDF or 'name' if you prefer HTML validation
	 * @var string
	 */
	const META_ATTR = 'property';
	/**
	 * Property prefix
	 * @var string
	 */
	const PREFIX = 'og';
	/**
	 * prefix namespace
	 * @var string
	 */
	const NS = 'http://ogp.me/ns#';
	/**
	 * Page classification according to a pre-defined set of base types.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $type;
	/**
	 * The title of your object as it should appear within the graph.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $title;
	/**
	 * If your object is part of a larger web site, the name which should be displayed for the overall site.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $site_name;
	/**
	 * A one to two sentence description of your object.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $description;
	/**
	 * The canonical URL of your object that will be used as its permanent ID in the graph.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $url;
	/**
	 * The word that appears before this object's title in a sentence
	 *
	 * @var string
	 * @since 1.3
	 */
	protected $determiner;
	/**
	 * Language and optional territory of page content.
	 * @var string
	 * @since 1.3
	 */
	protected $locale;
	/**
	 * An array of OpenGraphProtocolImage objects
	 *
	 * @var array
	 * @since 1.0
	 */
	protected $image;
	/**
	 * An array of OpenGraphProtocolAudio objects
	 *
	 * @var array
	 * @since 1.2
	 */
	protected $audio;
	/**
	 * An array of OpenGraphProtocolVideo objects
	 *
	 * @var array
	 * @since 1.2
	 */
	protected $video;
	/**
	 * Build Open Graph protocol HTML markup based on an array
	 *
	 * @param array $og associative array of OGP properties and values
	 * @param string $prefix optional prefix to prepend to all properties
	 */
	public static function buildHTML( array $og, $prefix=self::PREFIX ) {
		if ( empty($og) )
			return;
		$s = '';
		foreach ( $og as $property => $content ) {
			if ( is_object( $content ) || is_array( $content ) ) {
				if ( is_object( $content ) )
					$content = $content->toArray();
				if ( empty($property) || !is_string($property) )
					$s .= static::buildHTML( $content, $prefix );
				else
					$s .= static::buildHTML( $content, $prefix . ':' . $property );
			} elseif ( !empty($content) ) {
				$s .= '<meta ' . self::META_ATTR . '="' . $prefix;
				if ( is_string($property) && !empty($property) )
					$s .= ':' . htmlspecialchars( $property );
				$s .= '" content="' . htmlspecialchars($content) . '">' . PHP_EOL;
			}
		}
		return $s;
	}
	/**
	 * A list of allowed page types in the Open Graph Protocol
	 *
	 * @param Bool $flatten true for grouped types one level deep
	 * @link http://ogp.me/#types Open Graph Protocol object types
	 * @return array Array of Open Graph Protocol object types
	 */
	public static function supported_types( $flatten=false ) {
		$types = array(
			_('Activities') => array(
				'activity' => _('Activity'),
				'sport' => _('Sport')
			),
			_('Businesses') => array(
				'company' => _('Company'),
				'bar' => _('Bar'),
				'cafe' => _('Cafe'),
				'hotel' => _('Hotel'),
				'restaurant' => _('Restaurant')
			),
			_('Groups') => array(
				'cause' => _('Cause'),
				'sports_league' => _('Sports league'),
				'sports_team' => _('Sports team')
			),
			_('Organizations') => array(
				'band' => _('Band'),
				'government' => _('Government'),
				'non_profit' => _('Non-profit'),
				'school' => _('School'),
				'university' => _('University')
			),
			_('People') => array(
				'actor' => _('Actor or actress'),
				'athlete' => _('Athlete'), 
				'author' => _('Author'),
				'director' => _('Director'),
				'musician' => _('Musician'),
				'politician' => _('Politician'),
				'profile' => _('Profile'),
				'public_figure' => _('Public Figure')
			),
			_('Places') => array(
				'city' => _('City or locality'),
				'country' => _('Country'),
				'landmark' => _('Landmark'),
				'state_province' => _('State or province')
			),
			_('Products and Entertainment') => array(
				'music.album' => _('Music Album'),
				'book' => _('Book'),
				'drink' => _('Drink'),
				'video.episode' => _('Video episode'),
				'food' => _('Food'),
				'game' => _('Game'),
				'video.movie' => _('Movie'),
				'music.playlist' => _('Music playlist'),
				'product' => _('Product'),
				'music.radio_station' => _('Radio station'),
				'music.song' => _('Song'),
				'video.tv_show' => _('Television show'),
				'video.other' => _('Video')
			),
			_('Websites') => array(
				'article' => _('Article'),
				'blog' => _('Blog'),
				'website' => _('Website')
			)
		);
		if ( $flatten === true ) {
			$types_values = array();
			foreach ( $types as $category=>$values ) {
				$types_values = array_merge( $types_values, array_keys($values) );
			}
			return $types_values;
		} else {
			return $types;
		}
	}
	/**
	 * Facebook maps languages to a default territory and only accepts locales in this list. A few popular languages such as English and French support multiple territories.
	 * Map the Facebook list to avoid throwing errors in Facebook parsers that prevent further content indexing
	 *
	 * @link https://www.facebook.com/translations/FacebookLocales.xml Facebook locales
	 * @param bool $keys_only return only keys
	 * @return array associative array of locale code and locale name. locale code is in the format language_TERRITORY where language is an ISO 639-1 alpha-2 code and territory is an ISO 3166-1 alpha-2 code with special regions 'AR' and 'LA' for Arab region and Latin America respectively.
	 */
	public static function supported_locales( $keys_only=false ) {
		$locales = array(
			'af_ZA' => _('Afrikaans'),
			'ak_GH' => _('Akan'),
			'am_ET' => _('Amharic'),
			'ar_AR' => _('Arabic'),
			'as_IN' => _('Assamese'),
			'ay_BO' => _('Aymara'),
			'az_AZ' => _('Azerbaijani'),
			'be_BY' => _('Belarusian'),
			'bg_BG' => _('Bulgarian'),
			'bn_IN' => _('Bengali'),
			'br_FR' => _('Breton'),
			'bs_BA' => _('Bosnian'),
			'ca_ES' => _('Catalan'),
			'cb_IQ' => _('Sorani Kurdish'),
			'ck_US' => _('Cherokee'),
			'co_FR' => _('Corsican'),
			'cs_CZ' => _('Czech'),
			'cx_PH' => _('Cebuano'),
			'cy_GB' => _('Welsh'),
			'da_DK' => _('Danish'),
			'de_DE' => _('German'),
			'el_GR' => _('Greek'),
			'en_GB' => _('English (UK)'),
			'en_IN' => _('English (India)'),
			'en_US' => _('English (US)'),
			'eo_EO' => _('Esperanto'),
			'es_CO' => _('Spanish (Colombia)'),
			'es_ES' => _('Spanish (Spain)'),
			'es_LA' => _('Spanish'),
			'et_EE' => _('Estonian'),
			'eu_ES' => _('Basque'),
			'fa_IR' => _('Persian'),
			'ff_NG' => _('Fulah'),
			'fi_FI' => _('Finnish'),
			'fo_FO' => _('Faroese'),
			'fr_CA' => _('French (Canada)'),
			'fr_FR' => _('French (France)'),
			'fy_NL' => _('Frisian'),
			'ga_IE' => _('Irish'),
			'gl_ES' => _('Galician'),
			'gn_PY' => _('Guarani'),
			'gu_IN' => _('Gujarati'),
			'gx_GR' => _('Classical Greek'),
			'ha_NG' => _('Hausa'),
			'he_IL' => _('Hebrew'),
			'hi_IN' => _('Hindi'),
			'hr_HR' => _('Croatian'),
			'hu_HU' => _('Hungarian'),
			'hy_AM' => _('Armenian'),
			'id_ID' => _('Indonesian'),
			'ig_NG' => _('Igbo'),
			'is_IS' => _('Icelandic'),
			'it_IT' => _('Italian'),
			'ja_JP' => _('Japanese'),
			'ja_KS' => _('Japanese (Kansai)'),
			'jv_ID' => _('Javanese'),
			'ka_GE' => _('Georgian'),
			'kk_KZ' => _('Kazakh'),
			'km_KH' => _('Khmer'),
			'kn_IN' => _('Kannada'),
			'ko_KR' => _('Korean'),
			'ku_TR' => _('Kurdish (Kurmanji)'),
			'la_VA' => _('Latin'),
			'lg_UG' => _('Ganda'),
			'li_NL' => _('Limburgish'),
			'ln_CD' => _('Lingala'),
			'lo_LA' => _('Lao'),
			'lt_LT' => _('Lithuanian'),
			'lv_LV' => _('Latvian'),
			'mg_MG' => _('Malagasy'),
			'mk_MK' => _('Macedonian'),
			'ml_IN' => _('Malayalam'),
			'mn_MN' => _('Mongolian'),
			'mr_IN' => _('Marathi'),
			'ms_MY' => _('Malay'),
			'mt_MT' => _('Maltese'),
			'my_MM' => _('Burmese'),
			'nb_NO' => _('Norwegian (bokmal)'),
			'nd_ZW' => _('Ndebele'),
			'ne_NP' => _('Nepali'),
			'nl_BE' => _('Dutch (België)'),
			'nl_NL' => _('Dutch'),
			'nn_NO' => _('Norwegian (nynorsk)'),
			'ny_MW' => _('Chewa'),
			'or_IN' => _('Oriya'),
			'pa_IN' => _('Punjabi'),
			'pl_PL' => _('Polish'),
			'ps_AF' => _('Pashto'),
			'pt_BR' => _('Portuguese (Brazil)'),
			'pt_PT' => _('Portuguese (Portugal)'),
			'qu_PE' => _('Quechua'),
			'rm_CH' => _('Romansh'),
			'ro_RO' => _('Romanian'),
			'ru_RU' => _('Russian'),
			'rw_RW' => _('Kinyarwanda'),
			'sa_IN' => _('Sanskrit'),
			'sc_IT' => _('Sardinian'),
			'se_NO' => _('Northern Sámi'),
			'si_LK' => _('Sinhala'),
			'sk_SK' => _('Slovak'),
			'sl_SI' => _('Slovenian'),
			'sn_ZW' => _('Shona'),
			'so_SO' => _('Somali'),
			'sq_AL' => _('Albanian'),
			'sr_RS' => _('Serbian'),
			'sv_SE' => _('Swedish'),
			'sw_KE' => _('Swahili'),
			'sy_SY' => _('Syriac'),
			'sz_PL' => _('Silesian'),
			'ta_IN' => _('Tamil'),
			'te_IN' => _('Telugu'),
			'tg_TJ' => _('Tajik'),
			'th_TH' => _('Thai'),
			'tk_TM' => _('Turkmen'),
			'tl_PH' => _('Filipino'),
			'tr_TR' => _('Turkish'),
			'tt_RU' => _('Tatar'),
			'tz_MA' => _('Tamazight'),
			'uk_UA' => _('Ukrainian'),
			'ur_PK' => _('Urdu'),
			'uz_UZ' => _('Uzbek'),
			'vi_VN' => _('Vietnamese'),
			'wo_SN' => _('Wolof'),
			'xh_ZA' => _('Xhosa'),
			'yi_DE' => _('Yiddish'),
			'yo_NG' => _('Yoruba'),
			'zh_CN' => _('Simplified Chinese (China)'),
			'zh_HK' => _('Traditional Chinese (Hong Kong)'),
			'zh_TW' => _('Traditional Chinese (Taiwan)'),
			'zu_ZA' => _('Zulu'),
			'zz_TR' => _('Zazaki')
		);
		if ( $keys_only === true ) {
			return array_keys($locales);
		} else {
			return $locales;
		}
	}
	/**
	 * Cleans a URL string, then checks to see if a given URL is addressable, returns a 200 OK response, and matches the accepted Internet media types (if provided).
	 *
	 * @param string $url Publicly addressable URL
	 * @param array $accepted_mimes Given URL correspond to an accepted Internet media (MIME) type.
	 * @return string cleaned URL string, or empty string on failure.
	 */
	public static function is_valid_url( $url, array $accepted_mimes = array() ) {
		if ( !is_string( $url ) || empty( $url ) )
			return '';
		/*
		 * Validate URI string by letting PHP break up the string and put it back together again
		 * Excludes username:password and port number URI parts
		 */
		$url_parts = parse_url( $url );
		$url = '';
		if ( isset( $url_parts['scheme'] ) && in_array( $url_parts['scheme'], array('http', 'https'), true ) ) {
			$url = "{$url_parts['scheme']}://{$url_parts['host']}{$url_parts['path']}";
			if ( empty( $url_parts['path'] ) )
				$url .= '/';
			if ( !empty( $url_parts['query'] ) )
				$url .= '?' . $url_parts['query'];
			if ( !empty( $url_parts['fragment'] ) )
				$url .= '#' . $url_parts['fragment'];
		}
		if ( !empty( $url ) ) {
			// test if URL exists
			$ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt( $ch, CURLOPT_FORBID_REUSE, true );
			curl_setopt( $ch, CURLOPT_NOBODY, true ); // HEAD
			curl_setopt( $ch, CURLOPT_USERAGENT, 'Open Graph protocol validator ' . self::VERSION . ' (+http://ogp.me/)' );
			if ( !empty($accepted_mimes) )
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Accept: ' . implode( ',', $accepted_mimes ) ) );
			$response = curl_exec( $ch );
			if ( curl_getinfo( $ch, CURLINFO_HTTP_CODE ) == 200 ) {
				if ( !empty($accepted_mimes) ) {
					$content_type = explode( ';', curl_getinfo( $ch, CURLINFO_CONTENT_TYPE ) );
					if ( empty( $content_type ) || !in_array( $content_type[0], $accepted_mimes ) )
						return '';
				}
			} else {
				return '';
			}
		}
		return $url;
	}
	/**
	 * Output the OpenGraphProtocol object as HTML elements string
	 *
	 * @return string meta elements
	 */
	public function toHTML() {
		return rtrim( static::buildHTML( get_object_vars($this) ), PHP_EOL );
	}
	/**
	 * @return String the type slug
	 */
	public function getType() {
		return $this->type;
	}
	/**
	 *
	 * @param String type slug
	 */
	public function setType( $type ) {
		if ( is_string($type) && in_array( $type, self::supported_types(true), true ) )
			$this->type = $type;
		return $this;
	}
	/**
	 * @return String document title
	 */
	public function getTitle() {
		return $this->title;
	}
	/**
	 * @param String $title document title
	 */
	public function setTitle( $title ) {
		if ( is_string($title) ) {
			$title = trim( $title );
			if ( strlen( $title ) > 128 )
				$this->title = substr( $title, 0, 128 );
			else
				$this->title = $title;
		}
		return $this;
	}
	/**
	 * @return String Site name
	 */
	public function getSiteName() {
		return $this->site_name;
	}
	/**
	 * @param String $site_name Site name
	 */
	public function setSiteName( $site_name ) {
		if ( is_string($site_name) && !empty($site_name) ) {
			$site_name = trim( $site_name );
			if ( strlen( $site_name ) > 128 )
				$this->site_name = substr( $site_name, 0, 128 );
			else
				$this->site_name = $site_name;
		}
		return $this;
	}
	/**
	 * @return String Description
	 */
	public function getDescription() {
		return $this->description;
	}
	/**
	 * @param String $description Document description
	 */
	public function setDescription( $description ) {
		if ( is_string($description) && !empty($description) ) {
			$description = trim( $description );
			if ( strlen( $description ) > 255 )
				$this->description = substr( $description, 0, 255 );
			else
				$this->description = $description;
		}
		return $this;
	}
	/**
	 * @return String URL
	 */
	public function getURL() {
		return $this->url;
	}
	/**
	 * @param String $url Canonical URL
	 */
	public function setURL( $url ) {
		if ( is_string( $url ) && !empty( $url ) ) {
			$url = trim($url);
			if (self::VERIFY_URLS) {
				$url = self::is_valid_url( $url, array( 'text/html', 'application/xhtml+xml' ) );
			}
			if ( !empty( $url ) )
				$this->url = $url;
		}
		return $this;
	}
	/**
	 * @return string the determiner
	 */
	public function getDeterminer() {
		return $this->determiner;
	}
	public function setDeterminer( $determiner ) {
		if ( in_array($determiner, array('a','an','auto','the'), true) )
			$this->determiner = $determiner;
		return $this;
	}
	/**
	 * @return string language_TERRITORY
	 */
	public function getLocale() {
		return $this->locale;
	}
	/**
	 * @var string $locale locale in the format language_TERRITORY
	 */
	public function setLocale( $locale ) {
		if ( is_string($locale) && in_array($locale, static::supported_locales(true)) )
			$this->locale = $locale;
		return $this;
	}
	/**
	 * @return array OpenGraphProtocolImage array
	 */
	public function getImage() {
		return $this->image;
	}
	/**
	 * Add an image.
	 * The first image added is given priority by the Open Graph Protocol spec. Implementors may choose a different image based on size requirements or preferences.
	 *
	 * @param OpenGraphProtocolImage $image image object to add
	 */
	public function addImage( OpenGraphProtocolImage $image ) {
		$image_url = $image->getURL();
		if ( empty($image_url) )
			return;
		$image->removeURL();
		$value = array( $image_url, array($image) );
		if ( ! isset( $this->image ) )
			$this->image = array( $value );
		else
			$this->image[] = $value;
		return $this;
	}
	/**
	 * @return array OpenGraphProtocolAudio objects
	 */
	public function getAudio() {
		return $this->audio;
	}
	/**
	 * Add an audio reference
	 * The first audio is given priority by the Open Graph protocol spec.
	 *
	 * @param OpenGraphProtocolAudio $audio audio object to add
	 */
	public function addAudio( OpenGraphProtocolAudio $audio ) {
		$audio_url = $audio->getURL();
		if ( empty($audio_url) )
			return;
		$audio->removeURL();
		$value = array( $audio_url, array($audio) );
		if ( ! isset($this->audio) )
			$this->audio = array($value);
		else
			$this->audio[] = $value;
		return $this;
	}
	/**
	 * @return array OpenGraphProtocolVideo objects
	 */
	public function getVideo() {
		return $this->video;
	}
	/**
	 * Add a video reference
	 * The first video is given priority by the Open Graph protocol spec. Implementors may choose a different video based on size requirements or preferences.
	 *
	 * @param OpenGraphProtocolVideo $video video object to add
	 */
	public function addVideo( OpenGraphProtocolVideo $video ) {
		$video_url = $video->getURL();
		if ( empty($video_url) )
			return;
		$video->removeURL();
		$value = array( $video_url, array($video) );
		if ( ! isset( $this->video ) )
			$this->video = array( $value );
		else
			$this->video[] = $value;
		return $this;
	}
}

/**
 * Describe a media object
 *
 * @version 1.3
 */
abstract class OpenGraphProtocolMedia {

	/**
	 * HTTP scheme URL
	 *
	 * @var string
	 * @since 1.3
	 */
	protected $url;

	/**
	 * HTTPS scheme URL
	 *
	 * @var string
	 * @since 1.3
	 */
	protected $secure_url;

	/**
	 * Internet media type of the linked URLs
	 *
	 * @var string
	 * @since 1.3
	 */
	protected $type;

	/**
	 * Treat a string reference just like the base property
	 */
	public function toString() {
		return $this->url;
	}

	public function toArray() {
		return get_object_vars($this);
	}

	/**
	 * @return string URL string or null if not set
	 */
	public function getURL() {
		return $this->url;
	}

	/**
	 * Set the media URL
	 *
	 * @param string $url resource location
	 */
	public function setURL( $url ) {
		if ( is_string( $url ) && !empty( $url ) ) {
			$url = trim($url);
			if (OpenGraphProtocol::VERIFY_URLS) {
				$url = OpenGraphProtocol::is_valid_url( $url, array( 'text/html', 'application/xhtml+xml' ) );
			}
			if (!empty($url))
				$this->url = $url;
		}
		return $this;
	}

	/**
	 * Remove the URL property.
	 * Sets up the maximum compatibility between image and image:url indexers
	 */
	public function removeURL() {
		if ( !empty($this->url) )
			unset($this->url);
	}

	/**
	 * @return string secure URL string or null if not set
	 */
	public function getSecureURL() {
		return $this->url;
	}

	/**
	 * Set the secure URL for display in a HTTPS page
	 *
	 * @param string $url resource location
	 */
	public function setSecureURL( $url ) {
		if ( is_string( $url ) && !empty( $url ) ) {
			$url = trim($url);
			if (OpenGraphProtocol::VERIFY_URLS) {
				if ( parse_url($url,PHP_URL_SCHEME) === 'https' ) {
					$url = OpenGraphProtocol::is_valid_url( $url, array( 'text/html', 'application/xhtml+xml' ) );
				} else {
					$url = '';
				}
			}
			if (!empty($url))
				$this->secure_url = $url;
		}
		return $this;
	}

	/**
	 * Get the Internet media type of the referenced resource
	 *
	 * @return string Internet media type or null if none set
	 */
	public function getType() {
		return $this->type;
	}
}

abstract class OpenGraphProtocolVisualMedia extends OpenGraphProtocolMedia {
	/**
	 * Height of the media object in pixels
	 *
	 * @var int
	 * @since 1.3
	 */
	protected $height;

	/**
	 * Width of the media object in pixels
	 *
	 * @var int
	 * @since 1.3
	 */
	protected $width;

	/**
	 * @return int width in pixels
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Set the object width
	 *
	 * @param int $width width in pixels
	 */
	public function setWidth( $width ) {
		if ( is_int($width) && $width >  0 )
			$this->width = $width;
		return $this;
	}

	/**
	 * @return int height in pixels
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Set the height of the referenced object in pixels
	 * @var int height of the referenced object in pixels
	 */
	public function setHeight( $height ) {
		if ( is_int($height) && $height > 0 )
			$this->height = $height;
		return $this;
	}
}

/**
 * An image representing page content. Suitable for display alongside a summary of the webpage.
 */
class OpenGraphProtocolImage extends OpenGraphProtocolVisualMedia {
	/**
	 * Map a file extension to a registered Internet media type
	 *
	 * @link http://www.iana.org/assignments/media-types/image/index.html IANA image types
	 * @param string $extension file extension
	 * @return string Internet media type in the format image/* 
	 */
	public static function extension_to_media_type( $extension ) {
		if ( empty($extension) || ! is_string($extension) )
			return;
		if ( $extension === 'jpeg' || $extension === 'jpg' )
			return 'image/jpeg';
		else if ( $extension === 'png' )
			return 'image/png';
		else if ( $extension === 'gif' )
			return 'image/gif';
		else if ( $extension === 'svg' )
			return 'image/svg+sml';
		else if ( $extension === 'ico' )
			return 'image/vnd.microsoft.icon';
	}

	/**
	 * Set the Internet media type. Allow only image types.
	 *
	 * @param string $type Internet media type
	 */
	public function setType( $type ) {
		if ( substr_compare( $type, 'image/', 0, 6 ) === 0 )
			$this->type = $type;
		return $this;
	}
}

/**
 * A video that complements the webpage content
 */
class OpenGraphProtocolVideo extends OpenGraphProtocolVisualMedia {
	/**
	 * Map a file extension to a registered Internet media type
	 * Include Flash as a video type due to its popularity as a wrapper
	 *
	 * @link http://www.iana.org/assignments/media-types/video/index.html IANA video types
	 * @param string $extension file extension
	 * @return string Internet media type in the format video/* or Flash
	 */
	public static function extension_to_media_type( $extension ) {
		if ( empty($extension) || ! is_string($extension) )
			return;
		if ( $extension === 'swf' )
			return 'application/x-shockwave-flash';
		else if ( $extension === 'mp4' )
			return 'video/mp4';
		else if ( $extension === 'ogv' )
			return 'video/ogg';
		else if ( $extension === 'webm' )
			return 'video/webm';
	}

	/**
	 * Set the Internet media type. Allow only video types + Flash wrapper.
	 *
	 * @param string $type Internet media type
	 */
	public function setType( $type ) {
		if ( $type === 'application/x-shockwave-flash' || substr_compare( $type, 'video/', 0, 6 ) === 0 )
			$this->type = $type;
		return $this;
	}
}

/**
 * Audio file suitable for playback alongside the main linked content
 */
class OpenGraphProtocolAudio extends OpenGraphProtocolMedia {
	/**
	 * Map a file extension to a registered Internet media type
	 * Include Flash as a video type due to its popularity as a wrapper
	 *
	 * @link http://www.iana.org/assignments/media-types/audio/index.html IANA video types
	 * @param string $extension file extension
	 * @return string Internet media type in the format audio/* or Flash
	 */
	public static function extension_to_media_type( $extension ) {
		if ( empty($extension) || ! is_string($extension) )
			return;
		if ( $extension === 'swf' )
			return 'application/x-shockwave-flash';
		else if ( $extension === 'mp3' )
			return 'audio/mpeg';
		else if ( $extension === 'm4a' )
			return 'audio/mp4';
		else if ( $extension === 'ogg' || $extension === 'oga' )
			return 'audio/ogg';
	}

	/**
	 * Set the Internet media type. Allow only audio types + Flash wrapper.
	 *
	 * @param string $type Internet media type
	 */
	public function setType( $type ) {
		if ( $type === 'application/x-shockwave-flash' || substr_compare( $type, 'audio/', 0, 6 ) === 0 )
			$this->type = $type;
		return $this;
	}
}

/**
 * Open Graph protocol global types
 *
 * @link http://ogp.me/#types Open Graph protocol global types
 * @package open-graph-protocol-tools
 * @author Niall Kennedy <niall@niallkennedy.com>
 * @version 1.3
 * @copyright Public Domain
 */
if ( !class_exists('OpenGraphProtocol') )
	require_once dirname(__FILE__) . '/open-graph-protocol.php';
abstract class OpenGraphProtocolObject {
	const PREFIX ='';
	const NS='';
	/**
	 * Output the object as HTML <meta> elements
	 * @return string HTML meta element string
	 */
	public function toHTML() {
		return rtrim( OpenGraphProtocol::buildHTML( get_object_vars($this), static::PREFIX ), PHP_EOL );
	}
	/**
	 * Convert a DateTime object to GMT and format as an ISO 8601 string.
	 * @param DateTime $date date to convert
	 * @return string ISO 8601 formatted datetime string
	 */
	public static function datetime_to_iso_8601( DateTime $date ) {
		$date->setTimezone(new DateTimeZone('GMT'));
		return $date->format('c');
	}
	/**
	 * Test a URL for validity.
	 *
	 * @uses OpenGraphProtocol::is_valid_url if OpenGraphProtocol::VERIFY_URLS is true
	 * @param string $url absolute URL addressable from the public web
	 * @return bool true if URL is non-empty string. if VERIFY_URLS set then URL must also properly respond to a HTTP request.
	 */
	public static function is_valid_url( $url ) {
		if ( is_string($url) && !empty($url) ) {
			if (OpenGraphProtocol::VERIFY_URLS) {
				$url = OpenGraphProtocol::is_valid_url( $url, array( 'text/html', 'application/xhtml+xml' ) );
				if (!empty($url))
					return true;
			} else {
				return true;
			}
		}
		return false;
	}
}
class OpenGraphProtocolArticle extends OpenGraphProtocolObject {
	/**
	 * Property prefix
	 * @var string
	 */
	const PREFIX = 'article';
	/**
	 * prefix namespace
	 * @var string
	 */
	const NS = 'http://ogp.me/ns/article#';
	/**
	 * When the article was first published.
	 * ISO 8601 formatted string.
	 * @var string
	 */
	protected $published_time;
	/**
	 * When the article was last changed
	 * ISO 8601 formatted string.
	 * @var string
	 */
	protected $modified_time;
	/**
	 * When the article is considered out-of-date
	 * ISO 8601 formatted string.
	 * @var string
	 */
	protected $expiration_time;
	/**
	 * Writers of the article.
	 * Array of author URIs
	 * @var array
	 */
	protected $author;
	/**
	 * High-level section or category
	 * @var string
	 */
	protected $section;
	/**
	 * Content tag
	 * Array of tag strings
	 * @var array
	 */
	protected $tag;
	/**
	 * Initialize arrays
	 */
	public function __construct() {
		$this->author = array();
		$this->tag = array();
	}
	/**
	 * When the article was first published
	 * @return string ISO 8601 formatted publication date and optional time
	 */
	public function getPublishedTime() {
		return $this->published_time;
	}
	/**
	 * Set when the article was first published
	 * @param DateTime|string $pubdate ISO 8601 formatted datetime string or DateTime object for conversion
	 */
	public function setPublishedTime( $pubdate ) {
		if ( $pubdate instanceof DateTime )
			$this->published_time = static::datetime_to_iso_8601($pubdate);
		else if ( is_string($pubdate) && strlen($pubdate) >= 10 ) // at least YYYY-MM-DD
			$this->published_time = $pubdate;
		return $this;
	}
	/**
	 * When article was last changed
	 * @return string ISO 8601 formatted modified date and optional time
	 */
	public function getModifiedTime() {
		return $this->modified_time;
	}
	/**
	 * Set when the article was last changed
	 * @param DateTime|string $updated ISO 8601 formatted datetime string or DateTime object for conversion
	 */
	public function setModifiedTime( $updated ) {
		if ( $updated instanceof DateTime )
			$this->modified_time = static::datetime_to_iso_8601($updated);
		else if ( is_string($updated) && strlen($updated) >= 10 ) // at least YYYY-MM-DD
			$this->modified_time = $updated;
		return $this;
	}
	/**
	 * Time the article content expires
	 * @return string ISO 8601 formatted expiration date and optional time
	 */
	public function getExpirationTime() {
		return $this->expiration_time;
	}
	/**
	 * Set when the article content expires
	 * @param DateTime|string $expires ISO formatted datetime string or DateTime object for conversion
	 */
	public function setExpirationTime( $expires ) {
		if ( $expires instanceof DateTime )
			$this->expiration_time = static::datetime_to_iso_8601($expires);
		else if ( is_string($expires) && strlen($expires) >= 10 )
			$this->expiration_time = $expires;
		return $this;
	}
	/**
	 * Article author URIs
	 * @return array Article author URIs
	 */
	public function getAuthors() {
		return $this->author;
	}
	/**
	 * Add an author URI
	 * @param string $author_uri Author URI
	 */
	public function addAuthor( $author_uri ) {
		if ( static::is_valid_url($author_uri) && !in_array($author_uri, $this->author))
			$this->author[] = $author_uri;
		return $this;
	}
	/**
	 * High-level section name
	 */
	public function getSection() {
		return $this->section;
	}
	/**
	 * Set the top-level content section
	 * @param string $section
	 */
	public function setSection( $section ) {
		if ( is_string($section) && !empty($section) )
			$this->section = $section;
		return $this;
	}
	/**
	 * Content tags
	 * @return array content tags
	 */
	public function getTags() {
		return $this->tag;
	}
	/**
	 * Add a content tag
	 * @param string $tag content tag
	 */
	public function addTag( $tag ) {
		if ( is_string($tag) && !empty($tag) )
			$this->tag[] = $tag;
		return $this;
	}
}
class OpenGraphProtocolProfile extends OpenGraphProtocolObject {
	/**
	 * Property prefix
	 * @var string
	 */
	const PREFIX = 'profile';
	/**
	 * prefix namespace
	 * @var string
	 */
	const NS = 'http://ogp.me/ns/profile#';
	/**
	 * A person's given name
	 * @var string
	 */
	protected $first_name;
	/**
	 * A person's last name
	 * @var string
	 */
	protected $last_name;
	/**
	 * The profile's unique username
	 * @var string
	 */
	protected $username;
	/**
	 * Gender: male or female
	 */
	protected $gender;
	/**
	 * Get the person's given name
	 * @return string given name
	 */
	public function getFirstName() {
		return $this->first_name;
	}
	/**
	 * Set the person's given name
	 * @param string $first_name given name
	 */
	public function setFirstName( $first_name ) {
		if ( is_string($first_name) && !empty($first_name) )
			$this->first_name = $first_name;
		return $this;
	}
	/**
	 * The person's family name
	 * @return string famil name
	 */
	public function getLastName() {
		return $this->last_name;
	}
	/**
	 * Set the person's family name
	 * @param string $last_name family name
	 */
	public function setLastName( $last_name ) {
		if ( is_string($last_name) && !empty($last_name) )
			$this->last_name = $last_name;
		return $this;
	}
	/**
	 * Person's username on your site
	 * @return string account username
	 */
	public function getUsername() {
		return $this->username;
	}
	/**
	 * Set the account username
	 * @param string $username username
	 */
	public function setUsername( $username ) {
		if ( is_string($username) && !empty($username) )
			$this->username = $username;
		return $this;
	}
	/**
	 * The person's gender. male|female
	 * @return string male|female
	 */
	public function getGender() {
		return $this->gender;
	}
	/**
	 * Set the person's gender
	 * @param string $gender male|female
	 */
	public function setGender( $gender ) {
		if ( is_string($gender) && ( $gender === 'male' || $gender === 'female' ) )
			$this->gender = $gender;
		return $this;
	}
}
class OpenGraphProtocolBook extends OpenGraphProtocolObject {
	/**
	 * Property prefix
	 * @var string
	 */
	const PREFIX = 'book';
	/**
	 * prefix namespace
	 * @var string
	 */
	const NS = 'http://ogp.me/ns/book#';
	/**
	 * Book authors as an array of URIs.
	 * The target URI is expected to have an Open Graph protocol type of 'profile'
	 * @var array
	 */
	protected $author;
	/**
	 * International Standard Book Number. ISBN-10 and ISBN-13 accepted
	 * @link http://en.wikipedia.org/wiki/International_Standard_Book_Number ISBN
	 * @var string
	 */
	protected $isbn;
	/**
	 * The date the book was released, or planned release if in future.
	 * Stored as an ISO 8601 date string normalized to UTC for consistency
	 * @var string
	 */
	protected $release_date;
	/**
	 * Tag words describing book content and subjects
	 * @var array
	 */
	protected $tag;
	public function __construct() {
		$this->author = array();
		$this->tag = array();
	}
	/**
	 * Book author URIs
	 * @return array author URIs
	 */
	public function getAuthors() {
		return $this->author;
	}
	/**
	 * Add an author URI.
	 *
	 * @param string $author_uri
	 */
	public function addAuthor( $author_uri ) {
		if ( static::is_valid_url($author_uri) && !in_array($author_uri, $this->author))
			$this->author[] = $author_uri;
		return $this;
	}
	/**
	 * International Standard Book Number
	 *
	 * @return string
	 */
	public function getISBN() {
		return $this->isbn;
	}
	/**
	 * Set an International Standard Book Number
	 *
	 * @param string $isbn
	 */
	public function setISBN( $isbn ) {
		if ( is_string( $isbn ) ) {
			$isbn = trim( str_replace('-', '', $isbn) );
			if ( strlen($isbn) === 10 && is_numeric( substr($isbn, 0 , 9) ) ) { // published before 2007
				$verifysum = 0;
				$chars = str_split( $isbn );
				for( $i=0; $i<9; $i++ ) {
					$verifysum += ( (int) $chars[$i] ) * (10 - $i);
				}
				$check_digit = 11 - ($verifysum % 11);
				if ( $check_digit == $chars[9] || ($chars[9] == 'X' && $check_digit == 10) )
					$this->isbn = $isbn;
			} elseif ( strlen($isbn) === 13 && is_numeric( substr($isbn, 0, 12 ) ) ) {
				$verifysum = 0;
				$chars = str_split( $isbn );
				for( $i=0; $i<12; $i++ ) {
					$verifysum += ( (int) $chars[$i] ) * ( ( ($i%2) ===0 ) ? 1:3 );
				}
				$check_digit = 10 - ( $verifysum%10 );
				if ( $check_digit == $chars[12] )
					$this->isbn = $isbn;
			}
		}
		return $this;
	}
	/**
	 * Book release date
	 *
	 * @return string release date in ISO 8601 format
	 */
	public function getReleaseDate() {
		return $this->release_date;
	}
	/**
	 * Set the book release date
	 *
	 * @param DateTime|string $release_date release date as DateTime or as an ISO 8601 formatted string
	 */
	public function setReleaseDate( $release_date ) {
		if ( $release_date instanceof DateTime )
			$this->release_date = static::datetime_to_iso_8601($release_date);
		else if ( is_string($release_date) && strlen($release_date) >= 10 ) // at least YYYY-MM-DD
			$this->release_date = $release_date;
		return $this;
	}
	/**
	 * Book subject tags
	 *
	 * @return array Topic tags
	 */
	public function getTags() {
		return $this->tag;
	}
	/**
	 * Add a book topic tag
	 *
	 * @param string $tag topic tag
	 */
	public function addTag( $tag ) {
		if ( is_string($tag) && !empty($tag) && !in_array($tag, $this->tag) )
			$this->tag[] = $tag;
		return $this;
	}
}
/**
 * Video movie, TV show, and other all share the same properies.
 * Video episode extends this class to associate with a TV show 
 * 
 * @link http://ogp.me/#type_video Open Graph protocol video object
 */
class OpenGraphProtocolVideoObject extends OpenGraphProtocolObject {
	/**
	 * Property prefix
	 * @var string
	 */
	const PREFIX = 'video';
	/**
	 * prefix namespace
	 * @var string
	 */
	const NS = 'http://ogp.me/ns/video#';
	/**
	 * Array of actor URLs
	 * @var array
	 */
	protected $actor;
	/**
	 * Array of director URLs
	 * @var array
	 */
	protected $director;
	/**
	 * Array of writer URIs
	 * @var array
	 */
	protected $writer;
	/**
	 * Video duration in whole seconds
	 * @var int
	 */
	protected $duration;
	/**
	 * The date the movie was first released. ISO 8601 formatted string
	 * @var string
	 */
	protected $release_date;
	/**
	 * Tag words associated with the movie
	 * @var array
	 */
	protected $tag;
	public function __construct() {
		$this->actor = array();
		$this->director = array();
		$this->writer = array();
		$this->tag = array();
	}
	/**
	 * Get an array of actor URLs
	 *
	 * @return array actor URLs
	 */
	public function getActors() {
		return $this->actor;
	}
	/**
	 * Add an actor URL with an optional role association
	 *
	 * @param string $url Author URL of og:type profile
	 * @param string $role The role the given actor played in this video work.
	 */
	public function addActor( $url, $role='' ) {
		if ( static::is_valid_url($url) && !in_array($url, $this->actor) ) {
			if ( !empty($role) && is_string($role) )
				$this->actor[] = array( $url, 'role' => $role );
			else
				$this->actor[] = $url;
		}
		return $this;
	}
	/**
	 * An array of director URLs
	 *
	 * @return array director URLs
	 */
	public function getDirectors() {
		return $this->director;
	}
	/**
	 * Add a director profile URL
	 *
	 * @param string $url director profile URL
	 */
	public function addDirector( $url ) {
		if ( static::is_valid_url($url) && !in_array($url, $this->director) )
			$this->director[] = $url;
		return $this;
	}
	/**
	 * An array of writer URLs
	 *
	 * @return array writer URLs
	 */
	public function getWriters() {
		return $this->writer;
	}
	/**
	 * Add a writer profile URL
	 *
	 * @param string $url writer profile URL
	 *
	 * @return OpenGraphProtocolVideoObject
	 */
	public function addWriter( $url ) {
		if ( static::is_valid_url($url) && !in_array($url, $this->writer) )
			$this->writer[] = $url;
			
		return $this;
	}
	/**
	 * Duration of the video in whole seconds
	 *
	 * @return int duration in whole seconds
	 */
	public function getDuration() {
		return $this->duration;
	}
	/**
	 * Set the video duration in whole seconds
	 *
	 * @param int $duration video duration in whole seconds 
	 */
	public function setDuration( $duration ) {
		if ( is_int($duration) && $duration > 0 )
			$this->duration = $duration;
		return $this;
	}
	/**
	 * The release date as an ISO 8601 formatted string
	 *
	 * @return string release date as an ISO 8601 formatted string
	 */
	public function getReleaseDate() {
		return $this->release_date;
	}
	/**
	 * Set the date this video was first released
	 *
	 * @param DateTime|string $release_date date video was first released
	 */
	public function setReleaseDate( $release_date ) {
		if ( $release_date instanceof DateTime )
			$this->release_date = static::datetime_to_iso_8601($release_date);
		else if ( is_string($release_date) && strlen($release_date) >= 10 ) // at least YYYY-MM-DD
			$this->release_date = $release_date;
		return $this;
	}
	/**
	 * An array of tag words associated with this video
	 *
	 * @return array tags
	 */
	public function getTags() {
		return $this->tag;
	}
	/**
	 * Add a tag word or topic related to this video
	 *
	 * @param string $tag tag word or topic 
	 */
	public function addTag( $tag ) {
		if ( is_string($tag) && !in_array($tag, $this->tag) )
			$this->tag[] = $tag;
		return $this;
	}
}
/**
 * @link http://ogp.me/#type_video.episode Video episode
 */
class OpenGraphProtocolVideoEpisode extends OpenGraphProtocolVideoObject {
	/**
	 * URL of a video.tv_show which this episode belongs to
	 * @var string
	 */
	protected $series;
	/**
	 * URL of a video.tv_show which this episode belongs to
	 */
	public function getSeries() {
		return $this->series;
	}
	/**
	 * Set the URL of a video.tv_show which this episode belongs to
	 *
	 * @param string $url URL of a video.tv_show
	 */
	public function setSeries( $url ) {
		if ( static::is_valid_url($url) )
			$this->series = $url;
		return $this;
	}
}

?>