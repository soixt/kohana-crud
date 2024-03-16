<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_PaymentSystem
 *
 * PaymentSystem model representing payment systems in the application.
 */
class Model_PaymentSystem extends ORM
{
    /**
     * @var string $_table_name Name of the database table for payment systems.
     */
    protected $_table_name = 'payment_systems';
    
    /**
     * @var array $_table_columns Column definitions for the payment_systems table.
     */
    protected $_table_columns = [
        'id' => NULL,
        'name' => NULL,
        'status' => NULL,
    ];

    /**
     * @var array $_has_many Relationships with other models.
     */
    protected $_has_many = [
        'invoices' => ['model' => 'PaymentInvoice'],
    ];

    /**
     * Define validation rules for the payment system.
     *
     * @return array Validation rules.
     */
    public function rules() {
        return [
            'name' => [
                ['not_empty'],
                ['max_length', [':value', 32]],
            ],
            'status' => [
                ['not_empty'],
                ['in_array', [':value', ['on', 'off']]],
            ],
        ];
    }
}
