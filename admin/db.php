<?php 

class database {
	private $host = "localhost";
	private $user = "root";
	private $password = "toor";
	private $dbname = "electroshop";
	
	public $con;
	
	public function __construct() {
		$this->create_db();
		$this->connect();
		$this->create_table();
		$this->migrate_purchase_cid();
	}

	private function create_db() {
		$conn = new mysqli($this->host, $this->user, $this->password);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "CREATE DATABASE IF NOT EXISTS `".$this->dbname."` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
		if ($conn->query($sql) === TRUE) {
			// echo "Database successfully created!<br>";
		} else {
			echo "Error creating database: " . $conn->error;
		}
		
		$conn->close();
	}

	public function connect() {
		$this->con = new mysqli($this->host, $this->user, $this->password, $this->dbname); 
		if ($this->con->connect_error) {
			die("Connection failed: " . $this->con->connect_error);
		}
		return $this->con;
	}
	
	private function create_table() {
		$sql = '';

		$sql .= 'CREATE TABLE IF NOT EXISTS `customer` (
			`sl` int(11) NOT NULL AUTO_INCREMENT,		 
			`cid` text NOT NULL,
			`email` varchar(255) NOT NULL,
			`phone` varchar(15) NOT NULL,
			`full_name` varchar(255) NOT NULL,
			`password` varchar(255) NOT NULL,
			`address` text DEFAULT NULL,
			`join_date` text NOT NULL,
			`cart` text DEFAULT NULL,
			`wishlist` text DEFAULT NULL,
			PRIMARY KEY (`sl`),
			UNIQUE KEY `email` (`email`),
			UNIQUE KEY `phone` (`phone`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;';

		$sql .= 'CREATE TABLE IF NOT EXISTS `product` (
			`sl` int(11) NOT NULL AUTO_INCREMENT,
			`pid` text NOT NULL,
			`product_name` varchar(255) NOT NULL,
			`brand_name` varchar(255) DEFAULT NULL,
			`short_des` text DEFAULT NULL,
			`long_des` text DEFAULT NULL,
			`imgs_link` text DEFAULT NULL,
			`product_price` decimal(10,2) NOT NULL,
			`quantity` int(11) DEFAULT 0,
			`discount` decimal(5,2) DEFAULT 0.00,
			`category` text DEFAULT NULL,
			PRIMARY KEY (`sl`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;'; 

		$sql .= 'CREATE TABLE IF NOT EXISTS `purchase` (
			`sl` int(11) NOT NULL AUTO_INCREMENT,
			`order_id` text NOT NULL,
			`cart` text DEFAULT NULL,
			`cid` varchar(128) DEFAULT NULL,
			`address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
			`status` varchar(50) DEFAULT "200",
			`purchase_date` datetime DEFAULT current_timestamp(),
			PRIMARY KEY (`sl`),
			KEY `cid` (`cid`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;';

		if ($this->con->multi_query($sql)) {
			do {
				if ($res = $this->con->store_result()) {
					$res->free();
				}
			} while ($this->con->more_results() && $this->con->next_result());
		} else {
			echo "Error creating tables: " . $this->con->error;
		}
	}

	/** Customer `cid` is a hex hash (see header.php); older DBs used int and broke inserts. */
	private function migrate_purchase_cid() {
		$r = $this->con->query("SHOW COLUMNS FROM `purchase` LIKE 'cid'");
		if (!$r || !($row = $r->fetch_assoc())) {
			return;
		}
		if (preg_match('/int/i', $row['Type'])) {
			$this->con->query("ALTER TABLE `purchase` MODIFY `cid` VARCHAR(128) NULL DEFAULT NULL");
		}
	}
}

$con = new database();
$con = $con->connect();

?>
