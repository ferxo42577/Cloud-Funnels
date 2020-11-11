<?php
class Autoupdate
{
    var $update_url;
    var $current_version;
    var $base_dir;
    function __construct($arr)
    {
        $this->mysqli=$arr['mysqli'];
        $this->dbpref=$arr['dbpref'];
        $this->update_url="http://cloudfunnels.in/membership/api/auto_update";
        $this->current_version=get_option('qfnl_current_version');
        $this->base_dir=$arr['base_dir'];
    }
    function request($url,$arr=array(),$type="post")
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if($type=="post")
        {
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        $res=curl_exec($ch);
        curl_close($ch);
        return $res;
    }
    function checkForUpdate($download_url=0,$version=0)
    {
        if(!filter_var($download_url,FILTER_VALIDATE_URL))
        {
        $arr=array('user_version'=>$this->current_version,'check_qfnl_update'=>1);
        $res=self::request($this->update_url,$arr);
        //echo $res;
        $res=json_decode($res);
        if(json_last_error()===0)
        {
            if($res->update)
            {
                return json_encode(array('download_url'=>$res->download_url,'version'=>$res->updated_version,'changes'=>$res->changes));
            }
            else
            {
                // if(isset($res->version))
                // {
                //     self::installDependecies($res->version);
                // }
                return 0;
            }
        }
        else
        {return 0;}
        }
        elseif(filter_var($download_url,FILTER_VALIDATE_URL))
        {
                $zip=self::request($download_url,array(),'get');
                $fp=fopen($this->base_dir."/qfunnel_update.zip","w");
                fwrite($fp,$zip);
                fclose($fp);
                return 1;
        }

        return 0;
    }
    function doUpdate($version)
    {
        $file=$this->base_dir."/"."qfunnel_update.zip";
        $zip=new ZipArchive();
        $zip->open($file);
        $zip->extractTo($this->base_dir);
        $zip->close();
        unlink($file);
        return 1;
    }
    function installDependecies($version=0)
    {
        //install all updates if not exists
        //qfnl_has_update_00 to check if update exists or not
        //all things will be writtent before lbl
        $mysqli=$this->mysqli;
        $dbpref=$this->dbpref;

        lbl:
        if($version>0)
        {
            //all version changes will be written here
            //insidie the updates

            if(!get_option('qfnl_has_update_19'))
            {
                $table=$dbpref."quick_funnels";
                if(!$mysqli->query("select `token` from `".$table."`"))
                    {
                        $mysqli->query("alter table `".$table."` add `token` varchar(255) not null after `date_created`");
                    }
                update_option('qfnl_has_update_19','1');
            }
            if(!get_option('qfnl_has_update_29'))
            {
                $table=$dbpref."quick_autoresponders";
                $mysqli->query("alter table `".$table."` modify `autoresponder_detail` text not null");
                $mysqli->query("alter table `".$table."` modify `exf` text not null");
                update_option('qfnl_has_update_29','1');
            }
            if(!get_option('qfnl_has_update_423'))
            {
                add_option('app_language','lang_english_en');
                add_option('qfnl_has_update_423',1);
            }
            if(!get_option('qfnl_has_update_424'))
            {
                $table=$dbpref.'quick_pagefunnel';
                $mysqli->query("alter table `".$table."` modify `level` int(11)");

                $sql26="create table if not exists `".$dbpref."qfnl_plugins`(
                    `id` bigint not null auto_increment,
                    `base_dir` varchar(255) not null,
                    `destin_version` varchar(255) not null,
                    `status` varchar(10) not null,
                    `activated_on` datetime not null,
                    primary key(`id`)
                )
                ";
                $mysqli->query($sql26);
                
                $sql27="create table if not exists `".$dbpref."qfnl_funnel_meta`(
                    `id` bigint not null auto_increment,
                    `funnel_id` varchar(255) not null,
                    `page_level` varchar(255) not null,
                    `page_type` varchar(4) not null,
                    `key` varchar(255) not null,
                    `value` text not null,
                     primary key(`id`)
                    )
                ";
                $mysqli->query($sql27);
                
                if(!get_option('qfnl_setup_token'))
                {
                    add_option('qfnl_setup_token',time());
                }

                add_option('qfnl_has_update_424',1);
            }
            if(!get_option('qfnl_has_update_426'))
            {
                add_option('cod_otp_email_title', 'OTP  for product confirmation');
                add_option('cod_otp_email_content', '<p>Hello,</p><p>Please enter the below OTP code to complete Verification.</p><p><strong>{otp}</strong></p><p>This code is valid for the next 10 minutes.</p><p>If you did not raise the request please write to our support team.</p>');

                $sql28="create table if not exists `".$dbpref."qfnl_cod`(
                    `id` bigint not null auto_increment,
                    `sell_id` bigint not null,
                    `status` int default 0,
                    `buyer_email` varchar(255) not null,
                    `signed_by` int not null,
                    `last_ip` text not null,
                    `added_on` datetime not null,
                    `updated_on` datetime not null,
                    primary key(`id`)
                )";
                $mysqli->query($sql28);
                add_option('qfnl_has_update_426', 1);
            }
            if(!get_option('qfnl_has_update_427'))
            {
                $sql29= "create table if not exists `".$dbpref."media`(
                    `id` bigint not null auto_increment,
	                `title` varchar(255) not null,
	                `file` text not null,
	                `type` varchar(255) not null,
	                `file_type` varchar(255) not null,
	                `size` varchar(255) not null,
	                `description` text not null,
	                `added_on` varchar(255) not null,
	                `updated_on` varchar(255) not null,
	                primary key(`id`)
                    )
                    ";
                $create_twentynine= $mysqli->query($sql29);
                add_option('qfnl_has_update_427', 1);
            }

            //end of the call
            $strvar=str_replace(".","",(string)$version);
            $current_version=get_option('qfnl_current_version');

            if($version>$current_version)
            {
                update_option('qfnl_current_version',$version);
            }

            if(!get_option('qfnl_has_update_'.$strvar,'1'))
            {
                update_option('qfnl_current_version',$version);
                update_option('qfnl_has_update_'.$strvar,'1');
            }
        }
        return 1;
    }

}
?>