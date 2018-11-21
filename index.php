<?php

/**
 * My magic file
 *
 * PHP Version 7
 *
 * @category Irrelevant.
 * @package  Jenkins_Tests.
 * @author   Facundo Farias <contacto@facundofarias.com.ar>
 * @license  WTFPL <http://www.wtfpl.net/>
 * @link     https://github.com/fariasf/jenkins-test/
 */

class foo {
	public function foo() {
		bar::sayhi();
	}

	public function bar() {
		if ( true ) {
			for( $i = 0; $i < 1000; $i++ ) {
				if ( false ) {
					if ( true ) {
						$i--;
					} else {
						// Nothing
					}
				} else {
					if ( $a = $b ) {
						if ( $c ) {
							continue;
						}
					}
				}
			}
		} else {
			if ( !!true ) {
				// More stuff
			}
		}
	}
}

static class bar {
	public function sayhi() {
		echo 'Hi';
	}
}