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


/**
 *
 * @package    Useless\Legacy
 */
class Cookie
{
	/**
	 * @var \Useless\Legacy\SimpleHashMapInterface
	 */
	protected $cookie;

	/**
	 * @var \Useless\Legacy\SimpleHashMapInterface
	 */
	protected $session;

	/**
	 * @var bool
	 */
	protected $useLegacyCookies = false;

	public function __construct( SimpleHashMapInterface $session = null, SimpleHashMapInterface $cookie = null )
	{
		if ( $cookie ) {
			$this->setCookieObject( $cookie );
		}
		if ( $session ) {
			$this->setSessionObject( $session );
		}
	}

	/**
	 * @param string $name
	 * @return mixed|void
	 */
	public function getCookie( $name )
	{
		$cookie = $this->getCookieObject();
		$session = $this->getSessionObject();
		if ( $cookie ) {
			$rv = $cookie->get( $name );
			if ( $rv ) {
				return $rv;
			}
		}
		if ( $session ) {
			$rv = $session->get( $name );
			if ( $rv ) {
				return $rv;
			}
		}
	}

	/**
	 * @return \Useless\Legacy\SimpleHashMapInterface
	 */
	public function getCookieObject()
	{
		return $this->cookie;
	}

	/**
	 * @return \Useless\Legacy\SimpleHashMapInterface
	 */
	public function getSessionObject()
	{
		return $this->session;
	}

	/**
	 * @return bool
	 */
	public function getUseLegacyCookies()
	{
		return $this->useLegacyCookies;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param int $expire
	 * @param string $path
	 * @param string $domain
	 * @param bool $secure
	 * @param bool $httponly
	 * @return bool|void
	 */
	public function setCookie( $name, $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httponly = false )
	{
		$rv = true;
		$session = $this->getSessionObject();
		if ( $session ) {
			$session->put( $name, $value );
		}
		if ( $this->getUseLegacyCookies() ) {
			$rv = setcookie( $name, $value, $expire, $path, $domain, $secure, $httponly );
		}
		return $rv;
	}

	/**
	 * @param \Useless\Legacy\SimpleHashMapInterface $cookie
	 * @return $this
	 */
	public function setCookieObject( SimpleHashMapInterface $cookie )
	{
		$this->cookie = $cookie;
		return $this;
	}

	/**
	 * @param \Useless\Legacy\SimpleHashMapInterface $session
	 * @return $this
	 */
	public function setSessionObject( SimpleHashMapInterface $session )
	{
		$this->session = $session;
		return $this;
	}

	/**
	 * @param bool $useLegacyCookies
	 * @return $this
	 */
	public function setUseLegacyCookies( $useLegacyCookies )
	{
		$this->useLegacyCookies = (bool)$useLegacyCookies;
		return $this;
	}

}
