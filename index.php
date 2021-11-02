<!-- 
  Spell Check Starter
  This start code creates two arrays
  1: dictionary: an array containing all of the words from "dictionary.txt"
  2: aliceWords: an array containing all of the words from "AliceInWonderLand.txt"
 -->

<?php

set_time_limit(600);



function fileToArray($file)
{
  // Read file as a string
  $fileRef = fopen($file, "r");
  $textData = fread($fileRef, filesize($file));
  fclose($fileRef);

  // Split text by one or more whitespace characters
  return preg_split('/\s+/', $textData);
}

// Load data files into arrays 
$dictionary = fileToArray("data-files/dictionary.txt");
$aliceWords = fileToArray("data-files/AliceInWonderLand.txt");

// Print first 50 values of each array to verify contents
// echo "***DICTIONARY***<br>";
// print_r(array_slice($dictionary, 0, 50));
// echo "***ALICEWORDS***<br>";
// print_r(array_slice($aliceWords, 0, 50));

function binarySearch($anArray, $item)
{
  $li = 0;
  $ui = count($anArray) - 1;

  while ($li <= $ui) {
    $mi = floor(($li + $ui) / 2);

    if ($item == $anArray[$mi]) {
      return $mi;
    } else if ($item < $anArray[$mi]) {
      $ui = $mi - 1;
    } else {
      $li = $mi + 1;
    }
  }
  return -1;
}


function linearSearch($anArray, $item)
{
  for ($i = 0; $i < count($anArray); $i++) {
    if ($anArray[$i] == $item) {
      return $i;
    }
  }
  return -1;
}



// Page loaded on Form Submit
if (isset($_POST['submit'])) {
  $wordIn = strtolower($_POST['wordIn']);
  $option = $_POST["menuOption"];
  // dictionary search
  if ($option == "wordLinear") {
    // Starting clock time in seconds
    $start_time = microtime(true);
    echo "Linear search of " . $_POST["wordIn"] . " in dictionary..." . '<br>';
    echo $_POST['wordIn'] . ' found on line ' . linearSearch($dictionary, strtolower($wordIn)) . ' of dictionary';
    // End clock time in seconds
    $end_time = microtime(true);
    // Calculate script execution time
    $execution_time = ($end_time - $start_time);
    echo " (" . number_format($execution_time, 10) . " seconds) ";
  } elseif ($option == "wordBinary") {
    // Starting clock time in seconds
    $start_time = microtime(true);
    echo "Binary search of " . $_POST["wordIn"] . " in dictionary..." . '<br>';
    echo $_POST['wordIn'] . ' found on line ' . binarySearch($dictionary, strtolower($wordIn)) . ' of dictionary';
    // End clock time in seconds
    $end_time = microtime(true);
    // Calculate script execution time
    $execution_time = ($end_time - $start_time);
    echo " (" . number_format($execution_time, 10) . " seconds) ";
  }
}


if (isset($_POST['submitAlice'])) {
  $wordsNotFound = 0;
  $optionAlice = $_POST["aliceOptions"];
  if ($optionAlice == 'aliceLinear') {
    // Starting clock time in seconds
    $start_time = microtime(true);
    for ($i = 0; $i < count($aliceWords); $i++) {
      $result = linearSearch($dictionary, strtolower($aliceWords[$i]));
      if ($result == -1) {
        $wordsNotFound++;
      }
    }
    echo $wordsNotFound;
    // End clock time in seconds
    $end_time = microtime(true);
    // Calculate script execution time
    $execution_time = ($end_time - $start_time);
    echo " (" . number_format($execution_time, 10) . " seconds) ";
  } else if ($optionAlice == 'aliceBinary') {
    // Starting clock time in seconds
    $start_time = microtime(true);
    for ($i = 0; $i < count($aliceWords); $i++) {
      $result = binarySearch($dictionary, strtolower($aliceWords[$i]));
      if ($result == -1) {
        $wordsNotFound++;
      }
    }
    echo $wordsNotFound;
    // End clock time in seconds
    $end_time = microtime(true);
    // Calculate script execution time
    $execution_time = ($end_time - $start_time);
    echo " (" . number_format($execution_time, 10) . " seconds) ";
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Spell Check</title>
</head>

<body>
  <h1>Spell Check</h1>

  <form method="POST">
    <select name="menuOption">
      <option value="wordLinear">Check Word Linear</option>
      <option value="wordBinary">Check Word Binary</option>
    </select>
    <p>Word: <input name="wordIn" type="text"></p>
    <p><input type="submit" name="submit" value="Search"></p>
  </form>
  <br>
  <form method="POST">
    <select name="aliceOptions">
      <option value="aliceLinear">Check Alice Linear</option>
      <option value="aliceBinary">Check Alice Binary</option>

    </select>
    <p><input type="submit" name="submitAlice" value="Spellcheck Alice in Wonderland"></p>
  </form>

 



</body>



</html>


