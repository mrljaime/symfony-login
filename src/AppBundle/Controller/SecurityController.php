<?php
/**
 * Created by PhpStorm.
 * User: jaime
 * Date: 24/09/17
 * Time: 19:45
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 * @Route("/project")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login.login")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        /**
         * @var AuthenticationUtils $authenticationUtils
         */
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUser = $authenticationUtils->getLastUsername();
        $data = array(
            "username"  => $lastUser,
            "error"     => $error,
        );

        return $this->render("AppBundle::login.html.twig", $data);
    }

    /**
     * @Route("/checkLogin", name="login.check")
     * @Route("POST")
     *
     * @throws \Exception
     */
    public function checkLoginAction()
    {
        $this->get("logger")->critical("Firewall it's not been configured as expected");
        throw new \Exception("Error", 500);
    }

    /**
     * @Route("/logout", name="login.logout")
     * @Method("POST")
     *
     * @throws \Exception
     */
    public function logoutAction()
    {
        $this->get("logger")->critical("Firewall it's not been configured as expected");
        throw new \Exception("Error", 500);
    }

    /**
     * @Route("/register", name="login.register")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add("username", TextType::class, [
                "label" => "Nombre de usuario",
                "attr"  => [
                    "class" => "form-control",
                ],
            ])
            ->add("email", EmailType::class, [
                "label" => "Email",
                "attr"  => [
                    "class" => "form-control",
                ],
            ])
            ->add("password", PasswordType::class, [
                "label" => "Contraseña",
                "attr"  => [
                    "class"     => "form-control",
                    "required"  => true
                ],
            ])
            ->add("save", SubmitType::class, [
                "label" => "Crear usuario",
                "attr"  => [
                    "class" => "btn btn-primary btn-block",
                    "style" => "margin-top: 20px;",
                ],
            ])
            ->getForm();

        if ("post" == strtolower($request->getMethod())) {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //TODO: Verify if username or email are not present yet in database
                $encoder = $this->get("security.password_encoder");
                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
                $em->persist($user);
                $em->flush();

                $this->redirectToRoute("login.login");
            }
        }


        return $this->render("AppBundle::register.html.twig", [
            "form"  => $form->createView()
        ]);
    }
}