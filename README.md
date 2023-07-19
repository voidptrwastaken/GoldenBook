# Golden book

## How to set up:
- Clone this repo
  ```sh
  git clone git@github.com:voidptrwastaken/GoldenBook.git
  ```
- Once this is done, head to the root of the project and run the following to build images and start the containers
  ```sh
  # you may add the --remove-orphans flag if needed
  docker-compose up
  ```
- You should normally see this (if not then I'm terribly sorry for you) ![docker-compose](https://cdn.discordapp.com/attachments/756590162456084660/979739111827050526/unknown.png)
- The next step is to enter in our PHP containter: open a new terminal tab (in the project's folder) and run
  ```sh
  docker-compose exec php /bin/bash
  ```
- Since I'm just that good and it's impossible that I messed things up (kidding obviously, but it should work still), you just need to run
- ```sh
  php bin/console doctrine:database:create
  ```
  and boom!! Your database is up :D
- If you try ```php bin/console doctrine:query:sql 'SELECT 1'``` and it doesn't explode to your face then congratulations! 
- You may now create a feedback table with
  ```sh
  php bin/console doctrine:query:sql 'CREATE TABLE feedback (id SERIAL PRIMARY KEY, name TEXT, message TEXT, submissiondate SERIAL)'
  ```
- If everything went right, you can ```php bin/console doctrine:query:sql 'SELECT * FROM feedback'``` and see your magnificent yet empty table show up!
- It's time for you to fill this table with lovely feedback that no one cares about! Head to http://localhost:8080/ and start clogging your database with messages on how bad your school is!!
