<?php

namespace App\Core\Factory;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFactory
{

    protected OptionsResolver $optionsResolver;

    public function __construct()
    {
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    abstract protected function buildObject(array $data);

    public function create(array $data = [])
    {
        $resolvedData = $this->optionsResolver->resolve($data);
        return $this->buildObject($resolvedData);
    }

    abstract public function configureOptions(OptionsResolver $resolver);

}