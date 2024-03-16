<nav class="sticky bg-white shadow dark:bg-gray-800">
    <div class="container px-6 py-4 mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex items-center justify-between text-white font-bold text-lg">
                <a href="<?= URL::site('/') ?>">Kohana</a>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
                <?php if (!Auth::instance()->logged_in()): ?>
                <div class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                    <a href="https://github.com/soixt" class="px-3 py-2 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-md lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">GitHub</a>
                </div>
                <?php else: ?>
                <div class="flex items-center mt-4 lg:mt-0">
                    <button id="profile-dropdown-toggle" type="button" class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                        <h3 class="mx-2 text-gray-700 dark:text-gray-200"><?= Auth::instance()->get_user()->email ?></h3>
                        <div class="w-8 h-8 overflow-hidden border-2 border-gray-400 rounded-full">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" class="object-cover w-full h-full" alt="avatar">
                        </div>
                    </button>
                    <div id="profile-dropdown" class="hidden absolute top-12 right-0 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                        <a href="<?= URL::site('/') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <a href="<?= URL::site('/logout') ?>" id="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>