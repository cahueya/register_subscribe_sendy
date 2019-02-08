<?php
namespace Concrete\Package\RegisterSubscribeSendy;

use Database;
use Package;
use SinglePage;
use Core;
use Whoops\Exception\ErrorException;
use Log;
use Events;
use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Attribute\Key\Category as AttributeKeyCategory;
use Concrete\Core\Attribute\Type as AttributeType;
use AttributeSet;
use Concrete\Core\Entity\Attribute\Set;
use Concrete\Core\Entity\Attribute;
use Concrete\Core\Attribute\SetFactory;
use User;

use Concrete\Core\Entity\Attribute\Key\UserKey;


class Controller extends Package {
	protected $pkgHandle = 'register_subscribe_sendy';
	protected $appVersionRequired = '5.7.5';
	protected $pkgVersion = '0.4';


	public function getPackageDescription () {
		return t("Offer subscription to a Sendy List on User Registration");
	}

	public function getPackageName () {
		return t("Register - Subscribe to Sendy");
	}

	public function install () {

			$pkg = parent::install();
            SinglePage::add('/dashboard/subscribe',$pkg);
            
            $service = $this->app->make('Concrete\Core\Attribute\Category\CategoryService');
			$categoryEntity = $service->getByHandle('collection');
			$category = $categoryEntity->getController();

			$key = $category->getByHandle('register_subscribe');
			if (!is_object($key)) {
    		$key = new UserKey();
            $key->setAttributeKeyHandle('register_subscribe');
            $key->setAttributeKeyName('Subscribe on Register');
            $key->setAttributeKeyEditableOnRegister(true);
            $key = $category->add('boolean', $key, null, $pkg);
        }
    }        
                
            
  

    public function uninstall(){
        $pkg = parent::uninstall();
    }

	public function upgrade () {
		$pkg =parent::upgrade();
		$pkg = Package::getByHandle($this->pkgHandle);

	}


    public function on_start()
    {   
        require $this->getPackagePath() . '/vendor/autoload.php';
        
        $event = Core::make('\Concrete\Package\RegisterSubscribeSendy\Src\Subscribe');
        Events::addListener('on_user_validate', array($event, 'userAdd'));

    }
   

}
