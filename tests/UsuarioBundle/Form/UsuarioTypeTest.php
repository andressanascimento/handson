<?php

namespace Tests\UsuarioBundle\Form\Type;

use UsuarioBundle\Form\UsuarioType;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Entity\Endereco;
use Symfony\Component\Form\Test\TypeTestCase;

class UsuarioTypeTest extends TypeTestCase {

    public function testSubmitValidData() {

        $endereco = new Endereco();
        $endereco->setCidade('Jacarei');
        $endereco->setEstado('SP');
        $endereco->setNumero('1111111');
        $endereco->setPostalCode('111111111');
        $endereco->setRua('Av. das flores');
        
        $formData = new Usuario();
        $formData->setEmail('testex@teste.com');
        $formData->setNome('Andressa');
        $formData->setPassword('123');
        $formData->setEndereco($endereco);
        

        $form = $this->factory->create(UsuarioType::class);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isValid());

    }

}
