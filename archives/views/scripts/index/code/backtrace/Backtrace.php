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

class Library_Backtrace
{
	/**
	 * Developer-specified identifier for the area of code in which the error
	 * occurred, helpful during debugging when tracking down errors.
	 *
	 * @access private
	 * @var string
	 */
	private $_identifier;
	private $_email = "symosn@aospace.com";
	
	/**
	 * Constructor
	 *
	 * @param string $identifier
	 */
	public function __construct($identifier)
	{
		$this->_identifier = (string)$identifier;
	}

	/**
	 * Logs a detailed backtrace of the calls leading up to the call to this
	 * method, and other useful debugging information.
	 *
	 * This method can accept either a string or an object with an Exception
	 * base class.  If an Exception is passed in, this method will print the
	 * message and the exception trace in addition to the trace to this method
	 * call.
	 * 
	 * @param string|Exception $error
	 * @return void
	 */
	public function log($error)
	{
		$message =
		    "[{$this->_getCurrentTime()}]: error with identifier ".
		    "\"{$this->_identifier}\"\n\n";

		if ($error instanceof Exception) {
			$message .= 'Exception type: ' . get_class($error) . "\n\n";
			$message .= "Exception::getMessage():\n";
			$message .= "{$error->getMessage()}\n\n";
			$message .= "Exception::getTraceAsString():\n";
			$message .= "{$error->getTraceAsString()}\n\n";
		} else {
			$message .= "Message:\n";
			$message .= (string)$error . "\n\n";
		}

		$message .= "Output of debug_print_backtrace():\n";

		// Obtain the trace to this function call
		ob_start();
		debug_print_backtrace();
		$message .= ob_get_clean() . "\n";

		// Get a dump of what our session looks like
		$message .= "\$_SESSION dump:\n";
		ob_start();
		if (isset($_SESSION))
			var_dump($_SESSION);
		else
			$message .= "\$_SESSION not set.\n";
		$message .= ob_get_clean() . "\n";

		// Get a dump of what our GET requests look like
		$message .= "\$_GET dump:\n";
		ob_start();
		if (isset($_GET))
			var_dump($_GET);
		else
			$message .= "\$_GET not set.\n";
		$message .= ob_get_clean() . "\n";

		// Get a dump of what our POST requests look like
		$message .= "\$_POST dump:\n";
		ob_start();
		if (isset($_POST))
			var_dump($_POST);
		else
			$message .= "\$_POST not set.\n";
		$message .= ob_get_clean();

		$this->_mail($message);
	}

	/**
	 * Mails the contents of the parameter to the method as a form of logging.
	 *
	 * @param string
	 * @return void
	 */
	private function _mail($message)
	{
		$uname = posix_uname();
		$hostname = $uname['nodename'];

		$mailto = $this->_email;
		$subject = "PHP backtrace from $hostname";

		mail($mailto, $subject, $message);
		echo "<pre>$message</pre>";
	}

	/*
	 * Gets the current time, formatted for log output.
	 *
	 * @return string
	 */
	private function _getCurrentTime()
	{
		return date('D M j G:i:s Y');
	}
}

?>
