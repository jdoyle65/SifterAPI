# SifterAPI

[![Build Status](https://travis-ci.org/jdoyle65/SifterAPI.svg?branch=master)](https://travis-ci.org/jdoyle65/SifterAPI)


# Example Usage

```php
$apiKey = '2345LIKUYGWE35246KUYG2EKG';
$apiSubdomain = 'example';

$sifter = new Sifter(new SifterCurl($apiKey, $apiSubdomain));

$projects = $sifter->allProjects();

foreach($projects as $project) {
  echo $project->getName();
  echo "<br>";
  echo $project->getPrimaryCompanyName();
  echo "<br>";
  echo "<h3>People</h3><br>";
  
  $people = $project->people();
  foreach($people as $person) {
    echo $person->getUsername() . " : " . $person->getFullName() . "<br>";
  }
}
```
