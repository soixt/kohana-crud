<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_User
 *
 * User model representing users in the application.
 */
class Model_User extends Model_Auth_User
{
    /**
     * @var array $_table_columns Column definitions for the user table.
     */
    protected $_table_columns = [
        'id' => NULL,
        'email' => NULL,
        'username' => NULL,
        'password' => NULL,
        'logins' => NULL,
        'last_login' => NULL,
    ];
    
    /**
     * @var array $_has_many Relationships with other models.
     */
    protected $_has_many = [
        'user_tokens' => ['model' => 'User_Token'],
        'roles'       => ['model' => 'Role', 'through' => 'roles_users'],
        'invoices' => ['model' => 'PaymentInvoice'],
    ];
}
