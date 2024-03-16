<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_User_Dashboard
 *
 * Controller handling user dashboard actions.
 */
class Controller_User_Dashboard extends Controller {
    /**
     * Index action: Display user dashboard.
     */
    public function action_index() {
        $invoiceService = new Service_InvoiceService();
        $systemService = new Service_SystemService();

        $view = View::factory('pages/user/dashboard');

        $invoices = $invoiceService->all();
        $systems = $systemService->allActive();

        $view->bind('invoices', $invoices['records']);
        $view->bind('total', $invoices['total']);
        $view->bind('systems', $systems['records']);
        $view->set('statusColors', [
            'creating' => 'blue',
            'approved' => 'emerald',
            'cancelled' => 'red'
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
        // Redirect if not logged in as a regular user
        if (!Auth::instance()->logged_in() || Auth::instance()->logged_in('admin')) {
            return HTTP::redirect('/');
        }
    }
}
