<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Task_Generate_Seeder
 *
 * A Minion_Task class for generating new seeder files.
 */
class Task_Generate_Seeder extends Minion_Task {
    /**
     * Options for the task.
     *
     * @var array
     */
    protected $_options = [
        'name' => 'UnnamedClass',
    ];

    /**
     * Generates a new seeder file.
     *
     * @param array $params Parameters passed to the task.
     * @return void
     */
    protected function _execute(array $params) {
        // Define the name of the table for migration
        $tableName = $params['name'];
        $filePath = SEEDERS_PATH . $tableName . '.php';

        // Create the file content
        $fileContent = "<?php defined('SYSPATH') or die('No direct script access.');\n\n";
        $fileContent .= "class {$tableName} {\n";
        $fileContent .= "    public static function execute() {\n";
        $fileContent .= "        // Database logic here\n";
        $fileContent .= "    }\n";
        $fileContent .= "}\n";

        // Write the file
        file_put_contents($filePath, $fileContent);

        // Output the name of the file created
        Minion_CLI::write('Seeder file created: ' . $filePath);
    }
}
