<?php
/*
*      Robo Gallery     
*      Version: 1.5
*      By Robosoft
*
*      Contact: http://robosoft.co
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2015, Robosoft. All rights reserved.
*      Available only in http://robosoft.co/
*/



if( !class_exists('RoboGalleryConfig') ){
	class RoboGalleryConfig {

    	public static function guides() {
    		
    		$guides =  array(
				array(
					'link'=> 	'https://www.youtube.com/watch?v=DdCpRuLFxzk',
					'text'=> 	'How to make custom grid layout?',
					'class'=> 	'violet'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=m9XIeqMnhYI',
					'text'=> 	'Install and configuration guide',
					'class'=> 	'green'
				),
			);

			return $guides[ array_rand( $guides ) ];
    	}
	}
}