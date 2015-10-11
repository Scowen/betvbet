<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class RegisterForm extends Model
{
    public $email;
    public $emailConfirm;
    public $password;
    public $passwordConfirm;
    public $title;
    public $firstname;
    public $middlename;
    public $lastname;
    public $dob;
    public $contact;
    public $security;
    public $mother_maiden_name;
    public $currency;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password', 'title', 'firstname', 'lastname', 'dob', 'contact', 'security', 'mother_maiden_name', 'currency'], 'required'],
            ['password', 'compare', 'compareAttribute' => '$passwordConfirm'],
            ['email', 'compare', 'compareAttribute' => '$emailConfirm'],
            [['email', 'password'], 'string', 'max' => 128],
            ['email', 'match', 'pattern' => "/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/"],
            [['title', 'firstname', 'middlename', 'lastname', 'contact', 'mother_maiden_name'], 'string', 'max' => 128],
        ];
    }

    public function submit()
    {
        if ($this->validate()) {
            // Do validation and model saving here.
        }
        return false;
    }
}
