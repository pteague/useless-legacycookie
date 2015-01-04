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
	protected $cookie;
	protected $cookieMap;
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

	public function testCookie()
	{
		$this->assertTrue( true );
	}
}
