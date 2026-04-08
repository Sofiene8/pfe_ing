<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alstas
 * Date: 2/27/12
 * Time: 4:22 PM
 * To change this template use File | Settings | File Templates.
 */
class SJB_Function
{
	/**
	 * @var SJB_Acl
	 */
	public $acl;
	/**
	 * @var array
	 */
	public $params;
	/**
	 * current user sid
	 * @var int
	 */
	protected $aclRoleID;
	/**
	 * indicate what value should be returned if permission is not defined;
	 * @var bool
	 */
	protected $allowed = true;
	/**
	 * @var string|array
	 */
	protected $permissionLabel;

	/**
	 * @param SJB_Acl $acl
	 * @param array $params
	 * @param int $roleID
	 */
	public function __construct(SJB_Acl $acl, $params, $roleID)
	{
		$this->acl = $acl;
		$this->setAclRoleID($roleID);
		$this->params = $params;
	}

    /**
     * @return bool
     */
	public function isAccessible()
	{
		if (!$this->permissionLabel) {
			return $this->allowed;
		}

        $permissions = $this->permissionLabel;
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }
        foreach ($permissions as $permission) {
            if ($this->acl->isAllowed($permission, $this->getAclRoleID())) {
                return true;
            }
        }

		return false;
	}

	public function execute()  {}

	/**
	 * @param string|array $permissionLabel
	 */
	public function setPermissionLabel($permissionLabel)
	{
		$this->permissionLabel = $permissionLabel;
	}

	/**
	 * @return string
	 */
	public function getPermissionLabel()
	{
		return $this->permissionLabel;
	}

	/**
	 * @param int $aclRoleID
	 */
	public function setAclRoleID($aclRoleID)
	{
		$this->aclRoleID = $aclRoleID;
	}

	/**
	 * @return int
	 */
	public function getAclRoleID()
	{
		return $this->aclRoleID;
	}
}
