<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Auth
 *
 * Controller handling authentication-related actions.
 */
class Controller_Auth extends Controller {

    /**
     * Store action: Handle login attempt.
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
                'dashboard' => Auth::instance()->logged_in('admin') ? URL::site('/user/dashboard') : URL::site('/admin/dashboard')
            ]));
        } else {
            $this->response->status(400);
            $this->response->body(json_encode([
                'error' => 'Wrong credentials.',
            ]));
        }
    }

    /**
     * Index action: Display login form.
     */
    public function action_index() {
        $this->response->body(
            View::factory('layouts/app')
                ->set('content', View::factory('pages/auth/login'))
        );
    }

    /**
     * Execute before each action.
     */
    public function before() {
        // Check if the user is trying to access the 'logout' route
        if (Request::current()->route()->name(Request::current()->route()) !== 'logout') {
            if (Auth::instance()->logged_in('admin')) {
                HTTP::redirect('/admin/dashboard');
            } elseif (Auth::instance()->logged_in()) {
                HTTP::redirect('/user/dashboard');
            }
        }
    }

    /**
     * Destroy action: Handle logout.
     */
    public function action_destroy() {
        $loggedOut = Auth::instance()->logout();

        // Set the response header to application/json
        $this->response->headers('Content-Type', 'application/json');
        if ($loggedOut) {
            $this->response->status(200);
            $this->response->body(json_encode([
                'success' => $loggedOut,
                'home' => URL::site('/')
            ]));
        } else {
            $this->response->status(400);
            $this->response->body(json_encode([
                'error' => 'Something went wrong, please try again in a few minutes.',
            ]));
        }
    }
}
