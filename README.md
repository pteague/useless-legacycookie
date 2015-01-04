useless-legacycookie
====================

PHP classes to help merge crappy legacy code that depends on cookies to utilize sessions instead.

```php
<?php
session_start();
use Useless\Legacy\Cookie;
use Useless\Legacy\SimpleHashMap;

$cookie = new Cookie( new SimpleHashMap( $_SESSION ), new SimpleHashMap( $_COOKIE ) );
// @TODO switch this to false once all legacy code is replaced
$cookie->setUseLegacyCookies( true );

// replace old code:
$success = setcookie( 'foo', 'bar', 60*60*24*7, '/' );
// with:
$success = $cookie->setCookie( 'foo', 'bar', 60*60*24*7, '/' );


// replace old code:
$foo = $HTTP_COOKIE_VARS['foo'];
$foo = $_COOKIE['foo'];
// with:
$foo = $cookie->getCookie( 'foo' );
```
