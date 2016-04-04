<?php
if(!function_exists("FB_LOGIN")){
    function FB_LOGIN(){
        $helper = FB()->getRedirectLoginHelper();
        $permissions = explode(",", FACEBOOK_PERMISSIONS);
        $loginUrl = $helper->getLoginUrl(PATH.'facebook/add', $permissions);
        return $loginUrl;
    }
}

if(!function_exists("FB_ACCESS_TOKEN")){
    function FB_ACCESS_TOKEN(){
        $helper = FB()->getRedirectLoginHelper();
         $accessToken = $helper->getAccessToken()->getValue();
            set_session("fb_token",$accessToken);
    }
}

if(!function_exists("FB_POST")){
    function FB_POST($data){
        $response = array();
        try {
            switch ($data->type) {
                case 'text':
                    $mess = array("message" => $data->message);
                    $response = FB()->post('/'.$data->fid.'/feed', $mess, $data->access_token);
                    break;
                case 'link':
                    $mess = array(
                        "message"     => $data->message,
                        "name"        => $data->title,
                        "description" => $data->description,
                        "link"        => $data->url
                    );

                    $image = $data->image;
                    if (checkRemoteFile($image) === true) {
                        $mess["picture"] = $data->image;
                    }
                    
                    $response = FB()->post('/'.$data->fid.'/feed', $mess, $data->access_token);
                    break;
                case 'image':
                    $image = $data->image;
                    if (checkRemoteFile($image) === true) {
                        $mess = array(
                            "message"     => $data->description
                        );
                        $mess["url"] = $data->image;
                        $response = FB()->post('/'.$data->fid.'/photos', $mess, $data->access_token);
                    }
                    
                    break;
                case 'video':
                    $url = $data->url;
                    $id = getIdYoutube($data->url);
                    if(strlen($id) == 11){
                        $format = "mp4"; 
                        $ext = str_replace("video/", "", $format);
                        parse_str(file_get_contents("http://youtube.com/get_video_info?video_id=".$id),$info); 
                        $streams = $info['url_encoded_fmt_stream_map']; 
                        $streams = explode(',',$streams);
                        $filename = 'uploads/'.incrementalHash().".".$ext;
                        foreach($streams as $stream){
                            parse_str($stream,$result); 
                            if(stripos($result['type'],$format) !== false && $result['itag'] == 18){ 
                                $video = fopen($result['url'].'&amp;signature='.@$result['sig'],'r');
                                $file = fopen($filename,'w');
                                stream_copy_to_stream($video,$file);
                                fclose($video);
                                fclose($file);


                                $mess = array(
                                    "title"       => $data->title,
                                    "description" => $data->description
                                );
                                $mess["source"] = FB()->videoToUpload(BASE.$filename);
                                $response = FB()->post('/'.$data->fid.'/videos', $mess, $data->access_token);
                                unlink($filename);
                                break;
                            }
                        }
                    }else{
                        if (checkRemoteFile($url) === true) {
                            $mess = array(
                                "title"       => $data->title,
                                "description" => $data->description
                            );
                            $mess["source"] = FB()->videoToUpload($url);
                            $response = FB()->post('/'.$data->fid.'/videos', $mess, $data->access_token);
                        }
                    }
                    break;
            }
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            //return false;
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
           // return false;
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if(!empty($response)){
            return $response->getGraphNode();
        }else{
            return false;
        }
    }
}

if(!function_exists("FB_GET_POSTS")){
    function FB_GET_POSTS($data){
        $response = array();
        $post = json_decode($data->result);
        $post_id = 0;
        if(isset($post->id)){
            $post_id = $post->id;
        }

        try {
            $response = FB()->get('/'.$post_id."?fields=comments{message},likes,sharedposts", $data->access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return false;
            //echo 'Graph returned an error: ' . $e->getMessage();
            //exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return false;
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            //exit;
        }

        if(!empty($response)){
            return $response->getDecodedBody();
        }else{
            return false;
        }
    }
}

if(!function_exists('getExtendedTokenFB')){
    function getExtendedTokenFB($access_token){
        if($access_token != ""){
            $extend_url = 'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='.session("app_id").'&client_secret='.session("app_secret").'&fb_exchange_token='.$access_token;
            $resp = file_get_contents($extend_url);
            parse_str($resp,$output);
            $extended_token = $output['access_token'];
            return $extended_token;
        }
    }
}

if(!function_exists("FB")){
    function FB(){
        require_once(APPPATH.'libraries/Facebook/autoload.php');
        $fb = new Facebook\Facebook([
            'app_id' => session("app_id"),
            'app_secret' => session("app_secret"),
            'default_graph_version' => 'v2.3',
        ]);

        return $fb;
    }
}
?>