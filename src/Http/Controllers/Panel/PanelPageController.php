<?php

namespace App\Http\Controllers\Panel;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Services\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\AuthGroupUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PanelPageController extends Controller
{
    public function index(Request $request){
        if (Auth::check()){
            Logger::addLog('Dashboard page viewed');
            return view('panel.pages.index');
        }else{
            if($request->method() == 'GET'){
                return view('panel.auth.login');
            }else if($request->method() == 'POST'){

                $data = $request->only('email', 'password');

                if(Auth::attempt($data)){
                    $user = Auth::user();
                    session([
                        'name' => $user->name,
                        'surname' => $user->surname,
                        'email' => $user->email,
                        'group_id' => AuthGroupUsers::getGroupIdByUserId($user->id),
                        'group_name' => AuthGroupUsers::getGroupNameByUserId($user->id),
                    ]);
                    Logger::addLog('User login');
                    return redirect(route('index'));
                }else{
                    return redirect()->back();
                }
            }
        }
    }

    public function logout(Request $request){
        Logger::addLog('User logout');
        auth()->logout();

        return redirect(route('index'));
    }

    public function createPassword($id)
    {
    //        $user = User::where('id', 53)->first();
    //        return view('mail.welcome', ['user' => $user, 'url' => 'asd', 'appName' => 'deneme']);
        if (!$id)
            abort('404', 'SAYFA BULUNAMADI.');

        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            abort('403', 'GEÇERSİZ PARAMETREE.');
        }
        $user = User::where('id', $id)->first();
        if(!$user)
            abort('404', 'SAYFA BULUNAMADI.');


        if($user->password_generated == 1)
            abort('403', 'ŞİFRE DAHA ÖNCE OLUŞTURULMUŞ');

        Logger::addLog('createPassword sayfası görüntülendi', $user);
        return view('panel.auth.create-pass', ['id' => encrypt($id), 'adSoyad' => $user->name.' '.$user->surname]);
    }

    public function saveNewPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ], [
            'password.required' => 'Şifre alanı zorunludur.',
            'password.confirmed' => 'Şifre ve Şifre Tekrar alanları eşleşmiyor.',
            'password.min' => 'Şifre en az 8 karakterli olmalıdır.',
            'password.regex' => 'Şifre en az bir büyük harf, bir küçük harf ve bir rakam içermelidir.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "type" => "warning",
                "title" => "Dikkat",
                'desc' => $validator->errors()->first(),
                "msg" => 'Hata Kodu: 104'
            ]);
        }

        $user = User::where('id', decrypt($request->id))->first();
        if(!$user)
            return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Kullanıcı bulunamadı.']);

        $user->password = bcrypt($request->password);
        $user->password_generated = 1;

        if($user->save())
            return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Şifreniz başarıyla oluşturuldu, yönlendiriliyorsunuz...']);
        else
            return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Bilgiler kaydedilemedi. Lütfen daha sonra tekrar deneyiniz.']);

    }

    public function forgotPassword()
    {
        return view('panel.auth.forgot-pass');
    }

    public function resentPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user)
            return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Sisteme kayıtlı böyle bir kullanıcı bulunamadı.']);
        $user->password_generated = 0;
        $saved = $user->save();

        $text = 'Alan Adı Yönetim Sistemi\'ne kayıtlı üyeliğinizin şifresini yenilemeniz için gerekli bağlantı linki gönderilmiştir. Aşağıda yer alan butona tıklayarak şifrenizi yenileyebilirsiniz.';

        $urlData = encrypt($user->id);
        $result = Mail::to($user->email)->send(new WelcomeMail($user, $urlData, $text));
        Logger::addLog(' reset pass mail send to : ' . $request->email);

        if (!empty($result) && $saved)
            return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Şifre sıfırlama bağlantısı e-posta adresinize gönderilmiştir.']);
        else{
            if(empty($result))
                return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Şifre sıfırlama bağlantısı gönderilemedi, lütfen daha sonra tekrar deneyiniz.']);

            if (!$saved)
                return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Veritabanı hatası oluştu. Lütfen daha sonra tekrar deneyiniz.']);
        }

    }
}
