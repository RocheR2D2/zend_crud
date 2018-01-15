<?php
declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{	

	
    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }
    public function createMeetupFromNameDesDate(string $name, string $description, datetime $startTime, datetime $endTime)
    {
        return new Meetup($name, $description, $startTime, $endTime);
    }
    
}
?>