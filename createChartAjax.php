<?php

    $f1          = (int)trim(stripslashes($_REQUEST['f1']));
    $f2          = (int)trim(stripslashes($_REQUEST['f2']));

    $mid1        = (int)trim(stripslashes($_REQUEST['mid1']));
    $mid2        = (int)trim(stripslashes($_REQUEST['mid2']));

    $spectraType = (int)trim(stripslashes($_REQUEST['spectraType']));
    $nlType      = (int)trim(stripslashes($_REQUEST['nlType']));

    $sgd = new SpectraGraphData();

    // Process data using MIDs
    if ($mid1) {
        $db1  = new DB (HOST, USER, PASS, DB);
        $rsd1 = new ReadSpectraData($mid1, null, $db1, 0, $nlType);
        if ($spectraType == MS2_DATA) {
            $rsd1->processDBMS2Data();
        } else {
            $rsd1->processDBNLData();
        }
        $rsd1->sortData();
    }

    // Process data using a file
    if ($f1) {
        $rsd1 = new ReadSpectraData(0, $pathFileName1, null, 0, $nlType);

        if ($spectraType == MS2_DATA) {
            $rsd1->processFileMS2Data();
        } else {
            $rsd1->calcNL();
        }
        $rsd1->sortData();
    }

    // Process data using MIDs
    if ($mid2) {
        // $db2  = new DB();
        $db2  = new DB (HOST, USER, PASS, DB);
        $rsd2 = new ReadSpectraData($mid2, null, $db2, 1, $nlType);
        if ($spectraType == MS2_DATA) {
            $rsd2->processDBMS2Data();
        } else {
            $rsd2->processDBNLData();
        }
        $rsd2->sortData();
    }

    // Process data using a file
    if ($f2) {
        $rsd2 = new ReadSpectraData(0, $pathFileName2, null, 1, $nlType);

        if ($spectraType == MS2_DATA) {
            $rsd2->processFileMS2Data();
        } else {
            $rsd2->calcNL();
        }
        $rsd2->sortData();
    }

    $modeList = ["+"];
    $ceList   = [0, 10, 20, 40];

    if ($mid1 + $f1) {
    foreach ($modeList as $modeItem) {
        foreach ($ceList as $ceItem) {
            $seriesName = $rsd1->getCEName($modeItem, $ceItem);
            if (strlen($seriesName)) {
                $sgd->setSeries($seriesName, $seriesName."CMPD1", $rsd1->getSpectraData($modeItem, $ceItem, $spectraType));
            }
        }
    }
    }

    $modeList = ["+"];
    $ceList   = [0, 10, 20, 40];

    if ($mid2 + $f2) {
    foreach ($modeList as $modeItem) {
        foreach ($ceList as $ceItem) {
            $seriesName = $rsd2->getCEName($modeItem, $ceItem);
            if (strlen($seriesName)) {
                $sgd->setSeries($seriesName, $seriesName."CMPD2", $rsd2->getSpectraData($modeItem, $ceItem, $spectraType));
            }
        }
    }
    }

    $modeList = ["-"];
    $ceList   = [0, 10, 20, 40];

    if ($mid1 + $f1) {
    foreach ($modeList as $modeItem) {
        foreach ($ceList as $ceItem) {
            $seriesName = $rsd1->getCEName($modeItem, $ceItem);
            if (strlen($seriesName)) {
                $sgd->setSeries($seriesName, $seriesName."CMPD1", $rsd1->getSpectraData($modeItem, $ceItem, $spectraType));
            }
        }
    }
    }

    $modeList = ["-"];
    $ceList   = [0, 10, 20, 40];

    if ($mid2 + $f2) {
    foreach ($modeList as $modeItem) {
        foreach ($ceList as $ceItem) {
            $seriesName = $rsd2->getCEName($modeItem, $ceItem);
            if (strlen($seriesName)) {
                $sgd->setSeries($seriesName, $seriesName."CMPD2", $rsd2->getSpectraData($modeItem, $ceItem, $spectraType));
            }
        }
    }
    }

    $xMax = 0;


    if ($mid1 && $mid2) { 
        $xMax = ($rsd1->getMaxMass() >= $rsd2->getMaxMass()) ? $rsd1->getMaxMass() : $rsd2->getMaxMass();
    } else if ($mid1 && $f2) {
        $xMax = ($rsd1->getMaxMass() >= $rsd2->getMaxMass()) ? $rsd1->getMaxMass() : $rsd2->getMaxMass();
    } else if ($f1 && $m2) {
        $xMax = ($rsd1->getMaxMass() >= $rsd2->getMaxMass()) ? $rsd1->getMaxMass() : $rsd2->getMaxMass();
    } else if ($f1 && $f2) {
        $xMax = ($rsd1->getMaxMass() >= $rsd2->getMaxMass()) ? $rsd1->getMaxMass() : $rsd2->getMaxMass();
    } else if ($mid1 || $f1) {
        $xMax = $rsd1->getMaxMass();
    } else if ($mid2 || $f2) {
        $xMax = $rsd2->getMaxMass();
    }

    $sgd->setXAxisMax($xMax);

    if ($mid1 && $mid2) {
        $subTitle = $rsd1->getCompoundName()." (".$rsd1->getCompoundMass()." Da) vs. ".$rsd2->getCompoundName()." (".$rsd2->getCompoundMass()." Da)";
    } else if ($mid1 && $f2) {
        $subTitle = $rsd1->getCompoundName()." (".$rsd1->getCompoundMass()." Da) vs. ".$rsd2->getCompoundName()." (".$rsd2->getCompoundMass()." Da)";
    } else if ($f1 && $f2) {
        $subTitle = $rsd1->getCompoundName()." (".$rsd1->getCompoundMass()." Da) vs. ".$rsd2->getCompoundName()." (".$rsd2->getCompoundMass()." Da)";
    } else if ($f1 && $mid2) {
        $subTitle = $rsd1->getCompoundName()." (".$rsd1->getCompoundMass()." Da) vs. ".$rsd2->getCompoundName()." (".$rsd2->getCompoundMass()." Da)";
    } else if ($mid1 || $f1) {
        $subTitle = $rsd1->getCompoundName()." (".$rsd1->getCompoundMass()." Da)";
    } else if ($mid2 || $f2) {
        $subTitle = $rsd2->getCompoundName()." (".$rsd2->getCompoundMass()." Da)";
    }

    $sgd->setSubtitle($subTitle);

    echo $sgd->getJSON();

?>


