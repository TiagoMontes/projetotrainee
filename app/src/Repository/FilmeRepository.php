<?php
// Um repositório é um objeto que irá fazer a comunicação com o banco de dados, ele é responsável por fazer as consultas e salvar os dados no banco de forma organizada e padronizada.
// Poderiamos retirar o repository e fazer as consultas diretamente no controller, mas isso não é uma boa prática, pois o controller não deveria ter essa responsabilidade.

namespace App\Repository;

use App\Entity\Filme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Filme>
 *
 * @method Filme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filme|null findOneBy(array $criteria, array $orderBy = null) // faz tratamento para garantir que so tenha 1
 * @method Filme[]    findAll()
 * @method Filme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filme::class);
    }

    public function save(Filme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity); // getEntityManager é um metodo que irá pegar o entity manager, que é um objeto que irá gerenciar as entidades
        // persist significa que estamos persistindo a entidade, ou seja, estamos salvando ela no banco de dados

        if ($flush) {
            $this->getEntityManager()->flush(); // flush é um metodo que irá salvar no banco
        }
    }

    public function remove(Filme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Filme[] Returns an array of Filme objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Filme
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
