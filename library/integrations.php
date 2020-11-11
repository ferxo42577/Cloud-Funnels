<?php
class Integrations
{
    var $mysqli;
    var $pref;
    function __construct($arr)
    {
       // print_r($arr);
        $this->mysqli=$arr['mysqli'];
        $this->pref=$arr['dbpref'];
    }
    function storeIntegrations($title,$type,$data,$pos="footer",$do="insert",$id=0)
    {
        $mysqli=$this->mysqli;
        $title=$mysqli->real_escape_string($title);
        $type=$mysqli->real_escape_string($type);
        $data=$mysqli->real_escape_string($data);
        $pos=$mysqli->real_escape_string($pos);
        $id=$mysqli->real_escape_string($id);

        $table=$this->pref."qfnl_integrations";
        $add=0;
        if($do=="insert")
        {
            if($mysqli->query("insert into `".$table."` (`title`,`type`,`data`,`position`,`added_on`) values ('".$title."','".$type."','".$data."','".$pos."','".time()."')"))
            {
            $add=$mysqli->insert_id;
            }
        }
        else
        {
            if($mysqli->query("update `".$table."` set `title`='".$title."',`type`='".$type."',`data`='".$data."',`position`='".$pos."' where `id`=".$id.""))
            {
                $add=$id;
            }
           
        }
      
        return $add;
    }
    function delIntegration($id)
    {
        $mysqli=$this->mysqli;
        $table=$this->pref."qfnl_integrations";
        $id=$mysqli->real_escape_string($id);
        $mysqli->query("delete from `".$table."` where `id`=".$id."");
        return 1;
    }
    function getData($get="all",$page=1)
    {
        $mysqli=$this->mysqli;
        $table=$this->pref."qfnl_integrations";
        if(is_numeric($get))
        {
            $id=$mysqli->real_escape_string($get);
            $qry=$mysqli->query("select * from `".$table."` where `id`=".$id."");
            if($qry->num_rows>0)
            {
                return $qry->fetch_object();
            }
            else{return 0;}
        }
        elseif($get==="all")
        {
            if($page==1|| (! is_numeric($page)))
            {
                $page=0;
            }
            else
            {
                $page=($page*10)-10;
            }
            if(isset($_POST["onpage_search"]) && strlen($_POST['onpage_search'])>0)
            {
                $search_keywords=$mysqli->real_escape_string($_POST["onpage_search"]);
                $query_str="select * from `".$table."` where `title` like '%".$search_keywords."%' or `type` like '%".$search_keywords."%' or `data` like '%".$search_keywords."%' or `position` like '%".$search_keywords."%' order by `id` desc";
            }
            else
            {
                $timelimit_condition=1;
                $date_between=dateBetween('added_on');
                if(strlen($date_between[0])>1)
                 {
                     $timelimit_condition=$date_between[0];
                 }
                 $order_by="`id` desc";
                 if(isset($_GET['arrange_records_order']))
                 {
                    $order_by=base64_decode($_GET['arrange_records_order']);
                 }

                 $query_str="select * from `".$table."` where ".$timelimit_condition." order by ".$order_by." limit ".$page.",".get_option('qfnl_max_records_per_page')."";
            }
            return $mysqli->query($query_str);
        }
        elseif($get==="total")
        {
            $timelimit_condition=1;
            $date_between=dateBetween('added_on');
            if(strlen($date_between[0])>1)
             {
                 $timelimit_condition=$date_between[0];
             }

            $qry=$mysqli->query("select count(`id`) as `countid` from `".$table."` where ".$timelimit_condition."");
            if($r=$qry->fetch_object())
            {
                return $r->countid;
            }
            return 0;
        }
    }
    function integrationViewer($int_ids,$html)
    {
        if(is_array($int_ids))
        {
        $header="";
        $footer="";
        for($i=0;$i<count($int_ids);$i++)
        {
            $data=self:: getData($int_ids[$i]);
            if($data !==0)
            {
                $content=$data->data;
                if($data->type=="messenger"|| $data->type=="skype")
                {
                    if(strpos($content,"</script>")<1)
                    {
                        if($data->type=="messenger")
                        {
                            $content='<!-- Load Facebook SDK for JavaScript -->
                            <div id="fb-root"></div>
                            <script>
                              window.fbAsyncInit = function() {
                                FB.init({
                                  xfbml            : true,
                                  version          : \'v4.0\'
                                });
                              };
                      
                              (function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = \'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js\';
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, \'script\', \'facebook-jssdk\'));</script>
                      
                            <!-- Your customer chat code -->
                            <div class="fb-customerchat"
                              attribution=setup_tool
                              page_id="'.$content.'"
                        theme_color="#13cf13">
                            </div>';
                        }
                        else
                        {
                            $content='<span class="skype-button bubble " data-contact-id="'.$content.'"></span>
                            <script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>';
                        }
                    }
                }
                if($data->position=="header")
                {
                    $header .=$content;
                }
                else
                {
                    $footer .=$content;
                }
            }
        }
        $html=str_replace("</head>",$header."</head>",$html);
        $html=str_replace("</body>",$footer."</body>",$html);
        return $html;
        }
        else
        {
            return $html;
        }
    }
    function countOccurranceInPagetable($id)
    {
        $mysqli=$this->mysqli;
        $pref=$this->pref;
        $table=$pref."quick_pagefunnel";
        $id=$mysqli->real_escape_string($id);
        $qry=$mysqli->query("select count(distinct(`funnelid`)) as `countid` from `".$table."` where `settings` like '%\"snippet_integrations\":[%\"".$id."\"%]%'");

        $count=0;
        if($r=$qry->fetch_object())
        {
            $count=$r->countid;
        }
        return $count;
    }
}
?>