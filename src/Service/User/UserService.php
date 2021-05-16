<?php


namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Common\DateTimeServiceInterface;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method getDoctrine()
 */
class UserService implements UserServiceInterface
{

    private Security $security;
    private UserRepository $userRepository;
    private DateTimeServiceInterface $dateTimeService;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(Security $security,
                                UserRepository $userRepository,
                                DateTimeServiceInterface $dateTimeService,
                                UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->security = $security;
        $this->userRepository = $userRepository;
        $this->dateTimeService = $dateTimeService;
    }

    /**
     * @param string $email
     * @return object|User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return User
     * @throws ORMException
     */
    public function save(User $user): User
    {
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            )
        );

        $user->setCreatedAt($this->dateTimeService->setDateTimeNow());
        $user->setEditedAt($this->dateTimeService->setDateTimeNow());
        $user->setIsActive(true);
        $user->setIsDeleted(false);
        $user->setIsVerified(false);

        $this->userRepository->insert($user);
        return $user;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param User $user
     * @return object|User|null
     */
    public function findOne(User $user): ?User
    {
        return $this->userRepository->find($user);
    }

    /**
     * @return User|UserInterface|null
     */
    public function currentUser(): ?User
    {
        return $this->security->getUser();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }
}
