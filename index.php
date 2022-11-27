<?php
// Email kereső funkció


// Jelszó kereső funkció
function searchPassword($element_id, $array) 
{

    foreach ($array as $key => $value) 
    {
        if ($value[1] == $element_id) 
        {
            return $value;
        }
    }
    return null;
}

function searchEmail($element_id, $array) 
{
    
    foreach ($array as $key => $value) 
    {
        if ($value[0] == $element_id) 
        {
            return $value;
        }
    }
    return null;
}


echo
'
<div class="wrapper" id="mWidth">
    <h1>Szín lekérdezés</h1>
    <form class="form" method="POST">
        <div>
            <input class="form_input" type="text" name="username" placeholder="Felhasználónév">
            <input class="form_input" type="password" name="password" placeholder="Jelszó">
            <input class="query_button" type="submit" name="query_button" value="Lekérdezés">
        </div>
    </form>
';


if(isset($_POST['query_button'])) 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username=="" && $password=="") 
    {
        echo 
        "
            <script type='text/javascript'>
                alert('Kötelező megadni a felhasználónevet és a jelszót!'); 
            </script>
        ";
    }
    else
    {
        // Eredeti file kiolvasás
        $file = fopen("txt/password.txt", "r") or exit("Unable to open file!");
        while(!feof($file)) 
        {
            $coded[] = fgets($file);
        }
        array_pop($coded);
        
        fclose($file);

        // Átalakítás és szét szedés
        for($i=0;$i<count($coded);$i++) 
        {
            $converted_hexa[$i]=bin2hex($coded[$i]);
            $splited_hexa[$i]=str_split($converted_hexa[$i],2);
        }
        
        // A hexadecimális szöveg decimálissá alakítása és betöltése egy tömbbe
        for($i=0;$i<count($converted_hexa);$i++)
        {
            for($j=0;$j<count($splited_hexa[$i]);$j++) 
            {
                $converted_decimal[$i][$j]=hexdec($splited_hexa[$i][$j]);

                // Jelszó végén lévő hibás betű kitörlése
                if($converted_decimal[$i][$j] == 10) 
                {
                    unset($converted_decimal[$i][$j]);
                }
            }
        }

        // Feladat által adott számokkal való kiszámítások
        $cod=[5,-14,31,-9,3];
        foreach($converted_decimal as $row => $value) 
        {
            for($i=0; $i<count($value);$i++) 
            {
                $increased_decimal[$row][$i]=$value[$i]-$cod[$i%5];
            }                     
        }
    
        // Decimálisba vissza állítás
        for($i=0;$i<count($increased_decimal);$i++) 
        {
            for($j=0;$j<count($increased_decimal[$i]);$j++) 
            {
                $decoded_pw[$i][$j]=chr($increased_decimal[$i][$j]);
            }
        }
    
        // Összekötés
        for($i=0;$i<count($decoded_pw);$i++) 
        {
            $decoded[$i]=join($decoded_pw[$i]);
        }

        for($i=0;$i<count($decoded);$i++) 
        {
            $splited[]=(explode("*",$decoded[$i]));

            // Megoldás kiíratása file-ba
            file_put_contents('txt/megoldas.txt', print_r($splited, true));
        }
        
        // Megoldás ellenőrzés
        // var_dump($splited);

        if(searchEmail($username, $splited)!=null) 
        {
            if(searchPassword($password, $splited)!=null) 
            {
                error_reporting(E_ALL);
                $dbServer="localhost";
                $dbUser="root";
                $dbPass="";
                $dbName="adatok";
                
                // Adatbázisra csatlakozás
                $conn = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Felhasználónév lekérdezés
                $sql="SELECT Titkos FROM tabla WHERE username='$username'";
                $result=$conn->query($sql);
                
                // Eredmény kiíratása
                while($eredmeny=mysqli_fetch_row($result))
                {
                    $color = $eredmeny[0];

                    $colorGlobal = $color;

                    echo
                    '
                    <h2>
                    ';

                    if($color == "piros") {
                        echo $username . " kedvenc színe: <p class=".$color.">Piros</p>";
                    }
                    else if($color == "zold") {
                        echo $username . " kedvenc színe: <p class=".$color.">Zöld</p>";
                    }
                    else if($color == "sarga") {
                        echo $username . " kedvenc színe: <p class=".$color.">Sárga</p>";
                    }
                    else if($color == "kek") {
                        echo $username . " kedvenc színe: <p class=".$color.">Kék</p>";
                    }
                    else if($color == "fekete") {
                        echo $username . " kedvenc színe: <p class=".$color.">Fekete</p>";
                    }
                    else if($color == "feher") {
                        echo $username . " kedvenc színe: <p class=".$color.">Fehér</p>";
                    }

                    echo
                    '
                    </h2>
                    ';
                }
            }
            else 
            {
                echo 
                '
                    <script type="text/javascript"> 
                        alert("Hibás jelszó!");
                    </script>
                ';
                header("Refresh:3; url=https://www.police.hu/");
            }
        }
        else 
        {
            echo 
            '
                <script type="text/javascript"> 
                    alert("Nincs ilyen felhasználó!"); 
                </script>
            ';            
        }
    }
}

echo 
'
</div>
'
?>