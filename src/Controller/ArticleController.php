<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/articles", name="articles_list")
     */
    public function articleList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy(['isPublished' => true]);

        return $this->render('articleList.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function articleShow($id, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        return $this->render('articleShow.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/search", name="article_search")
     */
    public function search(ArticleRepository $articleRepository, Request $request)
    {
        $term = $request->query->get('q');

        $articles = $articleRepository->searchByTerm($term);

        return $this->render('articleSearch.html.twig', [
            'articles' => $articles,
            'term' => $term
        ]);
    }


}
