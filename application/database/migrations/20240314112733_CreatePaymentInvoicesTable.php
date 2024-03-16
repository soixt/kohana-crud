<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class CreatePaymentInvoicesTable
 *
 * A class responsible for executing SQL queries to create payment invoices table.
 */
class CreatePaymentInvoicesTable {
    /**
     * Execute SQL query to create payment invoices table.
     *
     * @return void
     */
    public static function execute() {
        // Database logic here
        $query = "CREATE TABLE payment_invoices (
                id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED NOT NULL,
                payment_system_id INT UNSIGNED NOT NULL,
                details TEXT,
                amount DECIMAL(10, 2) NOT NULL,
                status ENUM('creating', 'approved', 'cancelled') NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (payment_system_id) REFERENCES payment_systems(id)
            );
        ";

        // Execute the query using Kohana's database module
        Database::instance()->query(Database::INSERT, $query);
    }
}
