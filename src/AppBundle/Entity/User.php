<?php
/**
 * Created by PhpStorm.
 * User: jaime
 * Date: 24/09/17
 * Time: 19:17
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table("users",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="emailUnique", columns={"email"}),
 *          @ORM\UniqueConstraint(name="usernameUnique", columns={"username"})
 *     }
 * )
 */
class User implements UserInterface
{
    /**
     * @var integer

     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=75)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=75)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=75)
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="string", length=125)
     */
    private $roles;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", options={"default": TRUE})
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    function __construct()
    {
        $this->active = true;
        $this->createdAt = new \DateTime("now");
        // TODO: Modified
        $this->roles = "ROLE_ADMIN";
    }

    /**
     * @param $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array($this->roles);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->password = null;
        $this->active = false;
        $this->deletedAt = new \DateTime("now");
    }
}