<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Admin_PaymentInvoice
 *
 * Controller handling admin payment invoice actions.
 */
class Controller_Admin_PaymentInvoice extends Controller {

    /**
     * Update action: Update the status of a payment invoice.
     */
    public function action_update() {
        // Handled from a form with inputs with names email / password
        $this->response->headers('Content-Type', 'application/json');
        $post = $this->request->post();
        try {
            $invoice = (new Service_InvoiceService())->updateStatus($post['invoice'], $post['status']);

            $this->response->status(200);
            $this->response->body(json_encode([
                'success' => $invoice,
            ]));
        } catch (Exception $e) {
            // An error occurred, handle it
            $this->response->status(400);
            $this->response->body(json_encode([
                'error' => 'Something went wrong, please try again in a few minutes.',
            ]));
        }
    }

    /**
     * PDF action: Generate a PDF for a payment invoice.
     */
    public function action_pdf() {
        $pdf = (new Service_InvoiceService())->generatePDF($this->request->param('invoice'));

        // Use the PDF as the request response
        $this->response->body($pdf);
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
