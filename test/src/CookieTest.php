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
class CookieTest
	extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \Useless\Legacy\Cookie
	 */
	protected $cookie;

	/**
	 * @var \Useless\Legacy\SimpleHashMapInterface
	 */
	protected $cookieMap;

	/**
	 * @var \Useless\Legacy\SimpleHashMapInterface
	 */
	protected $sessionMap;

	public function setUp()
	{
		$this->cookieMap = $this->getNewCookieMap();
		FakeCookie::resetCookies( $this->cookieMap );
		$this->sessionMap = $this->getNewSessionMap();
		$this->cookie = $this->getNewCookie( $this->sessionMap, $this->cookieMap );
	}

	public function getNewCookie( SimpleHashMapInterface $session, SimpleHashMapInterface $cookie )
	{
		return new Cookie( $session, $cookie );
	}

	public function getNewCookieMap()
	{
		return new SimpleHashMap();
	}

	public function getNewSessionMap()
	{
		return new SimpleHashMap();
	}

	public function testGetSetSession()
	{
		$cookie = new Cookie();
		$session = $this->getNewSessionMap();
		$cookie->setSessionObject( $session );
		$this->assertEquals( $session, $cookie->getSessionObject() );
	}

	public function testGetSetCookie()
	{
		$cookie = new Cookie();
		$cookieMap = $this->getNewCookieMap();
		$cookie->setCookieObject( $cookieMap );
		$this->assertEquals( $cookieMap, $cookie->getCookieObject() );
	}

	public function providerTestCookie()
	{
		return array(
			array( array(
				'name' => 'foo',
				'value' => null,
				'expire' => 0,
				'path' => null,
				'domain' => null,
				'secure' => false,
				'httponly' => false,
			), ),
			array( array(
				'name' => 'foo',
				'value' => 'bar',
				'expire' => 60,
				'path' => '/',
				'domain' => null,
				'secure' => true,
				'httponly' => false,
			), ),
			array( array(
				'name' => 'bar',
				'value' => 'baz',
				'expire' => 360,
				'path' => null,
				'domain' => null,
				'secure' => false,
				'httponly' => false,
			), ),
			array( array(
				'name' => 'baz',
				'value' => 'foo',
				'expire' => 0,
				'path' => '/',
				'domain' => null,
				'secure' => false,
				'httponly' => false,
			), ),
		);
	}

	/**
	 * @dataProvider providerTestCookie
	 * @param $cookie
	 */
	public function testCookieUseLegacy( $cookie )
	{
		$this->cookie->setUseLegacyCookies( true );
		call_user_func_array( array( $this->cookie, 'setCookie' ), $cookie );

		$this->assertEquals( $cookie['value'], $this->sessionMap->get( $cookie['name'] ) );
		$cookieMap = FakeCookie::getCookies();
		$this->assertEquals( $cookie, $cookieMap->get( $cookie['name'] ) );
	}

	/**
	 * @dataProvider providerTestCookie
	 * @param $cookie
	 */
	public function testCookieNoLegacy( $cookie )
	{
		$this->cookie->setUseLegacyCookies( false );
		call_user_func_array( array( $this->cookie, 'setCookie' ), $cookie );

		$this->assertEquals( $cookie['value'], $this->sessionMap->get( $cookie['name'] ) );
		$cookieMap = FakeCookie::getCookies();
		$this->assertNull( $cookieMap->get( $cookie['name'] ) );
	}

}
