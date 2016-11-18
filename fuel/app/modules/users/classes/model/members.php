<?php

namespace Users;

class Model_Members extends \Orm\Model {

    private $status_name = array('Unverif', 'Verif');
    protected static $_table_name = 'user';

    protected static $_properties = array(
        'id',
        'role_id',
        'fName' => array(
            'label' => 'Full Name',
            'validation' => array(
                'required',
                'max_length' => array(100)
            )
        ),
        'email' => array(
            'label' => 'Email',
            'validation' => array(
                'required',
                'max_length' => array(100)
            )
        ),
        'password' => array(
            'label' => 'Password',
            'validation' => array(
                'required',
                'max_length' => array(250)
            )
        ),
        'gender' => array(
            'label' => 'Gender',
            'validation' => array(
                'max_length' => array(20)
            )
        ),
        'address' => array(
            'label' => 'Address',
            'validation' => array(
                'max_length' => array(200)
            )
        ),
        'phone' => array(
            'label' => 'Phone',
            'validation' => array(
                'max_length' => array(20)
            )
        )
    );

    public static function check_regis($email){
        return (self::query()->where('email',$email)->count()>0) ? TRUE : FALSE;
    }
}
