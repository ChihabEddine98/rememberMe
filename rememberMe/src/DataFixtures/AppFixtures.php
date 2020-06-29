<?php

namespace App\DataFixtures;

use App\Entity\Memo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->load_users($manager,5);
        $this->load_memos($manager,30,5);
    }

    function load_users(ObjectManager $manager,int $nb)
    {
        for ($i=1;$i<=$nb;$i++)
        {
            $user=new User();
            $user->setNom('Ouali')
                ->setPrenom('Ouss #'.$i)
                ->setEmail('user'.$i.'@gmail.com')
                ->setPassword($this->encoder->encodePassword($user,'ouss'))
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($user);
        }

        $manager->flush();
    }

    function load_memos(EntityManager $manager,int $nb,int $max_users)
    {
        $detail="Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
        Pourquoi l'utiliser?
        On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' vous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voire des phrases embarassantes).
        D'où vient-il?
        Contrairement à une opinion répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, \"Lorem ipsum dolor sit amet...\", proviennent de la section 1.10.32.";

        $users=$manager->getRepository(User::class)->findAll();

        for ($i=1;$i<=$nb;$i++)
        {
            $x=rand(0,$max_users-1);
            $auteur=$users[$x];
            $memo=new Memo();
            $memo->setTitre('Memo #'.$i)
                ->setDetail($detail.$i)
                ->setAuteur($auteur)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $manager->persist($memo);
        }

        $manager->flush();
    }
}
