<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
include_once('C:\xampp\htdocs\AU_CODING_PLATFORM\Compiler_Scipts\class.Diff.php');
include_once('C:\xampp\htdocs\AU_CODING_PLATFORM\Compiler_Scipts\result.php');
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_POST['language'] != 'NONE') {
	$flag = 0;
	$Qid = $_SESSION['Qid'];
	$Username = $_SESSION['Username'];
	$_SESSION["code"] = urldecode($_POST["code"]);
	$_SESSION["lang"] = urldecode($_POST["language"]);
	if ($_POST['case'] == 1) {
		$input = urldecode($_POST['custom-input']);
		$inputFile = rand(10000, 99999) . '.txt';
		$Qtestcase = array(0, 0);
		$flag = 1;
	} else {
		if (intval($Qid)) {
			$QUERY = "SELECT * FROM " . " `" . TABLE::QUESTION_PROP_DB . "` " . " WHERE Qid= " . intval($Qid) . ';';
			$RESULT = mysqli_query($QDB_LINK, $QUERY);
			if ($RESULT and mysqli_num_rows($RESULT) > 0) {
				$row = mysqli_fetch_assoc($RESULT);
				$inputFile = array();
				$inputFile["samplecase"] = array();
				$inputFile["realcase"] = array();

				$outputFile = array();
				$outputFile["samplecase"] = array();
				$outputFile["realcase"] = array();

				foreach (glob($row["Qtestcase"] . "samplecase/input/*.txt") as $key => $file) {
					array_push($inputFile["samplecase"], $file);
				}
				foreach (glob($row["Qtestcase"] . "realcase/input/*.txt") as $key => $file) {
					array_push($inputFile["realcase"], $file);
				}
				foreach (glob($row["Qtestcase"] . "samplecase/output/*.txt") as $key => $file) {
					array_push($outputFile["samplecase"], $file);
				}
				foreach (glob($row["Qtestcase"] . "realcase/output/*.txt") as $key => $file) {
					array_push($outputFile["realcase"], $file);
				}

				$Qtestcase = [$inputFile, 1];
				$flag = 1;
			} else {
				$flag = 0;
			}
		}
	}
	if ($flag) {
		$language = urldecode($_POST['language']);
		$user_code = urldecode($_POST['code']);
		$folder = $Qid . '_' . $Username;
		$dir = 'C:/xampp/htdocs/AU_CODING_PLATFORM/Compiler_Scipts/processes/' . $folder . '/';
		if (!is_dir($dir)) {
			mkdir($dir);
		}
		$filename = $dir . 'main';
		if ($Qtestcase[0] == 0) {
			$inputFile = $dir . $inputFile;
			file_put_contents($inputFile, $input);
			$Qtestcase[0] = $inputFile;
		}
		switch ($language) {
			case 'CPP':
				$filename .= ".cpp";
				$result = CPP($user_code, $filename, $Qtestcase);
				break;
			case 'C':
				$filename .= ".c";
				$result = C($user_code, $filename, $Qtestcase);
				break;
			case 'PYTHON':
				$filename .= ".py";
				$result = PYTHON($user_code, $filename, $Qtestcase);
				break;
			case 'JAVA':
				$filename .= ".java";
				$result = JAVA($user_code, $filename, $Qtestcase);
				break;
		}
	}
	deleteFile($dir);

	if ($Qtestcase[1] == 1) {

		$testResult = testOutput($result, $outputFile);
		if ($testResult["passed"]) {
			if (!alreadyDone($Username, $Qid)) {
				tranferBadges_and_Points($Username, $Qid);
			}
			if (!storeCode($user_code, $Username, $Qid, $language)) {
				$testResult["upload"] = 'FAILED TO SAVE CODE!';
			}
		}
		echo (json_encode($testResult));
	} else {
		$result = array("result" => $result);
		echo (json_encode($result));
	}
}
?>

<?php

function trimOutput($msg)
{
	global $folder;
	$msg = str_replace('C:\xampp\htdocs\AU_CODING_PLATFORM\Compiler_Scipts\processes\\' . $folder . '\\', '', $msg);
	$msg = str_replace('C:/xampp/htdocs/AU_CODING_PLATFORM/Compiler_Scipts/processes/' . $folder . '/', '', $msg);
	return $msg;
}


function CPP($user_code, $filename, $Qtestcase)
{

	putenv("PATH=C:\MinGW\bin");
	file_put_contents($filename, $user_code);
	$errtextfile = substr($filename, 0, strlen($filename) - 4) . '.txt';
	$exefile = substr($filename, 0, strlen($filename) - 4) . '.exe';
	$command = "g++ " . $filename . " 2> " . $errtextfile . " -o " . $exefile;
	shell_exec($command);
	$err = trimOutput(file_get_contents($errtextfile));
	$result = array();
	if ($err == "") {
		if (is_array($Qtestcase[0])) {
			$result = array(
				"samplecase" => array(),
				"realcase" => array()
			);
			foreach ($Qtestcase[0]["samplecase"] as $key => $file) {
				array_push(
					$result["samplecase"],
					array(
						"input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec($exefile . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["samplecase"]);
					array_push(
						$result["samplecase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}

			foreach ($Qtestcase[0]["realcase"] as $key => $file) {
				array_push(
					$result["realcase"],
					array(
						// "input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec($exefile . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["realcase"]);
					array_push(
						$result["realcase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}
		} else {
			$result = array(
				"custominput" => array()
			);
			array_push(
				$result["custominput"],
				array(
					"input" => utf8_encode(file_get_contents($Qtestcase[0])),
					"status" => 1,
					"message" => trimOutput(shell_exec("$exefile  <  $Qtestcase[0] 2> $errtextfile"))
				)
			);
			$err = trimOutput(file_get_contents($errtextfile));
			if ($err) {
				array_pop($result["custominput"]);
				array_push(
					$result["custominput"],
					array(
						"status" => 0,
						"message" => $err
					)
				);
			}
		}
	} else {
		if (is_array($Qtestcase[0])) {
			$result["samplecase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
			$result["realcase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		} else {
			$result["custominput"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		}
	}
	return $result;
}

function C($user_code, $filename, $Qtestcase)
{

	putenv("PATH=C:\MinGW\bin");
	file_put_contents($filename, $user_code);
	$errtextfile = substr($filename, 0, strlen($filename) - 4) . '.txt';
	$exefile = substr($filename, 0, strlen($filename) - 4) . '.exe';
	$command = "gcc " . $filename . " 2> " . $errtextfile . " -o " . $exefile;
	shell_exec($command);
	$err = trimOutput(file_get_contents($errtextfile));
	$result = array();
	if ($err == "") {
		if (is_array($Qtestcase[0])) {
			$result = array(
				"samplecase" => array(),
				"realcase" => array()
			);
			foreach ($Qtestcase[0]["samplecase"] as $key => $file) {
				array_push(
					$result["samplecase"],
					array(
						"input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec($exefile . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["samplecase"]);
					array_push(
						$result["samplecase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}

			foreach ($Qtestcase[0]["realcase"] as $key => $file) {
				array_push(
					$result["realcase"],
					array(
						// "input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec($exefile . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["realcase"]);
					array_push(
						$result["realcase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}
		} else {
			$result = array(
				"custominput" => array()
			);
			array_push(
				$result["custominput"],
				array(
					"input" => utf8_encode(file_get_contents($Qtestcase[0])),
					"status" => 1,
					"message" => trimOutput(shell_exec("$exefile  <  $Qtestcase[0] 2> $errtextfile"))
				)
			);
			$err = trimOutput(file_get_contents($errtextfile));
			if ($err) {
				array_pop($result["custominput"]);
				array_push(
					$result["custominput"],
					array(
						"status" => 0,
						"message" => $err
					)
				);
			}
		}
	} else {
		if (is_array($Qtestcase[0])) {
			$result["samplecase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
			$result["realcase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		} else {
			$result["custominput"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		}
	}
	return $result;
}

function PYTHON($user_code, $filename, $Qtestcase)
{
	file_put_contents($filename, $user_code);
	$errtextfile = substr($filename, 0, strlen($filename) - 3) . '.txt';
	shell_exec("$filename 2> $errtextfile");
	$err = trimOutput(file_get_contents($errtextfile));
	$result = array();

	if (is_array($Qtestcase[0])) {
		$result = array(
			"samplecase" => array(),
			"realcase" => array()
		);
		foreach ($Qtestcase[0]["samplecase"] as $key => $file) {
			array_push(
				$result["samplecase"],
				array(
					"input" => utf8_encode(file_get_contents($file)),
					"status" => 1,
					"message" => trimOutput(shell_exec("$filename < " . '"' . $file . '"' . " 2> $errtextfile"))
				)
			);
			$err = trimOutput(file_get_contents($errtextfile));
			if ($err) {
				array_pop($result["samplecase"]);
				array_push(
					$result["samplecase"],
					array(
						"status" => 0,
						"message" => $err
					)
				);
				break;
			}
		}
		foreach ($Qtestcase[0]["realcase"] as $key => $file) {
			array_push(
				$result["realcase"],
				array(
					"input" => utf8_encode(file_get_contents($file)),
					"status" => 1,
					"message" => trimOutput(shell_exec("$filename < " . '"' . $file . '"' . " 2> $errtextfile"))
				)
			);
			$err = trimOutput(file_get_contents($errtextfile));
			if ($err) {
				array_pop($result["realcase"]);
				array_push(
					$result["realcase"],
					array(
						"status" => 0,
						"message" => $err
					)
				);
				break;
			}
		}
	} else {
		$result = array(
			"custominput" => array()
		);
		array_push(
			$result["custominput"],
			array(
				"input" => utf8_encode(file_get_contents($Qtestcase[0])),
				"status" => 1,
				"message" => trimOutput(shell_exec("$filename < $Qtestcase[0] 2> $errtextfile"))
			)
		);
		$err = trimOutput(file_get_contents($errtextfile));
		if ($err) {
			array_pop($result["custominput"]);
			array_push(
				$result["custominput"],
				array(
					"status" => 0,
					"message" => $err
				)
			);
		}
	}

	return $result;
}
function JAVA($user_code, $filename, $Qtestcase)
{
	file_put_contents($filename, $user_code);
	putenv("PATH=C:\Program Files\Java\jdk-11.0.11\bin");
	$errtextfile = substr($filename, 0, strlen($filename) - 5) . '.txt';
	$javaclassfile = substr($filename, 0, strlen($filename) - 5) . '';
	shell_exec("javac $filename 2> $errtextfile");
	$err = trimOutput(file_get_contents($errtextfile));
	$result = array();
	if ($err == "") {
		if (is_array($Qtestcase[0])) {
			$result = array(
				"samplecase" => array(),
				"realcase" => array()
			);
			foreach ($Qtestcase[0]["samplecase"] as $key => $file) {
				array_push(
					$result["samplecase"],
					array(
						"input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec("java $filename" . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["samplecase"]);
					array_push(
						$result["samplecase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}
			foreach ($Qtestcase[0]["realcase"] as $key => $file) {
				array_push(
					$result["realcase"],
					array(
						// "input" => utf8_encode(file_get_contents($file)),
						"status" => 1,
						"message" => trimOutput(shell_exec("java $filename" . " < " . '"' . $file . '"' . " 2> $errtextfile"))
					)
				);
				$err = trimOutput(file_get_contents($errtextfile));
				if ($err) {
					array_pop($result["realcase"]);
					array_push(
						$result["realcase"],
						array(
							"status" => 0,
							"message" => $err
						)
					);
					break;
				}
			}
		} else {
			$result = array(
				"custominput" => array()
			);
			array_push(
				$result["custominput"],
				array(
					"input" => utf8_encode(file_get_contents($Qtestcase[0])),
					"status" => 1,
					"message" => trimOutput(shell_exec("java $filename" . " < " . '"' . $Qtestcase[0] . '"' . " 2> $errtextfile"))
				)
			);
			$err = trimOutput(file_get_contents($errtextfile));
			if ($err) {
				array_pop($result["custominput"]);
				array_push(
					$result["custominput"],
					array(
						"status" => 0,
						"message" => $err
					)
				);
			}
		}
	} else {
		if (is_array($Qtestcase[0])) {
			$result["samplecase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
			$result["realcase"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		} else {
			$result["custominput"] = array(
				array(
					"status" => 0,
					"message" => $err
				)
			);
		}
	}
	return $result;
}
?>


<?php
function testOutput($result, $outputFile)
{
	$sCasePassed = 1;
	$rCasePassed = 1;
	$passed = 0;
	foreach ($outputFile["samplecase"] as $key1 => $file) {
		if ($result["samplecase"][$key1]["status"] == 1) {
			$s1 = file_get_contents($file);
			$s2 = $result["samplecase"][$key1]["message"];
			$diff = Diff::compare(utf8_encode($s1), utf8_encode($s2), true);
			$flag = 1;
			foreach ($diff as $key2 => $value) {
				if ($value[1] != 0) {
					$flag = 0;
					$sCasePassed = 0;
					break;
				}
			}
			$result["samplecase"][$key1]["codematch"] = $flag;
			$result["samplecase"][$key1]["expected"] =  utf8_encode($s1);
		} else {
			$result["samplecase"][$key1]["codematch"] = 0;
			$sCasePassed = 0;
			break;
		}
	}

	foreach ($outputFile["realcase"] as $key1 => $file) {
		if ($result["realcase"][$key1]["status"] == 1) {
			$s1 = file_get_contents($file);
			$s2 = $result["realcase"][$key1]["message"];
			$diff = Diff::compare(utf8_encode($s1), utf8_encode($s2), true);
			$flag = 1;
			foreach ($diff as $key2 => $value) {
				if ($value[1] != 0) {
					$flag = 0;
					$rCasePassed = 0;
					break;
				}
			}
			$result["realcase"][$key1]["codematch"] = $flag;
			// $result["realcase"][$key1]["expected"] =  utf8_encode($s1);
		} else {
			$result["realcase"][$key1]["codematch"] = 0;
			$rCasePassed = 0;
			break;
		}
	}
	if ($rCasePassed and $sCasePassed) {
		$passed = 1;
	}
	return array("result" => $result, "passed" => $passed);
}

?>