# Example
====================

```php
$ws = new DoctorSenderClient($username, $api_token);
try {
    $campaigns = $ws->makeRequest('campaigns/list', ['fields' => ["name", "amount", "subject", "list_unsubscribe", "send_date", "status", "user_list", "country"], 'date' => ['start' => new \DateTime('2017-05-01'), 'end' => new \DateTime('2017-05-10')]]);

    echo 'result of campaigns/list:'.PHP_EOL.print_r($campaigns, true).PHP_EOL;
} catch (\Exception $e) {
    echo 'result of campaigns/list:'.PHP_EOL.$e->getMessage().PHP_EOL;
}
```

```php
$user = array(
    'email' => 'email@domain.tld',
    'field_firstname' => 'firstname',
    'field_lastname' => 'lastname'
);

$ws = new DoctorSenderClient($username, $api_token);
try {
    $response = $ws->makeRequest('users/create', ['listName' => 'list1', 'user' => $user, 'isTestList' => false]);

    echo 'result of users/create:'.PHP_EOL.print_r($response, true).PHP_EOL;
} catch (\Exception $e) {
    echo 'result of users/create:'.PHP_EOL.$e->getMessage().PHP_EOL;
}
```
