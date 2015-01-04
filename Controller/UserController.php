<?php
namespace Landmarx\Bundle\UserBundle\Controller;

class UserController extends \Landmarx\Bundle\CoreBundle\Controller\CoreController
{
    /**
     * Index action
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     */
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        // Create pager
        $pager = new \Pagerfanta\Pagerfanta(
            new \Pagerfanta\Adapter\DoctrineODMMongoDBAdapter(
                $this->getRepository()->findAll()
            )
        );
        
        // Configure pager
        $pager->setCurrentPage($request->get('page', 1), true, true);
        $pager->setMaxPerPage($this->getParameter('landmarx.user.per_page'));
        
        return $this-render(
            'LandmarxUserBundle:User:index.html.twig',
            array(
                'pager' => $pager,
                'results' => $pager->getCurrentPageResults(),
                'current' => $this->getCurrentCoordinates()
            )
        );
    }
    
    /**
     * New action
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $user = new \Landmarx\Bundle\UserBundle\Document\User();
        $form = $this-createForm(new \Landmarx\Bundle\UserBundle\Forms\Type\UserFormType(), $user);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($user);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'user added.'
                );

                return $this->render(
                    'LandmarxUserBundle:User:show.html.twig',
                    array('user' => $user)
                );
            }
        }
        
        return $this->render(
            'LandmarxUserBundle:User:new.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Search action
     * @param Request $request
     * @return response
     */
    public function searchAction(Request $request)
    {
        $form = new \Landmarx\Bundle\UserBundle\Forms\Type\UserSearchFormType();

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $pager = new \Pagerfanta(
                    new DoctrineODMMongoDBAdaptor(
                        $this->getRepository()
                            ->search(
                                $form["query"]->getData(),
                                $form["field"]->getData()
                            )
                    )
                );

                return $this->render(
                    'LandmarxUserBundle:User:index.html.twig',
                    array('pager' => $pager)
                );
            }

            return $this-render(
                'LandmarxUserBundle:User:search.html.twig',
                array('form' => $form->createView())
            );
        }
    }

    /**
     * Show action
     * @param Request $request
     * @return response
     */
    public function showAction(Request $request)
    {
        $user = $this->getRepository()
                ->findOneBySlug($request->getParameter('slug'));

        if (!$user) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching user found.'
            );
            $this->redirect($this->generateUrl('landmarx_user_index'));
        }

        return $this-render(
            'LandmarxUserBundle:User:show.html.twig',
            array('user' => $user)
        );
    }
}
