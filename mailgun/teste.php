<?php
# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-36b73492921d746eecdde68e3852fd29', null, 'bin.mailgun.net');
$mg->setApiVersion('72fbbe3a');
$mg->setSslEnabled(false);
$domain = "sandboxbd82401dff6e4cbf87c64517fb37a9e1.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandboxbd82401dff6e4cbf87c64517fb37a9e1.mailgun.org>',
                        'to'      => 'Francine Resende <fran.mresende@gmail.com>',
                        'subject' => 'Hello Francine Resende',
                        'text'    => 'Congratulations Francine Resende, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));

?>
