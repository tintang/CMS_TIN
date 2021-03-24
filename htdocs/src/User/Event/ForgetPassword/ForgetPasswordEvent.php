<?php


namespace App\User\Event\ForgetPassword;


use App\User\ForgetPassword\ForgetPassword;

class ForgetPasswordEvent
{

    private ForgetPassword $forgetPassword;

    /**
     * ForgetPasswordEvent constructor.
     * @param ForgetPassword $forgetPassword
     */
    public function __construct(ForgetPassword $forgetPassword)
    {
        $this->forgetPassword = $forgetPassword;
    }

    public function getForgetPassword(): ForgetPassword
    {
        return $this->forgetPassword;
    }

    public function setForgetPassword(ForgetPassword $forgetPassword): ForgetPasswordEvent
    {
        $this->forgetPassword = $forgetPassword;
        return $this;
    }
}