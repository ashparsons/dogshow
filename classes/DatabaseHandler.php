<?php
    class DatabaseHandler {
        public $driver;
        public $host;
        public $dbname;
        public $username;
        public $password;
        public $dsn;

        public $pdo;
        
        public function __construct($driver, $host, $dbname, $username, $password) {
            $this->driver = $driver;
            $this->host = $host;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;
            $this->dsn = "$this->driver:dbname=$this->dbname;host=$this->host;charset=utf8";
        }

        public function connect() {
            try {
                $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            } catch (PDOException $exception) {
                echo 'Database Error: ' . $exception->getMessage();
            }
        }
        
        public function disconnect() {
            $this->pdo = null;
        }

        //GET USERS
        public function getUsers() {
            $this->connect();

            $sql = "SELECT * 
                    FROM users;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $users = $statement->fetchAll();

            $this->disconnect();
            return $users;
        }

        //GET USER DETAILS FOR PROFILE.PHP
        public function getUserDetails($login_id) {
            $this->connect();

            $sql = "SELECT * 
                    FROM users
                    WHERE users.user_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $login_id);
            $statement->execute();
            $user = $statement->fetch();

            $this->disconnect();
            return $user;
        }

        //ADD A COMMENT ON PROFILE.PHP
        public function postComment($note) {
            $this->connect();

            $sql = "INSERT INTO comments(user_comment_id, comment)
                    VALUES (:usersid, :comment_made);";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':usersid', $note['user_comment_id']);
            $statement->bindValue(':comment_made', $note['comment']);
            $statement->execute();

            $this->disconnect();
            return true;
        }

        //GET NOTE INFO FOR PROFILE.PHP
        public function getNotes() {
            $this->connect();

            $sql = "SELECT comments.comment, comments.user_comment_id, users.username
                    FROM comments
                    INNER JOIN users 
                    ON comments.user_comment_id = users.user_id";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $notes = $statement->fetchAll();

            $this->disconnect();
            return $notes;
        }

        //UPDATE USERNAME
        // public function postName($user) {
        //     $this->connect();

        //     $sql = "UPDATE users
        //             SET username = :username
        //             WHERE users.user_id = :id;";

        //     $statement = $this->pdo->prepare($sql);
        //     $statement->bindValue(':username', $user['username']);
        //     $statement->bindValue(':id', $user['id']);
        //     $statement->execute();

        //     $this->disconnect();
        //     return true;
        // }

        //UPDATE EMAIL
        public function postEmail($user) {
            $this->connect();

            $sql = "UPDATE users
                    SET email = :email
                    WHERE users.user_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':email', $user['email']);
            $statement->bindValue(':id', $user['id']);
            $statement->execute();

            $this->disconnect();
            return true;
        }

        //UPDATE PASSWORD
        public function postPass($user) {
            $this->connect();

            $sql = "UPDATE users
                    SET password = :password
                    WHERE users.user_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':password', $user['password']);
            $statement->bindValue(':id', $user['id']);
            $statement->execute();

            $this->disconnect();
            return true;
        }

        //GET DOGS FOR DOGS.PHP & ADD CONTESTANT FORM
        public function getDogs() {
            $this->connect();

            $sql = "SELECT * 
                    FROM dogs;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $dogs = $statement->fetchAll();

            $this->disconnect();
            return $dogs;
        }

        //GET DOGS DETAILS FOR DOG.PHP
        public function getDogDetails($id) {
            $this->connect();

            $sql = "SELECT dogs.dog_name, dogs.breed, dogs.image_path_dog,
                           owners.owner_firstname, owners.owner_lastname, owners.image_path_owner
                    FROM dogs
                    INNER JOIN owners ON dogs.parent_id = owners.owner_id
                    WHERE dogs.dog_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $dogs = $statement->fetch();

            $sql = "SELECT events.event_category, events.event_date
                    FROM events INNER JOIN entries
                    ON events.event_id = entries.events_id
                    WHERE entries.dogs_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $dogResults = $statement->fetchAll();

            $dogsentered = array();
            $dogsdate = array();
            foreach ($dogResults as $dogResult) {
                array_push($dogsentered, $dogResult['event_category']);
                array_push($dogsdate, $dogResult['event_date']);
            }
            $dogs['dogsentered'] = $dogsentered;
            $dogs['dogsdate'] = $dogsdate;

            $this->disconnect();
            return $dogs;
        }


        //GET EVENTS THAT DO NOT FALL ON SAME DATE
        public function getEventsDog() {
            $this->connect();
            $sql = "SELECT * 
                    FROM events 
                    WHERE event_date <> $dogsdate;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $owners = $statement->fetchAll();

            $this->disconnect();
            return $events;
        }

        //ADD DOGS TO DATABASE & DOGS.PHP
        public function postDog($dog) {
            $this->connect();

            $sql = "INSERT INTO dogs(dog_name, breed, image_path_dog, parent_id)
                    VALUES (:dog_name, :breed, :image_path_dog, :parent_id);";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':dog_name', $dog['dog_name']);
            $statement->bindValue(':breed', $dog['breed']);
            $statement->bindValue(':image_path_dog', $dog['image_path_dog']);
            $statement->bindValue(':parent_id', $dog['parent_id']);
            $statement->execute();

            $this->disconnect();
            return true;
        }

        //GET OWNERS FOR OWNERS.PHP
        public function getOwnersSearch($searchText) {
            $this->connect();
            $sql = "SELECT * 
                    FROM owners 
                    WHERE owner_phonenumber LIKE :search";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":search", $searchText.'%');
            $statement->execute();
            $owners = $statement->fetchAll();

            $this->disconnect();
            return $owners;
        }

        //GET OWNER INFO FOR OWNER.PHP
        public function getOwnerDetails($id) {
            $this->connect();

            $sql = "SELECT owners.owner_firstname, owners.owner_lastname, owners.owner_phonenumber, owners.image_path_owner
                    FROM owners
                    WHERE owners.owner_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $owner = $statement->fetch();

            $sql = "SELECT dogs.dog_name
                    FROM dogs INNER JOIN owners
                    ON dogs.parent_id = owners.owner_id
                    WHERE owners.owner_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $dogResults = $statement->fetchAll();
            $dogsentered = array();
            foreach ($dogResults as $dogResult) {
                array_push($dogsentered, $dogResult['dog_name']);
            }
            $owner['dogsentered'] = $dogsentered;

            $this->disconnect();
            return $owner;
        }

        //GET OWNERS FOR OWNERS LIST (DOG.PHP)
        public function getOwners() {
            $this->connect();
            $sql = "SELECT * 
                    FROM owners";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $owners = $statement->fetchAll();

            $this->disconnect();
            return $owners;
        }
        
        //GET EVENTS FOR EVENTS.PHP
        public function getEvents() {
            $this->connect();

            $sql = "SELECT * 
                    FROM events";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $events = $statement->fetchAll();

            $this->disconnect();
            return $events;
        }

        //GET EVENT DETAILS FOR EVENT.PHP
        public function getEventDetails($id) {
            $this->connect();

            $sql = "SELECT events.event_category, events.prize_first, events.prize_second, events.prize_third, events.event_date
                    FROM events
                    WHERE events.event_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $event = $statement->fetch();

            $sql = "SELECT dogs.dog_name
                    FROM dogs INNER JOIN entries
                    ON dogs.dog_id = entries.dogs_id
                    WHERE entries.events_id = :id;";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $dogResults = $statement->fetchAll();
            $dogsentered = array();
            foreach ($dogResults as $dogResult) {
                array_push($dogsentered, $dogResult['dog_name']);
            }
            $event['dogsentered'] = $dogsentered;

            $this->disconnect();
            return $event;
        }

        //ADD DOG TO AN EVENT IN DATABASE
        public function postEntry($entry) {
            $this->connect();

            $sql = "INSERT INTO entries(events_id, dogs_id)
                    VALUES (:events_id, :dogs_id);";

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':events_id', $entry['events_id']);
            $statement->bindValue(':dogs_id', $entry['dogs_id']);
            $statement->execute();

            $this->disconnect();
            return true;
        }

        //UPDATE PRIZE AMOUNT
        public function postPrize($eventUpdate) {
            $this->connect();

            if (isset($eventUpdate['prize_first'])) {
                $sql = "UPDATE events
                        SET prize_first = :prize_first
                        WHERE events.event_id = :id;";

                $statement = $this->pdo->prepare($sql);
                $statement->bindValue(':prize_first', $eventUpdate['prize_first']);
                $statement->bindValue(':id', $eventUpdate['event_id']);
                $statement->execute();
    
                $this->disconnect();
                return true;
            }

            if (isset($eventUpdate['prize_second'])) {
                $sql = "UPDATE events
                        SET prize_second = :prize_second
                        WHERE events.event_id = :id;";

                $statement = $this->pdo->prepare($sql);
                $statement->bindValue(':prize_second', $eventUpdate['prize_second']);
                $statement->bindValue(':id', $eventUpdate['event_id']);
                $statement->execute();
    
                $this->disconnect();
                return true;
            }

            if (isset($eventUpdate['prize_third'])) {
                $sql = "UPDATE events
                        SET prize_third = :prize_third
                        WHERE events.event_id = :id;";

                $statement = $this->pdo->prepare($sql);
                $statement->bindValue(':prize_third', $eventUpdate['prize_third']);
                $statement->bindValue(':id', $eventUpdate['event_id']);
                $statement->execute();
    
                $this->disconnect();
                return true;
            }
        }


    }
?>