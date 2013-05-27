<?php
 
namespace MarvinLabs\AcraServerBundle\EventListener;
 
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;

use MarvinLabs\AcraServerBundle\Controller\IAcraServerController;
 
/**
 * 
 * @author Vincent Prat @ MarvinLabs
 */
class BeforeControllerListener
{
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
 
        if (!is_array($controller)) {
            // not a object but a different kind of callable. Do nothing
            return;
        }
 
        $controllerObject = $controller[0];
 
        // skip initializing for exceptions
        if ($controllerObject instanceof ExceptionController) {
            return;
        }
 
        if ($controllerObject instanceof IAcraServerController) {
			$doctrine = $controllerObject->getDoctrine()->getManager();
	        $crashRepo = $doctrine->getRepository('MLabsAcraServerBundle:Crash');	
	        $applications = $crashRepo->findAllApplications();
	        
            $controllerObject->setApplications($applications);
        }
    }
}