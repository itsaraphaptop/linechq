<?php
    require_once __DIR__ . '/vendor/autoload.php';
  
    // debug
    error_reporting(-1);
    ini_set('display_errors', 'On');
  
    // Channel secret - (from https://developers.line.me/console/)
    $token = 'b4Mm4PJSr3Ohue4vaTsg/W39BESnwRb0FI/Q9Y8MuGyFD9+rGi7BIKgRpPIA42sDu6LXibUl3pkyvOEGq2i8vjdpupkYio0Ji8lF6jWaEDVvEtbYufmHUvJZlH9DccfvKwZoi5OKLy3p1c3YnrdHEAdB04t89/1O/w1cDnyilFU=';
    // $token = $_POST['token'];
    
    // Channel access token - (from https://developers.line.me/console/)
    $secret = '3a1e2108bff253cfa7480883dc105c88';
    // $secret = $_POST['secret'];
//    $pushID = array(
//        "U11fae07ce7afb4aac7875be082b2b3ee",
//        "U0e6b5794496cbcee1bb4850c8f888c8c",
//        "U8f70ff048d6c81f89cc0f280be0acef2"
//    );
  
    // connect key setup
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);
  
    $request = file_get_contents('php://input');   // Get request content
    $request_array = json_decode($request, true);   // Decode JSON to Array
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$token}";
// // if(isset($_POST['to']) && trim($_POST['to']) != '' && isset($_POST['text']) && trim($_POST['text']) != ''){
  //   if(trim($request_array['id']) != ''){
    //   // check for send message only
    //   $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($request_array['text']);
    //   $response = $bot->pushMessage($request_array['id'], $textMessageBuilder);
    
    //   // check status sending line api
    //   if($response->isSucceeded()){
      //     echo "true";
      //     return;
      //   }else{
        //     echo "false";
        //   }
        echo $request_array['type'];
      $message = $request_array['type'];
      $n = 0;
      if($message == "message"){
          $arrayPostData['to'] = $request_array['id'];
          // $arrayPostData['messages'][0]['type'] = "text";
          // $arrayPostData['messages'][0]['text'] = $request_array['text'];
          // $arrayPostData['messages'][1]['type'] = "sticker";
          // $arrayPostData['messages'][1]['packageId'] = "2";

          // $arrayPostData['messages'][1]['stickerId'] = "34";z
          $arrayPostData['messages'][0]['type'] = "flex";
          $arrayPostData['messages'][0]['altText'] = $request_array['text'];
          $arrayPostData['messages'][0]['contents']['type'] =  "bubble";
          $arrayPostData['messages'][0]['contents']['direction'] =  "ltr";
          $arrayPostData['messages'][0]['contents']['header']['type'] =  "box";
          $arrayPostData['messages'][0]['contents']['header']['layout'] =  "vertical";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] =  "text";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] =  $request_array['text'];
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] =  "lg";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['align'] =  "start";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] =  "bold";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['color'] =  "#009813";

          $arrayPostData['messages'][0]['contents']['header']['contents'][1]['type'] =  "text";
          $arrayPostData['messages'][0]['contents']['header']['contents'][1]['text'] =  $request_array['customername'];
          $arrayPostData['messages'][0]['contents']['header']['contents'][1]['size'] =  "lg";
          $arrayPostData['messages'][0]['contents']['header']['contents'][1]['weight'] =  "bold";
          $arrayPostData['messages'][0]['contents']['header']['contents'][1]['color'] =  "#000000";

          // $arrayPostData['messages'][0]['contents']['header']['contents'][2]['type'] =  "text";
          // $arrayPostData['messages'][0]['contents']['header']['contents'][2]['text'] =  $request_array['pay'];
          // $arrayPostData['messages'][0]['contents']['header']['contents'][2]['size'] =  "lg";
          // $arrayPostData['messages'][0]['contents']['header']['contents'][2]['weight'] =  "bold";
          // $arrayPostData['messages'][0]['contents']['header']['contents'][2]['color'] =  "#000000";

          // $arrayPostData['messages'][0]['contents']['body']['type'] =  "box";
          // $arrayPostData['messages'][0]['contents']['body']['layout'] =  "vertical";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] =  "separator";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][0]['color'] =  "#C3C3C3";

          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] =  "box";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['layout'] =  "baseline";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['margin'] =  "lg";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][0]['type'] =  "text";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][0]['text'] =  $request_array['detail'];
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][0]['align'] =  "start";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][0]['color'] =  "#000000";
          
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][1]['type'] =  "text";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][1]['text'] =   $request_array['unit'];
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][1]['align'] =  "end";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][1]['contents'][1]['color'] =  "#000000";

          // $arrayPostData['messages'][0]['contents']['body']['contents'][2]['type'] =  "separator";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][2]['margin'] =  "lg";
          // $arrayPostData['messages'][0]['contents']['body']['contents'][2]['color'] =  "#C3C3C3";

           $arrayPostData['messages'][0]['contents']['footer']['type'] =  "box";
           $arrayPostData['messages'][0]['contents']['footer']['layout'] =  "horizontal";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] =  "text";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] =  "View Details";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] =  "lg";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] =  "start";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['color'] =  "#0084B6";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['type'] =  "uri";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['label'] =  "View Detail";
           $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['action']['uri'] =  $request_array['base_url'];
          
          
          var_dump($arrayPostData);
          // die();
      if($n==0){
        pushMsg($arrayHeader,$arrayPostData);
      }

      $n++;
      echo true;
   }elseif ($message == "flex") {
    
      // $arrayPostData = [
      //   "type" => "flex",
      //   "altText" => "Hello Flex Message",
      //   "contents" => [
      //     "type" => "bubble",
      //     "direction" => "ltr",
      //     "header" => [
      //       "type" => "box",
      //       "layout" => "vertical",
      //       "contents" => [
      //       [
      //         "type" => "text",
      //         "text" => "บอลติดหนี้",
      //         "size" => "lg",
      //         "align" => "start",
      //         "weight" => "bold",
      //         "color" => "#009813"
      //       ],
      //       [
      //         "type" => "text",
      //         "text" => "฿ 100.00",
      //         "size" => "3xl",
      //         "weight" => "bold",
      //         "color" => "#000000"
      //       ],
      //       [
      //         "type" => "text",
      //         "text" => "Rabbit Line Pay",
      //         "size" => "lg",
      //         "weight" => "bold",
      //         "color" => "#000000"
      //       ],
      //       [
      //         "type" => "text",
      //         "text" => "2019.02.14 21:47 (GMT+0700)",
      //         "size" => "xs",
      //         "color" => "#B2B2B2"
      //       ],
      //       [
      //         "type" => "text",
      //         "text" => "กรุณาจ่าย.",
      //         "margin" => "lg",
      //         "size" => "lg",
      //         "color" => "#000000"
      //       ]
      //       ]
      //     ]
      //   ]
      // ];


     $arrayPostData = [
      "to" => $request_array['id'],
      "messages" => [
        [
          "type" => "flex",
          "altText" => "This is a Flex Message",
          "contents" => [
            "type" => "bubble",
            "header" => [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type"=> "image",
                  "url"=> "https://sv1.picz.in.th/images/2022/08/25/aNrEuq.jpg",
                  "size"=> "full",
                  "aspectMode"=> "cover",
                  "margin"=> "none",
                  "align"=> "center",
                  "backgroundColor"=> "#044383",
                  "offsetTop"=> "none",
                  "offsetBottom"=> "none",
                  "offsetStart"=> "none",
                  "aspectRatio"=> "31:15",
                  "position"=> "absolute",
                  "offsetEnd"=> "none",
                  "gravity"=> "center"
                ],
                [
                  "type" => "text",
                  "text" => $request_array['text'],
                  "size" => "xs",
                  "margin"=> "none",
                  "align" => "end",
                  "weight" => "regular",
                  "offsetTop"=> "lg",
                  "adjustMode"=> "shrink-to-fit",
                  "color" => "#ffffff"
                ]
              ],
              "spacing"=> "none",
              "margin"=> "none",
              "height"=> "100px",
              "justifyContent"=> "flex-end"
            ],
            "body" => [
              "type" => "box",
              "layout" => "vertical",
              "spacing" => "md",
              "contents" => [
                [
                  "type" => "text",
                  "text" => $request_array['customername'],
                  "wrap" => true,
                  "weight" => "bold",
                  "size" => "lg",
                  "margin" => "none"
                ],
                [
                  "type" => "box",
                  "layout" => "vertical",
                  "margin" => "xs",
                  "spacing" => "xs",
                  "contents" => [
                    [
                      "type" => "box",
                      "layout" => "baseline",
                      "spacing" => "sm",
                      "contents" => [
                        [
                          "type" => "text",
                          "text" => "วันที่ :",
                          "size" => "sm",
                          "flex" => 2,
                          "margin" => "none"
                        ],
                        [
                          "type" => "text",
                          "text" => $request_array['buydate'],
                          "wrap" => true,
                          "size" => "md",
                          "color" => "#000000",
                          "flex" => 8,
                          "weight" => "regular",
                          "decoration" => "none",
                          "align" => "start"
                        ]
                      ],
                      "margin" => "none"
                    ],
                    [
                      "type" => "box",
                      "layout" => "baseline",
                      "spacing" => "sm",
                      "contents" => [
                        [
                          "type" => "text",
                          "text" => "กรอบ :",
                          "size" => "sm",
                          "flex" => 2,
                          "margin" => "none"
                        ],
                        [
                          "type" => "text",
                          "text" => $request_array['frame'],
                          "wrap" => true,
                          "size" => "md",
                          "color" => "#044383",
                          "flex" => 8,
                          "weight" => "regular",
                          "decoration" => "none"
                        ]
                      ]
                    ],
                    [
                      "type" => "box",
                      "layout" => "baseline",
                      "spacing" => "sm",
                      "contents" => [
                        [
                          "type" => "text",
                          "text" => "เลนส์ :",
                          "size" => "sm",
                          "flex" => 2,
                          "margin" => "none"
                        ],
                        [
                          "type" => "text",
                          "text" => $request_array['lens'],
                          "wrap" => true,
                          "size" => "md",
                          "color" => "#044383",
                          "flex" => 8,
                          "weight" => "regular"
                        ]
                      ]
                    ],
                    [
                      "type" => "separator",
                      "margin" => "md"
                    ],
                    [
                      "type" => "box",
                      "layout" => "baseline",
                      "spacing" => "sm",
                      "contents" => [
                        [
                          "type" => "text",
                          "text" => $request_array['prescription'],
                          "wrap" => true,
                          "size" => "sm",
                          "color" => "#576975",
                          "flex" => 6,
                          "weight" => "regular",
                          "decoration" => "none",
                          "margin" => "xs"
                        ]
                      ]
                    ]
                  ],
                  "borderWidth" => "none",
                  "borderColor" => "#D5EAFF"
                ]
              ],
            ],
            "footer" => [
              "type" => "box",
              "layout" => "vertical",
              "contents" => [
                [
                  "type" => "image",
                  "url" => "https://sv1.picz.in.th/images/2022/08/25/aNrQVb.jpg",
                  "size" => "full",
                  "aspectRatio" => "18:4",
                  "aspectMode" => "cover",
                  "margin" => "none",
                  "offsetTop" => "none",
                  "offsetBottom" => "none",
                  "offsetStart" => "none",
                  "position" => "absolute",
                  "align" => "center",
                  "gravity" => "center",
                  "offsetEnd" => "none"
                ]
              ],
              "spacing" => "none",
              "margin" => "none",
              "offsetEnd" => "none",
              "offsetBottom" => "none",
              "height" => "65px",
              "borderColor" => "#576975"
            ],
            "styles" => [
              "footer" => [
                "backgroundColor" => "#576975",
                "separator" => true
              ]
            ]
          ]
        ]
      ]
    ];

    // $arrayPostData = [
    //   "to" => $request_array['id'],
    //   "messages" => [
    //     [
    //       "type"=> "flex",
    //       "altText"=> "this is a flex message",
    //       "contents"=>

    //       //Start FLEX      

    //       [
    //         "type"=> "bubble",
    //         "header"=> [
    //           "type"=> "box",
    //           "layout"=> "vertical",
    //           "contents"=> [
    //             [
    //               "type"=> "image",
    //               "url"=> "https://sv1.picz.in.th/images/2022/08/25/aNrEuq.jpg",
    //               "size"=> "full",
    //               "aspectMode"=> "cover",
    //               "margin"=> "none",
    //               "align"=> "center",
    //               "backgroundColor"=> "#044383",
    //               "offsetTop"=> "none",
    //               "offsetBottom"=> "none",
    //               "offsetStart"=> "none",
    //               "aspectRatio"=> "31:15",
    //               "position"=> "absolute",
    //               "offsetEnd"=> "none",
    //               "gravity"=> "center"
    //             ],
    //             [
    //               "type"=> "text",
    //               "text"=> "" + $request_array['text'],
    //               "size"=> "xs",
    //               "color"=> "#ffffff",
    //               "margin"=> "none",
    //               "align"=> "end",
    //               "weight"=> "regular",
    //               "offsetTop"=> "lg",
    //               "adjustMode"=> "shrink-to-fit"
    //             ]
    //           ],
    //           "spacing"=> "none",
    //           "margin"=> "none",
    //           "height"=> "100px",
    //           "justifyContent"=> "flex-end"
    //         ],
    //         "body"=> [
    //           "type"=> "box",
    //           "layout"=> "vertical",
    //           "spacing"=> "md",
    //           "contents"=> [
    //             [
    //               "type"=> "text",
    //               "text"=> "" + $request_array['customername'],
    //               "wrap"=> true,
    //               "weight"=> "bold",
    //               "size"=> "lg",
    //               "margin"=> "none"
    //             ],
    //             [
    //               "type"=> "box",
    //               "layout"=> "vertical",
    //               "margin"=> "xs",
    //               "spacing"=> "xs",
    //               "contents"=> [
    //                 [
    //                   "type"=> "box",
    //                   "layout"=> "baseline",
    //                   "spacing"=> "sm",
    //                   "contents"=> [
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "วันที่ :",
    //                       "size"=> "sm",
    //                       "flex"=> 2,
    //                       "margin"=> "none"
    //                     ],
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "" + $request_array['buydate'],
    //                       "wrap"=> true,
    //                       "size"=> "md",
    //                       "color"=> "#000000",
    //                       "flex"=> 8,
    //                       "weight"=> "regular",
    //                       "decoration"=> "none",
    //                       "align"=> "start"
    //                     ]
    //                   ],
    //                   "margin"=> "none"
    //                 ],
    //                 [
    //                   "type"=> "box",
    //                   "layout"=> "baseline",
    //                   "spacing"=> "sm",
    //                   "contents"=> [
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "กรอบ :",
    //                       "size"=> "sm",
    //                       "flex"=> 2,
    //                       "margin"=> "none"
    //                     ],
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "" , //วันที่ขาย
    //                       "wrap"=> true,
    //                       "size"=> "md",
    //                       "color"=> "#044383",
    //                       "flex"=> 8,
    //                       "weight"=> "regular",
    //                       "decoration"=> "none"
    //                     ]
    //                   ]
    //                   ],
    //                 [
    //                   "type"=> "box",
    //                   "layout"=> "baseline",
    //                   "spacing"=> "sm",
    //                   "contents"=> [
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "เลนส์ :",
    //                       "size"=> "sm",
    //                       "flex"=> 2,
    //                       "margin"=> "none"
    //                     ],
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "" , // Lens
    //                       "wrap"=> true,
    //                       "size"=> "md",
    //                       "color"=> "#044383",
    //                       "flex"=> 8,
    //                       "weight"=> "regular"
    //                     ]
    //                   ]
    //                   ],
    //                 [
    //                   "type"=> "separator",
    //                   "margin"=> "md"
    //                 ],
    //                 [
    //                   "type"=> "box",
    //                   "layout"=> "baseline",
    //                   "spacing"=> "sm",
    //                   "contents"=> [
    //                     [
    //                       "type"=> "text",
    //                       "text"=> "", // Prescription
    //                       "wrap"=> true,
    //                       "size"=> "sm",
    //                       "color"=> "#576975",
    //                       "flex"=> 6,
    //                       "weight"=> "regular",
    //                       "decoration"=> "none",
    //                       "margin"=> "xs"
    //                   ]
    //                   ]
    //                 ]
    //               ],
    //               "borderWidth"=> "none",
    //               "borderColor"=> "#D5EAFF"
    //             ]
    //           ]
    //           ],
    //         "footer"=> [
    //           "type"=> "box",
    //           "layout"=> "vertical",
    //           "contents"=> [
    //             [
    //               "type"=> "image",
    //               "url"=> "https://sv1.picz.in.th/images/2022/08/25/aNrQVb.jpg",
    //               "size"=> "full",
    //               "aspectRatio"=> "18:4",
    //               "aspectMode"=> "cover",
    //               "margin"=> "none",
    //               "offsetTop"=> "none",
    //               "offsetBottom"=> "none",
    //               "offsetStart"=> "none",
    //               "position"=> "absolute",
    //               "align"=> "center",
    //               "gravity"=> "center",
    //               "offsetEnd"=> "none"
    //             ]
    //           ],
    //           "spacing"=> "none",
    //           "margin"=> "none",
    //           "offsetEnd"=> "none",
    //           "offsetBottom"=> "none",
    //           "height"=> "65px",
    //           "borderColor"=> "#576975"
    //         ],
    //         "styles"=> [
    //           "footer"=> [
    //             "backgroundColor"=> "#576975",
    //             "separator"=> true
    //           ]
    //         ]
    //       ]

    //     ]
    //   ]
    // ];

    pushMsg($arrayHeader,$arrayPostData);
   }
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
      print_r($result);
   }
   function pushMsgjson($arrayHeader,$arrayPostData){
    

    $data = [
      'messages' => [$arrayPostData]
    ];
    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
    // echo $data;
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
  
    // }else{
  
    //   // Get POST body content
    //   $content = file_get_contents('php://input');
    //   // Parse JSON
    //   $events = json_decode($content, true);
  
    //   // Validate parsed JSON data
    //   if (!is_null($events['events'])) {
    //     foreach ($events['events'] as $event) {
    //       if($event['type'] == "message" && isset($event['message']['text'])){
  
    //         $type = $event['source']['type']; // user , room , group
    //         $to = $event['source'][$type.'Id']; // userId , roomId , groupId
    //         $message = trim($event['message']['text']);
  
    //         switch ($message) {
    //           case '/help':
    //             $text = "ฉันคือ ID Finder Bot ยินดีที่ได้รู้จัก";
    //             $text .= "\nฉันมีหน้าที่ช่วยคุณค้าหา UserID RoomID หรือ GroupID ให้กับคุณ";
    //             $text .= "\nลองพิมพ์ /id ดูซิ";
    //             break;
    //           case '/id':
    //             $text = "ข้อมูล ID ของคุณ";
    //             if(isset($event['source']['userId'])){ $text .= "\nUser ID : ".$event['source']['userId']; }
    //             if(isset($event['source']['roomId'])){ $text .= "\nRoom ID : ".$event['source']['roomId']; }
    //             if(isset($event['source']['groupId'])){ $text .= "\nGroup ID : ".$event['source']['groupId']; }
    //             break;
    //           default:
    //             $text = NULL;
    //             break;
    //         }
  
    //         // message setup & send
    //         if($text != NULL){
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("OMG");
    //           $response = $bot->replyMessage($to, $textMessageBuilder);
    //         }
  
    //       }
    //     }
    //   }
    // }
  
    // debug
    // echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
  ?>
