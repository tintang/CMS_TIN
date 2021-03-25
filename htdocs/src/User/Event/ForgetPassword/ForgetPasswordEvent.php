<?php


namespace App\User\Event\ForgetPassword;


use App\User\ForgetPassword\PasswordResetRequest;

class ForgetPasswordEvent
{

    private PasswordResetRequest $forgetPassword;

    /**
     * ForgetPasswordEvent constructor.
     * @param PasswordResetRequest $forgetPassword
     */
    public function __construct(PasswordResetRequest $forgetPassword)
    {
        $this->forgetPassword = $forgetPassword;
    }

    public function getForgetPassword(): PasswordResetRequest
    {
        return $this->forgetPassword;
    }

    public function setForgetPassword(PasswordResetRequest $forgetPassword): ForgetPasswordEvent
    {
        $this->forgetPassword = $forgetPassword;
        return $this;
    }
}