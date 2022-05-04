<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/post", name="app_api_post",methods={"GET"})
     */
    public function index(PostRepository $postRepo ) 
    {
        $data=$postRepo->findAll();
        return $this->json($data,200);

    }

     /**
     * @Route("/api/post",methods={"POST"})
     */
    public function store(Request $request , SerializerInterface $serializerInterface,EntityManagerInterface $ent, ValidatorInterface $validator ) 
    {
        $requetsdata=$request->getContent();
        try{
            $post=$serializerInterface->deserialize($requetsdata,Post::class,'json');
            $errors = $validator->validate($post);
            
    if (count($errors) > 0) {
        return $this->json(["error"=>$errors,"status"=>400]);

    }
            $ent->persist($post);
            $ent->flush();
            return $this->json($post,200);
        }catch(NotEncodableValueException $e ){
            return $this->json(["Satue"=>400,"error"=>$e->getMessage()]);
        }
   

    }

    /**
     * @Route("/api/post/get/{id}",methods={"GET"})
     */
    public function getone(PostRepository $postRepo,$id ) 
    {
        $data=$postRepo->findBy(["id"=>$id]);
        return $this->json($data,200);

    }

 /**
     * @Route("/api/post/delete/{id}",methods={"DELETE"})
     */
    public function update(EntityManagerInterface $ent , int $id , PostRepository $postRepo)
    {
        $product = $ent->getRepository(Post::class)->find($id);
        $ent->remove($product);
        $ent->flush();
        return $this->json("ok",200);
    }

}
