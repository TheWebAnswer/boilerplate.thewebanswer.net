<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait RolesTrait
{
    #[ORM\Column ]
    private array $roles = [];

    public function getRoles() : array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;

        return $this;
    }
}
