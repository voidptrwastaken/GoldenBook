<?php

namespace App\Repository;

use App\Model\Feedback;
use PDO;

class FeedbackRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createFeeback(string $name, string $message)
    {
        $query = "INSERT INTO feedback (name, message, submissionDate) VALUES (:name, :message, :submissionDate)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":name", $name);
        $statement->bindValue(":message", $message);
        $statement->bindValue(":submissionDate", time());
        $statement->execute();
    }

    public function getFeedbacks(): array
    {
        $query = 'SELECT * FROM feedback';
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $feedbacksArray = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $feedbacks = [];

        foreach ($feedbacksArray as $index => $feedback) {

            array_push($feedbacks, new Feedback($feedback["id"], $feedback["name"], $feedback["message"], $feedback["submissionDate"]));
        }

        return $feedbacks;
    }

    public function getFeedback(int $id): Feedback
    {

        $query = 'SELECT * FROM feedback WHERE id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();

        $feedback = $statement->fetch(PDO::FETCH_ASSOC);

        return new Feedback($feedback["id"], $feedback["name"], $feedback["message"], $feedback["submissionDate"]);
    }
}