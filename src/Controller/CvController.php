<?php

namespace App\Controller;

use App\Entity\CV;
use App\Form\CvType;
use App\Repository\CVRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cv")
 */
class CvController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/list", name="cv-list")
     */
    public function index(CVRepository $cVRepository): Response
    {
        $cvs = $cVRepository->findBy(['user' => $this->getUser()]);

        return $this->render('cv/index.html.twig', [
            'cvs' => $cvs
        ]);
    }

    /**
     * @Route("/view/{id}", name="cv-view")
     */
    public function view(CV $cv)
    {
        $pattern = $cv->getPattern()->getId();
        
        return $this->render('cv/pattern.'. $pattern . '.html.twig', [
            'cv' => $cv
        ]);
    }

    /**
     * @Route("/create", name="cv-create")
     */
    public function create(Request $request): Response
    {
        $newCv = new CV();

        $form = $this->createForm(CvType::class, $newCv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Set User
            if (!null == $this->getUser()) {
                $newCv->setUser($this->getUser());
            }

            //Set Image
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo "L'image n'a pas été chargée";
                }
                $newCv->setImage($newFilename);
            }

            //Education
            $educations = $form->get('education')->getData();
            foreach ($educations as $education) {
                $newCv->addEducation($education);
                $education->setCV($newCv);
            }

            //Skills
            $skills = $form->get('skills')->getData();
            foreach ($skills as $skill) {
                $newCv->addSkill($skill);
            }

            //Interests
            $interests = $form->get('interests')->getData();
            foreach ($interests as $interest) {
                $newCv->addInterest($interest);
            }

            //XP
            $experiences = $form->get('experience')->getData();
            foreach ($experiences as $experience) {
                $newCv->addExperience($experience);
            }

            $this->em->persist($newCv);
            $this->em->flush();

            return $this->redirectToRoute('cv-list');
        }

        return $this->render('cv/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="cv-update", methods={"GET","POST"})
     */
    public function update(Request $request, CV $cv)
    {
        if (null === $cv) {
            throw $this->createNotFoundException('CV non trouvé');
        }

        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Set Image
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo "L'image n'a pas été chargée";
                }
                $cv->setImage($newFilename);
            }

            //Education
            $educations = $form->get('education')->getData();
            foreach ($educations as $education) {
                $cv->addEducation($education);
                $education->setCV($cv);
            }

            //Skills
            $skills = $form->get('skills')->getData();
            foreach ($skills as $skill) {
                $cv->addSkill($skill);
            }

            //Interests
            $interests = $form->get('interests')->getData();
            foreach ($interests as $interest) {
                $cv->addInterest($interest);
            }

            //XP
            $experiences = $form->get('experience')->getData();
            foreach ($experiences as $experience) {
                $cv->addExperience($experience);
            }
         
                $this->em->persist($cv);
                $this->em->flush();
                $this->addFlash('success', 'Le CV a bien été mis à jour !');

            return $this->redirectToRoute('cv-view', [
                'id' => $cv->getId()
            ]);
        }

        return $this->render('cv/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="cv-delete", methods={"GET","POST"})
     */
    public function delete(CV $cv)
    {
        if (!null == $cv->getImage()) {
            $fileSystem = new Filesystem();
            $dir = $this->getParameter('images_directory');
            $photoName = $cv->getImage();
            $fileSystem->remove($dir . '/' . $photoName);
        }

        $this->em->remove($cv);
        $this->em->flush();

        $this->addFlash('success', 'Le CV a bien été supprimé');

        return $this->redirectToRoute('cv-list');
    }
}
