<?php

return [ // here time is measured in ms
   "forumName" => "Kurenai", 
   "forumDescription" => "All red", 
   "isOpen" => true, 
   "defaultTheme" => "powerful_retro", 
   "themes" => [
         "powerful-retro"
    ], 
   "postConfig" => [
            "allowThreadCreationForNewUsers" => '+4 days'
            ,
            "rateLimit" => [
                  "replies" => '+3 minutes',
                  "threads" => '+1 hours' 
            ], 
            "allowedMedia" => [
                     "jpeg" => true, 
                     "png" => false, 
                     "webp" => false, 
                     "gif" => false, 
                     "pdf" => false, 
                     "mp4" => false, 
                     "webm" => false, 
                     "mp3" => false, 
                     "ogg" => false 
            ] 
         ], 
    "userCreationRules" => [
      "isOpen" => true,
      "ipBlockRules" => [
        [
          "name" => "Range-block of IPs that are currently not used on the internet", 
          "ip" => "240.0.0.0/4" 
        ], 
        [
          "name" => "Block the bogus IP", 
          "ip" => "0.0.0.0" 
        ]
      ] 
    ], 
    "boardConfig" => [
      "boardIndexMaxRepliesPerThread" => 10,
      "allowBoardCreation" => [
          "isEnabled" => false,
          "rateLimit" => '+6 hours',
          "newUsersHaveToWait" => '+2 week'
      ],
    ] 
];