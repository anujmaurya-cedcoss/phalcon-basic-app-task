<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;

class LoginController extends Controller
{
    public function IndexAction()
    {
        // nothing here
    }
    public function loginAction()
    {
        $user = new Users();
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email'
            ]
        );
        $query = $this->modelsManager->createQuery('SELECT * FROM Users WHERE name = :name: AND email = :email:');
        $usr = $query->execute([
            'name' => $user->name,
            'email' => $user->email
        ]);

        if (isset($usr[0])) {
            $this->view->success = true;
            $this->view->message = "LoggedIn succesfully";
        } else {
            $this->view->message = "Invalid Credentials";
        }
    }
}