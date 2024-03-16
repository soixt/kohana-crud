<section class="container px-4 mx-auto mt-10">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800">Invoices</h2>

                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full">Total <?= $total ?></span>
            </div>

            <div class="flex items-center mt-4 gap-x-3">
                <a href="<?= URL::site('/systems') ?>" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span>Payment Systems</span>
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                    User
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                    Status
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                    System
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">Details</th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">Amount</th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800"><?= isset($invoice->user) ? $invoice->user->email : '-' ?></h2>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap invoice-status" data-invoice="<?= $invoice->id ?>">
                                        <div class="inline px-3 py-1 text-sm font-normal rounded-full text-<?= $statusColors[$invoice->status] ?>-500 gap-x-2 bg-<?= $statusColors[$invoice->status] ?>-100/60">
                                            <?= $invoice->status ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800"><?= $invoice->system->name ?></h2>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800"><?= $invoice->details ?></h2>
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800"><?= $invoice->amount ?></h2>
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <?php if ($invoice->status == 'creating'): ?>
                                            <button class="px-4 py-2 text-sm rounded-md bg-green-500 hover:bg-green-700 text-white update-status" data-invoice="<?= $invoice->id ?>" data-status="approved" data-url="<?= URL::site('/invoice/update-status') ?>">Approve</button>
                                            <button class="px-4 py-2 text-sm rounded-md bg-red-500 hover:bg-red-700 text-white update-status" data-invoice="<?= $invoice->id ?>" data-status="cancelled" data-url="<?= URL::site('/invoice/update-status') ?>">Cancel</button>
                                        <?php endif; ?>
                                        <a href="<?= URL::site('download-pdf') . '/' . $invoice->id ?>" class="px-4 py-2 text-sm rounded-md bg-blue-500 hover:bg-blue-700 text-white">Download</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
