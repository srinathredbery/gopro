<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Env_reader
{
	public function __construct()
	{
		 $dotenv = Dotenv\Dotenv::create(FCPATH);
		 $dotenv->load();
	}
}
