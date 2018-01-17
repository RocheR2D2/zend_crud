<?php

namespace Meetup\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;
use Meetup\Entity\Meetup;

final class MeetupRepository extends EntityRepository
{	

	
    public function add($meetup)
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function update($meetup)
    {

        $this->getEntityManager()->flush($meetup);
    }


    public function delete($meetup)
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function updateMeetup(Meetup $meetup, string $title, string $description, DateTime $startTime, DateTime $endTime)
    {

        $meetup->setTitle($title);
        $meetup->setDescription($description);
        $meetup->setStartTime($startTime);
        $meetup->setEndTime($endTime);

        return $meetup;
    }

    public function createMeetupFromNameDescription(string $name, string $description, DateTime $startTime, DateTime $endTime)
    {

        $meetup = new Meetup($name, $description, $startTime, $endTime);
        return $meetup;

    }
    
}
?>