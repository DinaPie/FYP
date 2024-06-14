<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$purpose = $_POST['purpose'];
$location = $_POST['location'];
$packageNum = [];

switch ($location[0]) {
    //Ho Chi Minh
    case "AH":
        switch ($purpose[0]) {
            case "local":
                $packageNum = array("AHC", "AHF");
                if (isset($purpose[1])) {
                    switch ($purpose[1]) {
                        case "shopping":
                            $packageNum = array("AHC");
                            if (isset($purpose[2])) {
                                switch ($purpose[2]) {
                                    case "scenery":
                                        $packageNum = array("AHF");
                                        if (isset($purpose[3])) {
                                            switch ($purpose[3]) {
                                                case "fun":
                                                    $packageNum = array("AHF");
                                                    break;
                                            }
                                        }
                                        break;
                                }
                            }
                            break;
                        case "scenery":
                            $packageNum = array("AHE", "AHF");
                            if (isset($purpose[2])) {
                                switch ($purpose[2]) {
                                    case "fun":
                                        $packageNum = array("AHE");
                                        break;
                                }
                            }
                            break;
                        case "fun":
                            $packageNum = array("AHE", "AHF");
                            break;
                    }
                }
                break;
            case "shopping":
            $packageNum = array("AHA");
                    switch($purpose[1]){
                        case "scenery":
                        $packageNum = array("AHD");
                                switch($purpose[2]){
                                    case "fun":
                                    $packageNum = array("AHD");
                                    break;
                                }
                                break;
                        case "fun":
                        $packageNum = array("AHD");
                        break;
                    }
                    break;
            case "scenery":
            $packageNum = array("AHE", "AHF", "AHB", "AHD"); 
                    switch($purpose[1]){
                        case "fun":
                        $packageNum = array("AHB");
                        break;
                    }
                    break;
            case "fun":
                $packageNum = array("AHB", "AHD", "AHE", "AHF"); 
                break;
        }
        switch($location[1]){
            case "AD":
                //Ho Chi Minh & Dalat
                switch($purpose[0]){
                    case "local":
                            $packageNum = array("AHDL");
                            switch($purpose[1]){
                                    case "shopping":
                                        $packageNum = array("AHDG", "AHDE"); 
                                        switch($purpose[2]){
                                            case "scenery":
                                                $packageNum = array("AHDG");
                                                switch($purpose[3]){
                                                            case "fun":
                                                            $packageNum = array("AHDE");
                                                            break;
                                                }
                                                break;  
                                        }
                                        break;  

                                    case "scenery":
                                        $packageNum = array("AHDK");
                                        switch($purpose[2]){
                                                case "fun":
                                                $packageNum = array("AHDJ");
                                                break;
                                        }
                                        break;       
                                    case "fun":
                                        $packageNum = array("AHDJ", "AHDE");
                                        break;
                            }
                            break;  
                    case "shopping":
                            $packageNum = array("AHDF", "AHDD", "AHDC", "AHDG", "AHDE"); 
                            switch($purpose[1]){
                                    case "scenery":
                                        $packageNum = array("AHDF");
                                        switch($purpose[2]){
                                                case "fun":
                                                    $packageNum = array("AHDD");
                                                    break;
                                        }
                                        break;  
                                    case "fun":
                                        $packageNum = array("AHDC");
                                        break;
                            }
                            break;  
                    case "scenery":
                            $packageNum = array("AHDB");
                            switch($purpose[1]){
                                        case "fun":
                                        $packageNum = array("AHDI");
                                        break;
                            }
                            break;
                    case "fun":
                            $packageNum = array("AHDA");
                            break;
                }
                //Ho Chi Minh & Dalat & Mui Ne
                switch($location[2]){
                    case "AM":
                        switch($purpose[0]){
                            case "local":
                                $packageNum = array("AHDMB");
                                switch($purpose[1]){
                                    case "shopping":
                                        $packageNum = array("AHDMD");
                                        switch($purpose[2]){
                                            case "scenery":
                                                $packageNum = array("AHDME");
                                                switch($purpose[3]){
                                                    case "fun":
                                                        $packageNum = array("AHDMG");
                                                        break;
                                                }
                                                break;  
                                            case "fun":
                                                $packageNum = array("AHDMG");
                                                break;
                                        }
                                        break;  
                                    case "scenery":
                                        $packageNum = array("AHDMJ");
                                        switch($purpose[2]){
                                            case "fun":
                                                $packageNum = array("AHDMI");
                                                break;
                                        }
                                        break;  
                                    case "fun":
                                        $packageNum = array("AHDMI", "AHDMG"); 
                                        break;
                                }
                                break;  
                            case "shopping":
                                $packageNum = array("AHDMC", "AHDMF", "AHDMD"); 
                                switch($purpose[1]){
                                    case "scenery":
                                        $packageNum = array("AHDMC");
                                        switch($purpose[2]){
                                            case "fun":
                                                $packageNum = array("AHDMF");
                                                break;
                                        }
                                        break;
                                    case "fun":
                                        $packageNum = array("AHDMF");
                                        break;
                                }
                                break;  
                            case "scenery":
                                $packageNum = array("AHDMA");
                                switch($purpose[1]){
                                    case "fun":
                                    $packageNum = array("AHDMH");
                                    break;
                                }
                                break;  
                            case "fun":
                                $packageNum = array("AHDMH", "AHDMF", "AHDMI", "AHDMG"); 
                                break;
                        }
                        break;  
                }
                break;
            
            //Ho Chi Minh & Mui Ne
            case "AM":
                switch($purpose[0]){
                        case "local":
                        $packageNum = array("AHMF", "AHMC"); 
                            switch($purpose[1]){
                                case "shopping":
                                $packageNum = array("AHMF"); 
                                        switch($purpose[2]){
                                            case "scenery":
                                            $packageNum = array("AHMF"); 
                                                    switch($purpose[3]){
                                                        case "fun":
                                                        $packageNum = array("AHMF");
                                                        break;
                                                }
                                                break;
                                        }
                                        break;
                                case "scenery":
                                $packageNum = array("AHMF", "AHMC");
                                        switch($purpose[2]){
                                            case "fun":
                                            $packageNum = array("AHMC");
                                            break;
                                        }
                                        break;
                                case "fun":
                                $packageNum = array("AHMF", "AHMC"); 
                                break;
                            }
                            break;
                        case "shopping":
                        $packageNum = array("AHMD", "AHME", "AHMF"); 
                                switch($purpose[1]){
                                    case "scenery":
                                    $packageNum = array("AHMD");
                                            switch($purpose[2]){
                                                case "fun":
                                                $packageNum = array("AHME");
                                                break;
                                            }
                                            break;
                                    case "fun":
                                    $packageNum = array("AHME");
                                    break;
                                }
                                break;
                        case "scenery":
                        $packageNum = array("AHMD", "AHMC", "AHMF", "AHME");
                                switch($purpose[1]){
                                    case "fun":
                                    $packageNum = array("AHMB");
                                    break;
                                }
                                break;
                        case "fun":
                        $packageNum = array("AHMF", "AHMC", "AHME", "AHMB"); 
                        break;
                }
                break;
        }
        break;
        
    //Dalat
    case "AD":
        switch($purpose[0]){
            case "local":
                $packageNum = array("ADA", "ADB"); 
                switch($purpose[1]){
                        case "scenery":
                        $packageNum = array("ADA");
                                switch($purpose[2]){
                                    case "fun":
                                    $packageNum = array("ADB");
                                    break;
                                }
                                break;
                        case "fun":
                        $packageNum = array("ADB");
                        break;
                }
                break;
            case "scenery":
                $packageNum = array("ADA", "ADB");
                switch($purpose[1]){
                        case "fun":
                        $packageNum = array("ADB");
                        break;
                }
                break;
            case "fun":
                $packageNum = array("ADB");
                break;
        }
        switch($location[1]){
            case "AM":
                //Dalat & Mui Ne
                switch($purpose[0]){
                    case "local":
                    $packageNum = array("ADMA", "ADMB"); 
                        switch($purpose[1]){
                            case "scenery":
                            $packageNum = array("ADMA");
                                    switch($purpose[2]){
                                        case "fun":
                                        $packageNum = array("ADMB");
                                        break;
                                    }
                                    break;
                            case "fun":
                            $packageNum = array("ADMB");
                            break;
                        }
                        break;
                    case "scenery":
                    $packageNum = array("ADMA", "ADMB");
                        switch($purpose[1]){
                            case "fun":
                            $packageNum = array("ADMB");
                            break;
                        }
                        break;
                    case "fun":
                    $packageNum = array("ADMB");
                    break;
                }
                break;
            case "AN":
                //Dalat & Nha Trang
                switch($purpose[0]){
                        case "local":
                        $packageNum = array("ADNB");
                            switch($purpose[1]){
                                case "scenery":
                                $packageNum = array("ADNE");
                                        switch($purpose[2]){
                                            case "fun":
                                            $packageNum = array("ADND");
                                            break;
                                        }
                                        break;
                                case "fun":
                                $packageNum = array("ADNC");
                                break;
                            }
                            break;
                        case "scenery":
                        $packageNum = array("ADNE", "ADND");
                            switch($purpose[1]){
                                    case "fun":
                                    $packageNum = array("ADND");
                                    break;
                            }
                            break;
                        case "fun":
                            $packageNum = array("ADNA");
                            break;
                }
                break;
        }
        break;
        
    //Mui Ne
    case "AM":
        switch($purpose[0]){
            case "local":
                $packageNum = array("AM"); 
                    switch($purpose[1]){
                        case "scenery":
                        $packageNum = array("AM");
                        break;
                    }
                    break;
            case "scenery":
                $packageNum = array("AM");
                break;
        }
        break;

    //Nha Trang
    case "AN":
        switch($purpose[0]){
            case "local":
                $packageNum = array("AN"); 
                switch($purpose[1]){
                        case "fun":
                        $packageNum = array("AN");
                        break;
                }
                break;
            case "fun":
                $packageNum = array("AN");
                break;
        }
    
    //ZONE B
    //Danang
    case "B":
        switch($purpose[0]){
                    case "local":
                        $packageNum = array("BB");
                        switch($purpose[1]){
                            case "scenery":
                                $packageNum = array("BF");
                                switch($purpose[2]){
                                     case "fun":
                                    $packageNum = array("BE");
                                    break;
                                }
                                break;
                            case "fun":
                                $packageNum = array("BD");
                                break;
                        }
                        break;
                    case "scenery":
                        $packageNum = array("BC", "BF", "BE"); 
                        switch($purpose[1]){
                                case "fun":
                                $packageNum = array("BC");
                                break;
                        }
                        break;
                    case "fun":
                    $packageNum = array("BA");
                    break;
                }
    
    //ZONE C
    //Hanoi
    case "CH":
        switch($purpose[0]){
            case "local":
                $packageNum = array("CH");
                break;
        }
        switch($location[1]){
            case "CS":
                //Hanoi & Sapa 
                switch($purpose[0]){
                    case "local":
                    $packageNum = array("CSHA");
                        switch($purpose[1]){
                            case "scenery":
                            $packageNum = array("CSHB");
                            break;
                        }
                        break;
                    case "scenery":
                    $packageNum = array("CSHB");
                    break;
                }
                switch($location[2]){
                    case "CN":
                        //Hanoi & Sapa & Ninh Binh
                        switch($purpose[0]){
                        case "local":
                        $packageNum = array("CHSNA");
                            switch($purpose[1]){
                                case "scenery":
                                $packageNum = array("CHSNC");
                                        switch($purpose[2]){
                                            case "fun":
                                            $packageNum = array("CHSNC");
                                            break;
                                        }
                                        break;
                                case "fun":
                                $packageNum = array("CHSNB");
                                break;
                            }
                            break;
                        case "scenery":
                        $packageNum = array("CHSNC");
                                switch($purpose[1]){
                                    case "fun":
                                    $packageNum = array("CHSNC");
                                    break;
                            }
                            break;
                        case "fun":
                        $packageNum = array("CHSNB", "CHSNC");
                        break;
                    }
                    break;
                }
                break;
                
            case "CN":
                //Hanoi & Ninh Binh
                switch($purpose[0]){
                        case "local":
                        $packageNum = array("CHNA");
                            switch($purpose[1]){
                                case "scenery":
                                $packageNum = array("CHNB");
                                        switch($purpose[2]){
                                            case "fun":
                                            $packageNum = array("CHNB");
                                            break;
                                        }
                                        break;
                            }
                            break;
                        case "scenery":
                        $packageNum = array("CHNB");
                                switch($purpose[2]){
                                    case "fun":
                                    $packageNum = array("CHNB");
                                    break;
                            }
                            break;
                        case "fun":
                        $packageNum = array("CHNB");
                        break;
                    }
        }
        
    //Sapa
    case "CS":
        switch($purpose[0]){
            case "local":
            $packageNum = array("CSB");
                    switch($purpose[1]){
                        case "scenery":
                        $packageNum = array("CSA");
                        break;
                    }
                    break;
            case "scenery":
            $packageNum = array("CSA");
            break;
        }
        switch($location[1]){
            //Sapa & Ninh Binh
            case "CN":
                switch($purpose[0]){
                        case "local":
                        $packageNum = array("CSNA");
                            switch($purpose[1]){
                                case "scenery":
                                $packageNum = array("CSNC");
                                        switch($purpose[2]){
                                            case "fun":
                                            $packageNum = array("CSNC");
                                            break;
                                        }
                                        break;
                                case "fun":
                                $packageNum = array("CSNB");
                                    break;
                            }
                            break;
                        case "scenery":
                        $packageNum = array("CSNC");
                                switch($purpose[2]){
                                    case "fun":
                                    $packageNum = array("CSNC");
                                        break;
                                }
                                break;
                        case "fun":
                        $packageNum = array("CSNB", "CSNC");
                        break;
                }
                break;
        }
        break;

    //Ninh Binh
    case "CN":
        switch($purpose[0]){
            case "local":
            $packageNum = array("CN"); 
                    switch($purpose[1]){
                        case "scenery":
                        $packageNum = array("CN");
                                switch($purpose[2]){
                                    case "fun":
                                    $packageNum = array("CN");
                                    break;
                                }
                                break;
                        case "fun":
                        $packageNum = array("CN");
                        break;
                    }
                    break;
            case "scenery":
            $packageNum = array("CN");
                    switch($purpose[1]){
                        case "fun":
                        $packageNum = array("CN");
                        break;
                    }
                    break;
            case "fun":
            $packageNum = array("CN");
            break;
        }
        break;
}

// Start transaction
mysqli_begin_transaction($conn);

    try {
        // Insert packageNum values into package_choice table
        foreach ($packageNum as $packageNo) {
            $packageNo = mysqli_real_escape_string($conn, $packageNo);
            $query = "INSERT INTO package_choice (packageNum) VALUES ('$packageNo')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                throw new Exception("Error: " . mysqli_error($conn));
            }
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Redirect to custom_package.php on successful insertion
        header("location: custom_package.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($conn);
        echo $e->getMessage();
    }

    mysqli_close($conn);
}
?>