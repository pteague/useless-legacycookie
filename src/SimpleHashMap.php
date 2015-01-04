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

use ArrayObject;

/**
 *
 * @package    Useless\Legacy
 */
class SimpleHashMap
	extends ArrayObject
	implements SimpleHashMapInterface
{
	public function get( $key )
	{
		if ( $this->offsetExists( $key ) ) {
			return $this->offsetGet($key);
		}
	}

	public function put( $key, $value )
	{
		$this->offsetSet( $key, $value );
	}
}

