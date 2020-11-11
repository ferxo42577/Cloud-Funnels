<?php
//language manager
$cf_registered_languages=array();
$cf_available_languages=array(
    "lang_english_en"=>"English US",
    "lang_hindi_hi"=>"हिन्दी",
    "lang_dutch_nl"=>"Nederlands",
    "lang_french_fr"=>"français",
    "lang_german_de"=>"Deutsch",
    "lang_greek_gr"=>"ελληνικά",
    "lang_italian_itl"=>"italiano",
    "lang_japanese_ja"=>"日本語",
    "lang_arabic_ar"=>"عربى",
    "lang_danish_da"=>"dansk",
    "lang_korean_ko"=>"한국어",
    "lang_romanian_ro"=>"Română",
    "lang_spanish_sp"=>"Española",
    "lang_polish_pl"=>"Polskie",
    "lang_portuguese_po"=>"Portuguesa",
    "lang_malay_ml"=>"Bahasa Melayu"
);

if(!function_exists('getCachedTranslation'))
{
    function getCachedTranslation($lang="lang_english_en",$dir=false,$cache_location=false)
    {
        global $document_root;
        global $is_gcp;
        global $gcp_bucket;
        global $gcp_bucket_url;
        global $cf_registered_languages;


        if($is_gcp)
        {
            $file=$gcp_bucket."/lang/cache.json";
        }
        else
        {
            $file=$document_root."/lang/cache.json";
        }
        if($cache_location !==false)
        {
            $cache_location=rtrim(str_replace("\\","/",$cache_location),"/");
            $file=$cache_location."/lang/cache.json";
        }
        
        $regenerate=false;
        if(!is_file($file) || (is_file($file) && filesize($file)<1))
        {
            $regenerate=true;
        }
        else
        {
            if($is_gcp)
            {
                $data=gcp_files_get_content($file);
            }
            else
            {
                $fp=fopen($file,'r');
                $data=fread($fp,filesize($file));
                fclose($fp);
            }
            $data=json_decode($data);
            if(is_object($data)){$data=(array)$data;}
            if(is_array($data) && count($data)>0)
            {
                $cf_registered_languages=$data;
            }
            else
            {
                $regenerate=true;
            }
        }

        if($regenerate)
        {
            registerTranslation($lang,$dir,$cache_location);
        }
    }
}
if(!function_exists('registerTranslation'))
{
    function registerTranslation($lang="lang_english_en",$dir=false,$cache_location=false)
    {
        global $is_gcp;
        global $cf_registered_languages;
        global $document_root;

        $def="lang_english_en";
        
        if($dir !==false)
        {
            $dir=rtrim(str_replace("\\","/",$dir),'/');
        }
        else
        {
            $dir=rtrim(str_replace("\\","/",__DIR__),"/");
            $dir .="/languages";
        }
        $file=$dir."/".$lang.'.json';
        if(!is_file($file))
        {
            $file=$dir."/".$lang.".json";
            if(!is_file($file))
            {return;}
        }
        if(filesize($file)>0)
        {
            $fp=fopen($file,'r');
            $data=fread($fp,filesize($file));
            fclose($fp);
            $data=json_decode(trim($data));
            if(!json_last_error())
            {
                $data=(array)$data;

                foreach($data as $data_index=>$data_val){
                    $data[$data_index]=html_entity_decode($data_val);
                }
                
                if(!is_array($cf_registered_languages))
                {
                    $cf_registered_languages=array();
                }

                $cf_registered_languages=array_merge($cf_registered_languages,$data);
            }
            
        }
        
        if(!is_array($data))
        {return false;}

        $cached_content="{}";
        $cache_file=$document_root."/lang/cache.json";
        $cache_file_js=$document_root."/lang/cache.js";
        if($is_gcp)
        {
            global $gcp_bucket;
            global $gcp_bucket_url;

            if($gcp_bucket ===false)
            {return;}

            $cache_file=$gcp_bucket."/lang/cache.json";
            $cache_file_js=$gcp_bucket."/lang/cache.js";
        }
        /*
        if(is_file($cache_file) && filesize($cache_file)>0)
        {
            if($is_gcp)
            {
                $cached_content= gcp_files_get_content($cache_file);
            }
            else
            {
                $fp=fopen($cache_file,"r");
                $cached_content=fread($fp,filesize($cache_file));
                fclose($fp);
            }
        }
        */
        //if($cached_content !==json_encode($data))
        //{
            $cached_content=json_encode($data);
            cf_fwrite($cache_file,$cached_content);
            cf_fwrite($cache_file_js, "try{var cf_current_selected_language=`".$lang."`;var cf_registered_languages=".$cached_content.";}catch(err){ console.log(err); }");
        //}
        
    }
}
if(!function_exists('getTranslation'))
{
    function getTranslation()
    {
        
    }
}
if(!function_exists('t'))
{
    function t($txt,$arr=array())
    {
        global $cf_registered_languages;

        $has_nbsp=false;
        if(strpos($txt,"&nbsp;") !==false)
        {
            $has_nbsp=true;
        }

        $txtt=str_replace("&nbsp;"," ",trim($txt));
        $txtt=htmlentities($txtt);

        $txtt=str_replace("&amp;","&",$txtt);
        $txtt=str_replace("&apos;","'",$txtt);
        $txtt=str_replace("&rsquo;","'",$txtt);
        $txtt=str_replace("&nbsp;"," ",$txtt);

        $num_reg="/^[0-9]+([\.,0-9]*[0-9]+)*$/";
        $t_found=false;

        if(preg_match($num_reg,$txtt))
        {
            $txtt=str_split($txtt);

            for($i=0;$i<count($txtt);$i++)
            {
                if($txtt[$i]=='.'|| $txtt[$i]==",")
                {continue;}
                if(isset($cf_registered_languages[$txtt[$i]]))
                {
                    $trans=trim($cf_registered_languages[$txtt[$i]]);
                    $txtt[$i]=(strlen($trans)>0)? $trans:$txtt[$i];
                }
            }
            $t_found=true;
            $txt=implode("",$txtt);
        }
        elseif(isset($cf_registered_languages[$txtt]))
        {
            $trans=$cf_registered_languages[$txtt];
            $txt=(strlen($trans)>0)? $trans:$txt;
            $t_found=true;
        }

        
        for($i=0;$i<count($arr);$i++)
        {
            $j=$i+1;
            $txt=str_replace("\${".$j."}",$arr[$i],$txt);
        }
        
        if($has_nbsp)
        {
            $txt=str_replace(" ","&nbsp;",$txt);
        }
        return $txt;
    }
}
if(!function_exists('w'))
{
    function w($txt,$arr=array())
    {
        echo t($txt,$arr);
    }
}
?>