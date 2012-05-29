<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_pagination {

    private $CI;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function all_paging($current_page,$total_page)
	{
            $prev_page=$current_page-1;
            $next_page=$current_page+1;

            $page_name=$_SERVER['REQUEST_URI'];
            $page_name=basename($page_name);

            //echo $query_str=$_SERVER['QUERY_STRING'];


            $page1=explode("?",$page_name);
            if(count($page1)>1 && $page1[1]!=NULL)
            //if($query_str!='')
            {
            $page2=explode("&",$page1[1]);
            //$page2=explode("&",$query_str[1]);

            //print_r($page2);

            $array=array();


            foreach($page2 as $v)
            {
                $v=explode("=",$v);
                if(count($v)>1)
                {
                   $array[$v[0]]=$v[1];
                }

            }

            $prev_array=$array; // for previous page
            $next_array=$array; // for next page

            $prev_array['page']=$prev_page;
            $next_array['page']=$next_page;

           $prev_page_display="";
           foreach($prev_array as $v=>$v1)
           {
            $prev_page_display.=$v."=".$v1."&";
           }
           $prev_page_display=rtrim($prev_page_display,"&");


           $next_page_display="";
           foreach($next_array as $v=>$v1)
           {
            $next_page_display.=$v."=".$v1."&";
           }
           $next_page_display=rtrim($next_page_display,"&");

           $prev_page_display=base_url().uri_string()."?".$prev_page_display;

           $next_page_display=base_url().uri_string()."?".$next_page_display;

			unset($array);
			unset($prev_array);
			unset($next_array);
            }

            else
            {
                $prev_page_display=base_url().uri_string()."?page=".$prev_page;

                $next_page_display=base_url().uri_string()."?page=".$next_page;


            }




            if($prev_page>0)
            {
                $prev_display='<a href="'.$prev_page_display.'"><img src="'.base_url().'image/prev.gif" alt="" border="0" /></a>';
            }
            else
            {
                $prev_display='<img src="'.base_url().'image/prevd.gif" alt="" border="0" />';
            }

            if($next_page<=$total_page)
            {
                $next_display='<a href="'.$next_page_display.'"><img src="'.base_url().'image/next.gif" alt="" border="0"/></a>';
            }
            else
            {
                $next_display='<img src="'.base_url().'image/nextd.gif" alt="" border="0"/>';
            }


            /*
            $paging=$prev_display.'<input name="page" type="text" maxlength="4" value="'.$current_page.'" class="pin" />
                             av '.$total_page.' '.$next_display;

             */

$paging='<div class="pagination">
        <div class="pagibody">
                        <div class="pagiarrow">'.
                       $prev_display.'
                        </div>
                        <div class="pagininput"><input name="page" type="text" maxlength="4" value="'.$current_page.'"/></div>
			<div class="pagininfo"> '.$this->CI->all_function->get_label('l_of').' '.$total_page.'
                      	</div>
                        <div class="pagiarrow">'.
                        $next_display.'
                        </div>

                    </div>
                    </div>';

       

           return $paging;
        }


    function get_paging_limit($post_page) // submit the filtering
    {

                //$page_name=$_SERVER['REQUEST_URI'];
                //$page_name=basename($page_name);

                $page_name=$_SERVER['HTTP_REFERER'];


                $page1=explode("?",$page_name);

                if(count($page1)>1&& $page1[1]!=NULL)
                {
                $page2=explode("&",$page1[1]);


                $array=array();


                foreach($page2 as $v)
                {
                    $v=explode("=",$v);
                    if(count($v)>1)
                    {
                    $array[strtolower($v[0])]=$v[1];
                    }
                }


                //$array['limit']=$limit;
                //$array['sort']=$sort;
                $array['page']=$post_page;

               $page_display="";
               foreach($array as $v=>$v1)
               {
               		$page_display.=$v."=".$v1."&";
               }
               $page_display=rtrim($page_display,"&");
               $page_display=$page1[0]."?".$page_display;

               unset($array);

                }
                else
                {
                    //$page_display=$page_name."?limit=".$limit."&sort=".$sort."&page=".$post_page;
                   $page_display=$page1[0]."?page=".$post_page;

                }



                //$full_path=base_url().$page_display;
                 $full_path=$page_display;
                return $full_path;
}


function get_paging_filter($parameter_arr) // submit the filtering
    {

                //$page_name=$_SERVER['REQUEST_URI'];
                //$page_name=basename($page_name);

                $page_name=$_SERVER['REQUEST_URI'];
                $page_name=basename($page_name);

                $page1=explode("?",$page_name);

                if(count($page1)>1&& $page1[1]!=NULL)
                {
                $page2=explode("&",$page1[1]);


                $array=array();


                foreach($page2 as $v)
                {
                    $v=explode("=",$v);
                    if(count($v)>1)
                    {
                        $array[strtolower($v[0])]=$v[1];
                    }
                }


                //$array['limit']=$limit;
                //$array['sort']=$sort;
                //$array['page']=$post_page;

               

                }

                /*
                else
                {
                   
                   $page_display=$page1[0]."?page=".$post_page;

                }
                */
    
                foreach($parameter_arr as $v=>$v1)
                {
                    $array[strtolower($v)]=$v1;
                }

                $array=array_filter($array);

               $page_display="";
               foreach($array as $v=>$v1)
               {
               		$page_display.=$v."=".$v1."&";
               }
               $page_display=rtrim($page_display,"&");

               $page_display=uri_string()."?".$page_display;

               unset($array);

                //$full_path=base_url().$page_display;
                 $full_path=$page_display;
                return $full_path;
}


            function display_paging_tot_number($total_number)
            {
                $max_number=10000;

                if($total_number >$max_number)
                {
                    $val=$max_number."+";
                }
                else
                {
                    $val=$total_number;
                }

                return $val;
            }

}

?>