<?php
namespace App\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArticleController extends AbstractController{
    /**
     * @Route("/",name="article-list")
     * @Method({"GET"})
     */

    public function index(){
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll(); 
        return $this->render('articles/index.html.twig',array('articles'=>$articles));
    }


    
    /**
     * @Route("/article/new",name="new_article")
     * @Method({"GET","POST"})
     */

    public function new(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
        ->add('title',TextType::class,array('attr' => array('class'=>'form-control')))
        ->add('body',TextareaType::class,array('required' => false,'attr' => array('class'=>'form-control')))
        ->add('submit',SubmitType::class,array('label'=>'Submit','attr' => array('class'=>'btn btn-primary mt-3')))
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article-list');
        }

        return $this->render('articles/new.html.twig',array('form'=>$form->createView()));
    }
    


    /**
     * @Route("/article/edit/{id}",name="edit_article")
     * @Method({"GET","POST"})
     */

    public function edit(Request $request,$id){
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createFormBuilder($article)
        ->add('title',TextType::class,array('attr' => array('class'=>'form-control')))
        ->add('body',TextareaType::class,array('required' => false,'attr' => array('class'=>'form-control')))
        ->add('submit',SubmitType::class,array('label'=>'Update','attr' => array('class'=>'btn btn-primary mt-3')))
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('article-list');
        }

        return $this->render('articles/new.html.twig',array('form'=>$form->createView()));
    }
    



    /**
     * @Route("/article/{id}", name="article_show")
     */

    public function show($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig',array('article'=>$article));
    }

    /**
     * @Route("/article/delete/{id}")
     * @Method({"DELETE"})
     */

    public function delete($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();   
        return $this->redirectToRoute('article-list');
    
    }


    // /**
    //  * @Route("/article/save")
    //  */

    //  public function save(){
    //     $entityManager = $this->getDoctrine()->getManager();
        
    //     $article = new Article();
    //     $article->setTitle('Article 1');
    //     $article->setBody('this is the body of article 1');
        
    //     $entityManager->persist($article);

    //     $entityManager->flush();
    //     return new Response();
    //  }
}
?>