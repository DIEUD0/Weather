<?php

namespace OpenClassrooms\Projet5\Weather;

abstract class Manager
{
	final protected function dbConnect()
	{
		$db = new \PDO('mysql:host=HOST;dbname=DATABASE;charset=utf8', 'USERNAME', 'PASSWORD');

		return $db;
	}
}
