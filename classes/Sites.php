<?php

Zend_Loader::loadClass('SiteModel', 'models');

abstract class Aospace_Sites
{
	const ALL = true;

	public function fetch($id = 0)
	{
		$sites = array();

		if ($id == ALL) {
			$db = new Library_Db;
			$stmt = $db->prepare(
			   'SELECT id '.
			   'FROM main_sites '.
			   'ORDER BY name ASC'
			);
			$rows = $stmt->execute();
			foreach ($rows as $row)
				$sites[] = new SiteModel($row['id']);
		}

		else {
			$id = (int)$id;
			$sites[] = new SiteModel($id);
		}

		return $sites;
	}
}
