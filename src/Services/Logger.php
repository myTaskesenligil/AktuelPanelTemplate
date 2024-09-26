<?php

namespace App\Services;

use App\Models\Logs;

class Logger
{
    public static function addLog($action, $data = null)
    {
        $modelType = $data ? get_class($data) : null;
        $modelId = $data ? $data->id : null;

        if(str_contains($action, 'update')){

            // Sadece değişen sütunları alıp onları veritabanına kaydediyor.
            $change = $data->getDirty();
            foreach ($change as $key => $value) {
                $logData[$key]['old'] = $data->getOriginal($key);
                $logData[$key]['new'] = $value;
            }

            // Güncellenme zamanını timstamp formatından daha okunabilir bir formaya çeviriyoruz
            if(isset($logData['updated_at'])){
                $logData['updated_at']['old'] = $logData['updated_at']['old']->toDateTimeString();
            }
        }

        Logs::create([
            'userId' => auth()->id() ?? 1,
            'userIP' => $_SERVER['REMOTE_ADDR'] ?? '::1',
            'action' => $action,
            'modelType' => $modelType,
            'modelId' => $modelId,
            'data' => isset($logData) ? json_encode($logData) : json_encode($data)
        ]);
    }
}
