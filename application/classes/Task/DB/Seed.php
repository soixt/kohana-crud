<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Task_DB_Seed
 *
 * A Minion_Task class for seeding the database with data from seeder files.
 */
class Task_DB_Seed extends Minion_Task {
    /**
     * Options for the task.
     *
     * @var array
     */
    protected $_options = [
        'name' => null,
    ];

    /**
     * Execute the database seeding process.
     *
     * @param array $params Parameters passed to the task.
     * @return void
     */
    protected function _execute(array $params) {
        $seeder = $params['name'];
        try {
            // Retrieve the list of seeder files
            $seederFiles = scandir(SEEDERS_PATH);
            $seederFiles = array_diff($seederFiles, ['.', '..']); // Remove . and ..

            // Remove .php extension from seeder filenames
            $seederFilesWithoutExtension = array_map(function ($file) {
                return pathinfo($file, PATHINFO_FILENAME);
            }, $seederFiles);

            if (is_null($seeder)) {
                // Execute all seeder files
                foreach ($seederFilesWithoutExtension as $file) {
                    include_once SEEDERS_PATH . $file . '.php';
                    $file::execute();
                    Minion_CLI::write("Seeder $file executed successfully.");
                }
            } elseif (!is_null($seeder) && in_array($seeder, $seederFilesWithoutExtension)) {
                // Execute the specified seeder file
                include_once SEEDERS_PATH . $seeder . '.php';
                $seeder::execute();
                Minion_CLI::write("Seeder $seeder executed successfully.");
            } else {
                Minion_CLI::write("Seeder $seeder not found!");
            }
        } catch (Exception $e) {
            Minion_CLI::write($e->getMessage());
        }
    }
}
