<?php

namespace Commander\Input;


class InputOption extends \Symfony\Component\Console\Input\InputOption
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
