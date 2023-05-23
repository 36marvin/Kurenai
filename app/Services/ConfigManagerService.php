<?php
/** 
 * This class is breaking so many solid principles...
*/

namespace App\Services;

class ConfigManagerService {
    private $config;

    private $configFromAdmin;

    const FILE_DIRECTORY = __DIR__ . './../../config/global/kurenaiConfig.json';

    public function __construct () {
        $this->loadConfig();
    }

    private function loadConfig () {
        $configFile = file_get_contents(self::FILE_DIRECTORY);
        $configFile = json_decode($configFile);
        $this->config = $configFile;
    }

    private function writeToConfigFile () {
        $configAsString = json_encode($this->config,  JSON_PRETTY_PRINT); 
        file_put_contents(self::FILE_DIRECTORY, $configAsString);
    }

    public function getConfig() {
        return $this->config;
    }

    public function setBoardConfig ($maxRepliesIndex, $isEnabled, $rateLimit, $userWait) {
        try {
            $this->config->boardIndexMaxRepliesPerThread = $maxRepliesIndex;
            $this->config->allowBoardCreation->isEnabled = $isEnabled;
            $this->config->allowBoardCreation->rateLimit = $rateLimit;
            $this->config->allowBoardCreation->newUsersHaveToWait = $userWait;
        }
        catch (Exception $e) { // maybe this exception handling should be in a validator class
            if (config('app.debug') === false) {
                return redirect('/error/500');
            }
            throw new Exception($e->getMessage());
        }
        $this->writeToConfigFile();
    }

    public function setGeneralConfig ($forumName, $forumDescription, $isOpen, $defaultTheme) {
        try {
            $this->config->forumName = $forumName;
            $this->config->forumDescription = $forumDescription;
            $this->config->isOpen = $isOpen;
            $this->config->defaultTheme = $defaultTheme;
        }
        catch (Exception $e) {
            if (config('app.debug') === false) {
                return redirect('/error/500');
            }
            throw new Exeption($e->getMEssage);
        }
        $this->writeToConfigFile();
    }

    public function setPostConfig ($allowThreadNewUsr, $rateLimitReplies, $rateLimitThreads, ...$mediaInputArr) {
        try {
            $this->config->postConfig->allowThreadCreationForNewUsers = $allowThreadNewUsr;
            $this->config->postConfig->rateLimit->replies = $rateLimitReplies;
            $this->config->postConfig->rateLimit->threads = $rateLimitThreads;

            // For each media name in the original config array...
            foreach($this->config->postConfig->allowedMedia as $mediaName => $isAllowed) {
                // check if it has a match in the $mediaInputArr variable that 
                // the user gave us and, if so, assign the user-provided value 
                // to the config.
                foreach($mediaInputArr as $mediaNameInput => $isAllowedInput) {
                    if($mediaName === $mediaNameInput) {
                        $this->config->postConfig->allowedMedia->$mediaName = $isAllowedInput;
                    }
                }
            }    
        }
        catch(Exception $e) {
            if (config('app.debug') === false) {
                return redirect('/error/500');
            }
            throw new Exeption($e->getMEssage);
        }
        $this->writeToConfigFile();
    }

    /**
     * Uses the current request to return an array 
     * containing all media names as keys and their
     * boolean value as values.
     * 
     * (Because HTML5/http is still a piece of shit and 
     * can't provide associative arrays from forms.)
     */
    public function makeArrayOfAllowedMediaFromRequest() {
        $mediaArr = [
            'jpeg','png', 'webp', 'gif', 'pdf', 
            'mp4', 'webm', 'mp3', 'ogg'
        ];
        $finalArr = array();

        foreach($mediaArr as $media) {
            // Did the user send us this media? If so,
            // this means he wants it to be allowed.
            $mediaRequest = request($media);
            if (isset($mediaRequest)) {
                $finalArr += [$media => true];
            } else {
                $finalArr += [$media => false];
            }
        }
        return $finalArr;
    }
}