<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Service_SystemService
 *
 * A service class for handling payment system operations.
 */
class Service_SystemService
{
    /**
     * Retrieve all payment systems.
     *
     * @return array Associative array containing records and total count of payment systems.
     */
    public function all () {
        $systems = ORM::factory('PaymentSystem')->order_by('id', 'desc');

        return [
            'records' => $systems->find_all(),
            'total' => $systems->count_all() 
        ];
    }

    /**
     * Retrieve all active payment systems.
     *
     * @return array Associative array containing active records and total count of payment systems.
     */
    public function allActive () {
        $systems = ORM::factory('PaymentSystem')->where('status', '=', 'on')->order_by('id', 'desc');

        return [
            'records' => $systems->find_all(),
            'total' => $systems->count_all() 
        ];
    }

    /**
     * Update a payment system.
     *
     * @param array $post Data for updating the payment system.
     * @return bool True on success, false otherwise.
     */
    public function update ($post) {
        // Find the PaymentSystem model instance by ID
        $system = ORM::factory('PaymentSystem', $post['system']);
    
        // Check if the model was found
        if (!$system->loaded()) {
            return false;
        }

        $system->values($post, ['name', 'status']);

        // Perform validation and save
        $system->check();
    
        // Save the changes
        $system->save();
    
        return true; // Indicate success
    }

    /**
     * Create a new payment system.
     *
     * @param array $post Data for creating the payment system.
     * @return object|bool ORM model instance on success, false otherwise.
     */
    public function create ($post) {
        return ORM::factory('PaymentSystem')
            ->values($post, ['name', 'status'])
            ->create();
    }
}
