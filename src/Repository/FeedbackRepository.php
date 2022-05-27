<?php

namespace App\Repository;

use App\Model\Feedback;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
use PDO;


// php bin/console doctrine:query:sql \
//"INSERT INTO feedback (name, message, submissionDate) VALUES ('Zaru', 'At the start of everything, there was one man. And it was meeeeeeeee :3', 1)"

class FeedbackRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function createFeeback(string $name, string $message)
    {
        $query = "INSERT INTO feedback (name, message, submissionDate) VALUES (:name, :message, :submissionDate)";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(":name", $name);
        $statement->bindValue(":message", $message);
        $statement->bindValue(":submissionDate", time());
        $statement->executeQuery();
    }

    public function getFeedbacks(): array
    {
        $feedbacksArray = $this->connection->fetchAllAssociative('SELECT * FROM feedback');
        $feedbacks = [];
        foreach ($feedbacksArray as $feedback) {

            array_push($feedbacks, new Feedback($feedback["id"], $feedback["name"], $feedback["message"], $feedback["submissiondate"]));
        }

        return $feedbacks;
    }

    public function getFeedback(int $id): Feedback
    {
        $feedback = $this->connection->fetchAssociative('SELECT * FROM feedback WHERE id='.$id);
        return new Feedback($feedback["id"], $feedback["name"], $feedback["message"], $feedback["submissiondate"]);
    }
}