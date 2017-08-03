<?php
/**
 * Created by PhpStorm.
 * User: oliver
 * Date: 03.08.17
 * Time: 22:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Eventseries;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FilmController
 * @package AppBundle\Controller
 * @Route("uptodate")
 */
class UptodateController extends Controller
{
    /**
     * @Route("/", name="uptodate_index")
     * @Method("GET")
     */
    public function indexAction()
    {



        $models = ['Film', 'Party', 'Event'];
        $entities = [];
        foreach ($models as $model){
            /** @var EntityRepository $eventRepo */
            $eventRepo = $this->getDoctrine()->getManager()->getRepository('AppBundle:' . $model);
            $queryBuilder = $eventRepo->createQueryBuilder('e');
            $queryBuilder
                ->select('e')
                ->where('e.doorsopen > :now')
                ->setParameter('now', new \DateTime('now'), Type::DATETIME);

            $nextEvents = $queryBuilder->getQuery()->getResult();


            $entities = array_merge($entities, $nextEvents);
            /** @var ContentInterface $content */
            foreach($nextEvents as $content){
                $order[] = $content->getDoorsopen();
            }
        }
        array_multisort($order, SORT_ASC, $entities);


        return $this->render('uptodate.html.twig', [
            'models' => $entities,
            'active' => 'uptodate',
            'eventseriesNav' => $this->getDoctrine()->getManager()->getRepository(Eventseries::class)->findAll()
        ]);
    }
}