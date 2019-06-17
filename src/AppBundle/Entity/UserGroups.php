<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserGroups
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="groups")
 */
class UserGroups extends Role
{
    /**
     * @ORM\Column(type="integer", name="group_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="group_title", length=100)
     */
    protected $groupTitle;

    /**
     * @var array
     */
    private $role_translator = array(
        'ADMIN' => 'ROLE_ADMIN',
        'PAGE_1' => 'ROLE_PAGE_1',
        'PAGE21' => 'ROLE_PAGE_2'
    );

    /**
     * @return mixed
     */
    public function getGroupTitle()
    {
        return $this->groupTitle;
    }

    /**
     * Returns the role.
     *
     * This method returns a string representation whenever possible.
     *
     * When the role cannot be represented with sufficient precision by a
     * string, it should return null.
     *
     * @return string|null A string representation of the role, or null
     */
    public function getRole()
    {
        return $this->role_translator[$this->getGroupTitle()];
    }
}