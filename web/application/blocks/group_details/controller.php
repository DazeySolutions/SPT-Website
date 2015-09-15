<?php
namespace Application\Block\GroupDetails;
use Loader;
use Group;
use GroupList;
use \Concrete\Core\Block\BlockController;
class Controller extends BlockController {
	
	protected $btInterfaceWidth = 480;
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btInterfaceHeight = 600;
	protected $btTable = 'btGroupDisplay';
	
	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Display Group Bios");
	}
	
	public function getBlockTypeName() {
		return t("Group Bios");
	}

	public function add(){
		$this->common();
	}
	public function edit(){
		$this->common();
	}
	public function view(){
		$group = Group::getByName($this->groupName);
		$users = $group->getGroupMembers();
		$userData = array();
		foreach($users as $user){
			$userData[$user->getAttribute('sort_order').$user->getAttribute('real_name')] = $user;
		}
		ksort($userData);
		$this->set('userData', $userData);
    $this->set('title', $this->title);
	}
	
	protected function common(){
	}
	public function save($data){
		
		parent::save($data);
	}
}
?>
