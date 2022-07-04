<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $organization_id;
    public $job_title;
    public $avatar_path;
    public $avatar;
    public $file_path;
    public $file_custom;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'organization_id', 'job_title', 'password'], 'required'],
            [['organization_id'], 'integer'],
            [['username', 'job_title'], 'string', 'max' => 255],
            [['email', 'password'], 'string', 'max' => 55],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['file_custom'], 'file', 'skipOnEmpty' => true],
        ];
    }

    public function upload() {
        if ($this->avatar) {
            $this->avatar->saveAs($this->getPath($this->avatar));
        }
        if ($this->file_custom) {
            $this->file_custom->saveAs($this->getPath($this->file_custom));
        }
        return true;
    }


    static function getPath($uFile) {
        $path = '';
        if ($uFile) {
            $path .= '../web/uploads/' . static::getFilename($uFile);
        }
        return $path;
    }


    static function getFilename($uFile) {
        $path = '';
        if ($uFile) {
            $path .= $uFile->baseName;
            if ($uFile->extension) {
                $path .= '.' .$uFile->extension;
            }
        }
        return $path;
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->organization_id = $this->organization_id;
        $user->job_title = $this->job_title;
        $user->avatar_path = $this->avatar_path;
        $user->file_path = $this->file_path;
        $user->password= $this->password;

        if (!$user->validate()) {
            if ($user->getErrors()) {
                foreach ($user->getErrors() as $key => $value) {
                     Yii::$app->session->setFlash('error', $value);
                }
            }
            return null;
        }
        return $user->save();
    }

}