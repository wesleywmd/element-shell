# Shell Element
Library for running shell commands.

## How to install the library

Install the library with composer

    composer install wesleywmd/element-shell

## How to create a command

Create a simple command with just a string.

    $command = $commandFactory->create("ls -al");
     
Commands can have arguments. Add them via the factory.

    $command = $commandFactory->create("ls", ["-al"]);

Or separate method.

    $command = $commandFactory->create("ls");
    $command->addArgument("-al");
     
You can define more than one argument with an array.

    $command = $commandFactory->create("ls", ["-a", "-l"]);

or 

    $command = $commandFactory->create("ls");
    $command->addArguments(["-a", "-l"]);

## How to get a result object from the cli

Once you have created you command, the next step is to run the command.

    $result = $cli->execute($command);
     
Using the `execute()` method runs your command and then returns a result object. What happens if
we want to be able to interact with our command? Then we need to you the `interact()` method. This
will attach stdin and stdout to the process running the command. 

    $result = $cli->interact($command);
    
If you want to specify the directory to be in when running the command, specify it as the second
parameter. 

    $result = $cli->execute($command, "~/path/to/use");

## How to use the result object

You get a result object as the return from either the `execute()` or `interact()`. Your are able to
get a lot of information about the command. 

    $result->getOriginalCommand();
    $result->getOriginalCwd();
    $result->getResponse();
    $result->getExitCode();
    $result->getStdErr();
    $result->getExecutionTime();
