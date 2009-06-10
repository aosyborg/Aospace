<?php

class SiteModel
{
	private $_id;
	private $_name;
	private $_url;
	private $_status;
	private $_status_message;
	private $_lastupdated;

	public function __construct($id)
	{
		$db = new Library_Db;
		$stmt = $db->prepare(
		   'SELECT main_sites.name, main_sites.url, main_sites.status as status, main_statuses.status as status_message '.
		   'FROM main_sites, main_statuses '.
		   'WHERE main_sites.status = main_statuses.id '.
		   'AND main_sites.id = %s'
		);
		$stmt->bindValue($id);
		$rows = $stmt->execute();

		if (empty($rows))
			throw new Exception ('invalid id');

		$row = $rows[0];
		$this->_id = $id;
		$this->_name = $row['name'];
		$this->_url = $row['url'];
		$this->_status = $row['status'];
		$this->_status_message = $row['status_message'];
	}

	public function getId()
	{
		return $this->_id;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getStatus()
	{
		switch ($this->_status) {
			case 1: return 'green';  // UP
			case 2: return 'red';    // DOWN
			case 3: return 'yellow'; // UNKNOWN
		}

		return false;
	}

	public function getStatusMessage()
	{
		return $this->_status_message;
	}
}
