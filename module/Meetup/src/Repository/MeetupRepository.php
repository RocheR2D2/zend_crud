<?php

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use DateTime;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{	

	
    public function add($meetup)
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function update($meetup)
    {
        
    }

    public function delete($meetup)
    {
        $this->getEntityManager()->remove($meetup);
        $this->getEntityManager()->flush();
    }

    public function createMeetupFromNameDescription(string $name, string $description, DateTime $startTime, DateTime $endTime)
    {

        $meetup = new Meetup($name, $description, $startTime, $endTime);
        return $meetup;

    }
    
}
?>