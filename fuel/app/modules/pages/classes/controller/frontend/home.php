<?php
namespace Pages;

class Controller_Frontend_Home extends \Controller_Frontend
{
    public function before(){
        parent::before();
    }
    
    public function action_index(){
        $this->_data_template['list_reward'] = \Reward\Model_Reward::query()->where('status',1)->order_by('id')->limit(5)->get();
    	return \Response::forge(\View::forge('pages::frontend/home.twig',$this->_data_template,FALSE));
    }

    public function action_news(){
        return \Response::forge(\View::forge('pages::frontend/news.twig',$this->_data_template,FALSE));
    }

    public function action_news_detail(){
        $id = $this->param('id');
        $news_detail = \Pages\Model_News::query()->where('id',$id)->get();;
        $this->_data_template['news_detail'] = $news_detail;

    	return \Response::forge(\View::forge('pages::frontend/news_detail.twig',$this->_data_template,FALSE));
    }

    public function action_profile(){
        $user_id = \Session::get('user_id');
        if(empty($user_id)){
            \Session::set_flash('ask_login','Please login before continue');
            \Response::redirect(\Uri::base().'login');
        }
        $this->_data_template['profile'] = \Users\Model_Members::query()->where('id',$user_id)->get_one();
        $this->_data_template['success_update'] = \Session::get_flash('success_update');
        $this->_update_profile($user_id);
        return \Response::forge(\View::forge('pages::frontend/profile.twig',$this->_data_template,FALSE));
    }

    public function action_logout(){
        \Session::destroy();
        \Response::redirect(\Uri::base());
    }

    public function action_add_point(){
        $_post_data = \Input::post();
        if(empty(\Session::get('user_id'))){
            \Session::set_flash('ask_login','Please login before continue');
            return \Response::redirect(\Uri::base().'login');
        }
        $news = Model_News::query()->where('id',$_post_data['news_id'])->get_one();
        $task = \Promo\Model_Task::query()->where('promo_id',$news->promo_id)->where('type','Share')->get_one();
        $user_id = \Session::get('user_id');
        \Users\Model_activityUser::add_point($user_id,$task->id,$news->brand_id);
    }


    private function _update_profile($user_id){
        $_post_data = \Input::post();
        if (count($_post_data) > 0) {
            $_err = \Users\Model_Members::validate_profile($_post_data);
            if(count($_err) > 0){
                $this->_data_template['error_message'] = $_err;
                return;
            }

            try{
                \Users\Model_Members::update_profile($_post_data,$user_id);
                \Session::set_flash('success_update','Profile has been updated');
                \Response::redirect(\Uri::base().'profile');  
            }
            catch (\Exception $e){
//               $this->_data_template['error_message'] = $e -> getMessage();
               $this->_data_template['error_message'] = "Fail to Update, please try again.";
            }
        }
    }

}