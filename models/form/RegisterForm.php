<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\User;

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
    public $mother;
    public $currency;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Required Fields.
            [['email', 'emailConfirm', 'password', 'passwordConfirm', 'title', 'firstname', 'lastname', 'dob', 'contact', 'security', 'mother', 'currency'], 'required'],
            // Comparison Fields.
            ['password', 'compare', 'compareAttribute' => 'passwordConfirm', 'message' => 'Your passwords do not match.'],
            ['email', 'compare', 'compareAttribute' => 'emailConfirm', 'message' => 'Your email addresses do not match.'],
            // Regex Pattern Fields.
            ['password', 'match', 'pattern' => '/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'message' => 'Your password must contain a lowercase letter, an uppercase letter and a digit.'],
            ['email', 'match', 'pattern' => '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD'],
            // String Length Fields.
            [['email', 'password'], 'string', 'max' => 128],
            [['firstname', 'middlename', 'lastname', 'contact', 'mother'], 'string', 'min' => 3, 'max' => 128],
            ['security', 'string', 'length' => 4],
            ['contact', 'string', 'length' => 11],
            // Range Fields
            // TODO: Add more supported currencies, for now, just GBP.
            ['currency', 'in', 'range' => ['GBP']],
            ['title', 'in', 'range' => ['Mr', 'Mrs', 'Ms', 'Miss']],
            // Poor little old date field all by his lonesome. Haha, loser.
            ['dob', 'date', 'format' => 'yyyy-dd-MM'],
            // Check that the email address being used is in fact, unique.
            ['email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email'],
        ];
    }

    public function submit()
    {
        if ($this->validate()) {
            // Create a new user model.
            $user = new User;

            // Assign attributes.
            $user->attributes = [
                'email' => $this->email,
                'password' => $this->password,
                'created' => time(),
                'title' => $this->title,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'dob' => strtotime($this->dob),
                'contact' => $this->contact,
                'security' => $this->dob,
                'mother_maiden_name' => $this->mother,
                'currency' => $this->currency,
            ];

            // Finally, save the user.
            $user->save();

            // Now that we have a valid user, send them an activation email.
            $user->sendActivationEmail();

            return true;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'firstname' => 'First Name',
            'middlename' => 'Middle Name',
            'lastname' => 'Last Name',
            'email' => 'Email Address',
            'emailConfirm' => 'Confirm Email Address',
            'dob' => 'Date of Birth',
            'passwordConfirm' => 'Confirm Password',
            'contact' => 'Telephone Number',
            'security' => '4 Digit Security Code',
            'mother' => 'Mother\'s Maiden Name',
        ];
    }
}
