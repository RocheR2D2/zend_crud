<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Meetup\Controller;


use Meetup\Entity\Meetup;
use Meetup\Form\MeetupForm;
use Meetup\Repository\MeetupRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }


    public function indexAction()
    {
        $form = $this->meetupForm;
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
            'form' => $form,
        ]);
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id', '-1');
        $meetup = $this->meetupRepository->find($id);

        return new ViewModel([
            'meetup' => $meetup,
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;
      
        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetupFromNameDescription(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    date_create_from_format('Y-m-d', $form->getData()['startTime']),
                    date_create_from_format('Y-m-d', $form->getData()['endTime'])
                );
                $this->meetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetups');
            }
        }
        $form->prepare();
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function updateAction()
    {

        $id = $this->params()->fromRoute('id', '-1');
        $meetup = $this->meetupRepository->find($id);/* @var $meetup \Meetup\Entity\Meetup */

        $form = $this->meetupForm;
        /* @var $request Request */

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $newmeetup = $this->meetupRepository->updateMeetup(
                    $meetup,
                    $form->getData()['title'],
                    $form->getData()['description'],
                    date_create_from_format('Y-m-d', $form->getData()['startTime']),
                    date_create_from_format('Y-m-d', $form->getData()['endTime'])
                );


                $this->meetupRepository->update($newmeetup);

                return $this->redirect()->toRoute('meetups');

            }
        }
        $form->prepare();


        return new ViewModel([
            'meetup' => $meetup,
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {

        $id = $this->params()->fromRoute('id', '-1');
        $meetup = $this->meetupRepository->find($id);


        $this->meetupRepository->delete($meetup);

        return $this->redirect()->toRoute('meetups');
    }
}
