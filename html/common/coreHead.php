<?php
require_once __DIR__ . '/config.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;

if (!$CONFIG['DEV']) Sentry\init([
    'dsn' => $CONFIG['ERRORS']['SENTRY'],
    'release' => $CONFIG['VERSION']['HEROKU']['COMMIT']
]); //Setup Sentry Error Logging
try {
    //session_set_cookie_params(0, '/', '.' . $_SERVER['SERVER_NAME']); //Fix for subdomain bug
    session_set_cookie_params(43200); //12hours
    session_start(); //Open up the session
} catch (Exception $e) {
    //Do Nothing
}
/* DATBASE CONNECTION */
$DBLIB = new MysqliDb ([
                'host' => $CONFIG['DB_HOSTNAME'],
                'username' => $CONFIG['DB_USERNAME'],
                'password' => $CONFIG['DB_PASSWORD'],
                'db'=> $CONFIG['DB_DATABASE'],
                'port' => 3306,
                //'prefix' => 'adamrms_',
                'charset' => 'utf8'
        ]);

/* FUNCTIONS */
class bCMS {
    function sanitizeString($var) {
        global $DBLIB;
        //Setup Sanitize String Function
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return $DBLIB->escape($var);
    }
    function randomString($length = 10, $stringonly = false) { //Generate a random string
        $characters = 'abcdefghkmnopqrstuvwxyzABCDEFGHKMNOPQRSTUVWXYZ';
        if (!$stringonly) $characters .= '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function cleanString($var) {
        //HTML Purification
        //$var = str_replace(array("\r", "\n"), '<br>', $var); //Replace newlines

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
        $config->set('AutoFormat.Linkify', true);
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($var);

        $clean_html = urlencode($clean_html); //Url encoding stops \ problems!

        global $DBLIB;
        return $DBLIB->escape($clean_html);
    }
    function unCleanString($var) {
        return urldecode($var);
    }
    function formatSize($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 1) . ' GB';
        } elseif ($bytes >= 100000) {
            $bytes = number_format($bytes / 1048576, 1) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 0) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
    function modifyGet($array) {
        //Used to setup links that don't affect search terms etc.
        foreach ($array as $key=>$value) {
            $_GET[$key] = $value;
        }
        return $_GET;
    }
    function auditLog($actionType = null, $table = null, $revelantData = null, $userid = null, $useridTo = null, $projectid = null, $targetid = null) { //Keep an audit trail of actions - $userid is this user, and $useridTo is who this action was done to if it was at all
        global $DBLIB;
        $data = [
            "auditLog_actionType" => $actionType,
            "auditLog_actionTable" => $table,
            "auditLog_actionData" =>  $revelantData,
            "auditLog_timestamp" =>  date("Y-m-d H:i:s"),
            "projects_id" => $projectid,
            "auditLog_targetID" => $this->sanitizeString($targetid)
        ];
        if ($userid > 0) $data["users_userid"] = $this->sanitizeString($userid);
        if ($useridTo > 0) $data["auditLog_actionUserid"] = $this->sanitizeString($useridTo);

        if ($DBLIB->insert("auditLog", $data)) return true;
        else return false;
    }
    function s3List($typeid, $subTypeid = false, $sort = 's3files_meta_uploaded', $sortOrder = 'ASC') {
        global $DBLIB, $CONFIG;
        $DBLIB->where("s3files_meta_type", $typeid);
        if ($subTypeid) $DBLIB->where("s3files_meta_subType", $subTypeid);
        $DBLIB->where("(s3files_meta_deleteOn >= '". date("Y-m-d H:i:s") . "' OR s3files_meta_deleteOn IS NULL)"); //If the file is to be deleted soon or has been deleted don't let them download it
        $DBLIB->where("s3files_meta_physicallyStored",1); //If we've lost the file or deleted it we can't actually let them download it
        $DBLIB->orderBy($sort, $sortOrder);
        return $DBLIB->get("s3files", null, ["s3files_id", "s3files_extension", "s3files_name","s3files_meta_size", "s3files_meta_uploaded"]);
    }
    function s3URL($fileid, $size = false, $forceDownload = false, $expire = '+10 minutes', $cloudfront = true) {
        global $DBLIB, $CONFIG;
        /*
         * File interface for Amazon AWS S3.
         *  Parameters
         *      f (required) - the file id as specified in the database
         *      s (filesize) - false to get the original - available is "tiny" (100px) "small" (500px) "medium" (800px) "large" (1500px)
         *      d (optional, default false) - should a download be forced or should it be displayed in the browser? (if set it will download)
         *      e (optional, default 1 minute) - when should the link expire? Must be a string describing how long in words basically. If this file type has security features then it will default to 1 minute.
         */
        $fileid = $this->sanitizeString($fileid);
        if (strlen($fileid) < 1) return false;
        $DBLIB->where("s3files_id", $fileid);
        $DBLIB->where("(s3files_meta_deleteOn >= '". date("Y-m-d H:i:s") . "' OR s3files_meta_deleteOn IS NULL)"); //If the file is to be deleted soon or has been deleted don't let them download it
        $DBLIB->where("s3files_meta_physicallyStored",1); //If we've lost the file or deleted it we can't actually let them download it
        $file = $DBLIB->getone("s3files");
        if (!$file) return false;
        if ($size and false) { //disabled as at the moment the filenames are random so there's no way that this ever works out correct!
            switch ($size) {
                case "tiny":
                    $file['s3files_filename'] .= ' (tiny)';
                    break; //The want the original
                case "small":
                    $file['s3files_filename'] .= ' (small)';
                    break; //The want the original
                case "medium":
                    $file['s3files_filename'] .= ' (medium)';
                    break; //The want the original
                case "large":
                    $file['s3files_filename'] .= ' (large)';
                    break; //The want the original
                default:
                    //They want the original
            }
        }

        $file['expiry'] = $expire;


        switch ($file['s3files_meta_type']) {
            case 1:
                //This is a user thumbnail
                break;
            case 2:
                // Asset type thumbnail
            case 3:
                // Asset type file
            case 4:
                // Asset file
            case 5:
                // Instance thumbnail
            case 6:
                // Instance file
            case 7:
                //Project file
            case 8:
                // Maintenance job file
            case 9:
                // User thumbnail
            default:
                //There are no specific requirements for this file so not to worry.
        }

        //Generate the url

        if ($cloudfront) {
            // Create a CloudFront Client to sign the string
            $CloudFrontClient = new Aws\CloudFront\CloudFrontClient([
                'profile' => 'default',
                'version' => '2014-11-06',
                'region' => 'us-east-2'
            ]);
            $signedUrlCannedPolicy = $CloudFrontClient->getSignedUrl([
                'url' => $CONFIG['AWS']["CLOUDFRONT"]["URL"] . $file['s3files_path'] . "/" . $file['s3files_filename'] . '.' . $file['s3files_extension'],
                'expires' => time() + 300, //5 mins - time() is always UTC anyway
                'private_key' => $CONFIG['AWS']["CLOUDFRONT"]["PRIVATEKEY"],
                'key_pair_id' => $CONFIG['AWS']["CLOUDFRONT"]["KEYPAIRID"]
            ]);
            return $signedUrlCannedPolicy;
        } else {
            //Download direct from S3
            $s3Client = new Aws\S3\S3Client([
                'region' => $file["s3files_region"],
                'endpoint' => "https://" . $file["s3files_endpoint"],
                'version' => 'latest',
                'credentials' => array(
                    'key' => $CONFIG['AWS']['KEY'],
                    'secret' => $CONFIG['AWS']['SECRET'],
                )
            ]);

            $parameters = [
                'Bucket' => $file['s3files_bucket'],
                'Key' => $file['s3files_path'] . "/" . $file['s3files_filename'] . '.' . $file['s3files_extension'],
            ];
            if ($forceDownload) $parameters['ResponseContentDisposition'] = 'attachment; filename="' . $CONFIG['PROJECT_NAME'] . ' ' . $file['s3files_filename'] . '.' . $file['s3files_extension'] . '"';
            $cmd = $s3Client->getCommand('GetObject', $parameters);
            $request = $s3Client->createPresignedRequest($cmd, $file['expiry']);
            $presignedUrl = (string)$request->getUri();
            return $presignedUrl;
        }
    }
    function aTag($id) {
        if ($id == null) return null;
        if ($id <= 9999) return "A-" . sprintf('%04d', $id);
        else return "A-" . $id;
    }
    function reverseATag($tag) {
        //Reverse the process above, being sure to pick out any leading 0s
        $tag = strtolower($tag);
        $tag = str_replace("a-000",null,$tag);
        $tag = str_replace("a-00",null,$tag);
        $tag = str_replace("a-0",null,$tag);
        $tag = str_replace("a-",null,$tag);
        return $tag;
    }
}

$GLOBALS['bCMS'] = new bCMS;


