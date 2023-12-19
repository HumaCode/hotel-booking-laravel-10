<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;

class SettingController extends Controller
{
    public function smtpSetting()
    {
        $smtp = SmtpSetting::find(1);

        return view('backend.setting.smtp_update', compact('smtp'));
    }
    
    public function smtpUpdate(Request $request)
    {
        $smtp_id = $request->id;

        SmtpSetting::find($smtp_id)->update([
            'mailer'        => $request->mailer,
            'host'          => $request->host,
            'port'          => $request->port,
            'username'      => $request->username,
            'password'      => $request->password,
            'encryption'    => $request->encryption,
            'from_address'  => $request->from_address,
        ]);

        $notification = [
            'message'       => 'Smtp Setting Update Successfully.',
            'alert-type'    => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
