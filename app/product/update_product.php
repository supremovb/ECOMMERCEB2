<?php

if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__."/../config/Directories.php"); //to handle folder specific path
include("..\config\DatabaseConnect.php"); //to access database connection

$db = new DatabaseConnect(); //make a new database instance

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $productId = htmlspecialchars($_POST["id"]);
    $productImage2 = htmlspecialchars($_POST["productImage2"]);
    $productName = htmlspecialchars($_POST["productName"]);
    $category = htmlspecialchars($_POST["category"]);
    $basePrice = htmlspecialchars($_POST["basePrice"]);
    $numberOfStocks = htmlspecialchars($_POST["numberOfStocks"]);
    $unitPrice = htmlspecialchars($_POST["unitPrice"]);
    $totalPrice = htmlspecialchars($_POST["totalPrice"]);
    $description = htmlspecialchars($_POST["description"]);
    
     //validate user input
    
    
    if (trim($productName) == "" || empty($productName)) { 
        $_SESSION["mali"] = "Product Name field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($category) == "" || empty($category)) { 
        $_SESSION["mali"] = "Category field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($basePrice) == "" || empty($basePrice)) { 
        $_SESSION["mali"] = "Base Price field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($numberOfStocks) == "" || empty($numberOfStocks)) { 
        $_SESSION["mali"] = "Number of Stocks field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($unitPrice) == "" || empty($unitPrice)) { 
        $_SESSION["mali"] = "Unit Price field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($totalPrice) == "" || empty($totalPrice)) { 
        $_SESSION["mali"] = "Total Price field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    
    if (trim($description) == "" || empty($description)) { 
        $_SESSION["mali"] = "Description field is empty";
        header("location: ".BASE_URL."views/admin/products/edit.php");
        exit;
    }
    if (!isset($productImage2) || empty($productImage2)) {
        $_SESSION["error"] = "No image attached";
    
        header("location: ".BASE_URL."views/admin/products/edit.php");
      exit;
    }
 

    try{
    //insert record to database
    $conn = $db->connectDB();
    $sql ="UPDATE products SET products.product_name = :p_product_name,
                    products.product_description = :p_product_description,
                    products.category_id = :p_category_id,
                    products.base_price = :p_base_price,
                    products.stocks = :p_stocks,
                    products.unit_price = :p_unit_price,
                    products.total_price = :p_total_price,
                    products.updated_at = NOW()
                    WHERE products.id = :p_id";

    $stmt= $conn->prepare($sql);
    $data = [':p_product_name'        => $productName,
         ':p_product_description' => $description,
         ':p_category_id'         => $category,
         ':p_base_price'          => $basePrice,
         ':p_stocks'              => $numberOfStocks,
         ':p_unit_price'          => $unitPrice,
         ':p_total_price'         => $totalPrice, 
         ':p_id'                  => $productId ];

         if(!$stmt->execute($data)){
            $_SESSION["mali"] = "failed to update the reccord";
            header("location: ".BASE_URL."views/admin/products/edit.php");
            exit;

         }

         $lastId = $productId;
        
         
     

         
         if (isset($_FILES['productImage2']) && $_FILES['productImage2']['error'] == 0) {
            $error = processImage($lastId);
        
            if ($error) {
                $_SESSION["error"] = $error;
                header("Location: " . BASE_URL . "views/admin/products/edit.php");
                exit;
            }
        }
         
         $_SESSION["tama"] = "product updated successfully";
         header("location: ".BASE_URL."views/admin/products/index.php");
        exit;
    

        } catch(PDOException $e){
            echo "Connection Failed" . $e->getMessage();
            $db=null;
        }

        
            

}

function processImage($id){
    global $db;
    //retrieve $_FILES
    $path         = $_FILES['productImage']['tmp_name']; //actual file on tmp path
    $fileName     = $_FILES['productImage']['name']; //file name
    $fileType     =mime_content_type($path);


    if($fileType != 'image/jpeg' && $fileType  != 'image/png'){
        return "File is not jpg/png file";
    }
    
    
    $newFileName = md5(uniqid($fileName, true));
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $hashedName = $newFileName.'.'.$fileExt;

    $destination = ROOT_DIR.'public/uploads/products/'.$hashedName;
    if(!move_uploaded_file($path,$destination)){
        return "transferring of image returns an error";

    }

    $imageUrl ='public/uploads/products/'.$hashedName;

    $conn = $db->connectDB();
    $sql = "UPDATE products  SET image_url = :p_image_url WHERE id = :p_id; ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':p_image_url',$imageUrl);
    $stmt->bindParam(':p_id',$id);

    $stmt->execute();

    return null;
}