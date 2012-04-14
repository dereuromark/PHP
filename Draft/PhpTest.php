<?php
/**
 * Draft 0.1 for PHP argument order fix
 * 2012-04-13 ms
 */

//App::uses('Php', 'Tools.Utility');
App::uses('MyCakeTestCase', 'Tools.Lib');

/**
 * @see https://bugs.php.net/bug.php?id=44794
 * 2012-04-13 ms
 */
class PhpTest extends MyCakeTestCase {

	/**
	 * fixed 
	 * - documented return type (mixed)
	 * - argument order
	 * - missing underscore
	 */
	public function testStrStr() {
		$res = Php::str_str('some', 'more some text');
		$expected = 'some text';
		$this->assertSame($expected, $res);
		
		$res = Php::str_str('some', 'more som text');
		$expected = false;
		$this->assertSame($expected, $res);
	}
	
	/**
	 * no changes
	 */
	public function testStrReplace() {
		$res = Php::str_replace('some', 'more', 'in some text');
		$expected = 'in more text';
		$this->assertSame($expected, $res);
		
		$count = 0;
		$res = Php::str_replace('some', 'more', 'in some text', $count);
		$this->assertSame($expected, $res);
		$this->assertSame(1, $count);
	}
	
	/**
	 * fixed 
	 * - documented return type (mixed)
	 * - argument order
	 * - missing underscore
	 * 
	 * very strange method
	 */
	public function testStrRchr() {
		$res = Php::str_rchr('some', 'more some text');
		$expected = 'some text';
		$this->assertSame($expected, $res);
		
		# WTF?
		$res = Php::str_rchr('some', 'more som text');
		$expected = 'som text';
		$this->assertSame($expected, $res);
		
		$res = Php::str_rchr('xome', 'more som text');
		$expected = 'xt';
		$this->assertSame($expected, $res);
		
		$res = Php::str_rchr('abc', 'more som text');
		$expected = false;
		$this->assertSame($expected, $res);
		
		$res = Php::str_rchr(120, 'more som text');
		$expected = 'xt';
		$this->assertSame($expected, $res);
	}

	/**
	 * no changes
	 */
	public function testArraySearch() {
		$res = Php::array_search('strings', array('some', 'strings', 'yeah'));
		$expected = 1;
		$this->assertSame($expected, $res);
		
		$res = Php::array_search('strinGs', array('some', 'strings', 'yeah'), true);
		$this->assertSame(false, $res);
		
		$res = Php::array_search('strinGs', array('some', 'strinGs', 'yeah'), true);
		$this->assertSame($expected, $res);
	}
	

}

/**
 * Fix/Unify order, unify _ (strstr to str_str etc).
 * @inspired by http://www.skyrocket.be/2009/05/30/php-function-naming-and-argument-order/comment-page-1
 * 
 * Alternative idea: make two classes
 * - Arr (Arr::inArray, ...)
 * - Str (Str::chr, Str::rchr, ...)
 * Currently all in one class
 * 
 * 2012-04-13 ms
 */
final class Php {
	
	/**
	 * Find the first occurrence of a string
	 * @return mixed
	 */
	final public static function str_str($needle, $haystack, $beforeNeedle  = false) {
		return strstr($haystack, $needle, $beforeNeedle);
	}

	/**
	 * Case-insensitive strstr()
	 * @return mixed
	 */
	final public static function str_istr($needle, $haystack, $beforeNeedle  = false) {
		return stristr($haystack, $needle, $beforeNeedle);
	}
	
	/**
	 * Find the first occurrence of a string - alias of strstr()
	 * @return mixed
	 */
	final public static function str_chr($needle, $haystack, $beforeNeedle  = false) {
		return strchr($haystack, $needle, $beforeNeedle);
	}
	
	/**
	 * Find the last occurrence of a character in a string
	 * Note: If needle contains more than one character, only the first is used. 
	 * This behavior is different from that of strstr(). This behavior is different from that of strstr().
	 * If needle is not a string, it is converted to an integer and applied as the ordinal value of a character.
	 * @return mixed
	 */
	final public static function str_rchr($needle, $haystack) {
		return strrchr($haystack, $needle);
	}
		
	/**
	 * Replace all occurrences of the search string with the replacement string
	 * @return mixed
	 */
	final public static function str_replace($search, $replace, $subject, &$count = null) {
		return str_replace($search, $replace, $subject, $count);
	}
	
	/**
	 * Find the position of the first occurrence of a substring in a string
	 * @return mixed
	 */
	final public static function str_pos($needle, $haystack, $offset = 0) {
		return strpos($haystack, $needle, $offset);
	}
	
	/**
	 * Find the position of the last occurrence of a substring in a string
	 * @return mixed
	 */
	final public static function str_rpos($needle, $haystack, $offset = 0) {
		return strrpos($haystack, $needle, $offset);
	}
	
	/**
	 * Case-insensitive version of str_replace()
	 * @return mixed
	 */
	final public static function str_ireplace($search, $replace, $subject, &$count = null) {
		return str_ireplace($search, $replace, $subject, $count);
	}


/*** all array function seem to have correct order etc ***/


	/**
	 * Checks if the given key or index exists in the array
	 * @return bool
	 */
	final public static function array_key_exists($key, array $search) {
		return array_key_exists($key, $search);
	}
	
	/**
	 * Checks if a value exists in an array
	 * @return bool
	 */
	final public static function in_array($needle, array $haystack, $strict = false) {
		return in_array($needle, $haystack, $strict);
	}
	
	/**
	 * Searches the array for a given value and returns the corresponding key if successful
	 * @return mixed
	 */
	final public static function array_search($needle, array $haystack, $strict = false) {
		return array_search($needle, $haystack, $strict);
	}
	
}
