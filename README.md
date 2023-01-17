# farmr_dashboard
farmr.net Web App 

This forked version will look for the farmr2.net FQDN. If you are hosting locally you can just create the farmr2.net entry in your hosts file. 

Requires

flutter 3.3.0 for web build
```flutter build web``` 

php 7.4

mariadb for backend

Kreait/Firebase PHP library for authentication
    Install with ```composer require kreait/firebase-php``` 

    https://github.com/kreait/firebase-php

Your firebase-adminsdk.json authentication file must be in the parent folder of the web root. 

lib/firebaseOptions must be completed with your own values.

web/db.php must be completed with your own values.

web/oauth.php must be completed with your own values. 

To create an IIS certificate, in Powershell:
 
 New-SelfSignedCertificate -DnsName farmr2.net, localhost -CertStoreLocation cert:\LocalMachine\My -notafter (get-date).addyears(10)