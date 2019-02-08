<?php
namespace  Concrete\Package\RegisterSubscribeSendy\Src;
use Concrete\Core\Http\ServerInterface;
use Concrete\Core\Package\Package;
use Database;
use Core;
use Events;
use Loader;
use User;
use Concrete\Core\User\Event\UserInfo;
use Concrete\Core\User\Event;




class Subscribe
{

    public function userAdd($event)
    {
    	$pkg = Package::getByHandle('register_subscribe_sendy');
        $apikey = $pkg->getConfig()->get('settings.subscribe.API_KEY');
        $endpoint = $pkg->getConfig()->get('settings.subscribe.INSTALL_URL');
        $listid = $pkg->getConfig()->get('settings.subscribe.LIST_ID');
		$user = $event->getUserInfoObject();
    	$subscribe_check = $user->getAttribute('register_subscribe');
        $email = $user->getUserEmail();

        if ($subscribe_check == 1) {

    	    $installed = Package::getInstalledHandles();
		    if (!(is_array($installed) && in_array('community_store', $installed))) {
			    $name = (' ');
		        } else {
			    $name = ($user->getAttribute('billing_first_name') . ' ' . $user->getAttribute('billing_last_name'));
		    }


    		if(isset($apikey, $endpoint, $listid)) {
    
            define('Sendy_PHP_API_Wrapper', true);
            $pkg = Package::getByHandle("register_subscribe_sendy");
            require_once $pkg->getPackagePath() . "/vendor/ahmadawais/sendy-php-api/src/class-sendy-php-api.php";
            $config = [
                'installation_url' => $endpoint,
                'list_id' => $listid,
                'api_key' => $apikey
                ];
            $sendy = new \Sendy\Sendy_PHP_API($config);
            $result = $sendy->subscribe([
                'name' => $name,
                'email' => $email
                ]);
            } else {
            }     
        
        }
    }
}	




