<?php

use Symfony\Component\Validator\Constraints;

class FeedbackData
{
    /**
     * @Constraints\Length(
     * min = 2,
     * max = 50
     * )
     */
    public string $name;
    /**
     * @Constraints\Length(
     * min = 1,
     * max = 4000
     * )
     */
    public string $message;
}