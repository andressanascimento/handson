<?php

namespace UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco")
 * @ORM\Entity(repositoryClass="UsuarioBundle\Repository\EnderecoRepository")
 */
class Endereco {

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
     * @ORM\Column(name="rua", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Your street must be at least {{ limit }} characters length",
     *      maxMessage = "Your street cannot be longer than {{ limit }} characters length"
     * )
     */
    private $rua;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "1",
     *      max = "8",
     *      minMessage = "Your number must be at least {{ limit }} characters length",
     *      maxMessage = "Your number cannot be longer than {{ limit }} characters length"
     * )
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "8",
     *      max = "20",
     *      minMessage = "Your postal code must be at least {{ limit }} characters length",
     *      maxMessage = "Your postal code cannot be longer than {{ limit }} characters length"
     * )
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "8",
     *      max = "20",
     *      minMessage = "Your city must be at least {{ limit }} characters length",
     *      maxMessage = "Your city cannot be longer than {{ limit }} characters length"
     * )
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "60",
     *      minMessage = "Your state must be at least {{ limit }} characters length",
     *      maxMessage = "Your state cannot be longer than {{ limit }} characters length"
     * )
     */
    private $estado;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set rua
     *
     * @param string $rua
     *
     * @return Endereco
     */
    public function setRua($rua) {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get rua
     *
     * @return string
     */
    public function getRua() {
        return $this->rua;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Endereco
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Endereco
     */
    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode() {
        return $this->postalCode;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     *
     * @return Endereco
     */
    public function setCidade($cidade) {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade() {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Endereco
     */
    public function setEstado($estado) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado() {
        return $this->estado;
    }

}
