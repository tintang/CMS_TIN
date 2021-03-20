<?php

namespace App\User\Command;

use App\User\Entity\Roles;
use App\User\Factory\MemberFactory;
use App\User\Model\MemberDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserCommand extends Command
{

    public static $defaultName = 'cms:create:user';

    private MemberFactory $factory;

    private DenormalizerInterface $denormalizer;

    private ValidatorInterface $validator;

    private EntityManagerInterface $entityManager;

    public function __construct(
        MemberFactory $factory,
        DenormalizerInterface $denormalizer,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    )
    {
        parent::__construct(self::$defaultName);
        $this->factory = $factory;
        $this->denormalizer = $denormalizer;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user')
            ->setHelp('Creates a new user that has access to the cms-backend');
    }

    private function getQuestions(): array
    {
        $userRolesQuestion = new ChoiceQuestion("Please select the user role\n", Roles::getUserRoles());
        $userRolesQuestion->setMultiselect(true);

        return [
            'firstname' => new Question("please enter the firstname:\n"),
            'lastname' => new Question("please enter the lastname:\n"),
            'email' => new Question("please enter an e-mail address:\n"),
            'password' => new Question("please enter the password:\n"),
            'passwordConfirmation' => new Question("please reenter the password:\n"),
            'userRoles' => $userRolesQuestion
        ];
    }

    private function getErrorMessage(ConstraintViolationListInterface $constraintViolationList): string
    {
        $result = '';
        foreach ($constraintViolationList as $error) {
            $result .= sprintf("%s: %s\n", $error->getPropertyPath(), $error->getMessage());
        }
        return $result;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $answers = [];

        foreach ($this->getQuestions() as $key => $question) {
            $answers[$key] = $helper->ask($input, $output, $question) ?? '';
        }

        try {
            /** @var MemberDto $memberDto */
            $memberDto = $this->denormalizer->denormalize($answers, MemberDto::class);
            $validationErrors = $this->validator->validate($memberDto);
            if (count($validationErrors) > 0) {
                $output->writeln($this->getErrorMessage($validationErrors));
                return Command::FAILURE;
            }
            $member = $this->factory->createMember($memberDto);
            $this->entityManager->persist($member);
            $this->entityManager->flush();
            $output->writeln('Member successfully created');
            return Command::SUCCESS;
        } catch (ExceptionInterface $e) {
            $output->writeln('Error in input. Please try again');
            return Command::FAILURE;
        }
    }
}