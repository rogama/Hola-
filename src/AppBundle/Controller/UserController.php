<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"PUT"})
     * @Security("has_role('ADMIN')")
     */
    public function newAction(Request $request)
    {
        $datas = $request->query;
        $user = new User();

        $user->setName($datas->get('name'));
        $user->setUsername($datas->get('username'));
        $user->setPassword($datas->get('password'));
        $user->setRoles($datas->get('roles'));

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $response = new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            $response = new JsonResponse(['success' => false, 'error' => $e->getMessage()]);
            $response->setStatusCode(500);
        }

        return $response;
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return new JsonResponse(['user' =>
            [
                'name' => $user->getName(),
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'roles' => serialize($user->getRoles()),
            ]
        ]);
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"POST"})
     * @Security("has_role('ADMIN')")
     */
    public function editAction(Request $request, User $user)
    {
        $datas = $request->query;

        $user->setName($datas->get('name'));
        $user->setUsername($datas->get('username'));
        $user->setPassword($datas->get('password'));
        $user->setRoles(serialize($datas->get('roles')));

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $response = new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            $response = new JsonResponse(['success' => false, 'error' => $e->getMessage()]);
            $response->setStatusCode(500);
        }

        return $response;
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     * @Security("has_role('ADMIN')")
     */
    public function deleteAction(Request $request, User $user)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $response = new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            $response = new JsonResponse(['success' => false, 'error' => $e->getMessage()]);
            $response->setStatusCode(500);
        }

        return $response;
    }
}
