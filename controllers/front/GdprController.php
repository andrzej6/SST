<?php



class GdprController extends FrontController {
public $php_self = 'gdpr';

public function setMedia()
	{
		parent::setMedia();
		/* $this->addCSS(_THEME_CSS_DIR_.'benefits.css'); */
	}

public function init() {
    parent::init();
}

public function initContent() {
    parent::initContent();
	
	
	if (!empty($_GET)) {
		    $email = Tools::getValue('email');
		    $list = Tools::getValue('list');
			$opt = Tools::getValue('opt');
			
            if (
                filter_var($email, FILTER_VALIDATE_EMAIL) &&
                //(($list == 'DSE Assessors') || ($list == 'Allied Health') || ($list == 'Gavin contacts')) &&
                (($opt == 'yes') || ($opt == 'no'))
               )
            {
				$query = new DbQuery();
				$query->select('id');
				$query->from('mailing_list');
				$query->where('email = \''.$email.'\'');
				$query->where('list = \''.$list.'\'');

		        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);
			    
                if (!empty($result))
                {
                    //DB::table('mailing_list')->where('email', $request->email)->where('list',$request->list)->update(['opt' => $request->opt]);
					Db::getInstance()->update('mailing_list', array('email' => $email,'list' => $list,'opt' => $opt));
					$this->context->smarty->assign('notif', 'Activation was successful. Thank you.');
                }
                else
                {
					Db::getInstance()->insert('mailing_list', array('email' => $email,'list' => $list,'opt' => $opt));
					
					if (!empty(Db::getInstance()->Insert_ID()))
						$this->context->smarty->assign('notif', 'Activation was successful. Thank you.');
					else $this->context->smarty->assign('notif', 'Activation was not successful.');
						
                }
				
                //flash('Activation was successful. Thank you.','success');
            }
            else
                //flash('Activation was not successful. Empty or incorrect values','error');
			    $this->context->smarty->assign('notif', 'Activation was not successful. Empty or incorrect values');
        }
        else //flash('Activation was not successful. Empty values','error');
		     $this->context->smarty->assign('notif', 'Activation was not successful. Empty values');
	
	
     $this->setTemplate(_PS_THEME_DIR_.'gdpr.tpl'); 
}

}

