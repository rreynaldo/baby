<?php

namespace Baby\Input;


class InputArgument extends \Symfony\Component\Console\Input\InputArgument
{
    private string $description;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description ?: parent::getDescription();
    }
}
