<?php

require_once 'Base.php';

class IndexController extends Aospace_Controller_Base
{
	public function indexAction()
	{
		$this->view->header->setTitle('Home')
		                   ->addScriptTag('src="/js/index.js"  type="text/javascript"')
		                   ->addLinkTag('rel="stylesheet" type="text/css" href="/css/index.css"');

		$this->view->tweets = $this->getTweets();
	}

	private function getTweets()
	{
		$twitter = new Zend_Service_Twitter($this->config->twitter->username, $this->config->twitter->password);
		try { return $twitter->status->userTimeline(array('count' => $this->config->twitter->tweetsOnIndex)); }
		catch (Zend_Service_Exception $e) { return false; }
	}

	/**
	 * Ajax call to speed up page loading
	 */
	public function getflickrphotosAction()
	{
		$this->_helper->layout()->disableLayout();
		$flickr = new Zend_Service_Flickr($this->config->flickr->apiKey);

		try { $results = $flickr->userSearch($this->config->flickr->email); }
		catch (Zend_Service_Exception $e) { return false; }

		$photos = array();
		foreach ($results as $result) {
			if ($result->ispublic) {
				$photos[] = $result;
			}
		}

		shuffle($photos);
		$this->view->photos = array_slice($photos, 1, $this->config->flickr->photosOnIndex);

		$this->render('flickrPhotos');
	}
}
