<?php

namespace Meetup\InputFilter;


use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Callback;
use Zend\Validator\ValidatorChain;
use Zend\Validator\StringLength;
use Zend\Validator\Date;
use Zend\I18n\Validator\Alnum;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use DateTime;

class FormFilter extends InputFilter
{
    public function __construct()
    {
        $title = new Input('title');
        $title->setRequired(true);
        $title->setValidatorChain($this->getTitleValidatorChain());
        $title->setFilterChain($this->getStringTrimFilterChain());

        $description = new Input('description');
        $description->setRequired(true);
        $description->setValidatorChain($this->getDescriptionValidatorChain());

        $startTime = new Input('startTime');
        $startTime->setRequired(true);
        $startTime->setValidatorChain($this->getStartTimeValidatorChain());


        $endTime = new Input('endTime');
        $endTime->setRequired(true);

        $endTime->setValidatorChain($this->getEndTimeValidatorChain($endTime, 'startTime'));

        $this->add($title);
        $this->add($description);
        $this->add($startTime);
        $this->add($endTime);
    }

    protected function  getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());

        return $filterChain;
    }

    protected function getTitleValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(5);
        $stringLength->setMax(15);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }


    protected function getDescriptionValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(10);
        $stringLength->setMax(120);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    protected function getStartTimeValidatorChain()
    {
        $dateFormat = new Date();

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($dateFormat);

        return $validatorChain;
    }

    protected function getEndTimeValidatorChain($value, $context = [])
    {
        $dateFormat = new Date();
        $callback = new Callback(
            function($value, $context = []) {
                $dateA = $context['startTime'];
                $dateB = $value;
                return $dateA <= $dateB;
            }
        );
        $callback->setMessage('End time cannont be smaller than start time');

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($dateFormat);
        $validatorChain->attach($callback);


        return $validatorChain;
    }


}

?>