<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/DriveGoogle/apiclient/src/Google/autoload.php';

class Google_Drive {
    public $CI;
    public function __construct(){

        define('APPLICATION_NAME', 'hmmmmm');
        define('CREDENTIALS_PATH', FCPATH.'.credentials/drive-php-quickstart.json');
        define('CLIENT_SECRET_PATH', FCPATH . '/client_secret.json');
        define('SCOPES', implode(' ', array(
            Google_Service_Drive::DRIVE_METADATA_READONLY)
        ));

        $this->CI =& get_instance();
    }

    /**
    * Returns an authorized API client.
    * @return Google_Client the authorized client object
    */
    // function getClient($authCode) {
    //     $client = new Google_Client();
    //     $client->setApplicationName(APPLICATION_NAME);
    //     $client->setScopes(SCOPES);
    //     $client->addScope("https://www.googleapis.com/auth/drive");
    //     $client->addScope("profile");
    //     $client->addScope("email");
    //     $client->setAuthConfigFile(CLIENT_SECRET_PATH);

    //     // Exchange authorization code for an access token.
    //     $accessToken = $client->authenticate($authCode);

    //     $accessToken = json_decode($accessToken);
    //     $this->CI->session->set_userdata('google_token', $accessToken);
    //     return $client;
    // }

    // function getAuthCode(){
    //     $client = new Google_Client();
    //     $client->setApplicationName(APPLICATION_NAME);
    //     $client->setScopes(SCOPES);
    //     $client->addScope("https://www.googleapis.com/auth/drive");
    //     $client->addScope("profile");
    //     $client->addScope("email");
    //     $client->setAuthConfigFile(CLIENT_SECRET_PATH);
    //     $authUrl = $client->createAuthUrl();
    //     redirect($authUrl);
    // }


    /**
    * Expands the home directory alias '~' to the full path.
    * @param string $path the path to expand.
    * @return string the expanded path.
    */
    function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    function insertFile($service, $title, $description, $parentId, $mimeType, $filename) {
        $file = new Google_Service_Drive_DriveFile();
        $file->setTitle($title);
        $file->setDescription($description);
        $file->setMimeType($mimeType);

        // Set the parent folder.
        if ($parentId != null) {
            $parent = new Google_Service_Drive_ParentReference();
            $parent->setId($parentId);
            $file->setParents(array($parent));
        }

        try {
            $data = file_get_contents($filename);

            $createdFile = $service->files->insert($file, array(
                'data' => $data,
                'mimeType' => $mimeType,
            ));

            // Uncomment the following line to print the File ID
            // print 'File ID: %s' % $createdFile->getId();

            return $createdFile;
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }

    function getClient(){
        $client = new Google_Client();
        $client_email = 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key = file_get_contents(APPPATH.'libraries/hmmmm-4c2bd9a777d8.p12');
        $scopes = array('https://www.googleapis.com/auth/drive');
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );
        $client->setAssertionCredentials($credentials);
        return $client;
    }

    //print file metadata
    function printFile($service, $fileId) {
        try {
            $file = $service->files->get($fileId);

            print "Title: " . $file->getName();
            print "Description: " . $file->getDescription();
            print "MIME type: " . $file->getMimeType();
            //print "Download URL: : " . $file->getDownloadUrl();

            return $file;
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }

    function downloadFile($service, $downloadUrl,$client) {
        if ($downloadUrl) {
              $request = new Google_Http_Request($downloadUrl, 'GET', null, null);

              $SignhttpRequest = $client->getAuth()->sign($request);
              $httpRequest = $client->getIo()->makeRequest($SignhttpRequest);

              if ($httpRequest->getResponseHttpCode() == 200) {
                return $httpRequest->getResponseBody();
              } else {
              // An error occurred.
                return null;
              }
         } else {
          // The file doesn't have any content stored on Drive.
           return null;
         }
    }
}
