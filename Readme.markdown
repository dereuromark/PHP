# (Cake)PHP Utility class: Str

* PHP >= 5.3 (and PHP6 since it won't be fixed any time soon)
* optional: CakePHP 2.x (as Str class in Utility package)


## Idea
Tries to overcome the issue with chaotic argument order for string php functions.

Just read [1]
and you know what this is all about.

## Basic improvements

1. argument order now consistent
2. unified `_` and non-`_` (removed the `str_` prefix and made the methods camelCased)
3. tried to fix the naming inconsistencies
4. fixed some inconsistencies in CI (case insensitive) method calls (less arguments and always the same now)


## Usage in plain PHP

Put the Str class in a file `Str.php` and include it in your project:

	require_once('/path/to/file/Str.php');
	
You can then use the class like this:

	$string = Str::replace('needle', 'censored', 'haystack with needle and more');
		

## Usage in CakePHP

Put the Str class in:

	/APP/Lib/Utility/Str.php
	
The test cases go in:
	
	/APP/Test/Case/Lib/Utility/StrTest.php
	
Import it in your bootstrap:

	App::uses('Str', 'Utility');
	
You can then use the class like this:

	$string = Str::replace('needle', 'censored', 'haystack with needle and more');
	
	
## TODO

* Complete string methods
* More description in doc blocks
* More tests
* Speed comparison tests (compared to basic methods)

## History

* deprecated draft 0.1: removed the Php class in favor of Str class (without any array functions as they seem to be fine)

## Feedback
Any feedback/contribution is welcome.


[1]: http://www.skyrocket.be/2009/05/30/php-function-naming-and-argument-order "[php-function-naming-and-argument-order]"