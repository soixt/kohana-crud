<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Model_PaymentInvoice
 *
 * PaymentInvoice model representing payment invoices in the application.
 */
class Model_PaymentInvoice extends ORM
{
    /**
     * @var string $_table_name Name of the database table for payment invoices.
     */
    protected $_table_name = 'payment_invoices';

    /**
     * @var array $_table_columns Column definitions for the payment_invoices table.
     */
    protected $_table_columns = [
        'id' => NULL,
        'payment_system_id' => NULL,
        'user_id' => NULL,
        'details' => NULL,
        'amount' => NULL,
        'status' => NULL,
    ];

    /**
     * @var array $_belongs_to Relationships with other models.
     */
    protected $_belongs_to = [
        'user' => [
            'model' => 'User',
            'foreign_key' => 'user_id',
        ],
        'system' => [
            'model' => 'PaymentSystem',
            'foreign_key' => 'payment_system_id',
        ],
    ];

    /**
     * Define validation rules for the payment invoice.
     *
     * @return array Validation rules.
     */
    public function rules () {
        return [
            'payment_system_id' => [
                ['not_empty'],
                [[$this, 'system_exists']],
            ],
            'details' => [
                ['not_empty'],
            ],
            'amount' => [
                ['not_empty'],
            ],
            'status' => [
                ['not_empty'],
                ['in_array', [':value', ['creating', 'approved', 'cancelled']]],
            ],
        ];
    }

    /**
     * Check if the payment system exists.
     *
     * @param int $system Payment system ID.
     * @return bool Whether the system exists or not.
     */
    public function system_exists ($system) {
        // Check if the system exists
        return ORM::factory('PaymentSystem', $system)->where('id', '=', $system)->count_all() > 0;
    }
}
