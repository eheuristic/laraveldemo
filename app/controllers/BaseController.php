<?php

class BaseController extends Controller {

    
    protected $theme;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        // Using theme as a global.
        $this->theme = Theme::uses('default')->layout('default');
       // $theme = Theme::uses('default')->layout('default');
        
        $this->theme->asset()->add('bootstrap', Theme::asset()->url('css/bootstrap.min.css'));
        $this->theme->asset()->add('bootstrap-theme', Theme::asset()->url('css/bootstrap-theme.min.css'));
        $this->theme->asset()->add('theme', Theme::asset()->url('css/theme.css'));
        $this->theme->asset()->add('jquery', Theme::asset()->url('js/jquery.js'));
        $this->theme->asset()->add('core-script', Theme::asset()->url('js/bootstrap.min.js'));
    }

}