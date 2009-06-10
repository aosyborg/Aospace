<?php

/**
 * Author: David Symons
 * Home page: http://www.aospace.com
 * Release Date: 11 March 2009
 * License: Licensed under The MIT License. See http://www.opensource.org/licenses/mit-license.php
 *
 * Purpose: Provides sane defaults for and the ability to customize the header
 */

/**
 * @category Library
 */

class Library_Header
{
	/**
	 * The title, if set, will be displayed at the top of the page and also
	 * as part of the page-level title
	 *
	 * @access private
	 * @var string
	 */
	private $_title;

	/**
	 * Contents of the logo image tag, can be redefined to change the logo and
	 * its shape
	 *
	 * @access private
	 * @var string
	 */
	private $_logoimgtag = '';

	/**
	 * Where the logo should link to
	 *
	 * @access private
	 * @var string
	 */
	private $_logolink = '/';

	/**
	 * Links that will appear at the top of the page
	 *
	 * @access private
	 * @var array
	 */
	private $_sitelinks = array();

	/**
	 * Contents of the meta tags that will be displayed in the header
	 *
	 * @access private
	 * @var array
	 */
	private $_metatags = array();

	/**
	 * Contents of the link tags that will be displayed in the header
	 *
	 * @access private
	 * @var array
	 */
	private $_linktags = array();

	/**
	 * Contents of the script tags that will be displayed in the header
	 *
	 * @access private
	 * @var array
	 */
	private $_scripttags = array();

	/**
	 * Add a link to the top
	 *
	 * @param string $link
	 * @return Shared_View_Component_Header Provides a fluent interface
	 */
	public function addSiteLink($link)
	{
		$this->_sitelinks[] = $link;

		return $this;
	}

	/**
	 * Add a meta tag to the header
	 *
	 * You only need to add the body of the tag, the opening and closing tags
	 * are done for you.
	 *
	 * @param string $tag
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function addMetaTag($tag)
	{
		$this->_metatags[] = $tag;

		return $this;
	}

	/**
	 * Add a link tag to the header
	 *
	 * You only need to add the body of the tag, the opening and closing tags
	 * are done for you.
	 *
	 * @param string $tag
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function addLinkTag($tag)
	{
		$this->_linktags[] = $tag;

		return $this;
	}

	/**
	 * Add a script tag to the header
	 *
	 * You only need to add the body of the tag, the opening and closing tags
	 * are done for you.
	 *
	 * @param string $tag
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function addScriptTag($tag)
	{
		$this->_scripttags[] = $tag;

		return $this;
	}

	/**
	 * Allows the logo image tag to be redefined so that a custom logo image
	 * can be used
	 *
	 * You only need to add the body of the tag, the opening and closing tags
	 * are done for you.
	 *
	 * @param string $tag
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function setLogoImgTag($tag)
	{
		$this->_logoimgtag = $tag;

		return $this;
	}

	/**
	 * Sets the page-level title for the header to display
	 *
	 * @param string $title
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function setTitle($title)
	{
		$this->_title = $title;

		return $this;
	}

	/**
	 * Sets the name of the project for the header to display
	 *
	 * @param string $project
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function setProject($project)
	{
		$this->_project = $project;

		return $this;
	}

	/**
	 * Sets the location that will be linked to by the logo (if the logo is
	 * enabled)
	 *
	 * @param string $logolink
	 * @return Shared_View_Component_HorizHeader Provides a fluent interface
	 */
	public function setLogolink($logolink)
	{
		$this->_logolink = $logolink;

		return $this;
	}

	/**
	 * Retrieve any links added to the top
	 *
	 * @return array
	 */
	public function getSiteLinks()
	{
		return $this->_sitelinks;
	}

	/**
	 * Retrieve any meta tags added to the header
	 *
	 * @return array
	 */
	public function getMetaTags()
	{
		return $this->_metatags;
	}

	/**
	 * Retrieve any link tags added to the header
	 *
	 * @return array
	 */
	public function getLinkTags()
	{
		return $this->_linktags;
	}

	/**
	 * Retrieve any script tags added to the header
	 *
	 * @return array
	 */
	public function getScriptTags()
	{
		return $this->_scripttags;
	}

	/**
	 * Returns a boolean flag representing whether or not the header logo is
	 * enabled
	 *
	 * @return bool
	 */
	public function getLogo()
	{
		return $this->_logo;
	}

	/**
	 * Returns the logo image tag
	 *
	 * @return string
	 */
	public function getLogoImgTag()
	{
		return $this->_logoimgtag;
	}

	/**
	 * Returns the header's title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * Returns the display name for the project
	 *
	 * @return string
	 */
	public function getProject()
	{
		return $this->_project;
	}

	/**
	 * Returns the URL that the logo will link to, if the logo is set
	 *
	 * @return string
	 */
	public function getLogoLink()
	{
		return $this->_logolink;
	}

	public function render()
	{
		include 'header.phtml';
	}
}

?>
