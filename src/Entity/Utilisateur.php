<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"username"}, message="Le nom est déjà pris")
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=10, minMessage="Nom trop court", maxMessage="Nom trop long")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=10, minMessage="Mot de passe trop court", maxMessage="Mot de passe trop long")
     */
    private $password;

      /**
     * @Assert\Length(min=5, max=10, minMessage="Mot de passe trop court", maxMessage="Mot de passe trop long")
     * @Assert\EqualTo(propertyPath="password", message="Les mot de passes ne sont pas identiques")
     */
    private $password_confirm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->password_confirm;
    }

    public function setPasswordConfirm(string $password_confirm): self
    {
        $this->password_confirm = $password_confirm;

        return $this;
    }
}
