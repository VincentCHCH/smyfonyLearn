<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/aa")
     */
    function homepage(){
        return new Response('Omg ! My first page is sfsfsalready');
    }

//    /**
//     * @\Symfony\Component\Routing\Annotation\Route("/news/{slug}")
//     */
//    function show($slug) {
////        return new Response(sprintf('fsfsifwsfs : %s',$slug));
//
//        $number = random_int(0, 100);
//        return $this->render('lucky/number.html.twig', [
//            'number' => $number,
//        ]);
//    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"GET"})
     */
    public function toggleArticleHeart($slug,LoggerInterface $logger)
    {
        $logger->info("test logger api---");
        return new JsonResponse(['heart'=> rand(5,100)]);
    }

    /**
     * @Route("/blog/{page<\d+>?1}", name="blog_list")
     */
    public function list($page = 1)
    {
        // ...
        return new JsonResponse($page);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug)
    {

    }

}