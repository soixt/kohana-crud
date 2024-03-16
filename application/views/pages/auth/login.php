<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-24 mx-auto lg:py-32 min-h-screen">
        <div class="lg:flex">
            <div class="lg:w-1/2">
                <img class="w-auto h-7 sm:h-8" src="https://kohanaframework.org/img/kohana-logo.png" alt="">

                <h1 class="mt-4 text-gray-600 dark:text-gray-300 md:text-lg">Welcome back</h1>
                
                <h1 class="mt-4 text-2xl font-medium text-gray-800 capitalize lg:text-3xl dark:text-white">
                    login to your account
                </h1>
            </div>

            <div class="mt-8 lg:w-1/2 lg:mt-0">
                <form id="login-form" class="w-full lg:max-w-xl" method="POST" action="<?= URL::site('/auth'); ?>">
                    <div class="relative flex items-center">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>

                        <input type="email" name="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Email address" required>
                    </div>

                    <div class="relative flex items-center mt-4">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>

                        <input type="password" name="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Password" required>
                    </div>

                    <div class="relative flex items-center mt-4 text-sm text-red-700" id="login-error"></div>

                    <div class="mt-8 md:flex md:items-center">
                        <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg md:w-1/2 hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>