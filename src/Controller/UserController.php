<?php


namespace App\Controller;

use App\Entity\Password;
use App\Entity\User;
use App\Exceptions\ApiException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/user/register", methods={"POST"})
     */
    function register(Request $request){
//        debug_backtrace();
        $params = json_decode($request->getContent());
        $entityManager = $this->getDoctrine()->getManager();
//        $users = $repository->findAll();
//        var_dump($users);
//        exit;
        $user = $entityManager->getRepository(User::class)->findOneBy(['phoneNumber' => $params->mobile]);
        if (!empty($user)){
            throw new ApiException(
                "already has user",
                Response::HTTP_BAD_REQUEST,
                $params
            );

        }
        $nweUser = new User();
        $nweUser->setEmail($params->mail);
        $nweUser->setPassword($params->password);
        $nweUser->setPhoneNumber($params->mobile);
        $nweUser->setIsNewUser(false);
//        $entityManager->persist($nweUser);
//        $entityManager->flush();

        return $this->createResponse($params,[],[],Response::HTTP_OK);
//        return new Response('Omg ! My first page is already');
    }

    private function createResponse(
        $userRequest,
        array $errors,
        array $activityFeed,
        int $statusCode
    ): JsonResponse {
        $response = [
            'data' => $userRequest,
            'errors' => $errors,
            'activityFeed' => $activityFeed,
        ];

        return $this->json($response, $statusCode
//            ,
//            [
//                'Access-Control-Allow-Origin' => '*',
//                'Access-Control-Allow-Credentials' => 'true',
//                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
//                'Access-Control-Allow-Headers' => 'DNT, X-User-Token, Keep-Alive, User-Agent, X-Requested-With, If-Modified-Since, Cache-Control, Content-Type',
//                'Access-Control-Max-Age' => 1728000,
//                'Content-Type' => 'text/plain charset=UTF-8',
//                'Content-Length' => 0
//            ]
        );
    }
}