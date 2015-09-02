<?php 
namespace Concrete\Package\BootstrapSection;
use Concrete\Package\BootstrapSection\Src\BootstrapSectionFramework;
use Core;
use Package;
class Controller extends Package{
	protected $pkgHandle = 'bootstrap_section';
	protected $appVersionREquire = '5.7.4.0';
	protected $pkgVersion = '0.0.1';
	
	public function getPackageName(){
		return t('Bootstrap Section Framework');
	}
	
	public function getPackageDescription(){
		return t('Bootstrap grid framework with section class added to row');
	}
	
	public function on_start()
	{
    	$manager = Core::make('manager/grid_framework');
    	$manager->extend('bootstrap3s', function($app) {
        	return new BootstrapSectionFramework();
    	});
	}
}