<?php
/**
 * Created by PhpStorm.
 * User: oliver
 * Date: 03.08.17
 * Time: 22:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Event;
use AppBundle\Entity\EventInterface;
use AppBundle\Entity\Eventseries;
use AppBundle\Entity\Film;
use AppBundle\Entity\Party;
use AppBundle\Entity\Post;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FilmController
 * @package AppBundle\Controller
 */
class UptodateController extends ContentController
{
    /**
     * @Route("/aktuelles", name="uptodate_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $models = [Film::class, Party::class, Event::class];
        $entities = [];
        $order = [];
        foreach ($models as $model){
            /** @var EntityRepository $eventRepo */
            $eventRepo = $this->getDoctrine()->getManager()->getRepository($model);
            $queryBuilder = $eventRepo->createQueryBuilder('e');
            $queryBuilder
                ->select('e')
                ->where('e.doorsopen > :now')
                ->setParameter('now', new \DateTime('now'), Type::DATETIME);
            $nextEvents = $queryBuilder->getQuery()->getResult();

            $entities = array_merge($entities, $nextEvents);
            $order = [];
            /** @var EventInterface $content */
            foreach($nextEvents as $content){
                $order[] = $content->getDoorsopen();
            }
        }
        array_multisort($order, SORT_ASC, $entities);


        return $this->render('uptodate.html.twig', array_merge($this->getParams(), [
            'models' => $this->paginateContentByRequst($entities, $request),
            'active' => 'uptodate',
        ]));
    }
}