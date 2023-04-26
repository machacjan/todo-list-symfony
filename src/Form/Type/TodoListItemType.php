<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\TodoListItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoListItemType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TodoListItem::class,
        ]);
    }


    /**
     * @param array<string,mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('checked', CheckboxType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'required' => false,
            ]);
    }

}
