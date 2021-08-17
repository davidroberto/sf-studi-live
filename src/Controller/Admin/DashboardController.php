<?php


namespace App\Controller\Admin;


use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function dashboard(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $lastArticles = $articleRepository->findBy([], ['id' => 'DESC'], 2);
        $lastCategories = $categoryRepository->findBy([], ['id' => 'DESC'], 2);

        return $this->render('admin/dashboard.html.twig', [
            'lastArticles' => $lastArticles,
            'lastCategories' => $lastCategories
        ]);
    }

}
