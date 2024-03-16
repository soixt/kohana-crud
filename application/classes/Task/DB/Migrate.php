<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Task_DB_Migrate
 *
 * A Minion_Task class for managing database migrations.
 */
class Task_DB_Migrate extends Minion_Task {
    /**
     * Options for the task.
     *
     * @var array
     */
    protected $_options = [
        'fresh' => false,
    ];

    /**
     * Execute the database migration process.
     *
     * @param array $params Parameters passed to the task.
     * @return void
     */
    protected function _execute(array $params) {
        try {
            if ((bool)$params['fresh']) {
                $this->fresh();
            }

            // Check if the migrations table exists
            $migrationsResult = DB::select('name')->from('migrations')->execute();
            $existingMigrations = $migrationsResult->as_array(null, 'name');
        
            // Retrieve the list of migration files
            $migrationFiles = scandir(MIGRATIONS_PATH);
            $migrationFiles = array_diff($migrationFiles, ['.', '..']); // Remove . and ..
            
            // Remove .php extension from migration filenames
            $migrationFilesWithoutExtension = array_map(function ($file) {
                return pathinfo($file, PATHINFO_FILENAME);
            }, $migrationFiles);

            // Find new migrations
            $newMigrations = array_diff($migrationFilesWithoutExtension, $existingMigrations);

        
            if (count($newMigrations) > 0) {
                // Execute new migrations
                foreach ($newMigrations as $migrationClass) {
                    // Execute the migration file
                    include_once MIGRATIONS_PATH . $migrationClass . '.php';

                    // Run migration
                    $callableClass = (strpos($migrationClass, '_') !== false) ? explode('_', $migrationClass)[1] : $migrationClass;
                    $callableClass::execute();

                    // Insert the migration into the migrations table
                    $insert = DB::insert('migrations')
                        ->columns(['name'])
                        ->values([$migrationClass]);
                    $insert->execute();
                    Minion_CLI::write("Migration $migrationClass executed successfully.");
                }
            } else {
                Minion_CLI::write("Nothing to migrate.");
            }
        } catch (Database_Exception $e) {
            // Check if the error message or error code indicates that the database doesn't exist
            if ($e->getCode() === '42S02' && strpos($e->getMessage(), "migrations") !== false && strpos($e->getMessage(), "doesn't exist") !== false) {
                // If the migrations table doesn't exist, create it
                $this->createMigrationsTable();
        
                // Output a success message
                Minion_CLI::write('Migrations table created successfully.');
            } else {
                // If the exception is for something else, re-throw it to propagate the exception
                throw $e;
            }
        }
    }
    
    /**
     * Create migrations table.
     *
     * @return void
     */
    protected function createMigrationsTable() {
        // Define the query to create the migration table
        $query = "CREATE TABLE migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Execute the query using Kohana's database module
        Database::instance()->query(Database::INSERT, $query);

        $this->insertMigration();
    }

    /**
     * Insert migration record into migrations table.
     *
     * @return void
     */
    protected function insertMigration() {
        // Define the query to insert migration record
        $query = "INSERT INTO migrations (name) VALUES ('CreateMigrationsTable')";
        $query = "INSERT INTO migrations (name) VALUES ('CreateUsersTable')";

        // Execute the query using Kohana's database module
        Database::instance()->query(Database::INSERT, $query);

        $this->_execute([]);
    }

    /**
     * Drop all tables to start fresh.
     *
     * @return void
     */
    protected function fresh() {
        $db = Database::instance();
    
        // First, disable foreign key checks to prevent errors during drops
        $db->query(Database::INSERT, 'SET FOREIGN_KEY_CHECKS = 0;');
    
        // Fetch the list of all tables for the current database
        $result = $db->query(Database::SELECT, 'SHOW TABLES', FALSE);
        $results = $result->as_array(null, 'Tables_in_kohana_db'); //$config = Kohana::$config->load('database');

        // Drop each table
        foreach ($results as $table) {
            $db->query(Database::INSERT, "DROP TABLE IF EXISTS `$table`;");
        }
    
        // Re-enable foreign key checks
        $db->query(Database::INSERT, 'SET FOREIGN_KEY_CHECKS = 1;');
    }    
}
