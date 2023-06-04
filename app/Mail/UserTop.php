<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserTop extends Mailable
{
    use Queueable, SerializesModels;
    protected $User;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $User)
    {
        //
        $this->User = $User;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nameuser = $this->User->name;
        return $this->from('example@example.com', 'SHOP GIA HỶ')->subject('Shop hải sản Vĩnh Long Kính Gửi')->view('admin.sendemail',compact('nameuser'));
    }
}
