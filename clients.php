<?php
require_once ('database.php');

class Clients
{

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    //method to create new client
    public function create($name, $surname, $email, $phone1, $phone2, $comment)
    {
        $client = $this->connection->prepare("INSERT INTO clients (name, surname, email, phone1, phone2, comment) VALUES(?,?,?,?,?,?)");
        $client->bind_param("sssiis", $name, $surname, $email, $phone1, $phone2, $comment);
        if ($client->execute()) {
            return true;
        } else {
            return false;
        }
        $client->close();
    }

// get client list
    public function getClientList()
    {
        if ($result = $this->connection->query("SELECT * FROM clients")) {

            if ($result->num_rows > 0) {
                $clients = []; // client array
                while ($row = $result->fetch_assoc()) {
                    $clients[] = $row;
                }
                return $clients;
            } else {
                return false;
            }
            $result->close();
        }
    }

// get one client data
    public function getClientData($id)
    {
        $query = $this->connection->prepare("SELECT * FROM clients WHERE id=?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $clientInfo = []; // client array
            while ($row = $result->fetch_assoc()) {
                $clientInfo[] = $row;
            }
            return $clientInfo;
        } else {
            return false;
        }
        $result->close();
    }

	// update client information
    public function update($id, $name, $surname, $email, $phone1, $phone2, $comment)
    {
        $query = $this->connection->prepare("UPDATE clients set name=?, surname=?, email=?, phone1=?, phone2=?, 
		comment=? WHERE id=?");
        $query->bind_param("sssiisi", $name, $surname, $email, $phone1, $phone2, $comment,
            $id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
        $query->close();
    }

	// delete client data
    public function delete($id)
    {
        $query = $this->connection->prepare("DELETE FROM clients WHERE id=?");
        $query->bind_param("i", $id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
        $query->close();
    }

// email validation
    public function emailValidation($email)
    {
        var_dump(strlen($email), filter_var($email, FILTER_VALIDATE_EMAIL));
        if (strlen($email) > 5 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

	// export database to data.csv
    public function exportData()
    {
        $file = fopen('data.csv', 'w');

        fputcsv($file, array(
            'id',
            'name',
            'surname',
            'email',
            'phone1',
            'phone2',
            'comment'));
        $data = $this->getClientList();

        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }

}
?>