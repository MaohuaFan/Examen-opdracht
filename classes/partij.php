<?php
// auteur: studentnaam
// functie: definitie class Partij
require_once 'Database.php'; // Zorgt ervoor dat de Database-class wordt geladen.

class Partij extends Database {
    public $id;
    public $partijnaam;
    public $gecreëerd_op;
    private $table_name = "partijen"; 

    // Methods

    public function crudPartij() : void {
        $lijst = $this->getPartijen();
        $this->showTable($lijst);
    }

    public function getPartijen() : array {
        $sql = "SELECT id, partijnaam, gecreëerd_op FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $lijst = $stmt->fetchAll(PDO::FETCH_ASSOC); // Specify fetch mode
        return $lijst;
    }

    public function getPartij(int $id) : array {
        $sql = "SELECT id, partijnaam, gecreëerd_op FROM $this->table_name WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $lijst = $stmt->fetch(PDO::FETCH_ASSOC); // Specify fetch mode
        return $lijst;
    }

    public function showTable(array $lijst) : void {
        $txt = "<table>";
        $txt .= "<tr><th>Id</th><th>Partijnaam</th><th>Gemaakt op</th><th>Acties</th></tr>";

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["id"] . "</td>";
            $txt .= "<td>" . $row["partijnaam"] . "</td>";
            $txt .= "<td>" . $row["gecreëerd_op"] . "</td>";

            $txt .= "<td>";
            $txt .= "<form method='post' action='update.php?id={$row["id"]}'>       
                        <button name='update'>Wijzig</button>    
                    </form></td>";

            $txt .= "<td>";
            $txt .= "<form method='post' action='delete.php?id={$row["id"]}'>       
                        <button name='verwijderen'>Verwijderen</button>    
                    </form></td>";    
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    public function deletePartij(int $id) : bool {
        $sql = "DELETE FROM $this->table_name WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function updatePartij(array $row) : bool {
        $sql = "UPDATE $this->table_name SET partijnaam = :partijnaam WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            ':id' => $row['id'],
            ':partijnaam' => $row['partijnaam']
        ]);
    }

    public function insertPartij(array $row) : bool {
        // Construct the SQL query without defining the id explicitly
        $sql = "INSERT INTO $this->table_name (partijnaam, gecreëerd_op) 
                VALUES (:partijnaam, :gecreëerd_op)";
        
        // Prepare the SQL statement
        $stmt = self::$conn->prepare($sql);
        
        // Define the parameters
        $params = [
            ':partijnaam' => $row['partijnaam'], // Correctly match this key
            ':gecreëerd_op' => date('Y-m-d H:i:s') // Automatically set the timestamp
        ];

        // Debug: Output the parameters to check for any issues
        var_dump($params); // This line can be removed after testing

        // Execute the statement with the correct parameters
        return $stmt->execute($params);
    }

    private function BepMaxPartijId() : int {
        $sql = "SELECT MAX(id) max FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Specify fetch mode
        return is_null($row['max']) ? 1 : intval($row['max']) + 1;
    }
}
