<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Helpers\Interfaces\DeserializerHelperInterface;
use AppBundle\Helpers\Interfaces\JSONResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArticleController
{
    /**
     * @var JSONResponderInterface
     */
    private $responder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var DeserializerHelperInterface
     */
    private $deserializerHelper;

    /**
     * ArticleController constructor.
     * @param JSONResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     * @param DeserializerHelperInterface $deserializerHelper
     */
    public function __construct(
        JSONResponderInterface $responder,
        EntityManagerInterface $entityManager,
        DeserializerHelperInterface $deserializerHelper
    ) {
        $this->responder = $responder;
        $this->entityManager = $entityManager;
        $this->deserializerHelper = $deserializerHelper;
    }

    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function showAction(Article $article)
    {
        $article = new Article();
        $article->update(
            'Mon premier article',
            'Le contenu de mon article.'
        );

        return $this->responder->response($article);
    }

    /**
     * @Route(
     *     "/articles",
     *     name="article_create",
     *     methods={"POST"}
     * )
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $dto = $this->deserializerHelper->deserialize($request->getContent());

        if (is_null($dto)) {
            return new Response(
                '',
                Response::HTTP_BAD_REQUEST
            );
        }

        $article = new Article();
        $article->update(
            $dto->title,
            $dto->content
        );

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $this->responder->response(
            $article,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/articles", name="article_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        $data = $this->get('jms_serializer')->serialize($articles, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
