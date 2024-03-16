<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_User_PaymentInvoice
 *
 * Controller handling user payment invoice actions.
 */
class Controller_User_PaymentInvoice extends Controller {

    /**
     * Create action: Handle creation of a payment invoice.
     */
    public function action_create() {
        // Set the response header to application/json
        $this->response->headers('Content-Type', 'application/json');
        
        try {
            $invoice = (new Service_InvoiceService())->create($this->request->post());

            $this->response->status(200);

            $this->response->body(json_encode([
                'success' => $invoice,
            ]));
        } catch (ORM_Validation_Exception $e) {
            // The validation failed, handle the error
            $this->response->status(400);

            $this->response->body(json_encode([
                'errors' => $e->errors('models'),
            ]));
        }
    }

    /**
     * Execute before each action.
     */
    public function before() {
        // Redirect if not logged in as a regular user
        if (!Auth::instance()->logged_in() || Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/');
        }
    }
}
