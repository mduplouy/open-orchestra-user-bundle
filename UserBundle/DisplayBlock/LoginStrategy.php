<?php

namespace OpenOrchestra\UserBundle\DisplayBlock;

use OpenOrchestra\DisplayBundle\DisplayBlock\Strategies\AbstractStrategy;
use OpenOrchestra\ModelInterface\Model\ReadBlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

/**
 * Class LoginStrategy
 */
class LoginStrategy extends AbstractStrategy
{
    const LOGIN = 'login';

    protected $tokenManager;
    protected $securityContext;

    /**
     * @param CsrfTokenManagerInterface $tokenManager
     * @param TokenStorageInterface     $securityContext
     */
    public function __construct(CsrfTokenManagerInterface $tokenManager, TokenStorageInterface $securityContext)
    {
        $this->tokenManager = $tokenManager;
        $this->securityContext = $securityContext;
    }

    /**
     * Check if the strategy support this block
     *
     * @param ReadBlockInterface $block
     *
     * @return boolean
     */
    public function support(ReadBlockInterface $block)
    {
        return self::LOGIN == $block->getComponent();
    }

    /**
     * Perform the show action for a block
     *
     * @param ReadBlockInterface $block
     *
     * @return Response
     */
    public function show(ReadBlockInterface $block)
    {
        if( ($user = $this->securityContext->getToken()->getUser()) instanceof UserInterface) {
            return $this->render('OpenOrchestraUserBundle:Security:userLogged.html.twig',array(
                'user' => $user,
            ));
        }

        return $this->render(
            'OpenOrchestraUserBundle:Security:loginForm.html.twig',
            array(
                'csrf_token' => $this->tokenManager->getToken('authenticate')->getValue(),
                'last_username' => ''
            )
        );
    }

    /**
     * Get the name of the strategy
     *
     * @return string
     */
    public function getName()
    {
        return 'login';
    }
}
