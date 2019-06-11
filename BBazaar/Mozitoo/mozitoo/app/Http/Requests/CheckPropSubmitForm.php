<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckPropSubmitForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //User Type
            'user_type_val' => 'required|digits_between:1,2',
            //When user is already registered
           'user_email' =>'required_if:user_type_val,2|email',
           'user_password' =>'required_if:user_type_val,2',
           'inputManagerLogin' =>'required_if:user_type_val,2',
           //When user is new
           'new_user_name' =>  'required_if:user_type_val,1',
           'new_user_email' => 'required_if:user_type_val,1|email',
           'new_user_mobile' => 'required_if:user_type_val,1|numeric',
           'new_user_pwd' => 'required_if:user_type_val,1',
           'inputManager' => 'required_if:user_type_val,1|numeric'
           
        //Other Fields
        //    'inputTenant' => 'required|integer',
        //    'property_title' => 'required',
        //    'property_desc' => 'required',
        //    'property_type' => 'required|integer',
        //    'property_bhk' => 'required|integer',
        //    'property_area' => 'required',
        //    'property_age' => 'required|integer',
        //    'property_furnishing_status' => 'required|integer',
        //    'property_furnishing_age' => 'required_if:property_furnishing_status,3|integer'
        //    'rental_type' => 'required|integer',
        //    'add_photo_gallery' =>'mimes:jpeg,png',
        //    'addressline1' => 'required',
        //    'inputLocality' => 'required',
        //    'inputCity' => 'required',
        //    'inputPincode' => 'required|integer',
        //    'inputState' => 'required',
        //    'inputLat' => 'required',
        //    'inputLng' => 'required'
        ];
    }
}
