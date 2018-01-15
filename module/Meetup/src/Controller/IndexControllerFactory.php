<?php

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Form\MeetupForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;


final class IndexControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return IndexController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : IndexController
    {

        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $meetupForm = $container->get(MeetupForm::class);

        return new IndexController($meetupRepository,$meetupForm);
    }
}

?>