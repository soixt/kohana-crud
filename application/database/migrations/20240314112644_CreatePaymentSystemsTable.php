<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class CreatePaymentSystemsTable
 *
 * A class responsible for executing SQL queries to create payment systems table.
 */
class CreatePaymentSystemsTable {
    /**
     * Execute SQL query to create payment systems table.
     *
     * @return void
     */
    public static function execute() {
        // Database logic here
        $query = "CREATE TABLE payment_systems (
                id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                status ENUM('on', 'off') NOT NULL
            );
        ";

        // Execute the query using Kohana's database module
        Database::instance()->query(Database::INSERT, $query);
    }
}
