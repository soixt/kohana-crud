<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Admin_Dashboard
 *
 * Controller handling admin dashboard actions.
 */
class Controller_Admin_Dashboard extends Controller {

    /**
     * Store action: Authenticate admin login.
     */
    public function action_store() {
        // Handled from a form with inputs with names email / password
        $post = $this->request->post();
        $loggedIn = Auth::instance()->login($post['email'], $post['password']);

        // Set the response header to application/json
        $this->response->headers('Content-Type', 'application/json');

        // Return the JSON-encoded response
        if ($loggedIn) {
            $this->response->status(200);
            $this->response->body(json_encode([
                'success' => $loggedIn,
            ]));
        } else {
            $this->response->status(400);
            $this->response->body(json_encode([
                'error' => 'Wrong credentials.',
            ]));
        }
    }

    /**
     * Index action: Display the admin dashboard.
     */
    public function action_index() {
        $invoiceService = new Service_InvoiceService();
        $view = View::factory('pages/admin/dashboard');

        $invoices = $invoiceService->all();

        $view->bind('invoices', $invoices['records']);
        $view->bind('total', $invoices['total']);

        $view->set('statusColors', [
            'creating' => 'blue',
            'approved' => 'emerald',
            'cancelled' => 'red'
        ]);

        $view->set('statuses', [
            'creating' => 'Creating',
            'approved' => 'Approved',
            'cancelled' => 'Canceled',
        ]);

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
