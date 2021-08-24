<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, MailerInterface $mailer): Response
    {
        $lastArticles = $articleRepository->findBy([], ['id' => 'DESC'], 2);
        $lastCategories = $categoryRepository->findBy([], ['id' => 'DESC'], 2);

        return $this->render('home.html.twig', [
            'lastArticles' => $lastArticles,
            'lastCategories' => $lastCategories
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(MailerInterface $mailer, Request $request): Response
    {
        $postRequest = $request->request;

        $firstName = $postRequest->get('firstName');
        $lastName = $postRequest->get('lastName');
        $email = $postRequest->get('email');
        $message = $postRequest->get('message');

        if ($firstName &&
            $lastName &&
            $email &&
            $message
        ) {
            $email = (new TemplatedEmail())
                ->from('contact.davidrobert@gmail.com')
                ->to('contact.davidrobert@gmail.com')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'contactEmail' => $email,
                    'message' => $message
                ])
            ;

            $mailer->send($email);
        }



        return $this->render('contact.html.twig');
    }

}
