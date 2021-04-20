<?php
require '../../vendor/autoload.php'; // If you're using Composer (recommended)
// comment out the above line if not using Composer
// require("./sendgrid-php.php"); 
// If not using Composer, uncomment the above line


$apiKey = getenv('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');
$sg = new \SendGrid($apiKey);

////////////////////////////////////////////////////
// Create a batch ID #
// POST /mail/batch #

try {
    $response = $sg->client->mail()->batch()->post();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// Validate batch ID #
// GET /mail/batch/{batch_id} #

$batch_id = "test_url_param";

try {
    $response = $sg->client->mail()->batch()->_($batch_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

////////////////////////////////////////////////////
// v3 Mail Send #
// POST /mail/send #
// This endpoint has a helper, check it out [here](https://github.com/sendgrid/sendgrid-php/blob/master/lib/helpers/mail/README.md).

$request_body = json_decode('{
  "asm": {
    "group_id": 1, 
    "groups_to_display": [
      1, 
      2, 
      3
    ]
  }, 
  "attachments": [
    {
      "content": "[BASE64 encoded content block here]", 
      "content_id": "ii_139db99fdb5c3704", 
      "disposition": "inline", 
      "filename": "file1.jpg", 
      "name": "file1", 
      "type": "jpg"
    }
  ], 
  "batch_id": "[YOUR BATCH ID GOES HERE]", 
  "categories": [
    "category1", 
    "category2"
  ], 
  "content": [
    {
      "type": "text/html", 
      "value": "<html><p>Hello, world!</p><img src=[CID GOES HERE] /></html>"
    }
  ], 
  "custom_args": {
    "New Argument 1": "New Value 1", 
    "activationAttempt": "1", 
    "customerAccountNumber": "[CUSTOMER ACCOUNT NUMBER GOES HERE]"
  }, 
  "from": {
    "email": "sam.smith@example.com", 
    "name": "Sam Smith"
  }, 
  "headers": {}, 
  "ip_pool_name": "[YOUR POOL NAME GOES HERE]", 
  "mail_settings": {
    "bcc": {
      "email": "ben.doe@example.com", 
      "enable": true
    }, 
    "bypass_list_management": {
      "enable": true
    }, 
    "footer": {
      "enable": true, 
      "html": "<p>Thanks</br>The SendGrid Team</p>", 
      "text": "Thanks,/n The SendGrid Team"
    }, 
    "sandbox_mode": {
      "enable": false
    }, 
    "spam_check": {
      "enable": true, 
      "post_to_url": "http://example.com/compliance", 
      "threshold": 3
    }
  }, 
  "personalizations": [
    {
      "bcc": [
        {
          "email": "sam.doe@example.com", 
          "name": "Sam Doe"
        }
      ], 
      "cc": [
        {
          "email": "jane.doe@example.com", 
          "name": "Jane Doe"
        }
      ], 
      "custom_args": {
        "New Argument 1": "New Value 1", 
        "activationAttempt": "1", 
        "customerAccountNumber": "[CUSTOMER ACCOUNT NUMBER GOES HERE]"
      }, 
      "headers": {
        "X-Accept-Language": "en", 
        "X-Mailer": "MyApp"
      }, 
      "send_at": 1409348513, 
      "subject": "Hello, World!", 
      "substitutions": {
        "id": "substitutions", 
        "type": "object"
      }, 
      "to": [
        {
          "email": "john.doe@example.com", 
          "name": "John Doe"
        }
      ]
    }
  ], 
  "reply_to": {
    "email": "sam.smith@example.com", 
    "name": "Sam Smith"
  }, 
  "sections": {
    "section": {
      ":sectionName1": "section 1 text", 
      ":sectionName2": "section 2 text"
    }
  }, 
  "send_at": 1409348513, 
  "subject": "Hello, World!", 
  "template_id": "[YOUR TEMPLATE ID GOES HERE]", 
  "tracking_settings": {
    "click_tracking": {
      "enable": true, 
      "enable_text": true
    }, 
    "ganalytics": {
      "enable": true, 
      "utm_campaign": "[NAME OF YOUR REFERRER SOURCE]", 
      "utm_content": "[USE THIS SPACE TO DIFFERENTIATE YOUR EMAIL FROM ADS]", 
      "utm_medium": "[NAME OF YOUR MARKETING MEDIUM e.g. email]", 
      "utm_name": "[NAME OF YOUR CAMPAIGN]", 
      "utm_term": "[IDENTIFY PAID KEYWORDS HERE]"
    }, 
    "open_tracking": {
      "enable": true, 
      "substitution_tag": "%opentrack"
    }, 
    "subscription_tracking": {
      "enable": true, 
      "html": "If you would like to unsubscribe and stop receiving these emails <% clickhere %>.", 
      "substitution_tag": "<%click here%>", 
      "text": "If you would like to unsubscribe and stop receiving these emails <% click here %>."
    }
  }
}');

try {
    $response = $sg->client->mail()->send()->post($request_body);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
