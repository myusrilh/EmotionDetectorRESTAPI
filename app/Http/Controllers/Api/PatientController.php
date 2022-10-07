<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function PHPUnit\Framework\isEmpty;

class PatientController extends ApiController
{

    public function all()
    {
        $patient = User::where('level', '=', 'patient')->get();
        if ($patient == null) {
            return $this->errorResponse('Data pasien belum ada', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($patient, 'Data pasien ada');
    }

    public function getPatientById(Request $request)
    {
        $patient = Patient::with(['user'])->whereRelation('user', 'id', '=', $request->input('id'))->first();
        if ($patient == null) {
            return $this->errorResponse('Data pasien belum ada', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($patient, 'Data pasien ada');
    }
}
