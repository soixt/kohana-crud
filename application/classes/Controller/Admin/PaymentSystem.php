<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Admin_PaymentSystem
 *
 * Controller handling admin payment system actions.
 */
class Controller_Admin_PaymentSystem extends Controller {

    /**
     * Create action: Create a new payment system.
     */
    public function action_create() {
        // Handled from a form with inputs with names email / password
        $this->response->headers('Content-Type', 'application/json');
        try {
            $system = (new Service_SystemService())->create($this->request->post());

            $this->response->status(200);
            $this->response->body(json_encode([
                'success' => $system,
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
     * Update action: Update an existing payment system.
     */
    public function action_update() {
        // Handled from a form with inputs with names email / password
        $this->response->headers('Content-Type', 'application/json');
        try {
            $system = (new Service_SystemService())->update($this->request->post());

            $this->response->status(200);
            $this->response->body(json_encode([
                'success' => $system,
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
     * Index action: Display admin payment systems.
     */
    public function action_index() {
        $systemService = new Service_SystemService();

        $view = View::factory('pages/admin/payment-systems');
        $systems = $systemService->all();

        $view->bind('total', $systems['total']);
        $view->bind('systems', $systems['records']);

        $this->response->body(
            View::factory('layouts/app')
                ->bind('content', $view)
        );
    }

    /**
     * Execute before each action.
     */
    public function before() {
        // Redirect if not logged in as admin
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/');
        }
    }
}
