<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property integer $created
 * @property integer $active
 * @property integer $admin
 * @property double $balance
 * @property string $title
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property integer $dob
 * @property string $contact
 * @property string $security
 * @property string $mother_maiden_name
 * @property string $currency
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'created'], 'required'],
            [['authKey', 'accessToken'], 'string'],
            [['created', 'active', 'admin', 'dob'], 'integer'],
            [['balance'], 'number'],
            [['email', 'password'], 'string', 'max' => 128],
            [['title', 'firstname', 'middlename', 'lastname', 'contact', 'security', 'mother_maiden_name', 'currency'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'created' => 'Created',
            'active' => 'Active',
            'admin' => 'Admin',
            'balance' => 'Balance',
            'title' => 'Title',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'dob' => 'Dob',
            'contact' => 'Contact',
            'security' => 'Security',
            'mother_maiden_name' => 'Mother Maiden Name',
            'currency' => 'Currency',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return (Yii::$app->getSecurity()->validatePassword($password, $this->password));
    }

    /**
     * Before saving the record
     *
     * @param  boolean $insert Whether this method called while inserting a record. If false, it means the method is called while updating a record.
     * @return boolean Whether the insertion or updating should continue. If false, the insertion or updating will be cancelled.
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            return true;
        } else {
            return false;
        }
    }

    public function sendActivationEmail() {
        // First, create the body, in Html that is to be used.
        $htmlBody = "
        <div style='font-family: Trebuchet MS, Helvetica, sans-serif'>
            Hello " . $this->title . " " . $this->lastname . ",
            <br /><br />
            Thank you for registering with us at <a href='www.betvbet.co.uk'>Bet v Bet</a>.
            <br /><br />
            You are one step away from placing your first bet. Simply click the activation link below:
            <br />
            {activationLink}
            <br /><br />
            Alternatively, <a href='www.betvbet.co.uk/site/login'>log in</a> to your account and enter the code below:
            <br />
            {code}
            <br /><br />
            This code expires in 24 hours ({tomorrow}).
            <br /><br />
            Best of luck!
            <br />
            The Bet v Bet Team
            <br /><br /><br /><br />
            This inbox is not monitored, please do not reply to this address, any queries should be sent to <a href='mailto:support@betvbet.co.uk'>support@betvbet.co.uk</a>
        </div>
        ";

        // Now, create the activation code.
        $code = strtoupper(\app\components\Utilities::generateRandomString(6));
        // Create the activation link.
        $activationLink = Yii::getAlias('@web') . '/site/activate?code=' . $code;

        $activate = new Activate();
        $activate->attributes = [
            'user' => $this->id,
            'code' => $code,
            'expires' => time() + 86400,
            'created' => time(),
        ];
        $activate->save();

        $htmlBody = str_replace('{activationLink}', $activationLink, $htmlBody);
        $htmlBody = str_replace('{code}', $code, $htmlBody);
        $htmlBody = str_replace('{tomorrow}', date("d/m/Y H:i", time() + 86400), $htmlBody);
        Yii::$app->mailer->compose()
            ->setFrom(['noreply@betvbet.co.uk' => 'Bet v Bet'])
            ->setTo($this->email)
            ->setHtmlBody($htmlBody)
            ->setSubject('Bet v Bet - Account Activation')
            ->send();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivate()
    {
        return $this->hasOne(Activate::className(), ['user' => 'id'])->orderBy(['created' => SORT_DESC]);
    }
}
