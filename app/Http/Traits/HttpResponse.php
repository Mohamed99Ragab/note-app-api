<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HttpResponse
{


    public function responseJson($data =null,$message = null,$status){


        return response()->json(['data'=>$data,'message'=>$message,'status'=>$status]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->responseJson(null,$validator->errors()->first(),false)
        );
    }


}
