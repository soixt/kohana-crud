<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Service_InvoiceService
 *
 * A service class for handling invoice operations.
 */
class Service_InvoiceService
{
    /**
     * Retrieve all payment invoices.
     *
     * @return array Associative array containing records and total count of payment invoices.
     */
    public function all () {
        $invoices = ORM::factory('PaymentInvoice')
            ->select('paymentinvoice.*', array('user.id', 'user_id'), array('system.id', 'system_id'))
            ->join(['users', 'user'], 'LEFT')
            ->on('paymentinvoice.user_id', '=', 'user.id')
            ->join(['payment_systems', 'system'], 'LEFT')
            ->on('paymentinvoice.payment_system_id', '=', 'system.id')
            ->order_by('paymentinvoice.id', 'desc');

        return [
            'records' => $invoices->find_all(),
            'total' => $invoices->count_all() 
        ];
    }

    /**
     * Create a new payment invoice.
     *
     * @param array $post Data for creating the payment invoice.
     * @return object|bool ORM model instance on success, false otherwise.
     */
    public function create ($post = []) {
        $data = [
            'user_id' => Auth::instance()->get_user()->id,
            'payment_system_id' => $post['payment-system'],
            'details' => $post['details'],
            'amount' => $post['amount'],
            'status' => 'creating',
        ];

        return ORM::factory('PaymentInvoice')
            ->values($data, ['amount', 'status', 'user_id', 'payment_system_id', 'details'])
            ->create();
    }

    /**
     * Update the status of a payment invoice.
     *
     * @param int $invoiceID ID of the invoice to update.
     * @param string $status The new status for the invoice.
     * @return bool True on success, false otherwise.
     */
    public function updateStatus($invoiceID, $status) {
        // Find the PaymentInvoice model instance by ID
        $invoice = ORM::factory('PaymentInvoice', $invoiceID);
    
        // Check if the model was found
        if (!$invoice->loaded() || !in_array($status, ['approved', 'cancelled'])) {
            return false; // Or handle the case where the invoice is not found
        }
    
        // Update the status
        $invoice->status = $status;
    
        // Save the changes
        $invoice->save();
    
        return true; // Indicate success
    }

    /**
     * Generate a PDF for a payment invoice.
     *
     * @param int $invoiceID ID of the invoice for which to generate the PDF.
     * @return string Filename of the generated PDF.
     */
    public function generatePDF ($invoiceID) {
        // Load a view using the PDF extension
        $pdf = View_MPDF::factory('pdf/invoice');

        $pdf->set('invoice', ORM::factory('PaymentInvoice', $invoiceID));

        return $pdf->download(time() . '.pdf');
    }
}
