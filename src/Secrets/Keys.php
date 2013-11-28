<?php

namespace Secrets;

class Keys{

	/**
	 * Load the keys from php key files that possess the $secrets array. Basically 
	 * you call $keys = Keys::load('path/to/secrets'); Then you can assign it like 
	 * $_ENV['secrets'] = $keys.
	 * @param  String $secrets_path Relative path to secrets
	 * @return Array                Array of secret keys
	 */
	public static function load($secrets_path){

		$secrets_loaded = false;

		//see if "secrets folder" exists
		if(file_exists($secrets_path) AND is_dir($secrets_path)){

			foreach(new DirectoryIterator($secrets_path) as $file){

				//ignore dots and non-php extensions and this file itself
				if($file->isDot() OR $file->getExtension() != 'php') continue;
				
				$secrets_loaded = true;

				include_once($file->getPathname());

			}

		}

		if($secrets_loaded){

			return $secrets;

		}

	}

}