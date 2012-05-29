<?php
            if($this->input->post('page')) // if submit the filter
                     {

                        // $limit=$this->input->post('limit');

                         
                        // $this->session->set_userdata(array('limit'=>$limit));

                         if($this->input->post('page'))
                         {
                             $post_page=$this->input->post('page');
                         }
                         else
                         {
                             $post_page=1;
                         }


                       $full_path=$this->user_pagination->get_paging_limit($post_page);

                        redirect($full_path);

                     }

                     //-------- start for limit --------//

                    /* if($this->session->userdata('limit')!="")
                     {
                         $total_row_display=$this->session->userdata('limit');
                     }
                     else
                     {
                         $total_row_display='10';
                     }

                     */

                        if(!isset($total_row_display))
                        {
                            $total_row_display='10';
                        }
                        

                     //$row_array=array('10','20','30');

                     //$data_msg['select_limit']=$total_row_display;

                     //-------- end for limit --------//


                     $page=$this->input->get('page');

                     if(!is_numeric($page)|| $page==NULL|| $page < 1)
                     {
                         $page=1;
                     }
                     else
                     {
                         $page=$page;
                     }


                     
                     $tot_page=ceil($total_number/$total_row_display);

                     if($page > $tot_page)
                     {
                         $page=1;
                     }


                     $limit_from=($page-1)*$total_row_display;

?>