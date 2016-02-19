<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace USF\IdM\SlimSkeleton\Service;

/**
 * Description of GartnerService
 *
 * @author James Jones <james@mail.usf.edu>
 */
class GartnerService implements \USF\IdM\AuthTransfer\AuthTransferServiceInterface {

    public function __construct(LoggerInterface $logger, Collection $settings) {
        $this->logger = $logger;
        $this->settings = $settings;

        // Pull config data from the settings object
        $serviceConfig = $settings['example_config'];

        // If you need to configure your service object, do it here and  add it as a
        // private property to the class.
    }

    /**
     * Generate a MD5 digest token and construct the URL needed for Gartner authentication
     *
     * Last Update: 9-14-2012 (epierce@usf.edu)
     *
     * Example input:
     * [ time: unixTime.
     *   uid: username,
     *   fn: firstName,
     *   ln: lastName,
     *   em: email,
     *   title: eppa,
     *   other: campus,
     *   resId: resId,
     *   docCode: docCode ]
     *
     * NOTES:
     *    * resId and docCode are document identifiers from Gartner
     * 
     * @param array $paramMap
     * @return string The redirect URL
     */
    public function getRedirectUrl($paramMap) {
        $gartnerParams = [];
        
        $messageFormat = $this->settings['gartner']['messageFormat'] ?? '';
        if($messageFormat == "uid") {
            $gartnerParams['uid'] = $paramMap['uid'] ?? '';
        } else {
            $gartnerParams['fn'] = $paramMap['fn'] ?? '';
            $gartnerParams['ln'] = $paramMap['ln'] ?? '';
            $gartnerParams['em'] = $paramMap['em'] ?? '';            
        }
        
        // If time wasn't passed in constructor use current time
        $gartnerParams['dt'] = $this->settings['gartner']['testTime'] ?? \time();
        
        //Add EPPA and Campus
        if (isset($paramMap['title'])) {
            $gartnerParams['title'] = $paramMap['title'];
        }
        if (isset($paramMap['other'])) {
            $gartnerParams['other'] = $paramMap['other'];
        }


        // \http_build_query();
    }

//put your code here
}