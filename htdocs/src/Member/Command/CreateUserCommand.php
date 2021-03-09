<?php

namespace App\Member\Command;

use App\Member\Factory\MemberFactory;
use App\Member\Model\MemberDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
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
        return [
            'firstname' => new Question("please enter the firstname:\n"),
            'lastname' => new Question("please enter the lastname:\n"),
            'email' => new Question("please enter an e-mail address:\n"),
            'password' => new Question("please enter the password:\n"),
            'passwordConfirmation' => new Question("please reenter the password:\n"),
        ];
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
                foreach ($validationErrors as $error) {
                    $output->writeln(sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage()));
                }
                return Command::FAILURE;
            }
            $this->factory->createMember($memberDto);
            $output->writeln('Member successfully created');
        } catch (ExceptionInterface $e) {
            $output->writeln('Error in input. Please try again');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}