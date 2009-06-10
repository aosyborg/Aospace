<?php

/**
 * Author: David Symons
 * Home page: http://www.aospace.com
 * Release Date: 11 March 2009
 * License: Licensed under The MIT License. See http://www.opensource.org/licenses/mit-license.php
 *
 * Purpose: To notify developers with a detailed stacktrace and variable settings when bad things
 * happen to good applications
 */

/**
 * @category Library
 */

class Library_Db
{
	private $_database;
	private $_server;
	private $_username;
	private $_password;
	private $_stmt;
	private $_values;
	private $_link;

	public function __construct($database = 'defaultDatabase')
	{
		$this->_database = $database;
		$this->_server = '';	//usually localhost
		$this->_username = '';
		$this->_password = '';
	}

	public function prepare($stmt)
	{
		$this->_stmt = $stmt;
		$this->_values = array();

		return $this;
	}

	public function bindValue($value)
	{
		$this->_values[] = $value;
	}

	public function execute()
	{
		// Connect to the database
		$this->connect();

		// Safty first
		foreach ($this->_values as &$value)
			$value = "'".mysql_real_escape_string((string)($value))."'";


		// If there are values to bind, bind them to the query
		if (!empty($this->_values)) {
			$stmt = implode(", ", $this->_values);
			eval('$this->_stmt = sprintf("'.$this->_stmt.'", '.$stmt.');');
		}

		// Query the data
		$result = mysql_query($this->_stmt);

		// If there is bad data, throw an exception
		if (!$result) {
			$this->disconnect();
			throw new DBException(mysql_error($this->_link));
		}

		// Store query result in an array where each element is a row
		$results = array();
		while (@$row = mysql_fetch_assoc($result))
			$results[] = $row;

		// Disconnect and return
		$this->disconnect();

		return $results;
	}

	public function getLastStmt()
	{
		return $this->_stmt;
	}

	private function connect()
	{
		$this->_link = mysql_connect($this->_server, $this->_username, $this->_password);
		if (!$this->_link)
			throw new DBException('Unable to connect to database');

		if (!mysql_select_db($this->_database))
			throw new DBException("Unable to select database '{$this->_database}'");
	}

	private function disconnect()
	{
		mysql_close();
	}
}

?>
