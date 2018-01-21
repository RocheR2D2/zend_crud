<?php

namespace Meetup\InputFilter;


use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\ValidatorChain;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alnum;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;

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

        $this->add($title);
        $this->add($description);
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
        $stringLength->setMax(5);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }


    protected function getDescriptionValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(10);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

}

?>