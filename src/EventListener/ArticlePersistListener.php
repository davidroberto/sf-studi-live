<?php


namespace App\EventListener;

use App\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ArticlePersistListener
{

    /**
     * Méthode qui sera appelée automatiquement à l'enregistrement d'un article
     * grâce à un événement Doctrine
     *
     * @param Article $article
     * @param LifecycleEventArgs $eventArgs
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function preUpdate(Article $article, LifecycleEventArgs $eventArgs): void
    {
        $article->setUpdatedAt(new \DateTime('NOW'));
    }

}
