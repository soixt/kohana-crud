<dialog id="add-system-modal" class="w-1/2 rounded-lg shadow-md">
    <div class="bg-white p-8 w-full">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Payment System</h2>
        <form method="POST" action="<?= URL::site('/systems/create')?>" data-update-action="<?= URL::site('/systems/update')?>" id="payment-system-from">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name" required>
                <span class="error-message text-sm text-red-700 form-errors capitalize" id="error-name"></span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Select Status</label>
                <select id="status" name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="on">On</option>
                    <option value="off">Off</option>
                </select>
                <span class="error-message text-sm text-red-700 form-errors capitalize" id="error-status"></span>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
                <button type="button" onclick="closeModalForm('#add-system-modal')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</dialog>
<section class="container px-4 mx-auto">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800">Systems</h2>

                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full">Total <?= $total ?></span>
            </div>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600" onclick="openModal('#add-system-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span>Add System</span>
            </button>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                    Name
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                    Status
                                </th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($systems as $system): ?>
                                <tr>
                                    <td class="py-3.5 px-4 text-sm font-medium whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800"><?= $system->name ?></h2>
                                    </td>
                                    <td class="py-3.5 px-4 text-sm font-medium whitespace-nowrap">
                                        <div class="inline px-3 py-1 text-sm font-normal rounded-full text-<?= $system->status == 'on' ? 'emerald' : 'red' ?>-500 gap-x-2 bg-<?= $system->status == 'on' ? 'emerald' : 'red' ?>-100/60">
                                            <?= $system->status ?>
                                        </div>
                                    </td>

                                    <td class="py-3.5 px-4 text-sm whitespace-nowrap">
                                        <button class="px-4 py-2 text-sm rounded-md bg-blue-500 hover:bg-blue-700 text-white open-edit-system-from" data-system="<?= $system->id ?>" data-system-name="<?= $system->name ?>" data-system-status="<?= $system->status ?>">Edit</button>
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
