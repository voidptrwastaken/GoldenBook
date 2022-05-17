<?php

namespace App\Model;

class Feedback
{
    private int $id;
    private string $name;
    private string $message;
    private int $submissionDate;

    public function __construct(int $id, string $name, string $message, int $submissionDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->message = $message;
        $this->submissionDate = $submissionDate;
    }

    public function getID(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
    public function getSubmissionDate(): int
    {
        return $this->submissionDate;
    }
}
