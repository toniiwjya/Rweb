<?php
namespace Promo;

class Controller_Promo extends \Controller_Frontend
{
	public function action_index(){
		$this->_data_template['list_promo'] = Model_Promo::query()->where('status',1)->get();
		$this->_data_template['validate_user_promo'] = \Session::get_flash('validate_user_promo');
		return \Response::forge(\View::forge('promo::frontend/promo.twig',$this->_data_template,FALSE));
	}
    public function action_task(){
        
        if(empty(\Session::get('user_id'))){
            \Session::set_flash('ask_login','Please login before continue');
            return \Response::redirect(\Uri::base().'login');
        }

        $user_id = \Session::get('user_id');

        //Query to filter task base on user's promo
        $subQuery = Model_ActivityPromo::query()->select('promo_id')->where('user_id',\Session::get('user_id'));
        $this->_data_template['list_task'] = Model_Task::query()
                                                        ->where('promo_id','IN', $subQuery->get_query(true))
                                                        ->get();
        return \Response::forge(\View::forge('promo::frontend/task.twig',$this->_data_template,FALSE));
    }

    public function action_join(){
        $post_data = \Input::post();
    	
    	if(empty(\Session::get('user_id'))){
    		\Session::set_flash('ask_login','Please login before continue');
    		return \Response::redirect(\Uri::base().'login');
    	}else{
    		$user_id = \Session::get('user_id');
    	}

		//Check Promo Slot
    	$selected_promo = Model_Promo::query()->where('id',$post_data['id'])->get_one();
    	if($selected_promo['slot']>0){
    		//Check if user already join selected promo
    		$validate_user = Model_ActivityPromo::query()->where('user_id',$user_id)->where('promo_id',$post_data['id'])->get_one();
    		if(empty($validate_user)){
    			$join = Model_ActivityPromo::forge(array(
    			'user_id' => $user_id,
    			'promo_id' => $post_data['id'],
	    		));
	    		$join->save();

	    		$selected_promo['slot'] -= 1;
	    		$selected_promo->slot = $selected_promo['slot'];
	    		$selected_promo->save();
	    		return \Response::redirect(\Uri::base().'task');
    		}else{
    			\Session::set_flash('validate_user_promo','You have been registered in this '.$selected_promo->name.' promo');
    			return \Response::redirect(\Uri::base().'promo');
    		}
    	}else{
    		\Session::set_flash('validate_user_promo','This promo have reached maximum slot');
    		return \Response::redirect(\Uri::base().'promo');
    	}
    }
}