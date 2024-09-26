<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\Panel\AuthGroups;
use App\Models\Panel\AuthModules;
use App\Http\Controllers\Controller;
use App\Models\Panel\AuthGroupModules;

class ModuleSettings extends Controller
{
    public function getModules(){

        $modules = AuthModules::where('amParentMenuId',0)->with('childModules')->with('groups')->get();

        $groups = AuthGroups::all();

        return view('panel.pages.module-settings', ['modules' => $modules, 'groups' => $groups]);

    }

    public function addParentModule(Request $request){

        if($request->id){

            $model = AuthModules::find(decrypt($request->id));

            if(!$model)
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

            $model->fill($request->all());

            if($model->save())
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
            else
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

        }else{

            $model = new AuthModules();
            $model->amParentMenuId = 0;
            $model->fill($request->all());

            if($model->save()){
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla kaydedildi']);
            }else{
                return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Birşeyler ters gitti']);
            }

        }

    }

    public function addChildModule(Request $request){

        if($request->id){

            $model = AuthModules::find(decrypt($request->id));

            if(!$model)
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

            $model->fill($request->all());

            if($model->save())
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
            else
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

        }else{

            $model = new AuthModules();
            $model->fill($request->all());

            if($model->save()){
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla kaydedildi']);
            }else{
                return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Birşeyler ters gitti']);
            }

        }

    }

    public function addGroup(Request $request){

        if($request->id){

            $model = AuthGroups::find(decrypt($request->id));

            if(!$model)
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

            $model->fill($request->all());

            if($model->save())
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Grup başarıyla güncellendi']);
            else
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

        }else{

            $model = new AuthGroups();
            $model->fill($request->all());

            if($model->save()){
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Grup başarıyla kaydedildi']);
            }else{
                return response()->json(["type" => "error", "title" => "Hata Oluştu", 'desc' => 'Birşeyler ters gitti']);
            }

        }

    }

    public function deleteModule(Request $request){
        $model = AuthModules::find(decrypt($request->id));

        if(!$model)
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

        $model->delete();
        return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla silindi']);
    }

    public function changeStatus(Request $request){
        $model = AuthModules::find(decrypt($request->id));

        if(!$model)
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

        $model->amStatus = $request->val == "true" ? 1 : 0;

        if($model->save())
                return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
            else
                return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);
    }

    public function switchData(Request $request){

        switch ($request->inputName) {
            case 'status':

                $model = AuthModules::find(decrypt($request->id));

                if(!$model)
                        return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

                $model->amStatus = $request->val == "true" ? 1 : 0;

                if($model->save())
                        return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
                    else
                        return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

                break;

            case 'show':

                $model = AuthModules::find(decrypt($request->id));

                if(!$model)
                        return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

                $model->amShowMenu = $request->val == "true" ? 1 : 0;

                if($model->save())
                    return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
                else
                    return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

                break;

            case 'group':

                if($request->val == "true"){

                    $model = new AuthGroupModules();
                    $model->agmModuleId = decrypt($request->id);
                    $model->agmGroupId = decrypt($request->group_id);

                    if($model->save())
                        return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
                    else
                        return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);

                }else{
                    $model = AuthGroupModules::where('agmModuleId', decrypt($request->id))->where('agmGroupId', decrypt($request->group_id) )->first();
                    if($model){
                        $model->delete();
                        return response()->json(["type" => "success", "title" => "Başarılı", 'desc' => 'Modül başarıyla güncellendi']);
                    }else{
                        return response()->json(["type" => "error", "title" => "İşlem Hatası", 'desc' => 'Veritabanı hatası oluştu']);
                    }

                }

                break;

            default:
                # code...
                break;
        }

    }
}
