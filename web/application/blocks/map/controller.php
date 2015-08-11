<?php
namespace Application\Block\Map;

use Loader;
use Page;
use \Concrete\Core\Block\BlockController;
use Core;
use \File;
class Controller extends BlockController
{

    protected $btTable = 'btMap';
    protected $btInterfaceWidth = "600";
    protected $btInterfaceHeight = "480";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btDefaultSet = 'navigation';
	
    public $title = "";
    public $location = "";
    public $latitude = "";
    public $longitude = "";
    public $scrollwheel = true;
    public $draggable = true;
    public $defaultui = false;
    public $customstyle = false;
    public $zoom = 14;
    public $fMarkerID = 0;
    public $styles = "";

    /**
     * Used for localization. If we want to localize the name/description we have to include this
     */
    public function getBlockTypeDescription()
    {
        return t("Enter an address and a Google Map of that location will be placed in your page.");
    }

    public function getBlockTypeName()
    {
        return t("Google Map");
    }


    public function validate($args)
    {
        $error = Loader::helper('validation/error');

        if (empty($args['location']) || $args['latitude'] === '' || $args['longtitude'] === '') {
            $error->add(t('You must select a valid location.'));
        }

        if (!is_numeric($args['zoom'])) {
            $error->add(t('Please enter a zoom number from 0 to 21.'));
        }
        if ($error->has()) {
            return $error;
        }
    }

    public function registerViewAssets()
    {
        $this->requireAsset('javascript', 'jquery');
        $this->addFooterItem(
            '<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>'
        );
    }

    public function view()
    {
		$this->set('unique_identifier', Core::make('helper/validation/identifier')->getString(18));
        $this->set('bID', $this->bID);
        $this->set('title', $this->title);
        $this->set('location', $this->location);
        $this->set('latitude', $this->latitude);
        $this->set('longitude', $this->longitude);
        $this->set('zoom', $this->zoom);
        $this->set('scrollwheel', $this->scrollwheel);
        $this->set('defaultui', $this->defaultui);
        $this->set('draggable', $this->draggable);
        $this->set('customstyle', $this->customstyle);
        $this->set('styles', $this->styles);
        $f = File::getByID($this->fMarkerID);
        if (!is_object($f) || !$f->getFileID()) {
            return false;
        }
        $this->set('f', $f);
    }

    public function save($data)
    {
    	$args['fMarkerID'] = ($data['fMarkerID'] != '') ? $data['fMarkerID'] : 0;
        $args['title'] = isset($data['title']) ? trim($data['title']) : '';
        $args['location'] = isset($data['location']) ? trim($data['location']) : '';
        $args['zoom'] = (intval($data['zoom']) >= 0 && intval($data['zoom']) <= 21) ? intval($data['zoom']) : 14;
        $args['latitude'] = is_numeric($data['latitude']) ? $data['latitude'] : 0;
        $args['longitude'] = is_numeric($data['longitude']) ? $data['longitude'] : 0;
        $args['width'] = $data['width'];
        $args['height'] = $data['height'];
        $args['scrollwheel'] = $data['scrollwheel'] ? 1 : 0;
        $args['draggable'] = $data['draggable'] ? 1 : 0;
        $args['defaultui'] = $data['defaultui'] ? 1 : 0;
        $args['customstyle'] = $data['customstyle'] ? 1 : 0;
        $args['styles'] = isset($data['styles']) ? trim($data['styles']) : '';
        parent::save($args);
    }
    function getFileID() {return $this->fMarkerID;}
    public function getFileObject() {
        return File::getByID($this->fMarkerID);
    }
}
