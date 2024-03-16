<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Task_Generate_Migration
 *
 * A Minion_Task class for generating new migration files with a timestamp prefix.
 */
class Task_Generate_Migration extends Minion_Task {
    /**
     * Options for the task.
     *
     * @var array
     */
    protected $_options = [
        'name' => 'UnnamedClass',
    ];

    /**
     * Generates a new migration file with a timestamp prefix.
     *
     * @param array $params Parameters passed to the task.
     * @return void
     */
    protected function _execute(array $params) {
        // Get current timestamp
        $timestamp = date('YmdHis');

        // Define the name of the table for migration
        $tableName = $params['name'];

        $className = $tableName;
        $fileName = $timestamp . '_' . $tableName . '.php';
        $filePath = MIGRATIONS_PATH . $fileName;

        // Create the file content
        $fileContent = "<?php defined('SYSPATH') or die('No direct script access.');\n\n";
        $fileContent .= "class $className {\n";
        $fileContent .= "    public static function execute() {\n";
        $fileContent .= "        // Database logic here\n";
        $fileContent .= "    }\n";
        $fileContent .= "}\n";

        // Write the file
        file_put_contents($filePath, $fileContent);

        // Output the name of the file created
        Minion_CLI::write('Migration file created: ' . $filePath);
    }
}
