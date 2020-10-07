<?php

## PPPOE Configuration
> IP.Pool => PPP.PPPOE SERVERS => PPP.PROFILE => PPP.SECRETS 
> QUEUES => QUE.SimpleQueues => QUE.Types

# Step-1
IP => Pool => [
	'Name' => '2M-PPPOE',
	'Address' => '10.10.2.2-10.10.2.254',
];

# Step-2
PPP => PPPOE SERVERS => [
	'Service Name' => 'PPPoE Server',
	'Interface' => 'Lan Interface',
	'Default Profile' => 'Default',
];

# Step-3
PPP => PROFILE => [
	'Name' => '2MB-Profile',
	'Local Address' => 'Select Pool',
	'Remote Address' => 'Select Pool',
	'Rate Limit rx/tx' => '2M/2M',
];

# Step-4
PPP => SECRETS => [
	'Name' => '2mb@gmail.com',
	'Password' => '123123',
	'Service' => 'pppoe',
	'Profile' => '2MB-Profile',
];

# Step-6
QUEUES => QUEUE TYPE => [
	'Name' => '2MB-DN',
	'Rate' => '2M',
	'Checked' => ['Dst. Address', 'Src Address'] // DWN = Dst, UP = Src
];

# Step-7
QUEUES => SimpleQueues => General [
	'Name' => '2MB',
	'Target' => '10.10.2.0/24',
	'Checked' => ['Dst. Address', 'Src Address'] // DWN = Dst, UP = Src
];

# Step-8
QUEUES => SimpleQueues => Advance [
	'Queue Type' => ['2MB-UP', '2MB-DN']
];



