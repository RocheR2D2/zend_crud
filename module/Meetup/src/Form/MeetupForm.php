<?php

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Element\Date;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;


class MeetupForm extends Form implements InputFilterProviderInterface
{

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */

    public function __construct()
    {
        parent::__construct('meetup');
        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'attributes' => [
                'class' => 'form-control'
            ],

        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);
        $this->add([
            'type' => Date::class,
            'name' => 'startTime',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);
        $this->add([
            'type' => Date::class,
            'name' => 'endTime',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);
        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],

        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 8,
                            'max' => 12,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 10,
                            'max' => 30,
                        ],
                    ],
                ],
            ],

            'startTime' => [

            ],

            'endTime' => [
                'validators' => [
                    [
                        'endTime' > 'starTime',
                    ],
                ],
            ],
        ];
    }
}

?>