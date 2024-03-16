<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class CreateUsersTable
 *
 * A class responsible for executing SQL queries to create users table and roles.
 */
class CreateUsersTable {
    /**
     * Execute SQL queries to create users table and roles.
     *
     * @return void
     */
    public static function execute() {
        // Load the SQL queries into a string
        $query = file_get_contents(MODPATH . 'orm/auth-schema-mysql.sql');

        if ($query !== false) {
            // Execute the query using Kohana's database module
            Database::instance()->query(Database::INSERT, $query . "
                INSERT INTO `roles` (`id`, `name`, `description`) VALUES(3, 'user', 'Basic user');
            ");
        }
    }
}
