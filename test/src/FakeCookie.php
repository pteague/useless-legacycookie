<?php
/**
 *
 * @copyright  (c) Patrick Teague
 * @link       https://github.com/pteague/useless-legacycookie/
 * @date       2014-11-17
 * @license    For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * @package    useless/legacycookie
 */


/**
 * Part of useless/legacycookie
 *
 * @category useless/legacycookie
 */
namespace Useless\Legacy;

function setcookie(
	$name
	,$value = null
	,$expire = 0
	,$path = null
	,$domain = null
	,$secure = false
	,$httponly = false
) {
	FakeCookie::setCookie( $name, $value, $expire, $path, $domain, $secure, $httponly );
}

/**
 *
 * @package    Useless\Legacy
 */
class FakeCookie
{
	/**
	 * @var \Useless\Legacy\SimpleHashMapInterface
	 */
	static protected $cookies;

	static public function getCookies()
	{
		return static::$cookies;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param int $expire
	 * @param string $path
	 * @param string $domain
	 * @param bool $secure
	 * @param bool $httponly
	 */
	static public function setCookie( $name, $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httponly = false )
	{
		static::$cookies->put( $name, array(
			'name' => $name,
			'value' => $value,
			'expire' => $expire,
			'path' => $path,
			'domain' => $domain,
			'secure' => $secure,
			'httponly' => $httponly,
		) );
	}

	static public function resetCookies( SimpleHashMapInterface $cookies )
	{
		static::$cookies = $cookies;
	}

}

