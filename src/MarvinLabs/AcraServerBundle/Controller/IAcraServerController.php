<?php
 
namespace MarvinLabs\AcraServerBundle\Controller;
 
/**
 * All controllers from this Bundle should implement this interface. It provides the data common to the templates used as a base. 
 * For example, a list of all applications to render the main navigation menu
 *  
 * @author Vincent Prat @ MarvinLabs
 */
interface IAcraServerController
{
	/**
	 * Set the applications available in the database
	 * 
	 * @param array $applications
	 */
    public function setApplications($applications);
}