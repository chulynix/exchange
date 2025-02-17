<?php
/**
 * Created by PhpStorm.
 * User: kalyan
 * Date: 12/18/15
 * Time: 5:04 PM
 */

namespace Admin\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class NewsFormType
 * @package Admin\NewsBundle\Form\Type
 */
class NewsFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'constraints' => array(new NotBlank()),
            ))
            ->add('text', TextareaType::class, array(
                'constraints' => array(new NotBlank()),
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\NewsBundle\Entity\News',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'news_form_type';
    }
}
