<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');
class MY_Pagination extends CI_Pagination {

	 public function __construct() {
	    parent::__construct();
	  }
  

 public function pagination($total,$per_page,$page,$url,$querystring=null){   
    $adjacents = "2"; 
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
    $lastpage = ceil($total/$per_page);
   	$lpm1 = $lastpage - 1; // //last page minus 1
    
    $pagination = "";
	$pagination_message = "";
    if($lastpage > 1){
    	$pagination_message = "Page ".$page." of ".$lastpage;  
        $pagination .= "<ul class='pagination'>";
        //$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
              
            if($querystring == null){
            	$querystring = "";
            }else{
            	$querystring = "?".$querystring;
            }
            if ($page > 1) $pagination.= "<li><a href='{$url}/{$prev}{$querystring}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}/{$counter}{$querystring}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/{$counter}{$querystring}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}/{$lpm1}{$querystring}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}/{$lastpage}{$querystring}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}/1{$querystring}'>1</a></li>";
                $pagination.= "<li><a href='{$url}/2{$querystring}'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/{$counter}{$querystring}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}/{$lpm1}{$querystring}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}/{$lastpage}{$querystring}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}/1{$querystring}'>1</a></li>";
                $pagination.= "<li><a href='{$url}/2{$querystring}'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}/{$counter}{$querystring}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}/{$next}{$querystring}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}/{$lastpage}{$querystring}'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
    $data['paginationLinks'] = $pagination;
    $data['paginationMessage'] = $pagination_message;
	return $data;
} 
}//class ends
?>
