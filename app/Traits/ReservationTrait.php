<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ReservationTrait
{
    protected function commonStoreValidationAndFlash(Request $request, array $rules, array $messages)
    {
        $request->validate($rules, $messages);
        // Common creation logic can be extended
        return true;
    }

    protected function commonDestroy($id, string $modelClass, string $route, string $successMsg)
    {
        $item = $modelClass::findOrFail($id);
        if ($item->user_id !== session('user_id') && session('user_role') !== 'admin') {
            abort(403);
        }
        $item->delete();
        return redirect()->route($route)->with('success', $successMsg);
    }

    protected function commonApprove($id, string $modelClass, string $successMsg = 'Aprobado correctamente.')
    {
        if (session('user_role') !== 'admin') abort(403);
        $item = $modelClass::findOrFail($id);
        $item->update(['status' => 'aprobada']);
        return redirect()->back()->with('success', $successMsg);
    }

    protected function commonReject($id, string $modelClass, string $successMsg = 'Rechazado correctamente.')
    {
        if (session('user_role') !== 'admin') abort(403);
        $item = $modelClass::findOrFail($id);
        $item->update(['status' => 'rechazada']);
        return redirect()->back()->with('success', $successMsg);
    }

    protected function adminIndexQuery()
    {
        return session('user_role') === 'admin';
    }
}

