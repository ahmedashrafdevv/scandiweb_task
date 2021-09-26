<?php 
class ProductController extends Controller{
    public function getAll(){
       $q = $this->db->query("call GetProducts()");
       if ($q->num_rows >= 1){
        $prs = [];
        while($pr = $q->fetch_assoc()){
          $prs[] = array_map("stripslashes", $pr) ; //Call the function for each row
        }
      } else{
      echo "No rows" ;
  } 
   echo $prs;
    }
    public function createProduct(){
        var_dump($this->db);
        echo "add new";
    }
    
}

// if ($q->num_rows >= 1){
//     $prs = [];
//     while($prs = $q->fetch_assoc()){
//       $prs[] = array_map("stripslashes", $article) ; //Call the function for each row
//     }
//   } else
//     echo "No rows" ;
    
// }