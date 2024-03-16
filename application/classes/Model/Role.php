<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_Role
 *
 * Role model representing user roles in the application.
 */
class Model_Role extends Model_Auth_Role
{
    /**
     * @var array $_table_columns Column definitions for the role table.
     */
    protected $_table_columns = [
        'id' => NULL,
        'name' => NULL,
        'description' => NULL,
    ];
}
