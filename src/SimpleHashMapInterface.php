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
interface SimpleHashMapInterface
{
	/**
	 * @param string $key
	 * @return mixed|void
	 */
	public function get( $key );

	/**
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	public function put( $key, $value );
} 