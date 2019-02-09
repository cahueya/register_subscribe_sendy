<?php


namespace Concrete\Package\RegisterSubscribeSendy\Controller\SinglePage\Dashboard;
use Concrete\Package\RegisterSubscribeSendy;
use Concrete\Core\Page\Controller\DashboardPageController;
use Core;
use Package;
use Concrete\Core\Routing\Redirect;
use Concrete\Core\Page\Single as SinglePage;

defined('C5_EXECUTE') or die("Access Denied.");
class Subscribe extends DashboardPageController
{

    public function view() {  
		$pkg = Package::getByHandle('register_subscribe_sendy');
        $API_KEY = $pkg->getConfig()->get('settings.subscribe.API_KEY');
        $INSTALL_URL = $pkg->getConfig()->get('settings.subscribe.INSTALL_URL');
        $LIST_ID = $pkg->getConfig()->get('settings.subscribe.LIST_ID');
        
        $this->set('API_KEY', $API_KEY);
        $this->set('INSTALL_URL', $INSTALL_URL);
        $this->set('LIST_ID', $LIST_ID);
	
    }

    public function update_configuration() {
    	if (!$this->token->validate('perform_update_configuration')) {
            $this->flash('error', $this->token->getErrorMessage());

            return Redirect::to('/dashboard/subscribe');
        }
    
        if ($this->isPost()) {
           $API_KEY = $this->post('API_KEY');
           $INSTALL_URL = $this->post('INSTALL_URL');
           $LIST_ID = $this->post('LIST_ID');
               
           $pkg = Package::getByHandle('register_subscribe_sendy');
           $pkg->getConfig()->save('settings.subscribe.API_KEY', $API_KEY);
           $pkg->getConfig()->save('settings.subscribe.INSTALL_URL', $INSTALL_URL);
           $pkg->getConfig()->save('settings.subscribe.LIST_ID', $LIST_ID);
                    
           $this->set('message', t("Configuration saved"));
        }

        $this->view();
    }

    public function config_saved() {
        $this->set('message', t("Configuration saved"));
        $this->view();
    }

}
?>
