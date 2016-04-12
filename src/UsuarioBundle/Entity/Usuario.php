<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UsuarioBundle\Entity\Endereco;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\UsuarioRepository")
 * @UniqueEntity("email")
 */
class Usuario {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = "2",max = "255", 
     * minMessage = "Your name must be at least {{ limit }} characters length",
     * maxMessage = "Your name cannot be longer than {{ limit }} characters length"
     * ) 
     */
    private $nome;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=40)
     * @Assert\NotBlank()
     * @Assert\Length(min = "2", max = "40",
     * minMessage = "Your password must be at least {{ limit }} characters length",
     * maxMessage = "Your password cannot be longer than {{ limit }} characters length"
     * )
     */

    private $password;

    /**

     * @ORM\ManyToOne(targetEntity="Endereco", inversedBy="usuarios", cascade={"persist"})
     * @ORM\JoinColumn(name="id_endereco", referencedColumnName="id")

     */
    protected $endereco;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Usuario
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }


}
