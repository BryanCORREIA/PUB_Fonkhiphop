<?php

namespace App\Domain;

use App\Entity\User;

class mailAction
{
    /**
     * @var string
     */
    public $subject;

    /**
     * @var array
     */
    public $from;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $template;

    /**
     * @var User
     */
    public $user;

    /**
     * @param $subject
     * @param $to
     * @param $template
     * @param User $user
     * @return mailAction
     */
    public static function build(
        $subject,
        $to,
        $template,
        User $user
    ) {
        $action = new self();

        $action->subject    = $subject;
        $action->from       = ['no-reply@fonkhiphop.fr' => 'Fonkhiphop'];
        $action->to         = $to;
        $action->template   = $template;
        $action->user       = $user;

        return $action;
    }
}