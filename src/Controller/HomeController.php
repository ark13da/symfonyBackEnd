<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home" ,methods={"GET"})
     */

    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }
    /**
     * @Route("/recipe/add", name="add_new_recipe" ,methods={"POST"})
     */

    public function addRecipe(): Response
    {
        //recipe/add?name=pancake&ingredients=flour,egg,milk

       // if($_GET["name"]!==null && $_GET["ingredients"]!==null){
        if(isset($_GET["name"]) && isset($_GET["ingredients"])){
            $newName=$_GET['name'];
            $newIngredeints=$_GET['ingredients'];
            $entityManager=$this->getDoctrine()->getManager();
            $newRecipe=new Recipe();
            $newRecipe->setName($newName);
            $newRecipe->setIngredients($newIngredeints);

            $entityManager->persist($newRecipe);
            $entityManager->flush();

            return new Response('Adding new recipe'. $newRecipe->getName());
        }else{
            return new Response('wanting to add new recipe');
        }
    }

    /**
     * @Route("/recipe/all", name="fetch_all_recipe",methods={"GET"})
     */

    public function getAllRecipe(): Response
    {
        $recipes=$this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $response=[];
        foreach($recipes as $recipe){
            $response[]=array(
                'name'=>$recipe->getName()
            );
        }
        return $this->json($response);
    }
}
