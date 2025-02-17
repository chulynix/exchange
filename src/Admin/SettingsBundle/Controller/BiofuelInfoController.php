<?php
/**
 * Created by PhpStorm.
 * User: kalyan
 * Date: 7/11/16
 * Time: 12:03 PM
 */

namespace Admin\SettingsBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BiofuelInfoController
 * @package Admin\SettingsBundle\Controller
 */
class BiofuelInfoController extends Controller
{
    /**
     * @param Request $request
     * @param null    $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/biofuel-info-settings/{id}", name="settings_biofuel_info")
     * @Template("AdminSettingsBundle:BiofuelInfo:biofuel_info.html.twig")
     */
    public function indexAction(Request $request, $id = null)
    {
        /** @var $em EntityManager */
        $em = $this->getDoctrine()->getManager();

        if ($id) {
            $settings = $em->getRepository('AdminSettingsBundle:BiofuelInfo')->find($id);
        } else {
            $settings = null;
        }

        $form = $this->createFormBuilder($settings)
            ->add('text', 'text')
            ->add('link', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $em->flush($data);

                $this->addFlash(
                    'success',
                    $this->get('translator')->trans('saved')
                );

                return $this->redirectToRoute('settings_biofuel_info');
            }
        }

        return array(
            'all_settings'  => $em->getRepository('AdminSettingsBundle:BiofuelInfo')->findAll(),
            'form'  => $form->createView(),
        );
    }
}
