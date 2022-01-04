<?php

class ReadSpectraData {

    private $mid;
    private $pathFileName;
    private $compoundName;
    private $compoundMass;

    private $dbHandle;
    private $maxMass;
    private $maxMS2Mass;
    private $maxNLMass;

    private $reverse;
    private $nlType;

    private $ce0PosName;
    private $ce10PosName;
    private $ce20PosName;
    private $ce40PosName;

    private $ce0NegName;
    private $ce10NegName;
    private $ce20NegName;
    private $ce40NegName;

    private $ce0MS2PosData;
    private $ce10MS2PosData;
    private $ce20MS2PosData;
    private $ce40MS2PosData;

    private $ce0MS2NegData;
    private $ce10MS2NegData;
    private $ce20MS2NegData;
    private $ce40MS2NegData;

    private $ce0NLPosData;
    private $ce10NLPosData;
    private $ce20NLPosData;
    private $ce40NLPosData;

    private $ce0NLNegData;
    private $ce10NLNegData;
    private $ce20NLNegData;
    private $ce40NLNegData;


    function __construct($mid = 0, $pathFileName = null, $dbHandle = null, $reverse = 0, $nlType = 1) {
        $this->pathFileName = $pathFileName;

        $this->dbHandle = $dbHandle;
        $this->mid      = $mid;
        $this->reverse  = $reverse;
        $this->nlType   = $nlType;

        $this->ce0PosName   = null;
        $this->ce10PosName  = null;
        $this->ce20PosName  = null;
        $this->ce40PosName  = null;

        $this->ce0NegName   = null;
        $this->ce10NegName  = null;
        $this->ce20NegName  = null;
        $this->ce40NegName  = null;

        $this->ce0MS2PosData   = null;
        $this->ce10MS2PosData  = null;
        $this->ce20MS2PosData  = null;
        $this->ce40MS2PosData  = null;

        $this->ce0MS2NegData   = null;
        $this->ce10MS2NegData  = null;
        $this->ce20MS2NegData  = null;
        $this->ce40MS2NegData  = null;
        $this->maxMS2Mass      = 0;

        $this->ce0NLPosData  = null;
        $this->ce10NLPosData = null;
        $this->ce20NLPosData = null;
        $this->ce40NLPosData = null;

        $this->ce0NLNegData  = null;
        $this->ce10NLNegData = null;
        $this->ce20NLNegData = null;
        $this->ce40NLNegData = null;
        $this->maxMS2Mass    = 0;
        $this->maxNLMass     = 0;
        $this->maxMass       = 0;
    }


    function __destruct() {
    }

    #
    # Setters
    #

    function setPathFileName($val) {
        $this->pathFileName = $val;
    }


    function setCompoundName($val) {
        $this->compoundName = $val;
    }


    function setCompoundMass($val) {
        $this->compoundMass = $val;
    }


    function setMaxMass($val) {
        $this->maxMass = $val;
    }


    function setCEName($mode, $ce, $val) {
        switch ($mode) {
            case "-":
                switch ($ce) {
                    case 0:
                        $this->ce0PosName = $val;
                        break;
                    case 10:
                        $this->ce10PosName = $val;
                        break;
                    case 20:
                        $this->ce20PosName = $val;
                        break;
                    case 40:
                        $this->ce40PosName = $val;
                        break;
                }
                break;
            case "+":
                switch ($ce) {
                    case 0:
                        $this->ce0NegName = $val;
                        break;
                    case 10:
                        $this->ce10NegName = $val;
                        break;
                    case 20:
                        $this->ce20NegName = $val;
                        break;
                    case 40:
                        $this->ce40NegName = $val;
                        break;
                }
                break;
        }
    }


    function setSpectraData($mode, $ce, $mass, $intensity, $dataType) {
        switch ($mode) {
            case "-":
                switch ($ce) {
                    case 0:
                        if ($dataType == MS2_DATA) {
                            $this->ce0MS2PosData[] = array($mass, $intensity);
                        } else {
                            $this->ce0NLPosData[]  = array($mass, $intensity);
                        }
                        break;
                    case 10:
                        if ($dataType == MS2_DATA) {
                            $this->ce10MS2PosData[] = array($mass, $intensity);
                        } else {
                            $this->ce10NLPosData[]  = array($mass, $intensity);
                        }
                        break;
                    case 20:
                        if ($dataType == MS2_DATA) {
                            $this->ce20MS2PosData[] = array($mass, $intensity);
                        } else {
                            $this->ce20NLPosData[]  = array($mass, $intensity);
                        }
                        break;
                    case 40:
                        if ($dataType == MS2_DATA) {
                            $this->ce40MS2PosData[] = array($mass, $intensity);
                        } else {
                            $this->ce40NLPosData[]  = array($mass, $intensity);
                        }
                        break;
                }
                break;

            case "+":
                switch ($ce) {
                    case 0:
                        if ($dataType == MS2_DATA) {
                            $this->ce0MS2NegData[] = array($mass, $intensity);
                        } else {
                            $this->ce0NLNegData[]  = array($mass, $intensity);
                        }
                        break;
                    case 10:
                        if ($dataType == MS2_DATA) {
                            $this->ce10MS2NegData[] = array($mass, $intensity);
                        } else {
                            $this->ce10NLNegData[]  = array($mass, $intensity);
                        }
                        break;
                    case 20:
                        if ($dataType == MS2_DATA) {
                            $this->ce20MS2NegData[] = array($mass, $intensity);
                        } else {
                            $this->ce20NLNegData[]  = array($mass, $intensity);
                        }
                        break;
                    case 40:
                        if ($dataType == MS2_DATA) {
                            $this->ce40MS2NegData[] = array($mass, $intensity);
                        } else {
                            $this->ce40NLNegData[]  = array($mass, $intensity);
                        }
                        break;
                }
                break;
        }
    }

    #
    # Getters
    #

    function getPathFileName() {
        return $this->pathFileName;
    }


    function getCompoundName() {
        return $this->compoundName;
    }


    function getCompoundMass() {
        // return $this->compoundMass;
        return round($this->compoundMass, 3);
    }


    function getMaxMass() {
        return $this->maxMass;
    }


    function getCEName($mode, $ce) {
        switch ($mode) {
            case "-":
                switch ($ce) {
                    case 0:
                        return $this->ce0PosName;
                    case 10:
                        return $this->ce10PosName;
                    case 20:
                        return $this->ce20PosName;
                    case 40:
                        return $this->ce40PosName;
                }
                break;
            case "+":
                switch ($ce) {
                    case 0:
                        return $this->ce0NegName;
                    case 10:
                        return $this->ce10NegName;
                    case 20:
                        return $this->ce20NegName;
                    case 40:
                        return $this->ce40NegName;
                }
                break;
        }
    }


    function getSpectraData($mode, $ce, $dataType) {
        switch ($mode) {
            case "-":
                switch ($ce) {
                    case 0:
                        return (($dataType == MS2_DATA) ? $this->ce0MS2PosData : $this->ce0NLPosData);
                    case 10:
                        return (($dataType == MS2_DATA) ? $this->ce10MS2PosData : $this->ce10NLPosData);
                    case 20:
                        return (($dataType == MS2_DATA) ? $this->ce20MS2PosData : $this->ce20NLPosData);
                    case 40:
                        return (($dataType == MS2_DATA) ? $this->ce40MS2PosData : $this->ce40NLPosData);
                }
                break;

            case "+":
                switch ($ce) {
                    case 0:
                        return (($dataType == MS2_DATA) ? $this->ce0MS2NegData : $this->ce0NLNegData);
                    case 10:
                        return (($dataType == MS2_DATA) ? $this->ce10MS2NegData : $this->ce10NLNegData);
                    case 20:
                        return (($dataType == MS2_DATA) ? $this->ce20MS2NegData : $this->ce20NLNegData);
                    case 40:
                        return (($dataType == MS2_DATA) ? $this->ce40MS2NegData : $this->ce40NLNegData);
                }
                break;
        }
    }


    #
    # Misc methods
    #

    function sortData() {
        $column = 0;

        // MS2 Data
        if ($this->ce0MS2PosData) {
            usort($this->ce0MS2PosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce10MS2PosData) {
            usort($this->ce10MS2PosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce20MS2PosData) {
            usort($this->ce20MS2PosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce40MS2PosData) {
            usort($this->ce40MS2PosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce0MS2NegData) {
            usort($this->ce0MS2NegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce10MS2NegData) {
            usort($this->ce10MS2NegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce20MS2NegData) {
            usort($this->ce20MS2NegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce40MS2NegData) {
            usort($this->ce40MS2NegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        // NL Data
        if ($this->ce0NLPosData) {
            usort($this->ce0NLPosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce10NLPosData) {
            usort($this->ce10NLPosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce20NLPosData) {
            usort($this->ce20NLPosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce40NLPosData) {
            usort($this->ce40NLPosData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce0NLNegData) {
            usort($this->ce0NLNegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce10NLNegData) {
            usort($this->ce10NLNegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce20NLNegData) {
            usort($this->ce20NLNegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }

        if ($this->ce40NLNegData) {
            usort($this->ce40NLNegData, fn($a, $b) => $a[$column] <=> $b[$column]);
        }
    }


    function processFileNLData() {

        if (file_exists($this->pathFileName)) {

            if (($handle = fopen($this->pathFileName, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, MAX_CHAR_READ_LEN, ",")) !== FALSE) {
                    $num = count($data);

                    $compoundName = $data[0];
                    $this->setCompoundName($compoundName);

                    $compoundMass = $data[1];
                    $this->setCompoundMass($compoundMass);

                    $mode = $data[2];
                    $ce   = (int)$data[3];
                    $val  = $data[2].$data[3]."V";

                    $mass = (float)$data[5];
                    $int  = (float)$data[6];

                    $this->setCEName($mode, $ce, $val);
                    $this->setSpectraData($mode, $ce, $mass, $int);
                }
                fclose($handle);
            }
        }
    }


    function get_TPM_EPM_CE($list, $mode, $ce){
        $aDict = array();

        foreach ($list as $item) {
            if (($item['mode'] == $mode) && ($item['collisionE'] == $ce)) {
                $aDict['tpm'] = (float)$item['precursor'];
                $aDict['ce']  = (int)$item['mode'];
                break;
            }
        }

        $ppmVal = 30;
        $epmVal = -1;

        foreach ($list as $item) {
            if (($item['mode'] == $mode) && ($item['collisionE'] == $ce)) {

                // Calculate: PPM Error = ABS((TPM - EPM)) / TPM
                $ppmError = abs((float)$aDict['tpm'] - (float)$item['mz']) / (float)$aDict['tpm'];

                if ((float)$ppmError <= (float)$ppmVal) {
                    $ppmVal = $ppmError;
                    $epmVal = (float)$item['mz'];
                }
            }
        }

        $aDict['epm'] = (float)$epmVal;

        return $aDict;
    }


    function calNLValuesSkipIsotopes($list, $epm, $mode, $ce) {

        $data = array();
        $hasValidData        = False;
        $hasValidModeCEEntry = False;

        $name;
        $mode;
        $collisionE;
        $precursor;

        foreach ($list as $item) {

            if (($item['mode'] == $mode) && ((int)$item['collisionE'] == (int)$ce)) {

                $name       = $item['name'];
                $mode       = $item['mode'];
                $collisionE = $item['collisionE'];
                $precursor  = $item['precursor'];

                $hasValidModeCEEntry = True;

                // Remove isotopes from the list
                if ((float)$item['mz'] <= (float)$epm) {

                    $hasValidData = True;

                    $nlMass      = (float)$epm - (float)$item['mz'];
                    $nlIntensity = (float)$item['intensity'];

                    $data[] = array(
                            "name"        => $item['name'],       // name
                            "mode"        => $item['mode'],       // mode
                            "collisionE"  => $item['collisionE'], // collisionE
                            "precursor"   => $item['precursor'],  // precursor
                            "nlMass"      => $nlMass,             // nlMass
                            "nlIntensity" => $nlIntensity         // nlIntensity
                    );
                }
            }
        }

        if (($hasValidModeCEEntry == True) && ($hasValidData == False)) {
            $nlMass      = 0.0000;
            $nlIntensity = 100;

            $data[] = array(
                    "name"        => $name,       // name
                    "mode"        => $mode,       // mode
                    "collisionE"  => $collisionE, // collisionE
                    "precursor"   => $precursor,  // precursor
                    "nlMass"      => $nlMass,     // nlMass
                    "nlIntensity" => $nlIntensity // nlIntensity
            );
        }

        return $data;
    }


    function calcNL() {

        $final = array();
        if (file_exists($this->pathFileName)) {

            if (($handle = fopen($this->pathFileName, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, MAX_CHAR_READ_LEN, ",")) !== FALSE) {
                    $num = count($data);

                    $compoundName = $data[0];
                    $this->setCompoundName($compoundName);

                    $compoundMass = $data[1];
                    $this->setCompoundMass($compoundMass);

                    $data = array(
                            "name"       => $data[0],
                            "mode"       => $data[2],
                            "collisionE" => $data[3],
                            "precursor"  => $data[4],
                            "mz"         => $data[5],
                            "intensity"  => $data[6]
                    );

                    array_push($final, $data);

                    $row++;
                }
                fclose($handle);
            }
        }

        $finalList = array();

        $modeList = ["+", "-"];
        $ceList   = [0, 10, 20, 40];

        foreach ($modeList as $mode) {
            foreach ($ceList as $ce) {
                if ($ce == 0 && $mode == "+") {
                    $nlDict = $this->get_TPM_EPM_CE($final, $mode, $ce);
                } else if ($ce == 0 && $mode == "-") {
                    $nlDict = $this->get_TPM_EPM_CE($final, $mode, $ce);
                }

                $data = $this->calNLValuesSkipIsotopes($final, $nlDict['epm'], $mode, $ce);
                $finalList = array_merge($finalList, $data);
            }
        }

        foreach ($finalList as $finalItem) {
            $mode = $finalItem["mode"];
            $ce   = (int)$finalItem["collisionE"];
            $val  = $mode.$ce."V ".$this->getCompoundName();

            if ($this->reverse) {
                $int  = (float)$finalItem["nlIntensity"] * -1;
            } else {
                $int  = (float)$finalItem["nlIntensity"];
            }

            $mass = (float)$finalItem["nlMass"];
            if ($mass >= $this->maxMass) {
                $this->maxMass = $mass;
            }

            $this->setCEName($mode, $ce, $val);
            $this->setSpectraData($mode, $ce, $mass, $int, NL_DATA);
        }
    }

    function processFileMS2Data() {

        if (file_exists($this->pathFileName)) {

            if (($handle = fopen($this->pathFileName, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, MAX_CHAR_READ_LEN, ",")) !== FALSE) {
                    $num = count($data);

                    $compoundName = $data[0];
                    $this->setCompoundName($compoundName);

                    $compoundMass = $data[1];
                    $this->setCompoundMass($compoundMass);

                    $mode = $data[2];
                    $ce   = (int)$data[3];
                    $val  = $data[2].$data[3]."V ".$this->getCompoundName();

                    if ($this->reverse) {
                        $int  = (float)$data[6] * -1;
                    } else {
                        $int  = (float)$data[6];
                    }

                    $mass = (float)$data[5];
                    if ($mass >= $this->maxMass) {
                        $this->maxMass = $mass;
                    }

                    $this->setCEName($mode, $ce, $val);
                    $this->setSpectraData($mode, $ce, $mass, $int, MS2_DATA);
                }
                fclose($handle);
            }
        }
    }

    function queryCmpdName() {
    }

    function queryCmpdMass() {
    }

    function queryNLData() {
    }

    function queryMS2Data() {
    }

    function processDBNLData() {

        $this->setCompoundName($this->queryCmpdName());
        $this->setCompoundMass($this->queryCmpdMass());

        $result = $this->queryNLData();

        if ($result) {
            foreach($result as $item) {

                $mode = $item['mode'];
                $ce   = (int)$item['collisionE'];
                $val  = $mode.$ce."V ".$this->getCompoundName();

                if ($this->reverse) {
                    $int  = (float)$item['nlIntensity'] * -1;
                } else {
                    $int  = (float)$item['nlIntensity'];
                }

                $mass = (float)$item['nlMass'];
                if ($mass >= $this->maxMass) {
                    $this->maxMass = $mass;
                }

                $this->setCEName($mode, $ce, $val);
                $this->setSpectraData($mode, $ce, $mass, $int, NL_DATA);
            }
        }
    }


    function processDBMS2Data() {

        $this->setCompoundName($this->queryCmpdName());
        $this->setCompoundMass($this->queryCmpdMass());

        $result = $this->queryMS2Data();

        if ($result) {
            foreach($result as $item) {

                $mode = $item['mode'];
                $ce   = (int)$item['collisionE'];
                $val  = $mode.$ce."V ".$this->getCompoundName();

                if ($this->reverse) {
                    $int  = (float)$item['intensity'] * -1;
                } else {
                    $int  = (float)$item['intensity'];
                }

                $mass = (float)$item['mz'];
                if ($mass >= $this->maxMass) {
                    $this->maxMass = $mass;
                }

                $this->setCEName($mode, $ce, $val);
                $this->setSpectraData($mode, $ce, $mass, $int, MS2_DATA);
            }
        }
    }


    function getJSON() {
    }
}

?>


