<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class UserSeeder
 *
 * A class responsible for seeding users into the database.
 */
class UserSeeder {
    /**
     * Execute the user seeding logic.
     *
     * @return void
     */
    public static function execute() {
        // Seeder logic here
        $data = [
            [
                'username' => 'user@example.com',
                'email' => 'user@example.com',
                'password' => 'user12345',
                'roles' => [1]
            ],
            [
                'username' => 'admin@example.com',
                'email' => 'admin@example.com',
                'password' => 'admin12345',
                'roles' => [1,2]
            ]
        ];

        foreach ($data as $item) {
            $user = ORM::factory('User');
            $user->email = $item['email'];
            $user->username = $item['username'];
            $user->password = $item['password'];
            $user->save();
            
            foreach ($item['roles'] as $role) {
                $user->add('roles', $role);
            }
        }
    }
}