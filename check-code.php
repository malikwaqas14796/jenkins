<?php 
/**
* @author: Muhammad Waqas
* @datetime: 05-JUN-2023
* @description: File of Test cases to check code syntax, came case covention and code indenting
*/


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$filePath = $_POST['filePath'];
$fileContent = file_get_contents('/var/www/html/ncrm/views/crmViews/nayatelCrm/waqasCrm/check-code-syntax.php');
$fileName = '/var/www/html/ncrm/views/crmViews/nayatelCrm/waqasCrm/check-code-syntax.php';

/********************Test cases section starts here********************/
$caseOne = checkCodeSyntax($fileName);

if($caseOne[0]['responseCode'] === 1)
{
    $caseTwo = checkCamelCaseVariables($fileContent);

    if($caseTwo[0]['responseCode'] === 1)
    {
        $caseThree = checkCodeIndenting($fileContent);

        if($caseThree[0]['responseCode'] === 1)
        {
            echo json_encode (array(array('responseCode' => 1, 'responseMessage' => "All cases have successfully been passed!")));
        }

        else
        {
            $response = $caseThree[0]['responseMessage'];
            echo json_encode($caseThree);
        }
    }

    else
    {
        $response = $caseTwo[0]['responseMessage'];
        echo json_encode($caseTwo);
    }
}

else
{
    $response = $caseOne[0]['responseMessage'];
    echo json_encode($caseOne);
}
/********************Test cases section ends here********************/


/********************Test cases functions section starts here********************/

//Function to check Code syntax
function checkCodeSyntax($fileName)
{
    //executing shell command to check syntax
    $output = exec("php -l $fileName 2>&1");
    
    if(strpos($output, 'No syntax errors detected') !== false)
    {
        return array(array('responseCode' => 1, 'responseMessage' => $output));
    }

    else
    {
        return array(array('responseCode' => 0, 'responseMessage' => $output));
    }
}


//Function to check camel case convention
function checkCamelCaseVariables($code)
{
    // Regular expression to match camel case variable names
    $pattern = '/\$(\w+([A-Z][a-z0-9]+)*)/';

    // Find all variable names in the code
    preg_match_all($pattern, $code, $matches);

    // Check if all variable names are camel cased
    foreach ($matches[1] as $variable)
    {
        if (!preg_match('/^[a-z][a-zA-Z0-9]*$/', $variable) && strpos('$'.$variable, '$_') === false)
        {
            echo $variable;
            return array(array('responseCode' => 0, 'responseMessage' => "Use camel case convention for variables."));
        }
    }

    return array(array('responseCode' => 1, 'responseMessage' => "Proper Covention has been followed."));
}


//Function to check the indenting of PHP code
function checkCodeIndenting($code)
{
    $errorMessage = '';

    //loop index
    $index = 0;
    // Split the code into lines
    $lines = explode("\n", $code);

    // Variable to store the expected indent level
    $expectedSpaces = 0;

    // Variable to track any indenting errors
    $errorIndicator = false;

    foreach ($lines as $line) 
    {
        //loop index increment
        $index += 1;
        
        // Skip empty lines
        if (trim($line) === '') 
        {
            continue;
        }

        // Count the number of spaces at the beginning of the line
        $indentLevel = strlen($line) - strlen(ltrim($line));

        if ($indentLevel != $expectedSpaces)
        {
            if (strpos($line, '}') === false)
            {
                $errorMessage .= "<br>Indent error on line " . ($index) . ": Expected spaces level $expectedSpaces, got $indentLevel spaces";
                // echo "Indent error on line " . ($index) . ": Expected indent level $expectedSpaces, got $indentLevel<br>";

                $errorIndicator = true;
            }    
        }

        // Update the expected spaces level for the next line
        if (strpos($line, '{') !== false && strlen(trim($line)) == 1)
        {
            $expectedSpaces += 4;
        } 
        
        elseif (strpos($line, '}') !== false && strlen(trim($line)) == 1)
        {
            $expectedSpaces -= 4;
        }
    }

    // If no errors were found, print success message
    if (!$errorIndicator)
    {
        return array(array('responseCode' => 1, 'responseMessage' => $errorMessage));
    }

    else
    {
        return array(array('responseCode' => 0, 'responseMessage' => $errorMessage));
    }
}

/********************Test cases functions section ends here********************/


/**
* END OF LIFE
*/
