<?php
/**
 * Class SampleTest
 *
 * @package 360player
 */

/**
 * Filters
 */
class FiltersTest extends WP_UnitTestCase {

	/**
	 * Test width filter
	 */
	function test_width() {
		//default width
		$test_player_io = new Player_360io();
		$this->assertEquals( $test_player_io->width, 560 );

		// filtered width
		add_filter( '360player_embed_width', function(){ return 1000; } );
		$test_player_io->prepare_iframe();

		$this->assertEquals( $test_player_io->width, 1000 );
	}

	/**
	 * Test height filter
	 */

	function test_height() {
		//default height
		$test_player_io = new Player_360io();
		$this->assertEquals( $test_player_io->height, 315 );

		// filtered width
		add_filter( '360player_embed_height', function(){ return 1000; } );
		$test_player_io->prepare_iframe();

		$this->assertEquals( $test_player_io->height, 1000 );
	}


	function test_class() {
		//default width
		$test_player_io = new Player_360io();
		$this->assertEquals( $test_player_io->class, '' );

		// filtered width
		add_filter( '360player_embed_class', function(){ return 'test_class'; } );
		$test_player_io->prepare_iframe();

		$this->assertEquals( $test_player_io->class, 'test_class' );
	}

	function test_regexp() {
		$test_player_io = new Player_360io();

		$matches = '';
		$subject = 'https://360player.io/player/Zyu5Ua/';
		$pattern = $test_player_io->pattern;

		// player test
		preg_match ( $pattern , $subject, $matches );
		$this->assertEquals( $matches[1], 'Zyu5Ua' );

		// p test
		$matches = '';
		$subject = 'https://360player.io/p/Zyu5Ua/';

		preg_match ( $pattern , $subject, $matches );
		$this->assertEquals( $matches[1], 'Zyu5Ua' );

		// wrong address
		$matches = '';
		$subject = 'https://player.io/p/Zyu5Ua/';
		
		$this->assertFalse( isset( $matches[1] ) );
	}

}
